<?php

declare(strict_types=1);


namespace App\Http\Tabs;

use Illuminate\Support\Facades\Log;

class BudgetLineItems extends BaseTab implements TabInterface
{
    public const PREFIX = "BUDGET_LINE_ITEM_";

    public function outputFilename(): string
    {
        return sprintf("02 - Budget Line Items %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'budget-line-items';
    }

    public function populateData(): array
    {
        $cont = 1;
        foreach (range($this->start, $this->end) as $i) {
            foreach (range(0, $this->perRecord) as $j) {
                $this->results[] = [
                    "external_id" => sprintf("%s%s", self::PREFIX, $this->start + $cont++),
                    "company_external_id" => sprintf("%s%s", Resources::PREFIX, $i),
                    "budget_external_id" => sprintf("%s%s", Budgets::PREFIX, $i),
                    "description" => sprintf("Description %s %s", $i, $j),
                    "budget_approved" => rand(0, 100000),
                    "budget_current" => rand(0, 100000),
                    "budget_original" => rand(0, 100000),
                    "budget_pending" => rand(0, 100000),
                    "budget_projected" => rand(0, 100000),
                    "code_category" => "01_0160",
                    "allow_charges" => "true",
                    "allow_contracting" => "true",
                    "from_change_order" => "false",
                ];
            }
        }
        return $this->results;
    }
}
