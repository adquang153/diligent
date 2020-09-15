@extends('view.layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form class="card" action="{{route('leave-form.action')}}" method="POST">
            @csrf
              <div class="card-header">
                <h3 class="card-title">Đơn nghỉ phép đang chờ</h3>
                <div class="card-tools">
                  <button class="btn btn-info btn-sm" value="approval" name="type">Duyệt <i class="fas fa-check"></i></button>
                  <button class="btn btn-danger btn-sm" value="delete" name="type">Xóa <i class="fa fa-trash"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th>#</th>
                      <th>Nhân viên</th>
                      <th>Nội dung</th>
                      <th>Ngày nghỉ</th>
                    </tr>
                  </thead>
                  <tbody>
                @if(!empty($list) && $list)
                    @foreach($list as $index=>$item)
                    <tr>
                    <td><input type="checkbox" name="id[]" value="{{$item->id}}"></td>
                      <td>{{++$index}}</td>
                      <td>{{$item->user->full_name}}</td>
                      <?php
                        $content = $item->content;
                        $content = strlen($content) > 40 ? substr($content, 0, 38) . '...' : $content;
                      ?>
                      <td>{{$content}}</td>
                      <td>{{Date('d/m/Y', strtotime($item->day_off))}}</td>
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