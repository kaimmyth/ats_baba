<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_post_contacts;
use DB;

require 'vendor/autoload.php';

use Maatwebsite\Excel\Facades\Excel;
use PhpSpreadsheet\PhpSpreadsheet\Spreadsheet;
use PhpSpreadsheet\PhpSpreadsheet\Reader\Csv;
use PhpSpreadsheet\PhpSpreadsheet\Reader\Xlsx;
use App\Tbl_forward_candidate;
use App\tbl_team_member;
use DateTime;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Carbon;
use Session;

class Import_Controller extends Controller
{

	public function import()
	{
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		if (isset($_FILES['Upload_exe']['name']) && in_array($_FILES['Upload_exe']['type'], $file_mimes)) {

			$arr_file = explode('.', $_FILES['Upload_exe']['name']);
			$extension = end($arr_file);

			if ('csv' == $extension) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {

				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $reader->load($_FILES['Upload_exe']['tmp_name']);

			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			// echo "<pre>";
			// print_r($sheetData);
			// exit;
			foreach ($sheetData as $key => $value) {
				$contact_list = new Tbl_post_contacts();
				//$contact_list=$value->id;
				$contact_list->company_name = @$sheetData[$key][0];
				$contact_list->designation = @$sheetData[$key][1];
				$contact_list->sub_name = @$sheetData[$key][2];
				$contact_list->cont_per_name = @$sheetData[$key][3];
				$contact_list->phone_c = @$sheetData[$key][4];
				$contact_list->phone_w = @$sheetData[$key][5];
				$contact_list->email_h = @$sheetData[$key][6];
				$contact_list->email_w = @$sheetData[$key][7];
				$contact_list->country = @$sheetData[$key][8];
				$contact_list->state = @$sheetData[$key][9];
				$contact_list->city = @$sheetData[$key][10];
				$contact_list->status = @$sheetData[$key][11];
				// $contact_list->created_date=$sheetData[$key][12];
				$mydate = date('Y-m-d');
				$contact_list->created_by = $mydate;
				$contact_list->last_updated_by = 90;
				$contact_list->last_updated_date = $mydate;
				$contact_list->employer_id = @$sheetData[$key][16];
				$contact_list->save();
			}
			$msg = "DataSheet Import Done";
			return redirect('employer/my_posted_contacts')->with('msg', $msg);
		} else {
			$msg = "DataSheet is not Upload";
			return redirect('employer/my_posted_contacts')->with('msg', $msg);
		}
	}
	public function export_excel($id = "", $name = "", $date = "")
	{
		$data = array(1 => array("Year-Sheet"));
		$data[] = array('Sl. No.', 'Year', 'Status', 'Date');

		\Excel::create('Year-Sheet', function ($excel) use ($data) {

			// Set the title
			$excel->setTitle('Year-Sheet');

			// Chain the setters
			$excel->setCreator('Paatham')->setCompany('Paatham');

			$excel->sheet('Fees', function ($sheet) use ($data) {
				$sheet->freezePane('A3');
				$sheet->mergeCells('A1:I1');
				$sheet->fromArray($data, null, 'A1', true, false);
				$sheet->setColumnFormat(array('I1' => '@'));
			});
		})->download('xls');
	}
	public function exportclientsubmittaldaily(Request $request)
	{
		// return $request;
		$date = $request->week_date;
		$id = $request->data_id;
		$name = $request->name;

		$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
		$team_memeber = tbl_team_member::where('ID', $id)->first();
		$team_id = $team_memeber['team_member_type'];
		$candidate_email = $team_memeber['email'];
		// return $candidate_email;
		$user_type = Session::get('type');
		// return $user_type;
		if ($user_type == "teammember") {
			$data = array(1 => array("Cilent Submittal Report"));
			$data[] = array('Sl. No.', 'Recruiter Mail ID', 'Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location', 'Pay Rate', 'Employer Name', 'Empolyer Mail Id', 'Client Name', 'Bill Rate');
			// $data[] = array('Sl. No.', 'Recruiter Name','Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location','Candidate Qualification','Pay Rate','Employer Name','Empolyer Mail','Client Name','Bill Rate');
			$toReturn = Tbl_forward_candidate::leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_forward_candidate.job_id')
				->leftjoin('tbl_forward_candidate_reference', 'tbl_forward_candidate_reference.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
				->leftjoin('tbl_forward_candidate_exp_required', 'tbl_forward_candidate_exp_required.forward_candidate_id', '=', 'tbl_forward_candidate.job_id')
				->leftjoin('tbl_job_seekers', 'tbl_job_seekers.ID', '=', 'tbl_forward_candidate.job_seeker_id')
				->leftjoin('tbl_forward_emp_details', 'tbl_forward_emp_details.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
				->select('tbl_forward_emp_details.employer_name as employer_name', 'tbl_forward_emp_details.phone_number as emp_phone_number', 'tbl_forward_emp_details.email_Id as emp_email_Id', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
				// ->select('tbl_job_seekers.first_name as candiate_f_name','tbl_job_seekers.last_name as candidate_l_name','tbl_job_seekers.skype_id as candidate_skype_id','tbl_job_seekers.country as canidate_country','tbl_job_seekers.state as candaite_state','tbl_job_seekers.city as candiate_city','tbl_job_seekers.mobile as candiate_mobile','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.pay_max as job_pay_max','tbl_post_jobs.client_name as job_client_name','tbl_post_jobs.job_title as job_title','tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_forward_candidate.expectedrate as submital_rate','tbl_forward_candidate.forward_by as forward_by','tbl_forward_candidate.forward_to as forward_to','tbl_forward_candidate.fullname as submittal_fullname','tbl_forward_candidate.visa_status as submittal_visa_status')
				// select('tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_post_jobs.job_title as job_title','tbl_post_jobs.job_code as job_code','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.job_mode as job_mode','tbl_post_jobs.job_duration as job_duration','tbl_post_jobs.pay_max as job_pay_max','tbl_forward_candidate.expectedrate as expectedrate','tbl_forward_candidate.fullname as candiadate_name','tbl_forward_candidate.city as candidate_city','tbl_forward_candidate.state as candidate_state','tbl_forward_candidate.','tbl_forward_candidate.visa_status as visa_type')
				->whereDate('forward_date', '02-20-2020')->where('forward_by', $candidate_email)->get()->toArray();
		} else {
			$team_memeber_id = tbl_team_member::where('team_member_type', $team_id)->pluck('ID');
			$team_memeber_email = tbl_team_member::where('team_member_type', $team_id)->pluck('email');
			$data = array(1 => array("Cilent Submittal Report"));
			$data[] = array('Sl. No.', 'Recruiter Mail ID', 'Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location', 'Pay Rate', 'Employer Name', 'Empolyer Mail Id', 'Client Name', 'Bill Rate');
			// $data[] = array('Sl. No.', 'Recruiter Name','Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location','Candidate Qualification','Pay Rate','Employer Name','Empolyer Mail','Client Name','Bill Rate');
			$toReturn = Tbl_forward_candidate::leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_forward_candidate.job_id')
				->leftjoin('tbl_forward_candidate_reference', 'tbl_forward_candidate_reference.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
				->leftjoin('tbl_forward_candidate_exp_required', 'tbl_forward_candidate_exp_required.forward_candidate_id', '=', 'tbl_forward_candidate.job_id')
				->leftjoin('tbl_job_seekers', 'tbl_job_seekers.ID', '=', 'tbl_forward_candidate.job_seeker_id')
				->leftjoin('tbl_forward_emp_details', 'tbl_forward_emp_details.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
				->select('tbl_forward_emp_details.employer_name as employer_name', 'tbl_forward_emp_details.phone_number as emp_phone_number', 'tbl_forward_emp_details.email_Id as emp_email_Id', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
				// ->select('tbl_job_seekers.first_name as candiate_f_name','tbl_job_seekers.last_name as candidate_l_name','tbl_job_seekers.skype_id as candidate_skype_id','tbl_job_seekers.country as canidate_country','tbl_job_seekers.state as candaite_state','tbl_job_seekers.city as candiate_city','tbl_job_seekers.mobile as candiate_mobile','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.pay_max as job_pay_max','tbl_post_jobs.client_name as job_client_name','tbl_post_jobs.job_title as job_title','tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_forward_candidate.expectedrate as submital_rate','tbl_forward_candidate.forward_by as forward_by','tbl_forward_candidate.forward_to as forward_to','tbl_forward_candidate.fullname as submittal_fullname','tbl_forward_candidate.visa_status as submittal_visa_status')
				// select('tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_post_jobs.job_title as job_title','tbl_post_jobs.job_code as job_code','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.job_mode as job_mode','tbl_post_jobs.job_duration as job_duration','tbl_post_jobs.pay_max as job_pay_max','tbl_forward_candidate.expectedrate as expectedrate','tbl_forward_candidate.fullname as candiadate_name','tbl_forward_candidate.city as candidate_city','tbl_forward_candidate.state as candidate_state','tbl_forward_candidate.','tbl_forward_candidate.visa_status as visa_type')
				->whereDate('forward_date', $date)
				->whereIn('forward_by', $team_memeber_email)
				->get()->toArray();
		}

		// return $toReturn;
		foreach ($toReturn as $key => $value) {
			// print_r($value);
			$data[] = array(
				$key + 1,
				$value['forward_by'],
				$value['job_title'],
				$value['submittal_fullname'],
				$value['candiate_mobile'],
				$value['candaite_state'],
				$value['job_pay_min'],
				$value['employer_name'],
				$value['emp_email_Id'],
				$value['job_client_name'],
				$value['submital_rate']
			);
		}
		// 		echo "<pre>";
		// 			print_r($data);
		// 			exit;
		// 		return $toReturn;
		// 		exit;
		@\Excel::create('Client_Submittal_report' . $name . $date, function ($excel) use ($data) {
			// Set the title
			$excel->setTitle('Client_Submittal_report');

			// Chain the setters
			$excel->setCreator('Paatham')->setCompany('Paatham');

			$excel->sheet('client_Submittal', function ($sheet) use ($data) {
				// $sheet->freezePane('A3');
				$sheet->fromArray($data);
			});
		})->download('xls');
	}

	public function exportclientsubmittalmontly(Request $request)
	{
		// $id = "", $name = "", $date = ""
		$date_arary = explode("-", $request->week_date);
		// $date = array("0" => $date_arary[0]);
		$date = implode("-", $date_arary);
		$team_memeber = tbl_team_member::where('ID', $request->data_id)->first();
		$team_id = $team_memeber['team_member_type'];
		$candidate_email = $team_memeber['email'];
		$user_type = Session::get('type');
		// return $user_type;
		if ($user_type == "teammember") {
		$data = array(1 => array("Cilent Submittal Report"));
		$data[] = array('Sl. No.', 'Recruiter Mail ID', 'Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location', 'Pay Rate', 'Employer Name', 'Empolyer Mail Id', 'Client Name', 'Bill Rate');
		// $data[] = array('Sl. No.', 'Recruiter Name','Job Titile', 'Candidate Name', 'Candidate Phone No.', 'Candidate location','Candidate Qualification','Pay Rate','Employer Name','Empolyer Mail','Client Name','Bill Rate');
		$toReturn = Tbl_forward_candidate::leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_forward_candidate.job_id')
			->leftjoin('tbl_forward_candidate_reference', 'tbl_forward_candidate_reference.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
			->leftjoin('tbl_forward_candidate_exp_required', 'tbl_forward_candidate_exp_required.forward_candidate_id', '=', 'tbl_forward_candidate.job_id')
			->leftjoin('tbl_job_seekers', 'tbl_job_seekers.ID', '=', 'tbl_forward_candidate.job_seeker_id')
			->leftjoin('tbl_forward_emp_details', 'tbl_forward_emp_details.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
			->select('tbl_forward_emp_details.employer_name as employer_name', 'tbl_forward_emp_details.phone_number as emp_phone_number', 'tbl_forward_emp_details.email_Id as emp_email_Id', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
			->select('tbl_job_seekers.first_name as candiate_f_name', 'tbl_job_seekers.last_name as candidate_l_name', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate_reference.location as referencelocation', 'tbl_forward_candidate_reference.clientName as referenceclientName', 'tbl_forward_candidate_reference.designation as referencedesignation', 'tbl_forward_candidate_reference.officialEmail as officialEmail', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
			// select('tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_post_jobs.job_title as job_title','tbl_post_jobs.job_code as job_code','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.job_mode as job_mode','tbl_post_jobs.job_duration as job_duration','tbl_post_jobs.pay_max as job_pay_max','tbl_forward_candidate.expectedrate as expectedrate','tbl_forward_candidate.fullname as candiadate_name','tbl_forward_candidate.city as candidate_city','tbl_forward_candidate.state as candidate_state','tbl_forward_candidate.','tbl_forward_candidate.visa_status as visa_type')
			->whereMonth('forward_date', '=', $date)
			->where('forward_by', $candidate_email)
			->orderBy('tbl_forward_candidate.ID','DESC')
			->get()->toArray();
		}
		else
		{
			$team_memeber_email = tbl_team_member::where('team_member_type', $team_id)->pluck('email');
			$toReturn = Tbl_forward_candidate::leftjoin('tbl_post_jobs', 'tbl_post_jobs.ID', '=', 'tbl_forward_candidate.job_id')
			->leftjoin('tbl_forward_candidate_reference', 'tbl_forward_candidate_reference.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
			->leftjoin('tbl_forward_candidate_exp_required', 'tbl_forward_candidate_exp_required.forward_candidate_id', '=', 'tbl_forward_candidate.job_id')
			->leftjoin('tbl_job_seekers', 'tbl_job_seekers.ID', '=', 'tbl_forward_candidate.job_seeker_id')
			->leftjoin('tbl_forward_emp_details', 'tbl_forward_emp_details.forward_candidate_id', '=', 'tbl_forward_candidate.ID')
			->select('tbl_forward_emp_details.employer_name as employer_name', 'tbl_forward_emp_details.phone_number as emp_phone_number', 'tbl_forward_emp_details.email_Id as emp_email_Id', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
			->select('tbl_job_seekers.first_name as candiate_f_name', 'tbl_job_seekers.last_name as candidate_l_name', 'tbl_job_seekers.skype_id as candidate_skype_id', 'tbl_job_seekers.country as canidate_country', 'tbl_job_seekers.state as candaite_state', 'tbl_job_seekers.city as candiate_city', 'tbl_job_seekers.mobile as candiate_mobile', 'tbl_post_jobs.pay_min as job_pay_min', 'tbl_post_jobs.pay_max as job_pay_max', 'tbl_post_jobs.client_name as job_client_name', 'tbl_post_jobs.job_title as job_title', 'tbl_forward_candidate_reference.location as referencelocation', 'tbl_forward_candidate_reference.clientName as referenceclientName', 'tbl_forward_candidate_reference.designation as referencedesignation', 'tbl_forward_candidate_reference.officialEmail as officialEmail', 'tbl_forward_candidate.expectedrate as submital_rate', 'tbl_forward_candidate.forward_by as forward_by', 'tbl_forward_candidate.forward_to as forward_to', 'tbl_forward_candidate.fullname as submittal_fullname', 'tbl_forward_candidate.visa_status as submittal_visa_status')
			// select('tbl_forward_candidate_reference.location as referencelocation','tbl_forward_candidate_reference.clientName as referenceclientName','tbl_forward_candidate_reference.designation as referencedesignation','tbl_forward_candidate_reference.officialEmail as officialEmail','tbl_post_jobs.job_title as job_title','tbl_post_jobs.job_code as job_code','tbl_post_jobs.pay_min as job_pay_min','tbl_post_jobs.job_mode as job_mode','tbl_post_jobs.job_duration as job_duration','tbl_post_jobs.pay_max as job_pay_max','tbl_forward_candidate.expectedrate as expectedrate','tbl_forward_candidate.fullname as candiadate_name','tbl_forward_candidate.city as candidate_city','tbl_forward_candidate.state as candidate_state','tbl_forward_candidate.','tbl_forward_candidate.visa_status as visa_type')
			->whereMonth('forward_date', '=', $date)
			->whereIn('forward_by', $team_memeber_email)
			->orderBy('tbl_forward_candidate.ID','DESC')
			->get()->toArray();
		}
		foreach ($toReturn as $key => $value) {
			// print_r($value);
			$location = $value['candiate_city'] . " " . $value['candaite_state'] . " " . $value['canidate_country'];
			$data[] = array(
				$key + 1,
				$value['forward_by'] ?? "",
				$value['job_title'] ?? "",
				$value['submittal_fullname'] ?? "",
				$value['candiate_mobile'] ?? "",
				$location ?? "",
				$value['job_pay_min'] ?? " ",
				$value['employer_name'] ?? " ",
				$value['emp_email_Id'] ?? " ",
				$value['job_client_name'] ?? " ",
				$value['submital_rate'] ?? " "
			);
		}

		// 	print_r($toReturn);
		// exit;
		// 		return $toReturn;
		@\Excel::create('Client_Submittal_report' . $request->name . $date, function ($excel) use ($data) {

			// Set the title
			$excel->setTitle('Client_Submittal_report');

			// Chain the setters
			$excel->setCreator('Paatham')->setCompany('Paatham');

			$excel->sheet('client Submittal', function ($sheet) use ($data) {
				// $sheet->freezePane('A3');
				$sheet->fromArray($data);
				// $sheet->fromArray($toReturn, null, true, false);
				// $sheet->setColumnFormat(array('I1' => '@'));
			});
		})->download('xls');
	}
}
