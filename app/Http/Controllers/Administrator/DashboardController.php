<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\FinancialYear;

use App\Models\Accounting;
use App\Models\Budgeting;
use App\Models\Procurement;
use App\Models\AccountingAllotmentClasses;

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


        $procurementCurrentFY = DB::select('
            SELECT 
            c.`allotment_class`, 
            SUM(b.`amount`) as amount
            FROM procurements a
            JOIN `procurement_allotment_classes` b ON a.`procurement_id`= b.`procurement_id`
            JOIN `allotment_classes` c ON b.`allotment_class_id` = c.`allotment_class_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY b.`allotment_class_id`', [$fy->financial_year_id]);     
        
        $procurementFundSources = DB::select('
            SELECT 
            a.`fund_source_id`,
            b.`fund_source`,
            SUM(a.`pr_amount`) AS total_amount
            FROM procurements a
            JOIN `fund_sources` b ON a.`fund_source_id` = b.`fund_source_id`
            WHERE a.`financial_year_id` = ?
            GROUP BY a.fund_source_id
            ', [$fy->financial_year_id]);

        return view('administrator.dashboard')
            ->with('cfy', $cfy)
            ->with('fundSources', $fundSources)
            ->with('budgetingCurrentFY', $budgetingCurrentFY)
            ->with('budgetingFundSources', $budgetingFundSources)
            ->with('procurementCurrentFY', $procurementCurrentFY)
            ->with('procurementFundSources', $procurementFundSources);
    }


    public function loadAccountingUtilizations(Request $req, $financialId){
    
        $data = Accounting::where('financial_year_id', $financialId)
            ->sum('total_amount');

        return $data;

    }

    public function loadBudgetingUtilizations(Request $req, $financialId){
    
        $data = Budgeting::where('financial_year_id', $financialId)
            ->sum('total_amount');

        return $data;

    }

    public function loadProcurementUtilizations(Request $req, $financialId){
    
        $data = Procurement::where('financial_year_id', $financialId)
            ->sum('pr_amount');

        return $data;

    }



    public function loadAllotmentAccounting($financialId, $allotmentId){

        $data = DB::select('
            SELECT
            b.transaction_no,
            e.financial_year_id,
            e.financial_year_code,
            e.financial_year_desc,
            e.financial_budget,
            e.balance,
            a.amount,
            a.allotment_class_id,
            c.allotment_class,
            a.allotment_class_account_id,
            d.allotment_class_account_code,
            d.allotment_class_account,
            c.allotment_class_budget
            FROM
            accounting_allotment_classes a
            JOIN accountings b ON a.accounting_id = b.accounting_id
            JOIN allotment_classes c ON a.allotment_class_id = c.allotment_class_id
            JOIN allotment_class_accounts d ON a.allotment_class_account_id = d.allotment_class_account_id
            JOIN financial_years e ON b.financial_year_id = e.financial_year_id
            WHERE e.financial_year_id = ? AND a.allotment_class_id = ?
            ', [$financialId, $allotmentId]);

        return $data;
    }
}
