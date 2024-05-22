<?php

namespace Bulletproof\Crud\app\service\impl;

use Bulletproof\Crud\app\models\User;
use Bulletproof\Crud\app\service\UserService;
use repositories\UserRepository;

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../UserService.php';
require_once __DIR__ . '/../../repositories/UserRepository.php';


class UserServiceImpl implements UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    function register(string $email, string $name, string $password, string $contact , string $address): void
    {
        // TODO: Implement register() method.
        $data = new User();
        $data->setEmail($email);
        $data->setName($name);
        $data->setPassword($password);
        $data->setContact($contact);
        $data->setAddress($address);
        $this->userRepository->register($data);
    }

    function login(string $email, string $password): void
    {
        // TODO: Implement login() method.
        $data = new User();
        $data->setEmail($email);
        $data->setPassword($password);
        $this->userRepository->login($data);
    }

    function logout(): void
    {
        // TODO: Implement logout() method.
        $this->userRepository->logout();
    }

    function show(): array
    {
        // TODO: Implement show() method.
        return $this->userRepository->show();
    }

    function update(string $name, string $contact, string $address): void
    {
        // TODO: Implement update() method.
        $data = new User();
        $data->setName($name);
        $data->setContact($contact);
        $data->setAddress($address);
        $this->userRepository->update($data);
    }

    function topUp(int $balance): void
    {
        // TODO: Implement topUp() method.
        $data = new User();
        $data->setBalance($balance);
        $this->userRepository->topUp($data);
    }
}