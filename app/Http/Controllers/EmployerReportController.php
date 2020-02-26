<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_team_member_type;
use App\tbl_team_member;
use App\user;
use App\tbl_job_seekers;
use Session;
use DB;
use App\Tbl_seeker_applied_for_job;
use App\Tbl_forward_candidate;

class EmployerReportController extends Controller
{
    public function show_report_view()
    {
        $group_details = tbl_team_member_type::get();
        return view("Report.view_report")->with('group_details', $group_details);
    }
    public function genrate_report(Request $request)
    {
        return $request;
        $report_type = $request->type;
        $team_id = $request->team;
        $report_status = $request->status;
        $team_member_id = $request->team_member;
        // return $request;
        $post_assign_date = $request->data_interval;
        $today_date = date('2019-10-17');
        $toReturn['total_resume_submittal'] = array();
        $post_assign = array();
        if ($team_member_id != "") {
            $team_member_details = tbl_team_member::where('ID', $team_member_id)->where('company_id', Session('org_ID'))->get()->toArray();
        } else {
            $team_member_details = tbl_team_member::where('team_member_type', $team_id)->where('company_id', Session('org_ID'))->get()->toArray();
        }
        // print_r($team_member_details);
        // exit;

        if ($team_member_details != "") {
            foreach ($team_member_details as $key_team => $value_team) {
                $post_assign[$value_team['ID']] = tbl_team_member::leftjoin('tbl_job_post_assign', 'tbl_job_post_assign.team_member_id', '=', 'tbl_team_member.ID')
                    ->leftjoin('tbl_team_member_type', 'tbl_team_member_type.type_ID', '=', 'tbl_team_member.team_member_type')
                    ->leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_job_post_assign.job_post_id')
                    ->select(
                        'tbl_post_jobs.job_title as job_title',
                        'tbl_post_jobs.ID as Job_id',
                        'tbl_post_jobs.job_code as job_code',
                        'tbl_team_member.team_member_type',
                        'tbl_team_member.company_id',
                        'tbl_team_member.full_name',
                        'tbl_job_post_assign.team_member_id',
                        'tbl_team_member_type.type_name',
                        'tbl_team_member_type.type_ID',
                        'tbl_job_post_assign.job_assigned_date',
                        'tbl_team_member.email as user_email_id',
                        'tbl_team_member.company_id',
                        'tbl_job_post_assign.org_id',
                        'tbl_job_post_assign.ID'
                    )
                    ->orderBy('tbl_job_post_assign.ID','DESC')
                    ->where('tbl_job_post_assign.org_id', Session::get('org_ID'))
                    ->where('tbl_job_post_assign.owner_id', $value_team['ID'])
                    ->whereDate('tbl_job_post_assign.job_assigned_date',$post_assign_date)
                    ->get()->toArray();
                $job_ids = tbl_team_member::leftjoin('tbl_job_post_assign', 'tbl_job_post_assign.team_member_id', '=', 'tbl_team_member.ID')
                    ->leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_job_post_assign.job_post_id')
                    ->where('tbl_job_post_assign.org_id', Session::get('org_ID'))
                    ->where('tbl_job_post_assign.owner_id', $value_team['ID'])
                    ->select(
                        'tbl_post_jobs.ID as Job_id',
                        'tbl_post_jobs.job_code as job_code',
                        'tbl_post_jobs.job_title as job_title'
                    )->get();
                foreach ($job_ids as $key => $value) {
                    $toReturn[$value_team['ID']]['total_resume_submittal'][$value->Job_id] = count(Tbl_forward_candidate::where('job_id', $value->Job_id)->where('forward_by', $value_team['email'])->get());
                }
            }
        }
         return view("Report.view_report")->with(['toReturn' => @$toReturn,  'post_assign' => @$post_assign, 'report_type' => @$report_type, 'team_id' => @$team_id, 'team_member_id' => @$team_member_id, 'report_status' => @$report_status]);
    }
    public function genrate_report_old(Request $request)
    {
        $report_type = $request->type;
        $team_id = $request->team;
        $report_status = $request->status;
        $team_member_id = $request->team_member;
        // return $request;
        $post_assign_date = $request->data_interval;
        $today_date = date('2019-10-17');
        $toReturn['total_resume_submittal'] = array();
        $post_assign = array();
        if ($team_id != "") {
            $team_member_details = tbl_team_member::where('team_member_type', $team_id)->where('company_id', Session('org_ID'))->get();
        } else {
            $team_member_details = tbl_team_member::where('ID', $team_member_id)->where('company_id', Session('org_ID'))->get();
        }
        if ($team_member_details != "") {
            foreach ($team_member_details as $key_team => $value_team) {
                $post_assign[$value_team['ID']] = tbl_team_member::leftjoin('tbl_job_post_assign', 'tbl_job_post_assign.team_member_id', '=', 'tbl_team_member.ID')
                    ->leftjoin('tbl_team_member_type', 'tbl_team_member_type.type_ID', '=', 'tbl_team_member.team_member_type')
                    ->leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_job_post_assign.job_post_id')
                    ->select(
                        'tbl_post_jobs.job_title as job_title',
                        'tbl_post_jobs.ID as Job_id',
                        'tbl_post_jobs.job_code as job_code',
                        'tbl_team_member.team_member_type',
                        'tbl_team_member.company_id',
                        'tbl_team_member.full_name',
                        'tbl_job_post_assign.team_member_id',
                        'tbl_team_member_type.type_name',
                        'tbl_team_member_type.type_ID',
                        'tbl_job_post_assign.job_assigned_date',
                        'tbl_team_member.email as user_email_id',
                        'tbl_team_member.company_id',
                        'tbl_job_post_assign.org_id'
                    )
                    ->where('tbl_job_post_assign.org_id', Session::get('org_ID'))
                    ->where('tbl_job_post_assign.owner_id', $value_team['ID'])
                    // ->whereDate('tbl_job_post_assign.job_assigned_date',$post_assign_date)
                    ->get()->toArray();
                $job_ids = tbl_team_member::leftjoin('tbl_job_post_assign', 'tbl_job_post_assign.team_member_id', '=', 'tbl_team_member.ID')
                    ->leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_job_post_assign.job_post_id')
                    ->where('tbl_job_post_assign.org_id', Session::get('org_ID'))
                    ->where('tbl_job_post_assign.owner_id', $value_team['ID'])
                    ->select(
                        'tbl_post_jobs.ID as Job_id',
                        'tbl_post_jobs.job_code as job_code',
                        'tbl_post_jobs.job_title as job_title'
                    )->get();
                foreach ($job_ids as $key => $value) {
                    $toReturn[$value_team['ID']]['total_resume_submittal'][$value->Job_id] = count(Tbl_forward_candidate::where('job_id', $value->Job_id)->where('forward_by', $value_team['email'])->get());
                }
            }
        }
        // print_r($job_ids);
        // exit;
        // foreach($post_assign as $key_temp=>$value_temp)
        // {
        //     $report_view['assign']=$value_team;
        // }
        // exit;
        // return $toReturn;
        // return $post_assign['24'][0];

        $seeker_details = tbl_team_member_type::leftjoin('tbl_team_member', 'tbl_team_member.team_member_type', '=', 'tbl_team_member_type.type_ID')
            ->leftjoin('user', 'user.user_id', '=', 'tbl_team_member.ID')
            ->leftjoin('tbl_job_seekers', 'tbl_job_seekers.employer_id', '=', 'user.user_id')
            ->select(
                'tbl_team_member.ID as team_member_id',
                'tbl_job_seekers.ID as seeker_id',
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
            ->where('tbl_job_seekers.dated', $today_date)
            ->where('tbl_team_member.ID', $request->team_member)
            ->get();
        $job_details = Tbl_team_member_type::leftjoin('tbl_post_jobs', 'tbl_post_jobs.for_group', '=', 'tbl_team_member_type.type_ID')
            ->select(
                'tbl_team_member_type.type_ID as id',
                'tbl_team_member_type.type_name',
                'tbl_post_jobs.job_title as job_title',
                'tbl_post_jobs.ID as Job_id',
                'tbl_post_jobs.job_code as job_code',
                'tbl_post_jobs.for_group as group',
                'tbl_post_jobs.dated as date',
                'tbl_post_jobs.company_ID'
            )
            ->get();
        $user_id = user::where('ID', $request->team_member)->first('user_id');
        $application_submitted = Tbl_seeker_applied_for_job::leftjoin('tbl_job_seekers', 'tbl_job_seekers.ID', '=', 'tbl_seeker_applied_for_job.seeker_ID')
            ->leftjoin('user', 'user.ID', '=', 'tbl_job_seekers.employer_id')
            ->leftjoin('tbl_team_member', 'tbl_team_member.ID', '=', 'user.user_id')
            ->leftjoin('tbl_team_member_type', 'tbl_team_member_type.type_ID', '=', 'tbl_team_member.team_member_type')
            ->select(
                'user.ID as ',
                'tbl_job_seekers.ID',
                'tbl_job_seekers.dated',
                'tbl_seeker_applied_for_job.dated',
                'tbl_job_seekers.employer_id',
                'tbl_team_member.full_name',
                'tbl_team_member.team_member_type',
                'tbl_team_member_type.type_ID',
                'tbl_team_member_type.type_name',
                'tbl_team_member.company_id',
                'tbl_job_seekers.org_id'
            )
            ->where('tbl_job_seekers.org_id', Session::get('org_ID'))
            ->get();
        // return $post_assign;
        // return $forward_candidate;
        // return $post_assign;
        // return ['forward_candidate'=>$forward_candidate,'application_submitted'=>$application_submitted,'post_assign'=>$post_assign,'job_details'=>$job_details,'seeker_details'=>$seeker_details,'report_type'=>$report_type,'team_id'=>$team_id,'team_member_id'=>$team_member_id,'report_status'=>$report_status];
        return view("Report.view_report")->with(['toReturn' => @$toReturn, 'forward_candidate' => @$forward_candidate, 'application_submitted' => @$application_submitted, 'post_assign' => @$post_assign, 'job_details' => @$job_details, 'seeker_details' => @$seeker_details, 'report_type' => @$report_type, 'team_id' => @$team_id, 'team_member_id' => @$team_member_id, 'report_status' => @$report_status]);
    }
    public function get_team_details($type_id = "")
    {
        if ($type_id != "") {
            $group_details = tbl_team_member_type::get();
            return $group_details;
        }
    }
    public function get_team_member_details($team_id = "")
    {
        if ($team_id != "") {
            $team_member_details = tbl_team_member::where('team_member_type', $team_id)->get();
            return $team_member_details;
        }
    }
    public function get_date($status = "")
    {
        // print_r($status);
        $date_array = array();
        if ($status == 1) {
            for ($i = 0; $i < 5; $i++) {
                $date_array['date_d'][] = date('Y-m-d', strtotime('-' . $i*7 . ' days'));
                // $date_array['date_d'][]=date($date_array['date_d'],strtotime('-1 days'));
            }
        }
        if($status==2)
        {
            for($j=0;$j<5;$j++)
            {
                $date_array['date_d'][]=date('Y-m-d', strtotime('-'. $j*7 .' days'));
                // $date_array['date_d'][]=date($date_array['date_d'],strtotime('-1 days'));
            }
        }
        if($status==3)
        {
            for($j=0;$j<5;$j++)
            {
                $date_array['date_d'][]=date('Y-m-d', strtotime('-'. $j*30 .' days'));
                // $date_array['date_d'][]=date($date_array['date_d'],strtotime('-1 days'));
            }
        }
        return $date_array;
    }
}
