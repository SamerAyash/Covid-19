@extends('layouts.app', ['activePage' => 'checkin table', 'titlePage' => 'جدول الأماكن و المحلات'])

@section('content')
    <?php
        $checkins= DB::table('checkins')->paginate(15);
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">جدول تسجيل الدخول</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>المكان</th>
                                <th>رقم هوية المستخدم</th>
                                <th>تاريخ التسجيل</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($checkins as $checkin)
                            <tr>
                                <td>{{$checkin->place_id}}</td>
                                <td>{{$checkin->device_id}}</td>
                                <td>{{$checkin->created_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            {{ $checkins->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

