<?php
// src/TicketingBundle/Validator/Constraints/InvalidDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class InvalidDateValidator extends ConstraintValidator
{
    /**
     * @param $ticketDate
     * @param Constraint $constraint
     */
    public function validate($ticketDate, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $ticketDate || '' === $ticketDate) {
            return;
        }

        if (!$ticketDate instanceof \DateTime) {

            $this->context->buildViolation($constraint->messageInvalidDate)
            ->addViolation();
        }
    }
}