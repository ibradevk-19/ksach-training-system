<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Beneficiary,
    DistributionList,
    DistributionListItem,
    ImportBatch
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    

    public function index(Request $request)
    {
        return view('admin.dashboard.erp');
    }

}
