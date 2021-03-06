@extends('view.layouts.base')

@section('title', 'Thống kê chuyên cần theo tháng')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <form action="" class="form-inline">
                <div class="form-group mr-3">
                    <select name="month" id="" class="form-control">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}" {{$month == $i ? 'selected' : ''}}>Tháng {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mr-3">
                    <select name="year" id="" class="form-control">
                    <?php $yearFor = intval(Date('Y')); ?>
                    @for($i = $yearFor-3; $i <= $yearFor+3; $i++)
                        <option value="{{$i}}" {{$year == $i ? 'selected' : ''}}>Năm {{$i}}</option>
                    @endfor
                    </select>
                </div>
                <button class="btn btn-info"><i class="fas fa-search"></i> Tìm</button>
            </form>
        </div>
    </div>
    <div class="row">
    <?php $user = auth()->user(); ?>
    @if( $user->user_type == \App\Models\User::MEMBER )
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Tháng: {{$month.'/'.$year}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
                </div>
                <div class="card-body">
                <ul class="pl-3">
                    <li class="">Số ca đã làm: {{auth()->user()->work_info()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->count()}}</li>
                    <li class="">Số đơn xin phép được duyệt: {{auth()->user()->leave_forms()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->where('status', 1)->count()}}</li>
                    <li class="">Số đơn xin phép đang chờ: {{auth()->user()->leave_forms()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->where('status', 0)->count()}}</li>
                    <?php 
                        $money = auth()->user()
                                    ->salary_advance()
                                    ->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])
                                    ->where('status', 1)
                                    ->first();
                    ?>
                    <li class="">Lương đã ứng: {{number_format($money->amount ?? 0)}} <sup>đ</sup></li>
                </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer ">
                    <div class="d-flex justify-content-between">
                        <p class="mb-0">Tổng lương: <span class="font-weight-bold font-18 text-danger">{{number_format(auth()->user()->salaryAdvance($month, $year) - ($money->amount??0), 2)}} <sup>đ</sup></span></p>
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
                <h3 class="card-title">Chuyên cần tháng: {{$month.'/'.$year}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th class="text-center">Nhân viên</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Số ca đã làm</th>
                      <th class="text-center">Số đơn nghỉ phép</th>
                      <th class="text-center">Lương đã ứng</th>
                      <th class="text-center">Tổng lương</th>
                      <th class="text-center">Lương nhận được</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($list) && count($list))
                        @foreach($list as $index=>$item)
                        <tr>
                            <td class="text-center">{{++$index}}</td>
                            <td class="text-center">{{$item->full_name}}</td>
                            <td class="text-center">{{$item->email}}</td>
                            <td class="text-center">{{$item->work_info()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->count()}}</td>
                            <td class="text-center">{{$item->leave_forms()->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])->count()}}</td>
                            <td class="text-center">
                            <?php 
                                $money = $item->salary_advance()
                                                ->whereBetween('created_at', [Date("$year-$month-01"), Date("$year-$month-t")])
                                                ->where('status', 1)
                                                ->first();
                            ?>
                            {{ number_format( $money->amount ?? 0, 2, '.', ',') }}
                            </td>
                            <td class="text-center">{{ number_format($item->salaryAdvance($month, $year), 2, '.', ',')}} <sup>đ</sup> </td>
                            <?php $totalMoney = $item->salaryAdvance($month, $year) - ($money->amount ?? 0); ?>
                            <td class="text-center font-weight-bold text-danger">{{ number_format($totalMoney, 2, '.', ',')}} <sup>đ</sup> </td>
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