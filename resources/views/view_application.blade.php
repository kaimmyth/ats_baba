@include('include.emp_header')
@include('include.emp_leftsidebar')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-border card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-primary">Application View
                            </h3>
                        </div>
                        <div class="card-body">
                            <b>Job:-</b> {{$toReturn['job_details']->job_code}},&nbsp;{{$toReturn['job_details']->job_title}} &nbsp;| &nbsp;<b>Candidate:-</b>{{$toReturn['seeker_details']->first_name}}&nbsp;{{$toReturn['seeker_details']->last_name}} &nbsp;|&nbsp;<b>Phone:-</b>{{$toReturn['list_application']->phone_no_mobile}}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Job </th>
                                        <th>Match Status </th>
                                        <th>Candidate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>Pay Rate</td>
                                        <td>{{$toReturn['job_details']->pay_min}}- {{$toReturn['job_details']->pay_max}}</td>
                                        <td>@if($toReturn['matchpayrate']>=70)<span style="background-color:green;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>@elseif(($toReturn['matchpayrate']<=70)&&($toReturn['matchpayrate']>=50))<span style="background-color:yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @else <span style="background-color:red;color:white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @endif</td>
                                        <td>{{$toReturn['list_application']->expected_salary}}</td>
                                    </tr>
                                    <tr>
                                        <td>Visa Status</td>
                                        <td>{{$toReturn['job_details']->job_visa_status}}</td>
                                        <td>@if($toReturn['visa_match_percentage']>=70)<span style="background-color:green;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>@elseif(($toReturn['visa_match_percentage']<=70)&&($toReturn['visa_match_percentage']>=50))<span style="background-color:yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @else <span style="background-color:red;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @endif</td>
                                        <td>{{$toReturn['seeker_details']->visa_status}}</td>
                                    </tr>
                                    <tr>
                                        <td>Skills</td>
                                        <td>{{$toReturn['job_details']->required_skills}}</td>
                                        <td>@if($toReturn['matchpayrate']>=70)<span style="background-color:green;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>@elseif(($toReturn['skill_match_percentage']<=70)&&($toReturn['skill_match_percentage']>=50))<span style="background-color:yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @else <span style="background-color:red;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @endif</td>
                                        <td>{{$toReturn['seeker_details']->skills}}</td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td>{{$toReturn['jobcity']}},&nbsp;{{$toReturn['jobstate']}},&nbsp; {{$toReturn['job_details']->country}}</td>
                                        <td>@if($toReturn['matchLocation']>=70)<span style="background-color:green;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>@elseif(($toReturn['matchLocation']<=70)&&($toReturn['matchLocation']>=50))<span style="background-color:yellow;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @else <span style="background-color:red;color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> @endif</td>
                                        <td>{{$toReturn['seeker_details']->city}},&nbsp;{{$toReturn['seeker_details']->state}},&nbsp;{{$toReturn['seeker_details']->country}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($toReturn['application_candidate_exp_required']!="")
                    @if(count($toReturn['application_candidate_exp_required'])!=0)
                    <div class="card card-border card-primary">
                        <div class="card-body">
                            Candidate Exp Required:-
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Skills</th>
                                        <th>Years of
                                            Experience/Exposure </th>
                                        <th>Expertise Level (0 - 10)
                                            [1=Novice; 10=Expert]</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($toReturn['application_candidate_exp_required'] as $key_exp=>$value_exp)
                                    <tr>
                                        <td>{{$value_exp['skills']?? ""}}</td>
                                        <td>{{$value_exp['yrs_of_exp']?? ""}}</td>
                                        <td>{{$value_exp['expertise_level']?? ""}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                        @endif
                        @endif
                        @if($toReturn['application_candidate_reference']!="")
                        @if(count($toReturn['application_candidate_reference'])!=0)
                        <div class="card card-border card-primary">
                            <div class="card-body">
                                Candidate Reference:-
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Official Email Id</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($toReturn['application_candidate_reference'] as $key_ref=>$value_ref)
                                        <tr>
                                            <td>{{$value_ref['fullname'] ?? ""}}</td>
                                            <td>{{$value_ref['officialEmail']?? ""}}</td>
                                            <td>{{$value_ref['designation']?? ""}}</td>
                                            <td>{{$value_ref['clientName']?? ""}}</td>
                                            <td>{{$value_ref['location']?? ""}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            @endif
                            @endif
                    @if($toReturn['application_emp_details']!="")
                    <div class="card card-border card-primary">
                        <div class="card-body">
                            Employer Details:-
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Email Id </th>
                                        <th>Employer Name </th>
                                        <th>Phone Number</th>
                                        <th>Phone Number Ext</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$toReturn['application_emp_details']->company_name ?? ""}}</td>
                                        <td>{{$toReturn['application_emp_details']->email_Id ?? ""}}</td>
                                        <td>{{$toReturn['application_emp_details']->employer_name ?? ""}}</td>
                                        <td>{{$toReturn['application_emp_details']->phone_number ?? ""}}</td>
                                        <td>{{$toReturn['application_emp_details']->ext_no ?? " "}}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                        @endif
                </div>
                <!--end of col-->
            </div>
        </div>
    </div>
    @include('include.emp_footer')