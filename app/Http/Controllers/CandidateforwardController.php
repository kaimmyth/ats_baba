<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Tbl_job_seekers;
use App\tbl_post_job;
use App\Tbl_seeker_academic;
use App\Tbl_seeker_applied_for_job;
use App\Tbl_seeker_experience;
use App\Tbl_forward_candidate;
use App\Tbl_forward_candidate_reference;
use App\Tbl_forward_candidate_exp_required;
use App\Tbl_forward_candidate_document;
use Mail;
use App\tbl_forward_emp_details;
use App\Tbl_seeker_documents;
use App\tbl_job_history;
use App\tbl_application_candidate_reference;
use App\tbl_application_candidate_exp_required;
use App\tbl_application_candidate_documents;
use App\tbl_application_emp_details;


class CandidateforwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('mian_session');
    }
    public function application_forword($id = "")
    {
        $toReturn['application_detail'] = Tbl_seeker_applied_for_job::where('ID', $id)->first();
        $toReturn['candiate_record'] = Tbl_job_seekers::where('ID', $toReturn['application_detail']->seeker_ID)->first();
        // return $toReturn['candiate_record'];
        $toReturn['candiate_extra_doc'] = Tbl_seeker_documents::where('seeker_ID', $toReturn['application_detail']->seeker_ID)->get('file_name')->toArray();
        $toReturn['qualification'] = tbl_seeker_academic::where('seeker_ID', $toReturn['application_detail']->seeker_ID)->orderBy('ID', 'DESC')->first();
        $toReturn['application_candidate_documents'] = tbl_application_candidate_documents::where('forward_candidate_id', $id)->get()->toArray();
        $toReturn['application_candidate_exp_required'] = tbl_application_candidate_exp_required::where('forward_candidate_id', $id)->get()->toArray();
        $toReturn['application_candidate_reference'] = tbl_application_candidate_reference::where('forward_candidate_id', $id)->get()->toArray();
        $toReturn['application_emp_details'] = tbl_application_emp_details::where('forward_candidate_id', $id)->first();
        $toReturn['form_email_id'] = Session::get('email');
        return view('forward_candidate')->with('toReturn', $toReturn);
    }
    public function forward_candidate(Request $Request)
    {
        //    return $Request->reference[0][0];

// return $Request->param;
$data_array=array();
        foreach($Request->param as $key_request=>$value_request)
        {
            // $data_array[]=$value_request;
           $data_array[$value_request] =$Request->input('' . $value_request);
        // echo "<br>";
        }
        echo"<pre>";
        print_r($data_array['reference']);
        exit;
            //   return $Request->reference;
        //  return $Request->experience;
        $update_resume = $Request->update_Resume_file;
        $experience_list = $Request->experience;
        $reference_list = $Request->reference;
        $job_id = $Request->job_id;
        $seeker_id = $Request->seeker_id;
        //   return $seeker_id;
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
        $forward_candidate->email_sign = $Request->email_sign;
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
        //  $forward_candidate->prefer_location=$Request->prefer_location;

        $forward_candidate->passyear = $seeker_edu_detail['completion_year'];
        //  $forward_candidate->passyear =$Request->completion_year;
       
        $forward_candidate->dob = $Request->dob;
        $forward_candidate->entered = $Request->entred_in_us;
        $forward_candidate->relocation = $Request->Open_For_Relocation;
        $forward_candidate->telephonicinterview = $Request->availa_for_tele;
        $forward_candidate->personinterview = $Request->availa_for_per;
        $forward_candidate->availibilitynewproj = $Request->availa_for_new;
        $forward_candidate->expectedrate = $Request->expectedrate;
        $forward_candidate->org_id = Session::get('org_ID');
        $forward_candidate->save();
        // $forward_candidate_reference = new Tbl_forward_candidate_reference();
        foreach ($Request->reference as $key => $valuecandaidate) {
            if ((!empty($Request->reference[$key][0])) && (!empty($Request->reference[$key][1])) && (!empty($Request->reference[$key][2])) && (!empty($Request->reference[$key][3])) && (!empty($Request->reference[$key][4]))) {
                $candidate_reference = new Tbl_forward_candidate_reference();
                $candidate_reference->forward_candidate_id = $forward_candidate->id;
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
            if (!empty($Request->experience[$key][0]) && (!empty($Request->experience[$key][1])) && (!empty($Request->experience[$key][2])) && (!empty($Request->experience[$key][3])) && (!empty($Request->experience[$key][4]))) {
                $candidate_exp = new Tbl_forward_candidate_exp_required();
                $candidate_exp->forward_candidate_id = $forward_candidate->id;
                $candidate_exp->skills    = $valueexp[0];
                $candidate_exp->yrs_of_exp    = $valueexp[1];
                $candidate_exp->expertise_level = $valueexp[2];
                $candidate_exp->org_id = Session::get('org_ID');
                $candidate_exp->save();
            }
        }
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
        if ($Request->seeker_doc) {
            $seeker_document = array();
            $seeker_document_value = array();
            foreach ($Request->seeker_doc as $key => $value) {
                $seeker_document[] = $Request->seeker_doc[$key];
            }
        }

        if ($Request->extra_seeker_doc) {
            $extra_seeker_document = array();
            foreach ($Request->extra_seeker_doc as $key => $value) {
                $extra_seeker_document[] = $Request->extra_seeker_doc[$key];
            }
        }
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
                $forward_candidate_documents->org_id = Session::get('org_ID');
                $forward_candidate_documents->save();
                $document_array = Tbl_forward_candidate_document::where('forward_candidate_id', $forward_candidate->id)->get('documents')->toArray();
                $data['document_array'] = $document_array;
            }
            $data = array('forward_candidate' => $forward_candidate, 'experience_list' => $experience_list, 'reference_list' => $reference_list, 'document_array' => $document_array, 'seeker_document' => @$seeker_document, 'extra_seeker_document' => @$extra_seeker_document);
        } else {
            $data = array('forward_candidate' => $forward_candidate, 'experience_list' => $experience_list, 'reference_list' => $reference_list, 'seeker_document' => @$seeker_document, 'extra_seeker_document' => @$extra_seeker_document);
        }
        if($Request->Employer_required=="Employer_required")
        {
        if ($Request->Companyemp_detail) {
            $emp_details = new tbl_forward_emp_details();
            $emp_details->forward_candidate_id = $forward_candidate->id;
            $emp_details->company_name = $Request->Companyemp_detail;
            $emp_details->email_Id = $Request->Emailemp_detail;
            $emp_details->phone_number = $Request->Phoneemp_detail;
            $emp_details->ext_no = $Request->extenson;
            $emp_details->employer_name = $Request->Employeremp_detail;
            $emp_details->status = 1;
            $emp_details->created_by = Session('user_id');
            $emp_details->org_id = Session::get('org_ID');
            $emp_details->save();
            $data['emp_details'] = $emp_details;
        }
     }
     return $data;
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
                    $document_path = "public/forward_document/" . @$document['documents'];
                    $message->attach($document_path);
                }
                if (@$data['extra_seeker_document']) {
                    foreach (@$data['extra_seeker_document'] as $key => $value) {
                        $path = "public/forward_document/" . @$data['extra_seeker_document'][$key];
                        $message->attach($path);
                    }
                }
                if (@$data['seeker_document']) {
                    foreach (@$data['seeker_document'] as $key => $value) {
                        $path = "public/seekerresume/" . @$data['seeker_document'][$key];
                        $message->attach($path);
                    }
                }
            } else {
                if (@$data['extra_seeker_document']) {
                    foreach (@$data['extra_seeker_document'] as $key => $value) {
                        $path = "public/forward_document/" . @$data['extra_seeker_document'][$key];
                        $message->attach($path);
                    }
                }
                if (@$data['seeker_document']) {
                    foreach (@$data['seeker_document'] as $key => $value) {
                        $path = "public/seekerresume/" . @$data['seeker_document'][$key];
                        $message->attach($path);
                    }
                }
            }
            $message->from($data['forward_candidate']['forward_by'], $data['forward_candidate']['sender_fullname']);
        });
        // return "done";
        $job_history = new tbl_job_history();
        $job_history->job_id = $Request->job_id;
        $job_history->update_text = "this is Job Is Sumit To Client";
        $job_history->date = date('Y-m-d');
        $job_history->created_by = Session::get('id');
        $job_history->updated_by = Session::get('id');
        $job_history->save();
        // return "done";
        return redirect('employer/Application');
    }
    public function List_submited_application()
    {
        $list_application_submittal = Tbl_forward_candidate::get()->toArray();
        return view('application.sumitted_application')->with('application', $list_application_submittal);
        print_r($list_application_submittal[0]);
        exit;
    }
}
