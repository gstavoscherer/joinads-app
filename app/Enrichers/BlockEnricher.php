<?php

namespace App\Enrichers;

use App\Models\Block;

class BlockEnricher
{
    public function enrich(Block $block): array
    {
        $data = $block->toArray();

        $data['formatted_created_at'] = $block->created_at 
            ? $block->created_at->format('d/m/Y H:i:s') 
            : null;
        return $data;
    }
}
