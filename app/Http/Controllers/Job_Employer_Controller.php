<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Tbl_cities;
use App\Tbl_countries;
use App\Tbl_email_list;
use App\Tbl_email_list_contacts;
use App\tbl_job_industries;
use App\Tbl_job_post_assign;
use App\Tbl_job_seekers;
use App\tbl_meeting;
use App\Tbl_post_contacts;
use App\tbl_post_job;
use App\tbl_post_jobs;
use App\tbl_schedule_interview;
use App\Tbl_seeker_academic;
use App\Tbl_seeker_applied_for_job;
use App\Tbl_schedule_preview;
use App\Tbl_seeker_applied_for_job_doc;
use App\Tbl_seeker_experience;
use App\Tbl_seeker_skills;
use App\tbl_team_member;
use App\Tbl_team_member_type;
use App\tbl_interview_add;
use App\Tbl_visa_type;
use App\Tbl_state;
use App\Tbl_qualifications;
use App\Tbl_notification;
use App\Tbl_team_member_permission;
use App\Tbl_forward_candidate;
use App\Tbl_forward_candidate_reference;
use App\Tbl_forward_candidate_exp_required;
use App\Tbl_forward_candidate_document;
use App\Tbl_module;
use App\Tbl_degree;
use App\Tbl_jobs_notes;
use Mail;
use App\user;
use Validator;
use App\cities;
use App\countries;
use App\states;
use App\tbl_candidate_notes;
use App\Tbl_job_mail;
use App\tbl_forward_emp_details;
use App\Tbl_seeker_documents;
use App\tbl_job_history;
use App\Tbl_time_zone;
use App\tbl_application_candidate_reference;
use App\tbl_application_candidate_exp_required;
use App\tbl_application_candidate_documents;
use App\tbl_application_emp_details;
use App\tbl_job_location;


class Job_Employer_Controller extends Controller
{

    public function __construct()
    {
        ini_set('memory_limit', '-1');
        $this->middleware('mian_session');
    }

    public function dashboard()
    {
        ini_set('memory_limit', '-1');
        $id = Session::get('user_id');
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $toReturn['one_day_job'] = count(tbl_post_job::whereDate('dated', '=', date('Y-m-d'))->where('employer_ID', Session::get('user_id'))->get());
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');

            $toReturn['total_job'] = count(tbl_post_jobs::where('employer_ID', Session::get('id'))->get());


            $toReturn['today_resume'] = count(Tbl_job_seekers::where('employer_id', Session::get('user_id'))->where('dated', '=', date('Y-m-d'))->get());
            $toReturn['total_resume'] = count(Tbl_job_seekers::where('employer_id', Session::get('user_id'))->get());

            $toReturn['total_interview'] = count(tbl_schedule_interview::get());
            $toReturn['today_interview'] = count(tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get());

            $toReturn['tota_interview'] = count(tbl_schedule_interview::get());
            $toReturn['today_meeting'] = count(tbl_meeting::where('meeting_date', '=', date('Y-m-d'))->get());
            $toReturn['total_meeting'] = count(tbl_meeting::get());
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
            if ($one_group_teammember_employer_id) {
                $toReturn['today_application'] = count(Tbl_seeker_applied_for_job::whereIn('submitted_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get());
                $toReturn['total_application'] = count(Tbl_seeker_applied_for_job::whereIn('submitted_by', $one_group_teammember_employer_id)->get());
            } else {
                $toReturn['today_application'] = count(Tbl_seeker_applied_for_job::where('employer_ID', Session::get('user_id'))->where('dated', '=', date('Y-m-d'))->get());
                $toReturn['total_application'] = count(Tbl_seeker_applied_for_job::where('employer_ID', Session::get('user_id'))->get());
            }
        }

        //team lead
        else if ($toReturn['user_type'] == "teamlead") {
            $toReturn['one_day_job'] = count(tbl_post_job::whereDate('dated', '=', date('Y-m-d'))->where('employer_ID', Session::get('user_id'))->get());
           
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
            $toReturn['total_job'] = count(tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->get());
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
            $toReturn['today_resume'] = count(Tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get());
            $toReturn['total_resume'] = count(Tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->get());
            $toReturn['total_interview'] = count(tbl_schedule_interview::get());
            $toReturn['today_interview'] = count(tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get());
            $toReturn['tota_interview'] = count(tbl_schedule_interview::get());
            $toReturn['today_meeting'] = count(tbl_meeting::where('meeting_date', '=', date('Y-m-d'))->get());
            $toReturn['total_meeting'] = count(tbl_meeting::get());
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
            if ($one_group_teammember_employer_id) {
                $toReturn['today_application'] = count(Tbl_seeker_applied_for_job::whereIn('submitted_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get());
                $toReturn['total_application'] = count(Tbl_seeker_applied_for_job::whereIn('submitted_by', $one_group_teammember_employer_id)->get());
            } else {
                $toReturn['today_application'] = count(Tbl_seeker_applied_for_job::where('employer_ID', Session::get('user_id'))->where('dated', '=', date('Y-m-d'))->get());
                $toReturn['total_application'] = count(Tbl_seeker_applied_for_job::where('employer_ID', Session::get('user_id'))->get());
            }
        } else {
            $org_id = Session::get('org_ID');
            $toReturn['showdata'] = tbl_post_jobs::where('company_ID', $org_id)->count();
            $toReturn['total_job'] = count(tbl_post_job::where('company_ID', $org_id)->get());
            $toReturn['one_day_job'] = count(tbl_post_job::whereDate('dated', '=', date('Y-m-d'))->where('company_ID', $org_id)->get());
           
            $toReturn['today_application'] = count(Tbl_seeker_applied_for_job::where('employer_ID', $id)->where('dated', '=', date('Y-m-d'))->get());
            $toReturn['total_application'] = count(Tbl_seeker_applied_for_job::whereIn('employer_ID', Session::get('one_group_teammember_id'))->get());
            // $toReturn['total_resume']=count(Tbl_job_seekers::where('employer_id',$id)->get());  
            $toReturn['tota_interview'] = count(tbl_schedule_interview::get());
            $toReturn['today_interview'] = count(tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get());
            $toReturn['today_meeting'] = count(tbl_meeting::where('meeting_date', '=', date('Y-m-d'))->get());
            $toReturn['total_meeting'] = count(tbl_meeting::get());
        }
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        if ($one_group_teammember_employer_id) {
            $toReturn['today_resume'] = count(Tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get());
            $toReturn['total_resume'] = count(Tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->get());
        } else {
            $toReturn['today_resume'] = count(Tbl_job_seekers::where('employer_id', Session::get('user_id'))->where('dated', '=', date('Y-m-d'))->get());
            $toReturn['total_resume'] = count(Tbl_job_seekers::where('employer_id', Session::get('user_id'))->get());
        }
        // $toReturn['today_application']=count(Tbl_seeker_applied_for_job::where('employer_ID',$id)->where('dated', '=',date('Y-m-d'))->get()); 
        // $toReturn['total_application']=count(Tbl_seeker_applied_for_job::where('employer_ID',$id)->get());
        //Upto header Section
        // $toReturn['job_post'] = tbl_post_job::paginate(10);     
        $toReturn['interview'] = tbl_schedule_interview::get()->toArray();
        $toReturn['meeting'] = tbl_meeting::get()->toArray();
        $toReturn['assign'] = Tbl_job_post_assign::get()->toArray();
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');

        for ($i = 0; $i < 7; $i++) {
            $toReturn['date'][$i] = date('d-m-Y', strtotime("-" . $i . "days"));
            $toReturn['Publish_DatejobCount'][$i] = tbl_post_job::where('dated', '=', date('Y-m-d', strtotime("-" . $i . "days")))->count();
            $toReturn['close_DatejobCount'][$i] = tbl_post_job::where('last_date', '=', date('Y-m-d', strtotime("-" . $i . "days")))->count();
        }
        if ($toReturn['user_type'] == "teammember") {
            $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        } else {
            $org_id = Session::get('org_ID');
        }
        //jobs
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        $post_job_show = tbl_job_seekers::get()->toArray();
        // job by applications
        ini_set('memory_limit', '-1');
        $user_type = Session::get('type');
        if ($user_type == "employer") {
            $user_id = Session::get('org_ID');
        } else {
            $user_id = Session::get('user_id');
        }
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');


        return view('employerdashboard')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);
    }

    public function status(Request $request)
    {
        ini_set('memory_limit', '-1');
        $id = $request->id;
        $status = $request->sts;
        if ($status == 'deleted') {
            $stsdelete = tbl_post_job::where('ID', $id)->delete();
        }
        tbl_post_job::where('ID', $id)->update(array(
            'sts' => $status
        ));
        return redirect('employer/dashboard');
    }

    public function view_post_form()
    {
        ini_set('memory_limit', '-1');
        $toReturn = array();
        // $toReturn['team_member_type'] = tbl_team_member_type::get()->toArray();
        $toReturn['post_job']        = tbl_post_jobs::get()->toArray();
        if (Session::get('type') == "employer") {
            $toReturn['team_member']     = tbl_team_member::get()->toArray();
            $toReturn['team_member_type'] = tbl_team_member_type::get()->toArray();
        } else {
            $toReturn['team_member']     = tbl_team_member::where('team_member_type', Session::get('teamleader_id'))->orWhere('ID', Session::get('user_id'))->get()->toArray();
            $toReturn['team_member_id'] = tbl_team_member::where('ID', Session::get('user_id'))->first();
            $toReturn['team_member_type'] = tbl_team_member_type::where('type_ID', @$toReturn['team_member_id']['team_member_type'])->get()->toArray();
            // return $toReturn['team_member_type'];

            // $toReturn['is_team_leader']=tbl_team_member_type::where('team_leader_id',Session::get('user_id'))->first();
        }
        $toReturn['job_industries']  = tbl_job_industries::get()->toArray();
        $toReturn['cities']          = cities::get()->toArray();
        $toReturn['countries']       = countries::get()->toArray();
        $toReturn['qualification']   = Tbl_qualifications::get()->toArray();
        $toReturn['visa_type'] = Tbl_visa_type::get()->toArray();
        $toReturn['states']          = states::get()->toArray();
        // $toReturn['countries']       =countries::where('')get()
        $country_name = "United States";
        $country_id = 224;
        return view('post_new_job')->with('toReturn', $toReturn)->with('country_name', $country_name)->with('country_id', $country_id);
    }

    public function Add_to_post_job(Request $request)
    {
        //  return $request;
        ini_set('memory_limit', '-1');
        // $jobs_list = tbl_post_jobs::where('job_code', 00000)->get()->toArray();
        // return $request->job_code;
        $Add_to_post_job = new tbl_post_jobs();
        $Add_to_post_job->for_group     =  $request->group_of_company;
        $Add_to_post_job->client_name    =  $request->company_name;
        $Add_to_post_job->privacy_level  =  $request->privacy_level;
        $Add_to_post_job->sts            =  $request->status;
        $Add_to_post_job->industry_ID    =  $request->industry;
        $Add_to_post_job->job_code       =  $request->job_code;
        $Add_to_post_job->job_title      =  $request->job_title;
        $Add_to_post_job->vacancies      =  $request->no_of_vacancies;
        $Add_to_post_job->employer_ID     = Session::get('id');
        $Add_to_post_job->owner_id = $request->owner_name;
        $Add_to_post_job->company_ID = Session::get('org_ID');
        $date = $request->closeing_date;
        $Add_to_post_job->last_date   =  date('Y-m-d', strtotime($date));
        $Add_to_post_job->dated       =  date('Y-m-d');
        $Add_to_post_job->job_visa_status =  implode(',', $request->visa);
        $Add_to_post_job->qualification  =  implode(',', $request->quali);
        $con =  $request->country_name;
        $sta =  $request->state_name;
        $cit =  $request->city_name;
        $city_text = $request->city_text_name;
        $val_contries = countries::where('country_id', $con)->first('country_name');
        $val_state = states::where('state_id', $sta)->first('state_name');
        if (!empty($city_text)) {
            $Add_to_post_job->city    = $city_text;
        } else {
            $val_city = cities::where('city_id', $cit)->first('city_name');
            $Add_to_post_job->city = $val_city['city_name'];
        }
        $Add_to_post_job->country = $val_contries['country_name'];
        $Add_to_post_job->state   = $val_state['state_name'];
        $Add_to_post_job->job_mode       =  $request->type_of_job;
        $Add_to_post_job->job_duration   =  $request->job_duration;
        $Add_to_post_job->job_duration_uom =  $request->day_week;
        $select_payment = $request->select_payment;
        if ($select_payment == 'DOE') {
            $Add_to_post_job->pay_min       =  $select_payment;
            $Add_to_post_job->pay_max      =  $select_payment;
        } else {
            $payment_array = explode('-', $select_payment);
            $Add_to_post_job->pay_min        =  $payment_array[0];
            $Add_to_post_job->pay_max      =  $payment_array[1];
            $Add_to_post_job->max_pay_rate        =  $payment_array[0];
            $Add_to_post_job->pay_rate_umo        =  $payment_array[1];
        }
        $Add_to_post_job->pay_uom        =  $request->pay_uom;
        $Add_to_post_job->min_pay_rate        =  $request->pay_min;
        $Add_to_post_job->experience     =  $request->experience;
        $Add_to_post_job->min_experience     =  $request->experience;
        $Add_to_post_job->max_experience     =  $request->experience;
        $Add_to_post_job->requirement_must =  $request->requirement;
        $Add_to_post_job->requirement_optional =  $request->requirements;
        $Add_to_post_job->job_description =  $request->job_desc;
        $Add_to_post_job->required_skills =  $request->skills;
        $Add_to_post_job->created_by = Session::get('id');
        $Add_to_post_job->last_updated_by = Session::get('id');
        $Add_to_post_job->save();
        $job_id = $Add_to_post_job->id;
        $job_code = $Add_to_post_job->job_code;
        $country_names_array=$request->country_name;
        //  return $country_names_array;
         if($country_names_array!=""){
            foreach($country_names_array as $key => $value){
                       $job_location = new tbl_job_location();
                       $job_location->job_id         =$job_id;
                       $job_location->employer_id    = Session::get('id');
                       $job_location->owner_name     = $request->owner_name;
                       $job_location->org_id         = Session::get('org_ID');
                       $job_location->country        = $request->country_name[$key] ?? "";
                       $job_location->state          = $request->state_name[$key] ?? "";
                       $job_location->city           = $request->city_name[$key]??"";
                       $job_location->save();
                }
        
            }
            
            


        //Add Notiofication
        // $notification=new Tbl_notification();
        // Session::flash('danger','Job Edited Successfully');
        $user_list = user::where('org_ID', Session::get('org_ID'))->get()->toArray();
        //   $user_user_id=implode(',',$user_list);
        //   echo $user_user_id;
        //   exit;

        $Notification = new Tbl_notification();
        $Notification->notification_service_id = $job_id;
        $Notification->service_type = "Post Job";
        // $Notification->notify_to=$user_list['user_id'];
        $Notification->notification_added_by = Session::get('user_id');
        $Notification->notification_added_to = $Add_to_post_job->company_name;
        $Notification->applied_id = " ";
        $Notification->notification_text = $Add_to_post_job->job_title . "This  job Is Posted By " . Session::get('full_name');
        $mydate = date('Y-m-d');
        $Notification->submit_date = $mydate;
        $Notification->updated_date = $mydate;
        $Notification->read_date = $mydate;
        $Notification->read_status_team_member = 1;
        $Notification->read_date_team_member = $mydate;
        // $Notification->notification_service_id=$Add_to_post_job->ID;
        $Notification->save();
        Session::flash('success', 'Job Post Successfully');
        return redirect('employer/posted_jobs');
            
        
    }


 
    public function editjob(  $id ="" )
    {
        ini_set('memory_limit', '-1');
        $toReturn[] = array();
        $to = tbl_post_jobs::where('ID', $id)->get('for_group')->toArray();
        $toReturn['member_type'] = Tbl_team_member_type::where('type_ID', $to)->get('type_name')->first();
        //    return $toReturn['member_type'];
        $toReturn['qualification'] = Tbl_qualifications::get()->toArray();
        $toReturn['post_job_edit'] = tbl_post_jobs::get()->toArray();
        $toReturn['post_job'] = tbl_post_jobs::where('ID', $id)->first();
        $io = tbl_post_jobs::where('ID', $id)->get()->first();
        $toReturn['name'] = tbl_team_member::where('ID', $io['owner_id'])->get(['ID', 'full_name'])->toArray();
        $toReturn['team_member_type'] = tbl_team_member_type::get()->toArray();
        $toReturn['team_member']     = tbl_team_member::get()->toArray();
        // return $toReturn['team_member'];
        $toReturn['job_industries']  = tbl_job_industries::get()->toArray();
        $toReturn['industries_name'] = tbl_job_industries::where('ID', $toReturn['post_job']['industry_ID'])->first();
        // return $toReturn['job_industries'];
        $toReturn['cities']          = cities::get()->toArray();
        $toReturn['countries']       = countries::get()->toArray();
        $toReturn['states']          = states::get()->toArray();
        $post_job1 = tbl_post_jobs::where('ID', $id)->get('country')->first();
        $post_job2 = tbl_post_jobs::where('ID', $id)->get('state')->first();
        $post_job3 = tbl_post_jobs::where('ID', $id)->get('city')->first();
        $toReturn['qualification']   = Tbl_qualifications::get()->toArray();
        $toReturn['visa_type'] = Tbl_visa_type::get()->toArray();
        // return $toReturn['post_job3'];
        $toReturn['country'] = countries::where('country_name', $post_job1['country_name'])->get()->toArray();
        $toReturn['state'] = states::where('state_name', $post_job2['state_name'])->get()->toArray();
        $toReturn['city'] = cities::where('city_name', $post_job3['city_name'])->get()->toArray();
        //  return  $toReturn['country_one'];
        $toReturn['countries']       = countries::get()->toArray();

        $toReturn['job_location']=tbl_job_location::where('job_id',$id)->get();

        // return $toReturn['job_location'];
        // return $toReturn['industries_name'];
        // return $toReturn['post_job'];
        // $toReturn['team_member_name']=tbl_team_member::where('ID',$toReturn['post_job']['industry_ID'])->first('industry_name');
        return view('edit_posted_job')->with('toReturn', $toReturn);
    }


    public function updatejob(Request $Request)
    {
        ini_set('memory_limit', '-1');
        //  return $Request;
        $con =  $Request->country;
        $sta =  $Request->state;
        $cit =  $Request->city;
        $city_text =  $Request->city_text_name;
        $val_contries = countries::where('country_id', $con)->orWhere('country_name', $con)->first('country_name');
        $val_state = states::where('state_id', $sta)->orWhere('state_name', $sta)->first('state_name');
        if (!empty($city_text)) {
            $val_city['city_name'] = $city_text;
        } else {
            $val_city = cities::where('city_id', $cit)->orWhere('city_name', $cit)->first('city_name');
        }
        $id = $Request->id;
        $job_detail = array(
            'client_name' => $Request->company_name,
            'privacy_level' => $Request->privacy_level,
            'sts' => $Request->status,
            'industry_ID' => $Request->industry,
            'job_code' => $Request->job_code,
            'job_title' => $Request->job_title,
            'last_date' => $Request->closeing_date,
            'vacancies' => $Request->no_of_vacancies,
            'job_visa_status' => implode(',', $Request->visa),
            'qualification'  => implode(',', $Request->quali),
            'sts' => $Request->status,
            'country' => $val_contries['country_name'],
            'city' => $val_city['city_name'],
            'state' => $val_state['state_name'],
            'job_mode' => $Request->type_of_job,
            'job_duration' => $Request->job_duration,
            'job_duration_uom' => $Request->day_week,
            'pay_uom' => $Request->pay_uom,
            'experience' => $Request->experience,
            'requirement_must' => $Request->requirement,
            'requirement_optional' => $Request->requirements,
            'job_description' => $Request->job_desc,
            'required_skills' => $Request->skills,
            'owner_id' => $Request->owner_name,
            'for_group' => $Request->group_of_company
        );
        $select_payment = $Request->select_payment;
          if($select_payment == 'DOE') {
            $job_detail['pay_min']  =  $select_payment;
            $job_detail['pay_max'] = $select_payment;
        } else {
            $payment_array = explode('-', $select_payment);
            $job_detail['pay_min']  =  $payment_array[0];
            $job_detail['pay_max']  =  $payment_array[1];
        }

            $post_job = tbl_post_jobs::where('ID', $id)->update($job_detail);

            $country_names_array=$Request->country_name;
            $delete_joblocation_array=tbl_job_location::where('job_id',$Request->id)->get();// Search Record For delete
            if($delete_joblocation_array!="")
            {
                foreach($delete_joblocation_array as $key_delete=>$value_delete)
                {
                    tbl_job_location::where('id',$delete_joblocation_array[$key_delete]['id'])->delete();// Deleteing Exiting Record 
                }
            }
            if($country_names_array!=""){
            foreach($country_names_array as $key => $value){
                $job_location = new tbl_job_location();// Inserting New Country Record
                $job_location->job_id         =$Request->id;
                $job_location->employer_id    = Session::get('id');
                $job_location->owner_name     = $Request->owner_name;
                $job_location->org_id         = Session::get('org_ID');
                $job_location->country        = $Request->country_name[$key] ?? "";
                $job_location->state          = $Request->state_name[$key] ?? "";
                $job_location->city           = $Request->city_name[$key]??"";
                $job_location->save();
            }
            }
            
            
        $Notification = new Tbl_notification();
        $Notification->notification_service_id = $id;
        $Notification->service_type = "Update Job";
        $Notification->notification_added_by = Session::get('id');
        $Notification->notification_added_to = $Request->company_name;
        $Notification->applied_id = " ";
        $Notification->notification_text = $Request->job_title . "This  job Is Update By " . Session::get('full_name');
        $mydate = date('Y-m-d');
        $Notification->submit_date = $mydate;
        $Notification->updated_date = $mydate;
        $Notification->read_date = $mydate;
        $Notification->read_status_team_member = 1;
        $Notification->read_date_team_member = $mydate;
        // $Notification->notification_service_id=$Add_to_post_job->ID;
        $Notification->save();

        return redirect('employer/posted_jobs');
}

       public function view_my_posted_job()

    {
        // $toReturn[] = array();
        // $toReturn['user_type'] = Session::get('type');
        // $post_job_show = tbl_job_seekers::get()->toArray();
        //     $toReturn['post_job'] = tbl_post_jobs::orderBy('ID', 'DESC')->paginate(20);

        // return view('my_posted_jobs')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);

        ini_set('memory_limit', '-1');
        $toReturn[] = array();
        $current_module_id = 3;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
            $toReturn['post_job'] = tbl_post_jobs::where('employer_ID', Session::get('id'))->orderBy('ID', 'DESC')->paginate(20);
        }

        if ($toReturn['user_type'] == 'teamlead') {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
            $group_teammember_user_id = Session::get('one_group_teammember_id');

            foreach (@$group_teammember_user_id as $key => $value) {
                $teammember_record = user::where('ID', $group_teammember_user_id[$key])->where('user_type', "teammember")->first();
                $one_group_teammember_employer_id[$key] = @$teammember_record->ID;
            }
            // $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->orderBy('ID', 'DESC')->paginate(20);

            $array_val = Session::get('one_group_teammember_id');

            $toReturn['post_job']  = tbl_post_jobs::whereIn('created_by', $array_val)->orderBy('ID', 'DESC')->paginate(20);
        }

        if ($toReturn['user_type'] == "employer") {
            $toReturn['post_job'] = tbl_post_jobs::where('company_ID', Session::get('org_ID'))->orderBy('ID', 'DESC')->paginate(20);
        }
        $post_job_show = tbl_job_seekers::get()->toArray();

        return view('my_posted_jobs')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);
    }


    public function view_jobs_open_today()

    {
        // $toReturn[] = array();
        // $toReturn['user_type'] = Session::get('type');
        // $post_job_show = tbl_job_seekers::get()->toArray();
        //     $toReturn['post_job'] = tbl_post_jobs::orderBy('ID', 'DESC')->paginate(20);

        // return view('my_posted_jobs')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);

        ini_set('memory_limit', '-1');
        $toReturn[] = array();
        $current_module_id = 3;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
            $toReturn['post_job'] = tbl_post_jobs::whereDate('dated', '=', date('Y-m-d'))->where('employer_ID', Session::get('user_id'))->get();


        }

        if ($toReturn['user_type'] == 'teamlead') {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
            $group_teammember_user_id = Session::get('one_group_teammember_id');

            foreach (@$group_teammember_user_id as $key => $value) {
                $teammember_record = user::where('ID', $group_teammember_user_id[$key])->where('user_type', "teammember")->first();
                $one_group_teammember_employer_id[$key] = @$teammember_record->ID;
            }
            // $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->orderBy('ID', 'DESC')->paginate(20);

            $array_val = Session::get('one_group_teammember_id');

            $toReturn['post_job']  = tbl_post_jobs::whereDate('dated', '=', date('Y-m-d'))->where('employer_ID', Session::get('user_id'))->get();
        }

        if ($toReturn['user_type'] == "employer") {
            $toReturn['post_job'] = tbl_post_jobs::whereDate('dated', '=', date('Y-m-d'))->where('employer_ID', Session::get('user_id'))->get();
        }
        $post_job_show = tbl_job_seekers::get()->toArray();

        return view('my_posted_jobs')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);
    }



    public function PostjobsAssignToJobSeeker(Request $request)
    {
        ini_set('memory_limit', '-1');
        if ($request->seekerID != '' && $request->jobID != '') {
            $candiate_record = tbl_job_seekers::where('ID', $request->seekerID)->first();
            $job_record = tbl_post_jobs::where('ID', $request->jobID)->first();
            // return $candiate_record;
            $data = new Tbl_seeker_applied_for_job();
            $data->seeker_ID = $request->seekerID;
            $data->job_ID = $request->jobID;
            $data->expected_salary = $job_record->pay_min . "-" . $job_record->pay_max;
            $data->candate_name = $candiate_record->first_name . $candiate_record->last_name;
            $data->phone_no_mobile = $candiate_record->mobile;
            $data->email_id = $candiate_record->email;
            $data->updated_resume = $candiate_record->cv_file;
            $data->skype_id = $candiate_record->skype_id;
            $data->current_location = $candiate_record->city . " " . $candiate_record->state;
            $data->visa_status = $candiate_record->visa_status;
            $data->pay_min = $job_record->pay_min;
            $data->pay_max = $job_record->pay_max;
            $data->ip_address = $request->ip();
            $data->employer_ID = Session::get('user_id');
            $data->dated = date('Y-m-d');
            $data->is_employer = 0;

            $data->submitted_by = Session::get('user_id');

            $data->save();
            $job_history = new tbl_job_history();
            $job_history->job_id = $request->jobID;
            $job_history->update_text = "This is Job Is Submit to Candidate";
            $job_history->date = date('Y-m-d');
            $job_history->created_by = Session::get('id');
            $job_history->updated_by = Session::get('id');
            $job_history->save();
            Session::flash('success', 'Job Post Successfully');
            return back();
        } else {
            Session::flash('error', 'Plz Select The User');
            return back();
        }
    }
    public function delete_employer($id = '')
    {
        ini_set('memory_limit', '-1');
        $employer_data1 = tbl_post_jobs::where('ID', $id)->first('job_title');
        // return $employer_data1;
        $Notification = new Tbl_notification();
        $Notification->notification_service_id = $id;
        $Notification->service_type = "Delete Job";
        $Notification->notification_added_by = Session::get('id');
        $Notification->notification_added_to = $employer_data1;
        $Notification->applied_id = " ";
        $Notification->notification_text = $employer_data1->job_title . "This Job is Delete  By " . Session::get('full_name');
        $mydate = date('Y-m-d');
        $Notification->submit_date = $mydate;
        $Notification->updated_date = $mydate;
        $Notification->read_date = $mydate;
        $Notification->read_status_team_member = 1;
        $Notification->read_date_team_member = $mydate;
        // $Notification->notification_service_id=$Add_to_post_job->ID;
        $Notification->save();


        $employer_data = tbl_post_jobs::where('ID', $id)->delete();


        return redirect('employer/posted_jobs');
    }

    public function show_detail($id = "")
    {
        ini_set('memory_limit', '-1');
        $data = tbl_post_jobs::where('ID', $id)->first();
        $industry = tbl_job_industries::where('ID', $data->industry_ID)->first();
        return view('team_member_jobdetails')
            ->with('data', $data)
            ->with('industry', $industry);
    }

    public function application()
    {
        ini_set('memory_limit', '-1');
        $user_type = Session::get('type');
        if ($user_type == "employer") {
            $user_id = Session::get('org_ID');
        } else {
            $user_id = Session::get('user_id');
        }
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        // return $one_group_teammember_employer_id;
        if ($one_group_teammember_employer_id) {
            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                // ->leftjoin('tbl_seeker_applied_for_job as applied_jobs','applied_jobs.job_ID','=','post_jobs.ID ' )
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->whereIn('tbl_seeker_applied_for_job.submitted_by', $one_group_teammember_employer_id)
                ->where('tbl_seeker_applied_for_job.org_id', Session::get('org_ID'))
                ->orderBy('tbl_seeker_applied_for_job.ID', 'DESC')
                ->paginate(20);
            // return $toReturn['application'][1]['job_state']; 
        } else {
            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                // ->leftjoin('tbl_seeker_applied_for_job as applied_jobs','applied_jobs.job_ID','=','post_jobs.ID ')
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->where('tbl_seeker_applied_for_job.employer_ID', $user_id)
                ->orderBy('tbl_seeker_applied_for_job.ID', 'DESC')
                ->paginate(20);
        }
        return view('employerApplication')->with('toReturn', $toReturn);
    }

    public function application_received_today()
    {
        ini_set('memory_limit', '-1');
        $user_type = Session::get('type');
        if ($user_type == "employer") {
            $user_id = Session::get('org_ID');
        } else {
            $user_id = Session::get('user_id');
        }
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        // return $one_group_teammember_employer_id;
        if ($one_group_teammember_employer_id) {
            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                // ->leftjoin('tbl_seeker_applied_for_job as applied_jobs','applied_jobs.job_ID','=','post_jobs.ID ' )
                ->whereIn('tbl_seeker_applied_for_job.submitted_by', $one_group_teammember_employer_id)
                ->where('tbl_seeker_applied_for_job.dated', '=', date('Y-m-d'))
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->get();
            // return $toReturn['application'][1]['job_state']; 
        } else {
            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                // ->leftjoin('tbl_seeker_applied_for_job as applied_jobs','applied_jobs.job_ID','=','post_jobs.ID ')
                ->whereIn('tbl_seeker_applied_for_job.submitted_by', $one_group_teammember_employer_id)
                ->where('tbl_seeker_applied_for_job.dated', '=', date('Y-m-d'))
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->where('tbl_seeker_applied_for_job.employer_ID', $user_id)
                ->get();
        }
        return view('employerApplication')->with('toReturn', $toReturn);
    }

    public function application_delete($id = '')
    {

        ini_set('memory_limit', '-1');
        $employer_application_delete = Tbl_seeker_applied_for_job::where('ID', $id)->delete();
        return redirect('employer/Application');
    }

    public function list()
    {
        ini_set('memory_limit', '-1');
        $toReturn = array();
        $source = "Internal";
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        if ($one_group_teammember_employer_id) {
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);
            $personal = tbl_job_seekers::whereIn('created_by', $one_group_teammember_employer_id)->orderBy('ID', 'DESC')
                ->distinct()
                ->paginate(20);
            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        } else {
            $toReturn['post_job'] = tbl_post_jobs::where('employer_ID', Session::get('id'))->paginate(10);
            $personal = tbl_job_seekers::where('tbl_job_seekers.employer_id', Session::get('user_id'))->where('org_id', Session::get('org_ID'))->orderBy('ID', 'DESC')->distinct()->paginate(20);
            foreach ($personal as $key => $value) {
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $current_module_id = 2;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
        }
        if ($toReturn['user_type'] == "employer") {
            $all_user_id = user::where('org_ID', Session::get('org_ID'))->get('ID')->toArray();
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);
            $personal = tbl_job_seekers::whereIn('created_by', $one_group_teammember_employer_id)->where('org_id', Session::get('org_ID'))->orderBy('ID', 'DESC')
                ->distinct()
                ->paginate(20);
            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $job_list = Tbl_post_jobs::select('job_code', 'job_title', 'ID')->get()->toArray();
        return view('search_resume')->with('personal', $personal)->with('source', $source)->with('toReturn', $toReturn)->with('job_list', $job_list);
    }


    public function list_todays_resume()
    {
        ini_set('memory_limit', '-1');
        $toReturn = array();
        $source = "Internal";
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        if ($one_group_teammember_employer_id) {
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);
            $personal = tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get();
               
             
            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        } else {
            $toReturn['post_job'] = tbl_post_jobs::where('employer_ID', Session::get('id'))->paginate(10);
            $personal = tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get();
            foreach ($personal as $key => $value) {
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $current_module_id = 2;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
        }
        if ($toReturn['user_type'] == "employer") {
            $all_user_id = user::where('org_ID', Session::get('org_ID'))->get('ID')->toArray();
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);
            $personal = tbl_job_seekers::whereIn('tbl_job_seekers.created_by', $one_group_teammember_employer_id)->where('dated', '=', date('Y-m-d'))->get()
                ->distinct()
                ->paginate(20);
            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $job_list = Tbl_post_jobs::select('job_code', 'job_title', 'ID')->get()->toArray();
        return view('search_resume')->with('personal', $personal)->with('source', $source)->with('toReturn', $toReturn)->with('job_list', $job_list);
    }
    public function list_delete($id = "")
    {
        ini_set('memory_limit', '-1');
        $personal = tbl_job_seekers::where('ID', $id)->delete();
        return redirect('employer/search_resume');
    }


    public function show_form()
    {
        ini_set('memory_limit', '-1');
        $toReturn = array();
        $toReturn['degree'] = Tbl_seeker_academic::get()->toArray();
        $toReturn['visa_type'] = Tbl_visa_type::get()->toArray();
        $toReturn['cities']          = cities::get()->toArray();
        $toReturn['countries']       = countries::get()->toArray();
        $toReturn['qualification']   = Tbl_qualifications::get()->toArray();
        $toReturn['visa_type'] = Tbl_visa_type::get()->toArray();
        $toReturn['states']          = states::get()->toArray();
        return view('post_new_candidate')->with('toReturn', $toReturn);
    }

    public function post_new_candidate(Request $request)
    {
        ini_set('memory_limit', '-1');
        $con =  $request->country;
        $sta =  $request->state;
        $cit =  $request->city_name;
        $city_text = $request->city_text_name;

        $val_contries = countries::where('country_id', $con)->first('country_name');
        $val_state = states::where('state_id', $sta)->first('state_name');

        $validation = Validator::make($request->all(), [
            'cv_file' => 'required'
        ]);
        $cv = $request->file('cv_file');
        $store_cv = $cv->getClientOriginalName();
        $cv->move(public_path('seekerresume'), $store_cv);
        if ($request->hasFile('file_other1')) {
            $file_other1 = $request->file('file_other1');
            $file_other1_cv = $file_other1->getClientOriginalName();
            $file_other1->move(public_path('seekerresume'), $file_other1_cv);
        }
        if ($request->hasFile('file_other2')) {
            $file_other2 = $request->file('file_other2');
            $file_other2_cv = $file_other2->getClientOriginalName();
            $file_other2->move(public_path('seekerresume'), $file_other2_cv);
        }
        $postcandidate = new Tbl_job_seekers();
        $postcandidate->first_name = $request->first_name;
        $postcandidate->middle_name = $request->middle_name;
        $postcandidate->last_name = $request->last_name;
        $date = $request->dob;
        $postcandidate->dob  =  date('Y-m-d', strtotime($date));
        $postcandidate->gender = $request->gender;
        $postcandidate->email = $request->email;
        $postcandidate->skype_id = $request->skype_id;
        $postcandidate->ssn = $request->ssn;
        $postcandidate->visa_status = $request->visa_status;

        $postcandidate->address_line_1 = $request->addressline1;
        $postcandidate->address_line_2 = $request->addressline2;
        $postcandidate->mobile = $request->mobilephone;
        $postcandidate->home_phone = $request->homephone;
        $postcandidate->cv_file = $store_cv;
        // if (!empty($city_text)) {
        //     $postcandidate->city    = $city_text;
        if (($city_text !== "") && ($city_text !== null)) {
            $postcandidate->city    = $city_text;
        } else {
            $val_city = cities::where('city_id', $cit)->first('city_name');
            $postcandidate->city = $val_city['city_name'];
        }
        $postcandidate->country = $val_contries['country_name'];
        $postcandidate->state   = $val_state['state_name'];

        if ($request->hasFile('file_other1')) {
            $postcandidate->otherdocuments1 = $file_other1_cv;
        }
        if ($request->hasFile('file_other2')) {
            $postcandidate->otherdocuments2 = $file_other2_cv;
        }
        $postcandidate->fed_id = 12;
        $mydate = date('Y-m-d');
        $postcandidate->dated = $mydate;
        $postcandidate->experience = "";
        $postcandidate->default_cv_id = 1;
        // $postcandidate->cv_file=;
        $postcandidate->skills = $request->skills;
        $postcandidate->employer_id = Session::get('user_id');
        $postcandidate->created_by = Session::get('user_id');
        $postcandidate->is_employer = Session::get('user_id');
        $postcandidate->owner_id = "";
        $postcandidate->min_pay_rate = "";
        $postcandidate->max_pay_rate = "";
        $postcandidate->pay_rate_umo = "";
        $postcandidate->experience = $request->total_experience;
        $postcandidate->total_experience = $request->experience;
        $postcandidate->total_usa_experience = $request->total_usa_experience;
        $postcandidate->org_id = Session::get('org_ID');
        $postcandidate->save();
        $id = $postcandidate->id;
        //return $id;
        // educational insert
        $degree = $request->degree;
        foreach ($degree as $key => $value) {
            if ($degree[$key] != "") {
                $seeker_academic = new Tbl_seeker_academic();
                $seeker_academic->seeker_ID    = $id;
                $seeker_academic->degree_title   = $degree[$key];
                $seeker_academic->major           = $request->major_subject[$key];
                $seeker_academic->institude       = $request->institute[$key];
                $seeker_academic->city            = $request->edu_city[$key];
                $seeker_academic->country         = $request->edu_country[$key];
                $seeker_academic->completion_year = $request->completion_year[$key];
                // $seeker_academic->dated=data('Y-m-d');               
                $seeker_academic->save();
            }
            // return $seeker_academic->id;
        }

        //experiance  start
        $job_title_experience = $request->job_title;
        foreach ($job_title_experience as $key => $value) {
            if ($job_title_experience[$key] != "") {
                $seeker_exprience = new Tbl_seeker_experience();
                $seeker_exprience->seeker_ID = $id;
                $seeker_exprience->job_title  = $job_title_experience[$key];
                $seeker_exprience->company_name = $request->company_name[$key];
                $seeker_exprience->city         = $request->exp_city[$key];
                $seeker_exprience->country      = $request->exp_country[$key];
                $seeker_exprience->start_date   = $request->start_date[$key];
                $seeker_exprience->end_date     = $request->end_date[$key];
                $seeker_exprience->save();
            }
        }
        //   experiance end

        if ($request->file('multi_docs') != "") {

            foreach ($request->file('multi_docs') as $key => $file) {
                $user_document_name = $request->multi_docs[$key];
                $file_name = $user_document_name->getClientOriginalName();
                $file_uploaded = $user_document_name->getClientOriginalExtension();
                $user_document_name->move(public_path('forward_document'), $file_name);
                $candidate_documents = new Tbl_seeker_documents();
                $candidate_documents->document_type =  $file_uploaded;
                $candidate_documents->file_name = $file_name;
                $candidate_documents->status = 1;
                $candidate_documents->dated = date("Y/m/d h:i:s");
                $candidate_documents->seeker_ID = $id;

                //return ('$candidate_documents');
                $candidate_documents->save();
            }
        }
        //skill  start
        $seeker_skill_name = new Tbl_seeker_skills();
        $seeker_skill_name->seeker_ID = $id;
        $seeker_skill_name->skill_name = $request->skill;
        $seeker_skill_name->save();
        // return $seeker_skill_name->id;
        $can_ID = $postcandidate->id;
        $nam = $postcandidate->first_name . $postcandidate->last_name . $postcandidate->last_name;




        $Notification = new Tbl_notification();
        $Notification->notification_service_id = $can_ID;
        $Notification->service_type = "Add Candidate";
        $Notification->notification_added_by = Session::get('id');
        $Notification->notification_added_to = $nam;
        $Notification->applied_id = " ";
        $Notification->notification_text = $nam . "This  Candidate Is Posted By " . Session::get('full_name');
        $mydate = date('Y-m-d');
        $Notification->submit_date = $mydate;
        $Notification->updated_date = $mydate;
        $Notification->read_date = $mydate;
        $Notification->read_status_team_member = 1;
        $Notification->read_date_team_member = $mydate;
        // $Notification->notification_service_id=$Add_to_post_job->ID;
        $Notification->save();






        return redirect('employer/search_resume');
    }

    // function uploaded_resume(Request $request)
    //   {
    //     return $request;
    //  $validation = Validator::make($request->all(), [
    //   'Upload_image' => 'required'
    //  ]);
    //  if($validation->passes())
    //  {
    //   $image = $request->file('select_file');
    //   $new_name = rand() . '.' . $image->getClientOriginalExtension();
    //   $image->move(public_path('images'), $new_name);
    //   return response()->json([
    //   'message'   => 'Image Upload Successfully',
    //   'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
    //   'class_name'  => 'alert-success'
    //   ]);
    //  }
    //  else
    //  {
    //   return response()->json([
    //   'message'   => $validation->errors()->all(),
    //   'uploaded_image' => '',
    //   'class_name'  => 'alert-danger'
    //   ]);
    //  }
    // }




    // Team member managing functions
    public function showteam()
    {
        ini_set('memory_limit', '-1');
        $module = Tbl_module::all();
        return view('create_team_member')
            ->with('group', Tbl_team_member_type::all())
            ->with('country', tbl_countries::all())
            ->with('city', tbl_cities::all())
            ->with('module', $module);
    }

    public function showteamadd(Request $Request)
    {
        ini_set('memory_limit', '-1');
        if ($Request->hasFile('profile_image')) {
            $profile_image = $Request->file('profile_image');
            $new_profile_image = rand() . '.' . $profile_image->getClientOriginalExtension();
            $profile_image->move(public_path('seekerresume'), $new_profile_image);
        }
        $team = new tbl_team_member();
        $team->employer_id = Session::get('id');
        $team->company_id = Session::get('org_ID');
        $team->org_id = Session::get('org_ID');
        // 	return $Request->member_id;
        $team->member_id = $Request->member_id;
        $team->team_member_type = $Request->group;
        $team->assigned_jobs = " ";
        $team->email = $Request->email;
        $team->pass_code = $Request->password;
        $team->full_name = $Request->full_name;
        $team->first_name = $Request->full_name;
        if ($Request->hasFile('profile_image')) {
            $team->profile_image = $new_profile_image;
        }
        $team->jobs_history = $Request->jobs_history;
        $team->is_active = "active";
        $date = date('Y-m-d');
        $team->dated = $date;
        $team->phone = $Request->phone;
        $team->mobile_number = $Request->mobile_number;
        $team->sts = 'active';
        // $team->country=$Request->country;
        // $team->state=$Request->state;
        // $team->city=$Request->city;
        // $team->loc_time_zone=$Request->timea;
        // $team->dis_time_zone=$Request->timeb;
        $time = date('Y-m-d h:i:s', time());
        $team->first_login_date = $time;
        $team->last_login_date = $time;
        $team->last_updated_date = $time;
        $team->last_updated_by = Session::get('id');
        $team->save();
        $module = $Request->module;
        foreach ($module as $key => $value) {
            $permission = new Tbl_team_member_permission();
            $permission->team_member_id = $team->id;
            $permission->employer_id = Session::get('id');
            $permission->company_id = Session::get('org_ID');
            $permission->permission_value = $value;
            $permission->is_read = (!empty($Request->input('read' . $value))) ? "yes" : "no";
            $permission->is_add = (!empty($Request->input('add' . $value))) ? "yes" : "no";
            $permission->is_edit = (!empty($Request->input('edit' . $value))) ? "yes" : "no";
            $permission->is_delete = (!empty($Request->input('delete' . $value))) ? "yes" : "no";
            $permission->save();
        }
        $user_tbl = new user();
        $user_tbl->full_name = $Request->full_name;
        $user_tbl->email = $Request->email;
        $user_tbl->user_id = $team->id;
        $user_tbl->sts = 'active';
        $user_tbl->password = $Request->password;
        $user_tbl->user_type = $Request->team_type;
        $user_tbl->org_ID = Session::get('org_ID');
        $user_tbl->save();
        return redirect('employer/manageteammember');
    }


    public function addteam()
    {
        ini_set('memory_limit', '-1');
        return view('create_team_member_group');
    }


    public function addteaminsert(Request $Request)
    {
        ini_set('memory_limit', '-1');
        $teamType = new Tbl_team_member_type();
        $teamType->type_name = $Request->groupname;
        $teamType->status = 1;
        $date = date('Y-m-d h:i:s');
        $teamType->date_created = $date;
        $teamType->date_closed = $date;
        $teamType->last_updated_date = $date;
        $teamType->last_updated_by = Session::get('id');
        $teamType->org_id = Session::get('org_ID');
        $teamType->save();
        return redirect('employer/manageteammember');
    }

    public function editteam(Request $Request)
    {
        ini_set('memory_limit', '-1');
        $id = $Request->id;
        $editteamgroup = Tbl_team_member_type::where('type_ID', $id)->update(array(
            'type_name' => $Request->type_namegroup
        ));
        return redirect('employer/manageteammember');
    }


    public function manageteam()
    {
        ini_set('memory_limit', '-1');
        $current_module_id = 11;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
        }
        // return $toReturn;
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
            ->where('company_id', Session::get('org_ID'))
            ->where('tbl_team_member.is_active', 'active')
            ->get();

        $team_member_type = tbl_team_member_type::where('org_id', Session::get('org_ID'))->get();

        return view('manage_team_members')->with("team_member", $team_member)->with("team_member_type", $team_member_type)->with('toReturn', $toReturn);
    }




    // new 
    public function report_show($id = "", $name = "")
    {
        ini_set('memory_limit', '-1');
        //for days
        $team_memeber = tbl_team_member::where('ID', $id)->first('email');
        $data = $team_memeber['email'];
        $user = user::where('user_id', $id)->first();


        for ($j = 0; $j < 12; $j++) {
            $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-' . $j . ' days'));
            $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-' . $j . ' days'));
            $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
            $toReturn['week_report'][$j]['job_created'] = count(tbl_post_job::whereDate('dated', $newDate[$j])->where('created_by', $user->ID)->get());
            $toReturn['week_report'][$j]['candidate_created'] = count(Tbl_job_seekers::whereDate('dated', $newDate[$j])->where('created_by', $id)->get());
            $toReturn['week_report'][$j]['client_submittal'] = count(Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->where('forward_by', $data)->get());
            $toReturn['week_report'][$j]['application_submitted'] = count(Tbl_seeker_applied_for_job::whereDate('dated', $newDate[$j])->where('submitted_by', $id)->get());
        }

        // for months;
        $global = "";

        for ($i = 0; $i < 12; $i++) {
            if ($i == 0) {
                $one = date('d-m-Y');
                $global = $one;
            } else {
                $two = date('d-m-Y', (strtotime('-30 days', strtotime($global))));
                $toReturn['monthly'][$i]['month_week_one1'] = $newDate = date("m-Y", strtotime($global));
                $toReturn['monthly'][$i]['job_created_monthly1'] = count(tbl_post_job::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->where('created_by', $user->ID)->get());
                $toReturn['monthly'][$i]['candidate_created_monthly1'] = count(Tbl_job_seekers::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->where('created_by', $id)->get());
                $toReturn['monthly'][$i]['client_submittal_monthly1'] = count(Tbl_forward_candidate::whereMonth('forward_date', $toReturn['monthly'][$i]['month_week_one1'])->where('forward_by', $data)->get());
                $toReturn['monthly'][$i]['application_submitted_monthly1'] = count(Tbl_seeker_applied_for_job::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->where('submitted_by', $id)->get());
                $global = $two;
            }
        }

        return view('report_manage_team_member')->with('toReturn', $toReturn)->with('name', $name);
    }

    // starts here
    public function permission_org()
    {
        ini_set('memory_limit', '-1');
        $type = Session::get('type');
        $data = "";
        if ($type == "employer") {
            $data = "Yes";
        }else if($type=="teamlead")
        {
            $data ="no";
        }
         else{
            $data = "no";
        }
        return $data;
    }

    // above this comment is permission for org profile


    public function delete_teammember($id = "")
    {
        ini_set('memory_limit', '-1');
        // $team_member_del = tbl_team_member::where('ID', $id)->delete();

        tbl_team_member::where('ID', $id)->update(array(
            'is_active' => 'inactive'
        ));
        user::where('user_id', $id)->update(array(
            'sts' => 'inactive'
        ));

        return redirect('employer/manageteammember');
    }


    public function edit_teammember($id = "")
    {
        ini_set('memory_limit', '-1');
        $data = tbl_team_member::where('ID', $id)->first();
        $toReturn['cities']     = cities::get()->toArray();
        $toReturn['user']     = user::where('user_id', $id)->first();
        $toReturn['countries']  = countries::get()->toArray();
        $toReturn['states']     = states::get()->toArray();
        $toReturn['editteam'] = tbl_team_member_permission::where('team_member_id', $id)
            ->leftjoin('tbl_module', 'tbl_module.module_id', '=', 'tbl_team_member_permission.permission_value')
            ->select(
                'tbl_module.module_id as moduleid',
                'tbl_module.module_name as nameofmodule',
                'tbl_team_member_permission.is_add as add',
                'tbl_team_member_permission.is_edit as edit',
                'tbl_team_member_permission.is_delete as delete',
                'tbl_team_member_permission.is_read as read'
            )->get()->toArray();



        return view('edit_team_member')
            ->with('data', $data)
            ->with('toReturn', $toReturn)
            ->with('group', Tbl_team_member_type::all());
    }


    public function edit_teammember_add(Request $Request)
    {
        ini_set('memory_limit', '-1');
        // return $Request->profile_image;
        $date = date('Y-m-d h:i:s', time());
        $con =  $Request->country;
        $sta =  $Request->state;
        $cit =  $Request->city;
        $val_contries = countries::where('country_id', $con)->orWhere('country', $con)->first('country_name');
        $val_state = states::where('state_id', $sta)->orWhere('state_name', $sta)->first('state_name');
        $val_city = cities::where('city_id', $cit)->orWhere('city_name', $cit)->first('city_name');
        if ($Request->has('profile_image')) {
            $cv = $Request->file('profile_image');
            $store_cv = $cv->getClientOriginalName();
            $cv->move(public_path('seekerresume'), $store_cv);
            // echo $cv;
            // echo"done";
            // exit;
        } else {
            $store_cv = $Request->cv_file_before;
            // echo"work";
        }

        // return $store_cv;
        tbl_team_member::where('ID', $Request->ID)->update(array(
            'team_member_type' => $Request->group,
            'email' => $Request->email,
            'pass_code' => $Request->password,
            'full_name' => $Request->full_name,
            'first_name' => $Request->full_name,
            'profile_image' => $store_cv,
            'jobs_history' => $Request->jobs_history,
            'phone' => $Request->phone,
            'mobile_number' => $Request->mobile_number,
            'country' => $val_contries['country_name'],
            'state' => $val_state['state_name'],
            'city' => $val_city['city_name'],
            'loc_time_zone' => $Request->timea,
            'dis_time_zone' => $Request->timeb,
            'last_updated_date' => $date,
            'last_updated_by' => 2
        ));

        user::where('user_id', $Request->ID)->update(array(
            'full_name' => $Request->full_name,
            'email'     => $Request->email,
            'password'  => $Request->password,
            'user_type'  => $Request->team_type
        ));


        $module = $Request->editchange;
        // return $Request->ID;
        // exit;
        foreach ($module as $key => $value) {
            $team_member_id = $Request->ID;
            $employer_id = Session::get('id');
            $company_id = Session::get('org_ID');
            $get_permission_row = tbl_team_member_permission::where(array('team_member_id' => $team_member_id, 'employer_id' => $employer_id, 'company_id' => $company_id, 'permission_value' => $value))->first();
            $unique_permission_id = $get_permission_row['ID'];

            tbl_team_member_permission::where('ID', $unique_permission_id)->update(array(
                'is_read' => (!empty($Request->input('read' . $value))) ? "yes" : "no",
                'is_add' => (!empty($Request->input('add' . $value))) ? "yes" : "no",
                'is_edit' => (!empty($Request->input('edit' . $value))) ? "yes" : "no",
                'is_delete' => (!empty($Request->input('delete' . $value))) ? "yes" : "no"

            ));
        }
        //  return $get_permission_row;


        return redirect('employer/manageteammember');
    }

    public function manageteamadd()
    {
        ini_set('memory_limit', '-1');
        $team_member_type = tbl_team_member_type::all();
        return view('manage_team_members_group')->with("team_member_type", $team_member_type);
        // 	return view('manage_team_members')->with("team_member_type",$team_member_type);

    }
    public function delete_teammember_type($id = "")
    {
        ini_set('memory_limit', '-1');
        $team_member_del = tbl_team_member_type::where('type_ID', $id)->delete();

        return redirect('employer/manageteammember');
    }
    public function manageteamaddedit(Request $Request)
    {
        ini_set('memory_limit', '-1');
        $type_ID = $Request->type_id;
        $team_type = tbl_team_member_type::where('type_ID', $type_ID)->first();
        $type_name = $Request->type_namegroup;

        tbl_team_member_type::where('type_ID', $type_ID)->update(array('type_name' => $type_name));
        return redirect('employer/manageteammember');
    }



    public function add_email_form(Request $request)
    {
        ini_set('memory_limit', '-1');
        $emailList = new Tbl_email_list_contacts;
        $emailList->salutation = $request->salutation;
        $emailList->first_name = $request->firstname;
        $emailList->last_name  = $request->lastname;
        $emailList->created_date = $request->date;
        $emailList->full_name  = $request->fullname;
        $emailList->email_contact_id = $request->emailid;
        $emailList->add_in_contact_db = $request->contactdatabase;
        $emailList->save();
        return redirect('employer/my_posted_contacts');
    }

    public function show_email_form()
    {
        ini_set('memory_limit', '-1');
        return view('post_new_email_contact');
    }

    public function delete_email($id = "")
    {
        ini_set('memory_limit', '-1');
        $email_delete  = Tbl_email_list_contacts::where('id', $id)->delete();
        return redirect('employer/my_posted_contacts');
    }

    public function delete_email_list($id = "")
    {
        ini_set('memory_limit', '-1');
        $email_delete_list = Tbl_email_list::where('id', $id)->delete();
        return redirect('employer/my_posted_contacts');
    }



    public function assign_job($id = "")
    {
        ini_set('memory_limit', '-1');
        $toReturn = array();
        $toReturn['team_member_list'] = tbl_team_member::get()->toArray();
        foreach ($toReturn['team_member_list'] as $key => $value) {
            $check_already_assign = tbl_job_post_assign::where(array('job_post_id' => $id, 'team_member_id' => $toReturn['team_member_list'][$key]['ID'], 'status' => 'active'))->first();
            if (!empty($check_already_assign)) {
                $toReturn['team_member_list'][$key]['sts'] = 'active';
            } else {
                $toReturn['team_member_list'][$key]['sts'] = 'inactive';
            }
        }
        $toReturn['post_job'] = tbl_post_jobs::where('id', $id)->first();
        $post_job = tbl_post_jobs::where('id', $id)->first();
        $assign_details = \DB::table('tbl_job_post_assign')
            ->leftjoin('tbl_team_member', 'tbl_team_member.ID', '=', 'tbl_job_post_assign.team_member_id')
            ->leftjoin('user', 'user.ID', '=', 'tbl_job_post_assign.team_member_id')
            ->select(
                'tbl_team_member.full_name as name',
                'tbl_team_member.ID',
                'tbl_team_member.email as email',
                'tbl_job_post_assign.job_assigned_by as userAssign',
                'tbl_job_post_assign.job_assigned_date as job_assign_date'
            )->where('job_post_id', $id)->get()->toArray();
        return view('posted_job_assined')->with('toReturn', $toReturn)->with('jobpost', $post_job)->with('assign_details', $assign_details);
    }

    public function assign_active(Request $request)
    {
        ini_set('memory_limit', '-1');
        $job_id = $request->job_id;
        if ($request->sts == 'active') {
            $assigned_job = new tbl_job_post_assign();
            $assigned_job->team_member_id = $request->team_member_id;
            // $assigned_job->job_assigned_by=Session::get('id');
            $assigned_job->job_assigned_by = Session::get('full_name');
            $assigned_job->owner_id = $request->owner_id;
            $assigned_job->job_post_id = $request->job_id;
            $assigned_job->job_assigned_date = date('Y-m-d');
            $assigned_job->job_unassigned_date = date('Y-m-d');
            $assigned_job->status = "active";
            $assigned_job->read_flag = 0;
            $assigned_job->first_read_date_time = now();
            $assigned_job->org_id = Session::get('org_ID');
            $assigned_job->favourite_flag = 0;
            $assigned_job->save();
            $id_assign = $assigned_job->id;
            $team_member_name = tbl_team_member::where('ID', $request->team_member_id)->first();
            $job_history = new tbl_job_history();
            $job_history->job_id = $job_id;
            $job_history->update_text = "this is Job Is Assigned to " . $team_member_name->full_name;
            $job_history->date = date('Y-m-d');
            $job_history->created_by = Session::get('id');
            $job_history->updated_by = Session::get('id');
            $job_history->save();
            $table_post = Tbl_post_job::where('ID', $assigned_job->job_post_id)->first();
            // return $table_post;

            $Notification = new Tbl_notification();
            $Notification->notification_service_id = $request->job_id;
            $Notification->service_type = "Jost Assigned";
            $Notification->notify_to = $assigned_job->owner_id;
            $Notification->notification_added_by = Session::get('id');
            $Notification->notification_added_to = $team_member_name->full_name;
            $Notification->applied_id = $assigned_job->owner_id;
            $Notification->notification_text = "  Assigned to " . $team_member_name->full_name;
            $Notification->code_title = $table_post->job_code . " : " . $table_post->job_title;
            $Notification->by_personn = " By " . Session::get('full_name');
            $mydate = date('Y-m-d');
            $Notification->submit_date = $mydate;
            $Notification->updated_date = $mydate;
            $Notification->read_date = $mydate;
            $Notification->read_status_team_member = 2;
            $Notification->read_date_team_member = $mydate;
            // $Notification->notification_service_id=$Add_to_post_job->ID;
            $Notification->save();
            // return $Notification;
            // exit();
            return redirect('employer/posted_job_assined/' . $job_id);
        } else {
            $team_member = tbl_team_member::where('ID', $request->team_member_id)->update(array('sts' => 'inactive', 'is_active' => 'inactive'));
            $team_member_status = tbl_team_member::where('ID', $request->team_member_id)->first();
            $assigned_job = tbl_job_post_assign::where('job_post_id', $job_id)->where('team_member_id', $request->team_member_id)->delete();
            $team_member_name = tbl_team_member::where('ID', $request->team_member_id)->first('full_name');
            $job_history = new tbl_job_history();
            $job_history->job_id = $job_id;
            $job_history->update_text = "this is Job Is UnAssigned from " . $team_member_name->full_name;
            $job_history->date = date('Y-m-d');
            $job_history->created_by = Session::get('id');
            $job_history->updated_by = Session::get('id');
            $job_history->save();
            return redirect('employer/posted_job_assined/' . $job_id);
        }
    }

    public function list_candidate($id = "")
    {
        ini_set('memory_limit', '-1');
        $source = "Internal";
        $toReturn['personal'] = \DB::table('tbl_job_seekers')
            ->select(
                'tbl_job_seekers.ID as id',
                'tbl_job_seekers.first_name as first',
                'tbl_job_seekers.last_name as last_name',
                'tbl_job_seekers.dob as dob',
                'tbl_job_seekers.city as city',
                'tbl_job_seekers.state as state',
                'tbl_job_seekers.visa_status as visa',
                'tbl_job_seekers.email as email',
                'tbl_job_seekers.mobile as mobile',
                'tbl_job_seekers.skype_id as skype_id',
                'tbl_job_seekers.cv_file',
                'tbl_seeker_applied_for_job.total_experience as experience',
                'tbl_seeker_academic.degree_title as degree'
            )
            ->leftjoin('tbl_seeker_experience', 'tbl_seeker_experience.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->leftjoin('tbl_seeker_academic', 'tbl_seeker_academic.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->leftjoin('tbl_seeker_applied_for_job', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->where('tbl_job_seekers.ID', $id)
            ->first();
        $toReturn['candiate_extra_doc'] = Tbl_seeker_documents::where('seeker_ID', $id)->orderBy('ID', 'DESC')->get()->toArray();

        //   return $toReturn['candiate_extra_doc '];
        $toReturn['job_list'] = tbl_post_jobs::orderBy('ID','DESC')->limit(100)->get()->toArray();


        return view('employer_submit_to_job')->with('toReturn', $toReturn);
    }
    public function submit_candidate(Request $Request)
    {
        ini_set('memory_limit', '-1');
        if ($Request->job_id) { }
        $mydate = date('m-Y-d');
        $seeker_name = $Request->seeker_name;
        if ($Request->hasFile('updated_resume')) {
            $updated_resume = $Request->file('updated_resume');
            // $new_updated_resume =$seeker_name."update_resume".$mydate.".".$updated_resume->getClientOriginalName();
            $new_updated_resume = $updated_resume->getClientOriginalName();
            $updated_resume->move(public_path('seekerresume'), $new_updated_resume);
        }
        $seeker_applied_for_job = new Tbl_seeker_applied_for_job();
        $seeker_applied_for_job->seeker_ID = $Request->seeker_id;
        $seeker_applied_for_job->job_ID = $Request->job_id;
        // $seeker_applied_for_job->cover_letter=
        $payment = $Request->payment_range;
        // return $payment;
        if ($payment == 'DOE') {
            $pay_min = $payment;
            $pay_max = $payment;
        } else {
            $payment_array = explode('-', $Request->payment_range);
            $pay_min = $payment_array[0];
            $pay_max = $payment_array[1];
        }
        $seeker_applied_for_job->expected_salary = $Request->payment_range;
        $seeker_applied_for_job->dated = date('Y-m-d');
        $seeker_applied_for_job->ip_address = $Request->ip();
        $seeker_applied_for_job->employer_ID = Session::get('user_id');
        // $seeker_applied_for_job->flag=
        // $seeker_applied_for_job->old_id=
        $seeker_applied_for_job->candate_name = $Request->seeker_name;
        $seeker_applied_for_job->phone_no_mobile = $Request->mobile_number;
        // $seeker_applied_for_job->phone_no_home=
        $seeker_applied_for_job->email_id    = $Request->seeker_email;
        $cv_file = $Request->cv;
        if ($Request->hasFile('updated_resume')) {
            $seeker_applied_for_job->updated_resume = $new_updated_resume;
        } else {
            $seeker_applied_for_job->updated_resume = $cv_file;
        }
        // $seeker_applied_for_job->skype_id=
        $seeker_applied_for_job->current_location = $Request->seeker_city;
        $seeker_applied_for_job->visa_status = $Request->seeker_visa;
        // $seeker_applied_for_job->new_assignment=
        // $seeker_applied_for_job->personal_interviews=
        // $seeker_applied_for_job->telephonic_interviews=
        // $seeker_applied_for_job->expectation_trainee_stipend=
        // $seeker_applied_for_job->expectation_hours=
        // $seeker_applied_for_job->total_experience=
        $seeker_applied_for_job->is_employer = 0;
        $seeker_applied_for_job->submitted_by = Session::get('user_id');
        $seeker_applied_for_job->pay_min = $pay_min;
        $seeker_applied_for_job->pay_max = $pay_max;
        $seeker_applied_for_job->org_id = Session::get('org_ID');
        $seeker_applied_for_job->save();
        foreach ($Request->reference as $key => $valuecandaidate) {
            if ((!empty($Request->reference[$key][0])) && (!empty($Request->reference[$key][1])) && (!empty($Request->reference[$key][2])) && (!empty($Request->reference[$key][3])) && (!empty($Request->reference[$key][4]))) {
                $candidate_reference = new tbl_application_candidate_reference();
                $candidate_reference->forward_candidate_id = $seeker_applied_for_job->id;
                $candidate_reference->fullname = $valuecandaidate[0];
                $candidate_reference->officialEmail = $valuecandaidate[1];
                $candidate_reference->designation = $valuecandaidate[2];
                $candidate_reference->clientName = $valuecandaidate[3];
                $candidate_reference->location = $valuecandaidate[4];
                $candidate_reference->org_id = Session::get('org_ID');
                $candidate_reference->save();
            }
        }
        foreach ($Request->experience as $key => $valueexp) {
            if (!empty($Request->experience[$key][0]) && (!empty($Request->experience[$key][1])) && (!empty($Request->experience[$key][2]))) {
                $candidate_exp = new tbl_application_candidate_exp_required();
                $candidate_exp->forward_candidate_id = $seeker_applied_for_job->id;
                $candidate_exp->skills    = $valueexp[0];
                $candidate_exp->yrs_of_exp    = $valueexp[1];
                $candidate_exp->expertise_level = $valueexp[2];
                $candidate_exp->org_id = Session::get('org_ID');
                $candidate_exp->save();
            }
        }
        if ($Request->file('document_upload') != "") {
            foreach ($Request->file('document_upload') as $key => $file) {
                $user_document_name = $Request->document_name[$key];
                $file_name = $file->getClientOriginalName();
                $file_uploaded =  $user_document_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('forward_document'), $file_uploaded);
                $forward_candidate_documents = new tbl_application_candidate_documents();
                $forward_candidate_documents->forward_candidate_id = $seeker_applied_for_job->id;
                $forward_candidate_documents->document_name = $user_document_name;
                $forward_candidate_documents->documents = $file_uploaded;
                $forward_candidate_documents->status = 1;
                $forward_candidate_documents->created_by = Session::get('id');
                $forward_candidate_documents->modified_by = Session::get('id');
                $forward_candidate_documents->org_id = Session::get('org_ID');
                $forward_candidate_documents->save();
            }
        }
        if ($Request->Companyemp_detail) {
            $emp_details = new tbl_application_emp_details();
            $emp_details->forward_candidate_id = $seeker_applied_for_job->id;
            $emp_details->company_name = $Request->Companyemp_detail;
            $emp_details->email_Id = $Request->Emailemp_detail;
            $emp_details->phone_number = $Request->Phoneemp_detail;
            $emp_details->ext_no = $Request->extenson;
            $emp_details->employer_name = $Request->Employeremp_detail;
            $emp_details->status = 1;
            $emp_details->created_by = Session('user_id');
            $emp_details->org_id = Session::get('org_ID');
            $emp_details->save();
        }
        $job_history = new tbl_job_history();
        $job_history->job_id = $Request->job_id;
        $job_history->update_text = "this is Job Is Submited";
        $job_history->date = date('Y-m-d');
        $job_history->created_by = Session::get('id');
        $job_history->updated_by = Session::get('id');
        $job_history->save();

        // return $seeker_applied_for_job;
        return redirect('employer/Application');
        // return $Request;
    }


    public function show_interview_add()
    {
        ini_set('memory_limit', '-1');
        $toReturn['jobpost'] = tbl_post_jobs::select('job_code', 'ID')->get()->toArray();
        $toReturn['time_zone'] = Tbl_time_zone::get();
        $data[] = array();
        $data['name'] = Tbl_job_seekers::get()->toArray();
        return view('employee_dashbord_intrerview_add')
            ->with('data', $data)
            ->with('toReturn', $toReturn);
    }

    public function show_meeting1()
    {
        ini_set('memory_limit', '-1');
        $toReturn['time_zone'] = Tbl_time_zone::get();
        return view('employee_dashbord_meeting_add')->with('toReturn', $toReturn);
    }
    public function addinterview(Request $add)
    {
        ini_set('memory_limit', '-1');
        // return $add;
        $application_details = Tbl_seeker_applied_for_job::where('ID', $add->application_id)->first();
        $employer_ID = Session::get('user_id');
        $add_interview = new tbl_schedule_interview();
        $add_interview->interview_date = $add->date_interview;
        $add_interview->from_time = $add->start_time;
        $add_interview->end_time = $add->end_time;
        $add_interview->interview_type = $add->type;
        $add_interview->job_ID = $application_details->job_ID;
        $add_interview->invitees_to = $application_details->candate_name;
        $add_interview->candiate_name = $application_details->candate_name;
        $add_interview->dated = date('Y-m-d');
        $add_interview->instructions = $add->instruction;
        $add_interview->time_zone = $add->time_zone;
        $add_interview->employer_ID = $employer_ID;
        $add_interview->seeker_ID = $application_details->seeker_ID;
        $add_interview->invitees_cc = $application_details->candate_name;
        $add_interview->save();
        return redirect('employer/dashboard/interview-meeting');
    }

    public function addmeeting(Request $add)
    {
        ini_set('memory_limit', '-1');
        $id = Session::get('user_id');
        $cdate = date('Y-m-d');
        DB::insert('insert into tbl_meetings(meeting_date,meeting_time,subject,timezone,participants,employer_ID,dated) values(?,?,?,?,?,?,?)', [$add->date, $add->meeting_time, $add->subject, $add->local_time, $add->parti, $id, $cdate]);
        return redirect('employer/dashboard/interview-meeting');
    }

    public function meetingshow()
    {
        ini_set('memory_limit', '-1');
        $toReturn['meetingall'] = tbl_meeting::all();
        $toReturn['interviewall'] = tbl_schedule_interview::all();

        $toReturn['today_interview'] = tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get();
        $toReturn['today_meeting'] = tbl_meeting::where('dated', '=', date('Y-m-d'))->get();

        $toReturn['schedule'] = Tbl_schedule_preview::where('sts', 'rescheduled')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['rejected'] = Tbl_schedule_preview::where('sts', 'rejected')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['sent'] = Tbl_schedule_preview::where('sts', 'sent')->orderBy('id', 'DESC')->paginate(15);
        return view('calendar', compact('toReturn'));
    }
    public function todaysinterviewshow()
    {

        ini_set('memory_limit', '-1');
        $toReturn['meetingall'] = tbl_meeting::where('meeting_date', '=', date('Y-m-d'))->get();
        $toReturn['interviewall'] = tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get();
      

        $toReturn['schedule'] = Tbl_schedule_preview::where('sts', 'rescheduled')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['rejected'] = Tbl_schedule_preview::where('sts', 'rejected')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['sent'] = Tbl_schedule_preview::where('sts', 'sent')->orderBy('id', 'DESC')->paginate(15);
        return view('calendar', compact('toReturn'));
    }
    public function todays_meetings_show()
    {
        ini_set('memory_limit', '-1');
        $toReturn['meetingall'] = tbl_meeting::where('meeting_date', '=', date('Y-m-d'))->get();
        $toReturn['interviewall'] = tbl_schedule_interview::where('interview_date', '=', date('Y-m-d'))->get();
      

        $toReturn['schedule'] = Tbl_schedule_preview::where('sts', 'rescheduled')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['rejected'] = Tbl_schedule_preview::where('sts', 'rejected')->orderBy('id', 'DESC')->paginate(15);
        $toReturn['sent'] = Tbl_schedule_preview::where('sts', 'sent')->orderBy('id', 'DESC')->paginate(15);
        return view('calendar', compact('toReturn'));
    }
    public function del($id = "")
    {
        ini_set('memory_limit', '-1');
        $contact_delete = tbl_meeting::where('meeting_ID', $id)->delete();
        return redirect('employer/dashboard/interview-meeting');
    }


    public function delint($ida = "")
    {
        ini_set('memory_limit', '-1');
        $contact_delete1 = tbl_schedule_interview::where('job_ID', $ida)->delete();
        return redirect('employer/dashboard/interview-meeting');
    }
    public function upda($id = "")
    {
        ini_set('memory_limit', '-1');
        $data = tbl_meeting::where('meeting_ID', $id)->first();
        $toReturn['time_zone'] = Tbl_time_zone::get();
        return view('employee_dashbord_meeting_edit')
            ->with('data', $data)
            ->with('toReturn', $toReturn);
    }

    public function updateadd(Request $Request)
    {
        ini_set('memory_limit', '-1');
        tbl_meeting::where('meeting_ID', $Request->id_main)->update(array(
            'meeting_date' => $Request->date,
            'meeting_time' => $Request->meeting_time,
            'timezone' => $Request->local_time,
            'subject' => $Request->subject,
            'participants' => $Request->parti,
        ));
        return redirect('employer/dashboard/interview-meeting');
    }

    public function updaint($id = "")
    {
        ini_set('memory_limit', '-1');
        $data[] = array();
        $toReturn['jobpost'] = tbl_post_jobs::select('job_code', 'ID')->get()->toArray();
        $data['name'] = Tbl_job_seekers::get()->toArray();
        $data['int'] = tbl_schedule_interview::where('job_ID', $id)->first();
        $toReturn['time_zone'] = Tbl_time_zone::get();
        return view('employee_dashbord_intrerview_editinterview')
            ->with('data', $data)
            ->with('toReturn', $toReturn);
    }


    public function updateedit(Request $Request)
    {
        ini_set('memory_limit', '-1');
        $candiate_name = $Request->candiate_name;
        $exploded_value = explode('|', $candiate_name);
        $value_one = $exploded_value[0];
        $id = Session::get('user_id');
        tbl_schedule_interview::where('schedule_id', $Request->ID)->update(array(
            'interview_date' => $Request->date_interview,
            'from_time' => $Request->start_time,
            'end_time' => $Request->end_time,
            'time_zone' => $Request->time_zone,
            'interview_type' => $Request->type,
            'invitees_to' => $value_one,
            'candiate_name' => $value_one,
            'invitees_cc' => $value_one,
            'job_ID' => $Request->interview_job,
            'instructions' => $Request->instruction,
        ));
        return redirect('employer/dashboard/interview-meeting');
    }
    public function application_forword($id = "")
    {
        ini_set('memory_limit', '-1');
        $toReturn['application_detail'] = Tbl_seeker_applied_for_job::where('ID', $id)->first();
        // return $toReturn['application_detail'];
        $toReturn['candiate_record'] = Tbl_job_seekers::where('ID', $toReturn['application_detail']->seeker_ID)->first();
        $toReturn['candiate_extra_doc'] = Tbl_seeker_documents::where('seeker_ID', $toReturn['application_detail']->seeker_ID)->get('file_name')->toArray();
        $toReturn['qualification'] = tbl_seeker_academic::where('ID', $toReturn['application_detail']->seeker_ID)->orderBy('ID', 'DESC')->first();
        $toReturn['form_email_id'] = Session::get('email');
        return view('forward_candidate')->with('toReturn', $toReturn);
    }
    public function list_teammember($id = "")
    {
        ini_set('memory_limit', '-1');
        $data = tbl_team_member::where('team_member_type', $id)->get();
        return json_encode($data);
    }
    public function forward_candidate(Request $Request)
    {
        ini_set('memory_limit', '-1');
        // return $Request->document_upload[0];
        $update_resume = $Request->update_Resume_file;
        $experience_list = $Request->experience;
        $reference_list = $Request->reference;
        $job_id = $Request->job_id;
        $seeker_id = $Request->seeker_id;
        // return $seeker_id;
        $seeker_detail = Tbl_job_seekers::where('ID', $seeker_id)->first();
        $seeker_edu_detail = tbl_seeker_academic::where('seeker_id', $seeker_id)->first();
        $seeker_otherdocuments1 = $seeker_detail->otherdocuments1;
        $seeker_otherdocuments2 = $seeker_detail->otherdocuments2;

        // return $seeker_edu_detail;
        $seeker_exp_detail = tbl_seeker_experience::where('seeker_ID', $seeker_id)->first();
        $current_org = $seeker_exp_detail['company_name'];
        $start_date = $seeker_exp_detail['start_date'];
        $end_date = $seeker_exp_detail['end_date'];
        $datetime1 = strtotime(date('Y-m-d', strtotime($start_date)));
        $datetime2 = strtotime(date('Y-m-d', strtotime($end_date)));
        $secs = $datetime2 - $datetime1; // == <seconds between the two times>
        $days = $secs / 86400;
        $exp_month = floor($days / 30);
        $exp_years = floor($exp_month / 12);
        $job_detail = tbl_post_job::where('ID', $job_id)->first();
        $forward_candidate = new Tbl_forward_candidate();
        $forward_candidate->job_seeker_id = $seeker_id;
        $forward_candidate->job_id = $Request->job_id;
        $forward_candidate->forward_by = Session::get('email');
        $forward_candidate->forward_to = trim($Request->email_to);
        $forward_candidate->forward_date = date('Y-m-d');
        $forward_candidate->cc = $Request->email_cc;
        $forward_candidate->bcc = $Request->email_bcc;
        $forward_candidate->subject = $Request->email_subject;
        $forward_candidate->content = $Request->email_content;
        $forward_candidate->fullname = $Request->fullname;
        $forward_candidate->ssn = $Request->last_for_digit_ssn;
        $forward_candidate->visa_status = $Request->us_visa_status;
        // $forward_candidate->notice_period=$Request->notice_period;
        $forward_candidate->yearExp = $exp_years;
        $forward_candidate->monthExp = $exp_month;
        $forward_candidate->mobile = $Request->phone_primary;
        $forward_candidate->email = $Request->condidate_email_id;
        $forward_candidate->current_ctc = $Request->current_ctc;
        $forward_candidate->pay_min = $job_detail['pay_min'];
        $forward_candidate->pay_max = $job_detail['pay_max'];
        // $forward_candidate->panNumber=$Request->panNumber;
        $forward_candidate->institute = $seeker_edu_detail['institude'];
        $forward_candidate->current_org = $current_org;
        $forward_candidate->qualification = $seeker_edu_detail['degree_level'];
        $forward_candidate->qualification1 = $Request->qual_with_uni;
        // $forward_candidate->prefer_location=$Request->prefer_location;
        $forward_candidate->passyear = $seeker_edu_detail['completion_year'];
        $forward_candidate->dob = $Request->dob;
        $forward_candidate->entered = $Request->entred_in_us;
        $forward_candidate->relocation = $Request->Open_For_Relocation;
        $forward_candidate->telephonicinterview = $Request->availa_for_tele;
        $forward_candidate->personinterview = $Request->availa_for_per;
        $forward_candidate->availibilitynewproj = $Request->availa_for_new;
        $forward_candidate->expectedrate = $Request->expectedrate;
        $forward_candidate->save();
        $forward_candidate_reference = new Tbl_forward_candidate_reference();
        $send_mail_id = Session::get('email');
        $forword_candidate['sender_fullname'] = Session::get('full_name');
        $forward_candidate['skypeid'] = $Request->skypeid;
        $forward_candidate['visaexpiry'] = $Request->visaexpiry;
        $forward_candidate['passportno'] = $Request->passportno;
        $forward_candidate['linkedinid'] = $Request->linkedinid;
        $forward_candidate['current_location_full'] = $Request->current_location;
        $forward_candidate['job_type'] = $Request->job_type;
        $forward_candidate['job_rate_type'] = $Request->job_rate_type;
        $forward_candidate['job_rate_type_fulltime'] = $Request->job_rate_type_fulltime;
        $forward_candidate['us_exper'] = @$seeker_detail->total_usa_experience;
        $forward_candidate['it_exper'] = @$seeker_detail->experience;
        $email_to = $Request->email_to;
        // echo"<pre>";
        // print_r($experience_list);
        // exit;
        // return $experience_list;
        // if(!empty($experience_list))
        // {
        //     foreach($experience_list as $key =>$value)
        // {   
        // echo"dsfsdf";
        // if($experience_list[$key]!="" )
        // {
        // $forward_candidate_exp_required1 = new Tbl_forward_candidate_exp_required();
        // $forward_candidate_exp_required1->skills="fghf";
        // $forward_candidate_exp_required->skills=$experience_list[0][0];
        // $forward_candidate_exp_required->yrs_of_exp=$experience_list[1][1];
        // $forward_candidate_exp_required->expertise_level=$experience_list[1][2];
        // $forward_candidate_exp_required1->save;
        // }
        // break;

        // }            


        if ($Request->file('document_upload') != "") {
            foreach ($Request->file('document_upload') as $key => $file) {
                $user_document_name = $Request->document_name[$key];
                $file_name = $file->getClientOriginalName();
                $file_uploaded =  $user_document_name . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('forward_document'), $file_uploaded);
                $forward_candidate_documents = new Tbl_forward_candidate_document();
                $forward_candidate_documents->forward_candidate_id = $forward_candidate->id;
                $forward_candidate_documents->document_name = $user_document_name;
                $forward_candidate_documents->documents = $file_uploaded;
                $forward_candidate_documents->status = 1;
                $forward_candidate_documents->created_by = Session::get('id');
                $forward_candidate_documents->modified_by = Session::get('id');
                $forward_candidate_documents->save();
                $document_array = Tbl_forward_candidate_document::where('forward_candidate_id', $forward_candidate->id)->get('documents')->toArray();
                $data['document_array'] = $document_array;
            }
            $data = array('forward_candidate' => $forward_candidate, 'experience_list' => $experience_list, 'reference_list' => $reference_list, 'update_resume' => $update_resume, 'seeker_otherdocuments1' => $seeker_otherdocuments1, 'seeker_otherdocuments2' => $seeker_otherdocuments2, 'document_array' => $document_array);
        } else {
            $data = array('forward_candidate' => $forward_candidate, 'experience_list' => $experience_list, 'reference_list' => $reference_list, 'update_resume' => $update_resume, 'seeker_otherdocuments1' => $seeker_otherdocuments1, 'seeker_otherdocuments2' => $seeker_otherdocuments2);
        }
        if ($Request->Companyemp_detail) {
            $emp_details = new tbl_forward_emp_details();
            $emp_details->forward_candidate_id = $forward_candidate->id;
            $emp_details->company_name = $Request->Companyemp_detail;
            $emp_details->email_Id = $Request->Emailemp_detail;
            $emp_details->phone_number = $Request->Phoneemp_detail;
            $emp_details->ext_no = $Request->extenson;

            //    return $Request->extenson;
            //    if($Request->extenson != ""){
            //     $emp_details->ext_no=1;
            //     // $emp_details->ext_no=$Request->extenson;
            //    }
            $emp_details->employer_name = $Request->Employeremp_detail;
            $emp_details->status = 1;
            $emp_details->created_by = Session('user_id');
            $emp_details->save();
            $data['emp_details'] = $emp_details;
        }
        $seeker_all_document = Tbl_seeker_documents::where('seeker_ID', $seeker_id)->get('file_name')->toArray();
        // print_r($seeker_all_document);
        // exit;
        if (@$seeker_all_document) {
            @$data['seeker_extra_doc'] = $seeker_all_document;
        }
        // print_r($data['seeker_extra_doc']);
        // exit;
        Mail::send('emails.forward_candidate', ['data' => $data], function ($message) use ($data) {
            $email_to = explode(',', $data['forward_candidate']['forward_to']);
            foreach ($email_to as $key => $value) {
                $message->to($email_to[$key]);
            }
            $message->subject($data['forward_candidate']['subject']);
            if ($data['forward_candidate']['cc']) {
                $email_cc = explode(',', $data['forward_candidate']['cc']);
                foreach ($email_cc as $key => $value) {
                    $message->cc($email_cc[$key]);
                }
            }
            if ($data['forward_candidate']['bcc']) {
                $email_bcc = explode(',', $data['forward_candidate']['bcc']);
                foreach ($email_bcc as $key => $value) {
                    $message->bcc($email_bcc[$key]);
                }
            }
            if (@$data['document_array']) {
                foreach (@$data['document_array'] as $document) {
                    $document_path = "public/forward_document/" . $document['documents'];
                    $message->attach($document_path);
                }
                if (@$data['update_resume']) {
                    $path = "public/seekerresume/" . $data['update_resume'];
                    $message->attach($path);
                }
                if (@$data['seeker_otherdocuments1']) {
                    $path = "public/seekerresume/" . @$data['seeker_otherdocuments1'];
                    $message->attach($path);
                }
                if (@$data['seeker_otherdocuments2']) {
                    $path = "public/seekerresume/" . @$data['seeker_otherdocuments2'];
                    $message->attach($path);
                }
                if (@$data['seeker_extra_doc']) {
                    foreach ($data['seeker_extra_doc'] as $key => $value) {
                        $document_path = "public/forward_document/" . $data['seeker_extra_doc'][$key]['file_name'];
                        $message->attach($document_path);
                    }
                }
            } else {
                if ($data['update_resume']) {
                    $path = "public/seekerresume/" . $data['update_resume'];
                    $message->attach($path);
                }
                if (@$data['seeker_otherdocuments1']) {
                    $path = "public/seekerresume/" . $data['seeker_otherdocuments1'];
                    $message->attach($path);
                }
                if (@$data['seeker_otherdocuments2']) {
                    $path = "public/seekerresume/" . $data['seeker_otherdocuments2'];
                    $message->attach($path);
                }
                if (@$data['seeker_extra_doc']) {
                    foreach (@$data['seeker_extra_doc'] as $key => $value) {
                        $document_path = "public/forward_document/" . $data['seeker_extra_doc'][$key]['file_name'];
                        $message->attach($document_path);
                    }
                }
            }
            $message->from($data['forward_candidate']['forward_by'], $data['forward_candidate']['sender_fullname']);
        });
        // return view('emails.forward_candidate')->with('data',$data);

        $job_history = new tbl_job_history();
        $job_history->job_id = $Request->job_id;
        $job_history->update_text = "this is Job Is Sumit To Client";
        $job_history->date = date('Y-m-d');
        $job_history->created_by = Session::get('id');
        $job_history->updated_by = Session::get('id');
        $job_history->save();
        return redirect('employer/Application');
    }
    public function show_job_note(Request $request)
    {
        ini_set('memory_limit', '-1');
        $id = $request->id;
        $data = Tbl_jobs_notes::where('job_id', $id)->get()->toArray();
        return response()->json($data);
    }
    public function add_job_note(Request $request)
    {
        ini_set('memory_limit', '-1');
        $date = date("Y-m-d h:i:sa");
        $data = new Tbl_jobs_notes();
        $data->title     =  $request->title;
        $data->note      =  $request->note;
        $data->job_id    =  $request->job_id;
        $data->created_time = $date;
        $data->created_by = Session::get('id');
        $data->privacy_level    = $request->privacy;
        $data->status           = "active";
        $data->save();
        return redirect('employer/posted_jobs');
    }
    public function add_candidate_note(Request $request)
    {
        ini_set('memory_limit', '-1');
        $date = date("Y-m-d h:i:sa");
        $data = new tbl_candidate_notes();
        $data->title     =  $request->title;
        $data->note      =  $request->note;
        $data->candidate_id    =  $request->candidate_id;
        $data->created_time = $date;
        $data->created_by = Session::get('id');
        $data->privacy_level    = $request->privacy;
        $data->status           = "active";
        $data->save();
        return redirect('employer/search_resume');
    }

    public function show_candidate_note(Request $request)
    {
        ini_set('memory_limit', '-1');
        $id = $request->id;
        $data = tbl_candidate_notes::where('candidate_id', $id)->get()->toArray();
        return response()->json($data);
    }
    public function add_new_job_email(Request $request)
    {
        ini_set('memory_limit', '-1');
        // return $request;
        $candiate_name = $request->job;
        $exploded_value = explode('|', $candiate_name);
        $value_one = $exploded_value[0];
        $value_two = $exploded_value[1];
        $postmail = new Tbl_job_mail();
        $postmail->job_id = $request->candidate_id;
        $postmail->mail_to = $request->mail_to;
        $postmail->mail_from = Session::get('email');
        $postmail->subject = $request->subject;
        $postmail->candidate_name = $value_two;
        $postmail->comment = $request->comment;
        $postmail->save();
        $toemail = $request->mail_to;
        $formemail = Session::get('email');
        $sender_name = Session::get('full_name');
        $candidate_id = $value_one;
        $toReturn['job_seekers'] = Tbl_job_seekers::where('id', $candidate_id)->first()->toArray();
        $toReturn['seeker_exp'] = Tbl_seeker_academic::where('seeker_ID', $candidate_id)->first();
        // echo"<pre>";
        // print_r( $toReturn['job_seekers']);
        // exit;
        $toReturn['exp'] = Tbl_seeker_experience::where('seeker_ID', $candidate_id)->first();
        $toReturn['skills'] = Tbl_seeker_skills::where('seeker_ID', $candidate_id)->get()->toArray();
        $skills = $toReturn['skills'];
        $exp = $toReturn['exp'];
        $seeker_exp = $toReturn['seeker_exp'];
        $candidate_val = $toReturn['job_seekers'];
        $job_id = $candidate_id;
        $toReturn['job_post'] = tbl_post_job::where('id', $job_id)->first();
        $job_detail = $toReturn['job_post'];
        $mail_content = $request->comment;
        $mail_subject = $request->subject;
        $data = array('job_detail' => $job_detail, 'tomail' => $toemail, 'sender_name' => $sender_name, 'form_mail' => $formemail, 'mail_content' => $mail_content, 'mail_subject' => $mail_subject, 'candidate_val' => $candidate_val, 'seeker_exp' => $seeker_exp, 'exp' => $exp, 'skills' => $skills);
        // print_r($data['candidate_val']);
        // exit;
        Mail::send('emails.job_detail_job', ['data' => $data], function ($message) use ($data) {
            $message->to($data['tomail'])
                ->subject($data['mail_subject']);
            $message->from($data['form_mail'], $data['sender_name']);
        });
        // return view('emails.job_detail_job')->with('data',$data);
        return redirect('employer/posted_jobs');
    }

    public function candidate_list()
    {
        ini_set('memory_limit', '-1');
        $value = Tbl_job_seekers::get()->toArray();

        $data_array = [];
        $str = '{';
        foreach ($value as $item) {
            $var_patch = $item['first_name'] . $item['last_name'];
            $str .= '"' . $item['ID'] . '":"' . $item['first_name'] . $item['last_name'] . '",';
            array_push($data_array, $var_patch);
        }
        $str .= '}';
        $str = str_replace(',}', '}', $str);
        // return $str;
        // exit();
        $decoded_data = json_encode($data_array);
        return response($str);
    }

    public function search_jobs(Request $request)
    {

        ini_set('memory_limit', '-1');
        $toReturn[] = array();
        $current_module_id = 3;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }


            $toReturn['post_job'] = tbl_post_jobs::where('employer_ID', Session::get('id'))
                ->where('job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('job_code', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->paginate(20);
        }

        if ($toReturn['user_type'] == 'teamlead') {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
            $group_teammember_user_id = Session::get('one_group_teammember_id');

            foreach (@$group_teammember_user_id as $key => $value) {
                $teammember_record = user::where('ID', $group_teammember_user_id[$key])->where('user_type', "teammember")->first();
                $one_group_teammember_employer_id[$key] = @$teammember_record->ID;
            }
            // $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->orderBy('ID', 'DESC')->paginate(20);

            $array_val = Session::get('one_group_teammember_id');

            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $array_val)
                ->where('job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('job_code', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->paginate(20);
        }

        if ($toReturn['user_type'] == "employer") {
            $toReturn['post_job'] = tbl_post_jobs::where('company_ID', Session::get('org_ID'))
                ->where('job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('job_code', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->paginate(20);
        }
        $post_job_show = tbl_job_seekers::get()->toArray();

        return view('my_posted_jobs')->with('toReturn', $toReturn)->with('post_job_show', $post_job_show);
    }


    public function search_application(Request $request)
    {

        ini_set('memory_limit', '-1');
        $user_type = Session::get('type');
        if ($user_type == "employer") {
            $user_id = Session::get('org_ID');
        } else {
            $user_id = Session::get('user_id');
        }
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        if ($one_group_teammember_employer_id) {

            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->where('tbl_seeker_applied_for_job.org_id', Session::get('org_ID'))
                ->whereIn('tbl_seeker_applied_for_job.submitted_by', $one_group_teammember_employer_id)
                ->where('post_jobs.job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('post_jobs.job_code', 'LIKE', '%' . $request->search . '%')
                ->orWhere('post_jobs.client_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.last_name', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tbl_seeker_applied_for_job.ID', 'DESC')
                ->paginate(20);
        } else {
            $toReturn['application'] = Tbl_seeker_applied_for_job::leftjoin('tbl_post_jobs as post_jobs', 'tbl_seeker_applied_for_job.job_ID', '=', 'post_jobs.ID')
                ->leftjoin('tbl_job_seekers as seeker', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'seeker.ID')
                // ->leftjoin('tbl_seeker_applied_for_job as applied_jobs','applied_jobs.job_ID','=','post_jobs.ID ')
                ->select('seeker.ID as seeker_id', 'tbl_seeker_applied_for_job.ID as application_id', 'tbl_seeker_applied_for_job.current_location as current_location', 'post_jobs.city as job_city', 'post_jobs.state as job_state', 'post_jobs.ID as ID', 'post_jobs.job_code as job_code', 'post_jobs.job_title as job_title', 'post_jobs.client_name as job_client_name', 'post_jobs.country as location', 'post_jobs.job_visa_status as  job_visa', 'post_jobs.pay_min as pay_min', 'seeker.city as seeker_city', 'seeker.state as seeker_state', 'post_jobs.pay_max as pay_max', 'seeker.first_name as can_first_name', 'seeker.last_name as can_last_name', 'seeker.country as can_location', 'seeker.visa_status as can_visa', 'tbl_seeker_applied_for_job.dated as applied_date')
                ->where('tbl_seeker_applied_for_job.employer_ID', $user_id)
                ->where('post_jobs.job_title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('post_jobs.job_code', 'LIKE', '%' . $request->search . '%')
                ->orWhere('post_jobs.client_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('seeker.last_name', 'LIKE', '%' . $request->search . '%')
                ->orderBy('tbl_seeker_applied_for_job.ID', 'DESC')
                ->paginate(20);
        }
        return view('employerApplication')->with('toReturn', $toReturn);
    }

    public function candidate_search(Request $request)
    {


        ini_set('memory_limit', '-1');
        $toReturn = array();
        $source = "Internal";
        $one_group_teammember_employer_id = Session::get('one_group_teammember_id');
        if ($one_group_teammember_employer_id) {
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);


            $personal = tbl_job_seekers::whereIn('created_by', $one_group_teammember_employer_id)
                ->where('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('visa_status', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->distinct()
                ->paginate(20);




            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        } else {
            $toReturn['post_job'] = tbl_post_jobs::where('employer_ID', Session::get('id'))->paginate(10);


            $personal = tbl_job_seekers::where('tbl_job_seekers.employer_id', Session::get('user_id'))
                ->where('org_id', Session::get('org_ID'))
                ->where('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('visa_status', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->distinct()
                ->paginate(20);


            foreach ($personal as $key => $value) {
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $current_module_id = 2;
        $toReturn['user_type'] = Session::get('type');
        if ($toReturn['user_type'] == "teammember") {
            $user_permission_list = Session::get('user_permission');
            if ($user_permission_list) {
                foreach ($user_permission_list as $key => $value) {
                    if ($user_permission_list[$key]['module_id'] == $current_module_id) {
                        $toReturn['current_module_permission'] = Tbl_team_member_permission::where('permission_value', $current_module_id)->where('team_member_id', Session::get('user_id'))->first()->toArray();
                    }
                }
            }
        }
        if ($toReturn['user_type'] == "employer") {
            $all_user_id = user::where('org_ID', Session::get('org_ID'))->get('ID')->toArray();
            $toReturn['post_job'] = tbl_post_jobs::whereIn('created_by', $one_group_teammember_employer_id)->paginate(10);


            $personal = tbl_job_seekers::whereIn('created_by', $one_group_teammember_employer_id)
                ->where('org_id', Session::get('org_ID'))
                ->where('first_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('visa_status', 'LIKE', '%' . $request->search . '%')
                ->orderBy('ID', 'DESC')
                ->distinct()
                ->paginate(20);


            foreach ($personal as $key => $value) {
                $eduArrya = array();
                $education = tbl_seeker_academic::where('seeker_ID', $personal[$key]->ID)->get('degree_title')->toArray();
                foreach ($education as $key_seeker => $value) {
                    $eduArrya[$key_seeker] = $education[$key_seeker]['degree_title'];
                }
                $personal[$key]->degree = implode(',', $eduArrya);
            }
        }
        $job_list = Tbl_post_jobs::select('job_code', 'job_title', 'ID')->get()->toArray();
        return view('search_resume')->with('personal', $personal)->with('source', $source)->with('toReturn', $toReturn)->with('job_list', $job_list);
    }

    public function submit_candidate_job_search(Request $request)
    {
        ini_set('memory_limit', '-1');
        $source = "Internal";
        $toReturn['personal'] = \DB::table('tbl_job_seekers')
            ->select(
                'tbl_job_seekers.ID as id',
                'tbl_job_seekers.first_name as first',
                'tbl_job_seekers.last_name as last_name',
                'tbl_job_seekers.dob as dob',
                'tbl_job_seekers.city as city',
                'tbl_job_seekers.state as state',
                'tbl_job_seekers.visa_status as visa',
                'tbl_job_seekers.email as email',
                'tbl_job_seekers.mobile as mobile',
                'tbl_job_seekers.skype_id as skype_id',
                'tbl_job_seekers.cv_file',
                'tbl_seeker_applied_for_job.total_experience as experience',
                'tbl_seeker_academic.degree_title as degree'
            )
            ->leftjoin('tbl_seeker_experience', 'tbl_seeker_experience.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->leftjoin('tbl_seeker_academic', 'tbl_seeker_academic.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->leftjoin('tbl_seeker_applied_for_job', 'tbl_seeker_applied_for_job.seeker_ID', '=', 'tbl_job_seekers.ID')
            ->where('tbl_job_seekers.ID', $request->id)
            ->first();
        $toReturn['candiate_extra_doc'] = Tbl_seeker_documents::where('seeker_ID', $request->id)->orderBy('ID', 'DESC')->get()->toArray();

        //   return $toReturn['candiate_extra_doc '];
        $toReturn['job_list'] = tbl_post_jobs::where('company_ID', Session::get('org_ID'))
            ->where('job_title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('job_code', 'LIKE', '%' . $request->search . '%')
            ->orWhere('client_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('job_mode', 'LIKE', '%' . $request->search . '%')
            ->paginate(20);
        return view('employer_submit_to_job')->with('toReturn', $toReturn);
    }
    public function get_candiate_deatils($id = "")
    {
        ini_set('memory_limit', '-1');
        $post_job_show = tbl_job_seekers::orderBy('ID', 'DESC')->take(100)->select('ID', 'first_name', 'middle_name', 'last_name')->get()->toArray();
        return $post_job_show;
    }
    public function fetch_job_details($id = "")
    {
        ini_set('memory_limit', '-1');
        $job_list = Tbl_post_jobs::select('job_code', 'job_title', 'ID')->get()->toArray();
        return $job_list;
    }
}
