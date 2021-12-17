<?php

class Type 
{

    private int  $id;
    private string $type;


    public function getId(): ?int
    {
        return $this->id;
    }
 

    public function geType() : string 
    {
        return $this->type;
    }

    public function setType(array $type) : self
    {
        $this->type = $type;

        return $this;
    }
}