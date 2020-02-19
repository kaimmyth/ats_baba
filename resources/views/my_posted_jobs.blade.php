<meta name="csrf-token" content="{{ csrf_token() }}">
@include('include.emp_header')
@include('include.emp_leftsidebar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<style>
    .mini-stat-info span {
        color: #ffffff;
        display: block;
        font-size: 21px;
        font-weight: 500;
    }

    .card .card-header {
        padding: 10px 20px;
        border: none;
        background: #317eeb;
        ;
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

    .social {
        margin-left: 13%;
    }

    #wrapper {
        width: 100%;
        overflow-y: scroll;
    }

    table.dataTable thead>tr>th {
         padding-left: 8px;  padding-right: 30px;
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

    .card .card-header {
        padding: 10px 20px;
        /* border: none; */
        background: #fff;
        color: #fff;
    }

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
</style>
<div id="wrapper">
    <div class="content-page">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-border card-primary">
                        <div class="card-header">
                            <!--<input id="search" type="text" placeholder="Search" class="form-control" style="float:right;width:350px;border-radius:20px;height:30px;border:none;margin-top:2px;">-->
                            <form action="{{url('employer/posted_jobs/search')}}" method="get">
                                @csrf
                                <div class="input-group mb-3 mt-1" style="float:right;width:500px;">
                                    <input type="text" class="form-control" placeholder="Search Jobs ( title , code )" aria-label="Recipient's username" name="search" aria-describedby="button-addon2" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                                    </div>
                                </div>
                            </form>
                            @if(!empty($toReturn['user_type']=="teammember"))
                            @if($toReturn['current_module_permission']['is_add']=="yes")
                            <a href="{{url('employer/post_new_job')}}">
                                <button type="button" class="btn btn-info" style="float:left;">Add a Job</button></a>
                            @endif
                            @else
                            <a href="{{url('employer/post_new_job')}}">
                                <button type="button" class="btn btn-info" style="float:left;">Add a Job</button></a>
                            @endif
                            <a href="{{url('employer/posted_jobs')}}">
                                <button type="button" class="btn btn-primary ml-3 " style="float:left;padding:10px" title="Show all jobs"><i class="fa fa-repeat" aria-hidden="true"></i></button></a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <table class="table table-bordered table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; overflow-x:scroll;">
                                        <thead style="text-align:center;">
                                            <tr style="text-align: initial;">
                                                <th width="5%">Code</th>
                                                <th width="5%">Title</th>
                                                <th width="5%">Client</th>
                                                <th width="10%">Location</th>
                                                <th width="5%">#</th>
                                                <th width="10%">Type</th>
                                                <th width="10%">Visa </th>
                                                <th width="10%">Pay Rate</th>
                                                <th width="10%">Publish Date</th>
                                                <th width="10%">Status</th>
                                                <th width="7%">Closing Date</th>
                                                <th width="6%"><i class="fa fa-user fa-lg" aria-hidden="true" title="Assignees"></i>&nbsp<i class="fa fa-file-text fa-lg" aria-hidden="true" title="Application"></i>&nbsp;<i class="fa fa-check-square-o fa-lg" aria-hidden="true" title="Client Submittal"></i></th>
                                                <th width="18%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach($toReturn['post_job'] as $posted_job)
                                            <tr>
                                                <?php
															$id=$posted_job['ID'];
															$last_date=$posted_job['last_date'];
															$new_last_Date = date("m-d-Y", strtotime($last_date));
															$closing_date=date('m-d-Y',strtotime($posted_job['dated']));
															$application= count(DB::table('tbl_seeker_applied_for_job')->where('job_ID',$id)->get());
															$client_submittal=count(DB::table('tbl_forward_candidate')->where('job_ID',$id)->get());
															$assignee=count(DB::table('tbl_job_post_assign')->where('job_post_id',$id)->get());
                                                        	?>
                                                <td style="padding:1px;">{{$posted_job['job_code']}}</td>
                                                <td><a href="{{url('employer/jobsdetails/'.$id)}}">{{$posted_job['job_title']}} </a></td>
                                                <td>{{$posted_job['client_name']}}</td>
                                                <td>@if($posted_job['city']){{$posted_job['city']}}, &nbsp;@endif{{$posted_job['state']}}</td>
                                                <td>{{$posted_job['vacancies']}}</td>
                                                <td>{{$posted_job['job_mode']}}</td>
                                                <?php $vis=$posted_job['job_visa_status'];
                                                        $plus_visa=substr_count("$vis",",");
                                                        $sh=explode(",",$vis);
                                                        ?>
                                                <td onmouseover="visa_type({{$id}});" data-toggle="tooltip" title="{{$posted_job['job_visa_status']}}" id="visa{{$id}}"><span>{{$sh[0]}},&nbsp;+{{$plus_visa}}</span></td>
                                                <td>{{$posted_job['pay_min']}}-{{$posted_job['pay_max']}}</td>
                                                <td>{{$closing_date}}</td>
                                                <td>{{$posted_job['sts']}}</td>
                                                <td>{{$new_last_Date}}</td>
                                                <td style="display:flex;">
                                                    <!--<span class="badge badge-pill badge-primary">{{$assignee}}</span><span class="badge badge-pill badge-primary">{{$application}}</span><span class="badge badge-pill badge-primary">{{$client_submittal}}</span>-->
                                                    <button type="button" class="btn btn-primary btn-sm" style="padding: 2px;min-width: 20px;min-height: 2px;">{{$assignee}}</button>&nbsp;
                                                    <button type="button" class="btn btn-primary btn-sm" style="padding: 2px;min-width: 20px;min-height: 2px;margin-left: 2px;">{{$application}}</button>&nbsp;
                                                    <button type="button" class="btn btn-primary btn-sm" style="padding: 2px;min-width: 20px;min-height: 2px;margin-left: 2px;">{{$client_submittal}}</button>
                                                </td>
                                                <td class="actions" width="20%; display:flex;">
                                                    @if(!empty($toReturn['user_type']=="teammember"))
                                                    @if($toReturn['current_module_permission']['is_edit']=="yes")
                                                    <a href="{{url('employer/job/edit/'.$id)}}"><i class="fa fa-pencil" title="Edit"></i></a>
                                                    <a href="{{url('employer/posted_job_assined/'.$id)}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Asign this job"><i class="fa fa-users"></i></a>
                                                    @endif
                                                    @else
                                                    <a href="{{url('employer/posted_job_assined/'.$id)}}" class="on-default edit-row" data-placement="top" title="Assign this job" ><i class="fa fa-users"></i></a>
                                                    <a href="{{url('employer/job/edit/'.$id)}}"><i class="fa fa-pencil" title="Edit"></i></a>
                                                    @endif
                                                    @if(!empty($toReturn['user_type']=="teammember"))
                                                    @if($toReturn['current_module_permission']['is_delete']="yes")
                                                    <a href="{{url('employer/delete/'.$id)}}" onclick="return confirm('Are u really want to delete this item?')"><i class="fa fa-trash-o" title="Delete"></i></a>
                                                    @endif
                                                    @else
                                                    <a href="{{url('employer/delete/'.$id)}}" onclick="return confirm('Are u really want to delete this item?')"><i class="fa fa-trash-o" title="Delete"></i></a>
                                                    @endif
                                                    <!-- @if($toReturn['current_module_permission']['is_delete']="yes") -->
                                                    <!-- <a href="{{url(''.$id)}}" data-toggle="modal" data-target="#myModal{{$posted_job['ID']}}" title="Add a candidate"><i class="fa fa-plane" aria-hidden="true"></i></a> -->
                                                    <a href="javascript:void();"  onclick="showmailModal({{$posted_job['ID']}})"  title="mail"><i class="fa fa-envelope"></i></a>
                                                    <a href="javascript:void();" onclick="addjobNotes({{$posted_job['ID']}})" ><i class="fa fa-plus" title="Note"></i></a>
                                                    <!-- @endif -->
                                                    <a href="" data-toggle="modal" onclick="share({{$posted_job['ID']}})" title="share"><i class="fa fa-share"></i></a>
                                                    

                                            </tr>
                                          



                                            <!-- Model Mail -->
                                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mailModal" data-whatever="@mdo">Open modal for @mdo</button> -->

                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$toReturn['post_job']->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Row -->
        </div>
        <!--end of card body-->
    </div>
    <!--for Send Job Candidate Description-->
    <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Mail
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="cmxform form-horizontal tasi-form" action="{{url('employer/posted_jobs/email_add')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="candidate_id" name="candidate_id" value="" required>
    
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">To:</label>
                            <input type="email" class="form-control" id="mail_to" name="mail_to" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Candidate Name:</label>
                            <select name="job" id="job" class="form-control" required>
                                <option value="">Select</option>
                                
                              
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Comment:</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-secondary" value="submit">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- this Modal For Add Job Notes-->
    <div class="modal fade bd-example-modal-lg fade" id="addjobNotes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content" style="width:100%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <h2>Job Notes</h2>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('employer/posted_jobs/add_notes')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="input-group mb-3">
                          
                                <input type="hidden" value="" id="job_id" name="job_id">
                                
                                <input type="text" class="form-control" placeholder="Notes Title"  id="title" aria-label="Recipient's username" name="title" aria-describedby="basic-addon2" required>
                                <input type="text" class="form-control" placeholder="Enter Notes" id="note" maxlength="3" aria-label="Recipient's username" name="note" aria-describedby="basic-addon2" required>

                                <select name="privacy" class="custom-select">
                                    <option value="public">Public
                                    </option>
                                    <option value="Private">Private
                                    </option>
                                </select>

                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="submit" id="send_ajax">Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-primary" id="view" href="#" role="button" onclick="viewjobnote();">View More</a>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="mb-12">
                        <div id="append_view" class="table-responsive-lg " style="margin-left:130px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
    $('#title').bind('keyup blur',function(){ 
        var node = $(this);
        node.val(node.val().replace(/[^A-Za-z_\s]/,'') ); }   // (/[^a-z]/g,''
    );
    
    $('#note').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/,'') ); }   // (/[^a-z]/g,''
);

    </script>
    <script>
        var resizefunc = [];
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @include('include.emp_footer')
    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        function visa_type(id) {
            // alert();
            $("#visa" + id).hover(function () {
                $("#data1" + id).hide();
                $("#data2" + id).show();
            }, function () {
                $("#data2" + id).hide();
                $("#data1" + id).show();
            });
        }
    </script>
  <script type="text/javascript">



        function viewjobnote() {
            var job_id=$("#job_id").val();
            $.ajax({
                type: 'POST',
                url: '{{url("employer/job/notes/")}}',
                data: {
                    id: job_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    console.log(data);

                    var value_one = `<table class='table table-striped'>
										<thead>
                                           
											<tr>
											<th>Job_ID</th>
											<th>Title</th>
											<th>Note</th>
											<th>Created By</th>
											<th>Status</th>
											<th>Privacy</th>
											</tr>
										</thead>
										<tbody>`;
                    $('#append_view').append(value_one);
                    $.each(data, function (index, value) {
                        
                        
            var value_three = `<tr>
                        
								<td>`+ value.job_id + `</td>
								<td>`+ value.title + `</td>
								<td>`+ value.note + `</td>
								<td>`+ value.created_by + `</td>
								<td>`+ value.status + `</td>
								<td>`+ value.privacy_level +`</td>
							</tr>`;
                           
                            
                        $('#append_view').append(value_three);
                        


                        // $('#append_view').append("<option value="+'"'+value.state_id+'"'+"selected>"+value.state_name+"</option>");

                    });
                    $('#append_view').append("</tbody>");
                    $('#append_view').append("</table>");
                    $('#view').hide();
          


                },
                error: function (data) {
                    console.log(data);
                    

                }

            });
        }
        

    </script> 
    <script>
    function addjobNotes(id)
    {
    $("#job_id").val(id);
    $("#addjobNotes").modal("show");
    }

    </script>
<script>
function showmailModal(id)
{
$("#job").html("");
$("#candidate_id").val(id);
$.ajax({
            url: "{{url('employer/show_candiate_details/')}}" + "/" + id,
            method: "GET",
            contentType: 'application/json',
            dataType: "json",
            success: function (data) {
                var toAppend="";
                for(i=0;i<data.length;i++)
                {
                  toAppend+=`<option value="`+data[i].ID+`|`+data[i].first_name+ data[i].middle_name+data[i].last_name+`">`+data[i].first_name+" "+ data[i].middle_name+" "+data[i].last_name+`</option>`;
                }
                $("#job").append(toAppend);
                console.log(toAppend);
            }
});
$("#mailModal").modal("show");
}
</script>


    {{-- ******************************* Under this sharing code is written ******************************* --}}

    <script>
        function share(id) {
            // alert('this module work in progress')
            $('#exampleModalScrollable').modal();
            $('#id_for_job').val(id);
        }

        function share_twiter() {
            $('#exampleModalScrollable').modal('toggle');
            $('#share_twiter').modal();
            var id = $('#id_for_job').val();

            $.ajax({
                type: 'get',
                url: '{{url("employer/job_details/share_linked_in")}}',
                data: {
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    $('#job_title_twiter').val(data.job.job_title);
                    $('#job_detail_twiter').html(data.job.job_description);
                    $('#visa_twiter').val(data.job.job_visa_status);
                    $('#skills_twiter').val(data.job.required_skills);
                    $('#url_twiter').val('http://baba.software/ats/careers/job_detail/' + data.job.ID + '/' + data.org);
                    // $('#share_fb').attr('src', "https://www.facebook.com/plugins/share_button.php?href=http://localhost/babasoftware/careers/job_detail/" + data.job.ID + '/' +data.org+"=large&width=77&height=28&appId")    
                    $('#twiter_link').attr('href', "https://twitter.com/intent/tweet?url=http://baba.software/ats/careers/job_detail/" + data.job.ID + '/' + data.org)


                },
                error: function (data) {
                    alert('Internal Server error');
                }
            });

        }


        function share_facebook() {
            $('#exampleModalScrollable').modal('toggle');
            $('#share_facebook').modal();
            var id = $('#id_for_job').val();

            $.ajax({
                type: 'get',
                url: '{{url("employer/job_details/share_linked_in")}}',
                data: {
                    id: id
                },
                success: function (data) {
                    console.log(data);
                    $('#job_title').val(data.job.job_title);
                    $('#job_detail').html(data.job.job_description);
                    $('#visa').val(data.job.job_visa_status);
                    $('#skills').val(data.job.required_skills);
                    $('#url').val('http://localhost/babasoftware/careers/job_detail/' + data.job.ID + '/' +
                        data.org);
                    $('#share_fb').attr('src', "https://www.facebook.com/plugins/share_button.php?href=http://baba.software/ats/careers/job_detail/" + data.job.ID + '/' + data.org)
                    // $('#share_fb').attr('src', "https://www.facebook.com/plugins/share_button.php?href=http://itscient.com/")    


                },
                error: function (data) {
                    alert('Internal Server error');
                }
            });
        }

    </script>

    <!-- Modal -->
    <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalScrollableTitle">Share</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_for_job">
                    <center>
                        <button type="button" onclick="share_twiter()" class="btn btn-info"> Share on
                            Twitter</button>
                        <button type="button" onclick="share_facebook()" class="btn text-light" style="background-color:#4267b2"> Share on
                            Facebook</button>
                    </center>
                </div>
                <div class="modal-footer">

                    <small>Click the respective button for sharing this job post</small>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="share_twiter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalScrollableTitle">Share on Twiter <i class="fa fa-linkedin-in"></i></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Job Title</label>
                    <input type="text" id="job_title_twiter" class="form-control" readonly>
                    <label for="" class="mt-2">Job details</label>
                    <textarea name="" id="job_detail_twiter" style="width:100%" rows="10" readonly></textarea>
                    <label for="" class="mt-2">Link URL</label>
                    <input type="text" id="url_twiter" class="form-control" readonly>
                    <label for="" class="mt-2">Visa status</label>
                    <input type="text" id="visa_twiter" class="form-control" readonly>
                    <label for="" class="mt-2">Skills</label>
                    <input type="text" id="skills_twiter" class="form-control" readonly>

                </div>
                <div class="modal-footer">

                    {{-- <button type="button" class="btn btn-info">Share</button> --}}
                    <a id="twiter_link" class="btn btn-info" data-show-count="false">Tweet on twiter</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="share_facebook" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalScrollableTitle">Share on Facebook <i class="fa fa-linkedin-in"></i></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Job Title</label>
                    <input type="text" id="job_title" class="form-control" readonly>
                    <label for="" class="mt-2">Job details</label>
                    <textarea name="" id="job_detail" style="width:100%" rows="10" readonly></textarea>
                    <label for="" class="mt-2">Link URL</label>
                    <input type="text" id="url" class="form-control" readonly>
                    <label for="" class="mt-2">Privacy</label>
                    <label for="" class="mt-2">Visa status</label>
                    <input type="text" id="visa" class="form-control" readonly>
                    <label for="" class="mt-2">Skills</label>
                    <input type="text" id="skills" class="form-control" readonly>

                </div>
                <div class="modal-footer">

                    {{-- <button type="button" class="btn btn-info">Share</button> --}}
                    <iframe width="77" height="28" id="share_fb" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                </div>
            </div>
        </div>
    </div>



    {{-- *******************************  sharing code ends here ******************************* --}}

    </html>