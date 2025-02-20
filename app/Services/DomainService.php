<?php

namespace App\Services;

use App\DTOs\DomainDTO;
use App\Repositories\DomainRepositoryInterface;
use App\Models\Domain;
use Illuminate\Database\Eloquent\Collection;

class DomainService
{
    protected DomainRepositoryInterface $domainRepository;

    public function __construct(DomainRepositoryInterface $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    public function getAllDomains(): Collection
    {
        return $this->domainRepository->getAll();
    }

    public function getDomainById(int $id): ?Domain
    {
        return $this->domainRepository->findById($id);
    }

    public function createDomain(DomainDTO $domainDTO): Domain
    {
        return $this->domainRepository->create($domainDTO);
    }

    public function updateDomain(int $id, DomainDTO $domainDTO): ?Domain
    {
        return $this->domainRepository->update($id, $domainDTO);
    }

    public function deleteDomain(int $id): bool
    {
        return $this->domainRepository->delete($id);
    }
}
