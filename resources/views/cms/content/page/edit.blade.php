@extends('cms.master.default')

@section('extra-script')
@endsection

@section('content')

<header class="page-header">
  <h2>Chỉnh sửa</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý bài viết</span></li>
      <li><span>{{$page->title}}</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
@if(session('thongbao'))
<div><b>{{session('thongbao')}}</b></div><br>
@endif

<div class="row">
  <form class="form-horizontal" method="post" id="form summary-form">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-7 col-lg-8">
      <section class="panel">
        <div class="row">
          <div class="panel-body">
            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" value="{{$page->title}}" required>
                @if($errors->has('title'))
                <span class="error_mess">{{$errors->first('title')}}</span>
                @endif
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Đường dẫn tin tức</label>
                <input type="text" class="form-control" name="slug" value="{{$page->slug}}">
                @if($errors->has('slug'))
                <span class="error_mess">{{$errors->first('slug')}}</span>
                @endif
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Nội dung</label>
                <textarea class="form-control mce_full" name="content">{{$page->content}}</textarea>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="col-md-5 col-lg-4">
      <section class="panel">
        <div class="row">
          <div class="panel-body">

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Trạng thái</label>
                <select id="status" name="status" class="form-control">
                  <option value="public" @if($page->status == 'public'){{'selected'}}@endif>Hiện</option>
                  <option value="preview" @if($page->status == 'preview'){{'selected'}}@endif>Ẩn</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 form-type center">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary">OK</button>&emsp;
                <a href="cms/page/edit/{{$page->id}}" class="btn btn-default">Reset</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </form>
</div>
<!-- end: page -->

<script type="text/javascript">

</script>
@endsection