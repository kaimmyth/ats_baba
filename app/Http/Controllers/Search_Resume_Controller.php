<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tbl_job_seekers;
use App\Tbl_seeker_applied_for_job_doc;
use App\Tbl_seeker_experience;
use App\Tbl_seeker_skills;
use App\Tbl_seeker_academic;
use App\Tbl_seeker_applied_for_job;
use App\Tbl_countries;
use App\Tbl_cities;
use App\Tbl_candidate_mail;
use App\Tbl_visa_type;
use DB;
use App\cities;
use App\countries;
use App\states;
use App\tbl_post_job;
use App\Tbl_seeker_documents;
use Session;
use Mail;
use App\Tbl_notification;


class Search_Resume_Controller extends Controller
{
    public function __construct()
		{
			$this->middleware('mian_session');

		}
    
    public function index(){

        
        $toReturn['personal'] = \DB::table('tbl_job_seekers')
                                ->select('tbl_job_seekers.ID as id','tbl_job_seekers.first_name as first','tbl_job_seekers.last_name as last',
                                'tbl_job_seekers.dob','tbl_job_seekers.city','tbl_job_seekers.state','tbl_job_seekers.visa_status',
                                'tbl_job_seekers.email','tbl_job_seekers.mobile','tbl_job_seekers.skype_id',
                                'tbl_seeker_applied_for_job.total_experience as experience','tbl_seeker_academic.degree_title as degree')
                               ->leftjoin('tbl_seeker_experience','tbl_seeker_experience.seeker_ID', '=' , 'tbl_job_seekers.ID')
                               ->leftjoin('tbl_seeker_academic','tbl_seeker_academic.seeker_ID', '=' ,'tbl_job_seekers.ID' )
                               ->leftjoin('tbl_seeker_applied_for_job','tbl_seeker_applied_for_job.seeker_ID', '=' ,'tbl_job_seekers.ID' )
                               ->where('tbl_job_seekers.ID','=','*')
                               ->orderBy('tbl_job_seekers.ID','asc')
                               ->first();
                             
        return view ('search_resume')->with('toReturn',$toReturn);
        
    }
    
    public function post_new_candidate(Request $request){
        $con =  $request->country;
        $sta=  $request->state;
        $cit=  $request->city;
        $val_contries      =countries::where('country_id',$con)->first('country_name');

        $val_state      =states::where('state_id',$sta)->first('state_name');
        
        $val_city       =cities::where('city_id',$cit)->first('city_name');


        

        $postcandidate = new Tbl_job_seekers(); 
        $postcandidate->first_name=$request->first_name;
        $postcandidate->middle_name=$request->middle_name;
        $postcandidate->last_name=$request->last_name;
        $birthday = $request->dob_year . '-' . $request->dob_month . '-' . $request->dob_day;
        $postcandidate->dob=$birthday;
        $postcandidate->gender=$request->gender;
        $postcandidate->email=$request->email;
        $postcandidate->skype_id=$request->skype_id;
        $postcandidate->ssn=$request->ssn;
        $postcandidate->visa_status=$request->visa_status;
        $postcandidate->country=$val_contries['country_name'];
        $postcandidate->state=$val_state['state_name'];
        $postcandidate->city=$val_city['city_name'];
        $postcandidate->address_line_1=$request->addressline1;
        $postcandidate->address_line_2=$request->addressline2;
        $postcandidate->mobile=$request->mobilephone;
        $postcandidate->home_phone=$request->homephone;
            
        $postcandidate->fed_id=12;$postcandidate->dated="";$postcandidate->experience="";
        $postcandidate->default_cv_id=1;$postcandidate->cv_file="";$postcandidate->skills="";
        $postcandidate->employer_id=1;$postcandidate->created_by=12;$postcandidate->is_employer=12;
        $postcandidate->owner_id="";$postcandidate->min_pay_rate="";$postcandidate->max_pay_rate="";
        $postcandidate->pay_rate_umo="";
        $postcandidate->save();
        $degree = $request->degree;   
           foreach($degree as $key => $value) {
            $seeker_academic = new Tbl_seeker_academic();
            $seeker_academic->degree_title    = $degree[$key];
            $seeker_academic->major           = $request->major_subject[$key];
            $seeker_academic->institude       = $request->institute[$key];
            $seeker_academic->city            = $request->edu_city[$key];
            $seeker_academic->country         = $request->edu_country[$key];
            $seeker_academic->completion_year =$request->completion_year[$key];               
            $seeker_academic->save();
            
        }

        
        $job_title_experience = $request->job_title;              
        foreach($job_title_experience as $key => $value ){
            $seeker_exprience = new Tbl_seeker_experience();
            $seeker_exprience->  job_title  = $job_title_experience[$key]; 
            $seeker_exprience->company_name = $request->company_name[$key];
            $seeker_exprience->city         = $request->exp_city[$key];
            $seeker_exprience->country      = $request->exp_country[$key];
            $seeker_exprience->start_date   = $request->start_date[$key];
            $seeker_exprience->end_date     = $request->end_date[$key];
            $seeker_exprience->save();
            
        }
        

        
        $seeker_skill_name = new Tbl_seeker_skills();
        $seeker_skill_name->skill_name = $request->skill;
     return redirect('employer/search_resume');

    
    }
    public function show_form(){
        $toReturn=array();
        $toReturn['countries']=Tbl_countries::get()->toArray();
        $toReturn['cities']=Tbl_cities::get()->toArray(); 
        $toReturn['degree']=Tbl_seeker_academic::get()->toArray();
        $toReturn['visa_type']=Tbl_visa_type::get()->toArray();
       return view('post_new_candidate')->with('toReturn',$toReturn);
    }
    
    //Candidate->Experience
    public function edit_experience($id="")
    {
        $experiences= Tbl_seeker_experience::where('seeker_id',$id)->get();
        $country = countries::get();
        return view('team_member_edit_experience')->with('experiences',$experiences)->with('exp_seeker_id',$id)->with('country',$country);
    }

    public function add_insert(Request $data)
    {
        $seeker_id=$data->seeker_id;
        DB::insert('insert into tbl_seeker_experience(seeker_id,job_title,company_name,country,city,start_date,end_date) values(?,?,?,?,?,?,?)',[$data->seeker_id,$data->job_title,$data->company_name,$data->edu_country,$data->edu_city,$data->start_date,$data->end_date]); 
        return redirect('employer/team_member_edit_experience/'.$seeker_id);     
    }
  

    public function show_up($id="",$seekerid=""){
        $exp=tbl_seeker_experience::where('ID',$id)->first();
        // return $exp;
         $country = countries::get();
         return view('team_member_update_experience')->with('exp',$exp)->with('country',$country);
    }


    
    public function delete_entry($id="",$seekerid="")
    {
         $exp=DB::table('tbl_seeker_experience')->where('ID',$id)->delete();
         return redirect('employer/team_member_edit_experience/'.$seekerid);    
    }


public function update(Request $Request)
{
   $seekerid=$Request->seeker_id;
//    return $Request;
        $u=Tbl_seeker_experience::where('ID',$Request->ID)->update(array(
        'job_title'=>$Request->job_title,
        'company_name'=>$Request->company_name,
        'start_date'=>$Request->start_date,
        'end_date'=>$Request->end_date,
        'city'=>$Request->city,
        'country'=>$Request->country
        ));
    return redirect('employer/team_member_edit_experience/'.$seekerid);
}

//Candidate->Skills
public function view_skill($id="")
{
    $skills= Tbl_seeker_skills::where('seeker_ID',$id)->get()->toArray();
    return view('team_member_skills')->with('skills',$skills)->with('seeker_id',$id);
}

public function insert_skill(Request $data)
{
    $id=$data->seeker_ID;    
    DB::insert('insert into tbl_seeker_skills(seeker_ID,skill_name) values(?,?)',[$data->seeker_ID,$data->skills]); 
     return redirect('employer/team_member_skills/'.$id);    
}

public function delete_skill($id="",$seekerid="")
{
     $exp=DB::table('tbl_seeker_skills')->where('ID',$id)->delete();
     return redirect('employer/team_member_skills/'.$seekerid);    

}

//Candidate->Personal Details
public function view_personal_details($id="")
{
    $toReturn=array();
    $toReturn['countries']=Tbl_countries::get()->toArray();
    $toReturn['citie']=Tbl_cities::get()->toArray(); 
    $toReturn['degree']=Tbl_seeker_academic::get()->toArray();
    $toReturn['visa_type']=Tbl_visa_type::get()->toArray();
    $toReturn['cities']          =cities::get()->toArray();
    $toReturn['countries']       =countries::get()->toArray();
    $toReturn['states']          =states::get()->toArray();
    $details= Tbl_job_seekers::where('ID',$id)->first();
   return view('edit_posted_candidate')->with('toReturn',$toReturn)->with('details',$details);

}
public function update_personal_details(Request $request)
{
    
    //   return $request->state; 
    $con =  $request->country;
    $sta=  $request->state;
    $cit=  $request->city_name;
    $city_text_name=$request->city_text_name;
    $val_contries=countries::where('country_id',$con)->orWhere('country_name',$con)->first('country_name');
    $val_state=states::where('state_id',$sta)->orWhere('state_name',$sta)->first('state_name');
    // return $val_state;
    $val_city=cities::where('city_id',$cit)->orWhere('city_name',$cit)->first('city_name');
    if(!empty($city_text_name))
             {
                $val_city['city_name']=$city_text_name;
             }
             else
             {
                $val_city=cities::where('city_id',$cit)->orWhere('city_name',$cit)->first('city_name');
             } 
          if ($request->hasFile('cv_file')){
        $cv = $request->file('cv_file');
        $store_cv =$cv->getClientOriginalName();
        $cv->move(public_path('seekerresume'), $store_cv);
        }
        else{
            $store_cv=$request->cv_file_before;
        }
        
        if ($request->hasFile('file_other1')){
            $file_other1 = $request->file('file_other1');
            $store_file_other1 =$file_other1->getClientOriginalName();
            $file_other1->move(public_path('seekerresume'), $store_file_other1);
        }
        else
        {
            $store_file_other1="";
        }
        if ($request->hasFile('$file_other2')){
            $file_other2 = $request->file('$file_other2');
            $store_file_other2 =$file_other2->getClientOriginalName();
            $file_other2->move(public_path('seekerresume'), $store_file_other2);
        }
        else
        {
            $store_file_other2="";
        }
        
    $u=Tbl_job_seekers::where('ID',$request->id)->update(array(
    'first_name'=>$request->first_name,
    'middle_name'=>$request->middle_name,
    'last_name'=>$request->last_name,
    'dob'=>$request->dob,
    'gender'=>$request->gender,
    'email'=>$request->email,
    'skype_id'=>$request->skype_id,
    'ssn'=>$request->ssn,
    'visa_status'=>$request->visa_status,
    'email'=>$request->email,
    'country'=>$val_contries['country_name'],
    'state'=>$val_state['state_name'],
    'city'=>$val_city['city_name'],
    'experience'=>$request->total_experience,
    'total_experience'=>$request->experience,
    'total_usa_experience'=>$request->total_usa_experience,
    'address_line_1'=>$request->addressline1,
    'address_line_2'=>$request->addressline2,
    'mobile'=>$request->mobilephone,
    'home_phone'=>$request->homephone,
    'cv_file'=>$store_cv,
    'otherdocuments1'=>$store_file_other1,
    'otherdocuments2'=>$store_file_other2,
    ));
    
    $fname=$request->first_name;
    $mname=$request->middle_name;
    $lname= $request->last_name;
    $ID=$request->id;
    $Notification=new Tbl_notification();
    $Notification->notification_service_id=$ID;
    $Notification->service_type="Update Candidate";
    $Notification->notification_added_by=Session::get('id');
    $Notification->notification_added_to=$fname.$mname.$lname;
    $Notification->applied_id=" ";
    $Notification->notification_text=$fname.$mname.$lname. "This  Candidate Is Updated By ".Session::get('full_name');
    $mydate=date('Y-m-d');
    $Notification->submit_date=$mydate;
    $Notification->updated_date=$mydate;
    $Notification->read_date=$mydate;
    $Notification->read_status_team_member=1;
    $Notification->read_date_team_member=$mydate;
    // $Notification->notification_service_id=$Add_to_post_job->ID;
    $Notification->save();



    return redirect('employer/search_resume');
}

//Candidate->Education
public function view_education($id="")
{   
  
    $educations= Tbl_seeker_academic::where('seeker_id',$id)->get(); 
    $country = countries::get();
    return view('employer_edit_education')->with('educations',$educations)->with('id',$id)->with('country',$country);
}

    public function insert_education(Request $data)
    {
       $id=$data->seeker_ID;    
        DB::insert('insert into tbl_seeker_academic(seeker_ID,degree_title,institude,city,country,completion_year) values(?,?,?,?,?,?)',[$data->seeker_ID,$data->degree_title,$data->institude,$data->city,$data->country,$data->completion_year]);  
        return redirect('employer/employer_edit_education/'.$id);    
    }
    public function delete_education($id="",$seekerid="")
    {
         $del=Tbl_seeker_academic::where('ID',$id)->delete();
         return redirect('employer/employer_edit_education/'.$seekerid);    
    }


    public function update_education(Request $request,$id="",$seekerid="")
    {
        $edu=Tbl_seeker_academic::where('ID',$request->id)->update(array(
    'degree_title'=>$request->degree_title,
    'institude'=>$request->institude,
    'city'=>$request->city,
    'country'=>$request->country,
    'completion_year'=>$request->completion_year
        ));
        return redirect('employer/employer_edit_education/'.$seekerid);
    
    }
    public function jod_details_mail (Request $request)
    {
     $sender_email=Session::get('email');
        $sender_name=Session::get('full_name');
        $postmail = new Tbl_candidate_mail();
        $postmail->candidate_id=$request->candidate_id; 
        $postmail->mail_to=$request->mail_to;
        $postmail->mail_from=$sender_email;
        $postmail->subject=$request->subject;
        $postmail->job=$request->job;
        $postmail->comment=$request->comment;
        $postmail->save();
        $toemail=$request->mail_to;
        $formemail=$request->mail_from;
        $job_id=$request->job;
        $toReturn['job_post'] = tbl_post_job::where('id',$job_id)->first();
        $job_detail=$toReturn['job_post'];
        $mail_content=$request->comment;
        $mail_subject= $request->subject;
        $data=array('job_detail'=>$job_detail,'tomail'=>$toemail,'form_mail'=>$formemail ,'mail_content'=>$mail_content,'mail_subject'=>$mail_subject,'sender_email'=>$sender_email,'sender_name'=>$sender_name);
        Mail::send('emails.job_detail',['data' => $data], function($message) use ($data){
                $message->to($data['tomail'])
                        ->subject($data['mail_subject']);
                        // ->message($data['mail_content']);
                $message->from($data['sender_email'],$data['sender_name']);
            });
            return redirect('employer/search_resume');
    }
    public function job_matching($seeker_id)
    {
        $data= Tbl_job_seekers::where('ID',$seeker_id)->first();
        $results = array();
          $matchrecord=DB::table('tbl_post_jobs')->orWhere('required_skills','LIKE', '%'.$data->skills.'%')->orWhere('city', 'LIKE', '%'.$data->city.'%')->where('job_visa_status', 'LIKE', '%'.$data->visa_status.'%')->orderBy('ID','DESC')->get()->toArray();
          $results['job_record']=$matchrecord;
        foreach($matchrecord as $key=>$value)
        {
                $city_match=strnatcasecmp($data->city,$matchrecord[$key]->city);
                $visa_match_percentage=0;
                $skill_match_percentage=0;
                $city_match_percentage=0;
                $job_visa_array=explode(",",$matchrecord[$key]->job_visa_status);
                $job_skill_array=explode(",",$matchrecord[$key]->required_skills);
                foreach($job_visa_array as $key_visa=>$value)
                {
                    $visa_match_list=strnatcasecmp($job_visa_array[$key_visa],$data->visa_status);
                    if($visa_match_list==0)
                    {
                        $visa_match_percentage=30;
                    }
                }
                $job_skill_count=0;
                foreach($job_skill_array as $key_skill=>$value)
                {
                    $job_match_list=strnatcasecmp($job_skill_array[$key_skill],$data->skills);
                    $job_skill_count=$job_skill_count+1;
                    if($job_skill_count==3)
                    {
                        $skill_match_percentage=45;
                    }
                }
                if($city_match==0)
                {
                    $city_match_percentage=25;
                }
                $results['job_record'][$key]->match_percentage=$city_match_percentage + $visa_match_percentage + $skill_match_percentage;
        }
        return view('candidate_matching_job')->with('results',$results);
    }
    public function View_candidate_detail($id="")
    {
        $toReturn['job_seeker']=Tbl_job_seekers::where('ID',$id)->first();
        $toReturn['experience']=Tbl_seeker_experience::where('seeker_ID',$id)->get()->toArray();
        $toReturn['academic']=Tbl_seeker_academic::where('seeker_ID',$id)->get()->toArray();
        $toReturn['skills']=Tbl_seeker_skills::where('seeker_ID',$id)->get()->toArray();
        $toReturn['job_application']=Tbl_seeker_applied_for_job::where('seeker_ID',$id)->get()->toArray();
        $toReturn['job_details']=array();
        foreach($toReturn['job_application'] as $key =>$value)
        {
            $toReturn['job_details'][$key]=tbl_post_job::where('ID',$toReturn['job_application'][$key]['job_ID'])->first();
        }
        $toReturn['extra_doc']=Tbl_seeker_documents::where('seeker_ID',$id)->get()->toArray();
        return view('view_candidate_detail')->with('toReturn',$toReturn);
    }
    public function update_resume(Request $Request)
    {
        if($Request->file('Upload_cv'))
        {
            $upload_cv=$Request->file('Upload_cv');
            $file_name=$upload_cv->getClientOriginalName();
            $upload_cv->move(public_path('seekerresume'), $file_name);
            Tbl_job_seekers::where('ID',$Request->seeker_id)->update(array('cv_file'=>$file_name));
        }
        return redirect('employer/candidate/'.$Request->seeker_id); 
    }

}