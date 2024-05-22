<?php

namespace Bulletproof\Crud\services\impl;

use Bulletproof\Crud\app\models\Voucher;
use Bulletproof\Crud\services\VoucherService;
use repositories\VoucherRepository;

require_once __DIR__ . '/../VoucherService.php';
require_once __DIR__ . '/../../repositories/VoucherRepository.php';
require_once __DIR__ . '/../../models/Voucher.php';

class VoucherServiceImpl implements VoucherService
{
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    function create(string $name, string $disc, string $code, string $start, string $end, int $productId): void
    {
        // TODO: Implement create() method.
        $data = new Voucher();
        $data->setName($name);
        $data->setDisc($disc);
        $data->setCode($code);
        $data->setStart($start);
        $data->setEnd($end);
        $data->setProductId($productId);
        $this->voucherRepository->create($data);
    }

    function update(int $id, string $name, string $disc , string $code , string $start, string $end, int $productId): void
    {
        // TODO: Implement update() method.
        $data = new Voucher();
        $data->setName($name);
        $data->setDisc($disc);
        $data->setCode($code);
        $data->setStart($start);
        $data->setEnd($end);
        $data->setProductId($productId);
        $this->voucherRepository->update($id , $data);
    }

    function delete(int $id): void
    {
        // TODO: Implement delete() method.
        $this->voucherRepository->delete($id);
    }

    function show(int $id): array
    {
        // TODO: Implement show() method.
        return $this->voucherRepository->show($id);
    }

    function all(): array
    {
        // TODO: Implement all() method.
        return $this->voucherRepository->all();
    }
}