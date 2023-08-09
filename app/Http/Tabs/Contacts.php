<?php

declare(strict_types=1);


namespace App\Http\Tabs;

class Contacts extends BaseTab implements TabInterface
{
    public const PREFIX = "CONTACT_";

    public function outputFilename(): string
    {
        return sprintf("02 - Contacts %s-%s.csv", $this->start, $this->end);
    }

    public function outputModelName(): string
    {
        return 'contacts';
    }

    public function populateData(): array
    {
        foreach (range($this->start, $this->end) as $i) {
            $this->results[] = [
                "external_id" => sprintf("%s%s", self::PREFIX, $i),
                "title" => "TITLE",
                "first_name" => "First Name",
                "last_name" => "Last Name",
                "job_title" => "Job Title",
                "company_external_id" => sprintf("%s%s", Resources::PREFIX, $i),
                "office" => "",
                "office_phone" => "",
                "office_phone_code" => "",
                "office_phone_ext" => "",
                "cell_phone" => "",
                "cell_phone_code" => "",
                "fax" => "",
                "website" => "",
                "email" => self::createEmail($i)
            ];
        }

        return $this->results;
    }

    public static function createEmail(int $i): string
    {
        return sprintf("contact_email+%s@ingenious.build", $i);
    }
}
