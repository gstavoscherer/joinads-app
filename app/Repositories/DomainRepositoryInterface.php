<?php

namespace App\Repositories;

use App\Models\Domain;
use App\DTOs\DomainDTO;
use Illuminate\Database\Eloquent\Collection;

interface DomainRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Domain;
    public function create(DomainDTO $domainDTO): Domain;
    public function update(int $id, DomainDTO $domainDTO): ?Domain;
    public function delete(int $id): bool;
}
