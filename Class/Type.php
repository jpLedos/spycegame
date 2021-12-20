<?php

class Type 
{
    private int  $id;
    private string $type;

    public function __construct( $type=null) {

        if (func_get_args() != null) {
            $this->type = $type;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType() : string 
    {
        return $this->type;
    }

    public function setType(array $type) : self
    {
        $this->type = $type;

        return $this;
    }
}