@extends('layouts.app', ['activePage' => 'checkin table', 'titlePage' => 'جدول الأماكن و المحلات'])

@section('content')
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
                            <tr>
                                <td>معرض الخضيري مساهمة عامة</td>
                                <td>1341278168</td>
                                <td>1990-01-10</td>
                            </tr>
                            <tr>
                                <td>أكاديمية الخالدي</td>
                                <td>1341278168</td>
                                <td>1979-05-08</td>
                            </tr>
                            <tr>
                                <td>معرض الزامل	</td>
                                <td>1341278168</td>
                                <td>1975-09-27</td>
                            </tr>

                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item active" >
                                    <a class="page-link">
                                        1
                                    </a>
                                </li>
                                <li class="page-item" >
                                    <a class="page-link">
                                        2
                                    </a>
                                </li>
                                <li class="page-item" >
                                    <a class="page-link">
                                        3
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

