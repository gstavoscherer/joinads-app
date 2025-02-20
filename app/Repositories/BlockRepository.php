<?php

namespace App\Repositories;

use App\Models\Block;
use Illuminate\Database\Eloquent\Collection;

class BlockRepository implements BlockRepositoryInterface
{
    public function getAll(): Collection
    {
        return Block::all();
    }

    public function findById(int $id): ?Block
    {
        return Block::find($id);
    }

    public function create(array $data): Block
    {
        return Block::create($data);
    }

    public function update(int $id, array $data): ?Block
    {
        $block = $this->findById($id);
        if ($block) {
            $block->update($data);
            return $block;
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $block = $this->findById($id);
        if ($block) {
            return $block->delete();
        }
        return false;
    }
}
