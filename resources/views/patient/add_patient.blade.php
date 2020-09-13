@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'الرئيسية'])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">إضافة حالة</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body table-responsive">
                        <form @submit.prevent="save()">
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" class="form-control" name="first_name" placeholder="اسم الشخص">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="father_name"  placeholder="اسم الوالد">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="granddad_name" placeholder="اسم الجد">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="last_name" placeholder="اسم العائلة">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" class="form-control" name="id_number" placeholder="رقم البطاقة الشخصية">
                                </div>
                                <div class="col">
                                    <select class="form-control" name="gender" data-style="btn btn-link" id="genderFormControlSelect1">
                                        <option disabled>الجنس</option>
                                        <option value="male">رجل</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" class="form-control" name="phone" placeholder="رقم المحمول">
                                </div>
                                <div class="col">
                                    <select class="form-control" name="status" data-style="btn btn-link" id="statusFormControlSelect1">
                                        <option disabled>الحالة</option>
                                        <option>معافى</option>
                                        <option>مخالط</option>
                                        <option>مصاب</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col">
                                    <input type="text" class="form-control" name="city" placeholder="المدينة">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="area" placeholder="المنطقة">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="date_injury" placeholder="تاريخ الإصابة">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">إضافة</button>
                            <button class="btn btn-primary" type="submit">تعديل</button>
                        </form>
                    </div>
                </div>
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
