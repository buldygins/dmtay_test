<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckCompaniesLimit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check companies vacancy per day limit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $i = 0;
        $companies = Company::all();
        foreach ($companies as $company) {
            $company->vac_per_day = count($company->recentVacations);
            $company->save();
            $i++;
        }
        $this->info($i.' companies of '. count($companies).' was revised.' );
    }
}
