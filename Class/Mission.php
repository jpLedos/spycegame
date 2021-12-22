<?php

class Mission  
{  
    private ?INT $id =null;
    private ?string $title ;
    private string $descriptions;
    private string $code;
    private int $countryId;
    private int $typeId  ;
    private int $statutId;
    private int $specialityId;
    private $startDate;
    private $endDate;
 
    
    public function __construct($title=null, $descriptions=null, $code=null, $countryId=null, $typeId = null, 
                                $statutId=null, $specialityId =null, 
                                $startDate = null, $endDate= null) 
    {
        if (func_get_args() != null) {
            $this->title = $title;
            $this->descriptions = $descriptions;
            $this->code = $code;
            $this->countryId = $countryId;
            $this->typeId = $typeId;
            $this->statutId = $statutId;
            $this->specialityId = $specialityId;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return (string) $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getDescriptions(): string
    {
        return (string) $this->descriptions;
    }

    public function setDescription(string $descriptions): self
    {
        $this->descriptions = $descriptions;

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
        $this->countryId = $countryId;

        return $this;
    }

    public function getTypeId(): int
    {
        return (int) $this->typeId;
    }

    public function setTypeId(int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }


    public function getStatutId(): int
    {
        return (int) $this->statutId;
    }

    public function setStatutId(int $statutId): self
    {
        $this->statutId = $statutId;

        return $this;
    }



    public function getSpecialityId() :string
    {
    
        return $this->specialityId;
    }

    public function setSpecialityId( $specialityId): self
    {
        $this->specialityId = $specialityId;

        return $this;
    }

    public function getStartDate() :string
    {
    
        return $this->startDate;
    }

    public function setStartDate( $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

        public function getEndDate() :string
    {
    
        return $this->endDate;
    }

    public function setEndDate( $endDate): self
    {
        $this->startDate = $endDate;

        return $this;
    }


}