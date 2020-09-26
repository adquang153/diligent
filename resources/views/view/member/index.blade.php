@extends('view.layouts.base')

@section('title', 'Quản lý nhân viên')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form class="card" action="{{route('member.delete')}}" method="POST">
            @csrf    
               <div class="card-header">
                <h3 class="card-title">Danh sách nhân viên</h3>
                <div class="card-tools">
                  <button class="btn btn-danger btn-sm">Xóa <i class="fa fa-trash"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>Ảnh</th>
                      <th>Nhân viên</th>
                      <th>Email</th>
                      <th>Chức vụ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($list) && count($list))
                        @foreach($list as $index=>$item)
                        <tr data-url="{{route('member.profile', $item->id)}}" class="redirect">
                            <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                            <td>{{++$index}}</td>
                            <td><img src="{{asset($item->avatar ?? 'images/user.png')}}" class="avt-40" alt="avatar"></td>
                            <td>{{$item->full_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{optional($item->contract)->role}}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </form>
            @if(!empty($list) && $list)
                {{$list->links('vendor.pagination.bootstrap-4')}}
            @endif
        </div>
    </div>
</div>
@endsection