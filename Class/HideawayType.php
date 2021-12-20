<?php

class HideawayType 
{
    private int  $id;
    private string $name;

    public function __construct( $name=null) {

        if (func_get_args() != null) {
            $this->name = $name;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName() : string 
    {
        return $this->name;
    }

    public function setName(array $name) : self
    {
        $this->name = $name;

        return $this;
    }
}