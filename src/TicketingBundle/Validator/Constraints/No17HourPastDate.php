<?php
// src/TicketingBundle/Validator/Constraints/No17HourPastDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class No17HourPastDate extends Constraint
{
    public $messageNo17HourPastDate = 'Le musée ferme aujourd\'hui à 18h00 et la billetterie à 17h00. Choisissez un autre jour de visite.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}