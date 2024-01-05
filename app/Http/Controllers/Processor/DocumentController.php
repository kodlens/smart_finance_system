<?php

namespace App\Http\Controllers\Processor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accounting;
use App\Models\User;
use Auth;

class DocumentController extends Controller
{
    //
    public function index(){
        return view('processor.document.document-index');
    }



    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);
        $user = Auth::user();


        $data = Accounting::with(['fund_source', 'payee', 'acctg_documentary_attachments.documentary_attachment',
            'accounting_allotment_classes', 'processor'])
            ->where(function($q) use ($req){
                $q->where('particulars', 'like', $req->key . '%')
                ->orWhere('transaction_no', 'like', $req->key . '%')
                ->orWhere('training_control_no', 'like', $req->key . '%');
            })
            ->where('processor_id', $user->user_id)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;

    }

    public function documentMarkReceive($id){
        $data = Accounting::find($id);
        $data->processor_datetime_received = date('Y-m-d H:i');
        $data->save();

        return response()->json([
            'status' => 'received'
        ], 200);
    }

    public function documentMark($option, $id){
        if($option === 'bid_award_forward'){
            $this->bidAwardForward($id);
        }
        if($option === 'bid_award_retrieve'){
            $this->bidAwardRetrieve($id);
        }

        return response()->json([
            'status' => 'saved'
        ], 200);
    }




    public function documentBidAwardUpdate(Request $req, $id){

        $data = Accounting::find($id);
        $data->bids_award_status = $req->status;
        $data->save();

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
    public function documentBidAwardUpdateRemarks(Request $req, $id){

        $data = Accounting::find($id);
        $data->bids_award_remarks = $req->remarks;
        $data->save();

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    //addtional (separate) function to make codes better in view
    public function bidAwardForward($id){
        $data = Accounting::find($id);
        if(!$data->bids_award_datetime_forwarded){
            $data->bids_award_datetime_forwarded = date('Y-m-d H:i');
        }
        $data->save();
    }

    public function bidAwardRetrieve($id){
        $data = Accounting::find($id);
        if(!$data->bids_award_datetime_retrieved){
            $data->bids_award_datetime_retrieved = date('Y-m-d H:i');
        }
        $data->save();
    }













}
