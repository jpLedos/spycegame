<?php

class Statut 
{

    private int  $id;
    private string $statut;

    public function __construct( $statut=null) {

        if (func_get_args() != null) {
            $this->statut = $statut;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
 
    
    public function getStatut() : string 
    {
        return $this->statut;
    }

    public function setStatut(array $statut) : self
    {
        $this->statut = $statut;

        return $this;
    }
}