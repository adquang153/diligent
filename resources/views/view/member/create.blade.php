@extends('view.layouts.base')

@section('title', 'Quản lý nhân viên')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cấp tài khoản') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('member.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Họ Tên') }}</label>

                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Loại tài khoản') }}</label>

                            <div class="col-md-6">
                               <select name="user_type" id="user_type" class="form-control @error('email') is-invalid @enderror" id="">
                                   <option value="member">Nhân viên</option>
                                   <option value="manager" {{old('user_type') === 'manager' ? 'selected' : ''}}>Quản trị viên</option>
                               </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Chức vụ') }}</label>

                            <div class="col-md-6">
                                <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" autocomplete="role">

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
                                    <input id="salary" type="number" min="0" id="salary" name="salary" value="{{old('salary')}}" class="form-control d-inline mr-2 w-50"> <sup>đ</sup> / Tháng
                                </label>
                            </div>
                        </div>
                        <div class="form-group row" id="contract">
                            <label for="password-confirm" class="col-md-6 col-form-label text-center">{{ __('Thời hạn hợp đồng:') }}</label>
                            <div class="col-12 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Từ') }}</label>
                                <div class="col-md-6">
                                    <label class="d-flex align-items-center">
                                        <input type="date" name="date_start" value="{{old('date_start')}}" class="form-control d-inline mr-2 w-50">
                                    </label>
                                </div>
                            </div>
                            <div class="col-12 row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Đến') }}</label>

                                <div class="col-md-6">
                                    <label class="d-flex align-items-center">
                                        <input type="date" name="date_end" value="{{old('date_end')}}" class="form-control d-inline mr-2 w-50">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tạo') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

    $(function(){
        function check(value){
            if( value === 'manager' ){
                $('#role').parents('.form-group').fadeOut(500);
                $('#salary').parents('.form-group').fadeOut(500);
                $('#contract').fadeOut(500);
            }else{
                $('#role').parents('.form-group').fadeIn(500);
                $('#salary').parents('.form-group').fadeIn(500);
                $('#contract').fadeIn(500);
            }
        }
        check($('#user_type').val());
        $('#user_type').on('change', function(){
            check($(this).val());
        });
    });
</script>
@endsection