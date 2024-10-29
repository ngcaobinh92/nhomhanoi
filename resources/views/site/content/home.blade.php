@extends('site.master.default')
@section('content')
<style type="text/css">
  .title-collection-menu-l {
    display: none;
  }
  .left-menu {
    border: none;
  }
</style>

<div class="so-slideshow">
  <div class="module sohomepage-slider">
    <div class="modcontent">
      <div id="sohomepage-slider1">
        @if(count($data['header_slide']) > 0)
        <!-- Start Slide Header -->
        <div class="so-homeslider sohomeslider-inner-1">
          @foreach($data['header_slide'] as $key => $header_slide)
          <div class="item">
            <a title="Slider {{$key + 1}}" target="_blank">
              <img class="responsive" src="{{$header_slide->image}}" alt="Slider {{$key + 1}}">
            </a>
          </div>
          @endforeach
        </div>
        <!-- End Slide Header -->
        @endif
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>

<section class="so-spotlight1">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="module moduleship"></div>
      </div>
    </div>
  </div>
</section>

<!--Banner-->
<section class="box-collection1">
  <div class="container">
    <div class=" modcontent">
      <div class="header-title">
        <h3 class="modtitle"><span>Danh mục </span>&nbsp;<span>Sản phẩm</span></h3>
      </div>
      <div class="row">
      @include('site.master.side-product')
        <!-- Start Slider Hot -->
        <div class="col-md-9 col-sm-8 col-md-9 hidden-xs">
          @if(isset($data['hots']) && $data['hots'] != '')
          <div class="product-slider-1 product-thumb">
            @php
            $count = 0;
            @endphp
            @foreach($data['hots'] as $hotproduct)
              @php
              ++$count;
              @endphp
              @if($count == 1)
                <div>
              @endif
                  <div class="item">
                    <div class="item-inner transition">
                      <div class="image">
                        <a class="lt-image" href="{{$hotproduct->slug}}" target="_self" title="{{$hotproduct->title}}">
                          <img src="@if($hotproduct->featured_image != ''){{$hotproduct->featured_image}}@else{{'public/img/logo.png'}}@endif" class="@if($hotproduct->thump_image != ''){{'img-1'}}@endif" alt="{{$hotproduct->title}}">
                          @if($hotproduct->thump_image != '')
                            <img src="{{$hotproduct->thump_image}}" class="img-2" alt="{{$hotproduct->title}}">
                          @endif
                        </a>
                      </div>
                      <div class="caption">
                        <h4><a href="{{$hotproduct->slug}}" title="{{$hotproduct->title}}" target="_self">{{$hotproduct->title}}</a></h4>
                        <p class="price">
                          @if($hotproduct->sale > 0)
                            <a href="{{$hotproduct->slug}}"><span class="price-old">{{$hotproduct->origin_price}}đ</span></a> <small>(Tiết kiệm {{$hotproduct->sale}}%)</small></br>
                            <a href="{{$hotproduct->slug}}"><span class="price-new">{{number_format(ROUND(($hotproduct->origin_price - ($hotproduct->origin_price*$hotproduct->sale)/100),3))}}đ</span></a></br>
                          @else
                            </br>
                            <a href="{{$hotproduct->slug}}"><span class="price-new">{{number_format($hotproduct->origin_price)}}đ</span></a></br>
                          @endif

                          <div class="p-action">
                            @if($hotproduct->quantity > 0)
                              <span class="p-qty">
                                <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                              </span>
                              <a href="javascript:;" onclick="addcart('{{$hotproduct->slug}}')" class="p-buy"></a>
                            @else
                              <a href="lien-he">
                                <span class="p-empty">Liên hệ</span>
                              </a>
                            @endif
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
              @if($count == 2)
                </div>
                @php
                $count = 0;
                @endphp
              @endif
            @endforeach
              </div>
            </div>
          @else
            <img src="public/img/slide1.jpg" style="width: 100%;">
          @endif
        </div>
        <!-- End Slider Hot -->
      </div>
    </div>
  </div>
</section>

<!-- Start Slider -->
@if(isset($data['products']) && $data['products'] != '')
  @php
  $last = key(end($data['products']));
  @endphp
  @foreach($data['products'] as $key => $products)
    @if($products->product != '')
      @if($key == $last)
      <section class="box-collection">
        <div class="container">
          <div class="modcontent">
            <div class="header-title">
              <h3 class="modtitle"><span>{{$products->title}}</span></h3>
            </div>
            <div class="row">
              <div class="col-md-3 col-sm-4 col-xs-12 hidden-xs">
                <img src="public/img/banne2.jpg">
              </div>
              <div class="col-md-9 col-sm-8 col-xs-12">
                <!-- Start Slider last -->
                <div class="product-slider-3 product-thumb">
                  @foreach($products->product as $product)
                  <div class="item">
                    <div class="item-inner transition">
                      <div class="image">
                        <a class="lt-image" href="{{$product->slug}}" target="_self" title="{{$product->title}}">
                          <img src="@if($product->featured_image != ''){{$product->featured_image}}@else{{'public/img/logo.png'}}@endif" class="@if($product->thump_image != ''){{'img-1'}}@endif" alt="{{$product->title}}">
                          @if($product->thump_image != '')
                            <img src="{{$product->thump_image}}" class="img-2" alt="{{$product->title}}">
                          @endif
                        </a>
                      </div>
                      <div class="caption">
                        <h4><a href="{{$product->slug}}" title="{{$product->title}}" target="_self">{{$product->title}}</a></h4>
                        <p class="price">
                          @if($product->sale > 0)
                            <a href="{{$product->slug}}"><span class="price-old">{{$product->origin_price}}đ</span></a> <small>(Tiết kiệm {{$product->sale}}%)</small></br>
                            <a href="{{$product->slug}}"><span class="price-new">{{number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))}}đ</span></a></br>
                          @else
                            </br>
                            <a href="{{$product->slug}}"><span class="price-new">{{number_format($product->origin_price)}}đ</span></a></br>
                          @endif

                          <div class="p-action">
                            @if($product->quantity > 0)
                              <span class="p-qty">
                                <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                              </span>
                              <a href="javascript:;" onclick="addcart('{{$product->slug}}')" class="p-buy"></a>
                            @else
                              <a href="lien-he">
                                <span class="p-empty">Liên hệ</span>
                              </a>
                            @endif
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <!-- End Slider last -->
              </div>
            </div>
          </div>
        </div>
      </section>
      @else
      <section class="box-collection">
        <div class="container">
          <div class="modcontent">
            <div class="header-title">
              <h3 class="modtitle"><span>{{$products->title}}</span></h3>
            </div>
            <div class="product-slider-2 product-thumb">
              @foreach($products->product as $product)
              <div class="item">
                <div class="item-inner transition">
                  <div class="image">
                    <a class="lt-image" href="{{$product->slug}}" target="_self" title="{{$product->title}}">
                      <img src="@if($product->featured_image != ''){{$product->featured_image}}@else{{'public/img/logo.png'}}@endif" class="@if($product->thump_image != ''){{'img-1'}}@endif" alt="{{$product->title}}">
                      @if($product->thump_image != '')
                        <img src="{{$product->thump_image}}" class="img-2" alt="{{$product->title}}">
                      @endif
                    </a>
                  </div>
                  <div class="caption">
                    <h4><a href="{{$product->slug}}" title="{{$product->title}}" target="_self">{{$product->title}}</a></h4>
                    <p class="price">
                      @if($product->sale > 0)
                        <a href="{{$product->slug}}"><span class="price-old">{{$product->origin_price}}đ</span></a> <small>(Tiết kiệm {{$product->sale}}%)</small></br>
                        <a href="{{$product->slug}}"><span class="price-new">{{number_format(ROUND(($product->origin_price - ($product->origin_price*$product->sale)/100),3))}}đ</span></a></br>
                      @else
                        </br>
                        <a href="{{$product->slug}}"><span class="price-new">{{number_format($product->origin_price)}}đ</span></a></br>
                      @endif

                      <div class="p-action">
                        @if($product->quantity > 0)
                          <span class="p-qty">
                            <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                          </span>
                          <a href="javascript:;" onclick="addcart('{{$product->slug}}')" class="p-buy"></a>
                        @else
                          <a href="lien-he">
                            <span class="p-empty">Liên hệ</span>
                          </a>
                        @endif
                      </div>
                    </p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>
      @endif
    @endif
  @endforeach
@endif
<!-- End Slider -->

<section class="box_blog">
@if(count($data['news']) > 0)
  <div class="container">
    <div class="modcontent">
      <div class="header-title">
        <h3 class="modtitle"><span>Tin</span>&nbsp;<span>Mới</span></h3>
      </div>
      <!-- Start Slider News -->
      <div class="product-slider-3 product-thumb">
        @foreach($data['news'] as $news)
        <div class="item item-blog">
          <div class="blog_item_inner transition">
            <a class="lt-image" href="{{$news->slug}}" target="_self" title="{{$news->title}}">
              <img src="{{$news->featured_image}}" alt="{{$news->title}}">
            </a>
            <div class="thongtin">
              <h4 class="blog_item_title"><a href="{{$news->slug}}" title="{{$news->title}}" target="_self">{{$news->title}}</a></h4>
              <div class="blog_item_motangan">{{substr($news->title, 0, 125)}}...</div>
              <a href="{{$news->slug}}" class="blog_itemt_link">Xem thêm</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- End Slider News -->
      <div class="clearfix"></div>
    </div>
  </div>
@endif
</section>
@endsection