@extends('view.layouts.base')

@section('title', 'Ngày: '. Date('d/m/Y', strtotime($date)))

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
        @if($date >= Date('Y-m-d'))
            <a href="{{route('calendar.create', $date)}}" class="btn btn-primary mb-3"><i class="fas fa-plus mr-1"></i> Thêm ca</a>
        @endif
            <h5>Tổng: {{count($list ?? [])}} ca</h5>
        </div>
    </div>
    @if(!empty($list) && count($list))
    <div class="row">
        @foreach($list as $item)
        <div class="col-6">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Từ {{$item->start_time}} - Đến {{$item->end_time}}</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-plus"></i></button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="px-4">
                        <li>Giới hạn: {{$item->total}} (người)</li> 
                        <li>Đã thêm: {{$item->works_count}} (người)</li>
                    </ul>
                    @if( !empty($item->members) && count($item->members))
                    <table class="table table-bordered">
                        <thead ">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Tên nhân viên</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->members as $index=>$member)
                            <tr>
                                <td class="text-center">{{++$index}}</td>
                                <td class="text-center"><img src="{{ asset($member->avatar ?? 'images/user.png') }}" class="avt-40" alt="avatar user" ></td>
                                <td class="text-center">{{$member->full_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <div class="d-flex justify-content-between">
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm del-work"><i class="fa fa-trash mr-1"></i> Xóa ca</a>
                        <form action="{{ route('calendar.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <?php $date_time = Date('Y-m-d H:i:s', strtotime( $item->workday . $item->start_time )); ?>
                        @if( $date_time > Date('Y-m-d H:i:s') )
                        <a href="{{route('calendar.edit', $item->id)}}" class="btn btn-primary btn-sm"><i class="fas fa-user-edit mr-1"></i> Sửa ca</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        @endforeach
    </div>
    @else
    <div class="row mt-5">
        <div class="col">
            <h4 class="text-center">Chưa có ca nào trong ngày</h4>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    $(function(){
        $('.del-work').on('click', function(){
            Swal.fire({
                title: 'Bạn có muốn xóa ca làm việc này?',
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                showCancelButton: true,
                reverseButtons: true
            }).then((res)=>{
                if(res.value){
                    $(this).siblings('form').submit();
                }
            });
        });
    });
</script>
@endsection