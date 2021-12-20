<?php

class User 
{

    private int  $id;
    private string $user;



    public function getId(): ?int
    {
        return $this->id;
    }
 

    public function getLogin() : string 
    {
        return $this->login;
    }

    public function setLogin(array $login) : self
    {
        $this->login = $login;

        return $this;
    }
}