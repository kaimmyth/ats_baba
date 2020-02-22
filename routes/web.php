<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login page 
// Auth::routes();
Route::get('/',function(){
    return view('login.employer_login');
});
Route::get('employer_reset_password',function(){
    return view('login.employer_reset_password');
});
Route::get('/login', 'Login_Controller@index');
Route::post('login', 'Login_Controller@login_page');
Route::get('forget_password', 'Login_Controller@forget_password');
Route::post('email_link', 'Login_Controller@send_mail');
Route::get('email_red/{email}', 'Login_Controller@email_red_view');
Route::post('forgot', 'Login_Controller@forgot');
Route::get('employer/logout', 'Login_Controller@logout');

Route::get('forgetpassword', 'Login_Controller@forgetpassword_form');
Route::post('forgetemail', 'Login_Controller@send_email');

// JobSeeker Section routes definition
Route::get('indexjobseeker', 'Job_Seeker_Controller@index');
//new added
Route::get('indexjobseeker/logout', 'Job_Seeker_Controller@logout');
//
Route::get('jobseeker/my_account', 'Job_Seeker_Controller@manage_account');
Route::post('jobseeker/my_account/update', 'Job_Seeker_Controller@update_manage_account');
Route::post('jobseeker/change_pass/password_update', 'Job_Seeker_Controller@update_pass');
Route::post('jobseeker/edit_jobseeker/upload_photo', 'Job_Seeker_Controller@uploaded_image');
Route::post('jobseeker/add_skill/add', 'Job_Seeker_Controller@add');
Route::get('jobseeker/add_skill', 'Job_Seeker_Controller@show');
Route::get('jobseeker/my_jobs', 'Job_Seeker_Controller@my_jobs');
Route::get('jobseeker/add_info', 'Job_Seeker_Controller@add_info');
Route::get('jobseeker/search_jobs', 'Job_Seeker_Controller@search_jobs');

// Admin Dasahboard routes
Route::get('admindashboard', 'job_seeker_Controller@index1');
Route::post('admindashboard/addexp', 'job_seeker_Controller@addexp');
Route::post('admindashboard/addedu', 'job_seeker_Controller@addedu');
// Admin Dasahboard routes
Route::get('employer/fetchstate/{id}', 'LocationController@fetchstate');
Route::get('employer/fetchcity/{id}/{counid}', 'LocationController@fetchcity');


//Super admin route definition
Route::get('admin', 'userloginController@loginPage');
Route::post('adminLogin', 'userloginController@adminLogin');
Route::get('admin/dashboard', 'userloginController@dashboard');
Route::get('admin/logout', 'userloginController@logout');
Route::get('admin/emp_or_comp', 'EmployerCompanyController@index');
Route::get('employer/status/update/{id}', 'EmployerCompanyController@updateStatus');
Route::get('employer/top_employer/update/{id}', 'EmployerCompanyController@top_employer');
Route::get('admin/job_seekers_manage', 'jobseekersmanageController@index');
Route::get('admin/page_management', 'CMSController@index');
Route::get('admin/menu', 'CMSController@menu');
Route::post('admin/page_management/add', 'CMSController@add');
Route::get('admin/page_management/edit', 'CMSController@edit');
Route::get('admin/page_management/delete/{id}', 'CMSController@delete');
Route::get('cms/{pagehead}', 'CMSController@pagecontent');
Route::get('admin/invitejobseeker', 'Invite_jobseekerController@index');
Route::post('admin/invitejobseeker/add', 'Invite_jobseekerController@add');
Route::get('admin/inviteemployer', 'Invite_employerController@index');
Route::post('admin/inviteemployer/add', 'Invite_employerController@add');
Route::get('admin/institute', 'InstituteController@index');
Route::post('admin/institute/add', 'InstituteController@add_institute');
Route::post('admin/institute/edit', 'InstituteController@edit_institute');
Route::get('admin/institute/delete/{id}', 'InstituteController@delete_institute');
Route::get('admin/salary', 'SalaryController@index');
Route::post('admin/salary/add', 'SalaryController@add');
Route::post('admin/salary/edit', 'SalaryController@edit_salary');
Route::get('admin/salary/delete/{id}', 'SalaryController@delete_salary');
Route::get('admin/qualification', 'QualificationController@index');
Route::post('admin/qualification/add', 'QualificationController@add_qualification');
Route::post('admin/qualification/edit', 'QualificationController@edit_qualification');
Route::get('admin/qualification/delete/{id}', 'QualificationController@delete_qualification');
Route::get('admin/ads', 'Ads_Management@index');
Route::post('admin/upda_ads', 'Ads_Management@update_ads');
Route::get('admin/countries', 'CountriesController@index');
Route::post('admin/countries/add', 'CountriesController@add_countries');
Route::post('admin/countries/edit', 'CountriesController@edit_countries');
Route::get('admin/countries/delete/{id}', 'CountriesController@delete_countries');
Route::get('admin/cities', 'CityController@index');
Route::post('admin/cities/add', 'CityController@add_cities');
Route::post('admin/cities/edit', 'CityController@edit_cities');
Route::get('admin/cities/delete/{id}', 'CityController@delete');
Route::get('admin/prohibited_keyword', 'ProhibitedController@index');
Route::post('admin/prohibited_keyword/add', 'ProhibitedController@add');
Route::post('admin/prohibited_keyword/edit', 'ProhibitedController@edit');
Route::get('admin/prohibited_keyword/delete/{id}', 'ProhibitedController@delete');
Route::get('admin/manageskills', 'ManageSkillController@index');
Route::get('admin/team_members', 'TeamMemberController@index');
Route::post('admin/team_members/add', 'TeamMemberController@add_teammembertype');
Route::post('admin/team_members/edit', 'TeamMemberController@edit_teammembertype');
Route::get('admin/team_members/delete/{id}', 'TeamMemberController@delete_teammembertype');

Route::get('admin/team_members_view/delete/{id}', 'TeamMemberController@delete_team_view');
Route::get('admin/team_members_view', 'TeamMemberController@view_team_member');
Route::get('admin/team_members_view/show_report', 'TeamMemberController@report');
Route::get('admin/team_members_view/show_report_seeker', 'TeamMemberController@seeker_report');
Route::get('admin/team_members_view/show_report_seeker_applied_for', 'TeamMemberController@show_report_seeker_applied_for');
Route::get('admin/team_members_view/forward_to', 'TeamMemberController@forward_to');

Route::get('admin/team_members_view/report_show/{id}/{name}', 'TeamMemberController@report_show');

Route::get('admin/visa_type', 'VisaTypeController@index');
Route::post('admin/visa_type/add', 'VisaTypeController@add_visa_type');
Route::post('admin/visa_type/edit', 'VisaTypeController@edit_visa_type');
Route::get('admin/visa_type/delete/{id}', 'VisaTypeController@delete_visa_type');
Route::get('admin/pay_umo', 'Pay_UMO_Controller@index');
Route::post('admin/pay_umo/add', 'Pay_UMO_Controller@add_pay_umo');
Route::post('admin/pay_umo/edit', 'Pay_UMO_Controller@edit_pay_umo');
Route::get('admin/pay_umo/delete/{id}', 'Pay_UMO_Controller@delete_pay_umo');

// admin Manage Marketing
Route::get('admin/marketing', 'adminMarketingController@index');
Route::post('admin/marketing/addcontact', 'adminMarketingController@addcontact');
Route::post('admin/emailTemplate', 'adminMarketingController@add_template');
Route::post('admin/market_mail', 'adminMarketingController@send_mail');
Route::get('admin/schedule', 'adminMarketingController@schedule_email');
Route::post('admin/mails', 'adminMarketingController@send_mail');
Route::get('admin/emailTemplate/edit/{id}', 'adminMarketingController@edit_template');
Route::post('admin/emailTemplate/updated', 'adminMarketingController@update_template');
Route::get('admin/emailTemplate/delete/{id}', 'adminMarketingController@deletetemplate');
Route::get('admin/marketing/emaillistdelete/{id}', 'adminMarketingController@deleteemaillist');
Route::get('admin/marketing/contactdelete/{id}', 'adminMarketingController@deleteContact');

Route::get('admin/marketing/post_job/state/{country_id}', 'LocationController@get_state');
Route::get('admin/post_new_job/post_job/city/{state_id}', 'LocationController@get_city');

//Super admin route definition






//JobSeeker Section routes definition
Route::get('indexjobseeker', 'Job_Seeker_Controller@index');
Route::get('jobseeker/my_account', 'Job_Seeker_Controller@manage_account');
Route::post('jobseeker/my_account/update', 'Job_Seeker_Controller@update_manage_account');
Route::get('jobseeker/change_pass', 'Job_Seeker_Controller@change_pass');
Route::post('jobseeker/change_pass/password_update', 'Job_Seeker_Controller@update_pass');
Route::post('jobseeker/edit_jobseeker/upload_photo', 'Job_Seeker_Controller@uploaded_image');
Route::post('jobseeker/add_skill/add', 'Job_Seeker_Controller@add');
Route::get('jobseeker/add_skill', 'Job_Seeker_Controller@show');
Route::get('jobseeker/my_jobs', 'Job_Seeker_Controller@my_jobs');
Route::get('jobseeker/add_info', 'Job_Seeker_Controller@add_info');
Route::get('jobseeker/add_info/add', 'Job_Seeker_Controller@insert_additonal_info');
Route::get('jobseeker/search_jobs', 'Job_Seeker_Controller@search_jobs');
Route::post('jobseeker/dashboard/notes', 'job_seeker_Controller@notes');




// Route::get('emp','Employee_Dashboard_Controller@index');


Route::post('admindashboard/addexp', 'Job_Seeker_Controller@addexp');
Route::post('admindashboard/addedu', 'Job_Seeker_Controller@addedu');

// Admin Dasahboard routes
Route::get('notifications', 'NotificationController@show_notification');
Route::get('notification/details/{id}', 'NotificationController@details');
//New Register Jobpost.......................................................... 
Route::get('jobpostsignup', 'Post_Job_Controller@index');
Route::post('jobpostsignup/add', 'Post_Job_Controller@insert');
//New Register Jobseeker........................................................
Route::get('jobseekersignup', 'Seeker_Signup_Controller@index');
Route::post('jobseekersignup/add', 'Seeker_Signup_Controller@add');
Route::post('jobseeker/dashboard/notes', 'Job_Seeker_Controller@notes');


//Route::get('login','EmployerloginController@index');
//Route::post('login/emp','EmployerloginController@login');


Route::get('dashboard', 'dashboardController@index');


//Employer Section routes definition
Route::get('employer/companyprofile', 'CompanyProfileController@index');
Route::get('employer/companyprofile/edit', 'CompanyProfileController@edit');
Route::post('employer/companyprofile/update', 'CompanyProfileController@update');
Route::get('employer/posted_companies', 'PostedCompaniesController@index');
Route::get('employer/posted_companies/add_form', 'PostedCompaniesController@add_form');
Route::post('employer/posted_companies/add', 'PostedCompaniesController@add');
Route::get('employer/posted_companies/edit/{id}', 'PostedCompaniesController@edit');
Route::post('employer/posted_companies/update', 'PostedCompaniesController@update');
Route::get('employer/posted_companies/delete/{id}', 'PostedCompaniesController@delete');
Route::get('employer/manages_team_members', 'EmployerManageTeamMemberController@index');
Route::get('employer/post_new_contacts', 'ContactController@index');
Route::get('employer/post_new_contacts/change_add_status','ContactController@change_add_status');
Route::post('employer/post_new_contacts/add', 'ContactController@add');
Route::get('employer/my_posted_contacts', 'ContactController@show');
Route::get('employer/my_posted_contacts/delete/{id}', 'ContactController@delete');

Route::post('employer/post_new_email_contact/add', 'ContactController@add_email_form');
Route::get('employer/post_new_email_contact/show', 'ContactController@show_email_form');
Route::get('employer/my_posted_contacts/delete_email/{id}', 'ContactController@delete_email');
Route::get('employer/my_posted_contacts/delete_email_list/{id}', 'ContactController@delete_email_list');
Route::post('employer/importContact', 'Import_Controller@import');

Route::get('employer/search_resume', 'Job_Employer_Controller@list');
Route::get('employer/search_resume_published_today', 'Job_Employer_Controller@list_todays_resume');

Route::get('employer/search_resume/delete/{id}', 'Job_Employer_Controller@list_delete');
Route::get('employer/post_new_candidate', 'Job_Employer_Controller@show_form');
Route::post('employer/post_new_candidate/insert', 'Job_Employer_Controller@post_new_candidate');
Route::get('employer/dashboard', 'Job_Employer_Controller@dashboard');
Route::post('job_application/sts', 'Job_Employer_Controller@status');
Route::get('employer/show_job_details/{id}','Job_Employer_Controller@fetch_job_details');



// Route::get('employer/Application','Job_Employer_Controller@application');
Route::get('employer/delete/{id}', 'Job_Employer_Controller@delete_employer');


Route::get('employer/post_new_job', 'Job_Employer_Controller@view_post_form');
Route::get('employer/jobsdetails/{id}', 'Job_Employer_Controller@show_detail');
Route::get('employer/job/edit/{id}', 'Job_Employer_Controller@editjob');
Route::post('employer/post_job/update', 'Job_Employer_Controller@updatejob');
Route::get('employer/teammember', 'Job_Employer_Controller@showteam');
Route::post('employer/teammemberadd', 'Job_Employer_Controller@showteamadd');
Route::get('employer/teammember/add', 'Job_Employer_Controller@addteam');
Route::post('employer/teammember/addinsert', 'Job_Employer_Controller@addteaminsert');
Route::get('employer/manageteammember', 'Job_Employer_Controller@manageteam');
Route::get('employer/manageteammember/delete/{id}', 'Job_Employer_Controller@delete_teammember');
Route::get('employer/manageteammember/edit/{id}', 'Job_Employer_Controller@edit_teammember');
Route::post('employer/manageteammember/edit/add', 'Job_Employer_Controller@edit_teammember_add');
Route::get('employer/manageteammember/add', 'Job_Employer_Controller@manageteamadd');
Route::get('employer/manageteammember/add/delete/{id}', 'Job_Employer_Controller@delete_teammember_type');
Route::post('employer/manageteammember/add/edit', 'Job_Employer_Controller@manageteamaddedit');
//new
Route::any('employer/manageteammember/team_members_view/report_show/{id}/{name}', 'Job_Employer_Controller@report_show');
Route::get('permission/org', 'Job_Employer_Controller@permission_org');
//employeer Features for marketing
Route::get('employer/marketing', 'MarketingController@index');
Route::post('employer/market_mail', 'MarketingController@send_mail');
Route::get('employer/schedule', 'MarketingController@schedule_email');
Route::post('employer/mails', 'MarketingController@send_mail');
Route::post('employer/emailTemplate', 'MarketingController@add_template');
Route::get('employer/emailTemplate/edit/{id}', 'MarketingController@edit_template');
Route::post('employer/emailTemplate/updated', 'MarketingController@update_template');
Route::post('employer/marketing/addcontact', 'MarketingController@addcontact');
Route::get('employer/emailTemplate/delete/{id}', 'MarketingController@deletetemplate');
Route::get('employer/marketing/emaillistdelete/{id}', 'MarketingController@deleteemaillist');
Route::get('employer/marketing/contactdelete/{id}', 'MarketingController@deleteContact');
Route::get('notifications', 'NotificationController@show_notification');
Route::get('employer/posted_job_assined/{id}', 'Job_Employer_Controller@assign_job');
Route::get('employer/posted_job_assined', 'Job_Employer_Controller@assign_job');
Route::post('employer/assigned', 'Job_Employer_Controller@assign_active');
Route::get('employer/appli_forward/{id}', 'CandidateforwardController@application_forword');
Route::post('employer/forward_candidate', 'CandidateforwardController@forward_candidate');
Route::get('employer/submit_candidate_detail/{id}', 'Job_Employer_Controller@list_candidate');
Route::post('employer/submit_candidate', 'Job_Employer_Controller@submit_candidate');
Route::get('employer/listmember/{id}', 'Job_Employer_Controller@list_teammember');

// Jobsseeker Routes definition
Route::get('test', function () {
    return view('employer_manage_team_members');
});

Route::get('jobseeker/dashboard', 'Job_Seeker_Controller@dashboard');


Route::get('employer/Application', 'Job_Employer_Controller@application');
Route::get('employer/application-received-today', 'Job_Employer_Controller@application_received_today');


Route::get('employer/appli_del/{id}', 'Job_Employer_Controller@application_delete');

Route::get('employer/posted_jobs', 'Job_Employer_Controller@view_my_posted_job');
Route::get('employer/jobs-open-today','Job_Employer_Controller@view_jobs_open_today');//Jobs published today


Route::get('employer/show_candiate_details/{id}','Job_Employer_Controller@get_candiate_deatils');
Route::get('employer/post_new_job', 'Job_Employer_Controller@view_post_form');
Route::post('employer/post_new_job/post_job', 'Job_Employer_Controller@Add_to_post_job');
Route::get('employer/job/edit/{id}', 'Job_Employer_Controller@editjob');
Route::post('employer/post_job/update', 'Job_Employer_Controller@updatejob');
Route::post('employer/post_job/update', 'Job_Employer_Controller@updatejob');
Route::post('posted_jobs/assign', 'Job_Employer_Controller@PostjobsAssignToJobSeeker');



Route::post('employer/importContact', 'Import_Controller@import');



// Employer Section routes definition
// Route::get('employer/teammember','Job_Employer_Controller@showteam');
// Route::post('employer/teammemberadd','Job_Employer_Controller@showteamadd');
// Route::get('employer/teammember/add','Job_Employer_Controller@addteam');
// Route::post('employer/teammember/addinsert','Job_Employer_Controller@addteaminsert');

Route::get('employer/manageteammember', 'Job_Employer_Controller@manageteam');
Route::get('employer/manageteammember/delete/{id}', 'Job_Employer_Controller@delete_teammember');
Route::get('employer/manageteammember/edit/{id}', 'Job_Employer_Controller@edit_teammember');
Route::post('employer/manageteammember/edit/add', 'Job_Employer_Controller@edit_teammember_add');
Route::get('employer/manageteammember/add', 'Job_Employer_Controller@manageteamadd');
Route::get('employer/manageteammember/add/delete/{id}', 'Job_Employer_Controller@delete_teammember_type');
Route::post('employer/manageteammember/add/edit', 'Job_Employer_Controller@manageteamaddedit');
Route::get('employer/jobsdetails/{id}', 'Job_Employer_Controller@show_detail');
Route::get('employer/jobsdetails/{id}', 'JobDetailsController@show_detail');
Route::get('jobseeker/dashboard', 'Job_Seeker_Controller@dashboard');
Route::get('admin', 'userloginController@loginPage');
Route::post('adminLogin', 'userloginController@adminLogin');
Route::get('admin/dashboard', 'userloginController@dashboard');
Route::get('admin/logout', 'userloginController@logout');

Route::get('admin/cities', 'CityController@index');

Route::get('admin/qualification', 'QualificationController@index');
Route::post('admin/qualification/add', 'QualificationController@add_qualification');
Route::post('admin/qualification/edit', 'QualificationController@edit_qualification');
Route::get('admin/qualification/delete/{id}', 'QualificationController@delete_qualification');

Route::post('admin/cities/add', 'CityController@add_cities');
Route::post('admin/cities/edit', 'CityController@edit_cities');
Route::get('admin/cities/delete/{list}', 'CityController@delete');
Route::get('admin/countries', 'CountriesController@index'); //for countries call
Route::post('admin/countries/add', 'CountriesController@add_countries');
Route::post('admin/countries/edit', 'CountriesController@edit_countries');
Route::get('admin/countries/delete{id}', 'CountriesController@delete_countries');
Route::post('admin/state/add', 'CityController@add_state');

Route::get('admin/salary', 'SalaryController@index');
Route::get('admin/salary/edit', 'SalaryController@edit_salary');
Route::get('admin/salary/delete/{id}', 'SalaryController@delete_salary');
Route::post('admin/salary/add', 'SalaryController@add');


Route::get('admin/institute', 'InstituteController@index');        //for institute call
Route::post('admin/institute/add', 'InstituteController@add_institute');        //for institute call
Route::post('admin/institute/edit', 'InstituteController@edit_institute');        //for institute call
Route::get('admin/institute/delete/{id}', 'InstituteController@delete_institute');        //for institute call

Route::get('admin/industries', 'IndustryController@index');         //for industries call
Route::get('admin/page_management', 'CMSController@index');               //For manages pages
Route::post('admin/page_management/add', 'CMSController@add');
Route::get('admin/page_management/edit', 'CMSController@edit');

//For manages pages
Route::get('admin/pay_umo', 'Pay_UMO_Controller@index');
Route::post('admin/pay_umo/add', 'Pay_UMO_Controller@add_pay_umo');
Route::post('admin/pay_umo/edit', 'Pay_UMO_Controller@edit_pay_umo');
Route::get('admin/pay_umo/delete/{id}', 'Pay_UMO_Controller@delete_pay_umo');

Route::get('admin/visa_type', 'VisaTypeController@index');              //for visa type  call
Route::post('admin/visa_type/add', 'VisaTypeController@add_visa_type');              //for visa type  call
Route::post('admin/visa_type/edit', 'VisaTypeController@edit_visa_type');              //for visa type  call
Route::get('admin/visa_type/delete/{id}', 'VisaTypeController@delete_visa_type');              //for visa type  call

Route::get('admin/industries', 'IndustryController@index');

Route::get('admin/prohibited_keyword', 'ProhibitedController@index');
Route::post('admin/prohibited_keyword/add', 'ProhibitedController@add');
Route::post('admin/prohibited_keyword/edit', 'ProhibitedController@edit');
Route::get('admin/prohibited_keyword/delete/{id}', 'ProhibitedController@delete');
Route::get('admin/page_management', 'CMSController@index');               //For manages pages
Route::post('admin/page_management/add', 'CMSController@add');
Route::get('admin/page_management/edit', 'CMSController@edit');
Route::get('admin/page_management/delete/{id}', 'CMSController@delete');
Route::get('cms/{pagehead}', 'CMSController@pagecontent');
Route::get('admin/jobseekersmanage', 'jobseekersmanageController@index');
Route::get('admin/invitejobseeker', 'Invite_jobseekerController@index');
Route::post('admin/invitejobseeker/add', 'Invite_jobseekerController@add');
Route::get('jobseekersignup', 'JobseekrSignupController@index');
Route::post('jobseekersignup/add', 'JobseekrSignupController@add');
Route::get('admin/empcompmanage', 'EmployerCompanyController@index');
Route::get('admin/manageskills', 'ManageSkillController@index');
Route::get('admin/inviteemployer', 'InviteEmpolyerController@index');
Route::post('admin/inviteemployer/add', 'InviteEmpolyerController@add');
Route::get('employer/marketing', 'MarketingController@index');
Route::post('employer/market_mail', 'MarketingController@send_mail');
Route::get('employer/schedule', 'MarketingController@schedule_email');


// Route::get('employer/team_member_account','MarketingController@team_member_account');


// interview

// Route::get('employer/dashboard/interview','Job_Employer_Controller@show_interview');
Route::get('employer/dashboard/interview-meeting/add', 'Job_Employer_Controller@show_interview_add');
// Route::get('employer/dashboard/meeting','Job_Employer_Controller@show_meeting');

// Route::get('employer/dashboard/interview-meeting','Job_Employer_Controller@show_interviewC');

Route::get('employer/dashboard/interview-meeting-tab/add', 'Job_Employer_Controller@show_meeting1');

//data add

Route::post('employer/dashboard/interview_meeting/add', 'Job_Employer_Controller@addinterview');
Route::post('employer/dashboard/interview_meeting_interview/add1', 'Job_Employer_Controller@addmeeting');
Route::get('employer/dashboard/interview-meeting', 'Job_Employer_Controller@meetingshow');

Route::get('employer/dashboard/interview-today', 'Job_Employer_Controller@todaysinterviewshow');//For todays interview
Route::get('employer/dashboard/meeting-today', 'Job_Employer_Controller@todays_meetings_show');//For todays meetings
Route::get('employer/dashboard/interview-meeting-del{id}', 'Job_Employer_Controller@del');
Route::get('employer/dashboard/interview-meeting-intdel{ida}', 'Job_Employer_Controller@delint');

//delete admin data job seekers

Route::get('admin/job_seekers/applied_jobs/de{id}', 'jobseekersmanageController@de');


Route::get('employer/dashboard/interview-meeting-up{id}', 'Job_Employer_Controller@upda');

Route::post('employer/dashboard/interview-meeting-upchange', 'Job_Employer_Controller@updateadd');
Route::get('employer/dashboard/interview-meeting-intedit{id}', 'Job_Employer_Controller@updaint');
Route::post('employer/dashboard/interview-interview-upchange', 'Job_Employer_Controller@updateedit');

//Candidate->Experience
Route::get('employer/team_member_edit_experience/{id}', 'Search_Resume_Controller@edit_experience');
Route::post('employer/team_member_edit_experience/add', 'Search_Resume_Controller@add_insert');
Route::get('employer/team_member_edit_experience_del/{id}/{seekerid}', 'Search_Resume_Controller@delete_entry');
Route::get('employer/team_member_edit_experience_update/{id}/{seekerid}', 'Search_Resume_Controller@show_up');
Route::post('employer/team_member_edit_experience/update', 'Search_Resume_Controller@update');


//Candidate->Skills
Route::get('employer/team_member_skills/{id}', 'Search_Resume_Controller@view_skill');
Route::post('employer/team_member_skills/in', 'Search_Resume_Controller@insert_skill');
Route::get('employer/team_member_skills_del/{id}/{seekerid}', 'Search_Resume_Controller@delete_skill');

//Candidate->Personal Details
Route::get('employer/edit_posted_candidate/{id}/', 'Search_Resume_Controller@view_personal_details');
Route::post('employer/edit_posted_candidate/update/', 'Search_Resume_Controller@update_personal_details');

//Candidate->Education
Route::get('employer/employer_edit_education/{id}/', 'Search_Resume_Controller@view_education');
Route::post('employer/employer_edit_education/add/', 'Search_Resume_Controller@insert_education');
Route::get('employer/employer_edit_education/del/{id}/{seekerid}', 'Search_Resume_Controller@delete_education');
Route::post('employer/employer_edit_education/{id}/{seekerid}', 'Search_Resume_Controller@update_education');
//data for location
Route::get('employer/post_new_job/post_job/state/{country_id}', 'LocationController@get_state');
Route::get('employer/post_new_job/post_job/city/{state_id}', 'LocationController@get_city');
Route::post('employer/search_resume/jod_details_mail', 'Search_Resume_Controller@jod_details_mail');
Route::post('employer/posted_jobs/add_notes', 'Job_Employer_Controller@add_job_note');
Route::post('employer/job/notes/', 'Job_Employer_Controller@show_job_note');
Route::post('employer/search_resume/Candidate_add_notes', 'Job_Employer_Controller@add_candidate_note');
Route::post('employer/candidate/notes/', 'Job_Employer_Controller@show_candidate_note');
Route::post('employer/posted_jobs/email_add', 'Job_Employer_Controller@add_new_job_email');

Route::get('employer/report', 'Report_Controller@repost_show');
Route::post('employer/report/daily', 'Report_Controller@search_daily');
Route::post('employer/report/weekly', 'Report_Controller@search_weekly');
Route::post('employer/report/month', 'Report_Controller@search_monthly');
Route::post('employer/report/monthly_group', 'Report_Controller@month_group');
Route::get('employer/job_matching/{seeker_id}', 'Search_Resume_Controller@job_matching');
Route::get('careers/{company_name}', 'careersController@view_job_careers');
Route::get('{company_name}/jobs', 'careersController@view');
Route::get('careers/search/{job}/{location}', 'careersController@search_job');
Route::get('jobs', 'careersController@alljobs');
Route::get('employer/candidate/{id}', 'Search_Resume_Controller@View_candidate_detail');
Route::post('employer/seeker/resume_update', 'Search_Resume_Controller@update_resume');
Route::get('employer/application_view/{id}', 'ApplicationController@view_application');
//new changes
Route::get('admin/job_post_manage', 'Jobpost_manage_Controller@view_manage_job');
Route::post('admin/job_post_manage/change_status', 'Jobpost_manage_Controller@change_status');
Route::get('admin/job_post_manage/delete{id}', 'Jobpost_manage_Controller@delete');
Route::get('admin/job_post_manage/edit{id}', 'Jobpost_manage_Controller@update_view');
Route::post('admin/job_post_manage/update', 'Jobpost_manage_Controller@update');
Route::get('admin/job_post_manage/search', 'Jobpost_manage_Controller@search');

//new item

Route::get('admin/emp_login{id}', 'EmployerCompanyController@login_index');
Route::get('admin/job_post_manage/search', 'Jobpost_manage_Controller@search');
Route::get('admin/job_seekers_manage/job_post_view', 'jobseekersmanageController@view_job');
Route::post('admin/job_seekers_manage/sts', 'jobseekersmanageController@sts_change');
Route::get('admin/job_seekers/applied_jobs/edit/{id}', 'jobseekersmanageController@edit_candeate');
Route::post('admin/job_seekers/applied_jobs/update', 'jobseekersmanageController@update');
Route::get('admin/job_seekers/applied_jobs/auto_login_seeker{id}', 'jobseekersmanageController@auto_login_seeker');
Route::get('admin/emp_edit/quick_view', 'EmployerCompanyController@quick_view_company');
Route::get('admin/emp_edit{id}', 'EmployerCompanyController@emp_edit');
Route::post('admin/emp_edit/update_employer_info/{id}', 'EmployerCompanyController@update_employer_info');
Route::post('admin/emp_edit/update_Company_info/{id}', 'EmployerCompanyController@update_Company_info');
Route::get('admin/job_post_manage/search', 'Jobpost_manage_Controller@search');
Route::get('admin/industries/delete{id}', 'IndustryController@delete_all_industries');
Route::post('admin/industries/add', 'IndustryController@add_all_industries');
Route::get('admin/job_seekers_manage/advance_search', 'jobseekersmanageController@advance_search');
Route::get('employer/notification_data/{id}', 'NotificationController@jon_noti');
Route::any('employer/manageteammember/team_members_view/send_report/{id}/{name}', 'teammemberSendController@report_show');
Route::post('teammember/send_report', 'teammemberSendController@send_report');
Route::get('team_members_view/excelexport/daily/{id}/{name}/{date}','Import_Controller@exportclientsubmittaldaily');
Route::get('team_members_view/excelexport/montly/{id}/{name}/{date}','Import_Controller@exportclientsubmittalmontly');


//new
Route::get('employer/posted_job_assined/notification_data/{id}', 'NotificationController@jon_noti');
Route::any('employer/dashboard/interview-meeting/show_candidate', 'Job_Employer_Controller@candidate_list');
Route::any('employer/dashboard/interview_schedule_email_view', 'EmailInterviewController@show_interview_email');
Route::any('employer/interview_job_details_view', 'EmailInterviewController@interview_job_details');
Route::any('employer/interview_candidate_email', 'EmailInterviewController@interview_candidate_email');
Route::any('employer/dashboard/interview_schedule_email', 'EmailInterviewController@interview_schedule_email');
Route::any('interview_confirm/{id}', 'EmailInterviewController@interview_confirm');
Route::any('interview_request/review', 'EmailInterviewController@review');
Route::any('interview_request/review_onload', 'EmailInterviewController@review_onload');
Route::any('reject_request/{id}', 'EmailInterviewController@reject_request');
Route::any('interview_request/review_reject', 'EmailInterviewController@review_reject');
Route::any('reject_reschedule/{id}', 'EmailInterviewController@re_shidule');
Route::any('interview/reshidule_new/', 'EmailInterviewController@reshidule_new');



//new added
Route::any('employer/interview_create/job_val', 'EmailInterviewController@job_val');
Route::any('employer/interview_create/candidate_val', 'EmailInterviewController@candidate_val');
Route::any('employer/interview_create/send_email', 'EmailInterviewController@send_email_last_detail');
Route::any('employer/dashboard/create_email_template', 'EmailInterviewController@create_email_template');

//profile image
Route::any('url_for_profile_image', 'CompanyProfileController@url_for_profile_image');


//for geaph
Route::any('employer/dashboard/report_graph', 'Report_Controller@report_graph');
Route::any('report/show', 'Report_Controller@graph_how');
Route::any('report/graph_month', 'Report_Controller@graph_month');
Route::any('report/graph_yearly', 'Report_Controller@graph_year');


//for sharing
Route::any('employer/job_details/share_linked_in', 'ShareController@share_linkedin');
Route::any('careers/job_detail/{id}/{org}', 'ShareController@job_detail_preview');
Route::any('employer/dashboard/team_all_report', 'Report_Controller@team_and_group_report');


//to search jobs
Route::get('employer/posted_jobs/search', 'Job_Employer_Controller@search_jobs');

//to search application
Route::get('employer/Application/search_application', 'Job_Employer_Controller@search_application');

//to search candidate
Route::get('employer/search_resume/search_candidate', 'Job_Employer_Controller@candidate_search');

//search for submit candidate to job
Route::get('employer/submit_candidate_detail/submit_candidate_job_search/new', 'Job_Employer_Controller@submit_candidate_job_search');
Route::get('export/excel','Import_Controller@export_excel');


// Update Report Section
Route::get('employer/all_report','EmployerReportController@show_report_view');
Route::post('genrate/report','EmployerReportController@genrate_report');
Route::get('employer/report/get_team_details/{type_id}','EmployerReportController@get_team_details');
Route::get('employer/report/get_team_member_details/{team_id}','EmployerReportController@get_team_member_details');
Route::get('employer/report/get_date/{status}','EmployerReportController@get_date');