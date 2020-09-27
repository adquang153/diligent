@extends('view.layouts.base')

@section('title', 'Thông tin cá nhân')

@section('content')
<?php $user = $user ?? auth()->user(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card bg-light w-100">
            <div class="card-header text-muted border-bottom">
                <h4 class="mb-0">{{optional($user->contract)->role}}</h4>
            </div>
            <div class="card-body pt-3">
                <div class="row">
                <div class="col-7">
                    <h2 class="lead"><b>{{$user->full_name}}</b></h2>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-envelope-open-text"></i></span> E-Mail: {{$user->email}}</li>
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Địa chỉ: {{$user->address}}</li>
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> SĐT: {{$user->phone}}</li>
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-user-graduate"></i></span> Trình độ học vấn: {{$user->academic_level}}</li>
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-envelope-open-text"></i></span>Mức lương: {{number_format(optional($user->contract)->salary ?? 0)}} <sup>đ</sup> / Tháng </li>
                        @if($user->contract)
                        <li class="mb-2"><span class="fa-li"><i class="fas fa-file-word"></i></span> Thời hạn hợp đồng: 
                            {{Date('d/m/Y', strtotime($user->contract->date_start))}}
                            - {{Date('d/m/Y', strtotime($user->contract->date_end))}}
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-5 text-center">
                    <img src="{{asset($user->avatar ?? 'images/user.png')}}" alt="" class="img-circle img-fluid">
                </div>
                </div>
            </div>
            
            @if(auth()->user()->user_type == \App\Models\User::MANAGER)
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{route('member.edit', $user->id)}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Sửa
                    </a>
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection