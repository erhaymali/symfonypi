<?php
// src/Validator/ReclamationValidator.php

namespace App\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ReclamationValidator
{
    public function validateDateIsFromTodayOrLater($value, ExecutionContextInterface $context)
    {
        // Get the current date
        $currentDate = new \DateTime('today');

        // Check if the date is earlier than today
        if ($value < $currentDate) {
            $context->buildViolation('The date must be from today or later.')
                ->atPath('dateRec')
                ->addViolation();
        }
    }
}
