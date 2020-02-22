<meta name="csrf-token" content="{{ csrf_token() }}">
@include('include.emp_header')
@include('include.emp_leftsidebar')
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<style>
    #wrapper {
        width: 100%;
        overflow-y: scroll;
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

    .card .card-header {
        padding: 5px 20px;
        border: none;
        background: #f0f0f0;
    }

    .card-title {
        font-size: 14px;
        color: #00357f;
        margin-bottom: 0;
        margin-top: 6px;
        float: left;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 3px;
    }

    .form-control {
        -moz-border-radius: 2px;
        -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        -webkit-border-radius: 2px;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        border-radius: 2px;
        /* border: 1px solid #717171; */
        -webkit-box-shadow: none;
        box-shadow: 1px 1px;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
    }

    .btn-purple {
        background-color: #317eeb !important;
        border: 1px solid #317eeb !important;
        margin-left: 10px;
        height: 33px;
        margin-top: 4px;
    }

    .nav.nav-tabs>li>a,
    .nav.tabs-vertical>li>a {
        /* background-color: #60272700; */
        border-radius: 0;
        border: none;
        color: #000000 !important;
        cursor: pointer;
        line-height: 46px;
        padding-left: 20px;
        padding-right: 39px;
        font-weight: 900;
        background: #b9e0ff;
    }

    .nav.nav-tabs+.tab-content {
        background: #ffffff;
        margin-bottom: 30px;
        padding: 5px;
    }

</style>

<div id="wrapper">
    <div class="content-page">
        <div class="content">
            <div class="row">
                <div class="col-xl-12">
                    <ul class="nav nav-tabs tabs" role="tablist">
                        <li class="nav-item tab">
                            <a class="nav-link active" id="home-tab-2" data-toggle="tab" href="#home-2" role="tab"
                                aria-controls="home-2" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <span class="d-none d-sm-block"><i class="fa fa-calendar" aria-hidden="true"></i>
                                    &nbsp;&nbsp; Daily</span>
                            </a>
                        </li>

                        <li class="nav-item tab">
                            <a class="nav-link" id="message-tab-2" data-toggle="tab" href="#message-2" role="tab"
                                aria-controls="message-2" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                <span class="d-none d-sm-block"><i class="fa fa-calendar"
                                        aria-hidden="true"></i>&nbsp;&nbsp; Monthly</span>
                            </a>
                        </li>

                        <li style="width: 20%;background: #b9e0ff;"></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color:white">
                                            <h3 class="card-title" style="font-size:20px;"><b>DAILY REPORT OF: {{$name}}</b>

                                            </h3>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"  style="float:right;margin-left:10px" data-target="#sendmail">Send Report</button>
                                            <button type="button" class="btn btn-warning text-dark  ml-3"
                                                onclick="history.back();" style="float:right;">Back</button>
                                            <button type="button" class="btn btn-danger text-dark"
                                                onclick="get_pdf('table_daily' , 'Daily Report Of: {{$name}} →' , '#daily_title')"
                                                style="float:right;">PDF Separate</button>
                                            {{-- <button type="button" class="btn btn-success text-dark  ml-3"
                                                onclick="location.reload();" style="float:left;border-radius:10px;">↻</button> --}}
                                            <button type="button" class="btn btn-danger text-dark mr-3"
                                                onclick="get_pdf_all('table_daily' , 'Daily Report Of: {{$name}} → ' , '#daily_title','table_monthly' , 'Monthly Report Of: {{$name}} → ' , '#monthly_title' )"
                                                style="float:right;">PDF</button>

                                        </div>
                                        <!--end of card header-->
                                        <div class="card-body mt-4" id="table_daily">
                                            <div class="row">
                                                <div class="col-12" id="view_daily">
                                                    <div class="table-responsive" id="daily">
                                                        <h3 class="card-title ml-5 pb-5 pt-5" id="daily_title"
                                                            style="display:none;">

                                                        </h3>
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Date</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Posted Job List</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Candidate List</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Application Created
                                                                    </th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Client Submittal
                                                                        </th>
                                                                    <th style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Action</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($toReturn['week_report'] as $item)


                                                                <tr>
                                                                    <td style="text-align:center;">
                                                                        {{$item['week_date']}}</td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['job_created']}}</b></td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['candidate_created']}}</b></td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['application_submitted']}}</b></td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['client_submittal']}}</b></td>
                                                                        <?php $username=$name;
                                                                            $user_id=$data_id; 
                                                                        ?>
                                                                        <td><a href="{{url('team_members_view/excelexport/daily')}}?data_id={{$data_id}}&name={{$name}}&week_date={{$item['week_date']}}"> <span></span> Export In Excel</a></td>
                                                                    <!-- <td><a href="{{url('team_members_view/excelexport/daily')}}/{{$data_id}}/{{$name}}/{{$item['week_date']}}"> <span></span> Export In Excel</a></td> -->

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
                                        <!--end of card-body-->
                                    </div>
                                    <!--end of card-->
                                </div>
                                <!--end of col-->
                            </div>
                            <!--end of row-->
                        </div>
                        <!--end of tab pane-->


                        <div class="tab-pane" id="message-2" role="tabpanel" aria-labelledby="message-tab-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header" style="background-color:white">
                                            <h3 class="card-title" style="font-size:20px;"><b>MONTHLY REPORT OF: {{$name}} </b>
                                            </h3>
                                            <button type="button" class="btn btn-warning text-dark ml-3"
                                                onclick="history.back();" style="float:right;">Back</button>
                                            <button type="button" class="btn btn-danger text-dark"
                                                onclick="get_pdf('table_monthly' , 'Monthly Report Of: {{$name}} → ' , '#monthly_title')"
                                                style="float:right;">PDF Separate</button>
                                            {{-- <button type="button" class="btn btn-success text-dark  ml-3"
                                                onclick="location.reload();" style="float:left;border-radius:10px;">↻</button> --}}
                                            <button type="button" class="btn btn-danger text-dark mr-3"
                                                onclick="get_pdf_all('table_daily' , 'Daily Report Of: {{$name}} → ' , '#daily_title','table_monthly' , 'Monthly Report Of: {{$name}} → ' , '#monthly_title' )"
                                                style="float:right;">PDF</button>

                                        </div>
                                        <div class="card-body mt-4" id="table_monthly">
                                            <div class="row">
                                                <div class="col-12" id="show_month">
                                                    <div class="table-responsive" id="hide_month">
                                                        <h3 class="card-title ml-5 pb-5 pt-5" id="monthly_title"
                                                            style="display:none;">

                                                        </h3>
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Date</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Posted Job List</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Candidate List</th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Application Created
                                                                    </th>
                                                                    <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Client Submittal </th>
                                                                        <th
                                                                        style="text-align:center;color:white;background-color:rgb(10, 153, 247);">
                                                                        Action </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($toReturn['monthly'] as $item)

                                                                <tr>
                                                                    <td style="text-align:center;">
                                                                        {{$item['month_week_one1']}}</td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['job_created_monthly1']}}</b></td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['candidate_created_monthly1']}}</b>
                                                                    </td>
                                                                   
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['application_submitted_monthly1']}}</b>
                                                                    </td>
                                                                    <td style="text-align:center;color:blue;">
                                                                        <b>{{$item['client_submittal_monthly1']}}</b>
                                                                    </td>
                                                                    <?php $username=$name;
                                                                            $user_id=$data_id; 
                                                                        ?>
                                                                        <td><a href="{{url('team_members_view/excelexport/montly')}}?data_id={{$data_id}}&name={{$name}}&week_date={{$item['month_week_one1']}}"> <span></span> Export In Excel</a></td>

                                                                    <!-- <td><a href="{{url('team_members_view/excelexport/montly')}}/{{$data_id}}/{{$name}}/{{$item['month_week_one1']}}"> <span></span> Export In Excel</a></td> -->

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
                                        <!--end of card-body-->
                                    </div>
                                    <!--end of card-->
                                </div>
                                <!--end of col-->
                            </div>
                            <!--end of row-->
                        </div>

                        <!--end of tab pane-->
                    </div>
                    <!--end of tab content-->
                </div><!-- end row -->
            </div> <!-- col -->
        </div> <!-- End row -->
    </div>
    <!--end of content-->
</div>
<!--end of content-page-->
</div>
<!--end of wrapper-->
<div class="modal fade" id="sendmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><h2>Send Report</h2></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row" class="card">
            <div class="col-xl-12">
            <form action="{{url('teammember/send_report')}}" method="post" enctype="multipart/form-data">
                @csrf()                                 
                    <div class="row">
                        <div class="col-md-12">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label" for="example-input-normal">Sender Name</label>
                                <div class="col-sm-8">
                                <input type="text" class="form-control"  name="sender_name" id="" disabled value="{{Session::get('email')}}" required="" aria-required="true" placeholder="Sender Name">
                                <input type="hidden" class="form-control"  name="ID" id=""  value="{{$data_id}}" required="" aria-required="true" placeholder="Sender Name">
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="col-sm-4 control-label" for="example-input-normal">To<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control"  name="send_to" id="" required="" aria-required="true" placeholder="To ">
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">CC</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="send_cc" id="" aria-required="true" placeholder="CC">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">BCC</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="send_bcc" id=""  aria-required="true" placeholder="Bcc">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">Subject<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="send_Subject" id="" required="" aria-required="true" Placeholder="Subject">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">Email Content<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                            <textarea class="wysihtml5 form-control" required  placeholder="Message body" style="height: 200px" name="email_content" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row form-group">
                            <label class="col-sm-4 control-label" for="example-input-normal">file<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="sendfile_doc[]" id=""  aria-required="true" multiple >
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                    </div>
                </div> 
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
     
      </div>
    </div>
  </div>
</div>

@include('include.emp_footer')

<script>
    function get_pdf(value_of_html, name, id_of_div) {
        $(id_of_div).show();
        $(id_of_div).html(name);
        var printContents = document.getElementById(value_of_html).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        $(id_of_div).empty();
        $(id_of_div).hide();
        location.reload();
    }

</script>


<script>
    function get_pdf_all(value_of_html, name, id_of_div, value_of_html1, name1, id_of_div1) {
        $(id_of_div).show();
        $(id_of_div1).show();
        $(id_of_div).html(name);
        $(id_of_div1).html(name1);
        var printContents = document.getElementById(value_of_html).innerHTML;
        var printContents1 = document.getElementById(value_of_html1).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents + printContents1;
        window.print();
        document.body.innerHTML = originalContents;
        $(id_of_div).empty();
        $(id_of_div1).empty();
        $(id_of_div).hide();
        $(id_of_div1).hide();
        location.reload();
    }

</script>
