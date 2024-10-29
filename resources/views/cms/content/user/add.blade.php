@extends('cms.master.default')

@section('extra-script')
@endsection

@section('content')

<header class="page-header">
  <h2>User Profile</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="index.html">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quản lí người dùng</span></li>
      <li><span>Thêm người dùng</span></li>
    </ol>
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- start: page -->

<div class="row">
  <form class="form-horizontal" method="post" id="form summary-form" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-md-4 col-lg-3">

    <section class="panel">
      <div class="panel-body">
        <div class="thumb-info mb-md">
          <img src="" id="frame" class="rounded img-responsive">
          <!-- <div class="thumb-info-title">
            <span class="thumb-info-inner"></span>
            <span class="thumb-info-type"></span>
          </div> -->
        </div>

        <hr class="dotted short">
        @if($errors->has('avatar'))
        <br>
        <span class="error_mess">{{$errors->first('avatar')}}</span>
        @endif
        <div class="center">
          <label for="avatar" class="btn btn-primary">Tải Ảnh</label>
          <input class="form-control hidden" type="file" name="avatar" id="avatar" onchange="loadImg(event)"/>
        </div>

      </div>
    </section>
    </div>

    <div class="col-md-8 col-lg-9">
      <div class="tabs">
        <div class="tab-content">
          <div id="edit" class="tab-pane active">
              <h4 class="mb-xlg">Thông tin cá nhân</h4>
              @if(session('thongbao'))
              <div class="center"><b>{{session('thongbao')}}</b></div><br>
              @endif
              <fieldset>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="name">Tên <span class="required">*</span></label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{old('name')}}" required/>
                    @if($errors->has('name'))
                    <span class="error_mess">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="email">Email <span class="required">*</span></label>
                  <div class="col-md-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{old('email')}}" required/>
                    @if($errors->has('email'))
                    <span class="error_mess">{{$errors->first('email')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Giới tính</label>
                  <div class="col-sm-4">
                    <select id="gender" name="gender" class="form-control" required>
                      <option value="" hidden>Chọn giới tính</option>
                      <option value="unknown">Không biết</option>
                      <option value="male">Nam</option>
                      <option value="female">Nữ</option>
                      <option value="intersex">Không xác định</option>
                    </select>
                    @if($errors->has('gender'))
                    <span class="error_mess">{{$errors->first('gender')}}</span>
                    @endif
                  </div>
                </div>

                @if(in_array(Auth::user()->role, $RolesAcceptable))
                <div class="form-group">
                  <label class="col-sm-3 control-label">Quyền hạn</label>
                  <div class="col-sm-4">
                    <select id="role" name="role" class="form-control">
                      @foreach($roles_list as $role)
                      <option value="{{$role->id}}">{{$role->title}}</option>
                      @endforeach
                    </select>
                    @if($errors->has('role'))
                    <span class="error_mess">{{$errors->first('role')}}</span>
                    @endif
                  </div>
                </div>
                @endif

                <div class="form-group">
                  <label class="col-md-3 control-label" for="name">Mật khẩu <span class="required">*</span></label>
                  <div class="col-md-8">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập password" required/>
                    @if($errors->has('password'))
                    <span class="error_mess">{{$errors->first('password')}}</span>
                    @endif
                  </div>
                </div>
              </fieldset>

              <div class="panel-footer">
                <div class="row">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">OK</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- end: page -->

<script type="text/javascript">

</script>
@endsection