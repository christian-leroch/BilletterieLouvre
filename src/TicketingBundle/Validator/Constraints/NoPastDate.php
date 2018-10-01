<?php
// src/TicketingBundle/Validator/Constraints/NoPastDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NoPastDate extends Constraint
{
    public $messageNoPastDate = 'Vous ne pouvez pas réserver un billet pour une date de visite antérieure à la date actuelle.';
}