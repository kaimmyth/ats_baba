<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Tbl_job_seekers;
use App\tbl_post_job;
use App\tbl_post_jobs;
use App\Tbl_forward_candidate;
use App\Tbl_seeker_applied_for_job;
use App\Tbl_job_post_assign;
use App\Tbl_team_member_type;
use App\tbl_team_member; 


class Report_Controller extends Controller
{
    public function __construct()
		{
			$this->middleware('mian_session');

		}

    public function repost_show(){
                ini_set('memory_limit', '-1');
        $org_id=Session::get('org_ID');
            //for days
            for ($j=0; $j < 12 ; $j++) { 
                $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-'.$j.' days'));
                $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-'.$j.' days'));
                $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
                $toReturn['week_report'][$j]['job_created']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                // $toReturn['week_report'][$j]['job_created']= count(tbl_post_job::whereDate('dated',$newDate[$j])->where('company_ID',$org_id)->get());
                // $data_group[$j]=tbl_post_job::whereDate('dated',$newDate[$j])->where('company_ID',$org_id)->get('for_group');
                $toReturn['week_report'][$j]['candidate_created']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                $toReturn['week_report'][$j]['client_submittal']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereDate('forward_date',$newDate[$j])->get());
                $toReturn['week_report'][$j]['application_submitted']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                $toReturn['week_report'][$j]['post_assign']= count(Tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereDate('job_assigned_date',$newDate[$j])->get());
                
            }
            

            $org_id=Session::get('org_ID');
         //job post
            $date_team['team']=Tbl_team_member_type::leftjoin('tbl_post_jobs','tbl_post_jobs.for_group','=','tbl_team_member_type.type_ID')
            ->select('tbl_team_member_type.type_ID as id','tbl_team_member_type.type_name',
                    'tbl_post_jobs.for_group as group','tbl_post_jobs.dated as date','tbl_post_jobs.company_ID')
                    ->where('tbl_post_jobs.company_ID',Session::get('org_ID'))
                    ->get();


            // $dat="09-2019";
            // $date_team['jobs_created']=DB::table('tbl_team_member_type')
            //                             ->leftjoin('tbl_post_jobs','tbl_post_jobs.for_group','=','tbl_team_member_type.type_ID')
            //                             ->select('tbl_team_member_type.type_ID as id','tbl_team_member_type.type_name',
            //                                     'tbl_post_jobs.for_group as group','tbl_post_jobs.dated as date','tbl_post_jobs.company_ID')
            //                             ->whereMonth('tbl_post_jobs.dated',$dat)
                                        
            //                             ->count();
            //                             return $date_team['jobs_created'];
            //job post assign



            $post_assign=Tbl_job_post_assign::get()->toArray();
            //job assign
            $date_team['post_assign']=tbl_team_member::leftjoin('tbl_job_post_assign','tbl_job_post_assign.team_member_id','=','tbl_team_member.ID')     
                                                    ->leftjoin('tbl_team_member_type','tbl_team_member_type.type_ID','=','tbl_team_member.team_member_type')  
                                                    ->select('tbl_team_member.team_member_type','tbl_team_member.company_id','tbl_team_member.full_name',
                                                    'tbl_job_post_assign.team_member_id','tbl_team_member_type.type_name','tbl_team_member_type.type_ID',
                                                    'tbl_job_post_assign.job_assigned_date','tbl_team_member.company_id','tbl_job_post_assign.org_id')
                                                    ->where('tbl_job_post_assign.org_id',Session::get('org_ID'))
                                                    ->get();
   
            $date_team['create_candidate']=tbl_team_member_type::leftjoin('tbl_team_member','tbl_team_member.team_member_type','=','tbl_team_member_type.type_ID')
                                                    ->leftjoin('user','user.user_id','=','tbl_team_member.ID')  
                                                    ->leftjoin('tbl_job_seekers','tbl_job_seekers.employer_id','=','user.user_id')  
                                                    ->select('tbl_job_seekers.ID','tbl_job_seekers.dated','tbl_job_seekers.dated','tbl_job_seekers.employer_id',
                                                    'tbl_team_member.full_name','tbl_team_member.team_member_type','tbl_team_member_type.type_ID','tbl_team_member_type.type_name','tbl_team_member.company_id','tbl_job_seekers.org_id')
                                                    ->where('tbl_job_seekers.org_id',Session::get('org_ID'))
                                                    ->get();
            // application_submitted
            $date_team['application_submitted']=Tbl_seeker_applied_for_job::leftjoin('tbl_job_seekers','tbl_job_seekers.ID','=','tbl_seeker_applied_for_job.seeker_ID')
                                                    ->leftjoin('user','user.ID','=','tbl_job_seekers.employer_id')  
                                                    ->leftjoin('tbl_team_member','tbl_team_member.ID','=','user.user_id')  
                                                    ->leftjoin('tbl_team_member_type','tbl_team_member_type.type_ID','=','tbl_team_member.team_member_type')  
                                                    ->select('tbl_job_seekers.ID','tbl_job_seekers.dated','tbl_seeker_applied_for_job.dated','tbl_job_seekers.employer_id',
                                                    'tbl_team_member.full_name','tbl_team_member.team_member_type','tbl_team_member_type.type_ID','tbl_team_member_type.type_name','tbl_team_member.company_id','tbl_job_seekers.org_id')
                                                    ->where('tbl_job_seekers.org_id',Session::get('org_ID'))
                                                    ->get();

            $date_team['forward_candidate']=Tbl_forward_candidate::leftjoin('tbl_post_jobs','tbl_post_jobs.ID','=','tbl_forward_candidate.job_id')
                                                                   ->leftjoin('tbl_team_member_type','tbl_team_member_type.type_ID','=','tbl_post_jobs.for_group')
                                                                   ->select('tbl_team_member_type.type_ID','tbl_team_member_type.type_name',
                                                                        'tbl_post_jobs.for_group','tbl_forward_candidate.forward_date','tbl_forward_candidate.forward_by','tbl_post_jobs.company_ID')
                                                                        ->where('tbl_post_jobs.company_ID',Session::get('org_ID'))
                                                                        ->get();
                                                                        $google=$date_team['forward_candidate'];
            //   return $google;                                       
            @$toReturn['team_member']=Tbl_team_member_type::get()->toArray();
            for($o=0;$o<12;$o++){
                $data_one[$o]=$newDate[$o];        
                $filtered[$o] = $date_team['team']->whereIn('date', $data_one[$o])->toArray(); 
                $filtered1[$o] =$date_team['team']->whereIn('date', $data_one[$o]);

            }      
            // for months;
            $global="";
            for($i=0;$i<12;$i++){

                if($i==0){
                    $one = date('d-m-Y');
                    $global=$one;
                }
                else{
                    $two= date('d-m-Y',(strtotime ( '-30 days' , strtotime (   $global) ) ));
                    $toReturn['monthly'][$i]['month_week_one1'] =$newDate = date("m-Y", strtotime($global));
                    $toReturn['monthly'][$i]['job_created_monthly1']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                    $toReturn['monthly'][$i]['candidate_created_monthly1']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                    $toReturn['monthly'][$i]['client_submittal_monthly1']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereMonth('forward_date',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                    $toReturn['monthly'][$i]['application_submitted_monthly1']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                    $toReturn['monthly'][$i]['post_assign_month1']= count(tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereMonth('job_assigned_date',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                    $global=$two;
                }
            }

                $global_year="";
                for($k=0;$k<12;$k++){
    
                    if($k==0){
                        $one = date('d-m-Y');
                        $global_year=$one;
                    }
                    else {
    
                        $two= date('d-m-Y',(strtotime ( '-365 days' , strtotime (   $global_year) ) ));
                        $toReturn['yearly'][$k]['month_week_one1'] =$newDate = date("Y", strtotime($global_year));
                        $toReturn['yearly'][$k]['job_created_monthly1']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                        $toReturn['yearly'][$k]['candidate_created_monthly1']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                        $toReturn['yearly'][$k]['client_submittal_monthly1']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereYear('forward_date',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                        $toReturn['yearly'][$k]['application_submitted_monthly1']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                        $toReturn['yearly'][$k]['post_assign_month1']= count(Tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereYear('job_assigned_date',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                        $global_year=$two;
                    }
                }
                
                $week_no = array(1,2,3,4,5,6,7,8,9,10,11,12);
                $dayCount = 0;
                $dateToday= date('Y-m-d');
                foreach($week_no as $key=>$value)
                {
                    $weekStart= $dayCount + 6;
                    $weekEnd= $dayCount;
                $toReturn['week'][$key]['week_start'] =date('Y-m-d', strtotime('-'.$weekStart.' days'));
                $toReturn['week'][$key]['week_end']=date('Y-m-d', strtotime('-'.$weekEnd.' days'));
                $toReturn['week'][$key]['week_dates']=date('m-d-Y', strtotime('-'.$weekEnd.' days'));
                            $week_start_date=$toReturn['week'][$key]['week_start'];
                            $week_end_date=$toReturn['week'][$key]['week_end'];
                $toReturn['week'][$key]['job_created_weekly1']= count(tbl_post_job::whereDate('dated','<=',$week_end_date)
                                                ->whereDate('dated','>=',$week_start_date)
                                                ->get()->toArray());
                $toReturn['week'][$key]['candidate_created1']= count(Tbl_job_seekers::where('dated','<=',$week_end_date)
                                                ->where('dated','>=',$week_start_date)
                                                ->get());
                $toReturn['week'][$key]['application_submitted1']= count(Tbl_seeker_applied_for_job::where('dated','<=',$week_end_date)
                                                ->where('dated','>=',$week_start_date)
                                                ->get());
                $toReturn['week'][$key]['client_submittal1']= count(Tbl_forward_candidate::where('forward_date','<=',$week_end_date)
                                                ->where('forward_date','>=',$week_start_date)
                                                ->get());
                $toReturn['week'][$key]['post_assign_week_wise1']= count(Tbl_job_post_assign::where('job_assigned_date','<=',$week_end_date)
                                                            ->where('job_assigned_date','>=',$week_start_date)
                                                            ->get());
                $dayCount = $dayCount +7;
                }


                // return $toReturn['week'];

        return view('report')->with('toReturn',$toReturn)
                             ->with('date_team',$date_team)
                             ->with('org_id',$org_id)
                             ->with('dayCount',$dayCount);
    }
    public function search_daily(Request $request){

        ini_set('memory_limit', '-1');

        $date_1=$request->one_new;
        $date_2=$request->two_new;
        $data['one1']=$date_1;
        $data['two2']=$date_2;
        $data['job_created_days']= count(tbl_post_job::where('dated','<=', $date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['candidate_created_days']= count(Tbl_job_seekers::where('dated','<=',$date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['application_submitted_days']= count(Tbl_seeker_applied_for_job::where('dated','<=',$date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['client_submittal_days']= count(Tbl_forward_candidate::where('forward_date','<=',$date_2)
                                            ->where('forward_date','>=',$date_1)
                                            ->get());
        $data['post_assign_days']= count(Tbl_job_post_assign::where('job_assigned_date','<=',$date_2)
                                            ->where('job_assigned_date','>=',$date_1)
                                            ->get());                                        
        return response()->json($data);
    }

    public function search_weekly(Request $request){
                ini_set('memory_limit', '-1');

        $date_1=$request->one_new;
        $date_2=$request->two_new;
        $data['one1']=$date_1;
        $data['two2']=$date_2;


        $data['job_created_days']= count(tbl_post_job::where('dated','<=', $date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['candidate_created_days']= count(Tbl_job_seekers::where('dated','<=',$date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['application_submitted_days']= count(Tbl_seeker_applied_for_job::where('dated','<=',$date_2)
                                            ->where('dated','>=',$date_1)
                                            ->get());
        $data['client_submittal_days']= count(Tbl_forward_candidate::where('forward_date','<=',$date_2)
                                            ->where('forward_date','>=',$date_1)
                                            ->get());
        $data['post_assign_days']= count(Tbl_job_post_assign::where('job_assigned_date','<=',$date_2)
                                            ->where('job_assigned_date','>=',$date_1)
                                            ->get());                                     
        return response()->json($data);

    }
    public function month_group(Request $request){
                ini_set('memory_limit', '-1');

                $date=$request->da;
                $toReturn['team_member']=Tbl_team_member_type::get()->toArray();


                foreach($toReturn['team_member'] as $item){
                    $group_id=$item['type_ID'];
                    $date_team['jobs_created']=Tbl_team_member_type::leftjoin('tbl_post_jobs','tbl_post_jobs.for_group','=','tbl_team_member_type.type_ID')
                                                        ->select('tbl_team_member_type.type_ID as id','tbl_team_member_type.type_name',
                                                                'tbl_post_jobs.for_group as group','tbl_post_jobs.dated as date','tbl_post_jobs.company_ID')
                                                        ->whereMonth('tbl_post_jobs.dated',$date)
                                                        ->where('tbl_post_jobs.for_group',$group_id)
                                                        ->count();                                                

                }



                return response()->json($date_team);

    }

    public function report_graph()
    {   
        return view('report_graph');
    }

    public function graph_how(){

        ini_set('memory_limit', '-1');
        $org_id = Session::get('org_ID');
        //for days
        for ($j = 0; $j < 12; $j++) {
            $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-'.$j.' days'));
                $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-'.$j.' days'));
                $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
                $toReturn['week_report'][$j]['job_created']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                // $toReturn['week_report'][$j]['job_created']= count(tbl_post_job::whereDate('dated',$newDate[$j])->where('company_ID',$org_id)->get());
                // $data_group[$j]=tbl_post_job::whereDate('dated',$newDate[$j])->where('company_ID',$org_id)->get('for_group');
                $toReturn['week_report'][$j]['candidate_created']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                $toReturn['week_report'][$j]['client_submittal']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereDate('forward_date',$newDate[$j])->get());
                $toReturn['week_report'][$j]['application_submitted']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereDate('dated',$newDate[$j])->get());
                $toReturn['week_report'][$j]['post_assign']= count(Tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereDate('job_assigned_date',$newDate[$j])->get());
        }

        return response ($toReturn['week_report']);
    }

    public function graph_month(){

        ini_set('memory_limit', '-1');
        $org_id = Session::get('org_ID');
        // for months;
        $global="";
        for($i=0;$i<12;$i++){

            if($i==0){
                $one = date('d-m-Y');
                $global=$one;
            }
            else{
                $two= date('d-m-Y',(strtotime ( '-30 days' , strtotime (   $global) ) ));
                $toReturn['monthly'][$i]['month_week_one1'] =$newDate = date("m-Y", strtotime($global));
                $toReturn['monthly'][$i]['job_created_monthly1']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                $toReturn['monthly'][$i]['candidate_created_monthly1']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                $toReturn['monthly'][$i]['client_submittal_monthly1']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereMonth('forward_date',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                $toReturn['monthly'][$i]['application_submitted_monthly1']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereMonth('dated',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                $toReturn['monthly'][$i]['post_assign_month1']= count(tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereMonth('job_assigned_date',$toReturn['monthly'][$i]['month_week_one1'])->get()->toArray());
                $global=$two;
            }
        }

        return response ($toReturn['monthly']);
    }

    public function graph_year(){

        ini_set('memory_limit', '-1');
        $org_id = Session::get('org_ID');
        // for yeaars

        $global_year="";
        for($k=0;$k<12;$k++){

            if($k==0){
                $one = date('d-m-Y');
                $global_year=$one;
            }
            else {

                $two= date('d-m-Y',(strtotime ( '-365 days' , strtotime (   $global_year) ) ));
                $toReturn['yearly'][$k]['month_week_one1'] =$newDate = date("Y", strtotime($global_year));
                $toReturn['yearly'][$k]['job_created_monthly1']= count(tbl_post_job::where('company_ID',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                $toReturn['yearly'][$k]['candidate_created_monthly1']= count(Tbl_job_seekers::where('org_id',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                $toReturn['yearly'][$k]['client_submittal_monthly1']= count(Tbl_forward_candidate::where('org_id',Session::get('org_ID'))->whereYear('forward_date',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                $toReturn['yearly'][$k]['application_submitted_monthly1']= count(Tbl_seeker_applied_for_job::where('org_id',Session::get('org_ID'))->whereYear('dated',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                $toReturn['yearly'][$k]['post_assign_month1']= count(Tbl_job_post_assign::where('org_id',Session::get('org_ID'))->whereYear('job_assigned_date',$toReturn['yearly'][$k]['month_week_one1'])->get()->toArray());
                $global_year=$two;
            }
        }

        return response ($toReturn['yearly']);
    }
    
    
    public function team_and_group_report(){

        $group_teammember_user_id = Session::get('one_group_teammember_id');

        $team_member = tbl_team_member::leftjoin('tbl_team_member_type as member_type', 'tbl_team_member.team_member_type', '=', 'member_type.type_ID')
            ->select(
                'tbl_team_member.ID as ID',
                'tbl_team_member.company_id as company_id',
                'tbl_team_member.first_name as first_name',
                'member_type.type_name as team_member_type',
                'tbl_team_member.city as city',
                'tbl_team_member.state as state',
                'tbl_team_member.country as  country',
                'tbl_team_member.loc_time_zone as loc_time_zone',
                'tbl_team_member.first_login_date as first_login_date',
                'tbl_team_member.last_login_date as last_login_date',
                'tbl_team_member.last_updated_date as last_updated_date',
                'tbl_team_member.is_active as is_active',
                'tbl_team_member.ID as ID'
            )
            ->where('company_id',Session::get('org_ID'))
            ->where('tbl_team_member.team_member_type',Session::get('group_type'))
            ->where('tbl_team_member.is_active','active')
            ->paginate(12);
    
        return view('team_and_group_report')->with('team_member',$team_member);
    }


   public function group_daily_report($date="")
   {
       $date=str_replace("_","-",$date);
       $team_member=Tbl_team_member_type::get()->toArray();
       $group_report=array();
       foreach($team_member as $key_team=>$value_team)
          {
       $group_report[$value_team['type_name']]["seeker"]=tbl_team_member_type::leftjoin('tbl_team_member','tbl_team_member.team_member_type','=','tbl_team_member_type.type_ID')
                                                                    ->leftjoin('user','user.user_id','=','tbl_team_member.ID')  
                                                                    ->leftjoin('tbl_job_seekers','tbl_job_seekers.employer_id','=','user.user_id')  
                                                                    ->select(
                                                                        'tbl_job_seekers.ID',
                                                                        'tbl_job_seekers.dated',
                                                                        'tbl_job_seekers.dated',
                                                                        'tbl_job_seekers.employer_id',
                                                                        'tbl_team_member.full_name',
                                                                        'tbl_team_member.team_member_type',
                                                                        'tbl_team_member_type.type_ID',
                                                                        'tbl_team_member_type.type_name',
                                                                        'tbl_team_member.company_id',
                                                                        'tbl_job_seekers.org_id'
                                                                        )
                                                                    ->where('tbl_job_seekers.org_id',Session::get('org_ID'))
                                                                    ->whereDate('tbl_job_seekers.dated',$date)
                                                                    ->where('tbl_team_member_type.type_ID',$value_team['type_ID'])
                                                                    ->get()->count();
$group_report[$value_team['type_name']]["seeker"]=tbl_team_member_type::leftjoin('tbl_team_member','tbl_team_member.team_member_type','=','tbl_team_member_type.type_ID')
                                                                    ->leftjoin('user','user.user_id','=','tbl_team_member.ID')  
                                                                    ->leftjoin('tbl_job_seekers','tbl_job_seekers.employer_id','=','user.user_id')  
                                                                    ->select(
                                                                        'tbl_job_seekers.ID',
                                                                        'tbl_job_seekers.dated',
                                                                        'tbl_job_seekers.dated',
                                                                        'tbl_job_seekers.employer_id',
                                                                        'tbl_team_member.full_name',
                                                                        'tbl_team_member.team_member_type',
                                                                        'tbl_team_member_type.type_ID',
                                                                        'tbl_team_member_type.type_name',
                                                                        'tbl_team_member.company_id',
                                                                        'tbl_job_seekers.org_id'
                                                                        )
                                                                    ->where('tbl_job_seekers.org_id',Session::get('org_ID'))
                                                                    ->whereDate('tbl_job_seekers.dated',$date)
                                                                    ->where('tbl_team_member_type.type_ID',$value_team['type_ID'])
                                                                    ->get()->count();
          }
    //    foreach($team_member as $key_team=>$value_team)
    //    {
    //    $date_team['post_assign']=tbl_team_member::leftjoin('tbl_job_post_assign','tbl_job_post_assign.team_member_id','=','tbl_team_member.ID')     
    //    ->leftjoin('tbl_team_member_type','tbl_team_member_type.type_ID','=','tbl_team_member.team_member_type')  
    //    ->select('tbl_team_member.team_member_type','tbl_team_member.company_id','tbl_team_member.full_name',
    //    'tbl_job_post_assign.team_member_id','tbl_team_member_type.type_name','tbl_team_member_type.type_ID',
    //    'tbl_job_post_assign.job_assigned_date','tbl_team_member.company_id','tbl_job_post_assign.org_id')
    //    ->where('tbl_job_post_assign.org_id',Session::get('org_ID'))
    //    ->get();
    //    }
    return $group_report;
    //    return $date_team['create_candidate'][0];
    //    return ["date"=>$date,"team_member"=>$team_member];
   }



}
