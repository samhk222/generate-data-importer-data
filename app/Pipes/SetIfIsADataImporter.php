<?php

declare(strict_types=1);

namespace App\Pipes;

use App\Data\RedisKey;
use Closure;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class SetIfIsADataImporter
{
    public function handle(RedisKey $content, Closure $next)
    {
        if (Str::contains(Arr::get($content->content, 'name'), 'DataImporter')) {
            $content->isDataImporter = true;
        }

        return $next($content);
    }
}
