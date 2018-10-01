<?php
// src/TicketingBundle/Validator/Constraints/NoHolidayDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoHolidayDate extends Constraint
{
    public $messageNoHolidayDate = 'La billetterie en ligne est fermée les jours fériés. Réservation possible uniquement au guichet du musée.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}