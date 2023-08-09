<?php

declare(strict_types=1);

namespace App\Pipes;

use App\Data\RedisKey;
use Closure;
use Illuminate\Support\Facades\Redis;

class ConverHashToCollection
{
    public function handle(RedisKey $content, Closure $next)
    {
        if (!$content->is('hash')) {
            return $next($content);
        }

        $content->content = collect(Redis::hgetall($content->key));
        return $next($content);
    }
}
