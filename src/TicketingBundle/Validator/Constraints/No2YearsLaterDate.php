<?php
// src/TicketingBundle/Validator/Constraints/No2YearsLaterDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class No2YearsLaterDate extends Constraint
{
    public $message2YearsLaterDate ='Il est impossible de réserver un billet pour une date de visite supérieure à deux ans par rapport à la date actuelle.';
}