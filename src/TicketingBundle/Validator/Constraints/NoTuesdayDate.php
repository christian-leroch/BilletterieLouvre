<?php
// src/TicketingBundle/Validator/Constraints/NoTuesdayDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoTuesdayDate extends Constraint
{
    public $messageNoTuesdayDate = 'Il est impossible de réserver un billet pour une visite le mardi. Fermeture hebdomadaire du musée.';
}