<?php

namespace App\Repositories;

use App\DTOs\DomainDTO;
use App\Models\Domain;
use Illuminate\Database\Eloquent\Collection;

class DomainRepository implements DomainRepositoryInterface
{
    public function getAll(): Collection
    {
        return Domain::with('blocks')->get();
    }

    public function findById(int $id): ?Domain
    {
        return Domain::with('blocks')->find($id);
    }

    public function create(DomainDTO $domainDTO): Domain
    {
        return Domain::create([
            'name' => $domainDTO->name
        ]);
    }

    public function update(int $id, DomainDTO $domainDTO): ?Domain
    {
        $domain = $this->findById($id);
        if ($domain) {
            $domain->update([
                'name' => $domainDTO->name
            ]);
            return $domain;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $domain = $this->findById($id);
        if ($domain) {
            return $domain->delete();
        }
        return false;
    }
}
