<?php

    namespace App\DTOs;
    use Illuminate\Http\Request;

    class DomainDTO{
        

        public function __construct(
            string $name
        ){
            $this->name = $name;
        }

        public static function fromRequest(Request $request): self
        {
            return new self(
                $request->input('name')
            );
        }
    }