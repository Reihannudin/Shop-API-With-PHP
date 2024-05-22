<?php

namespace Bulletproof\Crud\services\impl;

require_once __DIR__ . '/../AddressService.php';
require_once __DIR__ . '/../../repositories/AddressRepository.php';
require_once __DIR__ . '/../../models/Address.php';

use Bulletproof\Crud\app\models\Address;
use Bulletproof\Crud\app\repository\AddressRepository;
use Bulletproof\Crud\services\AddressService;

class AddressServiceImpl implements AddressService
{
    private $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    function create(string $name, string $contact, string $address, string $location, string $codePos, string $maps): void
    {
        // TODO: Implement create() method.
        $data = new Address();
        $data->setName($name);
        $data->setContact($contact);
        $data->setAddress($address);
        $data->setLocation($location);
        $data->setCodePos($codePos);
        $data->setMaps($maps);
        $this->addressRepository->create($data);
    }

    function update(int $id, string $name, string $contact, string $address, string $location, string $codePos, string $maps): void
    {
        // TODO: Implement update() method.
        $data = new Address();
        $data->setName($name);
        $data->setContact($contact);
        $data->setAddress($address);
        $data->setLocation($location);
        $data->setCodePos($codePos);
        $data->setMaps($maps);
        $this->addressRepository->update($id , $data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->addressRepository->delete($id);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->addressRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->addressRepository->all();
    }
}