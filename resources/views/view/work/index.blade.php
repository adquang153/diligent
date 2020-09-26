@extends('view.layouts.base')

@section('title', 'Thống kê chuyên cần theo tháng')

@section('content')
<div class="container-fluid">
    <div class="row">
    <?php $user = auth()->user(); ?>
    @if( $user->user_type == \App\Models\User::MEMBER )
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Tháng: {{Date('m/Y')}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
                </div>
                <div class="card-body">
                <ul class="pl-3">
                    <li class="">Số ca đã làm: {{auth()->user()->work_info()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->count()}}</li>
                    <li class="">Số đơn xin phép được duyệt: {{auth()->user()->leave_forms()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->where('status', 1)->count()}}</li>
                    <li class="">Số đơn xin phép đang chờ: {{auth()->user()->leave_forms()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->where('status', 0)->count()}}</li>
                </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer ">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Tổng lương: {{number_format(auth()->user()->salaryAdvance, 2)}} <sup>đ</sup></p>
                        <a href="{{route('salary.create')}}" class="btn btn-danger btn-sm"><i class="fas fa-coins mr-2"></i> Ứng lương</a>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    @else
        <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chuyên cần tháng: {{Date('m/Y')}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nhân viên</th>
                      <th>Email</th>
                      <th>Số ca đã làm</th>
                      <th>Số đơn nghỉ phép</th>
                      <th>Lương tháng này</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($list) && count($list))
                        @foreach($list as $index=>$item)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->work_info()->count()}}</td>
                            <td>{{$item->leave_forms()->count()}}</td>
                            <td>{{$item->salaryAdvance}}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            @if(!empty($list) && $list)
                {{$list->links('vendor.pagination.bootstrap-4')}}
            @endif
        </div>
    @endif
    </div>
</div>
@endsection