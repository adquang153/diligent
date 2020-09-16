@extends('view.layouts.base')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8 mx-auto">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Meeting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="card-body" action="{{route('work.meeting')}}" method="POST">
                @csrf
                  <div class="form-group">
                    <label for="content">Nội dung làm việc</label>
                    <textarea class="form-control" id="content" rows="6" name="content"></textarea>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection