@extends('layouts.app', ['activePage' => 'userQr table', 'titlePage' => 'جدول المستخدمين'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div id="app">
                <user-qr-component></user-qr-component>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            md.initDashboardPageCharts();
        });
    </script>
@endpush
@push('js')
    <script src="{{asset('js/app.js')}}" defer></script>
@endpush
