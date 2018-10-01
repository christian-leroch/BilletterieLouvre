<?php
// src/TicketingBundle/Validator/Constraints/NoTuesdayDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @param $value
 * @param Constraint $constraint
 */
class NoTuesdayDateValidator extends ConstraintValidator

{
    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $day = $value->format('N');
        if ($day == '2') {
            $this->context->buildViolation($constraint->messageNoTuesdayDate)
                ->addViolation();
        }
    }
}