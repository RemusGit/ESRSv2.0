<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
require_once(public_path('fpdf_v1.86/fpdf.php'));
use App\Events\NotifyUser;
use Illuminate\Support\Facades\Crypt;


class RequestClientController extends Controller
{
    /* middleware is just better
    public function checkAuth(){
        if(Auth::check() == false){
            return redirect('/logout');
        }
    }*/

        //////////////////////////////////////////////////////////////////// CONDEMN FORM PDF
        public function viewCondemnForm($getRefID){

            $data = DB::table('request_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'request_tab.section_id')
            ->select(
                'request_tab.name_of_equipment as nameOfEq' ,
                'request_tab.serialno as serialNo' , 
                'request_tab.modelno as modelNo' ,
                'request_tab.propertyno as propNo' ,
                'request_tab.request_findings as reqFindings' ,
                'request_tab.request_recommendation as reqRecommend' ,
                'section_tab.section_name as sectionName'
                )
            ->where('request_refid' , $getRefID)
            ->first();

            $signatory = "BILLY LUCENA";

            $pdf = new \FPDF();
            $pdf->AddPage();
            
            $pdf->Image(public_path('images/vmclogo.png'), 20, 10, 20,0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(160, 10);
            $pdf->MultiCell(40,5,"FMT-ICT-008 \nRev 1 - 09/09/14" , 1, 'C' , 0,);


            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 10);
            $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0,1,'Padrigal St., Karuhatan, Valenzuela City' , 0 , 1 , 'C');
            $pdf->Cell(0,10,'Tel. No. 294-67-11, 2945090-ICT' , 0 , 1 , 'C');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0,1,'Information and Communication Technology Unit' , 0 , 1 , 'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 45);
            $pdf->Cell(0,10,'PRE-SERVICE AND EVALUATION REPORT FORM' , 0 , 1 , 'C');


            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(173, 60);
            $pdf->Write(1, Carbon::parse(now())->format('M. d, Y'));
            $pdf->Line(172,63,200,63);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(181, 65);
            $pdf->Write(1, 'Date');


            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(10, 75);
            $pdf->Write(1, 'PRE-SERVICE INFORMATION:');

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(10, 85);
            $pdf->Write(1, $getRefID);

            //////////////////////////////////////////// CONDEMN NAME OF EQUIPMENT
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 95);
            $pdf->Write(1, 'Name of Equipment: ');
            $pdf->Line(50,98,200,98);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(50, 96);
            $pdf->Write(1, $data->nameOfEq);

            //////////////////////////////////////////// CONDEMN SERIAL NO
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 100);
            $pdf->Write(1, 'Serial No: ');
            $pdf->Line(50,103,200,103);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(50, 101);
            $pdf->Write(1, $data->serialNo);

            //////////////////////////////////////////// CONDEMN MODEL NO
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 105);
            $pdf->Write(1, 'Model No: ');
            $pdf->Line(50,108,200,108);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(50, 106);
            $pdf->Write(1, $data->modelNo);

            //////////////////////////////////////////// CONDEMN PROPERTY NO
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 110);
            $pdf->Write(1, 'Property No: ');
            $pdf->Line(50,113,200,113);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(50, 111);
            $pdf->Write(1, $data->propNo);

            //////////////////////////////////////////// CONDEMN ASSIGNMENT / LOCATION
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 115);
            $pdf->Write(1, 'Assignment/Location: ');
            $pdf->Line(50,118,200,118);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(50, 116);
            $pdf->Write(1, $data->sectionName);


            //////////////////////////////////////////// CONDEMN FINDINGS
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(10, 135);
            $pdf->Write(1, 'PRELIMINARY DIAGNOSTIC/FINDINGS:');

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(20, 145);
            $pdf->Write(5, "As per preliminary assessment of the ICT equipment there was a technical problem causing the unit to initiate \nthe following start-up errors/warnings:");

            $pdf->SetFont('Arial', 'BI', 10);
            $pdf->SetXY(10, 160);
            $pdf->Write(5, $data->reqFindings);


            //////////////////////////////////////////// CONDEMN RECOMMENDATION
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(10, 200);
            $pdf->Write(1, 'RECOMMENDATIONS:');

            $pdf->SetFont('Arial', 'BI', 10);
            $pdf->SetXY(10, 205);
            $pdf->Write(5, $data->reqRecommend);


            //////////////////////////////////////////// INSPECTED BY / NOTED BY
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 250);
            $pdf->Write(1, 'Inspected by: ');

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(130, 250);
            $pdf->Write(1, 'Noted by: ');

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(24, 267);
            $pdf->Write(1, 'Signature over Printed Name');
            $pdf->Line(20,265,75,265);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(1, 262);
            $pdf->Cell(95,1, $signatory , 0 , 1 , 'C');


            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(145, 267);
            $pdf->Write(1, 'Signature over Printed Name');
            $pdf->Line(140,265,195,265);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(120, 262);
            $pdf->Cell(95,1, $signatory , 0 , 1 , 'C');


            return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf');

        }
        //////////////////////////////////////////////////////////////////// VMC IDENTIFICATION CARD FORM PDF
        public function vmcCardForm($getRefID){

            //dd(Crypt::decrypt($getRefID));
            $getRefID = Crypt::decrypt($getRefID);
    

            $data = DB::table('idrequest_attach_tab')
            ->join('position_tab' , 'position_tab.position_id' , '=' , 'idrequest_attach_tab.position_id')
            ->join('employstatus_tab' , 'employstatus_tab.employstatus_id' , '=' , 'idrequest_attach_tab.employstatus_id')
            ->join('ph_locations.ph_cities_tab as ph_loc_cities' , 'ph_loc_cities.ctycode' , '=' , 'idrequest_attach_tab.ctycode')
            ->join('ph_locations.ph_brgy_tab as ph_loc_brgy' , 'ph_loc_brgy.bgycode' , '=' , 'idrequest_attach_tab.bgycode')
            ->join('ph_locations.ph_provinces_tab as ph_loc_prov' , 'ph_loc_prov.provcode' , '=' , 'ph_loc_cities.ctyprovcod')
            ->selectRaw("
                idrequest_attach_tab.idrequest_empno as empID ,
                idrequest_attach_tab.idrequest_fname as empFname ,
                idrequest_attach_tab.idrequest_mname as empMname ,
                idrequest_attach_tab.idrequest_lname as empLname ,
                idrequest_attach_tab.idrequest_suffix as empSuffix ,
                idrequest_attach_tab.idrequest_dob as empBday ,
                employstatus_tab.employstatus_val as empStatus ,
                position_tab.position_name as empPosition ,
                idrequest_attach_tab.idrequest_street as addressSt ,
                ph_loc_cities.ctyname as cityName ,
                ph_loc_prov.provname as provName ,
                ph_loc_brgy.bgyname as brgyName ,
                idrequest_attach_tab.idrequest_tinno as tinNo ,
                idrequest_attach_tab.idrequest_gsis as GSIS ,
                idrequest_attach_tab.idrequest_blood as bloodType ,
                idrequest_attach_tab.idrequest_height as empHeight ,
                idrequest_attach_tab.idrequest_weight as empWeight ,
                idrequest_attach_tab.idrequest_picture as empPic ,
                idrequest_attach_tab.idrequest_signature as empSignature ,
                idrequest_attach_tab.idrequest_emerfname as emergencyFname ,
                idrequest_attach_tab.idrequest_emermname as emergencyMname ,
                idrequest_attach_tab.idrequest_emerlname as emergencyLname ,
                idrequest_attach_tab.idrequest_emersuffix as emergencySuffix ,
                idrequest_attach_tab.idrequest_emercontactno as emergencyContactNo ,
                idrequest_attach_tab.idrequest_emerstreet as emergencyStreet ,
                (SELECT ph_locations.ph_cities_tab.ctyname FROM ph_locations.ph_cities_tab 
                WHERE ph_locations.ph_cities_tab.ctycode = idrequest_attach_tab.emerctycode LIMIT 1) as emergencyCityName ,
                (SELECT ph_locations.ph_provinces_tab.provname FROM ph_locations.ph_provinces_tab
                WHERE ph_locations.ph_provinces_tab.provcode = ph_loc_cities.ctyprovcod LIMIT 1) as emergencyProvName ,
                (SELECT ph_locations.ph_brgy_tab.bgyname FROM ph_locations.ph_brgy_tab 
                WHERE ph_locations.ph_brgy_tab.bgycode = idrequest_attach_tab.emerbgycode LIMIT 1) as emergencyBrgyName
            ")
            ->where('idrequest_attach_tab.request_refid' , $getRefID)
            ->first();

            //dd($data);

            $currentEmpID = $data->empID;
            $refID = $getRefID;
            $familyName = $data->empLname;
            $givenName = $data->empFname;
            $middleName = $data->empMname;
            $suffix = $data->empSuffix;
            $empPosition = $data->empPosition;
            $empStatus = $data->empStatus;
            $bday = $data->empBday;
            $empAddress = $data->addressSt . ', ' . $data->cityName . ' (' .$data->provName. '), ' . $data->brgyName;
            $TinNo = $data->tinNo;
            $GsisNo = $data->GSIS;
            $bloodType = $data->bloodType;
            $empHeight = $data->empHeight;
            $empWeight = $data->empWeight;
            $emergencyName = $data->emergencyFname . ' ' . $data->emergencyMname . ' ' . $data->emergencyLname;
            $emergencyContactNo = $data->emergencyContactNo;
            $emergencyAddress = $data->emergencyStreet . ', ' .$data->emergencyCityName . ' (' .$data->emergencyProvName. '), ' . $data->emergencyBrgyName;
            
            $empPic = $data->empPic;
            $empSignature = $data->empSignature;

            $empPic = 'na-pic1.png';
            if($data->empPic != '' || $data->empPic != null){
                $empPic = $data->empPic;
            }
            
            $empSignature = 'na-sig2.png';
            if($data->empSignature != '' || $data->empSignature != null){
                $empSignature = $data->empSignature;
            }

            $pdf = new \FPDF();
            $pdf->AddPage();
            
            $pdf->Image(public_path('images/vmclogo.png'), 20, 10, 20,0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(160, 10);
            $pdf->MultiCell(40,5,"FMT-ICT-008 \nRev 1 - 09/09/14" , 1, 'C' , 0,);


            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 10);
            $pdf->Cell(0,10,'VALENZUELA MEDICAL CENTER' , 0 , 1 , 'C');

            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0,1,'Padrigal St., Karuhatan, Valenzuela City' , 0 , 1 , 'C');
            $pdf->Cell(0,10,'Tel. No. 294-67-11, 2945090-ICT' , 0 , 1 , 'C');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0,1,'Information and Communication Technology Unit' , 0 , 1 , 'C');

            
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 45);
            $pdf->Cell(0,10,'VMC IDENTIFICATION CARD FORM' , 0 , 1 , 'C');

            $pdf->SetFont('Arial', 'BI', 8);
            $pdf->SetXY(10, 65);
            $pdf->Write(1,'"Note: All date must be "PRINTED"');
            $pdf->Line(12,67,57,67);

            // REFERENCE NUMBER
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(170, 65);
            $pdf->Write(2,$refID);

            
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 75);
            $pdf->Write(1,'Current Employee ID No.');
            $pdf->Line(50,77,90,77);

            // CURRENT EMPLOYEE ID NO.
            $pdf->SetXY(70, 70);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(1,10, $currentEmpID , 0 , 1 , 'C');


            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 87);
            $pdf->Write(1,'Name:');
            $pdf->Line(22,89,200,89);

            // FAMILY NAME
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(44, 82);
            $pdf->Cell(1,10, $familyName , 0 , 1 , 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(35, 91);
            $pdf->Write(1,'Family Name');

            // GIVEN NAME
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(94, 82);
            $pdf->Cell(1,10, $givenName , 0 , 1 , 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(85, 91);
            $pdf->Write(1,'Given Name');

            // MIDDLE NAME
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(144, 82);
            $pdf->Cell(1,10, $middleName , 0 , 1 , 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(135, 91);
            $pdf->Write(1,'Middle Name');

            // SUFFIX
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(189, 82);
            $pdf->Cell(1,10, $suffix , 0 , 1 , 'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(185, 91);
            $pdf->Write(1,'Suffix');

            // POSITION
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 102);
            $pdf->Write(1,'Position:');
            $pdf->Line(27,104,158,104);
            $pdf->SetXY(26, 100);
            //$pdf->Cell(1,10, $empPosition .' ('. $empStatus .')' , 0 , 1 , 'L');
            $pdf->MultiCell(130,4, $empPosition .' ('. $empStatus .')' , 0, 'L' , 0,);

            // BIRTHDATE
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(159, 102);
            $pdf->Write(1,'Birth Date:');
            $pdf->Line(177,104,200,104);
            $pdf->SetXY(176, 102);
            $date = Carbon::parse($bday);
            $pdf->Write(1 , $date->format('M. d, Y'));

            // COMPLETE ADDRESS
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 115);
            $pdf->Write(1,'Complete Address: ');
            $pdf->Line(41,117,200,117);
            $pdf->SetXY(40, 115);
            $pdf->Write(1 , $empAddress);

            

            // TIN NO.
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 125);
            $pdf->Write(1,'TIN No.');
            $pdf->Line(23,127,100,127);
            $pdf->SetXY(22 , 125);
            $pdf->Write(1 , $TinNo);

            // GSIS NO.
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(110, 125);
            $pdf->Write(1,'GSIS No.');
            $pdf->Line(128,127,200,127);
            $pdf->SetXY(128 , 125);
            $pdf->Write(1 , $GsisNo);

            // BLOOD TYPE
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 135);
            $pdf->Write(1,'Blood Type:');
            $pdf->Line(30,137,80,137);
            $pdf->SetXY(30 , 135);
            $pdf->Write(1 , $bloodType);

            // HEIGHT
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(85, 135);
            $pdf->Write(1,'Height:');
            $pdf->Line(98,137,130,137);
            $pdf->SetXY(98 , 135);
            $pdf->Write(1 , $empHeight);

            // WEIGHT
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(135, 135);
            $pdf->Write(1,'Weight: (kgs.)');
            $pdf->Line(160,137,200,137);
            $pdf->SetXY(160 , 135);
            $pdf->Write(1 , $empWeight);

            // EMERGENCY CONTACT PERSON
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 145);
            $pdf->Write(1,'In case of emergency, person to notify:');
            $pdf->Line(71,147,200,147);
            $pdf->SetXY(70 , 145);
            $pdf->Write(1 , $emergencyName);


            // EMERGENCY CONTACT NUMBER
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(135, 155);
            $pdf->Write(1,'Contact No.');
            $pdf->Line(155,157,200,157);
            $pdf->SetXY(155 , 155);
            $pdf->Write(1 , $emergencyContactNo);


            // EMERGENCY ADDRESS
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 155);
            $pdf->Write(1,'Address:');
            $pdf->Line(25,157,130,157);
            $pdf->SetXY(24 , 151);
            $pdf->MultiCell(125,8, $emergencyAddress , 0, 'L' , 0,);

            $pdf->Line(25,165,200,165);

            // SIGNATURE BOX
            $pdf->SetXY(10, 175);
            $pdf->Cell(110,50, ' ' , 1 , 1 , 'C');
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetXY(10, 228);
            $pdf->Write(1,"Please sign inside the box (Note: do not exceed on the line)");

            //TEMP SOLUTION IF FILE NOT EXIST (LARAVEL'S STORAGE::EXIST DOES NOT WORK)
            try {
                $pdf->Image(public_path('uploads/VMC_ID_Sig/'.$empSignature), 31, 185, 68,0);
            } catch (\Throwable $th) {
                $pdf->Image(public_path('uploads/VMC_ID_Sig/na-sig2.png'), 31, 185, 68,0);
            }
              
            $pdf->SetFont('Arial', 'BI', 11);
            $pdf->SetXY(50, 233);
            $pdf->Write(1,"(Black ink only)");

            // EMPLOYEE PICTURE
            $pdf->SetXY(130, 175);
            $pdf->Cell(70,80, ' ' , 1 , 1 , 'C');
            $pdf->SetFont('Arial', 'BI', 11);
            $pdf->SetXY(115, 260);
            $pdf->MultiCell(100,5,"Passport size colored picture with \n white background" , 0, 'C' , 0,);     
            
            //TEMP SOLUTION IF FILE NOT EXIST (LARAVEL'S STORAGE::EXIST DOES NOT WORK)
            try {
                $pdf->Image(public_path('uploads/VMC_ID_Picture/'.$empPic),131, 178, 68,0);  
            } catch (\Throwable $th) {
                $pdf->Image(public_path('uploads/VMC_ID_Picture/na-pic1.png'),131, 178, 68,0);  
            }

            return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf');
        }
        
        //////////////////////////////////////////////////////////////////// CLIENT LIST FILTER
        public function viewClientRequest($getStatusID , $getRefNo , $getDateFrom , $getDateTo){

        $getUserID = session('account_empid');

            $sql = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->join('agentunit_tab' , 'agentunit_tab.agentunit_id' , '=' , 'request_tab.agentunit_id')
            ->leftJoin('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->selectRaw("
                        request_tab.request_by as requestBy , 
                        request_tab.agentunit_id as agentUnitID , 
                        request_tab.request_refid as refID , 
                        request_tab.category_id as categoryId , 
                        category_tab.category_value categoryVal ,
                        request_tab.request_descript reqDesc , 
                        request_tab.request_date as reqDate ,
                        request_tab.request_duration as reqDuration ,
                        request_tab.request_acknowledged as reqAcknowledge ,
                        status_tab.status_value as statusVal ,
                        agentunit_tab.agentunit_abbre as agentAbbre ,
                        request_tab.request_condemn as reqCondemn , 
                        CONCAT( accounts_tab.account_fname , ' ' , accounts_tab.account_lname ) as actionOfficer
            ")
            ->where('request_tab.account_id' , $getUserID)
            ->where('request_tab.status_id' , $getStatusID)
            ->where('request_tab.request_refid' , 'LIKE' , '%'.  $getRefNo . '%')
            ->groupBy('refID' , 
            'requestBy' ,
            'agentUnitID' ,
            'categoryId' ,
            'categoryVal' , 
            'reqDesc' , 
            'reqDate' , 
            'reqDuration' , 
            'reqAcknowledge' , 
            'statusVal' , 
            'agentAbbre' , 
            'actionOfficer',
            'reqCondemn'
            )
            ->orderBy('request_tab.request_date' , 'DESC');


            if($getDateFrom != null || $getDateTo != null){

                $getDateTo = Carbon::parse($getDateTo)->addDays(1); 
                $sql->whereBetween('request_tab.request_date' , [$getDateFrom ,$getDateTo]);
            }

            $data = $sql->get();

        return $data;
    }

    //////////////////////////////////////////////////////////////////// CLIENT LIST SHOW OPEN
    public function clientOpen(Request $req){

        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;

        $data = $this->viewClientRequest(2 , $getRefNo , $getDateFrom , $getDateTo); // open
        
        /* THIS APPROACH IS GOOD BUT MIDDLEWARE IS BETTER
        if(Auth::check()){
            return view('client.client_my_request' , compact('data'))->with('getStatus' , 2);
        }
        else{
            return redirect('/logout');
        }*/

        return view('client.client_my_request' , compact('data') , ['oldData' => $req->all()])->with('getStatus' , 2);
        
    }

    //////////////////////////////////////////////////////////////////// CLIENT LIST SHOW IN-PROGRESS
    public function clientInprogress(Request $req){

        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;
        //$this->checkAuth();
        $data = $this->viewClientRequest(5, $getRefNo , $getDateFrom , $getDateTo); //in progress

        return view('client.client_my_request' , compact('data'), ['oldData' => $req->all()])->with('getStatus' , 5);
    }

    //////////////////////////////////////////////////////////////////// CLIENT LIST SHOW ACKNOWLEDGE
    public function clientAcknowledge(Request $req){

        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;

        //$this->checkAuth();
        $data = $this->viewClientRequest(8, $getRefNo , $getDateFrom , $getDateTo); //acknowledge
        
        return view('client.client_my_request' , compact('data'), ['oldData' => $req->all()])->with('getStatus' , 8);
    }

    //////////////////////////////////////////////////////////////////// CLIENT LIST SHOW COMPLETED
    public function clientCompleted(Request $req){

        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;

        //$this->checkAuth();
        $data = $this->viewClientRequest(6, $getRefNo , $getDateFrom , $getDateTo); //completed

        return view('client.client_my_request' , compact('data'), ['oldData' => $req->all()])->with('getStatus' , 6);
    }

    //////////////////////////////////////////////////////////////////// CLIENT LIST SHOW CANCELLED
    public function clientCancelled(Request $req){

        $getRefNo = $req->refNo;
        $getDateFrom = $req->reqDateFrom;
        $getDateTo = $req->reqDateTo;

        //$this->checkAuth();
        $data = $this->viewClientRequest(7, $getRefNo , $getDateFrom , $getDateTo); //cancelled

        return view('client.client_my_request' , compact('data'), ['oldData' => $req->all()])->with('getStatus' , 7);
    }


    //////////////////////////////////////////////////////////////////// AJAX SHOW UPDATE
    public function ajaxShowUpdate(Request $req){
   
        $refID = $req->input('refID');
        $data = DB::table('editrequest_tab')
        ->join('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'editrequest_tab.account_id')
        ->selectRaw("
        editrequest_tab.editreq_details as updateDetails ,
        CONCAT(accounts_tab.account_fname , ' ' , accounts_tab.account_lname) as updatedBy ,
        editrequest_tab.editreq_datetime as dateTime
        ")
        ->where('request_refid' , $refID)
        ->get();
        
        return json_encode($data);

    }

    //////////////////////////////////////////////////////////////////// AJAX SHOW ACTION
    public function ajaxShowAction(Request $req){

        $refID = $req->input('refID');
        $data = DB::table('actiontaken_tab')
        ->where('request_refid' , $refID)
        ->orderBy('action_datetime' , 'DESC')
        ->get();

        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// VIEW ATTACHMENTS
    public function viewAttachment(Request $req){

        $refID = $req->input('refID');

        $categoryVal = $req->input('categoryVal');

        if($categoryVal == 'Travel Conduction'){

            $data = DB::table('travel_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'travel_attach_tab.section_id')
            ->select(
                'travel_attach_tab.request_refid' ,
                'travel_attach_tab.travel_destination' ,
                'travel_attach_tab.travel_purpose' ,
                'travel_attach_tab.travel_date' ,
                'travel_attach_tab.travel_time' ,
                'section_tab.section_name as sectionName'
                )
            ->where('request_refid' , $refID)
            ->get();
        }

        if($categoryVal == 'VMC ID Card Preparation'){

            $data = DB::table('idrequest_attach_tab')
            ->join('position_tab' , 'position_tab.position_id' , '=' , 'idrequest_attach_tab.position_id')
            ->join('employstatus_tab' , 'employstatus_tab.employstatus_id' , '=' , 'idrequest_attach_tab.employstatus_id')
            ->join('ph_locations.ph_cities_tab as ph_loc_cities' , 'ph_loc_cities.ctycode' , '=' , 'idrequest_attach_tab.ctycode')
            ->join('ph_locations.ph_brgy_tab as ph_loc_brgy' , 'ph_loc_brgy.bgycode' , '=' , 'idrequest_attach_tab.bgycode')
            ->join('ph_locations.ph_provinces_tab as ph_loc_prov' , 'ph_loc_prov.provcode' , '=' , 'ph_loc_cities.ctyprovcod')
            ->selectRaw("
                idrequest_attach_tab.idrequest_empno as empID ,
                idrequest_attach_tab.idrequest_fname as empFname ,
                idrequest_attach_tab.idrequest_mname as empMname ,
                idrequest_attach_tab.idrequest_lname as empLname ,
                idrequest_attach_tab.idrequest_suffix as empSuffix ,
                idrequest_attach_tab.idrequest_dob as empBday ,
                employstatus_tab.employstatus_val as empPosition ,
                idrequest_attach_tab.idrequest_street as addressSt ,
                ph_loc_cities.ctyname as cityName ,
                ph_loc_prov.provname as provName ,
                ph_loc_brgy.bgyname as brgyName ,
                idrequest_attach_tab.idrequest_tinno as tinNo ,
                idrequest_attach_tab.idrequest_gsis as GSIS ,
                idrequest_attach_tab.idrequest_blood as bloodType ,
                idrequest_attach_tab.idrequest_height as empHeight ,
                idrequest_attach_tab.idrequest_weight as empWeight ,
                idrequest_attach_tab.idrequest_picture as empPic ,
                idrequest_attach_tab.idrequest_emerfname as emergencyFname ,
                idrequest_attach_tab.idrequest_emermname as emergencyMname ,
                idrequest_attach_tab.idrequest_emerlname as emergencyLname ,
                idrequest_attach_tab.idrequest_emersuffix as emergencySuffix ,
                idrequest_attach_tab.idrequest_emercontactno as emergencyContactNo ,
                idrequest_attach_tab.idrequest_emerstreet as emergencyStreet ,
                (SELECT ph_locations.ph_cities_tab.ctyname FROM ph_locations.ph_cities_tab 
                WHERE ph_locations.ph_cities_tab.ctycode = idrequest_attach_tab.emerctycode LIMIT 1) as emergencyCityName ,
                (SELECT ph_locations.ph_provinces_tab.provname FROM ph_locations.ph_provinces_tab
                WHERE ph_locations.ph_provinces_tab.provcode = ph_loc_cities.ctyprovcod LIMIT 1) as emergencyProvName ,
                (SELECT ph_locations.ph_brgy_tab.bgyname FROM ph_locations.ph_brgy_tab 
                WHERE ph_locations.ph_brgy_tab.bgycode = idrequest_attach_tab.emerbgycode LIMIT 1) as emergencyBrgyName
            ")
            ->where('idrequest_attach_tab.request_refid' , $refID)
            ->get();

        }
       
        if($categoryVal == 'Biometrics Enrollment'){

            $data = DB::table('biometric_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'biometric_attach_tab.section_id')
            ->join('position_tab' , 'position_tab.position_id' , '=' , 'biometric_attach_tab.position_id')
            ->join('employstatus_tab' , 'employstatus_tab.employstatus_id' , '=' , 'biometric_attach_tab.employstatus_id')
            ->selectRaw("
                biometric_attach_tab.biometric_fname as firstName , 
                biometric_attach_tab.biometric_mname as middleName ,
                biometric_attach_tab.biometric_lname as lastName , 
                biometric_attach_tab.biometric_suffix as suffix ,
                biometric_attach_tab.biometric_curridno as currentID ,
                section_tab.section_name as sectionName ,
                position_tab.position_name as positionName ,
                employstatus_tab.employstatus_val as employmentStatus
            ")
            ->where('request_refid', $refID)
            ->get();

        }//EOF BIOMETRICS

         if($categoryVal == 'HOMIS Encoding Error'){

            $data = DB::table('ihomiserror_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'ihomiserror_attach_tab.section_id')
            ->selectRaw("
                section_tab.section_name as sectionName ,
                ihomiserror_attach_tab.ihomiserror_hospitalno as hospitalNo ,
                ihomiserror_attach_tab.ihomiserror_patfname as patientFname ,
                ihomiserror_attach_tab.ihomiserror_patmname as patientMname ,
                ihomiserror_attach_tab.ihomiserror_patlname as patientLname ,
                ihomiserror_attach_tab.ihomiserror_patsuffix as patientSuffix ,
                ihomiserror_attach_tab.ihomiserror_encodeerror as encodeError ,
                ihomiserror_attach_tab.ihomiserror_encodecorr as encodeCorrect ,
                ihomiserror_attach_tab.ihomiserror_encodedby as encodedBy
            ")
            ->where('request_refid', $refID)
            ->get();

        }//EOF HOMIS ENCODING ERROR

        if($categoryVal == 'Network Installation / Internet Connection / Cable Transfer'){

            $data = DB::table('networkconn_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'networkconn_attach_tab.section_id')
            ->join('connectiontype_tab' , 'connectiontype_tab.connectiontype_id' , '=' , 'networkconn_attach_tab.connectiontype_id')
            ->selectRaw("
                section_tab.section_name as sectionName ,
                connectiontype_tab.connectiontype_value as connectionVal ,
                networkconn_attach_tab.networkconn_desc as networkDesc
            ")
            ->where('request_refid', $refID)
            ->get();

        }//EOF NETWORK INSTALLATION


        if($categoryVal == 'Zoom Link'){

            $data = DB::table('virtualmeet_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'virtualmeet_attach_tab.section_id')
            ->selectRaw("
                section_tab.section_name as sectionName ,
                virtualmeet_attach_tab.virtualmeet_title as vmTile , 
                virtualmeet_attach_tab.virtualmeet_date as vmDate , 
                virtualmeet_attach_tab.virtualmeet_time as vmTime , 
                virtualmeet_attach_tab.virtualmeet_partno as vmParticipants ,
                virtualmeet_attach_tab.virtualmeet_hours as vmHrs , 
                virtualmeet_attach_tab.virtualmeet_email as vmEmail
            ")
            ->where('request_refid', $refID)
            ->get();

        }//EOF ZOOM LINK


        if($categoryVal == 'Website Uploads'){

            $data = DB::table('websiteupload_attach_tab')
            ->join('section_tab' , 'section_tab.section_id' , '=' , 'websiteupload_attach_tab.section_id')
            ->selectRaw("
                section_tab.section_name as sectionName ,
                websiteupload_attach_tab.websiteupload_details as webDetails
            ")
            ->where('request_refid', $refID)
            ->get();
            
        }//EOF WEBSITE UPLOADS


        if($categoryVal == 'System Enhancement / Modification / Homis / Other Installation'){

            $data = DB::table('sysmodi_attach_tab')
            ->join('vmcsystem_tab' , 'vmcsystem_tab.vmcsystem_id' , '=' , 'sysmodi_attach_tab.vmcsystem_id')
            ->selectRaw("
                sysmodi_attach_tab.modify_details as modDetails ,
                vmcsystem_tab.vmcsystem_value as modVmcVal
            ")
            ->where('request_refid', $refID)
            ->get();

        }//EOF SYSTEM MODIFICATION

        return json_encode($data);
    }

    public function clientCancelRequest(Request $req){

        //dd($req->getRefID);
        DB::table('request_tab')
        ->where('request_refid', $req->getRefID)
        ->delete();

        $generateRefNo = $req->getRefID;
        $agentUnitID = $req->agentUnitID;
        $requestDate = $req->requestDate;
        $categoryID = $req->categoryID;
        $requestBy = $req->requestBy;
        
        $this->notifFromClient($agentUnitID , $requestDate , $generateRefNo , $categoryID , $requestBy , 'CLIENT HAS CANCELLED THE REQUEST!');

        return back();
    }

    //////////////////////////////////////////////////////////////////// LOAD SECTION
    public function loadSection(){

        $data = DB::table('section_tab')->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD DESIGNATION / POSITION
    public function loadDesignation(){

        $data = DB::table('position_tab')->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD EMPLOYMENT STATUS
    public function loadEmpStatus(){

        $data = DB::table('employstatus_tab')->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD LOCATION
    public function loadLocation(){

        $data = DB::table('location_tab')
        //->where('deleted' , 0)
        ->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD FLOOR DEPENDS ON SELECTED BUILDING
    public function loadFloor(Request $req){

        $getBuildingID = $req->buildingID;
        $data = DB::table('bldgfloor_tab')
        ->where('location_id' , $getBuildingID)
        ->orderBy('bldgfloor_abbre')
        ->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD ALL CITIES
    public function loadCity(){

        $data = DB::connection('mysql_ph_location')
        ->table('ph_cities_tab')
        ->select('ph_cities_tab.ctycode as cityCode' , 'ph_cities_tab.ctyname as cityName' , 'ph_provinces_tab.provname as provinceName')
        ->join('ph_provinces_tab' , 'ph_provinces_tab.provcode' , '=' , 'ph_cities_tab.ctyprovcod')
        ->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD BARANGAY DEPENDS ON SELECTED CITY
    public function loadBarangay(Request $req){

        $getCityCode = $req->getCityCode;

        $data = DB::connection('mysql_ph_location')
        ->table('ph_brgy_tab')
        ->select('bgycode as barangayCode' , 'bgyname as barangayName')
        ->where('bgymuncod' , $getCityCode)
        ->get();
         return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// OFFICER - INPROGRESS UPDATE CATEGORY
    public function officerUpdateCategory(Request $req){

        $accountID = session("account_empid");
        $sectionID = session('section_id');

        $refID = $req->getRefID;
        $newCategoryID = $req->newCategoryValId;
        $newCategoryText = $req->newCategoryValText;
        $getRequestDate = $req->getRequestDate;

        //////////////////////////////////////////////////// UPDATE CATEGORY - TRAVEL CONDUCTION
        if($newCategoryText == 'Travel Conduction'){

            DB::table('travel_attach_tab')
            ->insert([
                'request_refid' => $refID,
                'travel_destination' => $req->EfmsTcDestination,
                'travel_purpose' => $req->EfmsTcPurpose,
                'travel_date' => $req->EfmsTcDate,
                'travel_time' => $req->EfmsTcTime,
                'section_id' => $sectionID,
            ]); 
        }

        //////////////////////////////////////////////////// UPDATE CATEGORY - BIOMETRICS ENROLLMENT 
        if($newCategoryText == 'Biometrics Enrollment'){

            $bioFirstname = strtoupper($req->bioFname);
            $bioMidname = strtoupper($req->bioMname);
            $bioLastname = strtoupper($req->bioLname);
            $bioSuffix = strtoupper($req->bioSuffix);
            $bioCurrentID = $req->bioCurrentIDNo;
            $positionID = $req->bioDesignation;
            $employmentStatus = $req->bioEmpStatus;
            $bioSectionID = $req->bioSection;

            DB::table('biometric_attach_tab')
            ->insert([
                'request_refid' => $refID ,
                'biometric_fname' => $bioFirstname ,
                'biometric_mname' => $bioMidname ,
                'biometric_lname' => $bioLastname ,
                'biometric_suffix' => $bioSuffix ,
                'biometric_curridno' => $bioCurrentID ,
                'section_id' => $bioSectionID ,
                'position_id' => $positionID ,
                'employstatus_id' => $employmentStatus
            ]);
        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - HOMIS ENCODE ERROR
        if($newCategoryText == 'HOMIS Encoding Error'){

            $hospitalNo = $req->homisHospitalNo;
            $homisFname = strtoupper($req->homisFname);
            $homisMname = strtoupper($req->homisMName);
            $homisLname = strtoupper($req->homisLName);
            $homisSuffix = strtoupper($req->homisSuffix);
            $encodedBy = strtoupper($req->homisEncodedBy);
            $encodeError = $req->homisEncodingError;
            $encodeCorrectDetails = $req->homisCorrectDetails;

            DB::table('ihomiserror_attach_tab')
            ->insert([
                'request_refid' => $refID ,
                'ihomiserror_hospitalno' => $hospitalNo,
                'ihomiserror_patfname' => $homisFname ,
                'ihomiserror_patmname' => $homisMname ,
                'ihomiserror_patlname' => $homisLname ,
                'ihomiserror_patsuffix' => $homisSuffix ,
                'ihomiserror_encodedby' => $encodedBy ,
                'ihomiserror_encodeerror' => $encodeError ,
                'ihomiserror_encodecorr' => $encodeCorrectDetails ,
                'section_id' => $sectionID
            ]);
        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - SYSTEM ENHANCEMENT / MODIFY
        if($newCategoryText == 'System Enhancement / Modification / Homis / Other Installation'){

            $systemEnhanceSelectSystem = $req->systemEnhanceSelectSystem;
            $systemEnhanceRequestDetails = $req->systemEnhanceRequestDetails;

            DB::table('sysmodi_attach_tab')
            ->insert([
                'request_refid' => $refID ,
                'vmcsystem_id' => $systemEnhanceSelectSystem ,
                'modify_details' => $systemEnhanceRequestDetails
            ]);
        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - VMC CARD ID PREPARATION
        if($newCategoryText == 'VMC ID Card Preparation'){

                $requestRefID = $refID;

                $idrequest_empno = $req->idrequest_empno;
                $position_id = $req->position_id;
                $employstatus_id = $req->employstatus_id;
                $idrequest_fname = strtoupper($req->idrequest_fname);
                $idrequest_mname = strtoupper($req->idrequest_mname);
                $idrequest_lname = strtoupper($req->idrequest_lname);
                $idrequest_suffix = $req->idrequest_suffix;
                $idrequest_dob = $req->idrequest_dob;
                $idrequest_street = strtoupper($req->idrequest_street);
                $ctycode = $req->ctycode;
                $bgycode = $req->bgycode;
                $idrequest_tinno = $req->idrequest_tinno;
                $idrequest_gsis = $req->idrequest_gsis;
                $idrequest_blood = $req->idrequest_blood;
                $idrequest_height = $req->idrequest_height;
                $idrequest_weight = $req->idrequest_weight;
                $idrequest_emerfname = strtoupper($req->idrequest_emerfname);
                $idrequest_emermname = strtoupper($req->idrequest_emermname);
                $idrequest_emerlname = strtoupper($req->idrequest_emerlname);
                $idrequest_emersuffix = $req->idrequest_emersuffix;
                $idrequest_emercontactno = $req->idrequest_emercontactno;
                $idrequest_emerstreet = strtoupper($req->idrequest_emerstreet);
                $emerctycode = $req->emerctycode;
                $emerbgycode = $req->emerbgycode;


                // CHANGE PICTURE FILENAME TO REFERENCE NUMBER
                $vmcIdCardPicture = $req->file('idrequest_picture');
                $getPictureExtension = $vmcIdCardPicture->extension();
                $vmcIdCardPicFilename = $requestRefID.'.'.$getPictureExtension;

                // CREATE FOLDER/PATH IF NOT EXIST
                if (!file_exists(public_path('uploads/VMC_ID_Picture'))) {
                    mkdir(public_path('uploads/VMC_ID_Picture'), 0775, true);
                }

                // MOVE PICTURE TO public/uploads/VMC_ID_Picture
                $vmcIdCardPicture->move(public_path('uploads/VMC_ID_Picture'), $vmcIdCardPicFilename);

                // CHANGE SIGNATURE FILENAME TO REFERENCE NUMBER
                $vmcIdCardSignature = $req->file('idrequest_signature');
                $getSignatureExtension = $vmcIdCardSignature->extension();
                $vmcIdCardSignatureFilename = $requestRefID.'.'.$getSignatureExtension;

                // CREATE FOLDER/PATH IF NOT EXIST
                if (!file_exists(public_path('uploads/VMC_ID_Sig'))) {
                    mkdir(public_path('uploads/VMC_ID_Sig'), 0775, true);
                }

                // MOVE PICTURE TO public/uploads/VMC_ID_Picture/VMC_ID_Sig
                $vmcIdCardSignature->move(public_path('uploads/VMC_ID_Sig'), $vmcIdCardSignatureFilename);

                DB::table('idrequest_attach_tab')
                ->insert([
                    'request_refid' => $requestRefID,
                    'idrequest_empno' => $idrequest_empno ,
                    'position_id' => $position_id ,
                    'employstatus_id' => $employstatus_id,
                    'idrequest_fname' => $idrequest_fname,
                    'idrequest_mname' => $idrequest_mname,
                    'idrequest_lname' => $idrequest_lname,
                    'idrequest_suffix' => $idrequest_suffix,
                    'idrequest_dob' => $idrequest_dob,
                    'idrequest_street' => $idrequest_street,
                    'ctycode' => $ctycode,
                    'bgycode' => $bgycode,
                    'idrequest_tinno' => $idrequest_tinno,
                    'idrequest_gsis' => $idrequest_gsis ,
                    'idrequest_blood' => $idrequest_blood,
                    'idrequest_height' => $idrequest_height,
                    'idrequest_weight' => $idrequest_weight,
                    'idrequest_emerfname' => $idrequest_emerfname,
                    'idrequest_emermname' => $idrequest_emermname,
                    'idrequest_emerlname' => $idrequest_emerlname,
                    'idrequest_emersuffix' => $idrequest_emersuffix,
                    'idrequest_emercontactno' => $idrequest_emercontactno,
                    'idrequest_emerstreet' => $idrequest_emerstreet,
                    'emerctycode' => $emerctycode,
                    'emerbgycode' => $emerbgycode,
                    'idrequest_picture' => $vmcIdCardPicFilename,
                    'idrequest_signature' => $vmcIdCardSignatureFilename
                ]);  

        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - WEB UPLOADS
        if($newCategoryText == 'Website Uploads'){

            $webUploadDetails = $req->webUploadDetails;

                $file = $req->file('webUploadFile');

                // Optional: unique name
                $filename = time() . '_' . $file->getClientOriginalName();

                $webUploadPath = 'uploads/Web_Upload';
                // Ensure public/uploads exists
                if (!file_exists(public_path($webUploadPath))) {
                    mkdir(public_path($webUploadPath), 0775, true);
                }

                //Move the uploaded file to public/uploads
                $file->move(public_path($webUploadPath), $filename);

                //Path to the zip file inside public/uploads
                $zipPath = public_path($webUploadPath.'/'.$refID.'.zip');

                // Initialize ZipArchive
                $zip = new ZipArchive;
                if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                    //Add the uploaded file into the zip
                    $zip->addFile(public_path($webUploadPath .'/' . $filename), $filename);
                    $zip->close();
                }

                // (Optional) delete original uploaded file
                unlink(public_path($webUploadPath .'/' . $filename));

                DB::table('websiteupload_attach_tab')
                ->insert([
                    'request_refid' => $refID ,
                    'websiteupload_details' => $webUploadDetails  ,
                    'section_id' => $sectionID
                ]);

        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - ZOOM LINK
        if($newCategoryText == 'Zoom Link'){

            $zoomTitle = $req->zoomTitle;
            $zoomDate = $req->zoomDate;
            $zoomTime = $req->zoomTime;
            $zoomParticipants = $req->zoomParticipants;
            $zoomDuration = $req->zoomDuration;
            $zoomEmail = $req->zoomEmail;

            DB::table('virtualmeet_attach_tab')
            ->insert([
                'request_refid' => $refID ,
                'virtualmeet_title' => $zoomTitle ,
                'virtualmeet_date' => $zoomDate ,
                'virtualmeet_time' => $zoomTime ,
                'virtualmeet_partno' => $zoomParticipants ,
                'virtualmeet_hours' => $zoomDuration ,
                'virtualmeet_email' => $zoomEmail ,
                'section_id' => $sectionID
            ]);
        }
        //////////////////////////////////////////////////// UPDATE CATEGORY - NETWORK INSTALLATION
        if($newCategoryText == 'Network Installation / Internet Connection / Cable Transfer'){

            $networkInstallConnectionType = $req->networkInstallConnectionType;
            $networkInstallRequestDetails = $req->networkInstallRequestDetails;

            DB::table('networkconn_attach_tab')
            ->insert([
                'request_refid' => $refID ,
                'connectiontype_id' => $networkInstallConnectionType ,
                'networkconn_desc' => $networkInstallRequestDetails ,
                'section_id' => $sectionID
            ]);
        }

        $currentCategoryText = $req->currentCategoryVal;
        $editReqDetails = "Category was changed from ".$currentCategoryText." to ".$newCategoryText;

        // GET REPAIR ID TO CALCULATE REQUEST DURATION
        $getRepairID = DB::table('category_tab')
        ->where('category_id' , $newCategoryID)
        ->first();
        $repairTypeID = $getRepairID->repairtype_id;

        $requestDuration = $this->calculateRequestDuration($newCategoryID , $repairTypeID , $getRequestDate);

        // INSERT TO EDIT REQUEST TAB
        DB::table('editrequest_tab')
        ->insert([
            'request_refid' => $refID,
            'editreq_details' => $editReqDetails,
            'account_id' => $accountID,
            'editreq_datetime' => now()
        ]);

        // UPDATE REQUEST TAB TABLE
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'category_id' => $newCategoryID ,
            'repairtype_id' => $repairTypeID ,
            'request_duration' => $requestDuration
        ]);

        // TABLE DELETION IF CATEGORY IS LISTED BELOW
        if($currentCategoryText == 'Biometrics Enrollment'){ // BIOMETRICS DELETE

            DB::table('biometric_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'HOMIS Encoding Error'){ // HOMIS DELETE

            DB::table('ihomiserror_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'Network Installation / Internet Connection / Cable Transfer'){ // NETWORK INSTALL DELETE

            DB::table('networkconn_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'System Enhancement / Modification'){ // SYSTEM ENHANCE DELETE

            DB::table('sysmodi_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'VMC ID Card Preparation'){ // VMC ID CARD DELETE

            DB::table('idrequest_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'Website Uploads'){ // WEBSITE UPLOADS DELETE

            DB::table('websiteupload_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'Zoom Link'){ // ZOOM LINK DELETE

            DB::table('virtualmeet_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }
        if($currentCategoryText == 'Travel Conduction'){ // TRAVEL CONDUCTION DELETE

            DB::table('travel_attach_tab')
            ->where('request_refid' , $refID)
            ->delete();
        }


        ///////////////////////////////////////////////////////////// UPDATE CATEGORY NOTIFICATION
        $officerFullname = Auth::user()->account_fname.' '.Auth::user()->account_lname;

        $updateRequestMsg = "REQUEST CATEGORY UPDATED! <br> 
        From: ".$currentCategoryText."<br>
        To: ".$newCategoryText."<br>
        Action Officer: ".$officerFullname. "<br>
        Timestamp: ".date('M. d, Y - h:i A' , strtotime(now())). "<br>
        Reference No. : <a href='/client_inprogress_request'>".$refID. "</a>";

        $data = DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->select('account_id')
        ->first();
        $accountEmpId = $data->account_id;

        broadcast(new NotifyUser($accountEmpId , $updateRequestMsg))->toOthers();

        return back();
    }

     /////////////////////////////////////////////////////////////////////////////////////// CHECK HOLIDAY.TXT
    public function checkHoliday($requestDuration){

        $path = public_path('holiday.txt'); 
        $convertDate = date('Y-M-d',strtotime($requestDuration));

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            list($getDate , $getDay , $getHoliday) = explode("\t" , $line);
            $getDate = date('Y-M-d' , strtotime($getDate));

            if($convertDate == $getDate){
                $requestDuration = $requestDuration->addDays(1);
                $convertDate = date('Y-M-d',strtotime($requestDuration));
            }
        }

        // GET NAME OF THE DAY
        $getNameOfDay = $requestDuration->format('l');

        if($getNameOfDay == 'Saturday'){
            $requestDuration = $requestDuration->addDays(2);
        }
        if($getNameOfDay == 'Sunday'){
             $requestDuration = $requestDuration->addDays(1);
        }

        return $requestDuration;
    }

    //////////////////////////////////////// CALCULATE REQUEST DURATION BASED ON REPAIR ID
    public function calculateRequestDuration($categoryID , $repairTypeID , $getRequestDate){

        $getRepairTime = DB::table('repairtype_tab')
        ->where('repairtype_id' , $repairTypeID)
        ->first();
        $repairTime = $getRepairTime->repairtype_time;

        list($hour, $minute, $second) = explode(':', $repairTime);
        $hour = (int)$hour;

        if($getRequestDate == null){
            $requestDuration = now();
        }else{
            $requestDuration = Carbon::parse($getRequestDate);
        }

        //GET NAME OF THE DAY
        $getNameOfDay = $requestDuration->format('l');

        $getHour = $requestDuration->hour;
        $getMinutes = $requestDuration->minute;
        $currentHourMinutes = (int)$getHour + ((float)$getMinutes * 0.01);

        $hourToDay = $hour / 24;
        if($hour >= 24){

            for($i = 1; $i <= $hourToDay; $i++){

                if($getNameOfDay == 'Friday'){
                    $requestDuration->addDays(2);
                }
                else{
                    $requestDuration->addDays(1);
                }
                // CHECK HOLIDAY
                $requestDuration = $this->checkHoliday($requestDuration);
                $getNameOfDay = $requestDuration->format('l');
            }

        }elseif($hour == 4){

            if($currentHourMinutes > 13){

                if($getNameOfDay == 'Friday'){
                    $requestDuration->addDays(2);
                }else{
                    $requestDuration->addHours(15); // reset to 8am the next day
                }
                $requestDuration->addHours($hour);
            }
            else{
                $requestDuration->addHours($hour);
            }
            // CHECK HOLIDAY
            $requestDuration = $this->checkHoliday($requestDuration);
        }
        else{
            $requestDuration = null;
        }
        
        return $requestDuration;
    }

    //////////////////////////////////////////////////////////////////// GENERATE REFERENCE ID + REQUEST DURATION
    public function generateRefID(Request $req){

        $categoryID = $req->categoryID;
        $getAgentUnitID = $req->agentUnitID;


        // GET REPAIR ID TO CALCULATE REQUEST DURATION
        $getRepairID = DB::table('category_tab')
        ->where('category_id' , $categoryID)
        ->first();
        $repairTypeID = $getRepairID->repairtype_id;

        $sql = DB::table('request_tab')
        ->select('request_refid');
        
        if($getAgentUnitID == 1){ // IF REQUEST IS UNDER EFMS
            $sql->where('request_refid' , 'NOT LIKE' , '%IMISS%');
        }
        if($getAgentUnitID == 2){ // IF REQUEST IS UNDER  IMISS
            $sql->where('request_refid' , 'LIKE' , '%IMISS%');
        }
        
        $getLastData = $sql->orderBy('request_date' , 'DESC')->first();

        //dd($getLastData->request_refid);

        $result = $getLastData->request_refid;
        $generateRefNo = "";
        if($getAgentUnitID == 1){ //GENERATE REF ID BASED ON CURRENT YEAR + LAST RECORD FOR EFMS

            $efmsCategoryInitials = $req->getEfmsInitials; // GET FROM FORM

            $lastRefNo = substr($result , 6 , strlen($result));
            $lastRefNo = preg_replace("/[^0-9]/", "", $lastRefNo); // GET NUMBER ONLY FROM STRING
            $lastRefNo = $lastRefNo + 1;
            $generateRefNo = date('y').'-'.date('m').'-'.$lastRefNo.' '.$efmsCategoryInitials; 
        }
        if($getAgentUnitID == 2){ //GENERATE REF ID BASED ON CURRENT YEAR + LAST RECORD FOR IMISS

            $lastRefNo = substr($result , 11 , strlen($result));
            $lastRefNo = $lastRefNo + 1;
            $generateRefNo = date('Y').'-'.'IMISS-'.$lastRefNo; 
        }

        $requestDuration = $this->calculateRequestDuration($categoryID , $repairTypeID , null);

        // INSERT REQUEST TAB
        $requestDescript= $req->getDescription;
        $accountID = session('account_empid');
        $locationID = $req->getLocation;
        $floorID = $req->getFloor;
        $requestDate = now();
        $statusID = 2; // STATUS 2 = OPEN
        $requestBy = strtoupper($req->getRequestBy);
        $requestByEmpNo = $req->getEmpNo;
        $agentUnitID = $getAgentUnitID;
        $requestorSection = session('section_id');
        $telNo = $req->getTelNo;
        $faxNo = $req->getFaxNo;
        $nameOFEquipment = $req->getNameOfEquipment;
        $serialNo = $req->getSerialNo;
        $modelNo = $req->getModelNo;
        $propertyNo = $req->getPropertyNo;
        $others = $req->getOthers;

        DB::table('request_tab')
        ->insert([
            'request_refid' => $generateRefNo ,
            'category_id' => $categoryID ,
            'repairtype_id' => $repairTypeID ,
            'request_descript' => $requestDescript ,
            'account_id' => $accountID ,
            'location_id' => $locationID ,
            'bldgfloor_id' => $floorID ,
            'request_date' => $requestDate ,
            'status_id' => $statusID ,
            'request_by' => $requestBy ,
            'request_byempno' => $requestByEmpNo ,
             'agentunit_id' => $agentUnitID ,
            'section_id' => $requestorSection ,
            'request_telno' => $telNo ,
            'request_faxno' => $faxNo ,
            'name_of_equipment' => $nameOFEquipment ,
            'serialno' => $serialNo ,
            'modelno' => $modelNo ,
            'propertyno' => $propertyNo ,
            'request_duration' => $requestDuration 
        ]);

        $this->notifFromClient($agentUnitID , $requestDate , $generateRefNo , $categoryID , $requestBy , 'YOU HAVE NEW REQUEST!');
        
        return $generateRefNo;
    }

    //////////////////////////////////////////////////////////////////// NOTIFICATION - NEW REQUEST
    public function notifFromClient($agentUnitID , $requestDate , $refNo , $categoryID , $requestBy , $notifTitle){

        $data = DB::table('category_tab')
        ->where('category_id' , $categoryID)
        ->select('category_value')
        ->first();
        $categoryName = $data->category_value;

        $link = '';
        if($notifTitle == 'YOU HAVE NEW REQUEST!'){
            $link = '/officer_open_request';
        }
        if($notifTitle == 'REQUEST HAS BEEN ACKNOWLEDGED'){
            $link = '/officer_completed_request';
        }
        if($notifTitle == 'ACKNOWLEDGEMENT HAS BEEN CANCELLED'){
            $link = '/officer_acknowledge_request';
        }
        if($notifTitle == 'CLIENT HAS CANCELLED THE REQUEST!'){
            $link = '/officer_open_request';
        }

        $newRequestMsg = $notifTitle." <br> 
        Request Date: ".$requestDate. "<br>
        Reference No. <a href=".$link.">".$refNo. "</a><br>
        Category: ".$categoryName. "<br>
        Request by: ".$requestBy. "<br>
        Timestamp: ".date("M. d, Y - h:iA" , strtotime(now()));

        $data = DB::table('accounts_tab')
        ->where('agentunit_id' , $agentUnitID)
        ->where('usertype_id' , 1)
        ->get();

        //$accountIDs = array_map("trim", explode(',', $data->account_empid));
        
        foreach($data as $datas){
            broadcast(new NotifyUser($datas->account_empid , $newRequestMsg))->toOthers();
        }
    }

    //////////////////////////////////////////////////////////////////// ALL EFMS REQUEST EXCLUDING TRAVEL CONDUCTION ADD REQUEST  
    public function addAllEFMS(Request $req){

        $requestRefID = $this->generateRefID($req);
        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// TRAVEL CONDUCTION ADD REQUEST  
    public function addEfmsTC(Request $req){

       $requestRefID = $this->generateRefID($req);
       $sectionID = session('section_id');


       DB::table('travel_attach_tab')
       ->insert([
        'request_refid' => $requestRefID,
        'travel_destination' => $req->EfmsTcDestination,
        'travel_purpose' => $req->EfmsTcPurpose,
        'travel_date' => $req->EfmsTcDate,
        'travel_time' => $req->EfmsTcTime,
        'section_id' => $sectionID,
       ]); 

       return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// BIOMETRICS ENROLL ADD REQUEST   
    public function addBioEnroll(Request $req){

        $requestRefID = $this->generateRefID($req);

        $bioFirstname = strtoupper($req->bioFname);
        $bioMidname = strtoupper($req->bioMname);
        $bioLastname = strtoupper($req->bioLname);
        $bioSuffix = strtoupper($req->bioSuffix);
        $bioCurrentID = $req->bioCurrentIDNo;
        $positionID = $req->bioDesignation;
        $employmentStatus = $req->bioEmpStatus;
        $bioSectionID = $req->bioSection;

        DB::table('biometric_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'biometric_fname' => $bioFirstname ,
            'biometric_mname' => $bioMidname ,
            'biometric_lname' => $bioLastname ,
            'biometric_suffix' => $bioSuffix ,
            'biometric_curridno' => $bioCurrentID ,
            'section_id' => $bioSectionID ,
            'position_id' => $positionID ,
            'employstatus_id' => $employmentStatus
        ]);

        //return back();
        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// HOMIS ENCODE ERROR ADD REQUEST
    public function addHomisEncodeError(Request $req){

        $requestRefID = $this->generateRefID($req);

        $hospitalNo = $req->homisHospitalNo;
        $homisFname = strtoupper($req->homisFname);
        $homisMname = strtoupper($req->homisMName);
        $homisLname = strtoupper($req->homisLName);
        $homisSuffix = strtoupper($req->homisSuffix);
        $encodedBy = strtoupper($req->homisEncodedBy);
        $encodeError = $req->homisEncodingError;
        $encodeCorrectDetails = $req->homisCorrectDetails;
        $sectionID = session('section_id');

        DB::table('ihomiserror_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'ihomiserror_hospitalno' => $hospitalNo,
            'ihomiserror_patfname' => $homisFname ,
            'ihomiserror_patmname' => $homisMname ,
            'ihomiserror_patlname' => $homisLname ,
            'ihomiserror_patsuffix' => $homisSuffix ,
            'ihomiserror_encodedby' => $encodedBy ,
            'ihomiserror_encodeerror' => $encodeError ,
            'ihomiserror_encodecorr' => $encodeCorrectDetails ,
            'section_id' => $sectionID
        ]);

       return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// ZOOM MEETING ADD REQUEST
    public function addZoomMeeting(Request $req){

        $requestRefID = $this->generateRefID($req);

        $zoomTitle = $req->zoomTitle;
        $zoomDate = $req->zoomDate;
        $zoomTime = $req->zoomTime;
        $zoomParticipants = $req->zoomParticipants;
        $zoomDuration = $req->zoomDuration;
        $zoomEmail = $req->zoomEmail;
        $zoomSection = session('section_id');

        DB::table('virtualmeet_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'virtualmeet_title' => $zoomTitle ,
            'virtualmeet_date' => $zoomDate ,
            'virtualmeet_time' => $zoomTime ,
            'virtualmeet_partno' => $zoomParticipants ,
            'virtualmeet_hours' => $zoomDuration ,
            'virtualmeet_email' => $zoomEmail ,
            'section_id' => $zoomSection
        ]);

        return redirect('/client_open_request');
    }

        //////////////////////////////////////////////////////////////////// OTHER-IMISS ADD REQUEST
    public function addOthersImiss(Request $req){

         $requestRefID = $this->generateRefID($req);
         return redirect('/client_open_request');
    }

        //////////////////////////////////////////////////////////////////// WEB UPLOADS ADD REQUEST
    public function addWebUploads(Request $req){

        $requestRefID = $this->generateRefID($req);

        $webUploadDetails = $req->webUploadDetails;
        $webUploadSectionID = session('section_id');

        if ($req->hasFile('webUploadFile')) {
            $file = $req->file('webUploadFile');

            // Optional: unique name
            $filename = time() . '_' . $file->getClientOriginalName();

            $webUploadPath = 'uploads/Web_Upload';
            // Ensure public/uploads exists
            if (!file_exists(public_path($webUploadPath))) {
                mkdir(public_path($webUploadPath), 0775, true);
            }

            //Move the uploaded file to public/uploads
            $file->move(public_path($webUploadPath), $filename);

            //Path to the zip file inside public/uploads
            $zipPath = public_path($webUploadPath.'/'.$requestRefID.'.zip');

            // Initialize ZipArchive
            $zip = new ZipArchive;
            if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
                //Add the uploaded file into the zip
                $zip->addFile(public_path($webUploadPath .'/' . $filename), $filename);
                $zip->close();
            }

            // (Optional) delete original uploaded file
            unlink(public_path($webUploadPath .'/' . $filename));
        }
        DB::table('websiteupload_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'websiteupload_details' => $webUploadDetails  ,
            'section_id' => $webUploadSectionID
        ]);

        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// WEB UPLOAD DOWNLOAD ATTACHMENT
    public function webUploadDownload($filename){

        $path = public_path('uploads/Web_Upload/' . $filename);

        if (file_exists($path)){
            return response()->download($path);
        }
        return abort(404);
    }

    //////////////////////////////////////////////////////////////////// NETWORK INSTALL ADD REQUEST
    public function addNetworkInstall(Request $req){

        $requestRefID = $this->generateRefID($req);

        $networkInstallSectionID = session('section_id');
        $networkInstallConnectionType = $req->networkInstallConnectionType;
        $networkInstallRequestDetails = $req->networkInstallRequestDetails;

        DB::table('networkconn_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'connectiontype_id' => $networkInstallConnectionType ,
            'networkconn_desc' => $networkInstallRequestDetails ,
            'section_id' => $networkInstallSectionID
        ]);
        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// VMC ID CARD PREPARATION ADD REQUEST
    public function addVmcIdCard(Request $req){

        $saveAsAbove = $req->sameAsAboveAddress;
        $picSigBypass = $req->picSigBypass;

        if($saveAsAbove == "on"){
            $idrequest_emerstreet = strtoupper($req->idrequest_street);
            $emerctycode = $req->ctycode;
            $emerbgycode = $req->bgycode;

        }else{
            $idrequest_emerstreet = strtoupper($req->idrequest_emerstreet);
            $emerctycode = $req->emerctycode;
            $emerbgycode = $req->emerbgycode;
        }

        $requestRefID = $this->generateRefID($req);
        $networkInstallSectionID = session('section_id');

        $idrequest_empno = $req->idrequest_empno;
        $position_id = $req->position_id;
        $employstatus_id = $req->employstatus_id;
        $idrequest_fname = strtoupper($req->idrequest_fname);
        $idrequest_mname = strtoupper($req->idrequest_mname);
        $idrequest_lname = strtoupper($req->idrequest_lname);
        $idrequest_suffix = $req->idrequest_suffix;
        $idrequest_dob = $req->idrequest_dob;
        $idrequest_street = strtoupper($req->idrequest_street);
        $ctycode = $req->ctycode;
        $bgycode = $req->bgycode;
        $idrequest_tinno = $req->idrequest_tinno;
        $idrequest_gsis = $req->idrequest_gsis;
        $idrequest_blood = $req->idrequest_blood;
        $idrequest_height = $req->idrequest_height;
        $idrequest_weight = $req->idrequest_weight;
        $idrequest_emerfname = strtoupper($req->idrequest_emerfname);
        $idrequest_emermname = strtoupper($req->idrequest_emermname);
        $idrequest_emerlname = strtoupper($req->idrequest_emerlname);
        $idrequest_emersuffix = $req->idrequest_emersuffix;
        $idrequest_emercontactno = $req->idrequest_emercontactno;



        if($picSigBypass == 'on'){

            $findPic = DB::table('idrequest_attach_tab')
            ->select('idrequest_picture' , 'idrequest_signature')
            ->where('idrequest_fname' , 'LIKE' , '%'.$idrequest_fname.'%')
            ->where('idrequest_lname' , 'LIKE' , '%'.$idrequest_lname.'%')
            ->first();

            $vmcIdCardPicFilename = '';
            $vmcIdCardSignatureFilename = '';
            if($findPic != '' || $findPic != null){
                $vmcIdCardPicFilename = $findPic->idrequest_picture;
                $vmcIdCardSignatureFilename = $findPic->idrequest_signature;
            }

        }
        else{

            // CHANGE PICTURE FILENAME TO REFERENCE NUMBER
            $vmcIdCardPicture = $req->file('idrequest_picture');
            $getPictureExtension = $vmcIdCardPicture->extension();
            $vmcIdCardPicFilename = $requestRefID.'.'.$getPictureExtension;

            // CREATE FOLDER/PATH IF NOT EXIST
            if (!file_exists(public_path('uploads/VMC_ID_Picture'))) {
                mkdir(public_path('uploads/VMC_ID_Picture'), 0775, true);
            }

            // MOVE PICTURE TO public/uploads/VMC_ID_Picture
            $vmcIdCardPicture->move(public_path('uploads/VMC_ID_Picture'), $vmcIdCardPicFilename);

            // CHANGE SIGNATURE FILENAME TO REFERENCE NUMBER
            $vmcIdCardSignature = $req->file('idrequest_signature');
            $getSignatureExtension = $vmcIdCardSignature->extension();
            $vmcIdCardSignatureFilename = $requestRefID.'.'.$getSignatureExtension;

            // CREATE FOLDER/PATH IF NOT EXIST
            if (!file_exists(public_path('uploads/VMC_ID_Sig'))) {
                mkdir(public_path('uploads/VMC_ID_Sig'), 0775, true);
            }

            // MOVE PICTURE TO public/uploads/VMC_ID_Picture/VMC_ID_Sig
            $vmcIdCardSignature->move(public_path('uploads/VMC_ID_Sig'), $vmcIdCardSignatureFilename);

        }// EOF BYPASS PIC AND SIG
        

        DB::table('idrequest_attach_tab')
        ->insert([
            'request_refid' => $requestRefID,
            'idrequest_empno' => $idrequest_empno ,
            'position_id' => $position_id ,
            'employstatus_id' => $employstatus_id,
            'idrequest_fname' => $idrequest_fname,
            'idrequest_mname' => $idrequest_mname,
            'idrequest_lname' => $idrequest_lname,
            'idrequest_suffix' => $idrequest_suffix,
            'idrequest_dob' => $idrequest_dob,
            'idrequest_street' => $idrequest_street,
            'ctycode' => $ctycode,
            'bgycode' => $bgycode,
            'idrequest_tinno' => $idrequest_tinno,
            'idrequest_gsis' => $idrequest_gsis ,
            'idrequest_blood' => $idrequest_blood,
            'idrequest_height' => $idrequest_height,
            'idrequest_weight' => $idrequest_weight,
            'idrequest_emerfname' => $idrequest_emerfname,
            'idrequest_emermname' => $idrequest_emermname,
            'idrequest_emerlname' => $idrequest_emerlname,
            'idrequest_emersuffix' => $idrequest_emersuffix,
            'idrequest_emercontactno' => $idrequest_emercontactno,
            'idrequest_emerstreet' => $idrequest_emerstreet,
            'emerctycode' => $emerctycode,
            'emerbgycode' => $emerbgycode,
            'idrequest_picture' => $vmcIdCardPicFilename,
            'idrequest_signature' => $vmcIdCardSignatureFilename
        ]);    

        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// LOAD ALL CONNECTION TYPE - AJAX
    public function loadConnection(){
        
        $data = DB::table('connectiontype_tab')->get();
        return json_encode($data);
    }

    //////////////////////////////////////////////////////////////////// LOAD ALL VMC SYSTEM - AJAX
    public function loadVmcSystem(){

        $data = DB::table('vmcsystem_tab')->get();
        return json_encode($data);    
    }

    //////////////////////////////////////////////////////////////////// REPAIR IT EQUIPMENT ADD REQUEST
    public function addRepairItEquipment(Request $req){

        $requestRefID = $this->generateRefID($req);
        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// SYSTEM ENHANCE ADD REQUEST
    public function addSystemEnhance(Request $req){

        $requestRefID = $this->generateRefID($req);
        $systemEnhanceSectionID = session('section_id');

        $systemEnhanceSelectSystem = $req->systemEnhanceSelectSystem;
        $systemEnhanceRequestDetails = $req->systemEnhanceRequestDetails;

        DB::table('sysmodi_attach_tab')
        ->insert([
            'request_refid' => $requestRefID ,
            'vmcsystem_id' => $systemEnhanceSelectSystem ,
            'modify_details' => $systemEnhanceRequestDetails
        ]);

        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// TECHNICAL ASSISTANCE ADD REQUEST
    public function addTechAssist(Request $req){

        $requestRefID = $this->generateRefID($req);
        return redirect('/client_open_request');
    }

    public function addTrainingOrientation(Request $req){

        $requestRefID = $this->generateRefID($req);
        return redirect('/client_open_request');
    }

    public function addUserAccMngt(Request $req){

        $requestRefID = $this->generateRefID($req);
        return redirect('/client_open_request');
    }

    //////////////////////////////////////////////////////////////////// ACKNOWLEDGE REQUEST
    public function acknowledgeRequest(Request $req){


        $refID = $req->refID;
        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'request_acknowledged' => now(),
            'status_id' => 6 // COMPLETED
        ]);

        $agentUnitID = $req->agentUnitID;
        $requestDate = $req->requestDate;
        $categoryID = $req->categoryID;
        $requestBy = $req->requestBy;

        $this->notifFromClient($agentUnitID , $requestDate , $refID , $categoryID , $requestBy , 'REQUEST HAS BEEN ACKNOWLEDGED');
        return back(); 
    }

    //////////////////////////////////////////////////////////////////// UNDO REQUEST (CLIENT)
    public function undoRequestClient(Request $req){

        $refID = $req->refID;

        DB::table('request_tab')
        ->where('request_refid' , $refID)
        ->update([
            'request_acknowledged' => null,
            'status_id' => 8 // ACKNOWLEDGED
        ]);

        $agentUnitID = $req->agentUnitID;
        $requestDate = $req->requestDate;
        $categoryID = $req->categoryID;
        $requestBy = $req->requestBy;

        $this->notifFromClient($agentUnitID , $requestDate , $refID , $categoryID , $requestBy , 'ACKNOWLEDGEMENT HAS BEEN CANCELLED');
        return back();
    }

    //////////////////////////////////////////////////////////////////// AJAX REFRESH CLIENT LIST
    public function ajaxClientList(Request $req){

        $getStatusID = $req->status;
        $getUserID = session('account_empid');

            $data = DB::table('request_tab')
            ->join('category_tab' , 'category_tab.category_id' , '=' , 'request_tab.category_id')
            ->join('status_tab' , 'status_tab.status_id' , '=' , 'request_tab.status_id')
            ->join('agentunit_tab' , 'agentunit_tab.agentunit_id' , '=' , 'request_tab.agentunit_id')
            ->leftJoin('accounts_tab' , 'accounts_tab.account_empid' , '=' , 'request_tab.agentacc_id')
            ->selectRaw("
                        request_tab.request_by as requestBy , 
                        request_tab.agentunit_id as agentUnitID , 
                        request_tab.request_refid as refID , 
                        request_tab.category_id as categoryId , 
                        category_tab.category_value categoryVal ,
                        request_tab.request_descript reqDesc , 
                        request_tab.request_date as reqDate ,
                        request_tab.request_duration as reqDuration ,
                        request_tab.request_acknowledged as reqAcknowledge ,
                        status_tab.status_value as statusVal ,
                        agentunit_tab.agentunit_abbre as agentAbbre ,
                        request_tab.request_condemn as reqCondemn , 
                        CONCAT( accounts_tab.account_fname , ' ' , accounts_tab.account_lname ) as actionOfficer
            ")
            ->where('request_tab.account_id' , $getUserID)
            ->where('request_tab.status_id' , $getStatusID)
            ->groupBy('refID' , 
            'agentUnitID' ,
            'requestBy' ,
            'categoryId' ,
            'categoryVal' , 
            'reqDesc' , 
            'reqDate' , 
            'reqDuration' , 
            'reqAcknowledge' , 
            'statusVal' , 
            'agentAbbre' , 
            'actionOfficer',
            'reqCondemn'
            )
            ->orderBy('request_tab.request_date' , 'DESC')
            ->get();

        
        $data->each(function($row) {
        $row->encryptedRefID = Crypt::encrypt($row->refID);
        });

        return json_encode($data);

    }

}
