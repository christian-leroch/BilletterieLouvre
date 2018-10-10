<?php
// src/TicketingBundle/Validator/Constraints/IsClosed.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsClosed extends Constraint
{
    public $messageNoTuesday = "Il est impossible de réserver un billet pour une visite le mardi. Fermeture hebdomadaire du musée.";

    public $messageNotHolidayClosingDay = "Le musée est fermé le {{ booking.ticketDayAndMonth|localizeddate('long', 'none', fr, null, 'd MMMM') }}. Vous ne pouvez pas réserver un billet pour cette date.";

    public $messageNoSunday = "La billetterie en ligne est fermée le dimanche. Réservation possible uniquement au guichet du musée.";

    public $messageNoHoliday = "La billetterie en ligne est fermée les jours fériés. Réservation possible uniquement au guichet du musée.";

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}