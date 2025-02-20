<?php

namespace App\Traits;

trait StringHelper
{
    public function toTitleCase(string $value): string
    {
        return ucwords(strtolower($value));
    }
}
