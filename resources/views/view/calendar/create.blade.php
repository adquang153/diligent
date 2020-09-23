@extends('view.layouts.base')

@section('title', 'Tạo ca làm việc')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8 mx-auto">
            <form class="card card-info" action="{{route('calendar.store', $date)}}" method="post">
                @csrf
                <div class="card-header">
                    <h3 class="card-title">Ngày {{Date('d/m/Y', strtotime($date))}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="start_time">Thời gian vào ca</label>
                                    <input type="time" id="start_time" name="start_time" class="form-control"
                                        value="{{ old('start_time') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="end_time">Thời gian kết thúc</label>
                                    <input type="time" id="end_time" name="end_time" class="form-control"
                                        value="{{ old('end_time') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="total">Số nhân viên</label>
                                    <input type="number" min="1" id="total" name="total" class="form-control"
                                        value="{{ old('total') ?? 1 }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Chọn nhân viên</label>
                                    <select class="duallistbox" name="users[]" multiple="multiple">
                                    @if(!empty($users) && count($users))
                                        @foreach($users as $item)
                                        <option value="{{$item->id}}" {{ in_array($item->id, old('users') ?? []) ? 'selected' : '' }}>
                                            {{$item->full_name}}
                                        </option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary btn-sm">Hủy</button>
                        <button class="btn btn-info btn-sm">Tạo ca</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script>
    $(function(){
       //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox();
    });
</script>
@endsection