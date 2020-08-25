<?php

namespace CarRentalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="CarRentalBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

    /**
     * @var int
     *
     * @ORM\Column(name="carid", type="integer")
     */
    private $carid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pickUpDate", type="datetime")
     */
    private $pickUpDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="returnDate", type="datetime")
     */
    private $returnDate;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userid.
     *
     * @param int $userid
     *
     * @return Orders
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set carid.
     *
     * @param int $carid
     *
     * @return Orders
     */
    public function setCarid($carid)
    {
        $this->carid = $carid;

        return $this;
    }

    /**
     * Get carid.
     *
     * @return int
     */
    public function getCarid()
    {
        return $this->carid;
    }

    /**
     * Set pickUpDate.
     *
     * @param \DateTime $pickUpDate
     *
     * @return Orders
     */
    public function setPickUpDate($pickUpDate)
    {
        $this->pickUpDate = $pickUpDate;

        return $this;
    }

    /**
     * Get pickUpDate.
     *
     * @return \DateTime
     */
    public function getPickUpDate()
    {
        return $this->pickUpDate;
    }

    /**
     * Set returnDate.
     *
     * @param \DateTime $returnDate
     *
     * @return Orders
     */
    public function setReturnDate($returnDate)
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    /**
     * Get returnDate.
     *
     * @return \DateTime
     */
    public function getReturnDate()
    {
        return $this->returnDate;
    }
}
