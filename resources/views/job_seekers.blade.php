@include('include.header')
@include('include.leftSidebar')
<style>
    #wrapper {
        overflow-y: scroll;
        width: 100%;
    }

    .form-inline .form-control {
        display: list-item;
        width: auto;
        vertical-align: bottom;
        width: 100%;
    }

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
</style>

<div id="wrapper">
    <div class="content-page">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="background:#317eeb;">
                            <h3 class="card-title" style="text-transform:none; font-size:20px; color:#fff; font-weight:300;">All Jobseeker
                            </h3>
                        </div>
                        <div class="card-body" style="background-color:#c3c3c3;height: 74px;">
                            <form class="form-inline" align="center">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="sr-only">Search By Name</label>
                                        <input type="job" class="form-control" id="search_name" name="search_name" placeholder="Search by Job Title">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="sr-only" for="">Search By Email</label>
                                        <input type="name" class="form-control" id="email" name="email" placeholder="Search By email">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="search_featured" id="search_featured" class="form-control" style="width:100%;">
                                            <option value="" selected>- Gender -</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail2">City</label>
                                        <input type="city" class="form-control" id="city" name="city" type="text" placeholder="Search by City">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="button" id="search" class="btn btn-primary" style="width: 40%;">Search</button>
                                        {{-- <button type="button" class="btn btn-primary"
                                            style="margin-left:1em;width: 40%;">View All</button> --}}
                                    </div>
                                </div>
                            </form>
                        </div> <!-- card-body -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-12" id="show_clear">
                                                <table  id="users-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <thead style="text-align:center;">
                                                        <tr>

                                                            <th>Joining Date</th>
                                                            <th>Candidate Name</th>
                                                            <th>Email Address</th>
                                                            <th>Location</th>
                                                            {{-- <th>City</th> --}}
                                                             <th>Applied Jobs</th>
                                                            <th>CVs</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>
                                                       
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
            </div><br><br><br>


            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalScrollableTitle">Applyed Job</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="show">


                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">Close</button> --}}
                            {{-- <button type="button"
                            class="btn btn-primary">Save
                            changes</button> --}}
                        </div>
                    </div>
                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{url('admin/job_seekers_manage/sts')}}" method="post">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for=""></label>
                                    <select class="form-control" name="sts_change" id="sts_change">
                                        <option>active</option>
                                        <option>blocked</option>
                                        <option>pending</option>
                                        {{-- <option>Deleted</option> --}}
                                    </select>


                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            @include('include.footer')




            <script>
                function sts_change() {
                     sts=document.getElementById("sts_change").value;

                    $("#exampleModalCenter").modal("show");


                }

            </script>

            <script>
                $("#search").click(function () {
                    var search_name = document.getElementById("search_name").value;
                    var email = document.getElementById("email").value;
                    var search_featured = document.getElementById("search_featured").value;
                    var city = document.getElementById("city").value;
                    console.log("wind");
                    $("#show_clear").empty();

                    $.ajax({
                        type: 'get',
                        url: '{{url("admin/job_seekers_manage/advance_search")}}',
                        data: {
                            search_name: search_name,
                            email: email,
                            search_featured: search_featured,
                            city: city,
                        },
                        success: function (data) {
                            console.log(data);
                            $("#datatable").hide();
                            var dataone = `<table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;" >
                                        <thead style="text-align:center;">
                                            <tr>
                                                            <th>Joining Date</th>
                                                            <th>Candidate Name</th>
                                                            <th>Email Address</th>
                                                            <th>Location</th>
                                                            <th>Applied Jobs</th>
                                                            <th>CVs</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                        </thead>


                                        <tbody id="show1"> `;
                            $("#show_clear").append(dataone);
                            $.each(data, function (index, value) {

                                var job_id = value.ID;
                                console.log(job_id);
                               
                                var datatwo = `
                                    <tr>
                                    <td>` + value.dated + `</td>
                                    <td>` + value.first_name + value.last_name + `</td>
                                    <td>` + value.email + `</td>
                                    <td>` + value.country + ` , ` + value.state + ` , ` + value.city + `</td>
                                        
                                    <td align="center" valign="middle">
                                                                <a onclick="opendata_model(`+ job_id + `)" type="button"
                                                                    class="btn btn-xs"
                                                                    style="background-color:#317eeb; color:#fff">View </a>
                                                            </td>


                                                            <td align="center" valign="middle">
                                                                <a href="{{url('public/seekerresume/`+ value.cv_file + `')}}"
                                                                    type="button" class="btn btn-xs"
                                                                    style="background-color:#2196F3; color:#fff">View
                                                                    CV</a>
                                                            </td>
                                                            <td align="center" valign="middle">
                                                                <button type="button" onclick="sts_change()"
                                                                    class="btn btn-xs"
                                                                    style="background-color:#04B431; color:#fff">`+ value.sts + `
                                                                </button>
                                                            </td>
                                                            <td class="actions">
                                                            <a href="{{url('admin/job_seekers/applied_jobs/edit/`+ value.ID + `')}}" class="btn btn-xs mb-1"
                                                                    style="background-color:#FF9800; color:#fff">Edit
                                                                    candidate</a><br>

                                                                    <a type="button" onclick="location.href = '{{url('admin/job_seekers/applied_jobs/auto_login_seeker`+ value.ID + `')}}'" class="btn btn-xs mb-1"
                                                                    style="background-color:#606060; color:#fff">Login
                                                                    as candidate</a><br>
                                                            
                                                                <button type="button"
                                                                    onclick="location.href = '{{url('admin/job_seekers/applied_jobs/de`+ value.ID + `')}}';"
                                                                    class="btn btn-xs mb-1"
                                                                    style="background-color:#ff6347; color:#fff">Delete
                                                                    Candidate</button>
                                                            </td>

                                    </tr>`;


                                $('#show1').append(datatwo);

                            });
                        },
                        error: function (data) {
                            console.log(data);
                        },



                    });

                });

            </script>

            <script>
                function opendata_model(val_id) {
                    if ((val_id == "") || (val_id == null)) {
                        id = document.getElementById("ID").value;
                    }
                    else {
                        id = val_id;
                    }

                    $("#show").empty();
                    $("#show_data").empty();
                    $.ajax({

                        type: 'get',
                        url: '{{url("admin/job_seekers_manage/job_post_view")}}',
                        data: {
                            id: id
                        },
                        success: function (data) {
                            console.log(data);


                            $("#exampleModalScrollable").modal('show');
                            var head = `<table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Job_ID</th>
                                    <th scope="col">Job_title</th>
                                    </tr>
                                </thead>
                                <tbody id="show_data">`;
                            $("#show").append(head);
                            $.each(data, function (index, value) {
                                var new_file = `
                                
                                    <tr>
                                    <th scope="row">` + value.job_code + `</th>
                                    <td>` + value.job_title + `</td>
                                    
                                    </tr>
                                
                                `;

                                $("#show_data").append(new_file);
                            });
                            var end = ` </tbody>
                            </table>`;

                            $("#show_data").append(end);
                        },
                        error: function (data) {
                            console.log("Error");
                        },
                    });
                    console.log(id);
                }

            </script>
            <script>
                $(document).ready(function() {
                $('#users-table').DataTable({
    serverSide: true,
    processing: true,
    ajax: "{{ route('fetch_seeker_details') }}",
    columns: [
            {data: 'dated', name: 'dated'},
            {data: 'first_name', name: 'first_name'},
            {data: 'email', name: 'email'},
            {data:'Location',name:'Location'},
            {data:'AppliedJobs',name:'AppliedJobs'}
            // {data:'Status',name:'Status'}
            // {data:'Action',name:'Action'}
        ]
});
                });
            </script>