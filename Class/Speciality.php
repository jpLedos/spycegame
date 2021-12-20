<?php

class Speciality {

    private int $id;
    private string $speciality;

    public function __construct( $speciality=null) {

        if (func_get_args() != null) {
            $this->speciality = $speciality;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
 
    public function getSpeciality(): string
    {
        return (string) $this->speciality;
    }

    public function setSpecility(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }
}

