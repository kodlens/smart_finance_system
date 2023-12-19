<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\ProcurementAllotmentClass;
use App\Models\ProcurementDocumentaryAttachment;
use Illuminate\Http\Request;

use App\Models\Procurement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProcurementController extends Controller
{
    //



    public function index(){
        return view('administrator.procurement.procurement-index');
    }


    public function show($id){
        $data = Procurement::with([
            'payee',
            'procurement_documentary_attachments.documentary_attachment',
            'procurement_allotment_classes.allotment_class',
            'procurement_allotment_classes.allotment_class_account',
            'priority_program', 'office'
        ])
            ->find($id);

        return $data;
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Procurement::with([
            'fund_source',
            'payee',
            'procurement_documentary_attachments.documentary_attachment',
            'procurement_allotment_classes'])
            ->where('particulars', 'like', $req->key . '%')
            ->orWhere('training_control_no', 'like', $req->key . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function create(){
        return view('administrator.procurement.procurement-create-edit')
            ->with('id', 0);
    }


    public function edit($id){
        return view('administrator.procurement.procurement-create-edit')
            ->with('id', $id);
    }


    public function store(Request $req){

        $req->validate([
            'financial_year_id' => ['required'],
            'fund_source_id' => ['required'],
            'date_time' => ['required'],
            'training_control_no' => ['required'],
            'pr_no' => ['required'],
            'particulars' => ['required'],
            'pr_amount' => ['required'],
            'payee_id' => ['required'],
            'office_id' => ['required'],
        ],[
            'payee_id.required' => 'Please select bank account/payee.',
            'office_id.required' => 'Please select office.'
        ]);

        $data = Procurement::create([
            'financial_year_id' => $req->financial_year_id,
            'fund_source_id' => $req->fund_source_id,
            'date_time' => $req->date_time,
            'training_control_no' => $req->training_control_no,
            'pr_no' => strtoupper($req->pr_no),
            'particulars' => $req->particulars,
            'pr_amount' => $req->pr_amount,
            'payee_id' => $req->payee_id,
            'pr_status' => $req->pr_status,
            'others' => $req->others,
            'priority_program_id' => $req->priority_program_id,
            'office_id' => $req->office_id
        ]);

        if($req->has('documentary_attachments')){
            foreach ($req->documentary_attachments as $item) {
                $n = [];
                if($item['file_upload']){
                    $pathFile = $item['file_upload']->store('public/procurement_attachments'); //get path of the file
                    $n = explode('/', $pathFile); //split into array using /
                }

                //insert into database after upload 1 image
                ProcurementDocumentaryAttachment::create([
                    'procurement_id' => $data->procurement_id,
                    'documentary_attachment_id' => $item['documentary_attachment_id'],
                    'doc_attachment' => $n[2]
                ]);
            }
        }

        if($req->has('allotment_classes')){
            $allotmentClasses = [];
            foreach ($req->allotment_classes as $item) {
                $allotmentClasses[] = [
                    'procurement_id' => $data->procurement_id,
                    'allotment_class_id' => $item['allotment_class_id'],
                    'allotment_class_account_id' => $item['allotment_class_account_id'],
                    'amount' => $item['amount'],
                ];
            }
            ProcurementAllotmentClass::insert($allotmentClasses);
        }

       return response()->json([
           'status' => 'saved'
       ], 200);

    }


    public function updateProcurement(Request $req, $id){
        //return $req;

        $req->validate([
            'financial_year_id' => ['required'],
            'fund_source_id' => ['required'],
            'date_time' => ['required'],
            'training_control_no' => ['required'],
            'pr_no' => ['required'],
            'particulars' => ['required'],
            'pr_amount' => ['required'],
            'payee_id' => ['required'],
            'office_id' => ['required'],
        ],[
            'payee_id.required' => 'Please select bank account/payee.',
            'office_id.required' => 'Please select office.'
        ]);


        $data = Procurement::find($id);
        $data->financial_year_id = $req->financial_year_id;
        $data->fund_source_id =  $req->fund_source_id;
        $data->date_time =  $req->date_time;

        $data->training_control_no =  $req->training_control_no;

        $data->payee_id =  $req->payee_id;
        $data->particulars =  $req->particulars;
        $data->pr_no =  $req->pr_no;
        $data->pr_amount =  $req->pr_amount;
        $data->priority_program_id =  $req->priority_program_id ? $req->priority_program_id : null;
        $data->pr_status =  $req->pr_status;
        $data->others =  $req->others;
        $data->office_id =  $req->office_id;
        $data->save();

        if($req->has('documentary_attachments')){
            foreach ($req->documentary_attachments as $item) {

                $path = null;
                if($item['file_upload'] && is_file($item['file_upload'])){

                    $pathFile = $item['file_upload']->store('public/doc_attachments'); //get path of the file
                    $n = explode('/', $pathFile); //split into array using /
                    $path = $n[2];
                    ProcurementDocumentaryAttachment::create(
                        [
                            'procurement_id' => $data->procurement_id,
                            'documentary_attachment_id' => $item['documentary_attachment_id'],
                            'doc_attachment' => is_file($item['file_upload']) ? $path : $data->doc_attachment
                        ]);

                }
                //insert into database after upload 1 image

                if($req->has('allotment_classes')){
                    foreach ($req->allotment_classes as $item) {
                        ProcurementAllotmentClass::updateOrCreate([
                            'procurement_allotment_class_id' => $item['procurement_allotment_class_id']
                        ],[
                            'procurement_id' => $id,
                            'allotment_class_id' => $item['allotment_class_id'],
                            'allotment_class_account_id' => $item['allotment_class_account_id'],
                            'amount' => $item['amount'],
                        ]);
                    }
                }

            }
        }
       return response()->json([
           'status' => 'updated'
       ], 200);

    }




    //delete attachment and image from storage
    public function deleteProcurementDocAttachment($id){
        $data = ProcurementDocumentaryAttachment::find($id);
        // $attchments = ProcurementDocumentaryAttachment::where('accounting_id', $data->accounting_id)
        //         ->get();
        if(Storage::exists('public/procurement_attachments/' . $data->doc_attachment)) {
            Storage::delete('public/procurement_attachments/' . $data->doc_attachment);
        }
        ProcurementDocumentaryAttachment::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ],200);

    }




    //for excel
    public function fetchProcurements(){

        return DB::select('
        SELECT
            a.`procurement_id`,
            b.`financial_year_code`,
            b.`financial_year_desc`,
            c.`fund_source`,
            a.`training_control_no`,
            a.`pr_no`,
            a.`pr_status`,
            e.`bank_account_payee`,
            a.`pr_amount`,
            gg.allotment_class_id,
            hh.`allotment_class_account_code`,
            hh.`allotment_class_account`,
            g.`amount`,
            h.`priority_program_code`,
            h.`priority_program`,
            f.`office`

            FROM procurements a
            JOIN `financial_years` b ON a.`financial_year_id` = b.`financial_year_id`
            JOIN fund_sources c ON a.`fund_source_id` = c.`fund_source_id`
            JOIN payee AS e ON a.`payee_id` = e.`payee_id`
            JOIN offices f ON a.`office_id` = f.`office_id`
            LEFT JOIN procurement_allotment_classes g ON a.`procurement_id` = g.procurement_id
            LEFT JOIN `allotment_classes` gg ON g.`allotment_class_id` = gg.`allotment_class_id`
            LEFT JOIN allotment_class_accounts hh ON g.`allotment_class_account_id` = hh.`allotment_class_account_id`
            LEFT JOIN priority_programs h ON a.`priority_program_id` = h.`priority_program_id`
        ');
    }



}
