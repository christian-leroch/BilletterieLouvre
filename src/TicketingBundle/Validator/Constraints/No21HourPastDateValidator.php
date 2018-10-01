<?php
// src/TicketingBundle/Validator/Constraints/No21HourPastDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class No21HourPastDateValidator extends ConstraintValidator
{
    const LIMIT_HOUR = 21;

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
        $dateNow = $now->format('d/m/Y');
        $hourNow = (int) $now->format('G');
        $dayNow = $now->format('N');
        $ticketDate = $booking->getTicketDate();
        $ticketDate = $ticketDate->format('d/m/Y');

        if(($dayNow == '3' || $dayNow == '5') && ($ticketDate == $dateNow) && ($hourNow >= self::LIMIT_HOUR))
        {
            $this->context->buildViolation($constraint->messageNo21HourPastDate)
                ->atPath('ticketDate')
                ->addViolation();
        }
    }
}
