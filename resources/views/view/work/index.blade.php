@extends('view.layouts.base')

@section('title', 'Thống kê chuyên cần theo tháng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
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
                    <li class="">Số đơn xin phép được duyệt: {{auth()->user()->leaveForm()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->where('status', 1)->count()}}</li>
                    <li class="">Số đơn xin phép đang chờ: {{auth()->user()->leaveForm()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->where('status', 0)->count()}}</li>
                    <?php 
                        $user = auth()->user();
                        $salary = optional($user->contract)->salary ?? 0;
                        $money = $salary / 30;
                        $money_total = $money * $user->works()->whereBetween('created_at', [Date('Y-m-01'), Date('Y-m-t')])->count();
                    ?>
                    <li>Tổng lương: {{number_format($money_total, 2)}} <sup>đ</sup></li>
                </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-coins mr-2"></i> Ứng lương </a>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    </div>
</div>
@endsection