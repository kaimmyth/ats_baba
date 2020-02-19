@include('include.emp_header')
@include('include.emp_leftsidebar')

<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="{{url('jquery.simple-calendar.js')}}"></script> 
<link rel="stylesheet" type="text/css" href="{{url('simple-calendar.css')}}" /> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('assets/packages/core/main.css')}}" rel='stylesheet'>
<link href="{{url('assets/packages/bootstrap/main.css')}}" rel="stylesheet">
<link href="{{url('assets/packages/timegrid/main.css')}}" rel="stylesheet">
<link href="{{url('assets/packages/daygrid/main.css')}}" rel="stylesheet">
<link href="{{url('assets/packages/list/main.css')}}" rel="stylesheet">
<script src="{{url('assets/packages/core/main.js')}}"></script>
<script src="{{url('assets/packages/interaction/main.js')}}"></script>
<script src="{{url('assets/packages/bootstrap/main.js')}}"></script>
<script src="{{url('assets/packages/daygrid/main.js')}}"></script>
<script src="{{url('assets/packages/timegrid/main.js')}}"></script>
<script src="{{url('assets/packages/list/main.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css">


<style>
    .page-link {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        margin-bottom: 3em;
    }

    #wrapper {
        width: 100%;
        overflow-y: scroll;
    }

    table.dataTable thead>tr>th {
        /* padding-left: 8px;  */
        padding-right: 30px;
    }

    .table-bordered th {
        border-top: 4px solid #f5f5f5 !important;
        border-bottom: 4px solid #f5f5f5 !important;
        border-right: 4px solid #f5f5f5 !important;
        border-left: 4px solid #f5f5f5 !important;
        color: #000;
        font-size: 13px;
        padding: 0.5em;
    }

    .table td {
        padding: 0.10rem;
        font-size: 12px;
        padding-left: 1em;
        border-top: 4px solid #f5f5f5 !important;
        border-bottom: 4px solid #f5f5f5 !important;
        border-right: 4px solid #f5f5f5 !important;
        border-left: 4px solid #f5f5f5 !important;
        color: #000;

    }

    .card-title {
        font-size: 21px;
        font-weight: 100;
        color: #797979;
        margin-bottom: 0;
        margin-top: 0;
        text-transform: capitalize;
        letter-spacing: 1px;
    }
</style>
<div id="wrapper">
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-border card-primary">
                        <div class="card-header">
                            <h3 class="card-title text-primary" style="float:left;">Application</h3>
                            <button class="btn btn-info ml-5" onclick="location.href= {{url('employer/application')}}" type="button" style="float:left;" id="button-addon2" title="Show All Application"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                            <h6 style="float:right;">
                                <!--<input id="myInput" type="text" placeholder="Search" style="height: 31px; width: 100%; padding: 13px; border:1px solid #9d9d9d; border-radius: 2px;">-->
                                <form action="{{url('employer/Application/search_application')}}" method="get">
                                    @csrf
                                    <div class="input-group mb-3 mt-1" style="float:right;width:700px;">
                                        <input type="text" class="form-control" placeholder="Search Application ( Title , Code , Client , First Name , Middle Name , Last Name )" aria-label="Recipient's username" name="search" aria-describedby="button-addon2" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 col-sm-12 col-12">
                                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow-x:scroll;">

                                        <thead class="table-light" style="text-align:center;">
                                            <!--<tr>
                                                        <th colspan="6">Job Details</th>
                                                        <th colspan="3">Candidate Details</th>
                                                        <th>Submittal Date</th>

                                                    </tr>-->
                                            <tr>
                                                <th> Code</th>
                                                <th width="10%">Title</th>
                                                <th>Client</th>
                                                <th width="10%">Location</th>
                                                <th width="10%">Visa Type</th>
                                                <th width="10%">Pay Rate</td>
                                                <th>Name</td>
                                                <th width="10%">Location</th>
                                                <th>Visa</th>
                                                <th width="10%">Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach($toReturn['application'] as $application)
                                            <tr>
                                                <?php $id=$application['application_id'];
                                                        $job_id=$application['ID'];
                                                        $seeker_id=$application['seeker_id'];
                                                                         
                                                        ?>
                                                <td style="padding:5px;">{{$application['job_code']}}</td>
                                                <td><a href="{{url('employer/jobsdetails/'.$job_id)}}">{{$application['job_title']}}</a></td>
                                                <td>{{$application['job_client_name']}}</td>
                                                <td>@if($application['job_city']){{$application['job_city']}} ,@endif&nbsp;{{$application['job_state']}}</td>
                                                <?php $vis=$application['job_visa'];
                                                        $plus_visa=substr_count("$vis",",");
                                                        $sh=explode(",",$vis);
                                                        ?>
                                                <td onmouseover="visa_type({{$id}});" data-toggle="tooltip" title="{{$application['job_visa']}}"> {{$sh[0]}}@if($plus_visa!=0),&nbsp;+{{$plus_visa}}@endif<span id="data1{{$id}}"></span><span id="data2{{$id}}" style="display:none"></span></td>
                                                <td>{{$application['pay_min']}}-{{$application['pay_max']}}</td>
                                                <td><a href="{{url('employer/candidate/'.$seeker_id)}}">{{$application['can_first_name']}} {{$application['can_last_name']}}</td>
                                                <td>@if($application['seeker_city']){{$application['seeker_city']}},&nbsp;@endif{{$application['seeker_state']}}</td>
                                                <td>{{$application['can_visa']}}</td>
                                                <?php $applied_date=date('m-d-Y',strtotime($application['applied_date'])); ?>
                                                <td>{{$applied_date}}</td>
                                                <td>
                                                    <a  onclick="interviewModalfunction({{$id}})" ><i class="fa fa-clock-o" aria-hidden="true" title="Schedule Interview"></i></a>
                                                    <a href="{{url('employer/appli_del/'.$id)}}" class="hidden on-editing login-row" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                                                    <a href="{{url('employer/appli_forward/'.$id)}}"><i class="fa fa-arrow-right" title="Candidate Forward "></i></a>
                                                    <a href="{{url('employer/application_view/'.$id)}}"> <i class="fa fa-eye" aria-hidden="true" title="View  Application"></i></a>

                                                </td>
                                                
                                </div>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                                {{$toReturn['application']->links()}}
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div>
                <!--end card-->
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end row-->
</div>
</div>
<!-- Interview Section-->
<div class="modal fade" id="interviewModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Schedule Interview</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{url('employer/dashboard/interview_meeting/add')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date_interview" name="date_interview" required />
                    </div>
                    <div class="form-group">
                        <label for="email">Start Time</label>
                        <input id="srttime" class=" form-control timepicker1" name="start_time" type="time" required>
                    </div>
                    <div class="form-group">
                        <label for="email">End Time</label>
                        <input id="endtime" class="form-control timepicker2" name="end_time" type="time" required>
                        <div class="col-md-1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Interview Type</label>
                        <select class="form-control" name="type" id="type">
                            <option>Select Interview Type</option>
                            <option>Telephonic</option>
                            <option>Skype/video</option>
                            <option>In-Person</option>
                        </select>
                    </div>
                    <input type="hidden" id="application_id" name="application_id">
                    <div class="form-group">
                        <label for="email">Instruction</label>
                        <input type="text" class="form-control" id="" placeholder="" name="instruction">
                    </div>
                    <div class="form-group">
                        <label for="email">Time Zone</label>
                        <select class="form-control" name="time_zone">
                            <option value="">Time Zone</option>
                            <option>Eastern Time Zone(ET)</option>
                            <option>Pacific Time Zone(PT)</option>
                            <option>Central Time Zone(CT)</option>
                            <option>Indian Standard Time(IST)</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function interviewModalfunction(id)
{
$("#application_id").val(id);
$("#interviewModal").modal("show");
}
</script>

<script>
</script>

@include('include.emp_footer')

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $('#edit_modal_Category').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var category = button.data('category')
        var categoryid = button.data('categoryid')
        var modal = $(this)


        modal.find('.modal-body #category').val(category);
        modal.find('.modal-body #categoryid').val(categoryid);

    })
</script>


<script>
    function visa_type(id) {
        $("#data1" + id).hover(function () {
            $("#data1" + id).hide();
            $("#data2" + id).show();

        }, function () {
            $("#data2" + id).hide();
            $("#data1" + id).show();
        });
    }
</script>

</body>

</html>