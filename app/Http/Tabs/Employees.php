<?php

declare(strict_types=1);


namespace App\Http\Tabs;

class Employees extends BaseTab implements TabInterface
{
    public const PREFIX = "EMP_";

    public function outputFilename(): string
    {
        return sprintf("01 - employees %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'employees';
    }

    public function populateData(): array
    {
        foreach (range($this->start, $this->end) as $i) {
            $this->results[] = [
                "external_id" => sprintf("%s%s", self::PREFIX, $i),
                "account_type" => "2",
                "billable_role" => "1",
                "first_name" => "Employee",
                "last_name" => sprintf("Number %s", $i),
                "city" => "City",
                "state" => "AK",
                "country" => "SS",
                "email" => self::createEmail($i)
            ];
        }

        return $this->results;
    }

    public static function createEmail(int $i): string
    {
        return sprintf("employee+%s@ingenious.build", $i);
    }
}
