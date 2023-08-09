<?php

declare(strict_types=1);


namespace App\Http\Tabs;

class ProjectMembers extends BaseTab implements TabInterface
{
    public const PREFIX = "PROJ_";

    public function outputFilename(): string
    {
        return sprintf("02 - Project Members %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'project-members';
    }

    public function populateData(): array
    {
        foreach (range($this->start, $this->end) as $i) {
            $this->results[] = [
                "external_project_id" => "",
                "employee_external_id" => sprintf("%s%s", Employees::PREFIX, $i),
                "first_name" => sprintf("Name %s", $i),
                "last_name" => "Last Name",
                "email" => Employees::createEmail($i),
                "role_name" => "p_u_id_pm"
            ];
        }

        return $this->results;
    }


}
