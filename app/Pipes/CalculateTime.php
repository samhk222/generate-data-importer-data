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

class CalculateTime
{
    public function handle(RedisKey $content, Closure $next)
    {
        if ($content->isCompleted && $content->isDataImporter) {
            $content->secondsToComplete = round($content->content['completed_at'] - $content->content['updated_at'], 2);
        }

        return $next($content);
    }
}
