<?php

namespace App\Library;

/**
 * Base class to handle pagination, navigation and searching.
 */
class BaseFilter
{
    public function __construct(
        public ?string $name,
        public int $limit,
        public int $offset,
    ) {
        $this->limit = min($limit, 100);
    }
}
