<?php

namespace Bulletproof\Crud\app\models;

class Address
{

    private int $id;
    private string $name;
    private string $contact;
    private string $address;
    private string $location;
    private string $code_pos;
    private string $maps;
    private string $userId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function setContact(string $contact): void
    {
        $this->contact = $contact;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getCodePos(): string
    {
        return $this->code_pos;
    }

    public function setCodePos(string $code_pos): void
    {
        $this->code_pos = $code_pos;
    }

    public function getMaps(): string
    {
        return $this->maps;
    }

    public function setMaps(string $maps): void
    {
        $this->maps = $maps;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }




}