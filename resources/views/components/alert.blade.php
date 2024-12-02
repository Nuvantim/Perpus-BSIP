@if(Session::has('alert'))
    <script>
        $(function() {
            toastr.{{ Session::get('alert.type') }}("{{ Session::get('alert.message') }}");
          });
    </script>
@endif