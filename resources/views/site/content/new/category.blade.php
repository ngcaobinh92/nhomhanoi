@extends('site.master.default')
@section('content')
@include('site.master.breadcrumbs')

<div class="page_collection">
  <div class="container">
    <div class="row content-blog-list">
      <div class="col-xs-12 col-sm-4 col-md-3">
        @include('site.master.side-new')
      </div>
      
      <div class="col-xs-12 col-sm-8 col-md-9">

        @if(isset($data['news']) && $data['news']->total() > 0)
          @foreach($data['news'] as $new)
          <div class="box-article-item">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-4">
                <a href="{{$new->slug}}"><img src="{{$new->featured_image}}" alt="{{$new->title}}"></a>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-8">
                <h3 class="title-article-inner"><a href="{{$new->slug}}">{{$new->title}}</a></h3>
                <div class="post-detail">
                  {{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y H:i:s') }} -{{$new->comments}} bình luận
                </div>
                <div class="text-blog">
                  <p>{{$new->description}}</p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @else
        <div>Không có bài viết nào để hiển thị</div>
        @endif
        @if($data['news']->total() > $data['news']->perPage())
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right">{{ $data['news']->links('site.master.pagination') }}</div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection