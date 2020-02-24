<meta name="csrf-token" content="{{ csrf_token() }}">
@include('include.emp_header')
@include('include.emp_leftsidebar')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<!-- Custom Files -->
<style>
    .form-control {
        border: 1px solid #b3b3b3;
        width: 66%;
        background-color: #fff;
    }

    .active,
    .btn:hover {
        background-color: #b3b3b3;
        color: white;
    }

    .control-label {
        font-family: inherit;
    }

    .card .card-header {
        padding: 10px 20px;
        border: none;
        background: #428bca;
        color: #fff;
    }

    .card-title {
        font-size: 17px;
        font-weight: 100;
        color: #ffffff;
        margin-bottom: 0;
        margin-top: 0;
        text-transform: none;
    }

    .checkbox label {
        display: inline-block;
        padding-left: 5px;
        position: absolute;
        font-weight: 400;
    }

    #wrapper {
        width: 100%;
        overflow-y: scroll;
    }

    input:checked+.slider {
        background-color: #317eeb;
    }

</style>
</head>

<div id="wrapper">
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border: 1px #C0C0C0 solid;">
                        <div class="card-header" style="background-color: #317eeb;">
                            <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large">EDIT USER
                            </h3>
                        </div>
                        <div class="card-body">
                            <!--Name-->
                            <form action="{{url('employer/manageteammember/edit/add')}}" method="post" enctype='multipart/form-data'>
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Name <span
                                            style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="full_name" name="full_name"
                                            placeholder="Full Name" value="{{$data->full_name}}">
                                        <input type="hidden" id="ID" name="ID" value="{{$data->ID}}">
                                        <span id="namecheck" name="namecheck">Please Enter Your Name</span>
                                    </div>
                                </div>
                                <!--end of Name-->
                                <!--Group-->
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Group <span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="group" id="group"
                                            style=" border: 1px solid #b3b3b3">
                                            @foreach($group as $group)
                                            <option value="{{$group->type_ID}}" @if($data->team_member_type==$group->type_ID) {{'selected'}} @endif>{{$group->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end of Group-->
                                <!--Email-->
                                <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Email <span
                                            style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="email" name="email" placeholder="Email"
                                            type="text" value="{{$data->email}}">
                                        <span id="emailcheck" name="emailcheck">Please enter a correct email ID</span>
                                    </div>
                                </div>
                                <!--end of Email-->
                                <!--Password-->
                                <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Password<span
                                            style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="password" name="password" placeholder="Password"
                                            type="password" >
                                        <span id="passwordcheck" name="passwordcheck">Value must have 6 characters or
                                            more</span>
                                    </div>
                                </div>
                                <!--end of Password-->
                                <!--Confirm Password-->
                                <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Confirm Password<span
                                            style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="confirm_password" name="confirm_password"
                                            placeholder="Confirm Password" type="password">
                                        <span id="cmfpascheck" name="cmfpascheck">Both password field must be
                                            same</span>
                                    </div>
                                </div>
                                <!--end of Confirm Password-->

                                <!--location-->
                                <div class="form-group row">
                                    <label for="address" class="control-label col-lg-4">Location <span
                                            style="color:red;">*</span></label>
                                    <select name="country" id="country" class="form-control "
                                        style="width:11%; border: 1px solid #bbb8b8; margin-left: 9px;" required>

                                    <option value="{{$data->country}}">{{$data->country}}</option>
                                        @foreach($toReturn['countries'] as $country)
                                        <option value="{{$country['country_id']}}" @if($data->country==$country['country_name']) {{'selected'}} @endif > {{ $country['country_name']}}
                                        </option>
                                        @endforeach
                                    </select>

                                    <select name="state" id="state_text" class="form-control "
                                        style="max-width:12%; margin-left: 9px; border: 1px solid #bbb8b8;" required>
                                        <option value="{{$data->state}}">{{$data->state}}</option>
                                    </select>
                                    <!--<div class="col-md-12" style="float: right;margin-left: 21em;margin-top: 2%;">-->
                                    <select name="city" id="city" class="form-control "
                                        style="max-width:20%; border: 1px solid #bbb8b8;" required>
                                        <option value="{{$data->city}}">{{$data->city}}</option>
                                    </select>
                                    <br>
                                    <span id="citycheck">Please choose Your Location</span>
                                    <!--</div>-->
                                </div>
                                <!--end location-->

                                <!--Mobile Phone-->
                                <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Mobile Phone<span
                                            style="color:red;">*</span></label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="mobile_number" name="mobile_number"
                                            placeholder="" maxlength="12" type="text" value="{{$data->mobile_number}}">
                                        <span id="phcheck" name="phcheck">Enter your mobile number</span>
                                    </div>
                                </div>
                                <!--end of Mobile Phone -->
                                <!--Home Phone-->
                                {{-- <div class="form-group row">
                                    <label for="" class="control-label col-lg-4">Home Phone</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="phone" name="phone" placeholder=""
                                            type="text"" maxlength=" 12" value="{{$data->number}}">
                                        <span id="homephcheck">Enter your mobile number</span>
                                    </div>
                                </div> --}}
                                <!--end of Home Phone -->
                                <!--Jobs History-->
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Jobs History <span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="jobs_history" name="jobs_history"
                                            style="border: 1px solid #b3b3b3;">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <span id="jobhistory" name="jobhistory">This field must not be empty</span>
                                    </div>
                                </div>
                                <!--end of Jobs History-->
                                <!--Member type-->
                                <div class="form-group row">
                                    <label class="col-sm-4 control-label">Type<span
                                            style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="team_type" name="team_type"
                                            style="border: 1px solid #b3b3b3;" required>
                                            @if($toReturn['user']->user_type == 'teamlead')
                                            <option value="{{$toReturn['user']->user_type}}" selected>Team leader</option>
                                            @else
                                            <option value="{{$toReturn['user']->user_type}}" selected>Teammember</option>
                                            @endif
                                            <option value="teamlead">Team leader</option>
                                            <option value="teammember">Teammember</option>
                                        </select>
                                        {{-- <span id="jobhistory" name="jobhistory">This field must not be empty</span> --}}
                                    </div>
                                </div>
                                <!--end Member type-->
                        </div>
                        <!-- card-body -->
                    </div>
                    <!-- card -->
                    <div class="card-body" style="background:#fff;">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive" style="width: 100%; style=" background:"#fff";>
                                    <table id="datatable-responsive"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr style="background-color:#317eeb; color:#fff;">
                                                <th style="color:#fff;">Permission</th>
                                                <th style="color:#fff;">Read</th>
                                                <th style="color:#fff;">Add</th>
                                                <th style="color:#fff;">Edit</th>
                                                <th style="color:#fff;">Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($toReturn['editteam'] as $key => $value)
                                            <tr>
                                                <td>{{$toReturn['editteam'][$key]['nameofmodule']}}<input type="hidden"
                                                        name="editchange[]" value="
                                                            {{$toReturn['editteam'][$key]['moduleid']}}">
                                                </td>

                                                <td>
                                                    <input id="checkbox1{{$key}}"
                                                        name="read{{$toReturn['editteam'][$key]['moduleid']}}"
                                                        value="read" type="checkbox"
                                                        <?php echo ($toReturn['editteam'][$key]['read'] == 'yes') ? 'checked' : ""; ?>>
                                                </td>

                                                <td><input id="checkbox2{{$key}}"
                                                        name="add{{$toReturn['editteam'][$key]['moduleid']}}"
                                                        value="add" type="checkbox"
                                                        <?php echo ($toReturn['editteam'][$key]['add'] == 'yes') ? 'checked' : ""; ?>>
                                                </td>

                                                <td>
                                                    <input id="checkbox3{{$key}}"
                                                        name="edit{{$toReturn['editteam'][$key]['moduleid']}}"
                                                        value="edit" type="checkbox"
                                                        <?php echo ($toReturn['editteam'][$key]['edit'] == 'yes') ? 'checked' : ""; ?>>
                                                </td>

                                                <td>
                                                    <input id="checkbox4{{$key}}"
                                                        name="delete{{$toReturn['editteam'][$key]['moduleid']}}"
                                                        value="delete" type="checkbox"
                                                        <?php echo ($toReturn['editteam'][$key]['delete'] == 'yes') ? 'checked' : ""; ?>>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <!-- <td><input type="hidden" name="" value="">System Administration</td> -->
                                                <!-- td>
                                                            <label class="switch">
                                                                <input type="checkbox"  name="systemAdministration" checked>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </td> -->
                                            </tr>
                                            <!--end-->
                                        </tbody>

                                    </table>
                                </div>
                                <br>
                                <!--Select File-->
                                <div class="form-group row" style="border: 1px #ccc solid;">
                                    <br>
                                    <br>
                                    <label class="col-md-2 control-label">Profile Image</label>
                                    <div class="col-lg-10">
                                    <input type="file" class="form-control" name="profile_image" >
                                            <input type="hidden"  name="cv_file_before" value="{{$data->profile_image}}" >
                                            <a href="{{url('public/seekerresume/'.$data->profile_image)}}">{{$data->profile_image}}</a>
                                            <br>
                                        <span id="profile" name="profile">Upload files only in .jpg, .jpeg, .gif or .png
                                            format with max size of 6 MB.</span>
                                            
                                    </div>
                                </div>
                                <!--end of Select File-->
                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info waves-effect waves-light m-b-5" id="validatefrm"
                                            name="validatefrm" type="submit">Update</button>
                                    </center>
                                    </a>
                                </div>
                                </form>
                            </div>
                            <!--end of col-->
                        </div>
                        <!--end of row-->
                    </div>
                    <!--end of card body-->
                </div>
                <!-- col -->
            </div>
            <!-- End row -->

            <!-- container -->
        </div>
    </div>
    <!-- content -->
    @include('include.emp_footer')
</div>
</div>
<!-- END wrapper -->

<script type="text/javascript">
    $('#country').on('change', function (e) {
        console.log(e);
        $('#state_text').empty();
        $('#city').empty();
        var country_id = e.target.value;
        console.log(country_id);
        $.ajax({
            type: 'get',
            url: '{{url("employer/post_new_job/post_job/state/")}}' + "/" + country_id,
            success: function (data) {
                console.log(data);
                $.each(data, function (index, value) {
                    $('#state_text').append("<option value=" + '"' + value.state_id + '"' +
                        "selected>" + value.state_name + "</option>");
                    console.log(value.state_id);
                });
            },
            error: function (data) {
                console.log(data);
            }

        });

    });
    $('#state_text').on('change', function (e) {
        console.log(e);
        $('#city').empty();
        var state_id = e.target.value;
        console.log(state_id);
        $.ajax({
            type: 'get',
            url: '{{url("employer/post_new_job/post_job/city/")}}' + "/" + state_id,
            success: function (data) {
                console.log(data);

                $.each(data, function (index, value) {
                    $('#city').append("<option value=" + '"' + value.city_id + '"' +
                        "selected>" + value.city_name + "</option>");
                });

            },
            error: function (data) {
                console.log(data);
            }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $("#namecheck").hide();
        $("#emailcheck").hide();
        $("#passwordcheck").hide();
        $("#cmfpascheck").hide();
        var err_check = true;
        var err_check_email = true;
        var err_check_psw = true;
        var err_check_cmfpsd = true;

        //validate name
        $("#full_name").blur(function () {
            check_firstname();
        });
        $("#validatefrm").click(function () {
            check_firstname();
        });

        function check_firstname() {
            var full_name_val = $("#full_name").val();

            var regexOnlyText = /^[a-zA-Z ]+$/;
            if (full_name_val.length == "" || regexOnlyText.test(full_name_val) != true) {
                $("#namecheck").show();
                $("#namecheck").focus();
                $("#namecheck").css("color", "red");
                err_check = false;
                return false;
            } else {
                $("#namecheck").hide();
            }

        }
        //validate email
        $("#email").blur(function () {
            check_email();
        });
        $("#validatefrm").click(function () {
            check_email();
        });

        function check_email() {
            var email_val = $("#email").val();
            var v =
                /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var result = email_val.match(v);
            if ((email_val.length == "") || (result == null)) {
                $("#emailcheck").show();
                $("#emailcheck").focus();
                $("#emailcheck").css("color", "red");
                err_check_email = false;
                return false;
                $("#emailcheck").hide();
            } else {

                $("#emailcheck").hide();
            }
        }
        //validate password
        $("#password").blur(function () {
            check_passd();
        });
        $("#validatefrm").click(function () {
            check_passd();
        });

        function check_passd() {
            var passd_val = $("#password").val();
            if ((passd_val.length == "") || (passd_val.length < 6)) {
                $("#passwordcheck").show();
                $("#passwordcheck").focus();
                $("#passwordcheck").css("color", "red");
                err_check_psw = false;
                return false;
            } else {
                $("#passwordcheck").hide();
            }
        }
        //validate conforme pass
        $("#confirm_password").blur(function () {
            check_cmfpassd();
        });
        $("#validatefrm").click(function () {
            check_cmfpassd();
        });

        function check_cmfpassd() {
            var cmfpassd_val = $("#confirm_password").val();
            var passd_val = $("#password").val();
            if (cmfpassd_val.length != passd_val.length) {

                $("#cmfpascheck").show();
                $("#cmfpascheck").focus();
                $("#cmfpascheck").css("color", "red");
                err_check_cmfpsd = false;
                return false;
            } else {
                if (cmfpassd_val!= passd_val) {
                    $("#cmfpascheck").show();
                $("#cmfpascheck").focus();
                $("#cmfpascheck").css("color", "red");
                err_check_cmfpsd = false;
                return false;
                }
                else
                {
                    $("#cmfpascheck").hide();
                return true;
                }
                
            }
        }

        $("#validatefrm").click(function () {
            err_check = true;
            err_check_email = true;
            err_check_psw = true;
            err_check_cmfpsd = true;
            check_firstname();
            check_email();
            check_passd();
            check_cmfpassd();
            if ((err_check == true)) {
                return true;
            } else {
                return false;
            }
        });
    });

</script>


//Validation Form Personal Information
<script>
    $(document).ready(function () {
        $("#citycheck").hide();
        $("#phcheck").hide();
        $("#homephcheck").hide();
        $("#jobhistory").hide();
        $("#filecheck").hide();

        var err_city = true;
        var err_ph = true;
        var err_home_ph = true;
        var err_jobhistory = true;
        var err_file = true;
        var err_state = true;



        //Validation City
        $("#city").blur(function () {
            check_loc();
        });
        $("#validatefrm").click(function () {
            check_loc();
        });

        function check_loc() {
            var loc_val2 = $("#city").val();
            if (loc_val2 == "") {
                $("#citycheck").show();
                $("#citycheck").focus();
                $("#citycheck").css("color", "red");
                err_city = false;
                return false;
            } else {
                $("#citycheck").hide();
            }
        }
        //validate mobile Phone
        $("#mobile_number").blur(function () {
            check_phone();
        });
        $("#validatefrm").click(function () {
            check_phone();
        });

        function check_phone() {

            var ph_val = $("#mobile_number").val();
            var phoneno = new RegExp(/^[0-9-+]+$/);
            if (ph_val !="") {
                $("#phcheck").hide();
            } else {
                $("#phcheck").show();
                $("#phcheck").focus();
                $("#phcheck").css("color", "red");
                err_ph = false;
                return false;
            }
        }
        //validate Home Phone
        $("#phone").blur(function () {
            check_home_phone();
        });
        $("#validatefrm").click(function () {
            check_home_phone();
        });

        function check_home_phone() {

            var home_ph_val = $("#phone").val();
            var home_phoneno = new RegExp(/^[0-9-+]+$/);
            if (home_ph_val != "") {
                
                    $("#homephcheck").hide();
                } 
                else 
                {
                    $("#homephcheck").show();
                    $("#homephcheck").focus();
                    $("#homephcheck").css("color", "red");
                    err_home_ph = false;
                    return false;
                }
            // } else {
            //     err_home_ph = true;
            //     $("#homephcheck").hide();
            //     return false;
            // }
        }
        //validate Jobs History
        $("#jobs_history").blur(function () {
            check_jobhistory();
        });
        $("#validatefrm").click(function () {
            check_jobhistory();
        });

        function check_jobhistory() {

            var jobhistory_val = $("#jobs_history").val();
            if (jobhistory_val == "") {
                $("#jobhistory").show();
                $("#jobhistory").focus();
                $("#jobhistory").css("color", "red");
                err_jobhistory = false;
                return false;
            } else {
                $("#jobhistory").hide();
            }
        }
        // //validate file upload
        // $("#profile_image").change(function () {
        //     check_file();
        // });
        // $("#validatefrm").click(function () {
        //     check_file();
        // });

        // function check_file() {

        //     var file_val = $("#profile_image").val();
        //     var ext = file_val.split('.').pop();
        //     if (ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png") {
        //         $("#profile").hide();
        //     } else {
        //         $("#profile").show();
        //         $("#profile").focus();
        //         $("#profile").css("color", "red");
        //         err_file = false;
        //         return false;
        //     }
        // }
        //validate state
        $("#validatefrm").click(function () {
            check_state();
        });

        function check_state() {

            var state_val = $("#state").val();
            if (state_val == "") {
                $("#statemsg").show();
                $("#statemsg").focus();
                $("#statemsg").css("color", "red");
                err_jobhistory = false;
                return false;
            } else {
                $("#statemsg").hide();
            }
        }

        $("#validatefrm").click(function () {
            // err_file = true;
            err_ph = true;
            err_home_ph = true;
            err_city = true;
            err_jobhistory = true;
            err_state = true;
            err_check_cmfpsd=true;
            err_check_psw=true;
            // check_file();
            check_phone();
            check_home_phone();
            check_loc();
            check_state();
            check_cmfpassd();
            check_passd();
            // if ((err_ph == true) && (err_home_ph == true) && (err_city == true) && (err_file == true) &&
            //     (err_jobhistory = true) && (err_state = true)) {
            if ((err_ph == true) && (err_check_cmfpsd== true) && (err_check_psw==true) && (err_home_ph == true) && (err_city == true) && (err_jobhistory = true) && (err_state = true)) {
                return true;
            } else {
                return false;
            }
        });
    });

</script>
<script>
    $("#phcheck").hide();

    function phoneMask() {
        var num = $(this).val().replace(/\D/g, '');
        if ($(this).val(num.substring(0, 3) + '-' + num.substring(3, 6) + '-' + num.substring(6, 10))) {

        } else {

            $("#phcheck").show();
        }
    }
    $('#mobile_number').keypress(phoneMask);

    $("#homephcheck").hide();

    function phoneMask() {
        var num = $(this).val().replace(/\D/g, '');
        if ($(this).val(num.substring(0, 3) + '-' + num.substring(3, 6) + '-' + num.substring(6, 10))) {

        } else {
            $("#homephcheck").show();
        }
    }
    $('#phone').keypress(phoneMask);

</script>
</body>

</html>
