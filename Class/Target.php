<?php

//require_once('Class/Person.php');

class Target
{
    private INT $id;
    private string $firstname;
    private string $lastname;
    private  $dateOfBirth;
    private string $code;
    private int $countryId;
    private bool $isDead;

    public function __construct ($firstname=null, $lastname=null, $dateOfBirth=null,$code=null,$countryId=null,$isDead=null) 
    {
        if (func_get_args() != null) {
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->dateOfBirth = $dateOfBirth;
            $this->code = $code;
            $this->countryId = $countryId;
            $this->isDead = $isDead;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }
 
    public function getFirstname(): string
    {
        return (string) $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firtname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return (string) $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->username = $lastname;

        return $this;
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

    public function getCountryId(): int
    {
        return (int) $this->countryId;
    }

    public function setCountryId(int $countryId): self
    {
        $this->countryIId = $countryId;

        return $this;
    }


    public function getIsDead(): int
    {
        return (int) $this->isDead;
    }

    public function setIsDead(int $isDead): self
    {
        $this->isDead = $isDead;

        return $this;
    }

    public function getDateOfBirth() :string
    {
    
        return $this->dateOfBirth;
    }

    public function setdateOfBirth( $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getFullName() :string
    {
    
        return $this->firstname." ".$this->lastname." --> Code : ".$this->code;
    }
    
}