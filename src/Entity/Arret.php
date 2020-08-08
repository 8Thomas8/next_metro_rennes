<?php

namespace App\Entity;

class Arret
{
    /**
     * @var string
     */
    private string $nomArret;

    /**
     * @var string
     */
    private string $arrivee;

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
     * @return string
     */
    public function getArrivee(): string
    {
        return $this->arrivee;
    }

    /**
     * @param string $arrivee
     * @return Arret
     */
    public function setArrivee(string $arrivee): Arret
    {
        $this->arrivee = $arrivee;
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