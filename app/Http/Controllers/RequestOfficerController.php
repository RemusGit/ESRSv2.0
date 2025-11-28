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
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('location_tab' , 'location_tab.location_id' , '=' , 'request_tab.location_id')
            ->join('bldgfloor_tab' , 'bldgfloor_tab.bldgfloor_id' , '=' , 'request_tab.bldgfloor_id')
            ->leftJoin('actiontaken_tab', 'actiontaken_tab.request_refid', '=', 'request_tab.request_refid')
            ->selectRaw("request_tab.request_refid as refNo , 
            category_tab.category_id as categoryId ,
            request_tab.request_date as reqDate , 
            request_tab.request_duration as until ,
            category_tab.category_value as categoryVal , 
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
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('location_tab' , 'location_tab.location_id' , '=' , 'request_tab.location_id')
            ->join('bldgfloor_tab' , 'bldgfloor_tab.bldgfloor_id' , '=' , 'request_tab.bldgfloor_id')
            ->leftJoin('actiontaken_tab', 'actiontaken_tab.request_refid', '=', 'request_tab.request_refid')
            ->selectRaw("request_tab.request_refid as refNo , 
            category_tab.category_id as categoryId ,
            request_tab.request_date as reqDate , 
            request_tab.request_duration as until ,
            category_tab.category_value as categoryVal , 
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

        $this->notifRequestStatusUpdate($officerFullName , $requestDone , $refID , $categoryVal , 8);
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

        $this->notifRequestStatusUpdate($officerFullName , $dateUpdated , $refID , $categoryVal , 5);
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
        
        $this->notifRequestStatusUpdate($officerFullName , $actionDateTime , $refID , $categoryVal , 2);

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

        $this->notifRequestStatusUpdate($officerFullName , $dateCancelled , $refID , $categoryVal , 7);
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

        $data = DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->select('account_id')
        ->first();
        $accountEmpId = $data->account_id;

        broadcast(new NotifyUser($accountEmpId , $updateRequestMsg))->toOthers();

        return back();
    }

    public function loadAllCategory(){

        $agentUnit = session('agentunit_id');

        $data = DB::table('category_tab')
        ->where('agentunit_id' , $agentUnit)
        ->orderBy('category_value' , 'ASC')
        ->get();
        return json_encode($data);
    }


    public function assignStaff(Request $req){
        
        $staffID = $req->getStaffID;
        $refID = $req->getRefID;
        $categoryVal = $req->getCategoryVal;
        $takenByFullName = $req->getTakenByName;
        $requestTaken = now();
    
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'agentacc_id' => $staffID ,
            'request_taken' => $requestTaken,
            'request_progress' => $requestTaken,
            'status_id' => 5 // IN-PROGRESS
        ]);

        $this->notifRequestStatusUpdate($takenByFullName , $requestTaken , $refID , $categoryVal , 5);
        return back();
    }
    //////////////////////////////////////////////////////////////////// NOTIFICATION - REQUEST STATUS UPDATE
    public function notifRequestStatusUpdate($takenByFullName , $dateTaken , $refNo , $categoryVal , $status){

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


        $updateRequestMsg = "REQUEST UPDATED! <br> 
        Status: ".$statusText."<br>
        Action Officer: ".$takenByFullName. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime($dateTaken)). "<br>
        Reference No. : <a href='/".$statusLink."'>".$refNo. "</a><br>
        Category: ".$categoryVal;

        $data = DB::table('request_tab')
        ->where('request_refid' , $refNo)
        ->select('account_id')
        ->first();
        $accountEmpId = $data->account_id;

        broadcast(new NotifyUser($accountEmpId , $updateRequestMsg))->toOthers();
    }

    //////////////////////////////////////////////////////////////////////////////// LOG REPORT PDF
    public function logReportPDF(Request $req){

        $agentUnitID = session('agentunit_id');
        $dateFrom = $req->reqDateFrom;
        $dateTo = Carbon::parse($req->reqDateTo)->addDays(1);
        $status = $req->reqStatus;
        $accountEmpId = $req->reqAgent;

            $sql = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->join('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab.category_value as categoryVal ,
                request_tab.request_refid as refID , 
                request_tab.request_date as requestDate ,
                request_tab.request_done as reqDone ,
                category_tab.category_value as categoryVal , 
                request_tab.request_by as requestBy ,
                section_tab.section_abbre as sectionVal ,
                CONCAT(accounts_tab.account_fname , ' ' ,  accounts_tab.account_lname) as actionOfficer ,
                status_tab.status_value as statusVal
                ")
            ->groupBy(
                'categoryVal' , 
                'category_tab.category_id',
                'refID' ,
                'requestDate' ,
                'reqDone' ,
                'categoryVal' ,
                'requestBy' ,
                'sectionVal' ,
                'actionOfficer' ,
                'statusVal'
                )
            ->where('category_tab.agentunit_id' , $agentUnitID)
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
            ->leftJoin('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->selectRaw(
                "category_tab.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab.category_id AND
                $statusWhere
                ) AS requestTaken
                ")
            ->groupBy('categoryVal' , 'category_tab.category_id')
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
            ->get();
            */

            $summary = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab.category_value as categoryVal' ,
                'request_tab.category_id',
                DB::raw("
                    COUNT(DISTINCT CASE 
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND $statusWhere
                        THEN request_tab.request_refid END) AS requestTaken
                        ")
            )
            ->groupBy('categoryVal' , 'category_tab.category_id' , 'request_tab.category_id')
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
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
        $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');


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
                $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');

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
        $pdf->Cell(0,10,'Integrated Management Information System Section' , 0 , 1 , 'C');

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
        
       
        $signatory = "BILLY T. LUCENA";

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetXY(1, 130+$y);
        $pdf->MultiCell(200,5, $signatory , 0, 'C' , 0,);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(1, 134+$y);
        $pdf->MultiCell(200,5, 'IMISS SUPERVISOR' , 0, 'C' , 0,);

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
        ->leftJoin('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
        ->selectRaw(
            "category_tab.category_value as categoryVal ,
            (SELECT COUNT(*) FROM request_tab 
            LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
            WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
            request_tab.category_id = category_tab.category_id AND
            (request_tab.agentacc_id = '".$accountEmpId."' OR tagagent_tab.agentacc_id = '".$accountEmpId."')
            AND $statusWhere
            ) AS requestTaken ,
            (SELECT COUNT(*) FROM request_tab 
            WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
            request_tab.category_id = category_tab.category_id AND
            request_tab.agentunit_id = '".$agentUnitID."' AND request_tab.status_id IN (2,5,6,7,8)
            ) AS overAll 
            ")
        ->groupBy('categoryVal' , 'category_tab.category_id')
        ->where('category_tab.agentunit_id' , $agentUnitID)
        ->where('request_tab.status_id' , '<>' , 2)
        ->orderBy('category_tab.category_id')
        ->get();
        */

        $data = DB::table('request_tab')
        ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
        ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
        ->select(
            'category_tab.category_value as categoryVal' ,
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
        ->groupBy('categoryVal' , 'category_tab.category_id' , 'request_tab.category_id')
        ->where('category_tab.agentunit_id' , $agentUnitID)
        ->where('request_tab.status_id' , '<>' , 2)
        ->orderBy('category_tab.category_id')
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
            ->leftJoin('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab.category_id AND
                (request_tab.agentacc_id = '".$accountEmpId."' OR tagagent_tab.agentacc_id = '".$accountEmpId."' ) AND $statusWhere 
                ) AS requestTaken ,
                (SELECT COUNT(*) FROM request_tab 
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab.category_id AND
                request_tab.agentunit_id = '".$agentUnitID."'
                ) AS overAll 
                ")
            ->groupBy('categoryVal' , 'category_tab.category_id')
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
            ->get();
            */

            $data = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab.category_value as categoryVal' ,
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
                'category_tab.category_id' , 
                'request_tab.category_id'
            )
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
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
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->leftJoin('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->leftJoin('tagagent_tab' , 'tagagent_tab.request_refid' , '=' , 'request_tab.request_refid')
            ->selectRaw(
                "category_tab.category_value as categoryVal ,
                request_tab.request_refid as refID , 
                request_tab.request_date as requestDate ,
                request_tab.request_done as reqDone ,
                category_tab.category_value as categoryVal , 
                request_tab.request_by as requestBy ,
                section_tab.section_abbre as sectionVal ,
                CONCAT(accounts_tab.account_fname , ' ' ,  accounts_tab.account_lname) as actionOfficer ,
                status_tab.status_value as statusVal
                ")
            ->groupBy(
                'categoryVal' , 
                'category_tab.category_id',
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
            ->leftJoin('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->selectRaw(
                "category_tab.category_value as categoryVal ,
                (SELECT COUNT(*) FROM request_tab 
                LEFT JOIN tagagent_tab ON tagagent_tab.request_refid = request_tab.request_refid
                WHERE request_tab.request_date BETWEEN '".$dateFrom."' AND '".$dateTo."' AND
                request_tab.category_id = category_tab.category_id AND
                $statusWhere
                ) AS requestTaken
                ")
            ->groupBy('categoryVal' , 'category_tab.category_id')
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
            ->get();
            */

            $summary = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->leftJoin('tagagent_tab', 'tagagent_tab.request_refid', '=', 'request_tab.request_refid')
            ->select(
                'category_tab.category_value as categoryVal' ,
                'request_tab.category_id',
                DB::raw("
                    COUNT(DISTINCT CASE 
                            WHEN request_tab.request_date BETWEEN '$dateFrom' AND '$dateTo'
                            AND $statusWhere
                        THEN request_tab.request_refid END) AS requestTaken
                        ")
            )
            ->groupBy('categoryVal' , 'category_tab.category_id' , 'request_tab.category_id')
            ->where('category_tab.agentunit_id' , $agentUnitID)
            ->where('request_tab.status_id' , '<>' , 2)
            ->orderBy('category_tab.category_id')
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
        //->where('deleted' , 0) // uncomment this line if table location_tab has column name -> 'deleted' with default value = 0
        ->get();

        //dd($data);
        return view('officer.location_floor_settings' , compact('data'));
    }

    public function officerDeleteLocation(Request $req){

        $locID = (int)$req->locID;
        dd($locID); // comment this line if table location_tab has column name -> 'deleted' with default value = 0

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

        dd($locID); // comment this line to enable update location

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

        $durationName = strtoupper($req->durationName);
        $durationTime = $req->durationTime;

        dd($durationName);

        DB::table('repairtype_tab')
        ->insert([
            'repairtype_value' => $durationName ,
            'repairtype_time' => $durationTime ,
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

        if(Auth::user()->account_lname == 'DILANTAWI'){
            $agentUnitID = 2;
        }// comment this block when request duration is working or available to public

        $data = DB::table('category_tab')
        ->join('repairtype_tab' , 'repairtype_tab.repairtype_id' , '=' , 'category_tab.repairtype_id')
        ->select('category_tab.category_value as categoryVal' , 'repairtype_tab.repairtype_time as repairTime')
        ->where('agentunit_id' , $agentUnitID)
        ->groupBy('category_tab.category_value' , 'repairtype_tab.repairtype_value' , 'repairtype_tab.repairtype_time')
        ->orderBy('category_tab.category_value')
        ->get();

        $durations = DB::table('repairtype_tab')
        ->select('repairtype_value as repairVal' , 'repairtype_time as repairTime')
        ->orderBy('repairtype_time')
        ->get();

        return view('officer.request_duration_settings' , compact('data' , 'durations'));
    }

}
