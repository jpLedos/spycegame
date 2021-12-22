<?php

class Hideaway  
{  
    private INT $id;
    private string $code;
    private string $address;
    private int $countryId;
    private int $hideawayTypeId;

    
    public function __construct ($code=null, $address=null, $countryId=null, $hideawayTypeId=null) 
    {
        if (func_get_args() != null) {
            $this->code = $code;
            $this->address = $address;
            $this->countryId = $countryId;
            $this->hideawayTypeId = $hideawayTypeId;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
 
    public function getCode(): string
    {
        return (string) $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAddress(): string
    {
        return (string) $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->username = $address;

        return $this;
    }

    public function getCountryId(): int
    {
        return (int) $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getHideawayTypeId(): int
    {
        return (int) $this->hideawayTypeId;
    }

    public function setHideawayTypeId(int $hideawayTypeId): self
    {
        $this->isDead = $hideawayTypeId;

        return $this;
    }

    public function getFullName() :string
    {
        return $this->code." ".$this->address;
    }
    

}