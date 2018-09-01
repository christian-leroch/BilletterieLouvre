<?php

namespace TicketingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisitorDetail
 *
 * @ORM\Table(name="detail")
 * @ORM\Entity(repositoryClass="TicketingBundle\Repository\DetailRepository")
 */
class VisitorDetail
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
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer")
     */
    private $orderID;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorName", type="string", length=255)
     */
    private $visitorName;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorFirstname", type="string", length=255)
     */
    private $visitorFirstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitorAge", type="date")
     */
    private $visitorAge;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorCountry", type="string", length=255)
     */
    private $visitorCountry;

    /**
     * @var bool
     *
     * @ORM\Column(name="visitorReduction", type="boolean")
     */
    private $visitorReduction;


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
     * Set orderID
     *
     * @param integer $orderID
     *
     * @return VisitorDetail
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;

        return $this;
    }

    /**
     * Get orderID
     *
     * @return int
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * Set visitorName
     *
     * @param string $visitorName
     *
     * @return VisitorDetail
     */
    public function setVisitorName($visitorName)
    {
        $this->visitorName = $visitorName;

        return $this;
    }

    /**
     * Get visitorName
     *
     * @return string
     */
    public function getVisitorName()
    {
        return $this->visitorName;
    }

    /**
     * Set visitorFirstname
     *
     * @param string $visitorFirstname
     *
     * @return VisitorDetail
     */
    public function setVisitorFirstname($visitorFirstname)
    {
        $this->visitorFirstname = $visitorFirstname;

        return $this;
    }

    /**
     * Get visitorFirstname
     *
     * @return string
     */
    public function getVisitorFirstname()
    {
        return $this->visitorFirstname;
    }

    /**
     * Set visitorAge
     *
     * @param \DateTime $visitorAge
     *
     * @return VisitorDetail
     */
    public function setVisitorAge($visitorAge)
    {
        $this->visitorAge = $visitorAge;

        return $this;
    }

    /**
     * Get visitorAge
     *
     * @return \DateTime
     */
    public function getVisitorAge()
    {
        return $this->visitorAge;
    }

    /**
     * Set visitorCountry
     *
     * @param string $visitorCountry
     *
     * @return VisitorDetail
     */
    public function setVisitorCountry($visitorCountry)
    {
        $this->visitorCountry = $visitorCountry;

        return $this;
    }

    /**
     * Get visitorCountry
     *
     * @return string
     */
    public function getVisitorCountry()
    {
        return $this->visitorCountry;
    }

    /**
     * Set visitorReduction
     *
     * @param boolean $visitorReduction
     *
     * @return VisitorDetail
     */
    public function setVisitorReduction($visitorReduction)
    {
        $this->visitorReduction = $visitorReduction;

        return $this;
    }

    /**
     * Get visitorReduction
     *
     * @return bool
     */
    public function getVisitorReduction()
    {
        return $this->visitorReduction;
    }
}

