<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/ckeditor/contents.css')}}">

    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{url('assets/custom/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/custom/cropper.css')}}" rel="stylesheet">
    <link href="{{url('assets/custom/custom.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(isset($title))
        <title>{{$title}}</title>
    @else
        <title>Document</title>
    @endif
</head>
<body>
@include('backend.layouts.top-header')
@include('backend.layouts.aside')
@yield('top-header')
@yield('aside')
@yield('content')

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>

            </span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Developed By <a href="">Dp dahal</a>
    </div>
</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
<script src="{{url('assets/js/jquery.js')}}"></script>
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
<script src="{{url('assets/js/axios.js')}}"></script>
<script src="{{url('assets/custom/sweetalert.js')}}"></script>
<script src="{{url('assets/custom/dropzone.min.js')}}"></script>
<script src="{{url('assets/custom/cropper.js')}}"></script>
<script src="{{url('assets/custom/custom.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let ckeditorUploadUrl = "{{route('ckeditor-image-upload', ['_token' => csrf_token() ])}}";
</script>
@yield('scripts')

</body>
</html>
