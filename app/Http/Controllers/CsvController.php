<?php

namespace App\Http\Controllers;

use App\Http\Tabs\BudgetLineItems;
use App\Http\Tabs\Budgets;
use App\Http\Tabs\Contacts;
use App\Http\Tabs\Employees;
use App\Http\Tabs\ProjectMembers;
use App\Http\Tabs\Projects;
use App\Http\Tabs\Resources;

class CsvController extends Controller
{
    public function __invoke()
    {
        // batch 01 - 1 - 1000
        // batch 02 - 1000 - 2000
        // batch 03 - 3000 - 3100

        // dataimporterparallel
        // batch 01 - 3500 - 4500 - after refresh 16f56066-a32c-4791-aa62-e6e0edbdd42f
        // batch 02 - 4501 - 5500 - 1f76c01c-75c7-4c94-8ffb-bd9f6ada0a6c
        // batch 03 - 5501 - 6500 - 3544d9da-6ab6-4a9c-9d49-bc6d0698887e - aconteceu rollback
        // batch 04 - 6501 - 7500 - ebec042d-c0ca-4e37-80dc-0a24ff1477f6
        // batch 05 - 7501 - 8500 - dd62f33d-a3c0-424c-84c2-74271ee90389
        // batch 06 - 8501 - 9500 - c2aab7bd-0c30-4c17-87d7-47e043c4618f

        /*
         *
         * Com quantos registros rodei,
         * qual média em segundos de cada um, 5 jobs, total de registros
         * metodologia de contar os dados
         *  Job / jobs por segundo / etc

         How effective is running the tests in parallel
            -
         How many projects can run in parallel
            -
         Time estimation for 150,000 projects
            -
         Any potential issues or errors that we can predict
            -
         Any other potential solutions you found along the way?
            - Não existe o módulo de tasks
            - Rollback vai crescer demais
            - O tempo dos jobs cresce em sequencia
            - Por exemplo, 1 segundo

         *
         */


        // Criar tags

        // Por conta do refresh do ambiente, precisei deixar rodando de novo
        // batch 01 - 0001 - 1000 - 764eee07-2033-4760-b91d-f2b8d00e034c
        // batch 02 - 1001 - 2000 - 7c841144-a4ef-4fc1-ae24-98c9c0409a44
        // batch 03 - 2001 - 3000 - 1196a1bc-8435-40ce-98d4-398879747a5a
        // batch 04 - 3001 - 4000 - 4a25a86f-8c34-42d9-aa2c-fe93cd592dd2
        // batch 05 - 4001 - 5000 -

        $start = 3001;
        $end = 4000;
        $files_to_generate = [
            new Employees($start, $end),
            new Resources($start, $end),
            new Contacts($start, $end),
            new Projects($start, $end),
            new ProjectMembers($start, $end),
            new Budgets($start, $end, 3),
            new BudgetLineItems($start, $end, 3),
        ];

        foreach ($files_to_generate as $class) {
            $class->saveFile();
        }

        dd($files_to_generate);
    }
}
