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
      <h2 class="panel-title">{{ trans('cms.danh_sach') }}</h2>
      <form method="GET">
        <section>
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.ten') }}</label>
                  <input type="text" name="name" class="form-control" value="@if(isset($_GET['name'])){{$_GET['name']}}@endif">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.email') }}</label>
                  <input type="text" name="email" class="form-control" value="@if(isset($_GET['email'])){{$_GET['email']}}@endif">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label class="control-label">{{ trans('cms.quyen_han') }}</label>
                  <select id="role" name="role" class="form-control">
                    @foreach($roles_list as $role)
                    <option value="{{$role->id}}" @if(isset($_GET['role']) && $_GET['role'] == $role->id){{'selected'}}@endif>{{$role->title}}</option>
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
      <table class="table table-bordered table-striped mb-none" id="table-list">
        <thead>
          <tr>
            <th class="center">{{ trans('cms.id') }}</th>
            <th class="center">{{ trans('cms.ten') }}</th>
            <th class="hidden" style="display: none">{{ trans('cms.avatar') }}</th>
            <th class="center">{{ trans('cms.email') }}</th>
            <th class="center">{{ trans('cms.quyen_han') }}</th>
            <th class="center">{{ trans('cms.thao_tac') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td class="center">{{$user->id}}</td>
            <td><a href="cms/user/edit/{{$user->id}}">{{$user->name}}</a></td>
            <td class="hidden"><img src="{{$user->avatar}}" width="100" height="100"></td>
            <td>{{$user->email}}</td>
            @php
              $role = DB::table('roles')->where('id', $user->role)->where('status', 1)->first();
              if ($role != '') {
                $role = $role->title;
              } else {
                $role = 'Không xác định';
              }
            @endphp
            <td class="center">{{$role}}</td>
            <td class="center actions-hover actions-fade">
              <a href="cms/user/edit/{{$user->id}}" title="{{ trans('cms.sua') }}"><i class="fa fa-pencil"></i></a>&emsp;
              <a href="cms/user/delete/{{$user->id}}" title="{{ trans('cms.xoa') }}" class="delete" data-id="{{$user->id}}"><i class="fa fa-trash-o"></i></a>
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
    var $table = $('#table-list');

    // format function for row details
    var fnFormatDetails = function( datatable, tr ) {
      var data = datatable.fnGetData( tr );

      return [
        '<table class="table mb-none" data-id="' + data[1]+ '">',
          '<tr class="b-top-none">',
            '<td><label class="mb-none">Avatar:</label></td>',
            '<td>' + data[3]+ '</td>',
          '</tr>',
        '</div>'
      ].join('');
    };

    // insert the expand/collapse column
    var th = document.createElement( 'th' );
    var td = document.createElement( 'td' );
    td.innerHTML = '<i data-toggle class="fa fa-plus-square-o text-primary h5 m-none" style="cursor: pointer;"></i>';
    td.className = "text-center";

    $table
      .find( 'thead tr' ).each(function() {
        this.insertBefore( th, this.childNodes[0] );
      });

    $table
      .find( 'tbody tr' ).each(function() {
        this.insertBefore(  td.cloneNode( true ), this.childNodes[0] );
      });

    // initialize
    var datatable = $table.dataTable({
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [ 0 ]
      }],
      aaSorting: [
        [1, 'asc']
      ]
    });

    // add a listener
    $table.on('click', 'i[data-toggle]', function() {
      var $this = $(this),
        tr = $(this).closest( 'tr' ).get(0);

      if ( datatable.fnIsOpen(tr) ) {
        $this.removeClass( 'fa-minus-square-o' ).addClass( 'fa-plus-square-o' );
        datatable.fnClose( tr );
      } else {
        $this.removeClass( 'fa-plus-square-o' ).addClass( 'fa-minus-square-o' );
        datatable.fnOpen( tr, fnFormatDetails( datatable, tr), 'details' );
      }
    });
  };
</script>
@endsection