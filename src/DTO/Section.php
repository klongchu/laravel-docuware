<?php

namespace Klongchu\DocuWare\DTO;

class Section
{
    public static function fromJson(array $data): self
    {
        return new static(
            doc_id: $data['Id'],
            page_count: $data['PageCount']
        );
    }

    public function __construct(
        public string $doc_id,
        public int $page_count
    ) {
    }

    public static function fake(
        string $doc_id = null,
        int $page_count = null,
    ): self {
        return new static(
            id: $doc_id ?? '',
            page_count: $page_count ?? 0,
        );
    }
}
