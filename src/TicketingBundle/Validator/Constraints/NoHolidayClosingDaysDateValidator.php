<?php
// src/TicketingBundle/Validator/Constraints/NoHolidayClosingDaysDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NoHolidayClosingDaysDateValidator extends ConstraintValidator
{
    /**
     * @param $booking
     * @param Constraint $constraint
     */
    public function validate($booking, Constraint $constraint)
    {
        $ticketdate = $booking->getTicketDate();
        $ticketdate = $ticketdate->format('Y');

        $holidayClosingDays = array(
            'FeteTravail' => new \DateTime((int)$ticketdate . '-05-01'),
            'Toussaint' => new \DateTime((int)$ticketdate . '-11-01'),
            'Noel' => new \DateTime((int)$ticketdate . '-12-25'),
        );
        //dump($holidayClosingDays, $booking);die();
        //return $holidayClosingDays;

        if(in_array($booking->getTicketDate(),$holidayClosingDays)){
            $this->context->buildViolation($constraint->messageNoHolidayClosingDaysDate)
                ->atPath('ticketDate')
                ->addViolation();
        }
    }
}