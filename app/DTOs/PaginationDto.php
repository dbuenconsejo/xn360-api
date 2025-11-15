<?php

namespace App\DTOs;

class PaginationDto
{
    public function __construct(
        public array $data,
        public array $pagination,
    ) {}

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'pagination' => $this->pagination,
        ];
    }
}
