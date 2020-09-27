@extends('view.layouts.base')

@section('title', 'Thống kê đơn nghỉ phép')

@section('content')
<?php $checkManager = auth()->user()->user_type == \App\Models\User::MANAGER; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form class="card" action="{{route('leave-form.action')}}" method="POST">
            @csrf
              <div class="card-header">
                @if($checkManager)
                <h3 class="card-title">Danh sách đơn nghỉ phép</h3>
                
                <div class="card-tools">
                  <button class="btn btn-info btn-sm" value="approval" name="type">Duyệt <i class="fas fa-check"></i></button>
                  <button class="btn btn-danger btn-sm" value="delete" name="type">Xóa <i class="fa fa-trash"></i></button>
                </div>
                @else
                <h3 class="card-title">Đơn nghỉ phép đã gửi</h3>
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
                      <th class="text-center">Nhân viên</th>
                      @endif
                      <th class="text-center">Nội dung</th>
                      <th class="text-center">Trạng thái</th>
                      <th class="text-center">Ngày nghỉ</th>
                      <th class="text-center">Ngày gửi</th>
                    </tr>
                  </thead>
                  <tbody>
                @if(!empty($list) && $list)
                    @foreach($list as $index=>$item)
                    <tr>
                      @if($checkManager)
                      <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                      @endif
                      <td>{{++$index}}</td>
                      @if($checkManager)
                      <td class="text-center">{{$item->user->full_name}}</td>
                      @endif
                      <?php
                        $content = $item->content;
                        $content = strlen($content) > 40 ? substr($content, 0, 38) . '...' : $content;
                      ?>
                      <td class="text-center">{{$content}}</td>
                      <td class="text-center">
                        @if($item->status)
                        <span class="badge badge-info">Đã duyệt</span>
                        @else
                        <span class="badge badge-danger">Chưa duyệt</span>
                        @endif
                      </td>
                      <td class="text-center">{{Date('d/m/Y', strtotime($item->day_off))}}</td>
                      <td class="text-center">{{Date('d/m/Y', strtotime($item->created_at))}}</td>
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