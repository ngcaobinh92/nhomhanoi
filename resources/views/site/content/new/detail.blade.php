@extends('site.master.default')
@section('content')
@include('site.master.breadcrumbs')

<div class="page_collection">
  <div class="container">
    <div class="row content-blog-list">
      <div class="col-xs-12 col-sm-4 col-md-3 sticky_top">
        @include('site.master.side-new')
      </div>
      
      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="box-detail">
          <h3><a href="{{$data['new']->slug}}">{{$data['new']->title}}</a></h3>
          <div class="post-detail"> {{ \Carbon\Carbon::parse($data['new']->created_at)->format('d/m/Y H:i:s') }} - {{count($data['new']->comments)}} bình luận </div>
          <div class="text-blog">{!!$data['new']->content!!}</div>
        </div>

        @if(count($data['new']->comments) > 0)
        <div class="comments box padding"> 
          <h3>Bình luận ({{count($data['new']->comments)}})</h3>

          @foreach($data['new']->comments as $comment)
          <div class="comments-content row">
            <div class="avatar col-md-2 col-xs-2">
              <img alt="Guest" src="public/img/avatar.png">
            </div>  
            <div class="comments-details col-md-10 col-xs-10">
              <div class="comment-author">
                <a>{{$comment->name}}</a> 
              </div>
              <div class="comment-meta">{{\Carbon\Carbon::parse($comment->updated_at)->format('d/m/Y H:i:s')}}</div>  
              <div class="comment-text">
                <p>{{$comment->content}}</p>
              </div>
            </div>
          </div>
          @endforeach      
        </div>
        @endif

        <!-- <div class="respond box padding">
          <form accept-charset="utf-8" action="comments/{{$data['new']->id}}" id="article_comments" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
            <h3>Viết bình luận của bạn</h3>
            @if(session('thongbao'))
            <div style="word-wrap: break-word;"><b style="color: red">{{session('thongbao')}}</b></div><br>
            @endif
            <div class="form-group ">
              <label for="name">Tên:<span class="required">*</span></label>
              <div>
                <input name="name" type="text" class="form-control" id="name" placeholder="Tên của bạn" required>
              </div>
            </div>
            <div class="form-group ">
              <label for="email">Email:<span class="required">*</span></label>
              <input name="email" type="email" class="form-control" id="email" placeholder="Email của bạn" required>
            </div>
            <div class="form-group ">
              <label>Bình luận:<span class="required">*</span></label>
              <textarea name="content" rows="3" cols="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn_button" type="submit">Gửi bình luận</button>
            </div>
          </form>
        </div> -->
      </div>
    </div>
  </div>
</div>
@endsection