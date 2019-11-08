<meta name="csrf-token" content="{{ csrf_token() }}">
@include('include.header')
@include('include.leftSidebar')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
                                        <div class="card-header">
                                            <h3 class="card-title">Daily Report:

                                            </h3>
                                            <form class="form-inline" style="float:right;margin-bottom: 0px;">
                                                <div class="form-group">
                                                    <label class="sr-only" for="exampleInputEmail2">Start Date</label>
                                                    <input type="date" id="daily_1date" class="form-control"
                                                        placeholder="Start Date">
                                                </div>
                                                <div class="form-group m-l-10">
                                                    <label class="sr-only" for="exampleInputPassword2">End Date</label>
                                                    <input type="date" id="daily_2date" class="form-control"
                                                        placeholder="End Date">
                                                </div>
                                                <button type="button" onclick="daily()"
                                                    class="btn btn-icon waves-effect waves-light btn-purple m-b-5">
                                                    <i class="fa fa-search"></i> </button>
                                            </form>
                                        </div>
                                        <!--end of card header-->
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12" id="view_daily">
                                                    <div class="table-responsive" id="daily">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align:center;">Date</th>
                                                                    <th style="text-align:center;">Posted Job List</th>
                                                                    <th style="text-align:center;">Candidate List</th>
                                                                    <th style="text-align:center;">Candidate Applied</th>
                                                                    <th style="text-align:center;">Candidate Applied To Job</th>
                                                                    {{-- <th>Action</th> --}}


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($toReturn['week_report'] as $item)


                                                                <tr>
                                                                    <td style="text-align:center;">{{$item['week_date']}}</td>
                                                                    <td style="text-align:center;">{{$item['job_created']}}</td>
                                                                    <td style="text-align:center;">{{$item['candidate_created']}}</td>
                                                                    <td style="text-align:center;">{{$item['client_submittal']}}</td>
                                                                    <td style="text-align:center;">{{$item['application_submitted']}}</td>

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
                                        <div class="card-header">
                                            <h3 class="card-title">Monthly
                                                Report:
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12" id="show_month">
                                                    <div class="table-responsive" id="hide_month">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Month</th>
                                                                    <th>Jobs Created</th>
                                                                    <th>Jobs Assigned</th>
                                                                    <th>Candidate Created</th>
                                                                    <th>Application Submitted</th>
                                                                    <th>Client Submittal</th>
                                                                    <th>Group Report</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <td><a href="" data-toggle="modal"
                                                                        data-target=".monthlyreport"><i
                                                                            class="fa fa-edit"
                                                                            aria-hidden="true"></i></a></td>
                                                                </tr>
                                                                <div class="modal fade monthlyreport" tabindex="-1"
                                                                    role="dialog" aria-labelledby="myLargeModalLabe1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="container-fluid">

                                                                                <div class="row">
                                                                                    <div class="col-md-11">
                                                                                        <h3>Group Report</h3>
                                                                                    </div>
                                                                                    <div class="col-md-1 mt-4">
                                                                                        <a href=""
                                                                                            data-dismiss="modal"><i
                                                                                                class="fa ion-android-close"></i></a>
                                                                                        </h3>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Date</h4>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Jobs Created</h4>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Jobs Assigned</h4>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Candidate Created</h4>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Application Submitted
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h4>Client Submittal </h4>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6>
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6
                                                                                            style="color:blue;text-align:center;">
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6
                                                                                            style="color:blue;text-align:center;">
                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6
                                                                                            style="color:blue;text-align:center;">

                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6
                                                                                            style="color:blue;text-align:center;">

                                                                                        </h6>
                                                                                    </div>
                                                                                    <div class="col-md-2"
                                                                                        style="border: 1px solid black;">
                                                                                        <h6
                                                                                            style="color:blue;text-align:center;">

                                                                                        </h6>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


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

@include('include.footer')
