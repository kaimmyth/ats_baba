<!DOCTYPE html>
<html lang="en">
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
<style>
    .form-control {
        border: 1px solid #737373;
        width: 84%;
    }

    .active,
    .btn:hover {
        background-color: #000000;
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

    .content-page {
        overflow: hidden;
        width: 100%;
    }

    .content-page>.content {
        margin-bottom: 60px;
        margin-top: 0px;
        padding: 20px 10px 15px 10px;
    }

    .element {
        background: #fff;
        width: 100% height: 100%;

    }

    .formwraper {
        margin-bottom: 20px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px 5px 0 0;
        width: 100%;
    }

    .jobdescription {
        border: 1px solid #ddd;
    }

    .jobdescription .skillBox {
        padding: 5px;
        border: 1px solid #ddd;
        font-size: 13px;
        line-height: 18px;
    }

    .input-group-addon {
        padding: 6px 15px;
        font-size: 14px;
        font-weight: 400;
        color: #ffffff;
        text-align: center;
        background-color: #29b6f6;
    }

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

    label {
        font-weight: 200;
        font-family: inherit;
        font-size: 15px;
    }


    input[type=text] {
        width: 83%;
        padding: 7px;
        border-radius: 5px;
    }

    textarea {
        border-radius: 5px;
        width: 48%;
    }
</style>
<div class="content-page">
    <div class="content"> <br><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border: 1px #C0C0C0 solid; width: 87%;">
                    <div class="card-header" style="background-color: #317eeb;">
                        <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large">Report</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('genrate/report')}}" method="post">
                            @csrf()
                            <div class="row">
                              <div class="col-sm-3">
                                  <label class="form-group">Type</label>
                                <select class="form-control form-control-lg" name="type" onchange="get_team_details(this);" required>
                                    <option value="">--select--</option>
                                    <option value="1">Group</option>
                                    <option value="2">Individual</option>
                                </select>
                              </div>
                              <div class="col-sm-3">
                                <label class="form-group">Team</label>
                              <select class="form-control form-control-lg" id="team" name="team" onchange="get_team_member_details(this);" required> 
                                  <option value="">--select--</option>
                              </select>
                            </div>
                            <div class="col-sm-3" id="team_member_div">
                                <label class="form-group">Team Member</label>
                              <select class="form-control form-control-lg" name="team_member" id="team_member">
                                <option value="">--select--</option>

                              </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-group">Status</label>
                              <select class="form-control form-control-lg" name="status" onchange="get_date(this)" required>
                                    <option value="">--select--</option>
                                  <option value="1">Daily</option>
                                  <option value="2">Weekly</option>
                                  <option value="3">Monthly</option>
                              </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="form-group">Date</label>
                              <select class="form-control form-control-lg" name="data_interval" id="data_interval"  required>
                                    <option value="">--select--</option>
                                  
                              </select>
                            </div>
                            <div class="col-sm-3" style="margin-top:50px;">
                                <button class="btn btn-primary">Genrate Report</button>
                            </div>
                            <div class="col-sm-3" style="margin-top:50px;">
                                <a href="{{url('employer/all_report')}}"><span class="btn btn-primary">Back</span></a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if(@$post_assign!="")
                <div class="card" style="border: 1px #C0C0C0 solid; width: 87%;">
                    <div class="card-header" style="background-color: #317eeb;">
                        <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large">Individual Report</h3>
                    </div>
                    <div class="card-body">
                        <style>
                        </style>
                        @if(@$team_member_id!="")
                        @php
                        $team_member_details_name=DB::table('tbl_team_member')->where('ID',$team_member_id)->first();
                        @endphp
                        <h3>{{@$team_member_details_name->full_name}} </h3>
                        @else
                        @php
                       $tbl_team_member_type_details= DB::table('tbl_team_member_type')->where('type_ID',$team_id)->first();
                       @endphp
                       <h3>{{@$tbl_team_member_type_details->type_name}} </h3>
                        @endif
                        <h4>Assigned Jobs</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                <th>SI No.</th>
                                <th>Date</th>
                                <th>Team Memeber Name</th>
                                <th>Job Code</th>
                                <th>Job Title</th>
                                <th>No. Of Client Submittal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $si_no=1; @endphp
                                @foreach($post_assign as $key_post=>$value_post)
                                    @foreach($value_post as $key_temp=>$value_temp)
                                        <tr>
                                            <td>{{$si_no++}}</td>
                                            <td>{{$value_temp['job_assigned_date']}}</td>
                                            <td>{{$value_temp['full_name']}}</td>
                                            <td>{{$value_temp['job_code']}}</td>
                                            <td>{{$value_temp['job_title']}}</td>
                                            <td>@php 
                                                foreach($toReturn[$key_post]['total_resume_submittal'] as $key=>$value)
                                                {
                                                    if($key==$value_temp['Job_id'])
                                                    {
                                                        echo $value;
                                                    }
                                                }
                                                @endphp</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>




@include('include.emp_footer')
<script>
 
   function get_team_details(e)
    {
        $("#team").html("");
        var type_id=$(e).val();
        if(type_id==1){
            $("#team_member_div").css('display','none');
        }
        else
        {
            $("#team_member_div").css('display','block');
        }
        $.ajax({
            type: 'get',
            url: '{{url("employer/report/get_team_details")}}' + "/" + type_id,
            success: function(data) {
                console.log(data);
                var append="";
                append+="<option value=" + '""' +
                        ">--select--</option>";
                $.each(data, function(index, value) {
                    append+="<option value=" + '"' + value.type_ID + '"' +
                        ">" + value.type_name + "</option>";
                });
                $("#team").append(append);

            },
        });
    }
    // });
</script>
<script>
// $( document ).ready(function() {
    function get_team_member_details(e)
    {
        var team_id=$(e).val();
        $("#team_member").html("");
        $.ajax({
            type: 'get',
            url: '{{url("employer/report/get_team_member_details")}}' + "/" + team_id,
            success: function(data) {
                console.log(data);
                var append="";
                append+="<option value=" + '""' +
                        ">--select--</option>";
                $.each(data, function(index, value) {
                    append+="<option value=" + '"' + value.ID + '"' +
                        ">" + value.full_name + "</option>";
                });
                $("#team_member").append(append);

            },
        });
    }
// });
</script>
<script>
    function get_date(e)
    {
    var  status=$(e).val();
    // alert(status);
    $("#data_interval").html("");

    $.ajax({
            type: 'get',
            url: '{{url("employer/report/get_date")}}' + "/" + status,
            success: function(data) {
                console.log(data.date_d);
                var append="";
                // for()
                append+="<option value=" + '""' +
                        ">--select--</option>";
                $.each(data.date_d, function(index, value) {
                    append+="<option value=" + '"' + value+ '"' +
                        ">" + value+ "</option>";
                });
                $("#data_interval").append(append);

            },
        });
    }
</script>

</body>

</html>