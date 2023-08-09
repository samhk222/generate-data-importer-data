<?php

declare(strict_types=1);

namespace App\Pipes;

use App\Data\RedisKey;
use Closure;
use Illuminate\Support\Facades\Redis;

class ConvertZsetToCollection
{
    public function handle(RedisKey $content, Closure $next)
    {
        if (!$content->is('zset')) {
            return $next($content);
        }

        return $next($content);
    }
}
