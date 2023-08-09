<?php

declare(strict_types=1);

namespace App\Pipes;

use App\Data\RedisKey;
use Closure;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class SetIfIsCompleted
{
    public function handle(RedisKey $content, Closure $next)
    {
        if ($content->content instanceof Collection && $content->content->get('status') === 'completed') {
            $content->isCompleted = true;
        }

        return $next($content);
    }
}
