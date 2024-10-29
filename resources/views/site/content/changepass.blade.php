@extends('site.master.default')
@section('content')
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ </a>
          <span class="divider"></span>
        </li>
        <li class="active">Kích hoạt tài khoản</li>
      </ul>
    </div>
  </div>
</section>

<div class="contaier" style="background:#fff">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
      <h2 class="title">Cập nhật mật khẩu</h2>
      @if(session('thongbao'))
      <div class="alert alert-info">
        <p class="m-none text-semibold h6">{{session('thongbao')}}</p>
      </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
        </ul>
      </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-3 customer-login">
      <form accept-charset="utf-8" action="" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_key" value="{{$key}}">
        <div class="loginbox form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4" for="password">Mật khẩu <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password" id="password" minlength="6" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4" for="password_confirmation">Nhập lại Mật khẩu <span class="required">*</span></label>
            <div class="col-md-8">
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" minlength="6" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary" type="submit">Đổi mật khẩu</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection