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
      @if(isset($module))<li><span><a href="cms/{{$module}}">{{ trans('cms.quan_ly_nguoi_dung') }}</a></span></li>@endif
      @if(isset($path))<li><span>{{ trans('cms.danh_sach') }}</span></li>@endif
    </ol>

    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<div class="row">

  <section class="panel">
    <header class="panel-heading">
      <div class="panel-actions">
        <a href="cms/readmess" class="fa fa-eye" title="Đánh dấu đã đọc"></a>
        <a href="#" class="fa fa-caret-down"></a>
        <a href="#" class="fa fa-times"></a>
      </div>

      <h2 class="panel-title">{{ trans('cms.danh_sach') }}</h2>
    </header>
    <div class="panel-body">
      <table class="table table-bordered table-striped mb-none" id="datatable-default">
        <thead>
          <tr>
            <th>{{ trans('cms.ten') }}</th>
            <th>{{ trans('cms.tieu_de') }}</th>
            <th>{{ trans('cms.content') }}</th>
            <th>{{ trans('cms.trang_thai') }}</th>
            <th>{{ trans('cms.thao_tac') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $dt)
          <tr>
            @php
            $user = DB::table('users')->where('id', $dt->user_id)->first();
            @endphp
            <td><a href="cms/notified/detail/{{$dt->id}}">{{$user->name}}</a></td>
            <td><a href="cms/notified/detail/{{$dt->id}}">{{$dt->title}}</a></td>
            <td><a href="cms/notified/detail/{{$dt->id}}">{{$dt->content}}</a></td>
            <td><a href="cms/notified/detail/{{$dt->id}}">@if($dt->status == 1){{'Chưa xem'}}@else{{'Đã xem'}}@endif</a></td>
            <td>
              <a href="cms/notified/delete/{{$dt->id}}" title="{{ trans('cms.xoa') }}" class="delete" data-id="{{$dt->id}}">
                <i class="fa fa-trash-o"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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