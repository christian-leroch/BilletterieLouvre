<?php
// src/TicketingBundle/Validator/Constraints/No14HourPastDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class No14HourPastDate extends Constraint
{
    public $messageNo14HourPastDate = 'Vous ne pouvez plus réserver un billet " Journée " après 14 heures pour une visite le jour même.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}

