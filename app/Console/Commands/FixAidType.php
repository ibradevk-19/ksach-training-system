<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BeneficiaryAidHistory;

class FixAidType extends Command
{
    protected $signature = 'aid:fix-type';
    protected $description = 'Convert aid_type_id from 11 to 1';

    public function handle()
    {
        $count = BeneficiaryAidHistory::where('aid_type_id', 11)->count();

        BeneficiaryAidHistory::where('aid_type_id', 11)
            ->update(['aid_type_id' => 1]);

        $this->info("Updated {$count} records successfully.");
    }
}
