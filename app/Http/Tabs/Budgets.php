<?php

declare(strict_types=1);


namespace App\Http\Tabs;

use Illuminate\Support\Facades\Log;

class Budgets extends BaseTab implements TabInterface
{
    public const PREFIX = "BUDGET_";

    public function outputFilename(): string
    {
        return sprintf("02 - Budgets %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'budgets';
    }

    public function populateData(): array
    {
        $cont = 1;
        foreach (range($this->start, $this->end) as $i) {
            foreach (range(0, $this->perRecord) as $j) {
                $this->results[] = [
                    "external_id" => sprintf("%s%s", self::PREFIX, $this->start + $cont++),
                    "external_project_id" => sprintf("%s%s", Projects::PREFIX, $i),
                    "type" => "my_budget"
                ];
            }
        }
        return $this->results;
    }
}
