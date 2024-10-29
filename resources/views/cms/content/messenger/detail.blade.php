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

  <div class="mailbox-email">
    <div class="mailbox-email-header mb-lg">
      <h3 class="mailbox-email-subject m-none text-light">{{$data[0]->title}} ({{$data->count()}})</h3>
  
      <p class="mt-lg mb-none text-md">{{ trans('cms.tu') }} <a href="cms/user/edit/{{$user->id}}">{{$user->name}}</a> {{ trans('cms.gui_toi_ban') }} {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data[0]->created_at)->format('D d M, Y. H:M A')}}</p>
    </div>
    <div class="mailbox-email-container">
      <div class="mailbox-email-screen">
        @foreach($data as $dt)
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-actions">
              <a href="#" class="fa fa-caret-down"></a>
              <!-- <a href="#" class="fa fa-mail-reply"></a> -->
              <!-- <a href="#" class="fa fa-mail-reply-all"></a> -->
              <!-- <a href="#" class="fa fa-star-o"></a> -->
            </div>
            @if($dt->user_id == 0)
            <p class="panel-title">{{ trans('cms.you') }} <i class="fa fa-angle-right fa-fw"></i> {{$user->name}}
            @else
            <p class="panel-title">{{$user->name}} <i class="fa fa-angle-right fa-fw"></i> {{ trans('cms.you') }}
            @endif
          </div>
          <div class="panel-body">{!! $dt->content !!}</div>
          <div class="panel-footer">
            <p class="m-none"><small>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dt->created_at)->format('D d M, Y. H:M A')}}</small></p>
          </div>
        </div>
        @endforeach
      </div>

      <form class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-12 col-lg-12">
          <section class="panel">
            <div class="row">
              <div class="panel-body">
                <div class="col-sm-12 form-type">
                  <div class="form-group">
                    <label class="control-label">{{ trans('cms.tra_loi') }}</label>
                    <input type="hidden" name="to_noid" value="{{$to_noid}}">
                    <textarea class="form-control mce_basic" name="content">{{old('content')}}</textarea>
                    @if($errors->has('content'))
                    <span class="error_mess">{{$errors->first('content')}}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="compose">
              <div class="text-right mt-md">
                <button class="btn btn-primary">
                  <i class="fa fa-send mr-xs"></i>{{ trans('cms.gui') }}
                </button>
              </div>
            </div>
          </section>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('extra-script')

<script type="text/javascript">

</script>
@endsection