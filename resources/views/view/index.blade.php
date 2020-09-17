@extends('view.layouts.base')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php $check = auth()->user()->workInfo(); ?>
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
          @else($check === 2)
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Hôm nay: {{Date('d/m/Y')}}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <ul class="pl-3">
              <?php $workHistory = auth()->user()->workInfo('info'); ?>
                <li class="mb-2">Meeting lúc: {{Date('H:i', strtotime($workHistory->meeting))}}</li>
                <li class="mb-2">Đã report lúc: {{Date('H:i', strtotime($workHistory->report))}}</li>
                <li class="">Nội dung làm việc hôm nay:</li>
                <p class="pre-line">{{$workHistory->content}}</p>
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              Thank {{auth()->user()->full_name}}
            </div>
            <!-- /.card-footer-->
          </div>
          @endif
        </div>
    </div>
</div>

@endsection