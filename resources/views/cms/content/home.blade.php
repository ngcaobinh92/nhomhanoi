@extends('cms.master.default')

@section('extra-script')
<script src="public/octopus/assets/javascripts/dashboard/examples.dashboard.js"></script>
@endsection

@section('content')

@if(session('thongbao'))
<span class="error"><b>{{session('thongbao')}}</b></span>
@endif

<header class="page-header">
  <h2>Dashboard</h2>

  <div class="right-wrapper pull-right">
    <p class="sidebar-right-toggle"></p>
  </div>
</header>

<!-- end: page -->
@endsection