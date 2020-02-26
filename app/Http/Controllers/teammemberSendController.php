<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_team_member;
use App\tbl_post_job;
use App\Tbl_job_seekers;
use App\Tbl_forward_candidate;
use App\Tbl_seeker_applied_for_job;
use App\user;
use App\tbl_teammember_send_report;
use Session;
use Mail;

class teammemberSendController extends Controller
{
    public function __construct()
		{
			$this->middleware('mian_session');

		}
    public function report_show($id = "", $name = "")
    {
        //for days
        $data_id = $id;
        $team_memeber = tbl_team_member::where('ID', $id)->first();
        $data = $team_memeber['email'];
        $team_id=$team_memeber['team_member_type'];
        // return $data;
        $user_type=Session::get('type');
        // return $user_type;
        if($user_type=="teammember")
        {
        $user = user::where('user_id',$id)->first();
        for ($j = 0; $j < 12; $j++) {
            $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-' . $j . ' days'));
            $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-' . $j . ' days'));
            $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
            $toReturn['week_report'][$j]['job_created'] = count(tbl_post_job::whereDate('dated', $newDate[$j])->where('created_by', $user->ID)->get());
            $toReturn['week_report'][$j]['candidate_created'] = count(Tbl_job_seekers::whereDate('dated', $newDate[$j])->where('created_by', $id)->get());
            $toReturn['week_report'][$j]['client_submittal'] = count(Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->where('forward_by', $data)->get());
            $toReturn['week_report'][$j]['client_submittal_export'] =Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->where('forward_by', $data)->get();
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
        }
        else
        {
            $user = user::where('user_id',$id)->first();
            $team_memeber_id= tbl_team_member::where('team_member_type', $team_id)->pluck('ID');
            $team_memeber_email= tbl_team_member::where('team_member_type', $team_id)->pluck('email');
            $user_id = user::whereIn('user_id',$team_memeber_id)->pluck('ID');
            for ($j = 0; $j < 12; $j++) {
                $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-' . $j . ' days'));
                $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-' . $j . ' days'));
                $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
                $toReturn['week_report'][$j]['job_created'] = count(tbl_post_job::whereDate('dated', $newDate[$j])->whereIn('created_by', $user_id)->get());
                $toReturn['week_report'][$j]['candidate_created'] = count(Tbl_job_seekers::whereDate('dated', $newDate[$j])->whereIn('created_by', $team_memeber_id)->get());
                $toReturn['week_report'][$j]['client_submittal'] = count(Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->whereIn('forward_by', $team_memeber_email)->get());
                $toReturn['week_report'][$j]['client_submittal_export'] =Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->whereIn('forward_by', $team_memeber_email)->get();
                $toReturn['week_report'][$j]['application_submitted'] = count(Tbl_seeker_applied_for_job::whereDate('dated', $newDate[$j])->whereIn('submitted_by', $team_memeber_id)->get());
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
                    $toReturn['monthly'][$i]['job_created_monthly1'] = count(tbl_post_job::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->whereIn('created_by', $user_id)->get());
                    $toReturn['monthly'][$i]['candidate_created_monthly1'] = count(Tbl_job_seekers::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->whereIn('created_by', $team_memeber_id)->get());
                    $toReturn['monthly'][$i]['client_submittal_monthly1'] = count(Tbl_forward_candidate::whereMonth('forward_date', $toReturn['monthly'][$i]['month_week_one1'])->whereIn('forward_by', $team_memeber_email)->get());
                    // $toReturn['monthly'][$j]['client_submittal_export'] =Tbl_forward_candidate::whereMonth('forward_date', $toReturn['monthly'][$i]['month_week_one1'])->whereIn('forward_by', $team_memeber_email)->get();
                    $toReturn['monthly'][$i]['application_submitted_monthly1'] = count(Tbl_seeker_applied_for_job::whereMonth('dated', $toReturn['monthly'][$i]['month_week_one1'])->whereIn('submitted_by', $team_memeber_id)->get());
                    $global = $two;
                }
            }
        }
// return $toReturn;
        return view('Send_report.teammember_report')->with('toReturn', $toReturn)->with('name', $name)->with('data_id', $data_id);
    }
    public function send_report(Request $Request)
    {
        $document_array = array();
        if (($Request->sendfile_doc !== "") && ($Request->sendfile_doc !== null)) {
            foreach ($Request->file('sendfile_doc') as $key => $value) {
                $team_member_report = $Request->sendfile_doc[$key];
                $team_member_update = $team_member_report->getClientOriginalName();
                $team_member_report->move(public_path('send_report'), $team_member_update);
                $document_array[] = $team_member_update;
            }
        }
            $document_string = implode(',', $document_array);
            // echo $document_string;
            // exit;
            $send_report = new tbl_teammember_send_report();
            $send_report->sender_id = Session::get('id');
            $send_report->send_to = $Request->send_to;
            $send_report->send_cc = $Request->send_cc;
            $send_report->send_bcc = $Request->send_bcc;
            $send_report->subject = $Request->send_Subject;
            $send_report->email_contenrt = $Request->email_content;
            if ($Request->hasFile('sendfile_doc')) {
                $send_report->files = $document_string;
            }
            $send_report->is_employer = 0;
            $send_report->company = Session::get('org_ID');
            $send_report->dated = date('Y-m-d');
            $send_report->save();
            $sender_email = Session::get('email');
            $sender_name = Session::get('full_name');
            // echo $sender_name=$send_report->files;
            //         $multi_send_file=explode(',',$send_report->files);
            //         foreach ($multi_send_file as $key => $value) {
            //             echo $multi_send_file[$key];
            //         }
            // print_r($multi_send_file);
            // exit;

            $id = $Request->ID;
            $team_memeber = tbl_team_member::where('ID', $id)->first('email');
            $data = $team_memeber['email'];

            for ($j = 0; $j < 12; $j++) {
                $toReturn['week_report'][$j]['week_date'] = date('m-d-Y', strtotime('-' . $j . ' days'));
                $toReturn['week_date_dated_us'][$j] = date('d-m-Y', strtotime('-' . $j . ' days'));
                $newDate[$j] = date("Y-m-d", strtotime($toReturn['week_date_dated_us'][$j]));
                $toReturn['week_report'][$j]['job_created'] = count(tbl_post_job::whereDate('dated', $newDate[$j])->where('created_by', $id)->get());
                $toReturn['week_report'][$j]['candidate_created'] = count(Tbl_job_seekers::whereDate('dated', $newDate[$j])->where('created_by', $id)->get());
                $toReturn['week_report'][$j]['client_submittal'] = count(Tbl_forward_candidate::whereDate('forward_date', $newDate[$j])->where('forward_by', $data)->get());
                $toReturn['week_report'][$j]['application_submitted'] = count(Tbl_seeker_applied_for_job::whereDate('dated', $newDate[$j])->where('submitted_by', $id)->get());
            }

            $data = array('send_report' => $send_report, 'sender_email' => $sender_email, 'sender_name' => $sender_name, 'toReturn' => $toReturn);


            Mail::send('emails.send_report', ['data' => $data], function ($message) use ($data) {
                $email_to = explode(',', $data['send_report']['send_to']);
                foreach ($email_to as $key => $value) {
                    $message->to($email_to);
                }
                $message->subject($data['send_report']['subject']);
                if ($data['send_report']['send_cc']) {
                    $email_cc = explode(',', $data['send_report']['send_cc']);
                    foreach ($email_cc as $key => $value) {
                        $message->cc($email_cc[$key]);
                    }
                }
                if ($data['send_report']['send_bcc']) {
                    $email_bcc = explode(',', $data['send_report']['send_bcc']);
                    foreach ($email_bcc as $key => $value) {
                        $message->bcc($email_bcc[$key]);
                    }
                }
                if ($data['send_report']['files']) {
                    $multi_send_file = explode(',', $data['send_report']['files']);
                    foreach ($multi_send_file as $key => $value) {
                        $document_path = "public/send_report/" . $multi_send_file[$key];
                        $message->attach($document_path);
                    }
                }
                $message->from($data['sender_email'], $data['sender_name']);
            });

            return redirect('employer/dashboard');
        
    }   
}
