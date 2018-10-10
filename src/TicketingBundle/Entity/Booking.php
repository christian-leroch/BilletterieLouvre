<?php

// src\TicketingBundle\Entity\Booking.php

namespace TicketingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use TicketingBundle\Validator\Constraints as TicketingAssert;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 *
 * @ORM\Entity(repositoryClass="TicketingBundle\Repository\BookingRepository")
 *
 * @TicketingAssert\NotAfterCertainHours
 * @TicketingAssert\IsClosed
 */
class Booking
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="ticketDate", type="date")
     *
     * @TicketingAssert\UnavailableDate
     */
    private $ticketDate;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="ticketType", type="string", length=255)
     */
    private $ticketType;

    /**
     * @var int
     *
     * @ORM\Column(name="nbTickets", type="integer")
     */
    private $nbTickets;

    /**
     * @var int
     *
     * @ORM\Column(name="totalPrice", type="integer", nullable=true)
     */
    private $totalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ticketDate
     *
     * @param \DateTime $ticketDate
     *
     * @return Booking
     */
    public function setTicketDate($ticketDate)
    {
        $this->ticketDate = $ticketDate;

        return $this;
    }

    /**
     * Get ticketDate
     *
     * @return \DateTime
     */
    public function getTicketDate()
    {
        return $this->ticketDate;
    }

    /**
     * Set ticketType
     *
     * @param string $ticketType
     *
     * @return Booking
     */
    public function setTicketType($ticketType)
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    /**
     * Get ticketType
     *
     * @return string
     */
    public function getTicketType()
    {
        return $this->ticketType;
    }

    /**
     * Set nbTickets
     *
     * @param integer $nbTickets
     *
     * @return Booking
     */
    public function setNbTickets($nbTickets)
    {
        $this->nbTickets = $nbTickets;

        return $this;
    }

    /**
     * Get nbTickets
     *
     * @return int
     */
    public function getNbTickets()
    {
        return $this->nbTickets;
    }

    /**
     * Set totalPrice
     *
     * @param integer $totalPrice
     *
     * @return Booking
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return int
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Booking
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Booking
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}

