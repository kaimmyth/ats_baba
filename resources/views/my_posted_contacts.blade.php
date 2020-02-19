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
    width: 50%;
    padding: 7px;
    border-radius: 5px;
}

textarea {
    border-radius: 5px;
    width: 48%;
}
span.red {
    color:red;
}
input[class="form-control"]{
    border:1px solid #bdbcbc;
    width: 84%;
    background: #fff;
}
select[class="form-control"]{
    border:1px solid #bdbcbc;
    width: 84%;
    background: #fff;
}
textarea[class="form-control"]{
    border:1px solid #bdbcbc;
    background: #fff;
    width: 84%;
}

#wrapper {
    width:100%;
    overflow-y:scroll;
}
.tabs li.tab {
    background-color: #b9e0ff;
    display: block;
    float: left;
    margin: 0;
    text-align: center;
}
.nav.nav-tabs > li > a, .nav.tabs-vertical > li > a {
    background-color: transparent;
    border-radius: 0;
    border: none;
    color: #00000; !important;
    cursor: pointer;
    line-height: 50px;
    padding-left: 20px;
    padding-right: 20px;
    font-size: 18px;
}
.nav.nav-tabs + .tab-content {
    background: #ffffff;
    margin-bottom: 30px;
    padding: 10px;
}
.nav.nav-tabs > li > a.active {
    background-color: #e8faf8;
    border: 0;
}
.tabs .indicator {
    background-color: #e8faf8;
    bottom: 0;
    height: 2px;
    position: absolute;
    will-change: left, right;
}
table.dataTable thead > tr > th {
    / padding-left: 8px; /
    padding-right: 30px;
}
.table-bordered th {
    border-top: 4px solid #f5f5f5 !important;
    border-bottom: 4px solid #f5f5f5 !important;
    border-right: 4px solid #f5f5f5 !important;
    border-left: 4px solid #f5f5f5 !important;
	color:#000;
	font-size: 13px;
	padding: 0.5em;
}
.table td{
    padding: 0.10rem;
	font-size: 12px;
    padding-left: 1em;
	border-top: 4px solid #f5f5f5 !important;
    border-bottom: 4px solid #f5f5f5 !important;
    border-right: 4px solid #f5f5f5 !important;
    border-left: 4px solid #f5f5f5 !important;
	color:#000;

}

</style>
	<div id="wrapper">                          
        <div class="content-page">              
            <div class="content">               
                <div class="row">
                	   <div class="col-md-12"> 
                            <ul class="nav nav-tabs tabs" role="tablist" style="height: 45px;">
                                <li class="nav-item tab">
                                    <a class="nav-link active" id="home-tab-2" data-toggle="tab" href="#home-2" role="tab" aria-controls="home-2" aria-selected="false">
                                    <span class="d-none d-sm-block"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Contact</span></a>
                                    </li>
                                    <li class="nav-item tab">
                                        <a class="nav-link" id="profile-tab-2" data-toggle="tab" href="#profile-2" role="tab" aria-controls="profile-2" aria-selected="true">
                                        <span class="d-none d-sm-block"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Email List</span>
                                        </a>
                                    </li>
                                    <li class="nav-item tab">
                                        <a class="nav-link" id="message-tab-2" data-toggle="tab" href="#message-2" role="tab" aria-controls="message-2" aria-selected="false">
                                            <span class="d-none d-sm-block"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;Email Contact</span>
                                        </a>
                                    </li>
                                    <li class="nav-item tab">
                                    </li>
                                    <li class="nav-item tab">
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
                                         <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header" style="background-color:#d0d0d0">
                                                        <h3 class="card-title" style="color:#000;text-transform: none; font-size:large;float:left;">Contact Detail:</h3>
                                                        <div style="float:right;display: flex;">
                                                        <form action ="{{url('employer/importContact')}}" method="post" enctype="multipart/form-data">
                                                        	@csrf
								                     	 <!-- <input type="file" id="Upload_cv" name="Upload_exe" > -->
								                     	 <!-- <input type="submit" id="submit_btn" class="btn btn-success" value="Import  Contact"> -->
								                     	 </form>
													    @if(!empty($toReturn['user_type']=="teammember")) 
                                                        @if($toReturn['current_module_permission']['is_edit']=="yes")
													    <a href="{{url('employer/post_new_contacts/change_add_status')}}"><button type="button" class="btn btn-success">Add Contact</button></a>
														@endif
														@else
                                                        <a href="{{url('employer/post_new_contacts/change_add_status')}}"><button type="button" class="btn btn-success" style="margin-left:1em;">Add Contact</button></a>
                                                        @endif
													</div>
												</div>
											</div>
													<div class="card-body">
															<div class="col-12">
																<div class="table-responsive">
																	<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap">
																	<thead>
																	<tr>                                                                                                     
																		<th>Name</th>
																		<th>Phone (C)</th>
																		<th>Phone (W)</th>
																		<th>Email (H)</th>
																		<th>Email (W)</th>
																		<th>Location</th>
																		<th>Company</th>
																		<th>Designation</th>
																		<th>Actions</th>												  
																	</tr>
																</thead>
																<tbody>  
															        @foreach($contacts as $contact_object)                                         
																	<tr> 
																	<?php $id=$contact_object->id; ?>
																		<td>{{$contact_object -> cont_per_name}}</td>
																		<td>{{$contact_object -> phone_c }}</td>
																		<td>{{$contact_object -> phone_w }}</td>
																		<td>{{$contact_object -> email_h}}</td>
																		<td>{{$contact_object -> email_w}}</td>
																		<td>{{$contact_object -> state_name}},{{$contact_object -> city}}</td>
																		<td>{{$contact_object -> type_name}}</td>
																		<td>{{$contact_object -> designation}}</td>
																		<td class="actions">
                                                                             @if(!empty($toReturn['user_type']=="teammember")) 
        
																		@if($toReturn['current_module_permission']['is_edit']=="yes")
																		<!-- <a href="{{url('employer/post_new_contacts')}}"><button type="button" class="btn btn-success">Add Contact</button></a> -->
																		
																		<a href="{{url('employer/post_new_contacts/change_add_status')}}?purpose=edit&id={{$contact_object->id}}"><i class="fa fa-pencil"></i></a>
																		@endif
																		@else
                                                                        <a href="{{url('employer/post_new_contacts/change_add_status')}}?purpose=edit&id={{$contact_object->id}}"><i class="fa fa-pencil"></i></a>

																		@endif
                                                                        @if(!empty($toReturn['user_type']=="teammember")) 
																		@if($toReturn['current_module_permission']['is_delete']=="yes")
																		<a href="{{url('employer/my_posted_contacts/delete/'.$id)}}"  class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><i class="fa fa-trash-o"></i></a>
																		@endif
																		@else
																		<a href="{{url('employer/my_posted_contacts/delete/'.$id)}}"  class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><i class="fa fa-trash-o"></i></a>
																		@endif
																	</td>  	                                              																								
																	</tr>  
															   @endforeach
															</tbody>
														</table>
																</div>
															</div><!--end of col-->
														</div><!--end of row-->
													</div><!--end of card body-->
												</div>
											</div>							
									
									
					               <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                                               <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header" style="background-color:#d0d0d0">
                                                        <h3 class="card-title" style="color:#000;text-transform: none; font-size:large">Email List Detail:
                                                        @if(!empty($toReturn['user_type']=="teammember")) 
															@if($toReturn['current_module_permission']['is_add']=="yes")
												 <a href=""><button type="button" class="btn btn-success" style="float: right;">Add an Email List</button></a>
															@endif
															@else
												 <a href=""><button type="button" class="btn btn-success" style="float: right;">Add an Email List</button></a>
															@endif
                                                    </div>
                                                    		<div class="card-body">
														<div class="row">
															<div class="col-12">
																<div class="table-responsive">
                                                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">															<thead>
																<tr>                                                                                                     
																	<th>Email List Name</th>
																	<th>Description</th>
																	<th>Privacy</th>
																	<th>Active</th>
																	<th>Date Created</th>
																	<th>Created By</th>
																	<th>Last Updated</th>
																	<th>Last Updated By</th>
																	<th>Actions</th>
																													  
																</tr>
															</thead>
															<tbody> 
															    @foreach($email as $email_list)                                   
																<tr>  
																  <?php $id = $email_list->id; ?>                                                   
																	<td>{{$email_list->name}}</td>
																	<td>{{$email_list->description}}</td>
																	<td>{{$email_list->privacy_flag}}</td>
																	 <td>{{$email_list->active_flag}}</td>
																	<td>{{date('d-m-Y',strtotime($email_list->created_date))}}</td>
																	<td>{{$email_list->created_by}}</td>
																	 <td>{{date('d-m-Y',strtotime($email_list->last_updated_date))}}</td>
																	<td>{{$email_list->last_updated_by}}</td>
																	<td class="actions">
                                                                @if(!empty($toReturn['user_type']=="teammember")) 

																	@if($toReturn['current_module_permission']['is_edit']=="yes")
																	
																	<a href="{{url('employer/my_posted_contacts/del_email/'.$id)}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><i class="fa fa-trash-o"></i></a>
																	@endif
																	@else
																	<a href="{{url('employer/my_posted_contacts/del_email/'.$id)}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="delete"><i class="fa fa-trash-o"></i></a>
																	@endif
                                                                        @if(!empty($toReturn['user_type']=="teammember")) 
																	@if($toReturn['current_module_permission']['is_delete']=="yes")
																	<!-- <a href="#" class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a> -->
																	@endif
																	@else
                                                                <!-- <a href="#" class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a> -->

																	@endif
																</td>  	                                              																								
															  </tr>  
															  @endforeach
															</tbody>
														</table>
																</div>
															</div><!--end of col-->
														</div><!--end of row-->
													</div><!--end of card body-->
                                                </div>
                                            </div>
                                        </div> <!-- End Row -->         
						          </div><!--end of tabpenel--> 

                                   <div class="tab-pane" id="message-2" role="tabpanel" aria-labelledby="message-tab-2">
                                          <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header" style="background-color:#d0d0d0">
                                                        <h3 class="card-title" style="color:#000;text-transform: none; font-size:large">Email Contact Details :
                                                            @if(!empty($toReturn['user_type']=="teammember")) 

															@if($toReturn['current_module_permission']['is_add']=="yes")
                                                       	<!-- <a href="{{url('uploadcsv')}}"><button type="button" class="btn btn-success" style="float: right;">Import Email Contact</button></a> -->
														<a href="{{url('employer/post_new_email_contact/show')}}"><button type="button" class="btn btn-success" style="float: right; margin-right: 1em;">Add an Email Contact</button></a>
														@endif
														@else
														<!-- <a href="{{url('uploadcsv')}}"><button type="button" class="btn btn-success" style="float: right;">Import Email Contact</button></a> -->
														<a href="{{url('employer/post_new_email_contact/show')}}"><button type="button" class="btn btn-success" style="float: right; margin-right: 1em;">Add an Email Contact</button></a>
														@endif
                                                    </div>
                                                   <div class="card-body">
												<div class="row">
													<div class="col-12">
														<div class="table-responsive">
                                                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
																<thead>
																	<tr>                                                                                                     
																		<th>First Name</th>
																		<th>Last Name</th>
																		<th>Full Name</th>
																		<th>Email List Name</th>
																		<th>Date Created</th>
																		<th>Created By</th>
																		<th>Last Updated</th>
																		<th>Last Updated By</th>
																		<th>Actions</th>
																														
																	</tr>
																</thead>
																<tbody>  
																@foreach($list as $emaillist)                                          
																	<tr>   
																	<?php $id = $emaillist->id; ?>

																		<td>{{$emaillist -> first_name }}</td>
																		<td>{{$emaillist -> last_name }}</td>
																		<td>{{$emaillist -> full_name }}</td>
																		<td>{{$emaillist -> email_contact_id }}</td>
																		<td>{{$emaillist -> created_date }}</td>
																		<!--<td>{{date('d-m-Y', strtotime($emaillist->created_date))}}</td>-->
																		<td>{{$emaillist->created_by}}</td>
																		<td>{{$emaillist -> last_updated_date }}</td>
																		<!--<td>{{date('d-m-Y', strtotime($emaillist -> last_updated_date))}}</td>-->
																		<td>{{$emaillist ->  first_name}}</td>
																		<td class="actions">
                                                                    @if(!empty($toReturn['user_type']=="teammember")) 

																		@if($toReturn['current_module_permission']['is_edit']=="yes")
																		<!-- <a href="" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Asign this job"><i class="fa fa-users"></i></a> -->
																		@endif
																		@else
                                            <!-- <a href="" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="" data-original-title="Asign this job"><i class="fa fa-users"></i></a> -->

																		@endif
                                                                        @if(!empty($toReturn['user_type']=="teammember")) 

																		@if($toReturn['current_module_permission']['is_delete']=="yes")
																		<a href="{{url('employer/my_posted_contacts/delete_email/'.$id)}}" class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" data-original-title="delete"><i class="fa fa-trash-o"></i></a>
																		@endif
																		@else
                                                                        <a href="{{url('employer/my_posted_contacts/delete_email/'.$id)}}" class="hidden on-editing login-row" data-toggle="tooltip" data-placement="top" data-original-title="delete"><i class="fa fa-trash-o"></i></a>

																		@endif
																		
																		</td>  	                                              																								
															  		</tr>  
															    @endforeach
																</tbody>
															</table>
														</div>
													</div><!--end of col-->
												</div><!--end of row-->
											</div><!--end of card body-->
                                            </div>
                                        </div> <!-- End Row -->
                                   </div>                                 
	                        	</div>
	                    	</div>
	                	</div>
	            	</div>
	        	</div>
	    	</div>

 <!-- /.modal -->
    <div id="contact-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mt-0">              </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="modal-body">
                            <div class="form-group row">
                                <input type="hidden" name="id" value="">
                                <label for="address" class="control-label col-md-12">Status:<span style="color:red;">*</span></label>
                                <select name="sts" id="sts" class="form-control">
                                    <option value="">Draft</option>
                                    <option value="published"> Published</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="deleted">Deleted</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="closed">Closed</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-info" style="background-color:#04B431; color:#fff"  value="Update Status"></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>

@include('include.emp_footer')
<script type="text/javascript">
     		 // $("#Upload_cv").css('display','none');
    
	    $("#select_doc").click(function(e){
	       e.preventDefault();
	       	if($("#Upload_cv").trigger('click'))
	       	{
			// $("#submit_btn").trigger('click');
			}

		    });
     </script>