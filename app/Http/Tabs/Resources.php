<?php

declare(strict_types=1);


namespace App\Http\Tabs;

use Illuminate\Support\Str;

class Resources extends BaseTab implements TabInterface
{
    public const PREFIX = "CMP_";

    public function outputFilename(): string
    {
        return sprintf("02 - Resources %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'resources';
    }

    public function populateData(): array
    {
        foreach (range($this->start, $this->end) as $i) {
            $this->results[] = [
                "account_type" => "Vendor",
                "external_id" => sprintf("%s%s", self::PREFIX, $i),
                "name" => sprintf("Company %s %s", $i, Str::random(20)),
                "address_line1" => sprintf("Address %s %s", $i, Str::random(20)),
                "address_line2" => "",
                "city" => sprintf("City %s", $i),
                "state" => "AZ",
                "zip" => (string)rand(10000, 99999),
                "country" => "AL",
                "phone" => "123",
                "email" => "",
                "website" => ""
            ];
        }

        return $this->results;
    }


}
