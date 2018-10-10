<?php
// src/TicketingBundle/Validator/Constraints/NotAfterCertainHoursValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotAfterCertainHoursValidator extends ConstraintValidator
{
    const LIMIT_HOUR_18 = 16;
    const LIMIT_HOUR_22 = 20;
    const LIMIT_HOUR_14 = 12;

    /**
     * @param $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $booking || '' === $booking)
        {
            return;
        }

        $now = new \DateTime();
        $dateNow = $now->format('d/m/Y');
        $hourNow = (int) $now->format('G');
        $dayNow = $now->format('N');
        $ticketDate = $booking->getTicketDate();
        $ticketDate = $ticketDate->format('d/m/Y');
        $ticketingClosingTime = 0;

        if (($booking->getTicketType() === 'Journee') && ($ticketDate === $dateNow) && ($hourNow >= self::LIMIT_HOUR_14))
        {
            $limitHour = 14;
            $this->context->buildViolation($constraint->messageNotAfter14Hours)
                ->atPath('ticketType')
                ->setParameter('{{ limitHour }}', $limitHour)
                ->addViolation();
        }

        if (($dayNow === '1' || $dayNow === '4' || $dayNow =='6') && ($ticketDate === $dateNow) && ($hourNow >= self::LIMIT_HOUR_18))
        {
            $ticketingClosingTime = 17;
        }
        elseif (($dayNow === '3' || $dayNow === '5') && ($ticketDate === $dateNow) && ($hourNow >= self::LIMIT_HOUR_22))
        {
            $ticketingClosingTime = 21;
        }

        if ($ticketingClosingTime !== 0)
        {
        $this->context->buildViolation($constraint->messageNotOneHourBeforeClosingTime)
            ->setParameter('{{ ticketingClosingTime }}', $ticketingClosingTime)
            ->setParameter('{{ museumClosingTime }}', $ticketingClosingTime + 1)
            ->atPath('ticketDate')
            ->addViolation();
        }
    }
}