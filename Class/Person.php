<?php


abstract class Person
{
    private INT $id;
    private string $firtname;
    private string $lastname;
    private  $dateofbirth;
    private string $code;
    private int $countryId;
    private bool $isDead;


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

    public function setisDead(int $isDead): self
    {
        $this->isDead = $isDead;

        return $this;
    }
 
}