<?php

namespace App\Services;

use App\Models\Block;
use App\DTOs\BlockDTO;
use App\Repositories\BlockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BlockService
{
    protected BlockRepositoryInterface $blockRepository;

    public function __construct(BlockRepositoryInterface $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    public function getAllBlocks(): Collection
    {
        return $this->blockRepository->getAll();
    }

    public function getBlockById(int $id): ?Block
    {
        return $this->blockRepository->findById($id);
    }

    public function createBlock(BlockDTO $blockDTO): Block
    {
        $data = [
            'name' => $blockDTO->name,
            'domain_id' => $blockDTO->domain_id
        ];

        return $this->blockRepository->create($data);
    }

    public function updateBlock(int $id, BlockDTO $blockDTO): ?Block
    {
        $data = [
            'name' => $blockDTO->name,
            'domain_id' => $blockDTO->domain_id
        ];

        return $this->blockRepository->update($id, $data);
    }

    public function deleteBlock(int $id): bool
    {
        return $this->blockRepository->delete($id);
    }
}
