<?php
// src/TicketingBundle/Validator/Constraints/NotAfterCertainHours.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotAfterCertainHours extends Constraint
{
    public $messageNotAfter14Hours = 'Vous ne pouvez plus réserver un billet " Journée " après {{ limitHour }} heures pour une visite le jour même.';

    public $messageNotOneHourBeforeClosingTime = 'Le musée ferme aujourd\'hui à {{ museumClosingTime }} heures et la billetterie en ligne à {{ ticketingClosingTime }} heures. Choisissez un autre jour de visite.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}