@include('include.emp_header')
@include('include.emp_leftsidebar')
<style type="text/css">
	.table td, .table th {
		padding: 4px;
		vertical-align: top;
		border-top: 1px solid #eaeaea;
		font-size: 13px;
		color: #444;
	}
	#wrapper {
		overflow: hidden;
		width: 100%;
		overflow-y: scroll;
	}
	.d-none{
		font-size: 17px;
		color: #fff;
		background: #317eeb;	
	}
	h3 {
		line-height: 30px;
		font-size: 24px;
		/* background: #317eeb; */
		color: #317eeb;
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
</style>
<div id="wrapper">
	<div class="content-page">
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12">
						<ul class="nav nav-tabs nav-justified" role="tablist" style="background: #317eeb;">

							<li class="nav-item">
								<a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="false">
									<span class="d-none d-sm-block">Job Details</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="true">
									<span class="d-none d-sm-block">Potential Matches</span>
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" id="message-tab-1" data-toggle="tab" href="#message-1" role="tab" aria-controls="message-1" aria-selected="false">
									<span class="d-none d-sm-block">Application</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="setting-tab-1" data-toggle="tab" href="#setting-1" role="tab" aria-controls="setting-1" aria-selected="false">
									<span class="d-none d-sm-block">Client Submittals</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="setting-tab-1" data-toggle="tab" href="#finish-1" role="tab" aria-controls="setting-1" aria-selected="false">
									<span class="d-none d-sm-block">History</span>
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
								<div class="row">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-12">
														<table id="datatable" class="table table-striped table-bordered table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Location</th>
																	<th>Visa</th>
																	<th>Skills</th>
																	<th>Exp. (Year)</th>
																	<th>Mobile</th>
																	<th>Email(H)</th>
																	<th>Source</th>
																	<th>Match Percentage</th>
																</tr>
															</thead>
															<tbody>
																
																@if($potentialdata!='')
																@foreach($potentialdata['seeker_details'] as $key => $val )
																@if($val->first_name!='' && $val->skills!='')
																<tr>
																	<td>{{$val->first_name ?? ''}} {{$val->last_name ?? ''}}</td>
																	<td>{{$val->city ?? ''}} {{$val->state ?? ''}},{{$val->country ?? ''}}</td>
																	<td>{{$val->visa_status ?? ''}}</td>
																	<td>{{$val->skills ?? ''}}</td>
																	<td>{{$val->experience ?? ''}}</td>
																	<td>{{$val->mobile ?? ''}}</td>
																	<td>{{$val->email ?? ''}}</td>
																	<td>INTERNAL</td>
																	<td>@if(@$val->match_percentage){{$val->match_percentage ?? ''}} @else 0 @endif</td>
																</tr>
																@endif
																@endforeach
																<!-- @endif -->
															</tbody>
														</table>

													</div>
												</div>
											</div>
										</div>
									</div> 
								</div> <!-- End Row --> 
							</div>
							<div class="tab-pane show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
								<div class="card-body">
									<h2 style="font-weight:100;color:#317eeb;"> {{@$data[0]->job_title}}
										<a href=""><i class="fa fa-external-link fa-1x" aria-hidden="true"></i></h2></a>
										<div class="row">
											<div class="col-md-8">
												<table class="table">
													<tbody>													   
														<tr>
															<td>Industry:</td>													
															<td>{{$industry['industry_name'] ?? ''}}</td>														  
														</tr>
														<tr>
															<td>Total Positions:</td>
															<td>{{@$data->vacancies}}</td>
														</tr>
														<tr>
															<td>Job Type:</td>
															<td>{{@$data->job_mode}}</td>
														</tr>
														<tr>
															<td>Salary:</td>
															<td>{{@$data->pay_min}} - {{@$data->pay_max}}  {{$data->pay_uom}}</td>
														</tr>
														<tr>
															<td>Job Location:</td>
															<td>{{@$data->country}},&nbsp;{{@$data->state}},&nbsp;{{@$data->city}}</td>
														</tr>
														<tr>
															<td>Minimum Education:</td>
															<td>{{@$data->qualification}}</td>
														</tr>
														<tr>
															<td>Minimum Experience:</td>
															<td>{{@$data->experience}}</td>
														</tr>
														<tr>
														<td>Apply By:</td>
															@if(@$data->last_updated_by)
															<?php 
															$last_update_by=DB::table('user')->where('ID',@$data->last_updated_by)->first();
															?>
															<td> {{@$last_update_by->full_name}}</td>
															@endif
														</tr>
														<tr>
															<td>Job Posting Date:</td>
															<!-- <?php 
															           $converted_date1 = date('y-m-d',strtotime($data->dated));   
																	?>
															<td>{{@$converted_date1->dated}}</td> -->


															<?php 
																			$converted_date1 = date('y-m-d',strtotime($data->dated));  
																	?>
																	<td>{{@$converted_date1}}</td>
														</tr>
													</tbody>
												</table>
												<br>

												<h3>Job Description</h3>
												<p>{{@$data->job_description}}</p>

												<h3>Skills Required</h3>
												<hr>
												<input type="text" value="{{@$data->required_skills}}" class="form-control" style="width:270px;"/>&nbsp;&nbsp;
														
														<hr>

													</div>
													<div class="col-md-8">
														<table class="table">
															<tbody>
																<tr>
																	<td>Job code:</td>
																	<td>{{@$data->job_code}}</td>
																</tr>
																<tr>
																	<td>Job Title:</td>
																	<td>{{@$data->job_title}}</td>
																</tr>
																<tr>
																	<td>Qualification:</td>
																	<td>{{@$data->qualification}}</td>
																</tr>
																<tr>
																	<td>Client Name:</td>
																	<td>{{@$data->client_name}}</td>
																</tr>
																<!--<tr>-->
																<!--	<td>Job Slug:</td>-->
																<!--	<td>{{@$data->job_slug}}</td>-->
																<!--</tr>-->
																<tr>
																	<td>Job Duration:</td>
																	<td>{{@$data->job_duration}}  {{@$data->job_duration_uom}}</td>
																</tr>
																<tr>
																	<td>Is Featured:</td>
																	<td>{{@$data->is_featured}}</td>
																</tr>
																<tr>
																	<td>Status:</td>
																	<td>{{@$data->sts}}</td>
																</tr>
																<tr>
																	<td>Created Date:</td>
																	<?php 
																			$converted_date2 = date('y-m-d',strtotime($data->dated));  
																	?>
																	<td>{{@$converted_date2}}</td>
																</tr>
																<tr>
																	<td>Last Updated Date:</td>
																	<?php 
																			$converted_date3 = date('y-m-d',strtotime($data->last_updated_date));  
																	?>
																	<td>{{@$converted_date3}}</td>
																</tr>
																<tr>
																@if(@$data->last_updated_by)
															<?php 
															    $last_update_by=DB::table('user')->where('ID',@$data->last_updated_by)->first();
															?>
																	<td>Last Updated By:</td>
																	<!-- <td>{{@$last_update_by->first_name}}</td> -->
																	<td> {{@$last_update_by->full_name}}</td>
																	@endif
																</tr>
															</tbody>
														</table>
													</div> 

												</div>             
											</div>  
										</div>

										<div class="tab-pane" id="message-1" role="tabpanel" aria-labelledby="message-tab-1">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-12">
													<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">   
														<thead>
															<tr>
																<th>Submittal Date</th>
																<th>Candidate</th>
																<th>Age</th>
																<th>Location</th>
																<th>Exp.</th>
																<th>Pay Rate</th>
																<th>Visa</th>
																<th>Email</th>
																<th>Mobile</th>
															</tr>
														</thead>
														@foreach($toReturn['application'] as $application)
															<tr>
															    	<?php 
																			$converted_date4 = date('y-m-d',strtotime($application['dated']));  
																	?>
																<td>{{$converted_date4}}</td>
																<td>{{$application['candate_name']}}</td>
																<td></td>
																<td>{{$application['current_location']}}</td>
																<td>{{$application['total_experience']}}</td>
																<td>{{$application['expected_salary']}}</td>
																<td>{{$application['visa_status']}}</td>
																<td>{{$application['email_id']}}</td>
																<td>{{$application['phone_no_mobile']}}</td>

															</tr>
														@endforeach
														<tbody>
															
														</tbody>
													</table>

												</div>
											</div>

										</div>
										<div class="tab-pane" id="setting-1" role="tabpanel" aria-labelledby="setting-tab-1">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-12">
													<table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
														<thead>

															<tr>
																<th>Submittal Date</th>
																<th>Job Code</th>
																<th>Job Title</th>
																<th>Job TYPE</th>
																<th>Location</th>
																<th>Required Skills</th>
																<th>Candidate Name</th>
																<th>Mobile</th>
																<th>Email</th>
																<th>Visa</th>
																<th>Qualification</th>
															</tr>
														</thead>
														<tbody>
														@foreach($toReturn['Client_submittals'] as $client_submittals)
														<tr>
														    	<?php 
																			$converted_date5 = date('m-d-Y',strtotime($client_submittals['forward_date']));  
																	?>
																<td>{{$converted_date5}}</td>
																<td>{{$client_submittals['job_code']}}</td>
																<td>{{$client_submittals['job_title']}}</td>
																<td>{{$client_submittals['job_type']}}</td>
																<td>{{$client_submittals['country']}}</td>
																<td>{{$client_submittals['skills']}}</td>
																<td>{{$client_submittals['fullname']}}</td>
																<td>{{$client_submittals['mobile']}}</td>
																<td>{{$client_submittals['email']}}</td>
																<td>{{$client_submittals['visa_status']}}</td>
																<td>{{$client_submittals['qualification1']}}</td>

														</tr>
														@endforeach
														</tbody>
													</table>

												</div>
											</div>

										</div>
										<div class="tab-pane" id="finish-1" role="tabpanel" aria-labelledby="setting-tab-1">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="row">
																<div class="col-md-12 col-sm-12 col-12">
																	<table id="datatable-keytable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
																		<thead>
																			<tr>
																				<th>Date & Time</th>
																				<th>User Name</th>
																				<th>Change Log</th>
																			</tr>
																		</thead>
																		<tbody>
																		@foreach($toReturn['list_job_history'] as $job_history)
																		<?php $user_name=DB::table('user')->where('ID',$job_history['created_by'])->first('full_name');?>
																				<tr>
																				    <?php 
																			$converted_date6 = date('m-d-Y',strtotime($job_history['created_date']));  
																	?>
																					<td>{{$converted_date6}}</td>
																					<td>{{$user_name->full_name}}</td>
																					<td>{{$job_history['update_text']}}</td>
																				</tr>
																		@endforeach
																		</tbody>
																	</table>

																</div>
															</div>
														</div>
													</div>
												</div>

											</div> <!-- End Row -->

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@include('include.emp_footer')