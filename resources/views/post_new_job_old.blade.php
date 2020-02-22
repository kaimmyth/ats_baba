    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    @include('include.emp_header')
    @include('include.emp_leftsidebar')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <style>
        input[type=text],
        textarea,
            {
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            outline: none;
            padding: 15px 71px 1px 4px;
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

        #wrapper {
            overflow-y: scroll;
            width: 100%;
        }

        label {
            font-weight: 200;
            font-family: inherit;
            font-size: 15px;
        }

        input[type=text] {
            width: 66%;
            padding: 7px;
            border-radius: 5px;
        }

        textarea {
            border-radius: 5px;
            width: 48%;
        }

        .form-control {
            border: 1px solid #bfbfbf;
            width: 84%;
            background: #fff;
        }

        .active,
        .btn:hover {
            background-color: #000000;
            color: white;
        }

        .form-group row {
            font: inherit;
        }
    </style>

    <div id="wrapper">

        <div class="content-page">
            <div class="content">
                <form action="{{url('employer/post_new_job/post_job')}}" method="post" novalidate>
                    <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                    <div class="card">
                        <div class="card-header" style="background-color:#317eeb;">
                            <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large;font-weight: 100;">Post New Job</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- col 1 -->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <!--group-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Group<span style="color:red;">*</span></label>
                                        <select name="group_of_company" id="for_group" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left:9px;" required>
                                            <option value="">Select Group Type</option>
                                            @foreach($toReturn['team_member_type'] as $team_member_type)
                                            <option value="{{$team_member_type['type_ID']}}">
                                                {{$team_member_type['type_name']}} </option>
                                            @endforeach
                                        </select><br>
                                        <span id="group_check" style="margin-left:35%;">Please Select Any Group</span>
                                    </div>
                                    <!--group-->
                                    <!--Client Name-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Client Name<span style="color:red;">*</span></label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Client Name" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                        <span id="clientname_check" style="margin-left:35%;">Please Select Any Client
                                            Name</span>
                                    </div>
                                    <!--Client Name-->
                                    <!--Privacy Level-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Privacy Level<span style="color:red;">*</span></label>
                                        <select name="privacy_level" id="privacy_level" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                        </select>
                                    </div>
                                    <!--Privacy Level-->

                                    <!--Owner Name-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Owner Name<span style="color:red;">*</span></label>
                                        <select name="owner_name" id="owner_name" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            <option value="">Select Owner Name</option>
                                            @foreach($toReturn['team_member'] as $team_member)
                                            <option value="{{$team_member['ID']}}"> {{$team_member['full_name']}} </option>
                                            @endforeach
                                        </select>
                                        <span id="owner_check" style="margin-left:35%;">Please Select Any Owner Name</span>
                                    </div>
                                    <!--Owner Name-->

                                    <!--Status-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Status<span style="color:red;">*</span></label>
                                        <select name="status" id="status" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            <option value="Published">Published</option>
                                            <option value="Draft">Draft</option>
                                            <option value="Deleted">Deleted</option>
                                            <option value="Hold">Hold</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Closed">Closed</option>
                                            <option value="Pending">Pending</option>
                                            <!-- @foreach($toReturn['post_job'] as $post_job)
                                            <option value="{{$post_job['sts']}}"> {{$post_job['sts']}} </option>
                                        @endforeach -->

                                        </select>
                                    </div>
                                    <!--Status-->

                                    <!--Industry-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Industry<span style="color:red;">*</span></label>
                                        <select name="industry" id="industry" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            @foreach($toReturn['job_industries'] as $job_industries)
                                            <option value="{{$job_industries['ID']}}"> {{$job_industries['industry_name']}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--Industry-->

                                    <!--Job Code-->
                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Job Code<span style="color:red;">*</span> </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="job_code" id="job_code" placeholder="Job Code" maxlength="50" required>
                                            <br>
                                            <span id="jobcode_check">Please Enter Job Code</span>
                                        </div>
                                    </div>
                                    <!--end of Job Code-->

                                    <!--Job Title-->
                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Job Title<span style="color:red;">*</span> </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="job_title" id="job_title" placeholder="Job Title" maxlength="50" required>
                                            <br>
                                            <span id="jobtitle_check">Please Enter Job Title</span>
                                        </div>
                                    </div>
                                    <!--end of Job Title-->

                                    <!--number of No.of Vacancies-->
                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">No.of Vacancies<span style="color:red;">*</span> </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="no_of_vacancies" id="no_of_vacancies" placeholder="No.of Vacancies" maxlength="150" required>
                                            <br>
                                            <span id="no_of_vacancies_check">Please Enter Job Title</span>
                                        </div>
                                    </div>
                                    <!--end of No.of Vacancies-->

                                    <!--Closing Date-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Closing Date(mm/dd/yyyy) <span style="color:red;">*</span></label>
                                        <div class="col-sm-8 input-group date">
                                            <input type="date" class="datetext datepicker" id="closeing_date" name="closeing_date" style="width:66%; padding:8px;" required>
                                            <span id="date_check">Enter Valid Closing Date</span>
                                        </div>
                                    </div>
                                    <!--end of Closing Date-->

                                    <!--Visa-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Visa<span style="color:red;">*</span></label>
                                        <select name="visa[]" id="job_visa_status" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left:9px;" multiple required>
                                            @foreach($toReturn['visa_type'] as $visa_type)
                                            <option value="{{$visa_type['type_name']}}">{{$visa_type['type_name']}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--Visa-->

                                    <!--Qualification -->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Qualification <span style="color:red;">*</span></label>
                                        <select name="quali[]" id="qualification" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left:9px;" multiple required>
                                            @foreach($toReturn['qualification'] as $qualification)
                                            <option value="{{$qualification['val']}}">{{ $qualification['val']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--Qualification -->

                                </div><!-- end col 1-->

                                <!-- col 2-->
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <!--location-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Location <span style="color:red;">*</span></label>
                                        <select name="country" id="country" class="form-control " style="width:22%; border: 1px solid #bbb8b8; margin-left: 9px;" required>
                                            <option value="224" selected>{{$country_name}}</option>
                                            @foreach($toReturn['countries'] as $country)
                                            <option value="{{$country['country_id']}}">{{ $country['country_name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <select name="state" id="state_text" class="form-control " style="max-width:22%; margin-left: 9px; border: 1px solid #bbb8b8;" required>
                                            <option value="">Select State</option>

                                        </select>

                                        <div class="col-md-12" style="float: right;margin-left: 21.5em;margin-top: 2%;">
                                            <div id="select_city">
                                                <select name="city_name" id="city" class="form-control " style="max-width:22%; border: 1px solid #bbb8b8;margin-left: -35px;" required>
                                                    <option value="" selected>Select City </option>
                                                </select>
                                                <br>
                                                <span id="citycheck">Please choose Your Location</span>
                                            </div>
                                        </div>
                                        <input type="checkbox" class="" id="myCheck" onclick="mycity()" style="width:20px;height:20px;">
                                        <label id="city_label" class="control-label col-lg-4">Enter City if not
                                            present</label>

                                        <div id="textCity" style="display:none;" class="form-group row col-md-12">
                                            <label for="" class="control-label col-lg-4">Enter City <span style="color:red;">*</span></label>
                                            <input type="text" class="col-sm-5 form-control" id="textCity_input" name="city_text_name">
                                            <label id="textCity_check">Need to be filled </label>
                                        </div>

                                    </div>
                                    <!--end of location-->

                                    <!--Job Type-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Job Type <span style="color:red;">*</span></label>
                                        <select name="type_of_job" id="type_of_job" onchange="fulltime()" class="form-control" style="width:42%; border: 1px solid #bbb8b8;margin-left: 9px;" required>
                                            <option value="">Select Job Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Contract-to-Hire">Contract-to-Hire</option>
                                            <option value="Part Time">Part Time</option>
                                        </select>
                                        <label id="check_job_type" style="display:none">Cannot be blank</label>
                                    </div>
                                    <!--Job Type-->

                                    <!--Job Duration-->
                                    <div class="form-group row">
                                        <label for="address" class="control-label col-lg-4">Job Duration <span style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="job_duration" id="job_duration" style="width:19%; float:left; margin-left: 1%;">
                                        <select name="day_week" id="job_duration_day" class="form-control" style="width:23%; border: 1px solid #bbb8b8; float:left; margin-left:0.5em;" required>
                                            <option value="Day">Day</option>
                                            <option value="Week">Week</option>
                                            <option value="Month">Month</option>
                                            <option value="Year">Year</option>
                                        </select>
                                        <span id="jobduration_check">Enter Valid Job Duration</span>
                                    </div>
                                    <!--Job Duration-->

                                    <!--Salary/Pay Rate -->
                                    <div class="form-group row">
                                        <label class="control-label col-lg-4">Salary/Pay Rate <span style="color:red;">*</span></label>
                                        <!-- <input type="text" placeholder="min" name="pay_min" id="pay_min" style="width:20%; float:left;  margin-left: 1%;">&nbsp;&nbsp;
                                  <input type="text" placeholder="Max" name="pay_max" id="pay_max" value="" maxlength="4" style="width:22%; float:left;"> -->
                                        <select name="select_payment" id="select_ranage" class="form-control"
                                            style="max-width:40%; border: 1px solid #bbb8b8; float:left;">
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
                                        <select name="select_payment" id="select_ranage_other" class="form-control"
                                            style="max-width:40%; display:none; border: 1px solid #bbb8b8; float:left;" >
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
                                        <div class="col-md-12" style="float: right;margin-left: 19em;margin-top: 2%;">
                                            <select name="pay_uom" id="pay_uom" class="form-control" style="width:19%; border: 1px solid #bbb8b8; float:left;" required>
                                                <option value="Hourly">Hourly</option>
                                                <option value="Annum">Annum</option>
                                            </select>
                                            <span id="salary_check">Enter Valid Salary/Pay Rate</span>
                                        </div>
                                    </div>
                                    <!--Experience Required  -->

                                    <div class="form-group row">
                                        <label for="" class="control-label col-lg-4">Experience Required <span style="color:red;">*</span> </label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="experience" id="experience" placeholder="Experience Required" maxlength="2" required><span>years</span>
                                            <br>
                                            <span id="exp_req_check">Please Enter a Valid Year</span>
                                        </div>
                                    </div>
                                    <!--Experience Required  -->

                                    <!-- Requirements (Must)-->
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label" for="example-textarea-input">Requirements
                                            (Must)<span style="color:red;">*</span></label>
                                        <div class="col-md-8">
                                            <textarea cols="40" rows="3" name="requirement" id="textarea" style="width:66%;" required></textarea>
                                            <br>
                                            <span class="tooltiptext">Must have required technologies like Java, Asp.net,
                                                PHP etc..</span>
                                            <br>
                                            <span id="req_check">Please Enter Requirements</span>
                                        </div>
                                    </div>
                                    <!--end of Requirements (Must)-->

                                    <!-- Requirements (Optional)-->
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label" for="example-textarea-input">Requirements
                                            (Optional)</label>
                                        <div class="col-md-8">
                                            <textarea cols="40" rows="3" name="requirements" id="textarea" style="width:66%;"></textarea>
                                            <br>
                                            <span class="tooltiptext">Must have optional technologies like Java, Asp.net,
                                                PHP etc..</span>
                                        </div>
                                    </div>
                                    <!--end of Requirements (Optional)-->

                                    <!--Job Description -->
                                    <div class="form-group row">
                                        <label class="col-md-4 control-label" for="example-textarea-input">Job
                                            Description<span style="color:red;">*</span></label>
                                        <div class="col-md-8">
                                            <textarea name="job_desc" id="editor" cols="60" rows="6" style="width:66%;" required></textarea>
                                            <br>
                                            <span id="job_desc_check">Please Enter Job Description</span>

                                            <br>
                                        </div>
                                    </div>
                                    <!--end of Job Description -->

                                </div>
                                <!-- end col 2 -->
                            </div>
                            <!-- End row -->
                        </div>
                        <!-- ens card body-->
                    </div>
                    <!-- card -->
                    <!-- Badge -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">

                                    <input name="skills" id="Result" class="form-control" readonly>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" onclick="fun()" name="" id="val_check" value="checkedValue">
                                            Edit skills
                                        </label>
                                    </div>


                                    <br>

                                    <div class="form-group row">
                                        <label for="lastname" class="control-label col-lg-4">Add Skill <span style="color:red;">*</span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" style="border: 1px solid #737373; width:100%;" id="tags" name="skill" type="text" required>
                                            <span class="help-block" style="text-align:right;"><small>
                                                    Single skill at a time..</small></span>
                                            <br>
                                            <span id="skill_check">Please Add Maximum Three Skill</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-info waves-effect waves-light m-l-10" onclick="add_element_to_array();">Add</button>

                                        </div>
                                    </div>
                                </div>
                                <!-- .form -->
                                <!--  <div class="buttons" style="width: 100%; height:70px; background: #cecece;"> -->
                                <div class="form-group" style="width:100%; height:80px;background:#e4e4e4;"><br>
                                    <center>
                                        <input type="submit" name="submit" id="validatefrm" value="Post Job" class="btn btn-info" />
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @include('include.emp_footer')
    <script>
        function fun() {

            $("#Result").removeAttr('readonly');

        }
    </script>
    <script type="text/javascript">
        $("#country").on("change", function(e) {
            $('#state_text').empty();
            var country_id = e.target.value;
            $.ajax({
                type: 'get',
                url: '{{url("employer/post_new_job/post_job/state/")}}' + "/" + country_id,
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, value) {
                        $('#state_text').append("<option value=" + '"' + value.state_id + '"' +
                            "selected>" + value.state_name + "</option>");
                        console.log(value.state_id);
                    });
                },



            });

        });
        $('#state_text').on('change', function(e) {
            $('#city').empty();
            var state_id = e.target.value;
            $.ajax({
                type: 'get',
                url: '{{url("employer/post_new_job/post_job/city/")}}' + "/" + state_id,
                success: function(data) {
                    console.log(data);
                    $.each(data, function(index, value) {
                        $('#city').append("<option value=" + '"' + value.city_id + '"' +
                            "selected>" + value.city_name + "</option>");
                    });

                },
            });
        });
    </script>

    <script>
        var x = 0;
        var arr = Array();

        function add_element_to_array() {
            arr[x] = document.getElementById("tags").value;
            x++;
            document.getElementById("Result").value = arr;
            var e = "";

            for (var y = 0; y < arr.length; y++) {
                e = e + "," + arr[y];
            }
            document.getElementById("Result").value = e.replace(/(^[,\s]+)|([,\s]+$)/g, '');
            document.getElementById("tags").value = "";
        }
    </script>


    <script>
        var resizefunc = [];
    </script>


    <script>
        // $(document).ready(function(){
        //     $('select[name="group_of_company"]').on('change', function(){
        //     $('#owner_name').empty();
        //         var group_id = $(this).val();
        //         if(group_id)
        //         {          
        //             $.ajax({
        //                 type:'get',
        //                 url:'{{url('employer/post_new_job/post_job/')}}'+"/"+group_id,
        //                 dataType:'json',
        //                 success: function(data)
        //                 {
        //                     $('#owner_name').empty();
        //                     $.each(data,function(i,owner_name){
        //                             $("#owner_name").append("<option>"+owner_name.full_name+"</option>");
        //                     });
        //                     console.log(data);                   
        //                 }
        //             });
        //         } 
        //     });
        // });
    </script>


    <!-- Validation of Post new Job -->
    <script>
        $(document).ready(function() {
            $("#jobduration_check").hide();
            $("#salary_check").hide();
            $("#exp_req_check").hide();
            $("#req_check").hide();
            $("#job_desc_check").hide();
            $("#skill_check").hide();
            var err_jobduration = true;
            var err_salary = true;
            var err_exp_req = true;
            var err_req = true;
            var err_job_desc = true;
            var err_skill = true;
            var err_city = true;
            var err_country = true;
            var err_state = true;
            var err_city_val = true;

            //validate job duration
            $("#validatefrm").click(function() {
                check_duration();
            });
            $("#job_duration").blur(function() {
                check_duration();
            });

            function check_duration() {

                var job_val = $("#job_duration").val();
                var regex = /^[0-9-+()]*$/;
                var regex1 = /^[a-zA-Z ]*$/;

                if (job_val == "") {
                    $("#jobduration_check").show();
                    $("#jobduration_check").focus();
                    $("#jobduration_check").css("color", "red");
                    err_jobduration = false;
                    return false;
                } else {
                    isValid = regex.test(job_val);

                    if (!isValid) {
                        $("#jobduration_check").show();
                        $("#jobduration_check").css("color", "red");
                        err_jobduration = false;
                        return false;
                    } else {
                        $("#jobduration_check").hide();
                        err_jobduration = true;
                        return false;
                    }

                }
            }






            //validate salary/ pay rate
            $("#validatefrm").click(function() {
                check_salary();
            });
            $("#pay_min").blur(function() {
                check_salary();
            });
            $("#pay_max").blur(function() {
                check_salary();
            });

            function check_salary() {
                var salary_val = $("#pay_min").val();
                var salary_max_val = $("#pay_max").val();
                if ((salary_val == "") || (salary_max_val == "")) {
                    $("#salary_check").show();
                    $("#salary_check").focus();
                    $("#salary_check").css("color", "red");
                    err_salary = false;
                    return false;
                } else {
                    $("#salary_check").hide();
                }
            }

            //validate experience required
            $("#validatefrm").click(function() {
                check_exp_req();
            });
            $("#experience").blur(function() {
                check_exp_req();
            });

            function check_exp_req() {

                var exp_req_val = $("#experience").val();
                var regex = /^[0-9-+()]*$/;
                var regex1 = /^[a-zA-Z ]*$/;

                if (exp_req_val == "") {
                    $("#exp_req_check").show();
                    $("#exp_req_check").focus();
                    $("#exp_req_check").css("color", "red");
                    err_exp_req = false;
                    return false;
                } else {
                    isValid = regex.test(exp_req_val);

                    if (!isValid) {
                        $("#exp_req_check").show();
                        $("#exp_req_check").css("color", "red");
                        err_exp_req = false;
                        return false;
                    } else {
                        $("#exp_req_check").hide();
                        err_exp_req = true;
                        return false;
                    }

                }






            }

            //validate requirement
            $("#validatefrm").click(function() {
                check_req();
            });
            $("#textarea").blur(function() {
                check_req();
            });

            function check_req() {

                var req_val = $("#textarea").val();

                if (req_val == "") {
                    $("#req_check").show();
                    $("#req_check").focus();
                    $("#req_check").css("color", "red");
                    err_req = false;
                    return false;
                } else {
                    $("#req_check").hide();
                }
            }
            //validate job description
            $("#validatefrm").click(function() {
                check_job_desc();
            });
            $("#editor").blur(function() {
                check_job_desc();
            });

            function check_job_desc() {

                var job_desc_val = $("#editor").val();

                if (job_desc_val == "") {
                    $("#job_desc_check").show();
                    $("#job_desc_check").focus();
                    $("#job_desc_check").css("color", "red");
                    err_job_desc = false;
                    return false;
                } else {
                    $("#job_desc_check").hide();
                }
            }
            //validate add skill
            $("#validatefrm").click(function() {
                check_skill();
            });
            $("#Result").click(function() {
                check_skill();
            });

            function check_skill() {
                var skill_val = $("#Result").val();
                if (skill_val == "") {
                    $("#skill_check").show();
                    $("#skill_check").focus();
                    $("#skill_check").css("color", "red");
                    err_skill = false;
                    return false;
                } else {
                    $("#skill_check").hide();
                }
            }
            //Validation Location
            $("#validatefrm").click(function() {
                check_location();
            });
            $("#country").blur(function() {
                check_location();
            });
            $("#state_text").blur(function() {
                check_location();
            });

            function check_location() {
                var loc_val = $("#country").val();
                var loc_val1 = $("#state_text").val();
                if ((loc_val == "") || (loc_val1 == "")) {
                    $("#citycheck").show();
                    $("#citycheck").focus();
                    $("#citycheck").css("color", "red");

                    err_country = false;
                    err_state = false;
                    return false;

                } else {
                    $("#citycheck").hide();
                }
            }

            $("#validatefrm").click(function() {
                check_city();
            });


            function check_city() {
                var loc_val2 = $("#city").val();
                var jobcode_val = $("#textCity_input").val();
                var checkBox = document.getElementById("myCheck");
                if ((checkBox.checked == true) && (jobcode_val == "")) {
                    console.log("new");
                    $("#citycheck").show();
                    $("#citycheck").focus();
                    $("#citycheck").css("color", "red");
                    err_city_val = false;
                    return false;
                } else if ((checkBox.checked == false) && (loc_val2 == "")) {
                    console.log("one");
                    $("#citycheck").show();
                    $("#citycheck").focus();
                    $("#citycheck").css("color", "red");
                    err_city_val = false;
                    return false;

                }



            }

            $("#validatefrm").click(function() {
                mycity();
            });
            $("#myCheck").click(function() {
                mycity();
            });


            function mycity() {
                $("#textCity_check").hide();
                var checkBox = document.getElementById("myCheck");
                if (checkBox.checked == true) {
                    $('#select_city').css('display', 'none');
                    $('#textCity').css('display', 'block');
                    $('#city_label').css('display', 'none')
                    $("#validatefrm").click(function() {
                        var jobcode_val = $("#textCity_input").val();
                        var regex1 = /^[a-zA-Z ]*$/;

                        if (jobcode_val == "") {
                            $("#textCity_check").show();
                            $("#textCity_check").focus();
                            $("#textCity_check").css("color", "red");
                            err_text_city = false;
                            return false;
                        } else {
                            isValid = regex1.test(jobcode_val);
                            $("#textCity_check").css("display", !isValid ? "block" : "none");
                            $("#textCity_check").css("color", "red");

                            err_text_city = false;
                        }
                    });

                } else {
                    $('#select_city').css('display', 'block');
                    $('#textCity').css('display', 'none');
                    $('#city_label').css('display', 'block')
                }
            }

            $("#validatefrm").click(function() {
                err_jobduration = true;
                err_salary = true;
                err_exp_req = true;
                err_req = true;
                err_job_desc = true;
                err_skill = true;
                err_city_val = true;
                err_text_city = true
                err_country = true;
                err_state = true;
                check_duration();
                check_salary();
                check_exp_req();
                check_req();
                check_job_desc();
                check_skill();
                check_location();
                check_city();

                if ((err_city_val == true) && (err_text_city == true) && (err_country == true) && (err_state == true) && (
                        err_jobduration == true) && (err_salary == true) && (err_exp_req == true) && (
                        err_req == true) && (err_job_desc == true) && (err_skill == true)) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#group_check").hide();
            $("#clientname_check").hide();
            $("#owner_check").hide();
            $("#no_of_vacancies_check").hide();
            $("#jobtitle_check").hide();
            $("#date_check").hide();
            $("#citycheck").hide();
            $("#err_vacancies_check").hide();
            $("#jobcode_check").hide();

            var err_group = true;
            var err_clientname = true;
            var err_owner = true;
            var err_jobcode = true;
            var err_jobtitle = true;
            var err_date = true;
            var err_job_type = true;
            var err_vacancies = true;



            //validate group

            $("#validatefrm").click(function() {
                check_group();
            });
            $("#for_group").blur(function() {
                check_group();
            });

            function check_group() {

                var group_val = $("#for_group").val();
                if (group_val == "") {
                    $("#group_check").show();
                    $("#group_check").focus();
                    $("#group_check").css("color", "red");
                    err_group = false;
                    return false;
                } else {
                    $("#group_check").hide();
                }
            }
            //validate client name
            $("#validatefrm").click(function() {
                check_clientname();
            });
            $("#company_name").blur(function() {
                check_clientname();
            });

            function check_clientname() {

                var clientname_val = $("#company_name").val();

                var regexOnlyText = /^[^0-9]+$/;
                if (clientname_val == "" || regexOnlyText.test(clientname_val) != true) {
                    $("#clientname_check").show();
                    $("#clientname_check").focus();
                    $("#clientname_check").css("color", "red");
                    err_clientname = false;
                    return false;
                } else {
                    err_clientname = true;
                    $("#clientname_check").hide();
                }

                // var regexOnlyText = /^[0-9]+$/;
                // if ((clientname_val == "")||(regexOnlyText.test(clientname_val) != true)) {
                //     $("#clientname_check").show();
                //     $("#clientname_check").focus();
                //     $("#clientname_check").css("color", "red");
                //     err_clientname = false;
                //     return false;
                // } else {
                //     $("#clientname_check").hide();
                //     return false;
                //     err_clientname = false;

                // }



            }
            //validate owner name
            $("#validatefrm").click(function() {
                check_owner();
            });
            $("#owner_name").blur(function() {
                check_owner();
            });

            function check_owner() {
                var owner_val = $("#owner_name").val();
                if (owner_val == "") {
                    $("#owner_check").show();
                    $("#owner_check").focus();
                    $("#owner_check").css("color", "red");
                    err_owner = false;
                    return false;
                } else {
                    $("#owner_check").hide();
                }
            }

            //validate job code
            $("#validatefrm").click(function() {
                check_jobcode();
            });
            $("#job_code").blur(function() {
                check_jobcode();
            });

            function check_jobcode() {
                var jobcode_val = $("#job_code").val();
                var regex = /^[0-9-+()]*$/;
                var regex1 = /^[a-zA-Z ]*$/;

                if (jobcode_val == "") {
                    $("#jobcode_check").show();
                    $("#jobcode_check").focus();
                    $("#jobcode_check").css("color", "red");
                    err_jobcode = false;
                    return false;
                } else {
                        $("#jobcode_check").hide();
                        err_jobcode = true;
                        
                    }

                
            }
            //validate no of vancancy
            $("#validatefrm").click(function() {
                check_vacancies();
            });
            $("#no_of_vacancies").blur(function() {
                check_vacancies();
            });

            function check_vacancies() {
                var jobcode_val = $("#no_of_vacancies").val();
                var regex = /^[0-9-+()]*$/;
                var regex1 = /^[a-zA-Z ]*$/;

                if (jobcode_val == "") {
                    $("#no_of_vacancies_check").show();
                    $("#no_of_vacancies_check").focus();
                    $("#no_of_vacancies_check").css("color", "red");
                    err_vacancies = false;
                    return false;
                } else {
                    isValid = regex.test(jobcode_val);

                    if (!isValid) {
                        $("#no_of_vacancies_check").show();
                        $("#no_of_vacancies_check").css("color", "red");
                        err_vacancies = false;
                        return false;
                    } else {
                        $("#no_of_vacancies_check").hide();
                        err_vacancies = true;
                        return false;
                    }

                }
            }



            //validate job title
            $("#validatefrm").click(function() {
                check_jobtitle();
            });
            $("#job_title").blur(function() {
                check_jobtitle();
            });

            function check_jobtitle() {
                var jobtitle_val = $("#job_title").val();
                var regex1 = /^[a-zA-Z0-9_]*$/;
                if (jobtitle_val == "") {
                    $("#jobtitle_check").show();
                    $("#jobtitle_check").focus();
                    $("#jobtitle_check").css("color", "red");
                    err_jobtitle = false;
                    return false;
                } else {
                        $("#jobtitle_check").hide();
                        err_jobtitle = true;
                        return false;
                    
                }
            }
            //validate closing date
            $("#validatefrm").click(function() {
                check_date();
            });
            $("#closeing_date").blur(function() {
                check_date();
            });

            function check_date() {
                var date_val = $("#closeing_date").val();
                console.log(date_val);
                // var date_regex = "^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$ ";

                // var dob_var = new Date(date_val);
                // var dob_val_day = dob_var.getDate();
                // var dob_val_month = dob_var.getMonth() + 1;
                // var dob_val_year = dob_var.getFullYear();

                if (!dob_val_day || !dob_val_month || !dob_val_year) {
                    $("#date_check").show();
                    $("#date_check").focus();
                    $("#date_check").css("color", "red");
                    err_dob = false;
                //     return false;
                // // } else if (dob_val_day > 31 || dob_val_month > 12 || dob_val_year > new Date().getFullYear()) {
                //     $("#date_check").show();
                //     $("#date_check").focus();
                //     $("#date_check").css("color", "red");
                //     err_dob = false;
                    return false;
                } else {
                    err_dob = true;
                    $("#date_check").hide();
                }

            }

            // $("#").blur(function () {
            //     check_city();
            // });
            // function check_city(){

            // }


            $("#validatefrm").click(function() {
                check_jon_type();
            });
            $("#type_of_job").blur(function() {
                check_jon_type();
            });

            function check_jon_type() {
                var type_job = $("#type_of_job").val();
                if (type_job == "") {
                    // check_job_type
                    $("#check_job_type").show();
                    $("#check_job_type").focus();
                    $("#check_job_type").css("color", "red");

                    err_job_type = false;
                    return false;
                } else {
                    $("#check_job_type").hide();
                }
            }


            $("#validatefrm").click(function() {
                err_group = true;
                err_clientname = true;
                err_owner = true;
                err_jobcode = true;
                err_jobtitle = true;
                err_date = true;
                err_city = true;
                err_vacancies = true;
                err_country = true;
                err_state = true;
                err_job_type = true;
                check_group();
                check_clientname();
                check_owner();
                check_jobcode();
                check_jobtitle();
                check_date();
                check_jon_type();
                check_vacancies();


                if ((err_country == true) && (err_state == true) && (err_group == true) && (
                        err_vacancies ==
                        true) && (err_clientname == true) && (err_owner == true) && (err_jobcode ==
                        true) && (err_jobtitle == true) && (err_date == true) && (err_city == true) && (err_job_type == true)) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#closeing_date ').datepicker();
        });
    </script>

    <script type="text/javascript">
        function fulltime() {
            // alert('hrllo');
            temp = document.getElementById('type_of_job').value;
            if (temp == 'Full Time') {
                document.getElementById("select_ranage").style.display = "block";
                document.getElementById("select_ranage_other").style.display = "none";
            } else {
                document.getElementById("select_ranage").style.display = "none";
                document.getElementById("select_ranage_other").style.display = "block";
            }            // alert(temp);
            // if (temp == 'Full Time') {
            //     //alert('full time');
            //     var x = document.getElementById("pay_min").options[1].disabled = false;
            //     var x = document.getElementById("pay_min").options[2].disabled = false;
            //     var x = document.getElementById("pay_min").options[3].disabled = false;
            //     var x = document.getElementById("pay_min").options[4].disabled = false;
            //     var x = document.getElementById("pay_min").options[5].disabled = false;
            //     var x = document.getElementById("pay_min").options[6].disabled = false;
            //     var x = document.getElementById("pay_min").options[7].disabled = false;
            //     var x = document.getElementById("pay_min").options[8].disabled = false;
            //     var x = document.getElementById("pay_min").options[9].disabled = false;
            //     var x = document.getElementById("pay_min").options[10].disabled = false;
            //     var x = document.getElementById("pay_min").options[11].disabled = true;
            //     var x = document.getElementById("pay_min").options[12].disabled = true;
            //     var x = document.getElementById("pay_min").options[13].disabled = true;
            //     var x = document.getElementById("pay_min").options[14].disabled = true;
            //     var x = document.getElementById("pay_min").options[15].disabled = true;
            //     var x = document.getElementById("pay_min").options[16].disabled = true;
            //     var x = document.getElementById("pay_min").options[17].disabled = true;
            //     var x = document.getElementById("pay_min").options[18].disabled = true;
            //     var x = document.getElementById("pay_min").options[19].disabled = true;
            //     var x = document.getElementById("pay_min").options[20].disabled = true;
            //     var x = document.getElementById("pay_min").options[21].disabled = true;
            //     var x = document.getElementById("pay_min").options[22].disabled = true;
            // } else if (temp == 'Contract') {
            //     //alert('Contract');
            //     var x = document.getElementById("pay_min").options[1].disabled = true;
            //     var x = document.getElementById("pay_min").options[2].disabled = true;
            //     var x = document.getElementById("pay_min").options[3].disabled = true;
            //     var x = document.getElementById("pay_min").options[4].disabled = true;
            //     var x = document.getElementById("pay_min").options[5].disabled = true;
            //     var x = document.getElementById("pay_min").options[6].disabled = true;
            //     var x = document.getElementById("pay_min").options[7].disabled = true;
            //     var x = document.getElementById("pay_min").options[8].disabled = true;
            //     var x = document.getElementById("pay_min").options[9].disabled = true;
            //     var x = document.getElementById("pay_min").options[10].disabled = true;
            //     var x = document.getElementById("pay_min").options[11].disabled = false;
            //     var x = document.getElementById("pay_min").options[12].disabled = false;
            //     var x = document.getElementById("pay_min").options[13].disabled = false;
            //     var x = document.getElementById("pay_min").options[14].disabled = false;
            //     var x = document.getElementById("pay_min").options[15].disabled = false;
            //     var x = document.getElementById("pay_min").options[16].disabled = false;
            //     var x = document.getElementById("pay_min").options[17].disabled = false;
            //     var x = document.getElementById("pay_min").options[18].disabled = false;
            //     var x = document.getElementById("pay_min").options[19].disabled = false;
            //     var x = document.getElementById("pay_min").options[20].disabled = false;
            //     var x = document.getElementById("pay_min").options[21].disabled = false;
            //     var x = document.getElementById("pay_min").options[22].disabled = false;


            // } else {
            //     var x = document.getElementById("pay_min").options[1].disabled = false;
            //     var x = document.getElementById("pay_min").options[2].disabled = false;
            //     var x = document.getElementById("pay_min").options[3].disabled = false;
            //     var x = document.getElementById("pay_min").options[4].disabled = false;
            //     var x = document.getElementById("pay_min").options[5].disabled = false;
            //     var x = document.getElementById("pay_min").options[6].disabled = false;
            //     var x = document.getElementById("pay_min").options[7].disabled = false;
            //     var x = document.getElementById("pay_min").options[8].disabled = false;
            //     var x = document.getElementById("pay_min").options[9].disabled = false;
            //     var x = document.getElementById("pay_min").options[10].disabled = false;
            //     var x = document.getElementById("pay_min").options[11].disabled = false;
            //     var x = document.getElementById("pay_min").options[12].disabled = false;
            //     var x = document.getElementById("pay_min").options[13].disabled = false;
            //     var x = document.getElementById("pay_min").options[14].disabled = false;
            //     var x = document.getElementById("pay_min").options[15].disabled = false;
            //     var x = document.getElementById("pay_min").options[16].disabled = false;
            //     var x = document.getElementById("pay_min").options[17].disabled = false;
            //     var x = document.getElementById("pay_min").options[18].disabled = false;
            //     var x = document.getElementById("pay_min").options[19].disabled = false;
            //     var x = document.getElementById("pay_min").options[20].disabled = false;
            //     var x = document.getElementById("pay_min").options[21].disabled = false;
            //     var x = document.getElementById("pay_min").options[22].disabled = false;

            // }
        }
    </script>
    </body>