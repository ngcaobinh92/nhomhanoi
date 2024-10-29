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
        <li class="active">Liên hệ</li>
      </ul>
    </div>
  </div>
</section>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="page_title">Liên hệ</h2>
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
    <div class="col-md-6">
      <form accept-charset="utf-8" action="" id="contact" method="post">
		    <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="contact_form">
          <fieldset class="form-group">
            <label>Thông tin liên hệ <span class="required">*</span></label>
            <input type="text" name="name" placeholder="Tên của bạn" class="form-control" required>
            <input type="Email" name="email" placeholder="Email của bạn" class="form-control" required>
          </fieldset>
          <div class="form-group">
            <label>Nội dung <span class="required">*</span></label>
            <textarea rows="3" name="content" class="form-control" required></textarea>
          </div>
          <p class="form-group">
            <button class="btn btn_button" type="submit">Gửi liên hệ</button>
          </p>
        </div>
      </form>
    </div>
    <div class="col-md-6">
      <div class="location">
        <strong>Công ty Cổ phần Phân phối nhôm Hà Nội</strong>
        <br>
        <strong>Website:</strong> {{URL::to('/')}}<br>
        @if($configs->factory != '') <strong>Nhà máy :</strong> {{$configs->factory}}<br>@endif
        @if($configs->hotline != '') <strong>Điện thoại:</strong> <a href="tel:{{$configs->hotline}}">{{$configs->hotline}}</a><br>@endif
        @if($configs->email != '') <strong>Email:</strong>  <a href="mailto:{{$configs->email}}">{{$configs->email}}</a><br>@endif
        @if($configs->address != '') <strong>Địa chỉ :</strong> {{$configs->address}}<br>@endif
        <p>Nếu có thắc mắc hoặc cần trợ giúp, bạn có thể liên hệ với chúng tôi bất cứ lúc nào! Chúng tôi sẽ phản hổi bạn nhanh hết mức có thể</p>
      </div>
    </div>
  </div>
</div>
@endsection