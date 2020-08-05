<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\DateTime;

class Arret
{
    /**
     * @var string
     */
    private string $nomArret;

    /**
     * @var DateTime
     */
    private DateTime $arrivee;

    /**
     * @var string
     */
    private string $destination;

    /**
     * @var string
     */
    private string $error;

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
    public function getArrivee(): DateTime
    {
        return $this->arrivee;
    }

    /**
     * @param DateTime $arrivee
     * @return Arret
     */
    public function setArrivee(DateTime $arrivee): Arret
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