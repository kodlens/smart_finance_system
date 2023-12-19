<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\FinancialYear;


class DashboardController extends Controller
{
    //

    public function index(){

        $fy = FinancialYear::where('active', 1)
            ->first();


        $cfy = DB::select('
            SELECT 
            c.`allotment_class`, 
            SUM(b.`amount`) as amount
            FROM accountings a
            JOIN `accounting_allotment_classes` b ON a.`accounting_id`= b.`accounting_id`
            JOIN `allotment_classes` c ON b.`allotment_class_id` = c.`allotment_class_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY b.`allotment_class_id`', [$fy->financial_year_id]);        
        //return $cfy;

        $fundSources = DB::select('
            SELECT 
            a.`fund_source_id`,
            b.`fund_source`,
            SUM(a.`total_amount`) AS total_amount
            FROM accountings a
            JOIN `fund_sources` b ON a.`fund_source_id` = b.`fund_source_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY a.fund_source_id
            ', [$fy->financial_year_id]);



        $budgetingCurrentFY = DB::select('
            SELECT 
            c.`allotment_class`, 
            SUM(b.`amount`) as amount
            FROM budgetings a
            JOIN `budgeting_allotment_classes` b ON a.`budgeting_id`= b.`budgeting_id`
            JOIN `allotment_classes` c ON b.`allotment_class_id` = c.`allotment_class_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY b.`allotment_class_id`', [$fy->financial_year_id]);     
        
        $budgetingFundSources = DB::select('
            SELECT 
            a.`fund_source_id`,
            b.`fund_source`,
            SUM(a.`total_amount`) AS total_amount
            FROM budgetings a
            JOIN `fund_sources` b ON a.`fund_source_id` = b.`fund_source_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY a.fund_source_id
            ', [$fy->financial_year_id]);

        return view('administrator.dashboard')
            ->with('cfy', $cfy)
            ->with('fundSources', $fundSources)
            ->with('budgetingCurrentFY', $budgetingCurrentFY)
            ->with('budgetingFundSources', $budgetingFundSources);
    }
}
