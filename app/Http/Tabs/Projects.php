<?php

declare(strict_types=1);


namespace App\Http\Tabs;

class Projects extends BaseTab implements TabInterface
{
    public const PREFIX = "PROJ_";

    public function outputFilename(): string
    {
        return sprintf("02 - Projects %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'projects';
    }

    public function populateData(): array
    {
        foreach (range($this->start, $this->end) as $i) {
            $this->results[] = [
                "project_name" => sprintf("Project %s", $i),
                "external_id" => sprintf("%s%s", self::PREFIX, $i),
                "address1" => sprintf("Address %s", $i),
                "address2" => "",
                "city" => "City",
                "state" => "AK",
                "country" => "DZ",
                "zip_code" => "1234",
                "project_status" => "200",
                "value" => rand(100, 40000),
                "company_external_id" => sprintf("%s%s", Resources::PREFIX, $i),
                "contact_id_client" => Contacts::createEmail($i),
                "legal_entity_name" => sprintf("entity %s", $i),
                "phase" => "300",
                "currency" => "USD",
                "agreement_type" => "agency",
                "created_at" => "08/08/2023",
                "start_date" => "2023-08-08",
                "financial_id" => sprintf("FIN_%s", $i),
                "project_year" => date("Y")
            ];
        }

        return $this->results;
    }


}
