@extends('view.layouts.base')

@section('title', 'Quản lý nhân viên')

@section('content')
<?php $user = $user ?? auth()->user(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sửa thông tin') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('member.update', $user->id)}}">
                        @csrf

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Họ Tên') }}</label>
                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{$user->full_name}}" required autocomplete="full_name" autofocus>

                                @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Chức vụ') }}</label>

                            <div class="col-md-6">
                                <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ optional($user->contract)->role }}" required autocomplete="role">

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Mức lương') }}</label>

                            <div class="col-md-6">
                                <label for="salary" class="d-flex align-items-center">
                                    <input type="number" min="0" id="salary" name="salary" value="{{ optional($user->contract)->salary }}" class="form-control d-inline mr-2 w-50"> <sup>đ</sup> / Tháng
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>
                            <div class="col-md-6">
                                <label for="address" class="d-flex align-items-center">
                                    <input type="text" name="address" value="{{ $user->address }}" class="form-control d-inline"> 
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>
                            <div class="col-md-6">
                                <label for="phone" class="d-flex align-items-center">
                                    <input type="number" min="0" name="phone" value="{{ $user->addres }}" class="form-control d-inline"> 
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Trình độ học vấn') }}</label>
                            <div class="col-md-6">
                                <label for="academic_level" class="d-flex align-items-center">
                                    <textarea name="academic_level" rows="3" class="form-control d-inline">{{ $user->academic_level }}</textarea>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label text-center">{{ __('Thời hạn hợp đồng:') }}</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Từ') }}</label>

                            <div class="col-md-6">
                                <label class="d-flex align-items-center">
                                    <input type="date" name="date_start" value="{{ optional($user->contract)->date_start }}" class="form-control d-inline mr-2 w-50">
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Đến') }}</label>

                            <div class="col-md-6">
                                <label class="d-flex align-items-center">
                                    <input type="date" name="date_end" value="{{ optional($user->contract)->date_end }}" class="form-control d-inline mr-2 w-50">
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sửa') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{asset($user->avatar ?? 'images/user.png')}}" alt="avatar user" style="width: 100px; height: 100px; object-fit:cover; object-position: center, center;">
                        <p class="mb-0 mt-3">Ảnh đại diện</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection