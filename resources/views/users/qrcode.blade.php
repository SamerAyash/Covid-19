@extends('layouts.app', ['activePage' => '', 'titlePage' => ''])

@section('content')
    <div class="content d-flex justify-content-center text-center">
        <div class="container-fluid">
            <h5>اسم المكان:  {{$placee}}</h5>
            <div>
                {!! \QrCode::size(400)
            ->encoding('UTF-8')
            ->gradient(250, 0, 180, 100,50, 150, 'vertical')
            ->generate('100000000'.$id.','.$placee)
             !!}
            </div>
            <div>
                <button class="btn btn-success">تنزيل الرمز</button>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();
        });
    </script>
@endpush
