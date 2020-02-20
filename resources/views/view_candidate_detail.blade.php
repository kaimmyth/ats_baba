@include('include.emp_header')
@include('include.emp_leftsidebar')
<style>
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

    .alert-success {
        background-color: #ffffff;
        border-color: #29b6f6;
        color: #ffffff;
    }

    .alert-dismissible .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: .75rem 1.25rem;
        color: black;
    }

    .card-title {
        font-size: 17px;
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 0;
        margin-top: 0;
        text-transform: capitalize;
    }

    .fa fa-user {
        font-size: 55px;
        margin-left: 3%;
        color: #1ba6df;

    }

    #wrapper {
        overflow: hidden;
        width: 100%;
        overflow-y: scroll;
    }

    .modal .modal-dialog .modal-content .modal-header {
        border-bottom-width: 0px;
        margin: 3px;
        padding: 9px;
        padding-bottom: 0px;
        background: #dadada;
        height: 46px;
        width: 100%;
    }

    input[type=text],
    textarea
        {
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        outline: none;
        margin: 5px 1px 3px 0px;
        border: 1px solid #DDDDDD;
        background: #fff;

    }

    input[type=text]:focus,
    textarea:focus {
        -moz-box-shadow: 0 0 5px #51cbee;
        -webkit-box-shadow: 0 0 5px #51cbee;
        box-shadow: 0 0 5px #51cbee;

        border: 1px solid #51cbee;
    }

    .card .card-header {
        padding: 10px 20px;
        border: none;
    }
</style>

<div class="content-page">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                        <div class="card-header bg-info">
                        <p style="font-size:18px;text-align:center;color:white;text-transform: uppercase;" class="mt-2">{{$toReturn['job_seeker']['first_name']}} {{$toReturn['job_seeker']['middle_name']}} {{$toReturn['job_seeker']['last_name']}}</p>
                            </div>
                    <div class="card-header mt-2" style="  background-color:#317eeb;">
                        <form action="{{url('employer/seeker/resume_update')}}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            <h3 class="card-title" style="float:left; color:#fff; font-size:large;font-weight:400; text-transform: capitalize;">
                                CV Manager<a href="#" id="select_doc" style="color:#fff; float:right; margin-left:10em;">Upload File <i class="fa fa-upload" style="font-size:20px;color:#fff;"></i> </a>
                                <input type="file" id="Upload_cv" name="Upload_cv" style="display:none;">
                                <input type="hidden" name="seeker_id" value="{{$toReturn['job_seeker']['ID']}}">
                               <input type="submit"  onclick="return appers();" name="seeker_resume" id="seeker_update" value="Update" class="btn btn-primary">
                            </h3>
                        </form>
                    </div>
                    <div class="card-body" style="height:200px;">
                        @if(!empty($toReturn['job_seeker']['cv_file']))
                        <div class="alert alert-success alert-dismissible">
                        <input type="hidden" name="updatresume" value="{{$toReturn['job_seeker']['cv_file']}}"><a href="{{url('public/seekerresume/'.$toReturn['job_seeker']['cv_file'])}}">{{$toReturn['job_seeker']['cv_file']}}</a>
                            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        </div>
                        @endif
                        @if(!empty($toReturn['job_seeker']['otherdocuments1']))
                        <div class="alert alert-success alert-dismissible">
                            <input type="hidden" name="otherdocuments1" value="{{$toReturn['job_seeker']['otherdocuments1']}}"><a href="{{url('public/seekerresume/'.$toReturn['job_seeker']['otherdocuments1'])}}">{{$toReturn['job_seeker']['otherdocuments1']}}</a>
                            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        </div>
                        @endif
                        @if(!empty($toReturn['job_seeker']['otherdocuments2']))
                        <div class="alert alert-success alert-dismissible">
                            <input type="hidden" name="otherdocuments2" value="{{$toReturn['job_seeker']['otherdocuments2']}}"><a href="{{url('public/seekerresume/'.$toReturn['job_seeker']['otherdocuments2'])}}">{{$toReturn['job_seeker']['otherdocuments2']}}</a>
                            <!--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-border card-primary" style="width:100%;">
                    <div class="card-header" style="margin-bottom:-1em;">
                    </div>
                    <div class="card-body">
                        <div class="col-md-6" style="float:left;">
                            <!-- <form method="post" id="upload_form" action="{{url('jobseeker/edit_jobseeker/upload_photo')}}" enctype="multipart/form-data">
									<i class="fa fa-user"></i>
									<img src="{{URL::asset('public/profile_pic/'.$toReturn['job_seeker']['photo'])}}" height="100" width="100">
										<i class="fa fa-upload" style="margin-top:15%;color:#1ba6df"></i>
								       <a href="#" id="select_image">Upload File</a> <input type="file" id="Upload_image" name="Upload_image" style="display:none;">
								</form> -->
                        </div>
                        <div class="col-md-6" style="float:right;">
                            <form class="form-horizontal">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td><i class="fa fa-mobile" style="font-size:15px" color:"#317eeb";></i>&nbsp;&nbsp;&nbsp;{{$toReturn['job_seeker']['mobile']}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-envelope" style="font-size:15px" color:"#317eeb";></i>&nbsp;&nbsp;&nbsp;{{$toReturn['job_seeker']['email']}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-map-marker" style="font-size:15px" color:"#317eeb";></i>&nbsp;&nbsp;&nbsp;{{$toReturn['job_seeker']['city']}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-flag" style="font-size:15px" color:"#317eeb";></i>&nbsp;&nbsp;&nbsp;{{$toReturn['job_seeker']['state']}}</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-map-marker" style="font-size:15px" color:"#317eeb";></i>&nbsp;&nbsp;&nbsp;{{$toReturn['job_seeker']['country']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <!--card body -->
                </div>
                <!--end of card-->
            </div>
            <!--end of col-->
        </div>
        <!--end of row-->

        <div class="row">

            <div class="col-md-6" style="float:left;">
                <div class="card card-border card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-primary" style="float:left;">Extra Document</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <!-- <thead>
                    <th></th>
                    </thead> -->
                            <tbody>
                                @foreach($toReturn['extra_doc'] as $extra_doc)
                                <tr>
                                    <td><a href="{{url('public/forward_document/'.$extra_doc['file_name'])}}">{{$extra_doc['file_name']}}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="float:left;">
                <div class="card card-border card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-primary" style="float:left;">Experience</h3>
                        <!-- <h3 style="float:right;"><button type="button" class="btn btn-info" data   -toggle="modal" data-target=".bs-example-modal-sm">Add Another &nbsp; <i class="fa fa-plus-square" style="font-size:15px;color:#fff" aria-hidden="true"></i></button></h3> -->
                    </div>
                    <div class="card-body">
                        @if(@$toReturn['experience'])
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Company Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>City</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($toReturn['experience'] as $experience)
                                <tr>
                                    <th>{{$experience['job_title']}}</th>
                                    <th>{{$experience['company_name']}}</th>
                                    <th>{{$experience['start_date']}}</th>
                                    <th>{{$experience['end_date']}}</th>
                                    <th>{{$experience['city']}}</th>
                                    <th>{{$experience['country']}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <!--end of row-->

            <div class="row">

            </div>
            <div class="col-md-6" style="float:left;">
                <div class="card card-border card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-primary" style="float:left;">My Job Application</h3>
                    </div>
                    <div class="card-body">
                        @if(@$toReturn['job_details'])
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Job Code</th>
                                    <th>Owner Id</th>
                                    <th>Client Name</th>
                                    <th>City</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($toReturn['job_details'] as $key=>$value)
                                <?php $owner_name = DB::table('tbl_team_member')->where('ID', $toReturn['job_details'][$key]['owner_id'])->orWhere('full_name', $toReturn['job_details'][$key]['owner_id'])->first();
                                // print_r($owner_name);
                                // exit;
                                ?>
                                <tr>
                                    <th>{{$toReturn['job_details'][$key]['job_title']}}</th>
                                    <th>{{$toReturn['job_details'][$key]['job_code']}}</th>
                                    <th>{{$owner_name->full_name}}</th>
                                    <th>{{$toReturn['job_details'][$key]['client_name']}}</th>
                                    <th>{{$toReturn['job_details'][$key]['city']}}</th>
                                    <th>{{$toReturn['job_details'][$key]['state']}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <a href="{{url('employer/Application')}}">View All/Manage</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="float:left;">
                <div class="card card-border card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-primary" style="float:left;">Education</h3>
                        <!-- <h3 style="float:right;"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#con-close-modal">Add Another &nbsp; <i class="fa fa-plus-square" style="font-size:15px;color:#fff;" aria-hidden="true"></i></button></h3>													 -->
                    </div>
                    <div class="card-body">
                        @if(@$toReturn['academic'])
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Degree Title</th>
                                    <th>Major</th>
                                    <th>Institude</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Completion_year</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($toReturn['academic'] as $academic)
                                <tr>
                                    <th>{{$academic['degree_title']}}</th>
                                    <th>{{$academic['major']}}</th>
                                    <th>{{$academic['institude']}}</th>
                                    <th>{{$academic['country']}}</th>
                                    <th>{{$academic['city']}}</th>
                                    <th>{{$academic['completion_year']}}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end of row-->


    </div>
    <!--end of content-->
</div>
<!--end of content-page-->




<!-- start of Experience modal-->
<!-- start of Experience modal-->
<div id="bs-example-modal-sm" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Experience Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{URL::to('admindashboard/addexp')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="seeker_ID" name="seeker_ID" placeholder="Seeker ID" value="{{$toReturn['job_seeker']['ID']}}" style="border: 1px #d6d6d6 solid; background:#fff;"> <br>
                                <label for="job_title" class="control-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name" class="control-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsibilities" class="control-label">Responsibilities</label>
                                <input type="text" class="form-control" id="responsibilities" name="responsibilities" placeholder="Responsibilities" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country" class="control-label">Country</label>
                                <select class="form-control" name="country" id="country">
                                    <option value="" selected>Select Country</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albany">Albany</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burma">Burma</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verd">Cape Verd</option>
                                    <option value="Central Africa">Central Africa</option>
                                    <option value="Chadi">Chadi</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Columbia">Columbia</option>
                                    <option value="Comora">Comora</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuban">Cuban</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="Yemen">Yemen</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="city" class="control-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="city" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="datea" class="control-label">Start Date</label>
                                <input type="date" class="form-control" id="datea" name="datea" placeholder="Start Date" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dateb" class="control-label">End Date (Keep blank if steel working)</label>
                                <input type="date" class="form-control" id="dateb" name="dateb" placeholder="End Date" style="border: 1px #d6d6d6 solid; background:#fff;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
            </div>
        </div>
        </form>
    </div><!-- /.modal -->
</div>


<div class="modal fade " id="con-close-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0" id="Education Information">Education Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{URL::to('admindashboard/addedu')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="seeker_ID_edu" name="seeker_ID_edu" placeholder="Seeker ID" style="border: 1px #d6d6d6 solid background:#fff;"> <br>
                                <label for="degree" class="control-label" style="margin-left: 1em;">Degree Level</label>

                                <select class="form-control" name="degree_level" id="degree_level">
                                    <option value="" selected>Select Degree Level</option>
                                    <option value="Bechelores">Bechelores</option>
                                    <option value="Masters">Masters</option>
                                </select>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="degree_title" class="control-label" style="margin-left: 1em;">Degree Title</label>
                                        <input type="text" class="form-control" id="degree_title" name="degree_title" placeholder="Degree Title" style="border: 1px #d6d6d6 solid; background:#fff;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="major" class="control-label" style="margin-left: 1em;">Major Subject</label>
                                        <input type="text" class="form-control" id="major" name="major" placeholder="Major Subject" style="border: 1px #d6d6d6 solid; background:#fff;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="institute" class="control-label" style="margin-left: 1em;">Name of the Institute</label>
                                        <input type="text" class="form-control" id="institute" name="institute" placeholder="Name of the Institute" style="border: 1px #d6d6d6 solid; background:#fff;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country" class="control-label" style="margin-left: 1em;">Country</label>
                                        <select class="form-control" name="country_edu" id="country_edu">
                                            <option value="" selected>Select Country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albany">Albany</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burma">Burma</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verd">Cape Verd</option>
                                            <option value="Central Africa">Central Africa</option>
                                            <option value="Chadi">Chadi</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Columbia">Columbia</option>
                                            <option value="Comora">Comora</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuban">Cuban</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Yemen">Yemen</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="city" class="control-label" style="margin-left: 1em;">City</label>
                                                <input type="text" class="form-control" id="city_edu" name="city_edu" placeholder="city" style="border: 1px #d6d6d6 solid; background:#fff;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="completion_year" class="control-label" style="margin-left: 1em;">Completion Year</label>
                                                <select class="form-control" id="completion_year" name="completion_year">
                                                    <option value="" selected>Completion year</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                </select>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                            </div>
                </form>
            </div>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


</div> <!-- card body -->
</div> <!-- card -->
</div> <!-- row -->
</div> <!-- container -->
</div>
</form>
</div>

@include('include.emp_footer')
<script type="text/javascript">
    $("#Upload_cv").css('display', 'none');

    $("#select_doc").click(function(e) {
        e.preventDefault();
        $("#Upload_cv").trigger('click');
    });
</script>
<script type="text/javascript">
    $("#Upload_image").css('display', 'none');

    $("#select_image").click(function(e) {
        e.preventDefault();
        $("#Upload_image").trigger('click');
    });
</script>


<script>
$("#seeker_update").click(function(){
    appers();

if($Upload_cv == ""){
    alert("please select upload file");
}  else {
alert("select file");
 }
});
</script>


<script>
    $(document).ready(function() {

        $('#upload_form').on('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{url('jobseeker/edit_jobseeker/upload_photo')}}",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    // $('#message').css('display', 'block');
                    // $('#message').html(data.message);
                    // $('#message').addClass(data.class_name);
                    // $('#uploaded_image').html(data.uploaded_image);
                }
            })
        });

    });
</script>

<!-- Ajax insertion -->
<!-- experience modal -->
<script>
    jQuery(document).ready(function() {
        jQuery('#insert_exp').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('jobseeker/dashboard/addexp') }}",
                method: 'post',
                data: {
                    seeker_ID: $('#seeker_ID').val(),
                    job_title: $('#job_title').val(),
                    company_name: $('#company_name').val(),
                    datea: $('#datea').val(),
                    dateb: $('#dateb').val(),
                    city: $('#city').val(),
                    country: $('#country').val(),
                    responsibilities: $('#responsibilities').val()
                },
                success: function(result) {
                    jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                }
            });
        });
    });
</script>
<!-- Education modal -->
<script>
    jQuery(document).ready(function() {
        jQuery('#insert_edu').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('jobseeker/dashboard/addedu') }}",
                method: 'post',
                data: {
                    seeker_ID: $('#seeker_ID_edu').val(),
                    degree_level: $('#degree_level').val(),
                    degree_title: $('#degree_title').val(),
                    major: $('#major').val(),
                    institute: $('#institute').val(),
                    country: $('#country_edu').val(),
                    city: $('#city_edu').val(),
                    completion_year: $('#completion_year').val()
                },
                success: function(result) {
                    jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                }
            });
        });
    });
</script>

<!-- Personal Summary modal -->
<script>
    $(document).ready(function() {
        jQuery('#note').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('jobseeker/dashboard/save/notes')}}",
                method: 'post',
                data: {
                    note: $('#notes').val(),
                    _token: $('#token').val()
                },
                success: function(data) {
                    console.log(data);
                    $("#show_summary").html(data.note);
                }
            });
        });
    });
</script>

</body>

</html>



@include('include.footers')