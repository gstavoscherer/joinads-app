<?php

    namespace App\DTOs;
    use Illuminate\Http\Request;

    class BlockDTO{
        public string $name;
        public int $domain_id;
        public function __construct(
            string $name,
            int $domain_id
        )
        {
            $this->name = $name;
            $this->domain_id = $domain_id;
        }

        public static function fromRequest(Request $request): self
        {
            return new self(
                $request->input('name'),
                $request->input('domain_id')
            );
        }
    }