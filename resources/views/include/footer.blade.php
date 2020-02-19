<footer class="footer" style="text-align:center;">
    <center><div>ATS
    © 2019 - 2020 BABA Software. All rights reserved.</div></center>
</footer>

    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{url('assets/js/jquery.min.js')}}"></script>
        <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('assets/js/detect.js')}}"></script>
        <script src="{{url('assets/js/fastclick.js')}}"></script>
        <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{url('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{url('assets/js/waves.js')}}"></script>
        <script src="{{url('assets/js/wow.min.js')}}"></script>
        <script src="{{url('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{url('assets/js/jquery.scrollTo.min.js')}}"></script>
        
        <!-- jQuery -->
        <script src="{{url('/plugins/moment/moment.min.js')}}"></script>
        
        <!-- Counter js  -->
        <script src="{{url('/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{url('/plugins/counterup/jquery.counterup.min.js')}}"></script>
        
        <!-- sweet alerts -->
        <script src="{{url('/plugins/sweetalert2/sweetalert2.js')}}"></script>
        
        <!-- flot Chart -->
        <script src="{{url('/plugins/flot-chart/jquery.flot.min.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.time.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.tooltip.min.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.resize.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.pie.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.selection.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.stack.js')}}"></script>
        <script src="{{url('/plugins/flot-chart/jquery.flot.crosshair.js')}}"></script>

        <!-- Todoapp -->
        <script src="{{url('assets/pages/jquery.todo.js')}}"></script>
        
        <!-- jQuery  -->
        <script src="{{url('assets/pages/jquery.chat.js')}}"></script>
        
        <!-- Dashboard js  -->
        <script src="{{url('assets/pages/jquery.dashboard.js')}}"></script>

        <!-- App js  -->
        <script src="{{url('assets/js/jquery.app.js')}}"></script>
        <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
          <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
         <script src="{{url('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
          <script src="{{url('plugins/datatables/dataTables.buttons.min.js')}}"></script>
           <script src="{{url('plugins/datatables/dataTables.buttons.min.js')}}"></script>
            <script src="{{url('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{url('plugins/datatables/jszip.min.js')}}"></script>
         <script src="{{url('plugins/datatables/pdfmake.min.js')}}"></script>
           <script src="{{url('plugins/datatables/vfs_fonts.js')}}"></script>
            <script src="{{url('plugins/datatables/buttons.html5.min.js')}}"></script>
            <script src="{{url('plugins/datatables/buttons.print.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.keyTable.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.keyTable.min.js')}}"></script>
             <script src="{{url('plugins/datatables/dataTables.scroller.min.js')}}"></script>
             <script src="{{url('plugins/datatables/dataTables.scroller.min.js')}}"></script>
             <script src="{{url('plugins/datatables/dataTables.responsive.min.js')}}"></script>
            <script src="{{url('plugins/datatables/dataTables.responsive.min.js')}}"></script>
             <script src="{{url('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
             <script src="{{url('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
        <!-- <script src="{{url('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script> -->
        <script>

            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();
            });
        </script>

        <script>
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
            
        </script>
         <script src="{{url('assets/js/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor', {
    toolbar: [
     { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     // { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
     { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
     // [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
     '/',                   
     { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }
    ]
   });
</script>
 <script src="{{('assets/pages/datatables.init.js')}}"></script>


        <script>
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "{{('plugins/datatables/json/scroller-demo.json')}}", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();
        </script>
         <script type="text/javascript">
            $( document ).ready(function() {
            // function notification()
            // {
                $("#notification_data").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('notifications')}}",
                    type: 'get',
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        var No_notifiacation= data.length;
                        $('#notification_no').html(No_notifiacation); 
                        $.each(data,function(i,notifications){
                            id = notifications.notification_service_id;
                            // $("#notification_data").append("<a href='notification_data/"+id+"'>"+notifications.notification_text+"</a>");;
                            var noti = ` <div onMouseOut="this.style.BackgroundColor=#90B0FF"><a href="{{url('employer/notification_data/`+id+`')}}" style='font-size:15px;text-decloration:none;'> 
                                <b style="color:#E50D0D;font-size:16px;">`+notifications.code_title+`</b>
                                <br>
                                <span style="color:black">`+notifications.notification_text+`</span> <br>
                                <span style="color:black">`+notifications.by_personn+`</span>
                                </a></div>
                                <br>
                                <br>  `;
                            $("#notification_data").append(noti);
                        });
                    }
                });
 
            
            // }
        });
           
        </script>
    
        <!-- Datatable init js -->


        <script>
        
        // $('#hide_org').show();
        // $('#hide_org').hide();

        $(document).ready(function(){
            $.ajax({
                url: "{{url('permission/org')}}",
                type:"GET",
                
                success:function(data){
                    console.log(data);
                    if(data == "Yes"){
                        $('#hide_org').show();
                    }else{
                        $('#hide_org').hide();
                    }
                },
                error:function(data){
                    console.log(data);

                },
            });
        });

        
        </script>
       </body>

<!-- Mirrored from coderthemes.com/moltran/blue/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Jun 2019 12:15:40 GMT -->
</html>
        