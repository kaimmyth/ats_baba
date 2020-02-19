@include('include.emp_header')
@include('include.emp_leftsidebar')
<style>
    input[type=text],
    textarea,
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
    textarea:focus {
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


    input[type=text] {
        width: 82%;
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
        width: 58%;
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

    .buttons {
        width: 100%;
        height: 80px;
        background: #e0e0e0;
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
            <form class="cmxform form-horizontal tasi-form" id="signupForm" autocomplete="off" action="{{url('employer/submit_candidate')}}" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="  background-color:#317eeb;">
                                <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large;font-weight:100;">Edit Details:-{{$toReturn['personal']->first}} {{$toReturn['personal']->last_name}}</h3>
                            </div>
                            <input type="hidden" name="seeker_name" value="{{$toReturn['personal']->first}} {{$toReturn['personal']->last_name}}">
                            <input type="hidden" name="seeker_email" value="{{$toReturn['personal']->email}}">
                            <input type="hidden" name="seeker_city" value="{{$toReturn['personal']->city}}">
                            <input type="hidden" name="seeker_visa" value="{{$toReturn['personal']->visa}}">
                            <input type="hidden" name="seeker_id" value="{{$toReturn['personal']->id}}">
                            <div class="card-body">
                                <div class="form">
                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Mobile Phone <span class="red">*</span></label>
                                        <div class="col-lg-8">
                                            <input name="mobile_number" type="tel" value="{{$toReturn['personal']->mobile}}" class="form-control" id="mobile_number" maxlength="12" required style="max-width:50%; border: 1px solid #bbb8b8;" />
                                            <label style="display:none;color:red;" id="mobile_number_check">Enter Valid number</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Job Type <span style="color:red;">*</span></label>
                                        <select name="" id="type_of_job" class="form-control" onchange="fulltime()" style="width:33%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            <option value="">Select Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Contract-to-Hire">Contract-to-Hire</option>
                                            <option value="Part Time">Part Time</option>
                                        </select>
                                    </div>
                                    <!--Job Type-->

                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Salary/Pay Rate <span class="red">*</span></label>
                                        <div class="col-lg-8">
                                            <!-- <span><input name="pay_min" type="text" class="form-control" id="pay_min"  min="0" style="width: 29%; float:left;"/></span>
							                  <span><input name="pay_max" type="text" class="form-control" id="pay_max" min="0" style="width: 29%; float:left;"/></span> -->
                                            <select name="payment_range" id="select_ranage" class="form-control" style="max-width:50%; border: 1px solid #bbb8b8;" >
                                                <option value=""> select Salary/Pay Rate</option>
                                                <option value="15k-20k">15k - 20k</option>
                                                <option value="20k-25k">20k - 25k</option>
                                                <option value="25k-30k">25k - 30k</option>
                                                <option value="30k-35k">30k - 35k</option>
                                                <option value="35k-40k">35k - 40k</option>
                                                <option value="40k-45k">40k - 45k</option>
                                                <option value="45k-50k">45k - 50k</option>
                                                <option value="50k-55k">50k - 55k</option>
                                                <option value="55k-60k">55k - 60k</option>
                                                <option value="DOE">(DOE)Depends upon Experience</option>
                                            </select>
                                            <select name="payment_range" id="select_ranage_other"   class="form-control" style="max-width:50%; display:none; border: 1px solid #bbb8b8;" >
                                                <option value="$20-$25">$20 - $25</option>
                                                <option value="$25-$30">$25 - $30</option>
                                                <option value="$30-$35">$30 - $35</option>
                                                <option value="$35-$40">$35 - $40</option>
                                                <option value="$40-$45">$40 - $45</option>  
                                                <option value="$45-$50">$45 - $50</option>
                                                <option value="$50-$55">$50 - $55</option>
                                                <!--<option value="$55-$60">$55 - $60</option>-->
                                                <!--<option value="$60-$65">$60 - $65</option>-->
                                                <!--<option value="$65-$70">$65 - $70</option>-->
                                                <option value="DOE">(DOE)Depends upon Experience</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Upload Resume<span class="red">*</span></label>
                                        <div class="col-lg-8">
                                            <input type="file" class="form-control" name="updated_resume" id="updated_resume" style="width: 50%;">
                                            <p>Upload files only in .doc, .docx or .pdf format with maximum size of 6 MB.</p>
                                            <a href="{{url('public/seekerresume/'.$toReturn['personal']->cv_file)}}" target="_blank">{{$toReturn['personal']->cv_file}}</a>
                                            <input type="hidden" name="cv" id="" value="{{$toReturn['personal']->cv_file}}">
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col -->
                </div> <!-- End row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="background-color:#5097e9;">
                                <h3 class="card-title mt-3"
                                    style="color:rgb(255, 255, 255);text-transform: none; font-size:large; font-weight:100;float:left;text-transform: uppercase;">Published
                                    Jobs</h3>
                                    <button class="btn btn-light mt-2 ml-5" type="button" title="Reload Jobs" style="border-radius: 50px; padding:15px;"
                                                    id="button-addon2" onclick="location.href='{{url('employer/submit_candidate_detail/'.$toReturn['personal']->id)}};"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                                    
                                        <div class="input-group mb-3 mt-2" style="float:right;width:700px;">
                                            <input type="text" class="form-control" id="value_text"
                                                placeholder="Search Jobs ( Code , Title , Client , Type)"
                                                aria-label="Recipient's username" name="search"
                                                aria-describedby="button-addon2" >
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="button"
                                                    id="button-addon2" onclick="sheck_search()">Search</button>
                                            </div>
                                        </div>
                                <!--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="float: right;">Add a Item</button>-->
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Code</th>
                                                    <th>Title</th>
                                                    <th>Client</th>
                                                    <th>Location</th>
                                                    <th>Nos</th>
                                                    <th>Type</th>
                                                    <th>Publish Dt.</th>
                                                    <th>Closing Dt.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($toReturn['job_list'] as $job_list)
                                                <?php $dated=date("m-d-Y",strtotime($job_list['dated']));
                                                        $last_date=date("m-d-Y",strtotime($job_list['last_date']));
                                                ?>
                                                <tr>
                                                    <td><input type="radio" id="" name="job_id" value="{{$job_list['ID']}}"></td>
                                                    <td>{{$job_list['job_code']}}</td>
                                                    <td>{{$job_list['job_title']}}</td>
                                                    <td>{{$job_list['client_name']}}</td>
                                                    <td>{{$job_list['country']}}</td>
                                                    <td>{{$job_list['vacancies']}}</td>
                                                    <td>{{$job_list['job_mode']}}</td>
                                                    <td>{{$dated}}</td>
                                                    <td>{{$last_date}}</td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <hr>
                                        <div align="center">
                                            <input type="checkbox" required onclick="javascript:showTable('exp_required','exp_table');" id="exp_required" name="exp_required" value="exp_required">  &nbsp;&nbsp;&nbsp; Experience Required ?

                                            <table class="table" style="display:none;" id="exp_table" cellspacing="0" style="border: 1Px solid;width: 40%;!important">
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
                                                        <td><input type="text" name="experience[0][]" class="form-control" id="next1"/></td>
                                                        <td><input type="text" name="experience[0][]" class="form-control" id="nexta" maxlength="2"/></td>
                                                        <td><input type="text" name="experience[0][]" class="form-control" id="nextw"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[1][]" class="form-control" id="next2" /></td>
                                                        <td><input type="text" name="experience[1][]" class="form-control"  id="nextb" maxlength="2"/></td>
                                                        <td><input type="text" name="experience[1][]" class="form-control" id="nextx"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[2][]" class="form-control" id="next3"/></td>
                                                        <td><input type="text" name="experience[2][]" class="form-control" id="nextc" maxlength="2"/></td>
                                                        <td><input type="text" name="experience[2][]" class="form-control" id="nexty"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[3][]" class="form-control" id="next4"/></td>
                                                        <td><input type="text" name="experience[3][]" class="form-control" id="nextd" maxlength="2"/></td>
                                                        <td><input type="text" name="experience[3][]" class="form-control" id="nextz"  maxlength="2"/></td>
                                                    </tr>
                                                     <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[4][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[4][]" class="form-control"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[5][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[5][]" class="form-control"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[6][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[6][]" class="form-control"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[7][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[7][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[7][]" class="form-control"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="experience[8][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[8][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[8][]" class="form-control"  maxlength="2"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="experience[9][]" class="form-control" /></td>
                                                        <td><input type="text" name="experience[9][]" class="form-control"  maxlength="2"/></td>
                                                        <td><input type="text" name="experience[9][]" class="form-control"  maxlength="2"/></td>
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
                                                        <td><input type="text" name="reference[0][]" class="form-control" id="test" /></td>
                                                        <td><input type="email" name="reference[0][]" class="form-control" id="test1"/></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" id="test2"/></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" id="test3"/></td>
                                                        <td><input type="text" name="reference[0][]" class="form-control" id="test4"/></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[1][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[2][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[3][]" class="form-control" /></td>
                                                    </tr>
                                                     <tr>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[4][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[5][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="email" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                        <td><input type="text" name="reference[6][]" class="form-control" /></td>
                                                    </tr>
                                                    <tr style="background: aliceblue;">
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="email" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                        <td><input type="text" name="reference[7][]"class="form-control" /></td>
                                                    </tr> 

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                                                    <td><input type="text" name="Companyemp_detail"  class="form-control" id="first_name" placeholder="Company name" />
                                                    <p id="first_name_val"></p></td>
                                                    <td><input type="email" name="Emailemp_detail" class="form-control"  placeholder="EmailId"/></td>
                                                    <td><input type="text" name="Employeremp_detail" id="last_name"  class="form-control" placeholder="Empolyer Name"  />
                                                    <p id="last_name_val"></p></td>
                                                    <td><input type="text" name="Phoneemp_detail" id="Phoneemp_detail" onkeyup="chekphone_no();" maxlength="12" class="form-control" placeholder="Phone Number"  ></td>
                                                    <td><input type="text" name="extenson" id="extenson" maxlength="4" class="form-control" placeholder="Extention"  ></td>
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
                                                        @if(!empty($toReturn['personal']->otherdocuments1))
                                                        <td><input type="checkbox" name="seeker_doc[]" id="other_doc0" value="{{$toReturn['personal']->otherdocuments1}}">
                                                            <!-- <input type="hidden" name="otherdocuments1_name" value="otherdocuments1"> -->
                                                            <input type="hidden" class="form-control" name="otherdocuments1" value="{{$toReturn['personal']->otherdocuments1}}"><a href="{{url('public/seekerresume/'.$toReturn['personal']->otherdocuments1)}}">{{$toReturn['personal']->otherdocuments1}}</a>
                                                            @endif
                                                        <!-- <td><input type="button" name="delete_doc" id="delete_doc" class="delete_doc"  value="Delete"> -->
                                                    </tr>
                                                    <tr style="background: aliceblue;" id="update_resume">
                                                        @if(!empty($toReturn['personal']->otherdocuments2))
                                                        <td><input type="checkbox" name="seeker_doc[]" id="other_doc0" value="{{$toReturn['personal']->otherdocuments2}}">
                                                            <input type="hidden" name="otherdocuments2_name" value="otherdocuments2">
                                                            <input type="hidden" class="form-control" name="otherdocuments2" value="{{$toReturn['personal']->otherdocuments2}}"><a href="{{url('public/seekerresume/'.$toReturn['personal']->otherdocuments2)}}">{{$toReturn['personal']->otherdocuments2}}</a>
                                                            @endif
                                                        <!-- <td><input type="button" name="delete_doc" class="delete_doc" id="delete_doc" value="Delete"> -->
                                                    </tr>
                                                    @if($toReturn['candiate_extra_doc'])
                                                    @foreach(@$toReturn['candiate_extra_doc'] as $key=>$value)
                                                        <tr style="background: aliceblue;" id="update_resume">
                                                        @if($value['file_name'])
                                                        <td><input type="checkbox" name="extra_seeker_doc[]" id="other_doc0" value="{{$value['file_name']}}">
                                                            <input type="hidden" class="form-control" name="{{$value['file_name']}}" value="{{$value['file_name']}}"><a href="{{url('public/forward_document/'.$value['file_name'])}}">{{$value['file_name']}}</a>
                                                        </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                    <tr id="exp_detail">
                                                        <td class="form-group row delete_exp">
                                                            <input type="text" name="document_name[]" id="job_title" placeholder="Document Name" style="width: 40%;"><p id="document_name_val"></p>
                                                            <input type="file" class="form-control" name="document_upload[]" id="document_upload" class="form-control" style="width: 40%;">
                                                            <p><button type="button" id="btnAdd_Exp" class="btn btn-primary">Add More&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></button></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <hr>
                               
                                <div class="buttons"><br>
                                    <center><button type="button" onclick="sub_btn()" 
                                         id="submit_btn" class="btn btn-info button">Submit</button></center>
                                     <center><button type="submit" id="btn_sub" class="btn btn-info"
                                            style="display:none">Submit</button></center>     
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div> <!-- End Row -->
        </div> <!-- content -->
    </div>
    </form>
</div>
<form action="{{url('employer/submit_candidate_detail/submit_candidate_job_search/new')}}" method="get" style="display: none;">
    @csrf
    <div class="input-group mb-3 mt-2" style="float:right;width:700px;">
        <input type="text" class="form-control"
            placeholder="Search Jobs ( Code , Title , Client , Type)"
            aria-label="Recipient's username" name="search"
            aria-describedby="button-addon2" id="search_box" >
        <div class="input-group-append">
            <button class="btn btn-info" type="submit"
                id="button_append">Search</button>
        </div>
    </div>
    <input type="hidden" name="id" value="{{$toReturn['personal']->id}}"  id="">
</form>
@include('include.emp_footer')
<script>
    function  sheck_search(){
        var value_text = $.trim($('#value_text').val());
        if(value_text == ""){
            alert('the search box value must not be empty');
        }else{
        $('#search_box').val(value_text);
        $('#button_append').click();
        }
    }
</script>

<script>
    function sub_btn() {
        return validateGroup(document.getElementsByName("job_id")) && validateGroup(document.getElementsByName(
            "job_id"))
    }

    function validateGroup(elements) {
        c = 0;
        for (var i = 0; i < elements.length; i++) {
            if (elements[i].checked) {
                $('#btn_sub').click();
                c = 1;
            }
        }
        if (c == 0) {
            alert('Must select one of the published jobs');
            c = 0;
        }
    }

    $('form').bind("keypress", function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });

</script>


<script type="text/javascript">
    function fulltime() {
        //alert('hrllo');
        temp = document.getElementById('type_of_job').value;
        if (temp == 'Full Time') {
            document.getElementById("select_ranage").style.display = "block";
            document.getElementById("select_ranage_other").style.display = "none";
        } else {
            document.getElementById("select_ranage").style.display = "none";
            document.getElementById("select_ranage_other").style.display = "block";
        }
        
    }
</script>
<script>
    function phoneMask() {
        var num = $(this).val().replace(/\D/g, '');
        if ($(this).val(num.substring(0, 3) + '-' + num.substring(3, 6) + '-' + num.substring(6, 10))) {

        }
        //   else
        //   {

        // 	$("#home_ph_check").show();
        //   }
    }
    $('#mobile_number').keyup(phoneMask);
</script>

<script>
    $("#mobile_number").blur(function() {
        mon_no();
    });

    function mon_no() {
        var mobile_number = $("#mobile_number").val();
        var face_value = mobile_number.charAt(0);
        if (mobile_number == "") {
            $("#mobile_number_check").css("display", "block");
            // console.log("write");
        } else if (face_value == "-") {
            // console.log("done");
            $("#mobile_number_check").css("display", "block");
        } else if (mobile_number.length == 12) {
            $("#mobile_number_check").css("display", "none");
        } else {
            $("#mobile_number_check").css("display", "block");
        }
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

// ('.alphaonly').bind('keyup blur',function(){ 
//     var node = $(this);
//     node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
// );

// $("#test").keypress(function(event){
//         var inputValue = event.charCode;
//         //alert(inputValue);
//         if(!((inputValue > 64 && inputValue < 91) || (inputValue > 96 && inputValue < 123)||(inputValue==32) || (inputValue==0))){
//             event.preventDefault();
//         }
//     });

$('#test').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);


// $('#test1').bind('keyup blur',function(){ 
//     var node = $(this);
//     node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
// );



$('#test2').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#test3').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#test4').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

</script>

<script >

$('#next1').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#nexta').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextw').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);


$('#next2').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextb').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextx').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#next3').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextc').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#nexty').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#next4').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextd').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

$('#nextz').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);






</script>


 <!-- <script>
    $(document).ready(function() 
    {
    
     $("first_name_val").hide();
    
     err_first_name = true;
    
     $("#first_name").blur(function(){
         username1();
       });
       function username1(){
         var t = $("#first_name").val();

         if(t.length==""){
           $("#first_name_val").show();
           $("#first_name_val").html("This field is required");
           $("#first_name_val").focus();
           $("#first_name_val").css("color","red");

             err_first_name=false;
             return false;
         }else{
             err_first_name=true;
           $("#first_name_val").hide();
         }
       }

    });  

 //validation for employer name text box

$(document).ready(function()
{

  $("#last_name_val").hide();
   err_last_name=true;

           $("#last_name").blur(function(){
            username2();
        });


        function username2(){
          var R = $("#last_name").val();
         
          if(R.length==""){
            $("#last_name_val").show();
            $("#last_name_val").html("This field is required");
            $("#last_name_val").focus();
            $("#last_name_val").css("color","red");

            err_last_name=false;
                    return false;
          }
          else{
            err_last_name=true;
              $("#last_name_val").hide();
            
          }
        }

   });

// validation of Document Name text box

$(document).ready(function()
{

  $("#document_name_val").hide();
   err_document_name=true;

           $("#job_title").blur(function(){
            username3();
        });


        function username3(){
          var L= $("#job_title").val();
         
          if(L.length==""){
            $("#document_name_val").show();
            $("#document_name_val").html("This field is required");
            $("#document_name_val").focus();
            $("#document_name_val").css("color","red");

            err_document_name=false;
                    return false;
          }
          else{
            err_document_name=true;
              $("#document_name_val").hide();
            
          }
        }

   });

// validation on submit button

$("#submit_btn").click(function(){

   err_first_name=true;
   err_last_name=true;
   err_document_name=true;

     username1();
     username2();
     username3();

  if((err_first_name==true)&&(err_last_name==true)&&(err_document_name==true))
 {
   return true;
  }
  else{
    return false;
  
  }
});

</script>  -->


</body>
<!-- Mirrored from coderthemes.com/moltran/blue/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jun 2019 12:15:55 GMT -->

</html>