<?php
// src/TicketingBundle/Validator/Constraints/No14HourPastDateValidatorphp

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class No14HourPastDateValidator extends ConstraintValidator
{
    const LIMIT_HOUR = 14;

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
        $ticketDate = $booking->getTicketDate();
        $ticketDate = $ticketDate->format('d/m/Y');

        if(($booking->getTicketType() === 'Journee') && ($ticketDate == $dateNow) && ($hourNow >= self::LIMIT_HOUR))
        {
            $this->context->buildViolation($constraint->messageNo14HourPastDate)
                ->atPath('ticketType')
                ->addViolation();
        }
    }
}