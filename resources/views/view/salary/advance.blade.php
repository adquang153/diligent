@extends('view.layouts.base')

@section('title', 'Thống kê ứng lương')

@section('content')
<?php $checkManager = auth()->user()->user_type == \App\Models\User::MANAGER; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form class="card" action="{{route('salary.action')}}" method="POST">
            @csrf
               <div class="card-header">
               @if($checkManager)
                <h3 class="card-title">Danh sách ứng lương</h3>
                <div class="card-tools">
                <button class="btn btn-info btn-sm" value="approval" name="type">Duyệt <i class="fas fa-check"></i></button>
                  <button class="btn btn-danger btn-sm" value="delete" name="type">Xóa <i class="fa fa-trash"></i></button>
                </div>
              @else
              <h3 class="card-title">Yêu cầu đã gửi</h3>
              @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      @if($checkManager)
                      <th></th>
                      @endif
                      <th>#</th>
                      @if($checkManager)
                      <th>Ảnh</th>
                      <th>Nhân viên</th>
                      @endif
                      <th>Số tiền</th>
                      <th>Nội dung</th>
                      <th>Trạng thái</th>
                      <th>Ngày gửi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($list) && count($list))
                        @foreach($list as $index=>$item)
                        <tr>
                            @if($checkManager)
                            <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                            @endif
                            <td>{{++$index}}</td>
                            @if($checkManager)
                            <td><img src="{{asset($item->user->avatar ?? 'images/user.png')}}" class="avt-40" alt="avatar"></td>
                            <td>{{$item->user->full_name}}</td>
                            @endif
                            <td>{{number_format($item->amount)}}</td>
                            <td>{{$item->content}}</td>
                            <td>
                              @if($item->status)
                              <span class="badge badge-info">Đã duyệt</span>
                              @else
                              <span class="badge badge-danger">Chưa duyệt</span>
                              @endif
                            </td>
                            <td>{{Date('d/m/Y', strtotime($item->created_at))}}</td>
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