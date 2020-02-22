 <!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft"><br>
                    <!--- Divider -->
      <div id="sidebar-menu">
            <ul>
                 <!--<li><a href="{{url('indexjobseeker')}}" class="waves-effect"><i class="md md-home"></i><span> Dashboard </span></a></li>-->
                <li><a href="{{url('employer/dashboard')}}" class="waves-effect"><i class="fa fa-home"></i><span>  Dashboard </span></a></li>
                <li><a href="{{url('employer/posted_jobs')}}" class="waves-effect"><i class="fa fa-briefcase" aria-hidden="true"></i><span> Jobs</span></a></li>
                <li><a href="{{url('employer/Application')}}" class="waves-effect"><i class="fa fa-files-o"></i><span> Applications </span></a></li>
                <li><a href="{{url('employer/search_resume')}}" class="waves-effect"><i class="fa fa-user-plus"></i><span> Candidates </span></a></li>
                <!--<li><a href="{{url('employer/dashboard')}}" class="waves-effect"><i class="fa fa-users"></i><span> Indeed Jobs </span></a></li>-->
                <!--<li><a href="{{url('employer/report')}}" class="waves-effect"><i class="fa fa-tasks"></i><span> Reports</span></a></li>-->
<?php $id=Session::get('user_id');
$name=Session::get('full_name');
?>
                <li class="has_sub">
                    <a href="#" class="waves-effect subdrop"><i class="md md-book"></i><span><span> Reports</span><span class="pull-right"><i class="md md-remove"></i></span></a>
                    <ul class="list-unstyled" style="display: block;">
                        <li><a href="{{url('employer/all_report')}}"><i class="md md-bookmark"></i>View Report</a></li>
                        <li><a href="{{url('employer/manageteammember/team_members_view/send_report/'.$id.'/'.$name)}}"><i class="md md-bookmark"></i>Send Report</a></li>
                        <li><a href="{{url('employer/dashboard/report_graph')}}"><i class="md md-bookmark"></i>Graph Report</a></li>
                        @if(Session::get('type') !== 'teammember')
                        <li><a href="{{url('employer/dashboard/team_all_report')}}" style="font-size:12px;"><i class="md md-bookmark"></i>Team & Group Report</a></li>
                        @endif
                    </ul>
                </li>                 
            </ul>
        </div>
    </div>
</div>

            <!-- Left Sidebar End --> 