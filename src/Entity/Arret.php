<?php

namespace App\Entity;

use DateTime;

class Arret
{
    /**
     * @var string
     */
    private string $nomArret;

    /**
     * @var DateTime
     */
    private DateTime $depart;

    /**
     * @var string
     */
    private string $destination;

    /**
     * @var string
     */
    private string $error;

    /**
     * @var int
     */
    private int $diff;

    /**
     * @return int
     */
    public function getDiff(): int
    {
        return $this->diff;
    }

    /**
     * @param int $diff
     * @return Arret
     */
    public function setDiff(int $diff): Arret
    {
        $this->diff = $diff;
        return $this;
    }

    /**
     * Arret constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return Arret
     */
    public function setError(string $error): Arret
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomArret(): string
    {
        return $this->nomArret;
    }

    /**
     * @param string $nomArret
     * @return Arret
     */
    public function setNomArret(string $nomArret): Arret
    {
        $this->nomArret = $nomArret;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDepart(): DateTime
    {
        return $this->depart;
    }

    /**
     * @param DateTime $depart
     * @return Arret
     */
    public function setDepart(DateTime $depart): Arret
    {
        $this->depart = $depart;
        return $this;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     * @return Arret
     */
    public function setDestination(string $destination): Arret
    {
        $this->destination = $destination;
        return $this;
    }

}