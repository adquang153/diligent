@extends('view.layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-info col-9 px-0 mx-auto">
                <div class="card-header">
                    <h3 class="card-title">Đơn nghỉ phép</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('leave-form.store')}}" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="day_off" class="col-sm-2 col-form-label">Chọn ngày nghỉ</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control w-50" value="{{old('day_off')}}" id="day_off" name="day_off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 col-form-label">Lý do</label>
                            <div class="col-sm-10">
                                <textarea name="content" id="content" value="{{ old('content') }}" class="form-control" rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Gửi</button>
                    </div>
                <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection