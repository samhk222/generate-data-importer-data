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

class ConvertClassName
{
    public function handle(RedisKey $content, Closure $next)
    {
        if ($content->isCompleted && $content->isDataImporter) {
            $pattern = '/(?=[A-Z])/';
            $replacement = '\\';
            $content->className = preg_replace($pattern, $replacement, $content->content['name']);
        }

        return $next($content);
    }
}
