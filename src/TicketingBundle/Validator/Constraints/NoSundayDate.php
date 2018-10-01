<?php
// src/TicketingBundle/Validator/Constraints/NoSundayDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoSundayDate extends Constraint
{
    public $messageNoSundayDate = 'La billetterie en ligne est fermée le dimanche. Réservation possible uniquement au guichet du musée.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}