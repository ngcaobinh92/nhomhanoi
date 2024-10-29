<div class="col-post">
  <div class="header-title">
    <h3 class="modtitle"><span>Danh mục</span>&nbsp;<span>tin tức</span></h3>
  </div>
  <ul class="post-menu">
    <li class="cat-item"><a href="tin-tuc">Tin tức ({{$news['total']}})</a></li>
  </ul>
</div>

<div class="col-post">
  <h3>Bài viết mới</h3>
  <ul class="post-menu">
    @if($news['total'] > 0)
      @foreach($news['news'] as $new)
        <li><a href="{{$new->slug}}" title="{{$new->title}}">{{$new->title}}</a></li>
      @endforeach
    @else
      <li>Không có bài viết nào để hiển thị</li>
    @endif
  </ul>
</div>
<div class="col-post">
  <h3></h3>
  <div class="banner">
    <a href="tin-tuc"><img alt="Công ty Cổ phần Phân phối nhôm Hà Nội" src="public/img/blog-img.jpg"></a>
  </div>
</div>