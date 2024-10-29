@extends('cms.master.default')

@section('extra-script')
@endsection

@section('content')

<header class="page-header">
  <h2>User Profile</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="cms">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Quản lí người dùng</span></li>
      <li><span>Thông tin người dùng</span></li>
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
          <img src="{{$user->avatar}}" id="frame" class="rounded img-responsive">
          @php
          if (DB::table('roles')->where('id', $user->role)->where('status', 1)->exists() == true) 
            $roleTitle = DB::table('roles')->where('id', $user->role)->where('status', 1)->first()->title;
          else
            $roleTitle = 'Không xác định';
          @endphp
          <!-- <div class="thumb-info-title">
            <span class="thumb-info-inner">{{$user->name}}</span>
            <span class="thumb-info-type">{{$roleTitle}}</span>
          </div> -->
        </div>

        <hr class="dotted short">

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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên" value="{{$user->name}}" required/>
                    @if($errors->has('name'))
                    <span class="error_mess">{{$errors->first('name')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="email">Email <span class="required">*</span></label>
                  <div class="col-md-8">
                    <input type="email" class="form-control" id="email" placeholder="Nhập email" value="{{$user->email}}" disabled/ required/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Giới tính</label>
                  <div class="col-sm-4">
                    <select id="gender" name="gender" class="form-control" required>
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
                      <option value="{{$user->role}}" hidden selected>{{$roleTitle}}</option>
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
                  <label class="col-md-3 control-label" for="profileCompany">Ngày khởi tạo</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" value="{{$user->created_at}}" disabled/>
                  </div>
                </div>
              </fieldset>

              <hr class="dotted tall">
              <div class="widget-toggle-expand mb-md">
                <div class="widget-header">
                  <h4>Đổi mật khẩu</h4>
                  <div class="widget-toggle"><i class="fa fa-plus" aria-hidden="true"></i></div>
                </div>
                <div class="widget-content-expanded">
                  <fieldset class="mb-xl">
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="password">Mật khẩu mới</label>
                      <div class="col-md-8">
                        <input type="password" class="form-control" id="password" name="password">
                        @if($errors->has('password'))
                        <span class="error_mess">{{$errors->first('password')}}</span>
                        @endif
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="password_confirmation">Xác nhận</label>
                      <div class="col-md-8">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @if($errors->has('password_confirmation'))
                        <span class="error_mess">{{$errors->first('password_confirmation')}}</span>
                        @endif
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>

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