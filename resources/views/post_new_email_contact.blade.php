@include('include.emp_header')
@include('include.emp_leftsidebar')

<style>
.form-control{
	border: 1px solid #737373;
	width: 84%;
}
.active, .btn:hover {
  background-color: #000000;
  color: white;
}
#wrapper{
    width:100%;
    overflow-y:scroll;
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
		width: 55%;
		padding: 7px;
		border-radius: 5px;
	}
	textarea {
		border-radius: 5px;
		width: 48%;
	}

 </style>       		

<body>       
 
	    <div id="wrapper">
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                        <div class="row"> 							
                        <div class="col-md-12">
                        <div class="card" style="border: 1px #C0C0C0 solid;">
                            <div class="card-header" style="background-color: #317eeb;">
		                        <h3 class="card-title" style="color:#fff;text-transform: none; font-size:large">ADD E-MAIL CONTACT LIST<a href="{{url('employer/my_posted_contacts')}}"><button type="button" class="btn btn-info" style="float:right">Back</button></a></h3></div>
                                    
									<div class="card-body">
									 <!--Salutation-->	
							<form action="{{url('employer/post_new_email_contact/add')}}"  method="post" autocomplete="off"> 
									<input type="hidden" name="_token" value = "{{ csrf_token()  }}" >                              
									 <div class="form-group row">
										<label class="col-sm-4 control-label">Salutation </label>
											<div class="col-sm-8">
												<select name="salutation" class="form-control" style="max-width:350px; border: 1px solid #737373; background:#fff;">
												<option value="">--Select--</option>													
													<option value="Mr" >Mr</option>
													<option value="Ms" >Ms</option>
													<option value="Mrs" >Mrs</option>
													<option value="Miss" >Miss</option>
													<option value="Dr" >Dr</option>
													<option value="Prof" >Prof</option>
												</select>
										   </div>
									</div>
									<!--end of Salutation-->
									<!--Name-->	   
									<div class="form-group row">
										<label for="" class="control-label col-lg-4"> First Name<span style="color:red;">*</span></label>
											<div class="col-lg-8">
												<input type="text" id="" name="firstname" placeholder="First Name" type="number--" required maxlength="15">
											</div>
									  </div>
								<!--end of Name-->
								<!--Last Name-->	   
									<div class="form-group row">
										<label for="" class="control-label col-lg-4"> Last Name </label>
											<div class="col-lg-8">
												<input type="text" id="" name="lastname" placeholder="Last Name" type="number--" maxlength="15">
											</div>
									  </div>
								<!--end of Last Name-->
								<!--Full Name-->	   
									<div class="form-group row">
										<label for="" class="control-label col-lg-4"> Full Name </label>
											<div class="col-lg-8">
													<input type="text" id="" name="fullname" placeholder="Full Name" type="number--" maxlength="15">
											</div>
									  </div>
								<!--end of Full Name-->
								
								
								<!--Email (W)-->	   
									<div class="form-group row">
										<label for="" class="control-label col-lg-4">Email Id <span style="color:red;">*</span> </label>
											<div class="col-lg-8">
												<input type="email" id="" name="emailid" placeholder="Email ID" type="number--" class="form-control" style="width:500px;" required>
											</div>
									  </div>
								<!--end of Email (W)-->
									
								
							
								<!--Add in Contact Database-->	   						                                  
									 <div class="form-group row">
										<label class="col-sm-4 control-label">Status <span style="color:red;">*</span></label>
											<div class="col-sm-8">
												<select name="contactdatabase" class="form-control" style="max-width:350px; border: 1px solid #737373;background:#fff;" required>													
												<option value="">--Select--</option>	 
												<option value="active" >Active</option>
														<option value="inactive">Inactive</option>												
												</select>
										   </div>
									</div>									
								<!--end of Add in Contact Database-->
									 <div class="form-group" style="width:100%; height:80px;background:#e4e4e4;"><br>
									    <center><button class="btn btn-info waves-effect waves-light m-b-5" type="submit">Submit</button> </center></a>
									</div>																                                        
                                    </div> <!-- card-body -->
						</form>			
                                </div> <!-- card -->
                            </div> <!-- col -->
                        </div> <!-- End row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
        </div>
        <!-- END wrapper -->
       <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
		@include('include.emp_footer'); 
	</body>

<!-- Mirrored from coderthemes.com/moltran/blue/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jun 2019 12:15:55 GMT -->
</html>