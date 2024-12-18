<!--Footer-->


</div>
</div>

<!--Main Content-->

</div>

<!--Page Wrapper-->

<!-- Page JavaScript Files-->
<script src="{{asset('Sleekadmin')}}/assets/js/jquery-1.12.4.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/jquery.min.js"></script>
<!--Popper JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/popper.min.js"></script>
<!--Bootstrap-->
<script src="{{asset('Sleekadmin')}}/assets/js/bootstrap.min.js"></script>
<!--Sweet alert JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/sweetalert.js"></script>
<!--Progressbar JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/progressbar.min.js"></script>
<!--Flot.JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/charts/jquery.flot.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/charts/jquery.flot.pie.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/charts/jquery.flot.categories.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/charts/jquery.flot.stack.min.js"></script>
<!--Chart JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/charts/chart.min.js"></script>
<!--Chartist JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/charts/chartist.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/charts/chartist-data.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/charts/demo.js"></script>
<!--Maps-->
<script src="{{asset('Sleekadmin')}}/assets/js/maps/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/maps/jvector-maps.js"></script>
<!--Bootstrap Calendar JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/calendar/bootstrap_calendar.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/calendar/demo.js"></script>
<!--Nice select-->
<script src="{{asset('Sleekadmin')}}/assets/js/jquery.nice-select.min.js"></script>
<!--Datatable-->
<script src="{{asset('Sleekadmin')}}/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('Sleekadmin')}}/assets/js/dataTables.bootstrap4.min.js"></script>
<!--Alertify JS-->
<script src="{{asset('Sleekadmin')}}/assets/js/alertify.min.js"></script>

<!--Custom Js Script-->
<script src="{{asset('Sleekadmin')}}/assets/js/custom.js"></script>

<script>
//Nice select
$('.bulk-actions').niceSelect();
</script>

<script>
  $('#datatable').DataTable();
</script>

<script>
  alertify.set('notifier', 'position', 'top-right');
  @if(Session::has('message'))
      let message = "{{ Session::get('message') }}";
      let alertType = "{{ Session::get('alert-type', 'info') }}";

      switch(alertType) {
          case 'info':
              alertify.message(message);
              break;
          case 'success':
              alertify.success(message);
              break;
          case 'warning':
              alertify.warning(message);
              break;
          case 'error':
              alertify.error(message);
              break;
      }
  @endif
</script>
</body>
</html>