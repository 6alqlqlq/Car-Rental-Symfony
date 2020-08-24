<?php

namespace CarRentalBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rent
 *
 * @ORM\Entity(repositoryClass="CarRentalBundle\Repository\RentRepository")
 * @ORM\Table(name="rents")
 *
 */
class Rent
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
     * @var DateTime
     *
     * @ORM\Column(name="start_at", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $startAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_at", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $endAt;



    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="CarRentalBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $user;

    /**
     * @var Car
     *
     * @ORM\ManyToOne(targetEntity="CarRentalBundle\Entity\Car")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $car;



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
     * Set startAt
     *
     * @param DateTime $startAt
     *
     * @return Rent
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set endAt
     *
     * @param DateTime $endAt
     *
     * @return Rent
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }


    /**
     * Set client
     *
     * @param User $user
     *
     * @return Rent
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get client
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set car
     *
     * @param Car $car
     *
     * @return Rent
     */
    public function setCar(Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }


}
