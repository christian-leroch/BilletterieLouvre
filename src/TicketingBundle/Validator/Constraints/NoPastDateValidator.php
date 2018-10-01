<?php
// src/TicketingBundle/Validator/Constraints/NoPastDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoPastDateValidator extends ConstraintValidator
{
    /**
     * @param $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $nowDate = new \DateTime();
        if($nowDate > $value && !($nowDate->format('Y-m-d') == $value->format('Y-m-d'))){
            $this->context->buildViolation($constraint->messageNoPastDate)
                ->setParameter('{{ ticketDate }}', $value->format('Y-m-d'))
                ->addViolation();
        }
    }
}