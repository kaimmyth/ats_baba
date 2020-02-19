
@include('include.emp_header')
@include('include.emp_leftsidebar')
<style>
	.card-header{
		background:#317eeb;
	}	
	 .bs-example{
    	margin: 10px;
    }	
 .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 0em;
}

.table td {
    padding: 7px;
    font-size: top;
    border-top: 1px solid #dee2e6;
    font-size: 14px;
    color: #000;
    background:#fff;
}
.table tr {
    padding: 7px;
    font-size: top;
    border-top: 1px solid #dee2e6;
    font-size: 14px;
    color: #000;
    background:#fff;
}
.table th {
    padding: 7px;
    font-size: top;
    border-top: 1px solid #dee2e6;
    font-size: 14px;
    color: #000;
    background:#e4e4e4;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 0.5px solid #000;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 1px;
}
.modal .modal-dialog .modal-content {
    height: 600px;
    overflow-y: scroll;
}

</style>  
                        
        <div class="content-page">              
            <div class="content">               
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">                                       
									<h4 style="color:#fff; float: left;">Team Member Assigned For {{$toReturn['post_job']['job_title']}} -{{$toReturn['post_job']['job_code']}}</h4>
									<h4><a href="{{url ('employer/posted_jobs') }}"><button type="button" class="btn btn-success" style="float: right;margin-left: 1em;">Back</button></a></h4>
									<h4><button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#myModal" style="float: right; margin-left: 1em;">Add Assignee</button></h4>

								</div> 
                                 <div class="card-body"> 
                                 	<div class="bs-example">
									    <table class="table">
									        <thead>
									            <tr>
									                <th>Name</th>
									                <th>Email</th>
									                <th>Assignees Date</th>
									                <th>Assigned By</th>
									            </tr>
									        </thead>
									        <tbody>
									        	@foreach($assign_details as $assign_details)
									            <tr>
									                <td>{{$assign_details->name}}</td>
									                <td>{{$assign_details->email}}</td>
									                <td>{{$assign_details->job_assign_date}}</td>
									                <td>{{$assign_details->userAssign}}</td>
									            </tr>
									            @endforeach
									        </tbody>
									    </table>
                                 </div><!--end of card body-->
                            </div><!--end of card-->
                        </div><!--end of --col-->                           
                    </div> <!-- End Row -->

        
				</div><!--container-fluid-->
            </div><!--content-->
    <!-- sample modal content -->
            <div id="myModal" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mt-0" id="myModalLabel">Team Member list</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"> 
                        
							  <table class="table table-bordered">
							    <thead>
							      <tr>
							        <th>Name</th>
							        <th>Email</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    	@foreach($toReturn['team_member_list'] as $key=>$toReturn)
							        <tr>
							        	<form action="{{url('employer/assigned')}}" method="post">
							        	<input type="hidden" name="_token" value ="{{ csrf_token()  }}" >
							        
							        	<input type="hidden" name="job_id" value="{{$jobpost['ID']}}">
						        		<input type="hidden" name="team_member_id"  value="{{$toReturn['ID']}}">
						        	 	
                                        <td><input type="hidden" name="owner_id" value="{{$toReturn['ID']}}">{{$toReturn['full_name']}}</td>
								        <td><input type="hidden" name="email" value="{{$toReturn['email']}}">{{$toReturn['email']}}</td>
								        @if($toReturn['sts'] == 'inactive')
								        	<td><input type="submit" class="btn btn-success btn-xs1" value="Assign"></td>
								        		<input type="hidden" name="sts" value="active">
								    	@else
								    		<td><input type="submit" class="btn btn-danger btn-xs1" value="Unassign"></td>
								    			<input type="hidden" name="sts"  value="blocked">
								    	@endif
									    </form>
							        </tr>
							        @endforeach
							    </tbody>
							  </table>
                        	</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
              
                        </div>
                    </div><!-- /.modal-content
                </div>/.modal-dialog -->
            </div><!-- /.modal -->    
@include('include.emp_footer')
<!-- <script type="text/javascript">
    function Assign_function(id)
    {
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('employer/posted_job_assined')}}"+ '/' +id,
                type: 'post',  
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    alert(id);
  
                    $("#"+id).html(data.sts);
                    if(data.sts==='active'){
                    $("#"+id).css('background-color','#04B431');                          
                    }
                    else
                    {
                    $("#"+id).css('background-color','#e20b0b');                          

                    }
                    // $("#formreset").reset();
                }
            });
    }
</script>
 -->
</script>
 