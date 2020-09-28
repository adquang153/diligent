@extends('view.layouts.base')

@section('title', 'Ngày '.Date('d/m/Y'))

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-6 mx-auto">
        <?php $check = auth()->user()->workInfo();?>
        @if($check === 1 || $check === 0)
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <?php 
                    $type = $check ? 'Meeting' : 'Report';
                  ?>
                {{$type}}
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="card-body" action="{{route('work.diligent')}}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="content">Nội dung làm việc</label>
                    <?php $content = '';
                          if($check === 0)
                            $content = auth()->user()->workInfo('info')->content;
                      ?>
                    <textarea class="form-control" id="content" rows="6" name="content">{{$content}}</textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="type" value="{{strtolower($type)}}" class="btn btn-primary">{{$type}}</button>
                  </div>
                </form>
            </div>
          @endif
          
        </div>
    </div>
    <?php $workHistory = auth()->user()->work_info()
                        ->whereDate('created_at', Date('Y-m-d'))
                        ->whereHas('work', function($q){
                          $q->whereHas('calendar', function($query){
                            $query->where('end_time', '<', Date('H:i:s'))->orWhere('report', '<>', null);
                          });
                        })
                        ->get();
    ?>
    @if(!empty($workHistory) && count($workHistory))
    <div class="row">
    @foreach($workHistory as $item)
      <div class="col-6 {{count($workHistory) == 1 ? 'mx-auto' : ''}}">
      <!-- card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ca {{$item->work->calendar->start_time}} - {{$item->work->calendar->end_time}}</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <ul class="pl-3">
          
            <li class="mb-2">Meeting lúc: {{Date('H:i', strtotime($item->meeting))}}</li>
            <li class="mb-2">{{$item->report ? 'Đã report lúc: ' . Date('H:i', strtotime($item->report)) : 'Chưa report'}}</li>
            <li class="">Nội dung làm việc:</li>
            <p class="pre-line">{{$item->content}}</p>
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Thank {{auth()->user()->full_name}}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- end card -->
      </div>
      <!-- end col -->
    @endforeach
    </div>
    <!-- end row -->
    @endif
</div>

@endsection