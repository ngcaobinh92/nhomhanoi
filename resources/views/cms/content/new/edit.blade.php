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
      <li><span>Quán lý tin tức</span></li>
      <li><span>{{$new->title}}</span></li>
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
                <input type="text" class="form-control" name="title" value="{{$new->title}}" required>
                @if($errors->has('title'))
                <span class="error_mess">{{$errors->first('title')}}</span>
                @endif
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Đường dẫn tin tức</label>
                <input type="text" class="form-control" name="slug" value="{{$new->slug}}">
                @if($errors->has('slug'))
                <span class="error_mess">{{$errors->first('slug')}}</span>
                @endif
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Nội dung</label>
                <textarea class="form-control mce_full" name="content">{{$new->content}}</textarea>
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
                <label class="control-label">Tags</label>
                <input name="tags" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="{{$new->tags}}">
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Ảnh mô tả</label>
                  <input type="hidden" name="featured_image" id="featured_image" value="{{$new->featured_image}}">
                  <img src="{{$new->featured_image}}" id="featured_image_src" class="thumbnail" width="100%">
                  <p><a class="btn btn-default imageUpload">Ảnh mô tả</a></p>
              </div>
            </div>

            <div class="col-sm-12 form-type">
              <div class="form-group">
                <label class="control-label">Trạng thái</label>
                <select id="status" name="status" class="form-control">
                  <option value="public" @if($new->status == 'public'){{'selected'}}@endif>Hiện</option>
                  <option value="preview" @if($new->status == 'preview'){{'selected'}}@endif>Ẩn</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 form-type center">
              <div class="form-group">
                <br>
                <button type="submit" class="btn btn-primary">OK</button>&emsp;
                <a href="cms/tin-tuc/edit/{{$new->id}}" class="btn btn-default">Reset</a>
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