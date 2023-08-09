<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RedisKey extends Data
{
    public function __construct(
        public readonly string $key,
        public readonly string $type,
        public bool $isDataImporter,
        public bool $isCompleted,
        public ?Collection $content,
        public float $secondsToComplete = 0.0,
        public ?string $className = null,
    ) {
    }

    public static function fromKey(string $key): self
    {
        return new self(
            key: $key,
            type: Redis::type($key)->getPayload() ?? 'string',
            isDataImporter: false,
            isCompleted: false,
            content: collect(),
            secondsToComplete: 0,
            className: null,
        );
    }

    public function is(string $type): bool
    {
        return $this->type === $type;
    }
}
