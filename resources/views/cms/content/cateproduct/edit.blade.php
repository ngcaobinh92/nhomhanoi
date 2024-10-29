@extends('cms.master.default')

@section('content')
<header class="page-header">
  <h2>Danh mục</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Danh mục</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->
@if(session('thongbao'))
<div><b>{{session('thongbao')}}</b></div><br>
@endif

<div class="row">
  <form class="frm-pr-add" method="post" action="">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-12">
      @if(session('message'))
      <div class="alert alert-success">{{session('message')}}</div>
      @endif
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Tên danh mục</label>
        @if($errors->has('title'))
        <br>
        <span>{{$errors->first('title')}}</span>
        @endif
        <input class="form-control" name="title" type="text" value="{{ $data->title }}" required>
      </div>

      <div class="form-group">
        <label>Đường dẫn danh mục</label>
        <input class="form-control" name="slug" type="text" value="{{ $data->slug }}">
      </div>

      <div class="form-group">
        <label>Danh mục cha</label>
        <select name="parent" class="form-control">
          <option value="0">Không</option>
          @foreach($categories_list as $cp)
            @if($cp->parent == 0)
            <option value="{{$cp->id}}" @if($data->parent == $cp->id){{'hidden selected'}}@endif>{{ $cp->title }}</option>
              @foreach($categories_list as $cp2)
                @if($cp2->parent == $cp->id)
                <option value="{{$cp2->id}}" @if($data->parent == $cp2->id){{'hidden selected'}}@endif>-- &nbsp;&nbsp;{{$cp2->title}}</option>
                @endif
              @endforeach
            @endif
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Mô tả</label>
        <textarea class="form-control" rows="3" name="description">{{ $data->description }}</textarea>
      </div>

      <div class="form-group">
        <label>Vị trí</label>
        <input class="form-control" name="order" type="number" value="0" required>
      </div>

      <div class="form-group">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
          <option value="public" @if($data->status == 'public'){{'hidden selected'}}@endif>Hiển thị</option>
          <option value="preview" @if($data->status == 'preview'){{'hidden selected'}}@endif>Ẩn</option>
        </select>
      </div>

      <div class="form-group">
        <label>Ảnh mô tả</label>
        <input type="hidden" name="featured_image" id="featured_image" value="{{ $data->featured_image }}">
        <img src="{{ $data->featured_image }}" id="featured_image_src" class="featured_image" width="100%">
        <p><a class="btn btn-default imageUpload">Chọn ảnh</a></p>
      </div>

      <div class="form-group">
        <label>Ảnh phụ</label>
        <input type="hidden" name="thump_image" id="featured_icon" value="{{ $data->thump_image }}">
        <img src="{{ $data->thump_image }}" id="featured_icon_src" class="featured_icon" width="100%">
        <p><a class="btn btn-default iconUpload">Chọn ảnh</a></p>
      </div>

      <p>
        <button type="submit" class="btn btn-primary">Cập nhật</button> &nbsp; 
        <a href="cms/danh-muc/list" class="btn btn-primary">Hủy</a>
      </p>
    </div>

    <div class="col-md-8">
      <label>&nbsp;</label>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Tên danh mục</th>
              <th>Trạng thái</th>
              <th>Áp dụng</th>
              <th>Vị trí</th>
              <th>Thao tác</th>
            </tr>
          </thead>

          <tbody>
            @foreach($categories_list as $cp)
              @if($cp->parent == 0)
                <tr data-id="{{ $cp->id }}" data-parent="{{ $cp->parent }}">
                  <td class="td-header">
                    <i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>
                  </td>
                  <td>{{ $cp->title }}</td>
                  <td>{{ $cp->status }}</td>
                  <td>{{ $cp->type }}</td>
                  <td>{{ $cp->order }}</td>
                  <td>
                    <a href="cms/danh-muc/edit/{{$cp->id}}"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                    <a class="btn-delete-cat" href="cms/danh-muc/delete/{{$cp->id}}"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                  </td>
                </tr>
                @foreach($categories_list as $cp2)
                  @if($cp2->parent == $cp->id)
                    <tr data-id="{{ $cp2->id }}" data-parent="{{ $cp2->parent }}">
                      <td class="td-header">
                        <i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>
                      </td>
                      <td>-- &nbsp;&nbsp;{{ $cp2->title }}</td>
                      <td>{{ $cp2->status }}</td>
                      <td>{{ $cp2->type }}</td>
                      <td>{{ $cp2->order }}</td>
                      <td>
                        <a href="cms/danh-muc/edit/{{$cp2->id}}"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                        <a class="btn-delete-cat" href="cms/danh-muc/delete/{{$cp2->id}}"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                      </td>
                    </tr>
                    @foreach($categories_list as $cp3)
                      @if($cp3->parent == $cp2->id)
                        <tr data-parent="{{ $cp3->parent }}">
                          <td></td>
                          <td>------ &nbsp;&nbsp;{{ $cp3->title }}</td>
                          <td>{{ $cp3->status }}</td>
                          <td>{{ $cp3->type }}</td>
                          <td>{{ $cp3->order }}</td>
                          <td>
                            <a href="cms/danh-muc/edit/{{$cp3->id}}"><span class="glyphicon glyphicon-pencil"></span> Sửa</a>
                            <a class="btn-delete-cat" href="cms/danh-muc/delete/{{$cp3->id}}"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </form>
</div>

<!-- end: page -->
@endsection

@section('extra-script')
<script type="text/javascript">
$('.td-header').click(function(){
  var id = $(this).parent().data("id");
  if ($('tr[data-id="'+id+'"] td:first-child').hasClass('expanded')) {
    $('tr[data-parent="'+id+'"]').fadeIn(500);
    $('tr[data-parent="'+id+'"]').each(function( index ) {
      var id_sub = $(this).data("id");
      $('tr[data-parent="'+id_sub+'"]').fadeIn(500);
      $('tr[data-id="'+id_sub+'"] td:first-child').removeClass('expanded');
      $('tr[data-id="'+id_sub+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>');
    });
    $('tr[data-id="'+id+'"] td:first-child').removeClass('expanded');
    $('tr[data-id="'+id+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-minus-square-o" style="cursor: pointer;"></i>');
  } else {
    $('tr[data-parent="'+id+'"]').fadeOut(500);
    $('tr[data-parent="'+id+'"]').each(function( index ) {
      var id_sub = $(this).data("id");
      $('tr[data-parent="'+id_sub+'"]').fadeOut(500);
      $('tr[data-id="'+id_sub+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-plus-square-o" style="cursor: pointer;"></i>');
      $('tr[data-id="'+id_sub+'"] td:first-child').addClass('expanded');
    });
    $('tr[data-id="'+id+'"] td:first-child').html('<i data-toggle="" class="fa text-primary h5 m-none fa-plus-square-o" style="cursor: pointer;"></i>');
    $('tr[data-id="'+id+'"] td:first-child').addClass('expanded');
  }
});

$('.btn-delete-cat').click(function(){
  if(confirm('Bạn chắc chắn muốn thực hiện hành động?')){
    var del_url = $(this).attr('href');
    $.ajax({
      type: 'get',
      url: del_url,
      context: this
    }).done(function(data){
      if(data > 0){
        location.reload();
      }else{
        alert('Không áp dụng được với kiểu dữ liệu này');
      }
    });
  }
  return false;
});

</script>
@endsection