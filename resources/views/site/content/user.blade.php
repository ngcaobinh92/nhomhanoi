@extends('site.master.default')
@section('content')
<link href="public/css/user.css" rel="stylesheet" type="text/css">
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a> 
          <span class="divider"></span>
        </li>
        <li class="active">Quản lý tài khoản</li>
      </ul>
    </div>
  </div>
</section>
<section style="background:#fff">
  <div class="container">
    <div class="row">

      @include('site.master.side-product')

      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="cat_header">
              <h2 class="page_title">Quản lý tài khoản</h2>
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
        </div>
        <div class="col-md-12 customer-register">
          <form accept-charset="utf-8" action="" method="post" enctype="multipart/form-data" id="user_form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="loginbox form-horizontal">

              <div class="form-group" style="text-align: center">
                <div id="profile-container">
                  <div class="avatar-wrapper">
                    <img class="profile-pic" src="{{$user->avatar}}" id="profileImage" />
                    <div class="upload-button">
                      <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                    </div>
                  </div>
                  <input id="file-upload" type="file" accept="image/*" name="avatar" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-4" for="name">Họ Tên<span class="required">*</span></label>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="name" id="name" required value="{{$user->name}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="email">Email</label>
                <div class="col-md-8">
                  <input type="email" class="form-control" disabled value="{{$user->email}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4">Chức vụ</label>
                <div class="col-md-8">
                  <select class="form-control" disabled>
                    <option value="{{$user->role}}">{{$user->role}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4">Ngày đăng ký</label>
                <div class="col-md-8">
                  <input type="text" class="form-control" disabled value="{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:m:s')}}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="gender">Giới tính</label>
                <div class="col-md-8">
                  <select class="form-control" name="gender">
                    @php
                      switch ($user->gender) {
                        case 'male':
                          $gender = 'Nam';
                          break;
                        case 'female':
                          $gender = 'Nữ';
                          break;
                        case 'intersex':
                          $gender = 'Không xác định';
                          break;
                        default:
                          $gender = 'Không biết';
                          break;
                      }
                    @endphp
                    <option value="{{$user->gender}}" hidden selected>{{$gender}}</option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="password">Mật khẩu</label>
                <div class="col-md-8">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Bỏ qua nếu không muốn thay đổi mật khẩu!!!">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4" for="re_password">Xác thực Mật khẩu</span></label>
                <div class="col-md-8">
                  <input type="password" class="form-control" name="re_password" id="re_password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3 col-md-offset-3">
                  <button class="btn btn_primary col-md-12" type="reset">Reset</button>
                </div>
                <div class="col-md-3">
                  <button class="btn btn_button col-md-12" type="submit">Cập nhật</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="public/js/user.js"></script>
@endsection