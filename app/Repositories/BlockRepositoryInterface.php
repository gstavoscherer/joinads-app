<?php

namespace App\Repositories;

use App\Models\Block;
use Illuminate\Database\Eloquent\Collection;

interface BlockRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Block;
    public function create(array $data): Block;
    public function update(int $id, array $data): ?Block;
    public function delete(int $id): bool;
}
