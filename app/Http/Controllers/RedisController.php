<?php

namespace App\Http\Controllers;

use App\Data\RedisKey;
use App\Pipes\CalculateTime;
use App\Pipes\ConvertClassName;
use App\Pipes\SetIfIsADataImporter;
use App\Pipes\ConverHashToCollection;
use App\Pipes\ConvertZsetToCollection;
use App\Pipes\SetIfIsCompleted;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function __invoke()
    {
        $pipes = [
            ConverHashToCollection::class,
            ConvertZsetToCollection::class,
            SetIfIsADataImporter::class,
            SetIfIsCompleted::class,
            CalculateTime::class,
            ConvertClassName::class,
        ];

        $items = collect(Redis::command('KEYS', ['horizon_api_staging:*']))
            ->map(function ($key) use ($pipes) {
                return app(Pipeline::class)
                    ->send(RedisKey::fromKey($key))
                    ->through($pipes)
                    ->thenReturn();
            })
            ->filter(fn(RedisKey $item) => $item->isCompleted)
            ->filter(fn(RedisKey $item) => $item->isDataImporter);


        dd($items);
    }
}
