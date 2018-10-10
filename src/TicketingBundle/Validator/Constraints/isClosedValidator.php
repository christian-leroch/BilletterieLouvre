<?php
// src/TicketingBundle/Validator/Constraints/isClosedValidator.php

namespace TicketingBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class isClosedValidator extends ConstraintValidator
{
    /**
     * Algorythme returning the list of the French holidays of precise year "year""
     * @param $year
     * @return array
     * @throws \Exception
     */
    public function getFrenchHolidayDates($year)
    {
        $holiday = array(
            'NewYearsDay' => new \DateTime($year.'-01-01'),
            'EasterSunday' => $this->get_easter_datetime($year),
            'EasterMonday' => $this->get_easter_datetime($year)->modify('+1 day'),
            'AscensionThursday' => $this->get_easter_datetime($year)->modify('+39 day'),
            'PentecostSunday' => $this->get_easter_datetime($year)->modify('+49 day'),
            'PentecostMonday' => $this->get_easter_datetime($year)->modify('+50 day'),
            'LaborDay' => new \DateTime($year.'-05-01'),
            'Victory1945' => new \DateTime($year.'-05-08'),
            'NationalHoliday' => new \DateTime($year.'-07-14'),
            'Assumption' => new \DateTime($year.'-08-15'),
            'AllSaintsDay' => new \DateTime($year.'-11-01'),
            'Armistice' => new \DateTime($year.'-11-11'),
            'ChristmasDay' => new \DateTime($year.'-12-25'),
        );
        return $holiday;
    }

    /**
     * Return the date of Easter Sunday of a precise year
     * @param $year
     * @return \DateTime
     * @throws \Exception
     */
    public function get_easter_datetime($year)
    {
        $start = new \DateTime("$year-03-21");

        $days = easter_days($year);
        return $start->add(new \DateInterval("P{$days}D"));
    }

    /**
     * @param $booking
     * @param Constraint $constraint
     * @throws \Exception
     */
    public function validate($booking, Constraint $constraint)
    {
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $booking || '' === $booking)
        {
            return;
        }

        $ticketDate = $booking->getTicketDate();
        $ticketDayNb = $ticketDate->format('N');
        $ticketYear = $ticketDate->format('Y');
        $ticketDayAndMonth = $ticketDate->format('d F');
        $now = new \DateTime();
        $dayNow = $now->format('N');

        $holidayClosingDays = array(
            'LaborDay' => new \DateTime((int)$ticketYear . '-05-01'),
            'AllSaintsDay' => new \DateTime((int)$ticketYear . '-11-01'),
            'Noel' => new \DateTime((int)$ticketYear . '-12-25'),
        );

        if ($ticketDayNb === '7' && $ticketDate === $dayNow)
        {
            $this->context->buildViolation($constraint->messageNoSunday)
                ->atPath('ticketDate')
                ->addViolation();
        }

        if ($ticketDayNb == '2')
        {
            $this->context->buildViolation($constraint->messageNoTuesday)
                ->atPath('ticketDate')
                ->addViolation();
        }

        if (in_array($ticketDate,$holidayClosingDays))
        {
            $this->context->buildViolation($constraint->messageNotHolidayClosingDay)
                ->setParameter("{{ booking.ticketDayAndMonth|localizeddate('long', 'none', fr, null, 'd MMMM') }}", $ticketDayAndMonth)
                ->atPath('ticketDate')
                ->addViolation();
        }

        if(in_array($ticketDate,$this->getFrenchHolidayDates($ticketYear)))
        {
            $this->context->buildViolation($constraint->messageNoHoliday)
                ->atPath('ticketDate')
                ->addViolation();
        }
    }
}