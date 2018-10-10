<?php
// src/TicketingBundle/Validator/Constraints/UnavailableDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UnavailableDate extends Constraint
{
    public $messageInvalidDate = "Cette date n'est pas valide.";

    public $messageNoPastDate = 'Vous ne pouvez pas réserver un billet pour une date de visite antérieure à la date actuelle.';

    public $messageNo2YearsLaterDate ='Il est impossible de réserver un billet pour une date de visite supérieure à deux ans par rapport à la date actuelle.';
}