@extends('site.master.default')
@section('content')
@include('site.master.breadcrumbs')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="cat_header">
        <h2 class="page_title">{{$data['page']->title}}</h2>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row content-page">
      <div class="box padding">
      	{!!$data['page']->content!!}
      </div>
    </div>
  </div>
</div>
<div style="background: #fff;height: 20px;"></div>
@endsection