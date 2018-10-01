<?php
// src/TicketingBundle/Validator/Constraints/NoHolidayClosingDaysDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoHolidayClosingDaysDate extends Constraint
{
    public $messageNoHolidayClosingDaysDate = '\'Le musée est fermé les 1er mai, 1er novembre et 25 décembre. Vous ne pouvez pas réserver un billet pour cette date.\'';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}