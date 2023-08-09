<?php

declare(strict_types=1);


namespace App\Http\Tabs;

use Illuminate\Support\Facades\File;

class BaseTab
{
    public array $results = [];

    public function __construct(
        public readonly int $start = 1,
        public readonly int $end = 1000,
        public readonly int $perRecord = 100, // Quando for por record, vou colocar para cada um esse valor de registros
    ) {
    }

    public function generate()
    {
        $data = ['records' => $this->populateData()];
        return json_encode($data);
    }

    public function saveFile()
    {
        $records = $this->generate();
        File::put(storage_path("app/csvs/") . $this->outputFilename(), $records);
        File::put(storage_path("app/models/") . $this->outputModelName(), $records);
    }
}
