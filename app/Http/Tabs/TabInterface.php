<?php

namespace App\Http\Tabs;

interface TabInterface
{
    public function outputFilename(): string;
    public function outputModelName(): string;

    public function populateData(): array;

}
