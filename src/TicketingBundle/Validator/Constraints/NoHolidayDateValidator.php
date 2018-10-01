<?php
// src/TicketingBundle/Validator/Constraints/NoHolidayDateValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use TicketingBundle\Service\FrenchHolidayDatesManager;

class NoHolidayDateValidator extends ConstraintValidator
{
    protected $holidayManager;

    public function __construct(FrenchHolidayDatesManager $holidayManager){
        $this->holidayManager = $holidayManager;
    }

    public function validate($value, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $currentDate = new \DateTime();
        $currentYear = $currentDate->format('Y');
        if(in_array($value,$this->holidayManager->getFrenchHolidayDates($currentYear))){
            $this->context->buildViolation($constraint->messageNoHolidayDate)
                ->atPath('ticketDate')
                ->addViolation();
        }
    }
}