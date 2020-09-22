@extends('view.layouts.base')

@section('title', 'Ngày: '. Date('d/m/Y', strtotime($date)))

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <a href="" class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i> Thêm ca</a>
            <h5>Tổng: {{count($list ?? [])}} ca</h5>
        </div>
    </div>
    @if(!empty($list) && count($list))
    <div class="row">
        @foreach($list as $item)
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Từ {{$item->start_time}} - Đến {{$item->end_time}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Progress</th>
                                <th style="width: 100px" class="text-center">Đã thêm</th>
                                <th style="width: 130px" class="text-center">Số nhân viên</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td style="vertical-align: middle;">
                                    <div class="progress progress-xs">
                                        <?php $perCent = ($item->works_count / $item->total)*100; ?>
                                        <div class="progress-bar progress-bar-danger " style="width: {{$perCent}}%;"></div>
                                    </div>
                                </td>
                                <td>{{$item->works_count}}</td>
                                <td>{{$item->total}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-1"></i> Xóa ca</a>
                        <a href="" class="btn btn-primary btn-sm"><i class="fas fa-user-edit mr-1"></i> Sửa ca</a>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        @endforeach
    </div>
    @else
    <div class="row mt-5">
        <div class="col">
            <h4 class="text-center">Chưa có ca nào trong ngày</h4>
        </div>
    </div>
    @endif
</div>
@endsection