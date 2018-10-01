<?php
// src/TicketingBundle/Validator/Constraints/NoSundayDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoSundayDateValidator extends ConstraintValidator
{
    /**
     * @param $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $booking || '' === $booking) {
            return;
        }

        $now = new \DateTime();
        $dayNow = $now->format('N');
        $ticketDate = $booking->getTicketDate();
        $ticketDateDay = $ticketDate->format('N');


        if ($ticketDateDay == '7' && $ticketDate == $dayNow) {
            $this->context->buildViolation($constraint->messageNoSundayDate)
                ->atPath('ticketDate')
                ->addViolation();
        }
    }
}