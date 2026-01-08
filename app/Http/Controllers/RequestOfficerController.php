<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestTab;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\NotifyUser;
use Illuminate\Support\Facades\Crypt;
require_once(public_path('fpdf_v1.86/fpdf.php'));


class RequestOfficerController extends Controller
{
    // CHECK AUTH
    public function checkAuth(){

        if(!Auth::check()){
            return redirect('/logout');
        }
    }

    public function ajaxOfficerRefreshTable(Request $req){

       //$data = $this->statusRequestQuery($req , 2);
        $status = $req->getStatus;
        $accEmpID = session("account_empid");

        $agentUnitID = session('agentunit_id');

        $sql = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->join('repairtype_tab' , 'repairtype_tab.repairtype_id' , '=' , 'request_tab.repairtype_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('location_tab' , 'location_tab.location_id' , '=' , 'request_tab.location_id')
            ->join('bldgfloor_tab' , 'bldgfloor_tab.bldgfloor_id' , '=' , 'request_tab.bldgfloor_id')
            ->leftJoin('actiontaken_tab', 'actiontaken_tab.request_refid', '=', 'request_tab.request_refid')
            ->selectRaw("request_tab.request_refid as refNo , 
            repairtype_tab.repairtype_time as repairTime , 
            category_tab_2.main_category as mainCategory ,
            category_tab_2.category_id as categoryId ,
            request_tab.request_date as reqDate , 
            request_tab.request_duration as until ,
            category_tab_2.category_value as categoryVal , 
            request_tab.request_by as requestBy , 
            section_tab.section_abbre as sectionName , 
            request_tab.request_descript as reqDesc , 
            request_tab.name_of_equipment as eq1 , 
            request_tab.serialno as eq2 ,
            request_tab.modelno as eq3 ,
            request_tab.propertyno as eq4 ,
            request_tab.request_done as accomplishedDate ,
            request_tab.request_acknowledged as acknowledgementDate ,
            request_tab.request_cancelled as cancelledDate ,
            GROUP_CONCAT( CONCAT(actiontaken_tab.action_taken , ' : ' ,actiontaken_tab.action_datetime ) 
            ORDER BY actiontaken_tab.action_datetime DESC SEPARATOR '<br>') AS actionTaken,
            location_tab.location_value as locationVal ,
            bldgfloor_tab.bldgfloor_val as bldgFloorVal ,
            request_tab.request_condemn as condemn
            ")
            ->where('request_tab.status_id' , $status)
            ->where('request_tab.agentunit_id' , $agentUnitID)
            ->groupBy(
                'refNo',
                'repairTime' ,
                'mainCategory',
                'categoryId',
                'reqDate',
                'until',
                'categoryVal',
                'requestBy',
                'sectionName',
                'locationVal',
                'bldgFloorVal',
                'reqDesc',
                'eq1',
                'eq2',
                'eq3',
                'eq4',
                'accomplishedDate',
                'acknowledgementDate',
                'cancelledDate' ,
                'condemn'
            )
            ->orderBy('request_tab.request_date' , 'DESC');

            // IF STATUS IS OPEN THEN CHAIN THIS WHERE CLAUSE
            if($status != 2){
                $sql->where('request_tab.agentacc_id' , $accEmpID); 
            }

        $data = $sql->get();

        $data->each(function($row) {
        $row->encryptedRefID = Crypt::encrypt($row->refNo);
        });

       return json_encode($data);
    }

    //---------------------------------------------------------------------------------- OFFICER OPEN REQUEST
    public function officerOpen(Request $req){

        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }

        //$data = $this->statusRequestQuery(2 , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID); // 2 = OPEN
        $data = $this->statusRequestQuery($req , 2); // 2 = OPEN
        
        $data->appends($req->all());
        return view('officer.officer_open_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 2);
    }

    //---------------------------------------------------------------------------------- OFFICER IN PROGRESS REQUEST
    public function officerInProgress(Request $req){

        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }

        //$data = $this->statusRequestQuery(5 , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID); // 5 = IN PROGRESS
        $data = $this->statusRequestQuery($req , 5); // 5 = IN PROGRESS
        
        $data->appends($req->all());
        return view('officer.officer_inprogress_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 5);
    }

    //---------------------------------------------------------------------------------- OFFICER ACKNOWLEDGE REQUEST
    public function officerAcknowledge(Request $req){

        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }

        //$data = $this->statusRequestQuery(8 , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID); // 8 = ACKNOWLEDGE
        $data = $this->statusRequestQuery($req , 8); // 8 = ACKNOWLEDGE
        
        $data->appends($req->all());
        return view('officer.officer_acknowledge_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 8);
    }



    //---------------------------------------------------------------------------------- OFFICER CANCELLED REQUEST
    public function officerCancelled(Request $req){

        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }

        //$data = $this->statusRequestQuery(7 , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID); // 7 = CANCELLED
        $data = $this->statusRequestQuery($req , 7); // 7 = CANCELLED
        
        $data->appends($req->all());
        return view('officer.officer_cancelled_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 7);
    }


    //---------------------------------------------------------------------------------- OFFICER COMPLETED REQUEST
    public function officerCompleted(Request $req){

        //CHECK AUTHENTICATION
        //$this->checkAuth();

        /*
        $accEmpID = session("account_empid");
        $agentUnitID = session('agentunit_id');

      
        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;
        */
        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }


        //$data = $this->statusRequestQuery(6 , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID , $condemn); // 6 = COMPLETED
        $data = $this->statusRequestQuery($req , 6); // 6 = COMPLETED

        $data->appends($req->all());
        return view('officer.officer_completed_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 6);
    }

    //public function statusRequestQuery($getStatusID , $agentUnitID , $getRefNo , $getDateFrom , $getDateTo , $accEmpID , $condemn){
    public function statusRequestQuery(Request $req , $getStatusID){

        $accEmpID = session("account_empid");
        $agentUnitID = session('agentunit_id');
      
        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;

        $sql = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->join('repairtype_tab' , 'repairtype_tab.repairtype_id' , '=' , 'request_tab.repairtype_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('location_tab' , 'location_tab.location_id' , '=' , 'request_tab.location_id')
            ->join('bldgfloor_tab' , 'bldgfloor_tab.bldgfloor_id' , '=' , 'request_tab.bldgfloor_id')
            ->leftJoin('actiontaken_tab', 'actiontaken_tab.request_refid', '=', 'request_tab.request_refid')
            ->selectRaw("request_tab.request_refid as refNo ,
            repairtype_tab.repairtype_time as repairTime , 
            category_tab_2.category_id as categoryId ,
            request_tab.request_date as reqDate , 
            request_tab.request_duration as until ,
            category_tab_2.category_value as categoryVal , 
            request_tab.request_by as requestBy , 
            section_tab.section_abbre as sectionName , 
            request_tab.request_descript as reqDesc , 
            request_tab.name_of_equipment as eq1 , 
            request_tab.serialno as eq2 ,
            request_tab.modelno as eq3 ,
            request_tab.propertyno as eq4 ,
            request_tab.request_done as accomplishedDate ,
            request_tab.request_acknowledged as acknowledgementDate ,
            request_tab.request_cancelled as cancelledDate ,
            GROUP_CONCAT( CONCAT(actiontaken_tab.action_taken , ' : ' ,actiontaken_tab.action_datetime ) 
            ORDER BY actiontaken_tab.action_datetime DESC SEPARATOR '<br>') AS actionTaken,
            location_tab.location_value as locationVal ,
            bldgfloor_tab.bldgfloor_val as bldgFloorVal ,
            request_tab.request_condemn as condemn
            ")
            ->where('request_tab.status_id' , $getStatusID)
            ->where('request_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.request_refid' , 'LIKE' ,  '%'.$getRefNo.'%')
            ->groupBy(
                'refNo',
                'repairTime' ,
                'categoryId',
                'reqDate',
                'until',
                'categoryVal',
                'requestBy',
                'sectionName',
                'locationVal',
                'bldgFloorVal',
                'reqDesc',
                'eq1',
                'eq2',
                'eq3',
                'eq4',
                'accomplishedDate',
                'acknowledgementDate',
                'cancelledDate' ,
                'condemn'
            )
            ->orderBy('request_tab.request_date' , 'DESC');

            //IF CONDEMN IS SET
            if($req->has('checkCondemn')){

                $condemn = $req->input('checkCondemn'); 
                $sql->where('request_tab.request_condemn' , $condemn);
            }
            // IF STATUS IS OPEN THEN CHAIN THIS WHERE CLAUSE
            if($getStatusID != 2){
                $sql->where('request_tab.agentacc_id' , $accEmpID); 
            }

            // DATEFROM AND DATETO IS NOT NULL THEN CHAIN THIS WHERE CLAUSE
            if($getDateFrom != null || $getDateTo != null){

                $getDateTo = Carbon::parse($getDateTo)->addDays(1);
                $sql->whereBetween('request_tab.request_date' , [$getDateFrom ,$getDateTo]);
            }

            $data = $sql->paginate(10);

        return $data;

    }

    public function ajaxDistributeRequest(request $req){

        $getAgentUnitID = $req->input('agentID');

        $data = DB::table('accounts_tab')
        ->join('usertype_tab' , 'usertype_tab.usertype_id' , '=' , 'accounts_tab.usertype_id')
        ->selectRaw("
            accounts_tab.account_empid as empNo , 
            accounts_tab.account_fname as empFname , 
            accounts_tab.account_lname as empLname , 
            usertype_tab.usertype_name as userType
        ")
        ->where('accounts_tab.agentunit_id' , $getAgentUnitID)
        ->orderBy('empFname' , 'ASC')
        ->get();

        return json_encode($data);
    }

    public function doneRequest(Request $req){

        $refID = $req->refID;
        $staffID = $req->agentStaffID;
        $officerFullName = $req->officerFullName;
        $categoryVal = $req->categoryVal;
        $requestDone = now();

        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'agentacc_id' => $staffID ,
            'request_done' => $requestDone,
            'status_id' => 8 // ACKNOWLEDGE
        ]);

        $this->notifRequestStatusUpdate($officerFullName , $requestDone , $refID , $categoryVal , 8 , "Request Done");
        return back();
    }

    public function undoRequest(Request $req){

        $refID = $req->refID;
        $staffID = $req->agentStaffID;
        $officerFullName = $req->officerFullName;
        $categoryVal = $req->categoryVal;
        $dateUpdated = now();

        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'agentacc_id' => $staffID ,
            'request_done' => null,
            'request_condemn' => 0,
            'status_id' => 5 // IN-PROGRESS
        ]);

        $this->notifRequestStatusUpdate($officerFullName , $dateUpdated , $refID , $categoryVal , 5 , "Request Undo");
        return back();
    }

    public function reopenRequest(Request $req){

        $refID = $req->getRefID;
        $officerFullName = $req->officerFullName;
        $actionDateTime = now();
        $categoryVal = $req->categoryVal;
    
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'agentacc_id' => null ,
            'request_taken' => null,
            'request_progress' => null,
            'status_id' => 2 // OPEN
        ]);

        $actionTakenVal = "Action Officer: ".$officerFullName." - Reopened this request!";

        DB::table('actiontaken_tab')
        ->insert([
            'request_refid' => $refID ,
            'action_taken' => $actionTakenVal,
            'action_datetime' => $actionDateTime
        ]);
        
        $this->notifRequestStatusUpdate($officerFullName , $actionDateTime , $refID , $categoryVal , 2 , "Request Re-Open");

        return back();
    }

    public function officerCancelRequest(Request $req){

        $refID = $req->getRefID;
        $dateCancelled = now();
        $officerFullName = $req->officerFullName;
        $categoryVal = $req->categoryVal;
        
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'status_id' => 7 ,
            'request_cancelled' => $dateCancelled
        ]);

        $cancelReason = $req->cancelReason;

        DB::table('actiontaken_tab')
        ->insert([
            'request_refid' => $refID ,
            'action_taken' => $cancelReason ,
            'action_datetime' => $dateCancelled
        ]);

        $this->notifRequestStatusUpdate($officerFullName , $dateCancelled , $refID , $categoryVal , 7 , "Request Cancelled");
        return back();
    }

    public function addNewAction(Request $req){

        $refID = $req->getRefID;
        $actionTakenVal = $req->getAction;

        DB::table('actiontaken_tab')
        ->insert([
            'request_refid' => $refID ,
            'action_taken' => $actionTakenVal,
            'action_datetime' => now()
        ]);
        
        return back();
    }

    public function condemnRequest(Request $req){

        $refID = $req->getRefID;
        $nameOfEquipment = $req->getNameOfEq;
        $serialNo = $req->getSerialNo;
        $modelNo = $req->getModelNo;
        $propertyNo = $req->getPropertyNo;
        $requestFindings = $req->getFindings;
        $requestRecommendation = $req->getRecommendation;

        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'request_done' => now() ,
            'status_id' => 8 ,
            'request_condemn' => 1 ,
            'name_of_equipment' => $nameOfEquipment ,
            'serialno' => $serialNo ,
            'modelno' => $modelNo ,
            'propertyno' => $propertyNo ,
            'request_findings' => $requestFindings ,
            'request_recommendation' => $requestRecommendation 
        ]);


        ///////////////////////////////////////////////////////////// CONDEMN NOTIFICATION
        $officerFullname = Auth::user()->account_fname.' '.Auth::user()->account_lname;

        $updateRequestMsg = "REQUEST UPDATED! <br> 
        Status: CONDEMN <br>
        Action Officer: ".$officerFullname. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime(now())). "<br>
        Reference No. : <a href='/client_acknowledge_request'>".$refID. "</a>";


        $updateRequestMsgForOfficer = "REQUEST UPDATED! <br> 
        Status: Condemn<br>
        Condemned by: ".$officerFullname. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime(now())). "<br>
        Reference No. : ".$refID."<br>";

        $data = DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->select('account_id' , 'agentunit_id')
        ->first();
        $accountEmpId = $data->account_id;
        $agentUnitID = $data->agentunit_id;

        //NOTIFY CLIENT
        broadcast(new NotifyUser($accountEmpId , $updateRequestMsg))->toOthers();

        /*
        //NOTIFY ACTION OFFICER
        $data = DB::table('accounts_tab')
        ->where('agentunit_id' , $agentUnitID)
        ->get();

        foreach($data as $datas){
            broadcast(new NotifyUser($datas->account_empid , $updateRequestMsgForOfficer))->toOthers();
        }
        */

        return back();
    }

    public function loadAllCategory(){

        $agentUnit = session('agentunit_id');

        $sql = DB::table('category_tab_2')
        ->where('agentunit_id' , $agentUnit)
        ->orderBy('category_id' , 'ASC');

        if($agentUnit == 1){
            $sql->where('category_id' , '>=' , 43); // SHOW ONLY NEW EFMS
        }

        $data = $sql->get();
        return json_encode($data);
    }


    public function assignStaff(Request $req){
        
        $staffID = $req->getStaffID;
        $refID = $req->getRefID;
        $categoryVal = $req->getCategoryVal;
        $takenByFullName = $req->getTakenByName;
        $requestTaken = now();

        //dd($takenByFullName);
    
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'agentacc_id' => $staffID ,
            'request_taken' => $requestTaken,
            'request_progress' => $requestTaken,
            'status_id' => 5 // IN-PROGRESS
        ]);

        $this->notifRequestStatusUpdate($takenByFullName , $requestTaken , $refID , $categoryVal , 5 , "Request Taken");
        return back();
    }
    //////////////////////////////////////////////////////////////////// NOTIFICATION - REQUEST STATUS UPDATE
    public function notifRequestStatusUpdate($takenByFullName , $dateTaken , $refNo , $categoryVal , $status , $actionDone){

        $statusText;
        $statusLink;

        if($status == 5){
            $statusText = 'IN-PROGRESS';
            $statusLink = 'client_inprogress_request';
        }
        if($status == 2){
            $statusText = 'OPEN';
            $statusLink = 'client_open_request';
        }
        if($status == 8){
            $statusText = 'ACKNOWLEDGE';
            $statusLink = 'client_acknowledge_request';
        }
        if($status == 7){
            $statusText = 'CANCELLED';
            $statusLink = 'client_cancelled_request';
        }

        $updateRequestMsgForClient = "REQUEST UPDATED!<br> 
        Status: ".$statusText." (".$actionDone.")<br>
        Action Officer: ".$takenByFullName. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime($dateTaken)). "<br>
        Reference No. : <a href='/".$statusLink."'>".$refNo. "</a><br>
        Category: ".$categoryVal;

        $updateRequestMsgForOfficer = "REQUEST UPDATED!<br> 
        Status: ".$statusText." (".$actionDone.")<br>
        Action Officer: ".$takenByFullName. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime($dateTaken)). "<br>
        Reference No. : ".$refNo."<br>
        Category: ".$categoryVal;

        // GET CLIENT ID + AGENT UNIT ID
        $data = DB::table('request_tab')
        ->where('request_refid' , $refNo)
        ->select('account_id' , 'agentunit_id')
        ->first();
        $accountEmpId = $data->account_id;
        $agentUnitID = $data->agentunit_id;

        //NOTIFY CLIENT
        broadcast(new NotifyUser($accountEmpId , $updateRequestMsgForClient))->toOthers();

        // IF STATUS OPEN OR FROM OPEN TO INPROGRESS OR VICE VERSA NOTIF ALL ACTION OFFICER USING AGENT UNIT ID
        if($actionDone == "Request Taken" || $actionDone == "Request Re-Open"){

            //NOTIFY ACTION OFFICER
            $data = DB::table('accounts_tab')
            ->where('agentunit_id' , $agentUnitID)
            ->where('account_empid' , '!=' , Auth::user()->account_empid)
            ->get();

            /*
            foreach($data as $datas){
                broadcast(new NotifyUser($datas->account_empid , $updateRequestMsgForOfficer))->toOthers();
            }
            */

            // BETTER APPROARCH VS USING FOREACH LOOP
            $data->unique('account_empid')->each(function ($user) use ($updateRequestMsgForOfficer) {
                NotifyUser::dispatch($user->account_empid, $updateRequestMsgForOfficer);
            });
        }

    }

    //////////////////////////////////////////////////////////////////////////////// LOG REPORT PDF
    public function logReportPDF(Request $req){

        $agentUnitID = session('agentunit_id');
        $dateFrom = $req->reqDateFrom;
        $dateTo = Carbon::parse($req->reqDateTo)->addDays(1);
        $status = $req->reqStatus;
        $accountEmpId = $req->reqAgent;

            $sql = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab_2.category_value as categoryVal ,
                request_tab.request_refid as refID , 
                request_tab.request_date as requestDate ,
                request_tab.request_done as reqDone ,
                category_tab_2.category_value as categoryVal , 
                request_tab.request_by as requestBy ,
                section_tab.section_abbre as sectionVal ,
                CONCAT(accounts_tab.account_fname , ' ' ,  accounts_tab.account_lname) as actionOfficer ,
                status_tab.status_value as statusVal
                ")
            ->groupBy(
                'categoryVal' , 
                'category_tab_2.category_id',
                'refID' ,
                'requestDate' ,
                'reqDone' ,
                'categoryVal' ,
                'requestBy' ,
                'sectionVal' ,
                'actionOfficer' ,
                'statusVal'
                )
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->whereBetween('request_date' , [$dateFrom , $dateTo])
            ->orderBy('request_tab.request_date');

            if ($status == 'In-Progress') {
                $sql->where('request_tab.status_id' , 5);
                $statusWhere = "request_tab.status_id = 5";
            }
            elseif ($status == 'Acknowledge') {
                $sql->where('request_tab.status_id' , 8);
                $statusWhere = "request_tab.status_id = 8";
            }
            elseif ($status == 'Completed') {
                $sql->where('request_tab.status_id' , 6);
                $statusWhere = "request_tab.status_id = 6";
            }
            elseif ($status == 'Cancelled') {
                $sql->where('request_tab.status_id' , 7);
                $statusWhere = "request_tab.status_id = 7";
            }
            elseif ($status == 'Condemned') {
                $sql->whereIn('request_tab.status_id' , [6,7,8])
                ->where('request_tab.request_condemn' , 1);

                $statusWhere = "request_tab.status_id IN (6,7,8) AND request_tab.request_condemn = 1";
            }
            else{
                $sql->whereIn('request_tab.status_id' , [6,7,8]);
                $statusWhere = "request_tab.status_id IN (6,7,8)";
            }

            if($accountEmpId != 'All Agents'){
                $sql->where('request_tab.agentacc_id' , $accountEmpId);
                $sql->orWhere('tagagent_tab.agentacc_id' , $accountEmpId);
                $sql->whereBetween('request_tab.request_date' , [$dateFrom , $dateTo]);
                
                    if ($status == 'In-Progress') {
                        $sql->where('request_tab.status_id' , 5);
                    }
                    elseif ($status == 'Acknowledge') {
                        $sql->where('request_tab.status_id' , 8);
                    }
                    elseif ($status == 'Completed') {
                        $sql->where('request_tab.status_id' , 6);
                    }
                    elseif ($status == 'Cancelled') {
                        $sql->where('request_tab.status_id' , 7);
                    }
                    elseif ($status == 'Condemned') {
                        $sql->whereIn('request_tab.status_id' , [6,7,8])
                        ->where('request_tab.request_condemn' , 1);
                    }
                    else{
                        $sql->whereIn('request_tab.status_id' , [6,7,8]);
                    }

                $statusWhere = $statusWhere . " and  (request_tab.agentacc_id = '".$accountEmpId."' 
                or tagagent_tab.agentacc_id = '".$accountEmpId."' and (request_tab.request_date between '".$dateFrom."' and '".$dateTo."'))  ";
            }

            $data = $sql->get();
        
            /*
            $summary = DB::table('request_tab')
            ->leftJoin('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->selectRaw(
                "category_tab_2.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab_2.category_id AND
                $statusWhere
                ) AS requestTaken
                ")
            ->groupBy('categoryVal' , 'category_tab_2.category_id')
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();
            */

            $summary = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab_2.category_value as categoryVal' ,
                'request_tab.category_id',
                DB::raw("
                    COUNT(DISTINCT CASE 
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND $statusWhere
                        THEN request_tab.request_refid END) AS requestTaken
                        ")
            )
            ->groupBy('categoryVal' , 'category_tab_2.category_id' , 'request_tab.category_id')
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();

            
        require_once(app_path('Services/MyPDF.php'));
        //$pdf = new \FPDF();
        $pdf = new \MyPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->Image(public_path('images\vmclogo.png'), 40, 10, 20,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(160, 10);
        $pdf->Image(public_path('images\doh2logo.png'), 150, 10, 20,0);


        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 10);
        $pdf->Cell(0,10,'REPUBLIC OF THE PHILIPPINES' , 0 , 1 , 'C');


        $pdf->SetXY(10, 16);
        $pdf->Cell(0,10,'Department of Health' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(10, 22);
        $pdf->Cell(0,10,'Metro Manila Center for Health Development' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 28);
        $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 33);

        if(Auth::user()->agentunit_id == 1){
            $pdf->Cell(0,10,'Engineering and Facilities Management Section' , 0 , 1 , 'C');
        }
        elseif(Auth::user()->agentunit_id == 2){
            $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');
        }

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(9, 60);
        $pdf->Write(1, 'Date From:');
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(26 , 60);
        $pdf->Write(1, date('M. d, Y' ,strtotime($dateFrom)).' - '.date('M. d, Y' ,strtotime($req->reqDateTo)));

        $pdf->Line(10,65,200,65);
        $pdf->Line(10,73,200,73);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 67);
        $pdf->Write(1,'Reference Number');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(38, 66);
        $pdf->MultiCell(18,3, 'Datetime Requested' , 0, 'C' , 0,);
        
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(55, 66);
        $pdf->MultiCell(25,3, 'Datetime Accomplished' , 0, 'C' , 0,);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(88, 67);
        $pdf->Write(1,'Category');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(116, 67);
        $pdf->Write(1,'Request By');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(142, 67);
        $pdf->Write(1,'Section');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(160, 67);
        $pdf->Write(1,'Action Officer');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(187, 67);
        $pdf->Write(1,'Status');

        $y = 0;
        $counter = 1;
        foreach($data as $datas){

        if($y == 0 && $accountEmpId != 'All Agents'){
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(9 , 55);
            $pdf->Write(1, $datas->actionOfficer);
        }


            /*
            $pdf->SetFont('Arial', '', 6);
            $pdf->SetXY(5, 76+$y);
            $pdf->Write(1,$counter.'.');
            */

            $mod = $counter % 2;
            if($mod == 1){
                $pdf->SetFillColor(220,220,220);
                $pdf->Rect(10, 74+$y, 190, 7 ,'F');
            }

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 74+$y);
            $pdf->MultiCell(30,5, $datas->refID , 0, 'L' , 0,);

            $pdf->SetXY(38, 74+$y);
            $pdf->MultiCell(18,3, $datas->requestDate , 0, 'C' , 0,);

            $pdf->SetXY(55, 74+$y);
            if($datas->reqDone == ''){
                 $pdf->MultiCell(25,3, '-' , 0, 'C' , 0,);
            }else{
                 $pdf->MultiCell(25,3, $datas->reqDone , 0, 'C' , 0,);
            }

            if(strlen($datas->categoryVal) >= 25){
                $pdf->SetFont('Arial', '', 7);
                $pdf->SetXY(78, 74+$y);
                $pdf->MultiCell(35,3, $datas->categoryVal , 0, 'C' , 0,);
                $y+=1;
            }
            else{
                $pdf->SetXY(78, 74+$y);
                $pdf->SetFont('Arial', '', 8);
                $pdf->MultiCell(35,3, $datas->categoryVal , 0, 'C' , 0,);
            }

            if(strlen($datas->requestBy) >= 30){

                $pdf->SetFont('Arial', '', 6);
                $pdf->SetXY(112, 74+$y);
                $pdf->MultiCell(25,3, $datas->requestBy , 0, 'C' , 0,);
                $y+=1;

            }else{
                $pdf->SetFont('Arial', '', 7);
                $pdf->SetXY(112, 74+$y);
                $pdf->MultiCell(25,3, $datas->requestBy , 0, 'C' , 0,);
            }



            $pdf->SetFont('Arial', '', 7);
            $pdf->SetXY(140, 74+$y);
            $pdf->MultiCell(17,3, $datas->sectionVal , 0, 'C' , 0,);

            $pdf->SetFont('Arial', '', 7);
            $pdf->SetXY(157, 74+$y);
            $pdf->MultiCell(25,3, $datas->actionOfficer , 0, 'C' , 0,);

            $pdf->SetFont('Arial', '', 7);
            $pdf->SetXY(180, 74+$y);
            $pdf->MultiCell(25,3, $datas->statusVal , 0, 'C' , 0,);
            
            
            if($y >= 184){

                $pdf->Line(10,82+$y,200,82+$y);

                $pdf->AliasNbPages();
                $pdf->AddPage();
                
                $y = 0;

                $pdf->Image(public_path('images\vmclogo.png'), 40, 10, 20,0);
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXY(160, 10);
                $pdf->Image(public_path('images\doh2logo.png'), 150, 10, 20,0);

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetXY(10, 10);
                $pdf->Cell(0,10,'REPUBLIC OF THE PHILIPPINES' , 0 , 1 , 'C');

                $pdf->SetXY(10, 16);
                $pdf->Cell(0,10,'Department of Health' , 0 , 1 , 'C');

                $pdf->SetFont('Arial', 'B', 11);
                $pdf->SetXY(10, 22);
                $pdf->Cell(0,10,'Metro Manila Center for Health Development' , 0 , 1 , 'C');

                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetXY(10, 28);
                $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(10, 33);

                if(Auth::user()->agentunit_id == 1){
                    $pdf->Cell(0,10,'Engineering and Facilities Management Section' , 0 , 1 , 'C');
                }
                elseif(Auth::user()->agentunit_id == 2){
                    $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');
                }
                
                if($y == 0 && $accountEmpId != 'All Agents'){
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetXY(9 , 55);
                    $pdf->Write(1, $datas->actionOfficer);
                }

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetXY(9, 60);
                $pdf->Write(1, 'Date From:');
                
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(26 , 60);
                $pdf->Write(1, date('M. d, Y' ,strtotime($dateFrom)).' - '.date('M. d, Y' ,strtotime($req->reqDateTo)));

                $pdf->Line(10,65,200,65);
                $pdf->Line(10,73,200,73);

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(10, 67);
                $pdf->Write(1,'Reference Number');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(38, 66);
                $pdf->MultiCell(18,3, 'Datetime Requested' , 0, 'C' , 0,);
                
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(55, 66);
                $pdf->MultiCell(25,3, 'Datetime Accomplished' , 0, 'C' , 0,);

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(88, 67);
                $pdf->Write(1,'Category');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(116, 67);
                $pdf->Write(1,'Request By');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(142, 67);
                $pdf->Write(1,'Section');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(160, 67);
                $pdf->Write(1,'Action Officer');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXY(187, 67);
                $pdf->Write(1,'Status');
            }else{
                $y+=8;
            }

        $pdf->SetFont('Arial', '', 8);
        $counter++;

        }
        $pdf->Line(10,74+$y,200,74+$y);

        /*
        return response($pdf->Output('S'))
        ->header('Content-Type', 'application/pdf');
        */

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $y = 0;

        $yForSummary = 0;
        $countRows = count($summary);
        for($i=1; $i <= $countRows; $i++){
            $mod = $i % 2;
            if($mod == 1){
                $pdf->SetFillColor(220,220,220);
                $pdf->Rect(10, 76+$yForSummary, 110, 4 ,'F');
                $yForSummary +=8;
            }
        }


        $pdf->Image(public_path('images\vmclogo.png'), 40, 10, 20,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(160, 10);
        $pdf->Image(public_path('images\doh2logo.png'), 150, 10, 20,0);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 10);
        $pdf->Cell(0,10,'REPUBLIC OF THE PHILIPPINES' , 0 , 1 , 'C');

        $pdf->SetXY(10, 16);
        $pdf->Cell(0,10,'Department of Health' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(10, 22);
        $pdf->Cell(0,10,'Metro Manila Center for Health Development' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 28);
        $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 33);

        if(Auth::user()->agentunit_id == 1){
            $pdf->Cell(0,10,'Engineering and Facilities Management Section' , 0 , 1 , 'C');
        }
        elseif(Auth::user()->agentunit_id == 2){
            $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');
        }

        if($y == 0 && $accountEmpId != 'All Agents'){
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(9 , 55);
            $pdf->Write(1, $datas->actionOfficer);
        }

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(9, 60);
        $pdf->Write(1, 'Date From:');
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(26 , 60);
        $pdf->Write(1, date('M. d, Y' ,strtotime($dateFrom)).' - '.date('M. d, Y' ,strtotime($req->reqDateTo)));

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(9, 67);
        $pdf->Write(1,'Summary');

        $pdf->Line(10,70,120,70);
        $pdf->Line(10,75,120,75);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 72);
        $pdf->Write(1,'Category');

        $pdf->SetXY(110, 72);
        $pdf->Write(1,'Taken');

        $pdf->SetFont('Arial', '', 9);
        $sumTaken = 0;
        $counter = 0;
        foreach($summary as $summaries){

            $pdf->SetXY(10, 78+$y);
            $pdf->Write(1,$summaries->categoryVal);

            $pdf->SetXY(110, 78+$y);
            $pdf->Write(1,$summaries->requestTaken);

            $y+=4;
            $sumTaken +=$summaries->requestTaken;
            $counter++;
        }
        $pdf->Line(10,77+$y,120,77+$y);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(10, 80+$y);
        $pdf->Write(1,'TOTAL');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(110, 80+$y);
        $pdf->Write(1,$sumTaken);
        
       
        $signatory = "";
        $signatoryTitle = "";
        if(Auth::user()->agentunit_id == 1){
            $signatory = "Engr. ZORAIDA S. CUADRA";
            $signatoryTitle = "EFMS Supervisor";
        }
        elseif(Auth::user()->agentunit_id == 2){
            $signatory = "BILLY T. LUCENA";
            $signatoryTitle = "IMISS Supervisor";
        }

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(1, 130+$y);
        $pdf->MultiCell(200,5, $signatory , 0, 'C' , 0,);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(1, 134+$y);
        $pdf->MultiCell(200,5, $signatoryTitle , 0, 'C' , 0,);

        return response($pdf->Output('S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Log-Report.pdf"',
        ]);
       
    }

    //////////////////////////////////////////////////////////////////////////////// MY REPORT PDF
    public function myReportPDF(Request $req){

        $agentUnitID = session('agentunit_id');
        $dateFrom = $req->reqDateFrom;
        $dateTo = Carbon::parse($req->reqDateTo)->addDays(1);
        $status = $req->reqStatus;
        $accountEmpId = session('account_empid');

        if ($status == 'In-Progress') {
            $statusWhere = "request_tab.status_id = 5";
        }
        elseif ($status == 'Acknowledge') {
            $statusWhere = "request_tab.status_id = 8";
        }
        elseif ($status == 'Completed') {
            $statusWhere = "request_tab.status_id = 6";
        }
        elseif ($status == 'Cancelled') {
            $statusWhere = "request_tab.status_id = 7";
        }
        elseif ($status == 'Condemned') {
            $statusWhere = "request_tab.status_id IN (6,7,8) AND request_tab.request_condemn = 1";
        }
        else{
            $statusWhere = "request_tab.status_id IN (6,7,8)";
        }

        /*
        $data = DB::table('request_tab')
        ->leftJoin('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
        ->selectRaw(
            "category_tab_2.category_value as categoryVal ,
            (SELECT COUNT(*) FROM request_tab 
            LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
            WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
            request_tab.category_id = category_tab_2.category_id AND
            (request_tab.agentacc_id = '".$accountEmpId."' OR tagagent_tab.agentacc_id = '".$accountEmpId."')
            AND $statusWhere
            ) AS requestTaken ,
            (SELECT COUNT(*) FROM request_tab 
            WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
            request_tab.category_id = category_tab_2.category_id AND
            request_tab.agentunit_id = '".$agentUnitID."' AND request_tab.status_id IN (2,5,6,7,8)
            ) AS overAll 
            ")
        ->groupBy('categoryVal' , 'category_tab_2.category_id')
        ->where('category_tab_2.agentunit_id' , $agentUnitID)
        ->where('request_tab.status_id' , '<>' , 2)
        ->orderBy('category_tab_2.category_id')
        ->get();
        */

        $data = DB::table('request_tab')
        ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
        ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
        ->select(
            'category_tab_2.category_value as categoryVal' ,
            'request_tab.category_id',
            DB::raw("COUNT(CASE 
                        WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                        AND (request_tab.agentacc_id = '$accountEmpId' 
                            OR tagagent_tab.agentacc_id = '$accountEmpId')
                        AND $statusWhere 
                    THEN 1 END) AS requestTaken"),
            DB::raw("
                    COUNT(
                        DISTINCT CASE
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND request_tab.agentunit_id = '$agentUnitID'
                            THEN request_tab.request_refid 
                        END
                    ) AS overAll
                    ")
        )
        ->groupBy('categoryVal' , 'category_tab_2.category_id' , 'request_tab.category_id')
        ->where('category_tab_2.agentunit_id' , $agentUnitID)
        ->where('request_tab.status_id' , '<>' , 2)
        ->orderBy('category_tab_2.category_id')
        ->get();


        $pdf = new \FPDF();
        $pdf->AddPage();

        $countRows = count($data);

        $y = 0;
        $mod = 0;
        for($i = 1; $i <= $countRows; $i++){

            $mod = $i % 2;
            if($mod == 1){
                $pdf->SetFillColor(220,220,220);
                $pdf->Rect(10, 94+$y, 190, 5 ,'F');
            }
            $y+=5;
        }

        
        $pdf->Image(public_path('images\vmclogo.png'), 40, 10, 20,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(160, 10);
        $pdf->Image(public_path('images\doh2logo.png'), 150, 10, 20,0);


        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 10);
        $pdf->Cell(0,10,'REPUBLIC OF THE PHILIPPINES' , 0 , 1 , 'C');


        $pdf->SetXY(10, 16);
        $pdf->Cell(0,10,'Department of Health' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(10, 22);
        $pdf->Cell(0,10,'Metro Manila Center for Health Development' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 28);
        $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 60);
        $pdf->Write(1, Auth::user()->account_fname.' '.Auth::user()->account_lname );

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 65);
        $pdf->Write(1,session('section_name').' ('.session('section_abbre').')');


        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 75);
        $pdf->Write(1,'Overview for');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(32, 75);
        $pdf->Write(1, date('M. d, Y' ,strtotime($dateFrom)).' - '.date('M. d, Y' ,strtotime($req->reqDateTo)));


        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 85);
        $pdf->Write(1,'Task Performed');

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(38, 85);
        $pdf->Write(1, '('.$status.')');

        $pdf->Line(10,89,200,89);
        $pdf->Line(10,94,200,94);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 91);
        $pdf->Write(1,'Categories');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(110, 91);
        $pdf->Write(1,'Request Taken');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(150, 91);
        $pdf->Write(1,'Overall');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(178, 91);
        $pdf->Write(1,'Percentage');


        $pdf->SetFont('Arial', '', 9);

        $y = 0;
        $totalTaken = 0;
        $totalOverall = 0;
        $totalPercentage = 0;

        foreach($data as $datas){

            $pdf->SetXY(10, 96+$y);
            $pdf->Write(2,$datas->categoryVal);

            $pdf->SetXY(110, 96+$y);
            $pdf->Write(1,$datas->requestTaken);

            $pdf->SetXY(150, 96+$y);
            $pdf->Write(1,$datas->overAll);

            if((int)$datas->overAll){
                $percentage = ( 100 / (int)$datas->overAll * (int)$datas->requestTaken ); 
                $percentage = round($percentage); 
            }else{
                $percentage = 0;
            }

            $pdf->SetXY(188, 96+$y);
            $pdf->Write(1,$percentage.'%');

            $y +=5;
            $totalTaken = $totalTaken + (int)$datas->requestTaken;
            $totalOverall = $totalOverall + (int)$datas->overAll;
            $totalPercentage = $totalPercentage + $percentage;
        }
        $pdf->Line(10,94+$y,200,94+$y);

        $totalPercentage = round($totalPercentage / $countRows);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(10, 98+$y);
        $pdf->Write(1,'TOTAL');

        $pdf->SetXY(110, 98+$y);
        $pdf->Write(1,$totalTaken);

        $pdf->SetXY(150, 98+$y);
        $pdf->Write(1,$totalOverall);

        $pdf->SetXY(188, 98+$y);
        $pdf->Write(1,(int)$totalPercentage.'%');


        return response($pdf->Output('S'))
        ->header('Content-Type', 'application/pdf');
    }

    public function officerMyReport(Request $req){

        $agentUnitID = session('agentunit_id');
        $accountEmpId = session('account_empid');

        if(isset($req->reqDateFrom)){

            $dateFrom = $req->reqDateFrom;
            $dateTo = Carbon::parse($req->reqDateTo)->addDays(1);
            $status = $req->reqStatus;

            if ($status == 'In-Progress') {
                $statusWhere = "request_tab.status_id = 5";
            }
            elseif ($status == 'Acknowledge') {
                $statusWhere = "request_tab.status_id = 8";
            }
            elseif ($status == 'Completed') {
                $statusWhere = "request_tab.status_id = 6";
            }
            elseif ($status == 'Cancelled') {
                $statusWhere = "request_tab.status_id = 7";
            }
            elseif ($status == 'Condemned') {
                $statusWhere = "request_tab.status_id IN (6,7,8) AND request_tab.request_condemn = 1";
            }
            else{
                $statusWhere = "request_tab.status_id IN (6,7,8)";
            }
            /*
            $data = DB::table('request_tab')
            ->leftJoin('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab_2.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab_2.category_id AND
                (request_tab.agentacc_id = '".$accountEmpId."' OR tagagent_tab.agentacc_id = '".$accountEmpId."' ) AND $statusWhere 
                ) AS requestTaken ,
                (SELECT COUNT(*) FROM request_tab 
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab_2.category_id AND
                request_tab.agentunit_id = '".$agentUnitID."'
                ) AS overAll 
                ")
            ->groupBy('categoryVal' , 'category_tab_2.category_id')
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();
            */

            $data = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab_2.category_value as categoryVal' ,
                'request_tab.category_id',
                DB::raw("COUNT(CASE 
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND (request_tab.agentacc_id = '$accountEmpId' 
                                OR tagagent_tab.agentacc_id = '$accountEmpId')
                            AND $statusWhere 
                        THEN 1 END) AS requestTaken"),
                DB::raw("
                    COUNT(
                        DISTINCT CASE
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND request_tab.agentunit_id = '$agentUnitID'
                            THEN request_tab.request_refid 
                        END
                    ) AS overAll
                ")
            )
            ->groupBy(
                'categoryVal' , 
                'category_tab_2.category_id' , 
                'request_tab.category_id'
            )
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();

            //dd($data);

            return view('officer.officer_my_report' , compact('data') , ['oldData' => $req->all()]);

        }//EOF DATE FROM ISSET
        else{
            return view('officer.officer_my_report');
        }
        
    }

    public function officerLogReport(Request $req){

        $agentUnitID = session('agentunit_id');
        $agents = DB::table('accounts_tab')
        ->select('account_fname' , 'account_mname' , 'account_lname' , 'account_suffix' , 'account_empid')
        ->where('agentunit_id' , $agentUnitID)
        ->orderBy('account_fname')
        ->get();

        if(isset($req->reqDateFrom)){

            $dateFrom = $req->reqDateFrom;
            $dateTo = Carbon::parse($req->reqDateTo)->addDays(1);
            $status = $req->reqStatus;
            $accountEmpId = $req->reqAgent;

            $sql = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->leftJoin('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab_2.category_value as categoryVal ,
                request_tab.request_refid as refID , 
                request_tab.request_date as requestDate ,
                request_tab.request_done as reqDone ,
                category_tab_2.category_value as categoryVal , 
                request_tab.request_by as requestBy ,
                section_tab.section_abbre as sectionVal ,
                CONCAT(accounts_tab.account_fname , ' ' ,  accounts_tab.account_lname) as actionOfficer ,
                status_tab.status_value as statusVal
                ")
            ->groupBy(
                'categoryVal' , 
                'category_tab_2.category_id',
                'refID' ,
                'requestDate' ,
                'reqDone' ,
                'categoryVal' ,
                'requestBy' ,
                'sectionVal' ,
                'actionOfficer' ,
                'statusVal'
                )
            ->where('request_tab.agentunit_id' , $agentUnitID)
            ->whereBetween('request_date' , [$dateFrom , $dateTo])
            ->orderBy('request_tab.request_date');

            if ($status == 'In-Progress') {
                $sql->where('request_tab.status_id' , 5);
                $statusWhere = "request_tab.status_id = 5 ";
            }
            elseif ($status == 'Acknowledge') {
                $sql->where('request_tab.status_id' , 8);
                $statusWhere = "request_tab.status_id = 8";
            }
            elseif ($status == 'Completed') {
                $sql->where('request_tab.status_id' , 6);
                $statusWhere = "request_tab.status_id = 6";
            }
            elseif ($status == 'Cancelled') {
                $sql->where('request_tab.status_id' , 7);
                $statusWhere = "request_tab.status_id = 7";
            }
            elseif ($status == 'Condemned') {
                $sql->whereIn('request_tab.status_id' , [6,7,8])
                ->where('request_tab.request_condemn' , 1);

                $statusWhere = "request_tab.status_id IN (6,7,8) AND request_tab.request_condemn = 1";
            }
            else{
                $sql->whereIn('request_tab.status_id' , [6,7,8]);
                $statusWhere = "request_tab.status_id IN (6,7,8)";
            }

                if($accountEmpId != 'All Agents'){

                    $sql->where('request_tab.agentacc_id' , $accountEmpId);
                    $sql->orWhere('tagagent_tab.agentacc_id' , $accountEmpId);
                    $sql->whereBetween('request_tab.request_date' , [$dateFrom , $dateTo]);

                    if ($status == 'In-Progress') {
                        $sql->where('request_tab.status_id' , 5);
                    }
                    elseif ($status == 'Acknowledge') {
                        $sql->where('request_tab.status_id' , 8);
                    }
                    elseif ($status == 'Completed') {
                        $sql->where('request_tab.status_id' , 6);
                    }
                    elseif ($status == 'Cancelled') {
                        $sql->where('request_tab.status_id' , 7);
                    }
                    elseif ($status == 'Condemned') {
                        $sql->whereIn('request_tab.status_id' , [6,7,8])
                        ->where('request_tab.request_condemn' , 1);
                    }
                    else{
                        $sql->whereIn('request_tab.status_id' , [6,7,8]);
                    }
                
                $statusWhere = $statusWhere . " and  (request_tab.agentacc_id = '".$accountEmpId."' 
                or tagagent_tab.agentacc_id = '".$accountEmpId."') and request_tab.request_date between '".$dateFrom."' and '".$dateTo."' ";
            }

            $data = $sql->get();

            /*
            $summary = DB::table('request_tab')
            ->leftJoin('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->selectRaw(
                "category_tab_2.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab_2.category_id AND
                $statusWhere
                ) AS requestTaken
                ")
            ->groupBy('categoryVal' , 'category_tab_2.category_id')
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();
            */

            $summary = DB::table('request_tab')
            ->join('category_tab_2' , 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab_2.category_value as categoryVal' ,
                'request_tab.category_id',
                DB::raw("
                    COUNT(DISTINCT CASE 
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND $statusWhere
                        THEN request_tab.request_refid END) AS requestTaken
                        ")
            )
            ->groupBy('categoryVal' , 'category_tab_2.category_id' , 'request_tab.category_id')
            ->where('category_tab_2.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab_2.category_id')
            ->get();

            return view('officer.officer_log_report' , compact('agents' , 'data' , 'summary') , ['oldData' => $req->all()]);
        }
        else{
            return view('officer.officer_log_report' , compact('agents') , ['oldData' => $req->all()]);
        }
        
    }

    public function ajaxLoadTagAgents(Request $req){

        $agentUnitID = $req->agentID;
        $currentUser = session('account_empid');
        $refID = $req->refID;

        /*
        $data = DB::table('accounts_tab')
        ->join('usertype_tab' , 'usertype_tab.usertype_id' , '=' , 'accounts_tab.usertype_id')
        ->leftJoin('tagagent_tab' , 'tagagent_tab.agentacc_id' , '=' , 'accounts_tab.account_empid')
        ->selectRaw("
            accounts_tab.account_empid as empNo , 
            accounts_tab.account_fname as empFname , 
            accounts_tab.account_lname as empLname , 
            usertype_tab.usertype_name as userType , 
            CASE WHEN (
            select count(*) from tagagent_tab 
            where agentacc_id = accounts_tab.account_empid and request_refid = '".$refID."'
            ) = 0 THEN 0 ELSE 1 END as tagId
        ")
        ->where('accounts_tab.agentunit_id' , $agentUnitID)
        ->where('accounts_tab.account_empid' , '<>' , $currentUser)
        ->orWhere('tagagent_tab.request_refid' , $refID)
        ->groupBy('empNo' , 'empFname' , 'empLname' , 'userType')
        ->orderBy('empFname' , 'ASC')
        ->get();
        */    

        $data = DB::table('accounts_tab')
        ->join('usertype_tab', 'usertype_tab.usertype_id', '=', 'accounts_tab.usertype_id')
        ->leftJoin('tagagent_tab', function($join) use ($refID) {
            $join->on('tagagent_tab.agentacc_id', '=', 'accounts_tab.account_empid')
                ->where('tagagent_tab.request_refid', '=', $refID);
        })
        ->select(
            'accounts_tab.account_empid as empNo',
            'accounts_tab.account_fname as empFname',
            'accounts_tab.account_lname as empLname',
            'usertype_tab.usertype_name as userType',
            DB::raw("CASE WHEN tagagent_tab.agentacc_id IS NULL THEN 0 ELSE 1 END as tagId")
        )
        ->where('accounts_tab.agentunit_id', $agentUnitID)
        ->where('accounts_tab.account_empid', '<>', $currentUser)
        ->orderBy('empFname', 'ASC')
        ->get();

        return json_encode($data);
    }

    public function ajaxTagAgentConfirm(Request $req){

        $refID = $req->refID;
        $tagAgentID = $req->tagAgentID;
        $tagValue = $req->tagValue;

        if($tagValue == 0){
            DB::table('tagagent_tab')
            ->insert([
                'request_refid' => $refID ,
                'agentacc_id' => $tagAgentID ,
                'tagegent_datetime' => now()
            ]);
        }
        else{
            DB::table('tagagent_tab')
            ->where('request_refid' , $refID)
            ->where('agentacc_id' , $tagAgentID)
            ->delete();
        }

        return "OK";
        /*
        return response()->json([
            'success' => true,
            'message' => 'Operation completed.'
        ]);
        */
    }

    public function locationFloorSettings(){

        $data = DB::table('location_tab')
        ->join('bldgfloor_tab' , 'bldgfloor_tab.location_id' , '=' , 'location_tab.location_id')
        ->selectRaw("
            location_tab.location_id as locID , 
            location_tab.location_value as locVal , 
            location_tab.location_abbre as locAbbr ,
            COUNT(bldgfloor_tab.location_id) as totalFloor
        ")
        ->groupBy('locVal' , 'locAbbr' , 'locID')
        ->orderBy('location_tab.location_id')
        ->where('deleted' , 0) // uncomment this line if table location_tab has column name -> 'deleted' with default value = 0
        ->get();

        //dd($data);
        return view('officer.location_floor_settings' , compact('data')); // USE ON TEST
    }

    public function underDev(){

         return view('accountstab.under_dev'); // USE ON LIVE TO PREVENT ACCESS - UNDER DEVELOPEMENT
    }

    public function officerDeleteLocation(Request $req){

        $locID = (int)$req->locID;
        //dd($locID); // comment this line if table location_tab has column name -> 'deleted' with default value = 0

        DB::table('location_tab')
        ->where('location_id' , $locID)
        ->update([
            'deleted' => 1
        ]);

        return back();
    }

    public function officerUpdateLoc(Request $req){

        $locID = $req->getLocID;
        $locationName = $req->locationName;
        $locAbbr = strtoupper($req->locAbbr);
        $floorNo = $req->floorNo;

        //dd($locID); // comment this line to enable update location

        //UPDATE location_tab TABLE
        DB::table('location_tab')
        ->where('location_id' , $locID)
        ->update([
            'location_value' =>  $locationName ,
            'location_abbre' =>  $locAbbr ,
        ]);

        // DELETE FLOORS UNDER LOC ID
        DB::table('bldgfloor_tab')
        ->where('location_id' , $locID)
        ->delete();


        $this->insertGenerateFloor($floorNo , $locID);
        return back();
    }

    public function officerAddDuration(Request $req){

        $agentUnitID = session('agentunit_id');

        $durationName = strtoupper($req->durationName);
        $durationHour = $req->durationHour;
        $durationDay = $req->durationDay;

        $totalDuration = ($durationDay * 24) + $durationHour;
        $totalDuration = $totalDuration.':00:00';

        DB::table('repairtype_tab')
        ->insert([
            'repairtype_value' => $durationName ,
            'repairtype_time' => $totalDuration ,
            'added_by_agentunit_id' => $agentUnitID ,
        ]);

        return back();
    }

    public function officerAddLocation(Request $req){

        $locationName = $req->locationName;
        $locAbbr = strtoupper($req->locAbbr);
        $floorNo = $req->floorNo;

        $getNewLocID = DB::table('location_tab')
        ->insertGetId([
            'location_value' => $locationName ,
            'location_abbre' => $locAbbr 
        ]);

        $this->insertGenerateFloor($floorNo , $getNewLocID);
        return back();
    }

    public function insertGenerateFloor($floorNo , $locID){

        for($i = 1; $i <= $floorNo; $i++){

            $floorVal = '';
            $flooAbbr = '';

            switch($i){
                case 1:
                    $floorVal = 'Ground Floor';
                    $flooAbbr = '1st';
                    break;

                case 2:
                    $floorVal = 'Second Floor';
                    $flooAbbr = '2nd';
                    break;

                case 3:
                    $floorVal = 'Third Floor';
                    $flooAbbr = '3rd';
                    break;

                case 4:
                    $floorVal = 'Fourth Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 5:
                    $floorVal = 'Fifth Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 6:
                    $floorVal = 'Sixth Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 7:
                    $floorVal = 'Seventh Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 8:
                    $floorVal = 'Eight Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 9:
                    $floorVal = 'Ninth Floor';
                    $flooAbbr = $i.'th';
                    break;

                case 10:
                    $floorVal = 'Tenth Floor';
                    $flooAbbr = $i.'th';
                    break;

                // DEFAULT VALUE FOR NOW IF FLOOR IS GREATER THAN 10
                default:
                $floorVal = $i.'th';
                $flooAbbr = $i.'th';
                break;
            }

            DB::table('bldgfloor_tab')
            ->insert([
                'bldgfloor_val' => $floorVal ,
                'bldgfloor_abbre' => $flooAbbr ,
                'location_id' => $locID ,
            ]);
        }

        return 1;
    }

    public function requestDurationSettings(){

        $agentUnitID = session('agentunit_id');

        $sql = DB::table('category_tab_2')
        ->join('repairtype_tab' , 'repairtype_tab.repairtype_id' , '=' , 'category_tab_2.repairtype_id')
        ->select(
        'category_tab_2.active as categoryActive' ,
        'category_tab_2.main_category as categoryMain' ,
        'category_tab_2.category_id as categoryID' , 
        'category_tab_2.category_value as categoryVal' , 
        'repairtype_tab.repairtype_time as repairTime'
        )
        ->where('agentunit_id' , $agentUnitID)
        ->groupBy(
        'categoryActive' ,
        'categoryMain' ,
        'categoryID' , 
        'category_tab_2.category_value' , 
        'repairtype_tab.repairtype_value' , 
        'repairtype_tab.repairtype_time'
        )
        ->orderBy('category_tab_2.category_id')
        ->orderBy('category_tab_2.category_value');

        if($agentUnitID == 1){
            $sql->where('category_id' , '>=' , 43); // SHOW ALL NEW EFMS ONLY
        }

        $data = $sql->get();

        $durations = DB::table('repairtype_tab')
        ->select('repairtype_value as repairVal' , 'repairtype_time as repairTime' , 'repairtype_id as repairID')
        ->where('deleted' , 0)
        ->where('added_by_agentunit_id' , $agentUnitID)
        ->orWhere('added_by_agentunit_id' , 0)
        //->orderBy('repairtype_time')
        ->get();

        return view('officer.request_duration_settings' , compact('data' , 'durations'));
    }

    public function officerUpdateDuration(Request $req){

        $getDurationID = $req->getDurationID;
        $getCategoryID = $req->getCategoryID;

        DB::table('category_tab_2')
        ->where('category_id' , $getCategoryID)
        ->update([
            'repairtype_id' => $getDurationID 
        ]);

        return back();
    }

    public function officerDeleteDuration(Request $req){

        $durationID = $req->durationID;
        DB::table('repairtype_tab')
        ->where('repairtype_id' , $durationID)
        ->update([
            'deleted' => 1
        ]);

        return back();
    }

    public function updateCategoryTab2(){

        //GET ALL CATEGORY FROM OLD CATEGORY TAB
        $getOld = DB::table('category_tab')
        ->orderBy('category_id')
        ->get();

        //UNCOMMENT TO UPDATE TABLE category_tab_2
        /*
        DB::table('category_tab_2')
        ->truncate();

        // insert all imiss request
        $sql = DB::table('category_tab_2');
        foreach($getOld as $data){
            $sql->insert([
                'category_id' => $data->category_id ,
                'category_value' => $data->category_value ,
                'main_category' => '' ,
                'agentunit_id' => $data->agentunit_id ,
                'repairtype_id' => $data->repairtype_id ,
                'category_icon' => $data->category_icon ,
            ]);
        }

        // insert all new efms request
        $insertNewEFMS = DB::table('category_tab_2');
        $filename = public_path()."/new_efms_request_11-24-2025.txt";
        $handle = fopen($filename, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $array = explode("," , $line);

                $categoryVal = $array[0];
                $catMain = $array[1];
                $agentUnitID = $array[2];
                $repairTypeID = $array[3];
                $categoryIcon = $array[4];

                $insertNewEFMS->insert([
                    'category_value' => $categoryVal,
                    'main_category' => $catMain,
                    'agentunit_id' => $agentUnitID,
                    'repairtype_id' => $repairTypeID,
                    'category_icon' => $categoryIcon ,
                ]);
            }
            fclose($handle);
        } else {
            echo "Error: Could not open the file '{$filename}'.";
        }

        $this->updateActionTakenTab2();
        */

        $data2 = DB::table('category_tab_2')
        ->get();

        return view('officer.category_tab_2_update' , compact('data2'));
    }

    public function updateActionTakenTab2(){

        $getOldData = DB::table('actiontaken_tab')->get();

        DB::table('actiontaken_tab_2')
        ->truncate();

        $sql = DB::table('actiontaken_tab_2');
        foreach($getOldData as $d){
            $sql->insert([
                'request_refid' => $d->request_refid ,
                'action_taken' => $d->action_taken ,
                'action_datetime' => $d->action_datetime ,
                'deleted' => 0 ,
            ]);
        }   
    }

    public function ajaxDeleteActionTaken(Request $req){

        $actionID = $req->actionID;
        $deletedBy = Auth::user()->account_fname.' '.Auth::user()->account_lname;


        DB::table('actiontaken_tab')
        ->where('action_id' , $actionID)
        ->update([
            'deleted' => 1 ,
            'deleted_datetime' => now() ,
            'deleted_by' => $deletedBy
        ]);
    }

    public function activateCategory(Request $req){

        $categoryID = $req->categoryID;
        $activeVal = $req->activeVal;

        if($activeVal == 'true'){
            $activeVal = 1;
        }else{
            $activeVal = 0;
        }

        DB::table('category_tab_2')
        ->where('category_id' , $categoryID)
        ->update([
            'active' => $activeVal
        ]);

        return $categoryID.'-'. $activeVal;
    }

    public function editAccomplished(Request $req){

        $refID = $req->refID;
        $newDateAccomplished = $req->newDateAccomplished;
        $newTimeAccomplished = $req->newTimeAccomplished;

        $newAccomplishedDateTime = $newDateAccomplished.' '.$newTimeAccomplished;

        //dd($newAccomplishedDateTime);

        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'request_done' => $newAccomplishedDateTime
        ]);

        return back();
    }

    public function officerServiceReport(Request $req){

        $getRefID = $req->getRefID;
        $nameOfEquipment = $req->getNameOfEqSR;
        $modelNo = $req->getModelNoSR;
        $serialNo = $req->getSerialNoSR;
        $complain = $req->getComplaintSR;
        $remarks = $req->getRemarksSR;

        $recommendation = $req->recommendationSR;
        $reason = $req->getReasonSR;

        /*
        $eqPartName = $req->input('eqPartName' , []);
        $eqPartAmt = $req->input('eqPartAmount' , []);
        */
        $getPartsCounter = (int)$req->getPartsCounter;
        for($i = 0; $i < $getPartsCounter; $i++){

            $eqPartName = $req->input('eqPartName_'.$i);
            $eqPartAmt = $req->input('eqPartAmount_'.$i);
            $eqTypeID = $req->input('recommendationSR_'.$i);

            //dd($eqPartName . ' / ' . $eqPartAmt . ' / ' .$eqTypeID);

            DB::table('equipmentparts_tab')
            ->insert([
                'request_refid' => $getRefID,
                'equipmentparts_name' => $eqPartName,
                'equipmentparts_amount' => $eqPartAmt,
                'equipmentparts_date' => now(),
                'equipmenttype_id' => $eqTypeID
            ]);
        }

        if($recommendation == 1){
            DB::table('request_tab')
            ->where('request_refid' , $getRefID)
            ->update([
                'request_done' => now(),
                'status_id' => 8 ,
                'name_of_equipment' => $nameOfEquipment ,
                'serialno' => $serialNo ,
                'modelno' => $modelNo ,
                'name_of_equipment' => $nameOfEquipment ,
                'request_remarks' => $remarks ,
                'request_findings' => $complain ,
                'request_recommendation' => $reason ,
                'request_warranty' => 1 ,
            ]);
        }
        elseif($recommendation == 2){

            DB::table('request_tab')
            ->where('request_refid' , $getRefID)
            ->update([
                'request_done' => now() ,
                'status_id' => 8 ,
                'name_of_equipment' => $nameOfEquipment ,
                'serialno' => $serialNo ,
                'modelno' => $modelNo ,
                'name_of_equipment' => $nameOfEquipment ,
                'request_remarks' => $remarks ,
                'request_findings' => $complain ,
                'request_recommendation' => $reason ,
                'request_condemn' => 1 ,
            ]);
        }

        return back();
    }

    public function serviceReportFormPDF(Request $req){

        $refID = $req->refID;

        $data = DB::table('request_tab')
        ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
        ->join('category_tab_2', 'category_tab_2.category_id' , '=' , 'request_tab.category_id')
        ->select(
            'section_tab.section_name as sectionName' ,
            'category_tab_2.category_value as categoryVal' ,
            'request_tab.request_by as requestBy' ,
            'request_tab.name_of_equipment as nameOfEq' ,
            'request_tab.serialno as serialNo' ,
            'request_tab.modelno as modelNo' ,
            'request_tab.request_findings as reqFindings' ,
            'request_tab.request_taken as reqTaken' ,
            'request_tab.request_done as reqDone' ,
            'request_tab.request_warranty as reqWarranty' ,
            'request_tab.request_condemn as reqCondemn' ,
            'request_tab.request_remarks as reqRemarks' ,
            'request_tab.request_recommendation as reqRecommendation'
        )
        ->where('request_tab.request_refid' , $refID)
        ->get();


        $sectionName = "";
        $categoryVal = "";
        $nameOfEq = "";
        $serialNo = "";
        $modelNo = "";
        $reqFindings = "";
        $reqTaken = "";
        $reqDone = "";
        $reqWarranty = "";
        $reqCondemn = "";
        $reqRemarks = "";
        $reqRecommendation = "";

        $signatory1 = "FRANCISCO GUILALAS CAMPOSANO JR";
        $signatory2 = "Engr. ZORAIDA S. CUADRA";
        $signatory3 = "";

        foreach($data as $rows){

            $sectionName = $rows->sectionName;
            $categoryVal = $rows->categoryVal;
            $nameOfEq = $rows->nameOfEq;
            $serialNo = $rows->serialNo;
            $modelNo = $rows->modelNo;
            $reqFindings = $rows->reqFindings;
            $reqTaken = $rows->reqTaken;
            $reqDone = $rows->reqDone;
            $reqWarranty = $rows->reqWarranty;
            $reqCondemn = $rows->reqCondemn;
            $reqRemarks = $rows->reqRemarks;
            $reqRecommendation = $rows->reqRecommendation;
            $signatory3 = $rows->requestBy;
        }


        $actionTakens = DB::table('actiontaken_tab')
        ->where('request_refid' , $refID)
        ->where('deleted' , 0)
        ->orderBy('action_datetime' , 'DESC')
        ->limit(1)
        ->get();

        $eqParts = DB::table('equipmentparts_tab')
        ->join('equipmenttype_tab' , 'equipmenttype_tab.equipmenttype_id' , '=' , 'equipmentparts_tab.equipmenttype_id')
        ->where('request_refid' , $refID)
        ->get();

        $pdf = new \FPDF();
        $pdf->AddPage();
        
        $pdf->Image(public_path('images/vmclogo.png'), 20, 10, 20,0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(160, 10);
        $pdf->MultiCell(40,5,"FM-EFMS-002 \nRev 3 - 06/15/17" , 1, 'C' , 0,);


        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 10);
        $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0,1,'Padrigal St., Karuhatan, Valenzuela City' , 0 , 1 , 'C');
        $pdf->Cell(0,10,'Tel. No. 294-67-11' , 0 , 1 , 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0,1,'Engineering and Facilities Management Section' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(10, 45);
        $pdf->Cell(0,10,'SERVICE REPORT FORM' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(165, 55);
        $pdf->Cell(0,10, date('M. d, Y' , strtotime(now())) , 0 , 1 , 'C');
        $pdf->Line(165,63,200,63);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(165, 65);
        $pdf->Cell(0,1,'Date' , 0 , 1 , 'C');


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 85);
        $pdf->Cell(50,1,'Name of Office/Unit' , 0 , 1 , 'L');
        $pdf->Line(60,87,200,87);


        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 84);
        $pdf->Cell(50,1, $sectionName , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 90);
        $pdf->Cell(50,1,'Service Order Number' , 0 , 1 , 'L');
        $pdf->Line(60,92,200,92);


        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 89);
        $pdf->Cell(50,1, $refID , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 95);
        $pdf->Cell(50,1,'Service Request Category' , 0 , 1 , 'L');
        $pdf->Line(60,97,200,97);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 94);
        $pdf->Cell(50,1, $categoryVal , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 100);
        $pdf->Cell(50,1,'Equipment' , 0 , 1 , 'L');
        $pdf->Line(60,102,200,102);


        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 99);
        $pdf->Cell(50,1, $nameOfEq , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 105);
        $pdf->Cell(45,1,'Brand / Model' , 0 , 1 , 'R');
        $pdf->Line(60,107,200,107);


        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 104);
        $pdf->Cell(50,1, $modelNo , 0 , 1 , 'L');


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 110);
        $pdf->Cell(45,1,'Serial No.' , 0 , 1 , 'R');
        $pdf->Line(60,112,200,112);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 109);
        $pdf->Cell(50,1, $serialNo , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 115);
        $pdf->Cell(50,1,'Complaint / Observation' , 0 , 1 , 'L');
        $pdf->Line(60,117,200,117);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 114);
        $pdf->Cell(50,1, $reqFindings , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 120);
        $pdf->Cell(50,1,'Work Done' , 0 , 1 , 'L');
        $pdf->Line(60,122,200,122);

        $x = 0;
        $countLetters = 0;
        $workDone = "";
        foreach($actionTakens as $rows){
            $countLetters = strlen($rows->action_taken);
            $workDone = $rows->action_taken;
            if($x > 0){
                $workDone = ', ' . $rows->action_taken;
            }
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(59 + $x, 119);
            $pdf->Cell(1,1, $workDone , 0 , 1 , 'L');
            $x+=($countLetters*2);
        }


        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 125);
        $pdf->Cell(50,1,'Work Started (Date and Time)' , 0 , 1 , 'L');
        $pdf->Line(60,127,200,127);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 124);
        $pdf->Cell(50,1, date('M. d, Y - H:i:s' , strtotime($reqTaken)) , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 130);
        $pdf->Cell(50,1,'Work Finished (Date and Time)' , 0 , 1 , 'L');
        $pdf->Line(60,132,200,132);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 129);
        $pdf->Cell(50,1, date('M. d, Y - H:i:s' , strtotime($reqDone)) , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 135);
        $pdf->Cell(50,1,'Remarks' , 0 , 1 , 'L');
        $pdf->Line(60,137,200,137);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(59, 134);
        $pdf->Cell(50,1, $reqRemarks , 0 , 1 , 'L');

        $pdf->Line(10,150,200,150);
        $pdf->Line(10,155,200,155);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 152);
        $pdf->Cell(10,1,'Equipment' , 0 , 1 , 'L');
        $pdf->SetXY(80, 152);
        $pdf->Cell(10,1,'Part Type' , 0 , 1 , 'L');
        $pdf->SetXY(190, 152);
        $pdf->Cell(10,1,'Cost' , 0 , 1 , 'R');

        $y = 0;
        $totalCost = 0;
        $pdf->SetFont('Arial', '', 9);
        foreach($eqParts as $rows){

            $pdf->SetXY(10, 157 + $y);
            $pdf->Cell(10,1, $rows->equipmentparts_name , 0 , 1 , 'L');

            $pdf->SetXY(80, 157 + $y);
            $pdf->Cell(10,1, $rows->equipmenttype_value , 0 , 1 , 'L');

            $pdf->SetXY(190, 157 + $y);
            $pdf->Cell(10,1, number_format($rows->equipmentparts_amount , 0) , 0 , 1 , 'R');
            $y+=5;
            $totalCost = $totalCost + $rows->equipmentparts_amount;


            if($y >= 120){
                $pdf->AddPage();
                $y = -145;
            }
        }

        $pdf->Line(10,155 +$y,200,155 +$y);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(150, 160 +$y);
        $pdf->Cell(10,1,'TOTAL :' , 0 , 1 , 'L');
        $pdf->SetXY(170, 160 +$y);
        $pdf->Cell(30,1, number_format($totalCost , 0) , 0 , 1 , 'R');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(10, 160 +$y);
        $pdf->Cell(10,1,'(   ) For Outside Repair' , 0 , 1 , 'L');

        if($reqWarranty == 1){
            $pdf->Image(public_path('images\check2.png'), 11, 158+$y, 0,5);
        }

        $pdf->SetXY(75, 160 +$y);
        $pdf->Cell(165,1,'(   ) For Condemn' , 0 , 1 , 'L');

        if($reqCondemn == 1){
            $pdf->Image(public_path('images\check2.png'), 76, 158 +$y, 0,5);
        }

        $pdf->SetXY(10, 170+$y);
        $pdf->Cell(165,1,'Reason :' , 0 , 1 , 'L');

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(25, 172+$y);
        $pdf->MultiCell(175,5, $reqRecommendation , 0 , 'L' , 0,);


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 250);
        $pdf->Cell(20,1,'Serviced by:' , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 265);
        $pdf->Cell(70,0, $signatory1 , 0 , 1 , 'C');
        $pdf->Line(15,267,75,267);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 270);
        $pdf->Cell(70,1,'Signature over Printed Name' , 0 , 1 , 'C');

        $pdf->SetFont('Arial', '', 6);
        $pdf->SetXY(10, 273);
        $pdf->Cell(70,1,'Staff, Engineering and Facilities Management' , 0 , 1 , 'C');


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(80, 250);
        $pdf->Cell(20,1,'Verified by:' , 0 , 1 , 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(80, 265);
        $pdf->Cell(70,0, $signatory2 , 0 , 1 , 'C');
        $pdf->Line(87,267,142,267);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(80, 270);
        $pdf->Cell(70,1,'Signature over Printed Name' , 0 , 1 , 'C');


        $pdf->SetFont('Arial', '', 6);
        $pdf->SetXY(80, 273);
        $pdf->Cell(70,1,'Head, Engineering and Facilities Management' , 0 , 1 , 'C');


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(150, 250);
        $pdf->Cell(20,1,'Accepted by:' , 0 , 1 , 'L');


        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(142, 265);
        $pdf->Cell(70,0, $signatory3 , 0 , 1 , 'C');
        $pdf->Line(155,267,200,267);


        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(142, 270);
        $pdf->Cell(70,1,'Signature over Printed Name' , 0 , 1 , 'C');


        $pdf->SetFont('Arial', '', 6);
        $pdf->SetXY(142, 273);
        $pdf->Cell(70,1,'End-User' , 0 , 1 , 'C');

        return response($pdf->Output('S'))
        ->header('Content-Type', 'application/pdf');
    }
}
