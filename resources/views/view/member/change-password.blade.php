@extends('view.layouts.base')

@section('title', 'Đổi mật khẩu')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form class="card" action="{{ route('change-password.confirm') }}" method="POST" >
            @csrf
                <div class="card-header">{{ __('Đổi mật khẩu') }}</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu cũ') }}</label>

                        <div class="col-md-6">
                            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') }}" required autocomplete="old_password" autofocus>

                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu mới') }}</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" required autocomplete="new_password" autofocus>
                            </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu mới') }}</label>

                        <div class="col-md-6">
                            <input id="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required autocomplete="new_password_confirmation" autofocus>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                   <div class="text-right">
                        <button class="btn btn-info btn-sm" type="submit">Thay đổi</button>
                   </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection