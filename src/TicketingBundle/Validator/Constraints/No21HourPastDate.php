<?php
// src/TicketingBundle/Validator/Constraints/No21HourPastDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class No21HourPastDate extends Constraint
{
    public $messageNo21HourPastDate = 'Le musée ferme aujourd\'hui à 22h00 et la billetterie à 21h00. Choisissez un autre jour de visite';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}