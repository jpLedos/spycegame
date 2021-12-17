<?php

class Target extends Person
{

    private array $specialities = array();

    public function getSpecialities() :array 
    {
        return $this->specialities;
    }

    public function setSpecialities(array $specialities) : self
    {
        $this->specialities = $specialities;

        return $this;
    }
}