<?php

class Statut 
{

    private int  $id;
    private string $statut;


    public function getId(): ?int
    {
        return $this->id;
    }
 
    
    public function geStatut() : string 
    {
        return $this->statut;
    }

    public function setStatut(array $statut) : self
    {
        $this->statut = $statut;

        return $this;
    }
}