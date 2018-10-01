<?php
// src/TicketingBundle/Validator/Constraints/No2YearsLaterDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @param $value
 * @param Constraint $constraint
 */
class No2YearsLaterDateValidator extends ConstraintValidator
{
    const MAX_DAY = 730;
    public function validate($value, Constraint $constraint)
    {
        $nowDate = new \DateTime();
        $diffNowDateTicketDate = $nowDate->diff($value);
        if($diffNowDateTicketDate->format('%a') > self::MAX_DAY){
            $this->context->buildViolation($constraint->messageNo2YearsLaterDate)
                ->setParameter('{{ ticketDate }}', $value->format('Y-m-d'))
                ->addViolation();
        }
    }
}