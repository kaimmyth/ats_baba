@include('include.emp_header')
@include('include.emp_leftsidebar')
<div id="wrapper">
    <div class="content-page">
        <div class="content">
            <div class="row" style="margin-left: 1em;width: 121%;">
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-comments-o icon-rounded"></i>
                        <div class="stats">
                            <a href="{{url('employer/jobs-open-today')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Jobs Detail" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['one_day_job']}}Jobs</strong></h5>
                            <span>Open Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-tasks user1 icon-rounded"></i>
                        <div class="stats">
                            <a href="{{url('employer/application-received-today')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Application Details" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['today_application']}} Apps</strong></h5>
                            <span>Received Today !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-support user2 icon-rounded"></i>
                        <div class="stats">
                            <a href="{{url('employer/search_resume_published_today')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Resume Detail" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['today_resume']}} Resume</strong></h5>
                            <span>Published Today !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-share-alt dollar1 icon-rounded"></i>
                        <div class="stats">
                            <a href="{{url('employer/dashboard/interview-today')}}"><i class="fa fa-eye" id="interview" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Interview Details" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['today_interview']}} Interview</strong></h5>
                            <span>Happening Today !</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 widget">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-calendar dollar2 icon-rounded"></i>
                        <div class="stats">
                            <a href="{{url('employer/dashboard/meeting-today')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Meeting Details" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['today_meeting']}} Meeting</strong></h5>
                            <span>Happening Today !</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!-- End row--><br>
            <div class="row" style="margin-left: 1em;width: 121%;">
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-comments-o dollar1 icon-rounded" style="background: #f76834;"></i>
                        <div class="stats">
                            <a href="{{url('employer/posted_jobs')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Total Jobs Detail" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['total_job']}} Jobs</strong></h5>
                            <span>Total Jobs !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-file-word-o dollar1 icon-rounded" style="background: #8BC34A;"></i>
                        <div class="stats">
                            <a href="{{url('employer/search_resume')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Resume Details" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['total_resume']}} Resume</strong></h5>
                            <span>Total Submitted !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-check-circle dollar1 icon-rounded" style="background: #09c1b0;"></i>
                        <div class="stats">
                            <a href="{{url('employer/Application')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Application Details" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['total_application']}} Application</strong></h5>
                            <span> Total Applications !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-user-plus icon-rounded" style="background: #dc0202;"></i>
                        <div class="stats">
                            <a href="{{url('employer/dashboard/interview-meeting')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Total Interviews" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['tota_interview']}} Interviews</strong></h5>
                            <span>Total Interviews !</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-calendar dollar1 icon-rounded" style="background: #03A9F4;"></i>
                        <div class="stats">
                            <a href="{{url('employer/dashboard/interview-meeting')}}"><i class="fa fa-eye" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Total Meetings" style="float: right;"></i></a>
                            <h5><strong>{{$toReturn['total_meeting']}} Meetings</strong></h5>
                            <span>Total Meetings !</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--//header-ends -->


            <br>
            <div class="col-xl-12">
                <div class="card card-border card-info">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div id="accordion-test-2" class="card-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info" id="headingOne" style="margin-left: 10px;">
                                            <h5 class="m-0 card-title">
                                                <a href="#" class="collapsed" data-toggle="collapse" data-target="#myjob1" aria-expanded="false" aria-controls="collapseOne-2">Jobs by Publish Date</a></h5>
                                        </div>

                                        <div id="myjob1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-test-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:100;">Process</th>
                                                                        <th>{{$toReturn['date'][0]}}</th>
                                                                        <th>{{$toReturn['date'][1]}}</th>
                                                                        <th>{{$toReturn['date'][2]}}</th>
                                                                        <th>{{$toReturn['date'][3]}}</th>
                                                                        <th>{{$toReturn['date'][4]}}</th>
                                                                        <th>{{$toReturn['date'][5]}}</th>
                                                                        <th>{{$toReturn['date'][6]}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Assigned</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Work in Process</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Covered Jobs</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Jobs</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][0]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][1]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][2]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][3]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][4]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][5]}}</td>
                                                                        <td>{{$toReturn['Publish_DatejobCount'][6]}}</td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end of table-->
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <!--end of col-->
                                            </div>
                                            <!--end of card body-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info" id="headingOne" style="margin-right: 10px;">
                                            <h5 class="m-0 card-title">
                                                <a href="#" class="collapsed" data-toggle="collapse" data-target="#myjob2" aria-expanded="false" aria-controls="collapseOne-2">Jobs by Closing Date</a></h5>
                                        </div>

                                        <div id="myjob2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion-test-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="datatable2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" ;>
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width:100;">Process</th>
                                                                        <th>{{$toReturn['date'][0]}}</th>
                                                                        <th>{{$toReturn['date'][1]}}</th>
                                                                        <th>{{$toReturn['date'][2]}}</th>
                                                                        <th>{{$toReturn['date'][3]}}</th>
                                                                        <th>{{$toReturn['date'][4]}}</th>
                                                                        <th>{{$toReturn['date'][5]}}</th>
                                                                        <th>{{$toReturn['date'][6]}}</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Assigned</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td>Work in Process</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Covered Jobs</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Total Jobs</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][0]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][1]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][2]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][3]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][4]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][5]}}</td>
                                                                        <td>{{$toReturn['close_DatejobCount'][6]}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end of card body-->
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info" id="headingThree" style="margin-left: 10px;">
                                            <h5 class="m-0 card-title">
                                                <a href="#" class="collapsed" data-toggle="collapse" data-target="#myjob3" aria-expanded="false" aria-controls="collapseThree-2">
                                                    Calendar: Next Interviews
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="myjob3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion-test-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;" ;>
                                                                <thead>
                                                                    <tr>

                                                                        <th>Date</th>
                                                                        <th>Time</th>
                                                                        <th>Job Code</th>
                                                                        <th>Candidate Name</th>
                                                                        <th>Type</th>
                                                                        <th>Time Zone</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($toReturn['interview'] as $interview)
                                                                    <tr>
                                                                        <?php $interview_date=$interview['interview_date']; 
                                                                                            $new_date = date("m-d-Y", strtotime($interview_date)); 
                                                                                            @$data_time = DB::table('tbl_time_zone')->where('time_zone_name',$interview['time_zone'])->first();
                                                                                            $static_time = @$data_time->change_time;
                                                                                            $cal_value = @$data_time->cal_value;
                                                                                            if($cal_value == "+"){
                                                                                                $secs = strtotime($interview['from_time'])-strtotime("00:00");
                                                                                                $result = date("H:i A",strtotime($static_time)+$secs);
                                                                                            }
                                                                                            else{
                                                                                                $secs = strtotime($interview['from_time'])-strtotime("00:00");
                                                                                                $result = date("H:i A",strtotime($static_time)-$secs);
                                                                                            }
                                                                                    ?>
                                                                        <td>{{$new_date}}</td>
                                                                        <td>{{$result}}</td>
                                                                        <td>{{$interview['job_ID']}}</td>
                                                                        <td>{{$interview['candiate_name']}}</td>
                                                                        <td>{{$interview['interview_type']}}</td>
                                                                        <td>{{$interview['time_zone']}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end of card body-->
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-info" id="headingThree" style="margin-right: 10px;">
                                            <h5 class="m-0 card-title">
                                                <a href="#" class="collapsed" data-toggle="collapse" data-target="#myjob4" aria-expanded="false" aria-controls="collapseThree-2">
                                                    Calendar: Next Meetings
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="myjob4" class="collapse" aria-labelledby="headingThree" data-parent="#accordion-test-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date</th>
                                                                        <th>Time</th>
                                                                        <th>Subject</th>
                                                                        <th>Participant</th>
                                                                        <th>Time Zone</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($toReturn['meeting'] as $meeting)
                                                                    <?php 
                                                                                            $meeting_date=$meeting['dated']; 
                                                                                            $new_date = date("m-d-Y", strtotime($meeting_date)); 
                                                                                            $data_time = DB::table('tbl_time_zone')->where('time_zone_name',$meeting['timezone'])->first();
                                                                                            $static_time = $data_time->change_time;
                                                                                            $cal_value = $data_time->cal_value;
                                                                                            if($cal_value == "+"){
                                                                                                $secs = strtotime($meeting['meeting_time'])-strtotime("00:00");
                                                                                                $result = date("H:i A",strtotime($static_time)+$secs);
                                                                                            }
                                                                                            else{
                                                                                                $secs = strtotime($meeting['meeting_time'])-strtotime("00:00");
                                                                                                $result = date("H:i A",strtotime($static_time)-$secs);
                                                                                            }
                                                                                ?>
                                                                    <tr>
                                                                        <td>{{$new_date}}</td>
                                                                        <td>{{$result}}</td>
                                                                        <td>{{$meeting['subject']}}</td>
                                                                        <td>{{$meeting['participants']}}</td>
                                                                        <td>{{$meeting['timezone']}}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end of table-->
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <!--end of row-->
                                            </div>
                                            <!--end of card body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end of content-->
</div>
<!--end of content-page-->
</div>
<!--end of wrapper-->



<script>
    var resizefunc = [];
</script><br><br>
@include('include.emp_footer')
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