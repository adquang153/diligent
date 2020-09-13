<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('plugins/adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('plugins/adminlte/js/demo.js')}}"></script>
<!-- sweetalert -->
<script src="{{asset('plugins/sweetalert2/sweetalert2.all.js')}}"></script>

<script>
    $(function(){
        $('.nav-sidebar > li > a').each(function(){
            if( location.href.includes( $(this).attr('data-active').trim().toLowerCase() ) )
                $(this).addClass('active');
        });
        if($('.nav-sidebar > li').find('a.active').length === 0)
            $('.nav-sidebar > li > a:first').addClass('active');
    });
</script>