<?php
// src/TicketingBundle/Validator/Constraints/InvalidDate.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class InvalidDate extends Constraint
{
    public $messageInvalidDate = "Cette date n'est pas valide.";
}