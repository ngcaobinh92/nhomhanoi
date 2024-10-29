@extends('site.master.default')
@section('content')
<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
          <span class="divider"></span>
        </li>
      </ul>
    </div>
  </div>
</section>
<div class="page_collection">
  <div class="container">
    <div class="row">
      @include('site.master.side-product')
      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="bannercollection">
          <img src="public/img/img_collection.jpg" alt="{{@$data['breadcrumb'][$last_key]['title']}}">
        </div>
        <h1 class='title font-white'><b>{!! trans('lang.404') !!}</b></h1>
        <a class="notify-btn" href="/"><b>{{ trans('lang.return_home') }}</b></a>
    </div>
  </div>
</div>
@endsection