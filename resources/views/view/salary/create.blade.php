@extends('view.layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-info col-9 px-0 mx-auto">
                <div class="card-header">
                    <h3 class="card-title">Ứng lương tháng: {{Date('m/Y')}}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('salary.store')}}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Số tiền</label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <p class="mb-0">{{number_format(auth()->user()->salaryAdvance, 2, '.', ',')}} <sup>đ</sup> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Lý do</label>
                            <div class="col-sm-10">
                                <textarea name="content" id="content" value="{{ old('content') }}" class="form-control" rows="6" required></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Ứng lương</button>
                    </div>
                <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection