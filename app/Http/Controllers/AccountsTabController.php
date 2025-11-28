<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountsTab;
use App\Models\RequestTab;
use DB;
use Carbon\Carbon;

class AccountsTabController extends Controller
{

    public function loginAccount(){

        return view('AccountsTab.account_login');
    }

    public function login(){

        //return view('AccountsTab.account_login');

        $users = AccountsTab::orderBy('account_fname')->get();
        return view('AccountsTab.temp_account_list' , compact('users'));
    }

    public function registerAccount(){

        Auth::logout(); // Log out the user
        session()->invalidate(); // Invalidate the session
        session()->regenerateToken(); // Regenerate the CSRF token

        return view('AccountsTab.account_register');
    }

    //------------------------------------------------------------------LOGOUT DESTROY SESSION
    public function logout(){

        Auth::logout(); // Log out the user
        session()->invalidate(); // Invalidate the session
        session()->regenerateToken(); // Regenerate the CSRF token
        //session()->flush();

        return redirect('/register_account'); // Redirect to a desired page, e.g., login
    }

    //------------------------------------------------------------------AUTHENTICATE USER
    public function authUser(Request $req){

        Auth::logout(); // Log out the user
        session()->invalidate(); // Invalidate the session
        session()->regenerateToken(); // Regenerate the CSRF token

       
        $user = AccountsTab::where('account_empid' , $req->account_empid)->first();
        //$checkUser = AccountsTab::where('account_empid' , $req->account_empid)->exists();
        if($user){
            Auth::login($user);

            $getSection = DB::table('section_tab')
            ->select('section_name' , 'section_abbre')
            ->where('section_id' , $user->section_id)
            ->first();

            $sectionName = $getSection->section_name;
            $sectionAbbre = $getSection->section_abbre;

            session([
                'usertype_id' => $user->usertype_id,
                'account_empid' => $user->account_empid,
                'agentunit_id' => $user->agentunit_id,
                'section_id' => $user->section_id,
                'section_name' => $sectionName,
                'section_abbre' => $sectionAbbre,
            ]);

            $req->session()->regenerate();
            return redirect()->intended('/client_dashboard');
        }
        else{
            return redirect('/logout');
        }
        
    }

    //------------------------------------------------------------------OFFICER DASHBOARD
    public function officerDashboard(Request $req){

        if(Auth::user()->agentunit_id == 3){
            return redirect('/client_dashboard');
        }

        $accountEmpid = session('agentunit_id');

            $searchAll = $req->searchAll;
            $getReqCategory = $req->reqCategory;
            $getReqStatus = $req->reqStatus;
            $getDateFrom = $req->reqDateFrom;
            $getDateTo = $req->reqDateTo;
            $getEmpFirstLastName = $req->searchEmpName;

            $sql = DB::table('request_tab')
                    ->join('category_tab', 'category_tab.category_id', '=', 'request_tab.category_id')
                    ->join('section_tab', 'section_tab.section_id', '=', 'request_tab.section_id')
                    ->join('status_tab', 'status_tab.status_id', '=', 'request_tab.status_id')
                    ->leftJoin('accounts_tab', 'accounts_tab.account_empid', '=', 'request_tab.agentacc_id')
                    ->leftJoin('actiontaken_tab', 'actiontaken_tab.request_refid', '=', 'request_tab.request_refid')
                    ->leftJoin('idrequest_attach_tab' , 'idrequest_attach_tab.request_refid' , '=' , 'request_tab.request_refid')
                    ->selectRaw("
                        request_tab.request_refid AS refNo,
                        request_tab.request_date AS reqDate,
                        request_tab.request_duration AS until,
                        category_tab.category_value AS categoryVal,
                        request_tab.request_by AS requestBy,
                        request_tab.request_byempno AS empNo,
                        section_tab.section_abbre AS sectionName,
                        request_tab.request_descript AS reqDesc,
                        request_tab.name_of_equipment AS eq1,
                        request_tab.serialno AS eq2,
                        request_tab.modelno AS eq3,
                        request_tab.propertyno AS eq4,
                        accounts_tab.account_fname AS officerFname,
                        accounts_tab.account_mname AS officerMname,
                        accounts_tab.account_lname AS officerLname,
                        accounts_tab.account_suffix AS officerSuffix,
                        request_tab.request_taken AS dateTaken,
                        GROUP_CONCAT( CONCAT(actiontaken_tab.action_taken ,' : ',actiontaken_tab.action_datetime ) 
                        ORDER BY actiontaken_tab.action_datetime DESC SEPARATOR '<br>') AS actionTaken,
                        status_tab.status_value AS statusVal
                        ")
                    ->where('request_tab.agentunit_id', $accountEmpid)
                    ->where('category_tab.category_value', 'LIKE' , '%'.$getReqCategory.'%')
                    ->where('status_tab.status_value', 'LIKE', '%'.$getReqStatus.'%')
                    ->groupBy(
                        'request_tab.request_refid',
                        'request_tab.request_date',
                        'request_tab.request_duration',
                        'category_tab.category_value',
                        'request_tab.request_by',
                        'request_tab.request_byempno',
                        'section_tab.section_abbre',
                        'request_tab.request_descript',
                        'request_tab.name_of_equipment',
                        'request_tab.serialno',
                        'request_tab.modelno',
                        'request_tab.propertyno',
                        'accounts_tab.account_fname',
                        'accounts_tab.account_mname',
                        'accounts_tab.account_lname',
                        'accounts_tab.account_suffix',
                        'request_tab.request_taken',
                        'status_tab.status_value'
                    )
                    ->orderBy('request_tab.request_date' , 'DESC');

                    //IF SEARCH EMPLOYEE NAME VIA VMC CARD PREP IS NOT NULL ( PRIO 1 )
                    if($getEmpFirstLastName != ''){
                        $sql->Where('idrequest_attach_tab.idrequest_fname', 'LIKE', '%'.$getEmpFirstLastName.'%')
                        ->orWhere('idrequest_attach_tab.idrequest_lname', 'LIKE', '%'.$getEmpFirstLastName.'%');
                    }

                    //IF WILD CARD/SEARCH IS NOT NULL ( PRIO 2)
                    elseif($searchAll != ''){
                    $sql->Where('request_tab.request_refid', 'LIKE', '%'.$searchAll.'%')
                    ->orWhere('request_tab.request_by' , 'LIKE' ,  '%'.$searchAll.'%')
                    ->orWhere('request_tab.request_descript' , 'LIKE' ,  '%'.$searchAll.'%');
                    }

                    // IF DATE FROM AND DATE TO IS NOT NULL ( PRIO 3 )
                    elseif($getDateFrom != null || $getDateTo != null){

                        // REQUIRED +1day to $getDateTo variable BCOZ request_date column has time
                        $getDateTo = Carbon::parse($getDateTo)->addDays(1); 

                        $sql->whereBetween('request_tab.request_date' , [$getDateFrom ,$getDateTo]);
                    }

                    $data = $sql->paginate(10)->appends($req->all());

            //return view('officer.officer_dashboard' , compact('data'));

            $populateCategory = DB::table('category_tab')
            ->select('category_id' , 'category_value')
            ->where('agentunit_id' , $accountEmpid)
            ->orderBy('category_value' , 'ASC')
            ->get();

            return view('officer.officer_dashboard' , compact('data','populateCategory'), ['oldData' => $req->all()]);
    }

    //------------------------------------------------------------------CLIENT DASHBOARD
    public function clientDashboard(){

        return view('client.client_dashboard');
    }

}
