<?php
// src\TicketingBundle\Service\FrenchHolidayDatesManager.php

namespace TicketingBundle\Service;

class FrenchHolidayDatesManager
{
    /**
     * Algorythme retournant la liste des jours fériés français d'une année pécise "year""
     * @param $year
     * @return array
     * @throws \Exception
     */
    public function getFrenchHolidayDates($year){
        $holiday = array(
            'JourAn' => new \DateTime($year.'-01-01'),
            'DimanchePaques' => $this->get_easter_datetime($year),
            'LundiPaque' => $this->get_easter_datetime($year)->modify('+1 day'),
            'JeudiAscension' => $this->get_easter_datetime($year)->modify('+39 day'),
            'DimanchePentecote' => $this->get_easter_datetime($year)->modify('+49 day'),
            'LundiPentecote' => $this->get_easter_datetime($year)->modify('+50 day'),
            'FeteTravail' => new \DateTime($year.'-05-01'),
            'Victoire1945' => new \DateTime($year.'-05-08'),
            'FeteNationale' => new \DateTime($year.'-07-14'),
            'Assomption' => new \DateTime($year.'-08-15'),
            'Toussaint' => new \DateTime($year.'-11-01'),
            'Armistice' => new \DateTime($year.'-11-11'),
            'Noel' => new \DateTime($year.'-12-25'),
        );
        return $holiday;

    }
    /**
     * Retourne la date du dimanche de Paques d'une année précise
     * @param $year
     * @return \DateTime
     * @throws \Exception
     */
    public function get_easter_datetime($year) {
        $start = new \DateTime("$year-03-21");

        $days = easter_days($year);
        return $start->add(new \DateInterval("P{$days}D"));
    }
}