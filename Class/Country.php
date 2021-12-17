<?php


class Country
{
    private INT $id;
    private string $name;
    private string $code;

    public function getId():int  { 
        
        return $this->id; 
    
    }


    public function getName():string {

        return $this->name;
    }

    public function setName(string $setName): self
    {
        $this->firtname = $setName;

        return $this;
    }

    public function getCode():string {

        return $this->code;
    }

    public function setCode(string $setCode): self
    {
        $this->firtname = $setCode;

        return $this;
    }


    public function getFullName():string 
    {
        return $this->name. " ".$this->code;
    }

}