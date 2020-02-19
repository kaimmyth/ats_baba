@include('include.emp_header') @include('include.emp_leftsidebar')
<style>
    input[type=text],
    input[type=email],
    textarea
        {
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        outline: none;
        margin: 5px 1px 3px 0px;
        border: 1px solid #DDDDDD;
    }

    input[type=text]:focus,
    
    input[type=email]:focus textarea:focus {
        -moz-box-shadow: 0 0 5px #51cbee;
        -webkit-box-shadow: 0 0 5px #51cbee;
        box-shadow: 0 0 5px #51cbee;
        border: 1px solid #51cbee;
    }

    label {
        width: 100%;
        float: left;
    }

    label {
        font-weight: 200;
        font-family: inherit;
        font-size: 15px;
    }

    input[type=text],
    input[type=email],
    input[type=date],
    select {
        width: 100%;
        padding: 7px;
        border-radius: 5px;
    }

    textarea {
        border-radius: 5px;
        width: 48%;
    }

    span.red {
        color: red;
    }

    input[class="form-control"] {
        border: 1px solid #bdbcbc;
        width: 84%;
        background: #fff;
    }

    select[class="form-control"] {
        border: 1px solid #bdbcbc;
        width: 84%;
        background: #fff;
    }

    textarea[class="form-control"] {
        border: 1px solid #bdbcbc;
        background: #fff;
        width: 84%;
    }

    #wrapper {
        width: 100%;
        overflow-y: scroll;
    }

    #dels {
        display: flex;
        margin-top: 2%;
        margin-left: 2%;
    }

    .card .card-header {
        padding: 2px 20px;
        border: none;
    }

    .table td {
        padding: 7px;
        font-size: top;
        border-top: 1px solid #dee2e6;
        font-size: 14px;
        color: #000;
        background: #fff;
    }

    .table tr {
        padding: 7px;
        font-size: top;
        border-top: 1px solid #dee2e6;
        font-size: 14px;
        color: #000;
        background: #fff;
    }

    .table th {
        padding: 7px;
        font-size: top;
        border-top: 1px solid #dee2e6;
        font-size: 14px;
        color: #000;
        background: #e4e4e4;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 0.5px solid #000;
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 1px;
    }
</style>
<div id="wrapper">
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <form class="cmxform form-horizontal tasi-form" id="signupForm" action="{{url('employer/forward_candidate')}}" method="post" enctype="multipart/form-data">
                    @csrf()
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="  background-color:#317eeb;">
                                    <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large">Candidate Link Forward</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form">
                                        <div class="form-group row">
                                            <label for="email" class="control-label col-lg-4">From<span class="red">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="email" style="width: 75%;" class="form-control" placeholder="Email Id" id="" name="email_from" disabled value="{{$toReturn['form_email_id']}}" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="control-label col-lg-4">Email To<span class="red">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="hidden" name="job_id" value="{{$toReturn['application_detail']['job_ID']}}">
                                                <input type="hidden" name="seeker_id" value="{{$toReturn['application_detail']['seeker_ID']}}">
                                                <input type="text" style="width: 75%;" class="form-control" placeholder=" Send Email To " id="email_to" name="email_to">
                                                <span id="email_to_error">Please enter valid email ID</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="CC" class="control-label col-lg-4">CC</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" style="width: 75%;" placeholder="CC " id="email_cc" name="email_cc">
                                                <span id="email_cc_error">Please enter valid email ID</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Bcc" class="control-label col-lg-4">Bcc</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" style="width: 75%;" placeholder=" BCC" id="email_bcc" name="email_bcc">
                                                <span id="email_bcc_error">Please enter valid email ID</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="Subject" class="control-label col-lg-4">Subject<span class="red">*</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" style="width: 75%;" placeholder="Subject" id="subject" name="email_subject" required>
                                                <span id="subject_error">Please enter valid subject</span>
                                            </div>
                                        </div>
                                        <input type="hidden" placeholder="Updated Resume" name="updated_resume" value="{{$toReturn['application_detail']['updated_resume']}}" />
                                        <div class="form-group row">
                                            <label for="Subject" class="control-label col-lg-4">Email Content<span class="red">*</label>
                                            <div class="col-lg-6">
                                                <textarea class="wysihtml5 form-control article-ckeditor" placeholder="Message body" style="height: 200px" name="email_content" required></textarea>
                                            </div>
                                        </div>
                                        <div class="card-header bg-primary">
                                        </div>
                                        <div class="card-header bg-primary">
                                        </div>
                                        <div class="container-fluid card-body" style="background:#f3f2f2;">
                                            <div class="row">
                                                <!-- <div class="col-md-1"></div> -->
                                                <!-- col-sm-6 col-md-4     col-md-3 col-sm-4 -->
                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="fullname" checked>
                                                    <label class="form-label">Full Name<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" value="{{$toReturn['application_detail']['candate_name']}}" required>
                                                    <span id="fullname_error">Please enter valid name</span>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="phone_primary" checked>
                                                    <label class="form-label">Phone(Primary)<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="phone_primart" placeholder="Phone(Primary)" name="phone_primary" value="{{$toReturn['application_detail']['phone_no_mobile']}}" maxlength="12" required>
                                                    <span id="phone_primart_error">Please enter valid Phone</span>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="condidate_email_id" checked>
                                                    <label class="form-label">Email ID<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="condidate_email_id" placeholder="Email ID" name="condidate_email_id" value="{{$toReturn['application_detail']['email_id']}}" required>
                                                    <span id="condidate_email_id_error">Please enter valid email ID</span>
                                                </div><!-- end of col -->


                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="skypeid" checked>
                                                    <label class="form-label">Skype ID</label>
                                                    <input type="text" class="form-control" id="skypeid" onblur="rate()" placeholder="Skype ID" name="skypeid" value="{{$toReturn['candiate_record']->skype_id}}">
                                                </div><!-- end of col -->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="current_location" checked>
                                                    <label class="form-label">Current Location(City,State)<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="current_location" placeholder="Current Location(City,State)" name="current_location" value="{{$toReturn['application_detail']['current_location']}}" required>
                                                    <span id="current_location_error">Should not be blank</span>
                                                </div>
                                                <!--end of col-->
                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="us_visa_status" checked>
                                                    <label class="form-label">US Visa Status<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="us_visa_status" placeholder=" US Visa Status " name="us_visa_status" value="{{$toReturn['application_detail']['visa_status']}}" required>
                                                    <span id="us_visa_status_error">Please enter valid visa status</span>
                                                </div>
                                                <!--end of col-->


                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="visaexpiry" checked>
                                                    <label class="form-label">US Visa Expiry</label>
                                                    <input type="date" class="form-control" id="visaexpiry" placeholder="US Visa Expiry" name="visaexpiry">
                                                    <span id="visaexpiry_error">Please enter valid expiry date</span>
                                                </div><!-- end of col -->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels" style="background-color:;">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="last_for_digit_ssn">
                                                    <label class="form-label">SSN No.(Last Four Digits)<span class="red"></span></label>
                                                    <input type="text" class="form-control" maxlength="4" placeholder="SSN No.(Last Four Digits)"   name="last_for_digit_ssn" title>
                                                    <span id="last_for_digit_ssn_error">Please enter SSN No. (last four digit only)</span>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="passportno" checked>
                                                    <label class="form-label">Passport No</label>
                                                    <input type="text" class="form-control" id="passportno" placeholder="Passport No" name="passportno">
                                                    <span id="passportno_error">Please enter valid passport no</span>
                                                </div><!-- end of col -->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="dob">
                                                    <label class="form-label">D O B<span class="red"></span></label>
                                                    <input type="date" class="form-control" id="dob" placeholder="Date Of Birth" name="dob"   />
                                                    <span id="dob_error">Please enter valid DOB</span>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" checked value="qual_with_uni" checked>
                                                    <label class="form-label">Qualification With University Name and Passing Year(Bachelors)<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="qual_with_uni" placeholder="Qualification With University Name and Passing Year" name="qual_with_uni"  required />
                                                    <span id="qual_with_uni_error">Should not be blank</span>
                                                </div>
                                                <!--end of col-->

                                                  <!-- <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" checked value="qual_with_uni" checked>
                                                    <label class="form-label">Passing Year<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="completion_year" placeholder="Completion year" name="passing_year"  required />
                                                    <span id="completion_year_error">Should not be blank</span>
                                                </div> -->
                                                <!--end of col-->   


                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="Open_For_Relocation" checked>
                                                    <label class="form-label">Open For Relocation(Yes/No)<span class="red">*</span></label>
                                                    <!--<input type="text" placeholder="Open For Relocation(Y/N)" name="Open_For_Relocation" required/>-->
                                                    <select placeholder="Open For Relocation(Yes/No)" id="open_for_relocation" name="Open_For_Relocation">
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="availa_for_tele" checked>
                                                    <label class="form-label">Availability For Telephone Interview(Yes/No)<span class="red">*</span></label>
                                                    <!--<input type="text"  placeholder="Availability For Telephone Interview(Y/N)" name="availa_for_tele"  required/>     -->
                                                    <select placeholder="Availability For Telephone Interview(Yes/No)" id="availa_for_tele" name="availa_for_tele">
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="availa_for_per" checked>
                                                    <label class="form-label">Availability For In-Person Interview(Yes/No)<span class="red">*</span></label>
                                                    <!--<input type="text"  placeholder="Availability For In-Person Interview(Y/N)" name="availa_for_per"  required />-->
                                                    <select placeholder="Availability For In-Person Interview(Yes/No)" id="availa_for_per" name="availa_for_per">
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="availa_for_new" checked>
                                                    <label class="form-label">Availability For New Project(Yes/No)<span class="red">*</span></label>
                                                    <!--<input type="text"  placeholder="Availability For New Project(Y/N)" name="availa_for_new" required />-->
                                                    <select placeholder="Availability For New Project(Yes/No)" id="availa_for_new" name="availa_for_new">
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </div>
                                                <!--end of col-->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="linkedinid" checked>
                                                    <label class="form-label">Linkedin ID</label>
                                                    <input type="text" class="form-control" id="linkedinid" onblur="rate()" placeholder="Linkedin Id" name="linkedinid">
                                                </div><!-- end of col -->

                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="expectedrate" checked>
                                                    <label class="form-label">Expected Rate<span class="red">*</span></label>
                                                    <input type="text" class="form-control" id="expectedrate" onblur="rate()" placeholder="Expected Rate" name="expectedrate" required>
                                                    <span id="expectedrate_error">Please enter valid rate</span>
                                                </div><!-- end of col -->
                                                <div class="col-sm-12 col-md-6 col-lg-4" id="dels">
                                                    <input class="form-check-input chkbx" type="checkbox" name="param[]" value="expectedrate" checked>
                                                    <label class="form-label">Job type<span class="red">*</span></label>
                                                    <select name="job_type" id="expectedrate1" name="job_type" onchange="jobtype()" required>
                                                        <option value="">Select job type</option>
                                                        <option value="Fulltime">Fulltime</option>
                                                        <option value="Contract">Contract</option>
                                                    </select>
                                                    <select name="job_rate_type_fulltime" id="fulltime_payrate" style="display:block">
                                                        <option value="">Select job type</option>
                                                        <option value="annum">annum</option>
                                                        <!--<option value ="per annum"></option>-->
                                                    </select>
                                                    <select name="job_rate_type" id="contract_payrate" style="display:none">
                                                        <option value="">Select job type</option>
                                                        <option value="W2">W2</option>
                                                        <option value="1099">1099</option>
                                                        <option value="C2C">C2C</option>

                                                    </select>
                                                    <span id="expectedrate_error1">Please enter valid rate</span>
                                                </div><!-- end of col -->

                                                <!-- <div class="col-sm-12 col-md-6 col-lg-4" id="dels" >
                                                <input class="form-check-input chkbx" type="checkbox"  name="param[]" value="expectedrate" checked> 
                                                <label class="form-label">Job type<span class="red">*</span></label>
                                                <select name="job_type" id="expectedrate1" required>
                                                    <option value="">Select job type</option>
                                                    <option value="fulltime">Fulltime</option>
                                                    <option value="contact">Contract</option>
                                                </select>
                                                <span id="expectedrate_error1">Please enter valid rate</span> -->
                                                <!-- </div>end of col -->

                                                <div class="col-sm-1" id="dels" >

                                                    <p id="wrong2" style="color:red;"></p>

                                                </div>
                                                <!--end of col-->


                                                <div class="col-sm-1" id="dels" >

                                                    <p id="wrong" style="color:red;"></p>

                                                </div>
                                                <!--end of col-->




                                                <div class="col-sm-1" id="dels" >

                                                    <p id="chk" style="color:red;"></p>

                                                </div>
                                                <!--end of col-->




                                                <div class="col-sm-1" id="dels">

                                                    <p id="exprate" style="color:red; "></p>

                                                </div>
                                                <!--end of col-->

                                                <!--                                        </div> end of row  -->
                                            </div>
                                        </div>
                                        <hr>
                                        <div align="center">
                                            <input type="checkbox" onclick="javascript:showTable('exp_required','exp_table');" id="exp_required" name="exp_required" value="exp_required"> &nbsp;&nbsp;&nbsp; Experience Required ?

                                            <table class="table" style="display:none;" id="exp_table" cellspacing="0" style="border: 1Px solid;width: 40%!important;">
                                                <thead style="    background: #317eeb;">
                                                    <tr>
                                                        <th colspan="5">Experiences</th>
                                                    </tr>
                                                    <tr>
                                                        <th style="border: 1Px solid;">Skills</th>
                                                        <th style="border: 1Px solid;">Years of<br>Experience/Exposure</th>
                                                        <th style="border: 1Px solid;">Expertise Level (0 - 10)<br />[1=Novice; 10=Expert]</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[0][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[1][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[2][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[3][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[4][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[5][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[6][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[7][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[7][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[7][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[8][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[8][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[8][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[9][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[9][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[9][]" class="form-control" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div align="center">
                                            <input type="checkbox" onclick="javascript:showTable('ref_required','ref_table');" id="ref_required" name="ref_required" value="ref_required"> &nbsp;&nbsp;&nbsp; Reference Required ?

                                            <table class="table" style="display:none;" id="ref_table" cellspacing="0" style="border: 1Px solid;width: 40%;!important">
                                                <thead>
                                                    <tr style="background: #317eeb;">
                                                        <th colspan="5">References</th>
                                                    </tr>
                                                    <tr style="background: #317eeb;">
                                                        <th style="border: 1Px solid;">Full Name</th>
                                                        <th style="border: 1Px solid;">Official Email Id</th>
                                                        <th style="border: 1Px solid;">Designation</th>
                                                        <th style="border: 1Px solid;">Client Name</th>
                                                        <th style="border: 1Px solid;">Location</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="reference[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div align="center">
                                            <input type="checkbox" onclick="javascript:showTable('Employer_table','emp_table');" id="Employer_table" name="Employer_required" value="Employer_required"> &nbsp;&nbsp;&nbsp;Employer Details ?
                                            <table class="table" style="display:none;" id="emp_table" cellspacing="0" style="border: 1Px solid;width: 40%;!important">
                                                <thead>
                                                    <tr style="background: #317eeb;">
                                                        <th colspan="5">Employer Details</th>
                                                    </tr>
                                                    <tr style="background: #317eeb;">
                                                        <th style="border: 1Px solid;">Company Name</th>
                                                        <th style="border: 1Px solid;"> Email Id</th>
                                                        <th style="border: 1Px solid;">Employer Name</th>
                                                        <th style="border: 1Px solid;">Phone Number</th>
                                                        <th style="border: 1Px solid;">Phone Number Ext</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="Companyemp_detail"  class="form-control" placeholder="Company name" /></td>
                                                        <td><input type="email" name="Emailemp_detail"  class="form-control" placeholder="Eamil ID"  /></td>
                                                        <td><input type="text" name="Employeremp_detail"  class="form-control" placeholder="Empolyer Name"  /></td>
                                                        <td><input type="text" name="Phoneemp_detail" id="Phoneemp_detail" onkeyup="chekphone_no();" maxlength="12" class="form-control" placeholder="Phone Number"  ></td>
                                                        <td><input type="text" name="extenson" id="extenson" maxlength="12" class="form-control" placeholder="Extention"  ></td>
                                                    </tr>
                                                    <p id="phone_mess" style="color:red;display:none;"> Please Enter Only Number</p>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div align="center">
                                            <input type="checkbox" onclick="javascript:showTable('attachment_required','attach_table');" name="attachment_required" id="attachment_required" value="attachment_required"> &nbsp;&nbsp;&nbsp; Attachment Required ?
                                            <table class="table" style="display:none;" id="attach_table" cellspacing="0" style="border: 1Px solid;width: 40%;!important">
                                                <thead>
                                                    <tr style="background: #317eeb;">
                                                        <th colspan="5">Attachments</th>
                                                    </tr>
                                                    <tr style="background: #317eeb;">
                                                        <th style="border: 1Px solid;">Resume</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="background: aliceblue;" id="update_resume">
                                                    @if(!empty($toReturn['application_detail']['updated_resume']))
                                                        <td><input type="checkbox" name="seeker_doc[]" id="other_doc0" value="{{$toReturn['application_detail']['updated_resume']}}">
                                                            <!-- <input type="hidden" name="update_Resume_name" value="update_Resume"> -->
                                                            <input type="hidden" class="form-control" name="update_Resume_file" value="{{$toReturn['application_detail']['updated_resume']}}"><a href="{{url('public/seekerresume/'.$toReturn['application_detail']['updated_resume'])}}">{{$toReturn['application_detail']['updated_resume']}}</a>
                                                            @endif
                                                        <!-- <td><input type="button" name="delete_doc" id="delete_doc" class="delete_doc"  value="Delete"> -->
                                                    </tr>
                                                    <tr style="background: aliceblue;" id="update_resume">
                                                        @if(!empty($toReturn['candiate_record']['otherdocuments1']))
                                                        <td><input type="checkbox" name="seeker_doc[]" id="other_doc0" value="{{$toReturn['candiate_record']['otherdocuments1']}}">
                                                            <!-- <input type="hidden" name="otherdocuments1_name" value="otherdocuments1"> -->
                                                            <input type="hidden" class="form-control" name="otherdocuments1" value="{{$toReturn['candiate_record']['otherdocuments1']}}"><a href="{{url('public/seekerresume/'.$toReturn['candiate_record']['otherdocuments1'])}}">{{$toReturn['candiate_record']['otherdocuments1']}}</a>
                                                            @endif
                                                        <!-- <td><input type="button" name="delete_doc" id="delete_doc" class="delete_doc"  value="Delete"> -->
                                                    </tr>
                                                    <tr style="background: aliceblue;" id="update_resume">
                                                        @if(!empty($toReturn['candiate_record']['otherdocuments2']))
                                                        <td><input type="checkbox" name="seeker_doc[]" id="other_doc0" value="{{$toReturn['candiate_record']['otherdocuments2']}}">
                                                            <input type="hidden" name="otherdocuments2_name" value="otherdocuments2">
                                                            <input type="hidden" class="form-control" name="otherdocuments2" value="{{$toReturn['candiate_record']['otherdocuments2']}}"><a href="{{url('public/seekerresume/'.$toReturn['candiate_record']['otherdocuments2'])}}">{{$toReturn['candiate_record']['otherdocuments2']}}</a>
                                                            @endif
                                                        <!-- <td><input type="button" name="delete_doc" class="delete_doc" id="delete_doc" value="Delete"> -->
                                                    </tr>
                                                    @foreach($toReturn['candiate_extra_doc'] as $key=>$value)
                                                        <tr style="background: aliceblue;" id="update_resume">
                                                        @if($value['file_name'])
                                                        <td><input type="checkbox" name="extra_seeker_doc[]" id="other_doc0" value="{{$value['file_name']}}">
                                                            <input type="hidden" class="form-control" name="{{$value['file_name']}}" value="{{$value['file_name']}}"><a href="{{url('public/forward_document/'.$value['file_name'])}}">{{$value['file_name']}}</a>
                                                        @endif
                                                        </tr>
                                                    @endforeach                                                    
                                                    <tr id="exp_detail">
                                                        <td class="form-group row delete_exp">
                                                            <input type="text" name="document_name[]" id="job_title" placeholder="Document Name" style="width: 40%;">
                                                            <input type="file" class="form-control" name="document_upload[]" id="document_upload" class="form-control" style="width: 40%;">
                                                            <p><button type="button" id="btnAdd_Exp" class="btn btn-primary">Add More&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></button></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <center><button type="submit" class="btn btn-info" id="send_btn">Send</button></center>
                                    </div> <!-- .form -->
                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col -->
                    </div> <!-- End row -->
            </div>
        </div>
        </form>
    </div>
</div>
@include('include.emp_footer')
<script>
    function chekphone_no() {
        var phone_no = $('#Phoneemp_detail').val();
        if (!phone_no.match(/^\d+/)) {
            // alert("Please only enter numeric characters only for your Age! (Allowed input:0-9)")
            $('#phone_mess').css('display', 'block');
        } else {
            $('#phone_mess').hide();
        }
    }
    $("#phone_primary").hide();

    function phoneMask() {
        var num = $(this).val().replace(/\D/g, '');
        if ($(this).val(num.substring(0, 3) + '-' + num.substring(3, 6) + '-' + num.substring(6, 10))) {

        } else {
            $("#phone_primary").show();
        }
    }
    $('#phone_primart').keyup(phoneMask);
</script>
<script type="text/javascript">
    function showTable(checkbox, tableId) {
        if ($('#' + checkbox).is(":checked"))
            $("#" + tableId).show();
        else
            $("#" + tableId).hide();
    }
</script>

<script type="text/javascript">
    function showTable(checkbox, tableId) {
        if ($('#' + checkbox).is(":checked"))
            $("#" + tableId).show();
        else
            $("#" + tableId).hide();
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

        var $regexname = /^([0-9])$/;
        $('#last_for_digit_ssn').on('keypress keydown keyup', function() {
            if (!$(this).val().match($regexname)) {
                // there is a mismatch, hence show the error message
                //  $('.emsg').removeClass('hidden');
                $('#emsg').show();
            } else {
                // else, do not display message
                $('#emsg').addClass('hidden');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#btnAdd_Exp').click(function() {
            i++;
            var data2 = `<div class="form-group row delete_exp">													
            <input type="text" name="document_name[]" id="job_title" placeholder="Document Name" style="width: 40%;">
                            <input type="file" name="document_upload[]" id="document_upload" style="width: 40%;">
							<button type="button" id="btnRemove" class="btn btn-primary btn_remove">Remove</button>											  
						 </div>`;
            $('#exp_detail').append(data2);
        });
    });
    $(document).on('click', '.btn_remove', function() {
        $(this).closest('.delete_exp').remove();
    });
</script>
<script>
    $(".delete_doc").click(function(e) {
        $("#update_resume").css("display", "none");
    });
</script>
<script>
    $(document).ready(function() {
        $("#email_to_error").hide();
        $("#email_cc_error").hide();
        $("#email_bcc_error").hide();
        $("#subject_error").hide();
        $("#fullname_error").hide();
        $("#phone_primart_error").hide();
        $("#condidate_email_id_error").hide();
        $("#current_location_error").hide();
        $("#us_visa_status_error").hide();
        $("#visaexpiry_error").hide();
        $("#last_for_digit_ssn_error").hide();
        $("#dob_error").hide();
        $("#qual_with_uni_error").hide();
        $("#expectedrate_error").hide();
        $("#expectedrate_error1").hide();
        $("#passportno_error").hide();
        var err_email_to = true;
        var err_email_cc = true;
        var err_email_bcc = true;
        var err_subject = true;
        var err_fullname = true;
        var err_phone_primart = true;
        var err_condidate_email_id = true;
        var err_skypeid = true;
        var err_current_location = true;
        var err_us_visa_status = true;
        var err_visaexpiry = true;
        var err_last_for_digit_ssn = true;
        var err_passportno = true;
        var err_dob = true;
        var err_qual_with_uni = true;
        var err_open_for_relocation = true;
        var err_availa_for_tele = true;
        var err_availa_for_per = true;
        var err_availa_for_new = true;
        var err_linkedinid = true;
        var err_expectedrate = true;
        var err_expectedrate1 = true;
        //validate email to
        $("#email_to").keyup(function() {
            var var_tmp = $("#email_to").val();
            $("#email_to").val(var_tmp.replace(/ /g, ""));
        });
        $("#email_to").blur(function() {
            check_email_to();
        });

        function check_email_to() {
            var email_to_val = $("#email_to").val();
            email_to_val = email_to_val.replace(/,(\s+)?$/, ''); // removing last comma
            $("#email_to").val(email_to_val); // removing last comma in input

            var email_to_val_arr = email_to_val.split(','); // array

            if (email_to_val) {
                for (i = 0; i < email_to_val_arr.length; i++) {
                    var v = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                    var result = email_to_val_arr[i].match(v);
                    if ((email_to_val_arr[i] == "") || (result == null)) {
                        $("#email_to_error").show();
                        $("#email_to_error").focus();
                        $("#email_to_error").css("color", "red");
                        err_email_to = false;
                        return false;

                    } else {
                        err_email_to = true;
                        $("#email_to_error").hide();
                    }
                }
            } else {
                $("#email_to_error").show();
                $("#email_to_error").focus();
                $("#email_to_error").css("color", "red");
                err_email_to = false;
                return false;
            }
        }
        //validate email cc
        $("#email_cc").keyup(function() {
            var var_tmp = $("#email_cc").val();
            $("#email_cc").val(var_tmp.replace(/ /g, ""));
        });
        $("#email_cc").blur(function() {
            check_email_cc();
        });

        function check_email_cc() {
            var email_cc_val = $("#email_cc").val();
            email_cc_val = email_cc_val.replace(/,(\s+)?$/, ''); // removing last comma
            $("#email_cc").val(email_cc_val); // removing last comma in input

            var email_cc_val_arr = email_cc_val.split(','); // array

            if (email_cc_val) {
                for (i = 0; i < email_cc_val_arr.length; i++) {
                    var v = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                    var result = email_cc_val_arr[i].match(v);
                    if ((email_cc_val_arr[i] == "") || (result == null)) {
                        $("#email_cc_error").show();
                        $("#email_cc_error").focus();
                        $("#email_cc_error").css("color", "red");
                        err_email_cc = false;
                        return false;

                    } else {
                        err_email_cc = true;
                        $("#email_cc_error").hide();
                    }
                }
            } else {
                err_email_cc = true;
                $("#email_cc_error").hide();
            }
        }
        //validate email bcc
        $("#email_bcc").keyup(function() {
            var var_tmp = $("#email_bcc").val();
            $("#email_bcc").val(var_tmp.replace(/ /g, ""));
        });
        $("#email_bcc").blur(function() {
            check_email_bcc();
        });

        function check_email_bcc() {
            var email_bcc_val = $("#email_bcc").val();
            email_bcc_val = email_bcc_val.replace(/,(\s+)?$/, ''); // removing last comma
            $("#email_bcc").val(email_bcc_val); // removing last comma in input

            var email_bcc_val_arr = email_bcc_val.split(','); // array

            if (email_bcc_val) {
                for (i = 0; i < email_bcc_val_arr.length; i++) {
                    var v = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                    var result = email_bcc_val_arr[i].match(v);
                    if ((email_bcc_val_arr[i] == "") || (result == null)) {
                        $("#email_bcc_error").show();
                        $("#email_bcc_error").focus();
                        $("#email_bcc_error").css("color", "red");
                        err_email_bcc = false;
                        return false;
                    } else {
                        err_email_bcc = true;
                        $("#email_bcc_error").hide();
                    }
                }
            } else {
                err_email_bcc = true;
                $("#email_bcc_error").hide();
            }
        }
        //validate subject
        $("#subject").blur(function() {
            check_subject();
        });

        function check_subject() {
            var subject_val = $("#subject").val();
            if (!subject_val) {
                $("#subject_error").show();
                $("#subject_error").focus();
                $("#subject_error").css("color", "red");
                err_subject = false;
                return false;
            } else {
                err_subject = true;
                $("#subject_error").hide();
            }


        }
        //validate full name
        $("#fullname").blur(function() {
            check_fullname();
        });

        function check_fullname() {
            var fullname_val = $("#fullname").val();

            var regexOnlyText = /^[a-zA-Z ]+$/;
            if (fullname_val == "" || regexOnlyText.test(fullname_val) != true) {
                $("#fullname_error").show();
                $("#fullname_error").focus();
                $("#fullname_error").css("color", "red");
                err_fullname = false;
                return false;
            } else {
                err_fullname = true;
                $("#fullname_error").hide();
            }

        }
        // validate phone_primart
        $("#phone_primart").blur(function() {
            check_phone_primart();
        });

        function check_phone_primart() {
            var var_mobile_number = $("#phone_primart").val();

            var regexOnlyNumbers = /^[0-9-]+$/;
            if (var_mobile_number.length != 12 || regexOnlyNumbers.test(var_mobile_number) != true) {
                $("#phone_primart_error").show();
                $("#phone_primart_error").focus();
                $("#phone_primart_error").css("color", "red");
                err_phone_primart = false;
                return false;
            } else {
                err_phone_primart = true;
                $("#phone_primart_error").hide();
            }
        }
        //validate email
        $("#condidate_email_id").blur(function() {
            check_condidate_email_id();
        });

        function check_condidate_email_id() {
            var email_val = $("#condidate_email_id").val();
            var v = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var result = email_val.match(v);
            if ((email_val.length == "") || (result == null)) {
                $("#condidate_email_id_error").show();
                $("#condidate_email_id_error").focus();
                $("#condidate_email_id_error").css("color", "red");
                err_condidate_email_id = false;
                return false;
            } else {
                err_condidate_email_id = true;
                $("#condidate_email_id_error").hide();
            }
        }
        //validate qualification with university
        $("#current_location").blur(function() {
            check_current_location();
        });

        function check_current_location() {
            var current_location_val = $("#current_location").val();
            if (current_location_val == "") {
                $("#current_location_error").show();
                $("#current_location_error").focus();
                $("#current_location_error").css("color", "red");
                err_current_location = false;
                return false;
            } else {
                err_current_location = true;
                $("#current_location_error").hide();
            }

        }
        // us visa status
        $("#us_visa_status").blur(function() {
            check_us_visa_status();
        });

        function check_us_visa_status() {
            var us_visa_status_val = $("#us_visa_status").val();

            var regexOnlyTextNumbers = /^[a-zA-Z0-9- ]+$/;
            if (us_visa_status_val == "" || regexOnlyTextNumbers.test(us_visa_status_val) != true) {
                $("#us_visa_status_error").show();
                $("#us_visa_status_error").focus();
                $("#us_visa_status_error").css("color", "red");
                err_us_visa_status = false;
                return false;
            } else {
                err_us_visa_status = true;
                $("#us_visa_status_error").hide();
            }

        }
        // validate visa expiry
        $("#visaexpiry").blur(function() {
            check_visaexpiry();
        });

        function check_visaexpiry() {
            var visaexpiry_val = $("#visaexpiry").val();
            if (visaexpiry_val) {
                var visaexpiry_var = new Date(visaexpiry_val);
                var visaexpiry_val_day = visaexpiry_var.getDate();
                var visaexpiry_val_month = visaexpiry_var.getMonth() + 1;
                var visaexpiry_val_year = visaexpiry_var.getFullYear();

                if (!visaexpiry_val_day || !visaexpiry_val_month || !visaexpiry_val_year) {
                    $("#visaexpiry_error").show();
                    $("#visaexpiry_error").focus();
                    $("#visaexpiry_error").css("color", "red");
                    err_visaexpiry = false;
                    return false;
                } else if (visaexpiry_val_day > 31 || visaexpiry_val_month > 12 || visaexpiry_val_year > 2050) {
                    $("#visaexpiry_error").show();
                    $("#visaexpiry_error").focus();
                    $("#visaexpiry_error").css("color", "red");
                    err_visaexpiry = false;
                    return false;
                } else {
                    err_visaexpiry = true;
                    $("#visaexpiry_error").hide();
                }
            } else {
                err_visaexpiry = true;
                $("#visaexpiry_error").hide();
            }

        }
        // last four digit ssn
        $("#last_for_digit_ssn").keypress(function() {
            var var_tmp = $("#last_for_digit_ssn").val();
            $("#last_for_digit_ssn").val(var_tmp.replace(/[^0-9]/g, ''));
        });
        $("#last_for_digit_ssn").blur(function() {
            check_last_for_digit_ssn();
        });

        function check_last_for_digit_ssn() {
            var var_last_for_digit_ssn = $("#last_for_digit_ssn").val();

            var regexOnlyNumbers = /^[0-9-]+$/;
            if (var_last_for_digit_ssn.length != 4 || regexOnlyNumbers.test(var_last_for_digit_ssn) != true) {
                $("#last_for_digit_ssn_error").show();
                $("#last_for_digit_ssn_error").focus();
                $("#last_for_digit_ssn_error").css("color", "red");
                err_last_for_digit_ssn = false;
                return false;
            } else {
                err_last_for_digit_ssn = true;
                $("#last_for_digit_ssn_error").hide();
            }
        }
        // passport no
        $("#passportno").blur(function() {
            check_passportno();
        });

        function check_passportno() {
            var passportno_val = $("#passportno").val();

            var regexOnlyText = /^[a-zA-Z0-9-]+$/;
            if (passportno_val) {
                if (regexOnlyText.test(passportno_val) != true) {
                    $("#passportno_error").show();
                    $("#passportno_error").focus();
                    $("#passportno_error").css("color", "red");
                    err_passportno = false;
                    return false;
                } else {
                    err_passportno = true;
                    $("#passportno_error").hide();
                }
            } else {
                err_passportno = true;
                $("#passportno_error").hide();
            }

        }
        // validate dob
        $("#dob").keypress(function() {
            check_dob();
        });

        function check_dob() {
            var dob_val = $("#dob").val();

            var dob_var = new Date(dob_val);
            var dob_val_day = dob_var.getDate();
            var dob_val_month = dob_var.getMonth() + 1;
            var dob_val_year = dob_var.getFullYear();

            if (!dob_val_day || !dob_val_month || !dob_val_year) {
                $("#dob_error").show();
                $("#dob_error").focus();
                $("#dob_error").css("color", "red");
                err_dob = false;
                return false;
            } else if (dob_val_day > 31 || dob_val_month > 12 || dob_val_year > new Date().getFullYear()) {
                $("#dob_error").show();
                $("#dob_error").focus();
                $("#dob_error").css("color", "red");
                err_dob = false;
                return false;
            } else {
                err_dob = true;
                $("#dob_error").hide();
            }
        }
        //validate qualification with university
        $("#qual_with_uni").blur(function() {
            check_qual_with_uni();
        });

        function check_qual_with_uni() {
            var qual_with_uni_val = $("#qual_with_uni").val();
            if (qual_with_uni_val == "") {
                $("#qual_with_uni_error").show();
                $("#qual_with_uni_error").focus();
                $("#qual_with_uni_error").css("color", "red");
                err_qual_with_uni = false;
                return false;
            } else {
                err_qual_with_uni = true;
                $("#qual_with_uni_error").hide();
            }

        }
        //validate expected rate
        $("#expectedrate").blur(function() {
            check_expectedrate();
        });
        $("#expectedrate1").blur(function() {
            check_expectedrate1();
        });

        function check_expectedrate() {
            var var_expectedrate = $("#expectedrate").val();

            var regexOnlyNumbers = /^[0-9]+$/;
            if (regexOnlyNumbers.test(var_expectedrate) != true) {
                $("#expectedrate_error").show();
                $("#expectedrate_error").focus();
                $("#expectedrate_error").css("color", "red");
                err_expectedrate = false;
                return false;
            } else {
                err_expectedrate = true;
                $("#expectedrate_error").hide();
            }
        }

        function check_expectedrate1() {
            var var_expectedrate1 = $("#expectedrate1").val();

            // var regexOnlyNumbers = /^[0-9]+$/;
            if (var_expectedrate1 == "") {
                $("#expectedrate_error1").show();
                $("#expectedrate_error1").focus();
                $("#expectedrate_error1").css("color", "red");
                err_expectedrate1 = false;
                return false;
            } else {
                err_expectedrate1 = true;
                $("#expectedrate_error1").hide();
            }
        }

        // final submission
        $("#send_btn").click(function() {
            // when submit button clicked, validate
            check_email_to();
            check_email_cc();
            check_email_bcc();
            check_subject();
            check_fullname();
            check_phone_primart();
            check_condidate_email_id();
            check_current_location();
            check_current_location();
            check_us_visa_status();
            check_visaexpiry();
            check_expectedrate1()
            check_passportno();
            check_qual_with_uni();
            check_expectedrate();
            // check if error occured | True <=> to return true/ submit | false <=> stay on same form, error occured
            if ((err_email_to == true) && (err_email_cc == true) && (err_email_bcc == true) && (err_subject == true) && (err_fullname == true) && (err_phone_primart == true) && (err_condidate_email_id == true) && (err_current_location == true) && (err_us_visa_status == true) && (err_visaexpiry == true) && (err_last_for_digit_ssn == true) && (err_passportno == true) && (err_dob == true) && (err_qual_with_uni == true) && (err_expectedrate == true) && (err_expectedrate1 == true)) {
                return true; //ok
            } else {
                return false; //error occurred
            }
        });
    });
</script>
<script>
    function jobtype() {
        temp = document.getElementById('expectedrate1').value;
        if (temp == 'Fulltime') {
            document.getElementById("fulltime_payrate").style.display = "block";
            document.getElementById("contract_payrate").style.display = "none";
        } else {
            document.getElementById("fulltime_payrate").style.display = "none";
            document.getElementById("contract_payrate").style.display = "block";
        }
    };
</script>