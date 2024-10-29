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
        <li class="active">Tìm kiếm</li>
      </ul>
    </div>
  </div>
</section>
<section style="background:#fff">
  <div class="container">
    <div class="row">

      @include('site.master.side-product')

      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="row">
          <div class="col-md-12">
            <div class="cat_header">
              <h2 class="page_title">Tìm kiếm</h2>
            </div>
          </div>
        </div>
        <p>Kết quả tìm kiếm với từ khóa "{{$params['ten']}}":</p>
        <form action="tim-kiem" method="get" class="btformsearch">
          <input type="text" class="input-control" name="ten" value="{{$params['ten']}}" placeholder="Tìm kiếm ...">
          <button type="submit" class="button searchbt">Tìm kiếm</button>
        </form>
        
        <div class="row product-thumb">
          @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
            <div class="col-xs-6 col-sm-4 col-md-3 productcollections">
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
            </div>
            @endforeach
          @else
            <div class="col-xs-12 col-sm-12 col-md-12 productcollections">Không có sản phẩm nào để hiển thị</div>
          @endif
        </div>

        @if($products->total() > $products->perPage())
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right">{{ $products->links('site.master.pagination') }}</div>
          </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</section>
@endsection