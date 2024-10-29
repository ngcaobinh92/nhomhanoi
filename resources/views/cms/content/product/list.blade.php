@extends('cms.master.default')

@section('content')

@if(session('thongbao'))
<span class="error"><b>{{session('thongbao')}}</b></span>
@endif

<header class="page-header">
  <h2>{{ trans('cms.danh_sach') }}</h2>
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quán lý sản phẩm</span></li>
      <li><span>Danh sách</span></li>
    </ol>

    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<div class="row">
  <section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="fa fa-caret-down"></a>
          <a href="#" class="fa fa-times"></a>
        </div>
      <h2 class="panel-title">Danh sách</h2>
        
      <form method="GET">
        <section>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Tiêu đề</label>
                  <input type="text" name="title" class="form-control" value="@if(isset($_GET['title'])){{$_GET['title']}}@endif">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">Lọc</label>
                  <select id="type_date" name="type_date" class="form-control">
                    <option value="created_at" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'created_at'){{'selected'}}@endif >Ngày tạo</option>
                    <option value="updated_at" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'updated_at'){{'selected'}}@endif>Ngày cập nhật</option>
                    <option value="origin_price" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'){{'selected'}}@endif>Khoảng giá gốc</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group" id="range">
                  <label class="control-label">Trong khoảng</label>
                  <div class="input-daterange input-group date_range @if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'){{'hidden'}}@endif" data-plugin-datepicker>
                    <span class="input-group-addon">Từ</span>
                    <input type="text" class="form-control" name="start" value="@if(isset($_GET['start'])){{$_GET['start']}}@endif" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'){{'disabled'}}@endif>
                    <span class="input-group-addon">Đến</span>
                    <input type="text" class="form-control" name="end" value="@if(isset($_GET['end'])){{$_GET['end']}}@endif" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'origin_price'){{'disabled'}}@endif>
                  </div>
                  <div class="input-daterange input-group amount_range @if(@$_GET['type_date'] == 'origin_price')@else{{'hidden'}}@endif">
                    <span class="input-group-addon">Từ</span>
                    <input type="number" class="form-control" name="start" value="@if(isset($_GET['start'])){{$_GET['start']}}@endif" @if(@$_GET['type_date'] == 'origin_price')@else{{'disabled'}}@endif>
                    <span class="input-group-addon">Đến</span>
                    <input type="number" class="form-control" name="end" value="@if(isset($_GET['end'])){{$_GET['end']}}@endif" @if(@$_GET['type_date'] == 'origin_price')@else{{'disabled'}}@endif>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.trang_thai') }}</label>
                  <select id="status" name="status" class="form-control">
                    <option value="" @if(isset($_GET['status']) && $_GET['status'] == ''){{'selected'}}@endif>Tất cả</option>
                    <option value="preview" @if(isset($_GET['status']) && $_GET['status'] == 'preview'){{'selected'}}@endif>Ẩn</option>
                    <option value="public" @if(isset($_GET['status']) && $_GET['status'] == 'public'){{'selected'}}@endif>Hiện</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.tinh_trang') }}</label>
                  <select id="quantity" name="quantity" class="form-control">
                    <option value="" @if(isset($_GET['quantity']) && $_GET['quantity'] == ''){{'selected'}}@endif>Tất cả</option>
                    <option value="public" @if(isset($_GET['quantity']) && $_GET['quantity'] == 'public'){{'selected'}}@endif>Còn hàng</option>
                    <option value="preview" @if(isset($_GET['quantity']) && $_GET['quantity'] == 'preview'){{'selected'}}@endif>Hết hàng</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.danh_muc') }}</label>
                  <select id="category" name="category" class="form-control">
                    <option value="" @if(isset($_GET['category']) && $_GET['category'] == ''){{'selected'}}@endif>Tất cả</option>
                    @foreach($categories_list as $cp)
                      @if($cp->parent == 0)
                        @foreach($categories_list as $cp2)
                          @if($cp2->parent == $cp->id)
                          <option value="{{ $cp2->id }}" @if(isset($_GET['category']) && $_GET['category'] == '{{ $cp2->id }}'){{'selected'}}@endif>{{ $cp2->title }}</option>
                            @foreach($categories_list as $cp3)
                              @if($cp3->parent == $cp2->id)
                              <option value="{{ $cp3->id }}" @if(isset($_GET['category']) && $_GET['category'] == '{{ $cp3->id }}'){{'selected'}}@endif>-- &nbsp;&nbsp;{{ $cp3->title }}</option>
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <br>
                  <button class="btn btn-primary">Tìm kiếm</button>
                </div>
              </div>
            </div>
        </section>
      </form>
    </header>

    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
          <thead>
            <tr>
              <th class="center">ID</th>
              <th class="center">Ảnh sản phẩm</th>
              <th class="center">Tiêu đề</th>
              <th class="center">Danh mục</th>
              <th class="center">Giá cả (VNĐ)</th>
              <th class="center">Tình trạng</th>
              <th class="center">Trạng thái</th>
              <th class="center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td class="center">{{$product->id}}</td>
              <td>
                <a href="cms/san-pham/edit/{{$product->id}}" title="{{$product->description}}">
                  <img src="{{$product->featured_image}}" alt="" style="width: 100px;">
                </a>
              </td>
              <td>
                {{$product->title}}
              </td>
              <td>
                @if($product->category != '')
                  {{$product->category->title}}
                @else
                  {{'Sản phẩm không nằm trong danh mục nào'}}
                @endif
              </td>
              <td class="center">
                @if($product->sale > 0)
                  <span style="text-decoration-line:line-through;">{{number_format($product->origin_price)}}đ</span> - <b style="color: red">{{number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))}}đ</b> ({{$product->sale}}%)
                @else
                  @if($product->origin_price == null)
                    {{'miễn phí'}}
                  @else
                    {{number_format($product->origin_price)}}đ
                  @endif
                @endif
              </td>
              <td class="center">
                @if($product->quantity == null || $product->quantity == 0)
                  {{'0 sản phẩm (hết hàng)'}}
                @else
                  {{$product->quantity.' sản phẩm (còn lại)'}}
                @endif
              </td>
              @php
                switch ($product->status) {
                  case 'public':
                    $status = 'Công khai';
                    break;
                  
                  default:
                    $status = 'Ẩn';
                    break;
                }
              @endphp
              <td class="center">
                Đã {{$status}} lúc  {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$product->updated_at)->format('H:i:s d/m/Y')}}
              </td>
              <td class="center actions-hover actions-fade">
                <a href="cms/san-pham/edit/{{$product->id}}" title="Sửa"><i class="fa fa-pencil"></i></a>
                <a href="cms/san-pham/delete/{{$product->id}}" title="Xóa" class="btn-delete" data-id="{{$product->id}}"><i class="fa fa-trash-o"></i></a>
                <a href="{{$product->slug}}" title="Link sản phẩm" target="_blank"><i class="fa fa-external-link"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

@endsection

@section('extra-script')
<script type="text/javascript">
  var datatableInit = function() {
    $('#datatable-default').dataTable();
  };

  $('#type_date').on('change', function() {
    if (this.value == 'origin_price') {
      $(".date_range :input").attr("disabled", true);
      $(".date_range").addClass('hidden');
      $(".amount_range :input").attr("disabled", false).val('');
      $(".amount_range").removeClass('hidden');
    } else {
      $(".date_range :input").attr("disabled", false).val('');
      $(".date_range").removeClass('hidden');
      $(".amount_range :input").attr("disabled", true);
      $(".amount_range").addClass('hidden');
    }
  });
</script>
@endsection