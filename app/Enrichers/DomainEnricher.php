<?php

namespace App\Enrichers;

use App\Models\Domain;

class DomainEnricher
{
    public function enrich(Domain $domain): array
    {
        $data = $domain->toArray();

        $data['formatted_created_at'] = $domain->created_at 
            ? $domain->created_at->format('d/m/Y H:i:s') 
            : null;

        $data['block_count'] = $domain->relationLoaded('blocks')
            ? $domain->blocks->count()
            : $domain->blocks()->count();

        return $data;
    }
}
