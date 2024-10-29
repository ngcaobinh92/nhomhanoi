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
      <li><span>Quán lý tin tức</span></li>
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
                  <label class="control-label">Ngày</label>
                  <select id="type_date" name="type_date" class="form-control">
                    <option value="created_at" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'created_at'){{'selected'}}@endif >Ngày tạo</option>
                    <option value="updated_at" @if(isset($_GET['type_date']) && $_GET['type_date'] == 'updated_at'){{'selected'}}@endif>Ngày cập nhật</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Từ ngày</label>
                  <div class="input-daterange input-group" data-plugin-datepicker>
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input type="text" class="form-control" name="start" value="@if(isset($_GET['start'])){{$_GET['start']}}@endif">
                    <span class="input-group-addon">Đến ngày</span>
                    <input type="text" class="form-control" name="end" value="@if(isset($_GET['end'])){{$_GET['end']}}@endif">
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
              <th class="center">Tiêu đề</th>
              <th class="center">Trạng thái</th>
              <th class="center">Ngày tạo</th>
              <th class="center">Chỉnh sửa</th>
              <th class="center">Thao tác</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pages as $page)
            <tr>
              <td class="center">{{$page->id}}</td>
              <td><a href="cms/page/edit/{{$page->id}}" title="{{$page->title}}">{{$page->title}}</a></td>
              @php
                switch ($page->status) {
                  case 'public':
                    $status = 'Hiện';
                    break;
                  
                  default:
                    $status = 'Ẩn';
                    break;
                }
              @endphp
              <td class="center">{{$status}}</td>
              <td class="center">{{$page->created_at}}</td>
              <td class="center">{{$page->updated_at}}</td>
              <td class="center actions-hover actions-fade">
                <a href="cms/page/edit/{{$page->id}}" title="Sửa"><i class="fa fa-pencil"></i></a>&emsp;
                <a href="cms/page/delete/{{$page->id}}" title="Xóa}" class="btn-delete" data-id="{{$page->id}}"><i class="fa fa-trash-o"></i></a>
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
</script>
@endsection