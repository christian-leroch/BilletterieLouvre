<?php
// src/TicketingBundle/Validator/Constraints/UnavailableDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @param $value
 * @param Constraint $constraint
 */
class UnavailableDateValidator extends ConstraintValidator
{
    const MAX_DAY = 730;

    public function validate($value, Constraint $constraint)
    {
        $nowDate = new \DateTime();
        $diffNowDateTicketDate = $nowDate->diff($value);

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value)
        {
            return;
        }

        if (!$value instanceof \DateTime)
        {
            $this->context->buildViolation($constraint->messageInvalidDate)
                ->addViolation();
        }

        if($diffNowDateTicketDate->format('%a') > self::MAX_DAY){
            $this->context->buildViolation($constraint->messageNo2YearsLaterDate)
                ->setParameter('{{ value }}', $value->format('Y-m-d'))
                ->addViolation();
        }

        if($nowDate > $value && !($nowDate->format('Y-m-d') === $value->format('Y-m-d'))){
            $this->context->buildViolation($constraint->messageNoPastDate)
                ->setParameter('{{ ticketDate }}', $value->format('Y-m-d'))
                ->addViolation();
        }
    }
}