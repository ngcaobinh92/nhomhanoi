@extends('site.master.default')
@section('content')
@include('site.master.breadcrumbs')

<div class="page_collection">
  <div class="container">
    <div class="row">
      @include('site.master.side-product')
      <div class="col-xs-12 col-sm-8 col-md-9">
        <div class="bannercollection">
          <img src="public/img/img_collection.jpg" alt="{{@$data['breadcrumb'][$last_key]['title']}}">
        </div>
        <!--Sắp xếp-->
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-4 col-sm-6">
              <div class="sorter">
                <div class="view-mode"> 
                  <a id="grid-tab" title="Danh sách" class="button button-grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                  <a id="list-tab" title="Danh sách" class="button button-list"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
            <div class="col-xs-8 col-sm-6 text-right">
              <div id="sort-by">
                <span class="left">Sắp xếp: </span>
                <select id="soft_by" class="coll-soft-by">
                  <option @if(@$params["orderBy"].'-'.@$params["order"] == "title-asc"){{'selected'}}@endif value="title-asc">Từ A-Z</option>
                  <option @if(@$params["orderBy"].'-'.@$params["order"] == "title-desc"){{'selected'}}@endif value="title-desc">Từ Z-a</option>
                  <option @if(@$params["orderBy"].'-'.@$params["order"] == "created_at-asc"){{'selected'}}@endif value="created_at-asc">Mới đến cũ</option>
                  <option @if(@$params["orderBy"].'-'.@$params["order"] == "created_at-desc"){{'selected'}}@endif value="created_at-desc">Cũ đến mới</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div id="grid-div" class="row product-thumb" style="display: none;">
          @if(count($data['products']) > 0)
            @foreach($data['products'] as $product)
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

                    @if($product->type == 'product')
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
                    @endif
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <div class="col-xs-12 col-sm-12 col-md-12 productcollections">Không có sản phẩm nào để hiển thị</div>
          @endif
        </div>

        <div id="list-div" class="row product-thumb" style="display: none;">
          @if(count($data['products']) > 0)
            @foreach($data['products'] as $product)
            <div class="col-xs-12">
              <div class="item collection-item">
                <div class="item-inner transition">
                  <div class="row" style="border-bottom: 1px solid #ddd">
                    <div class="col-xs-12 col-sm-4">
                      <div class="image">
                        <a class="lt-image" href="{{$product->slug}}" target="_self" title="{{$product->title}}">
                          <img src="@if($product->featured_image != ''){{$product->featured_image}}@else{{'public/img/logo.png'}}@endif" alt="{{$product->title}}">
                        </a>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 text-left">
                      <div class="caption">
                        <h4><a href="{{$product->slug}}" title="{{$product->title}}" target="_self">{{$product->title}}</a></h4>
                        <div class="">
                          @if(strlen($product->description) > 170) {!!substr($product->description, 170).'...'!!} @else {!!$product->description!!} @endif
                        </div>
                        @if($product->type == 'product')
                        
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
                              <span class="">
                                <i class="fa fa-check" aria-hidden="true"></i> Sẵn hàng 
                              </span>
                            @else
                              <a href="lien-he">
                                <span class="">Liên hệ</span>
                              </a>
                            @endif
                          </div>
                        </p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <div class="col-xs-12">Không có sản phẩm nào để hiển thị</div>
          @endif
        </div>

        @if($data['products']->total() > $data['products']->perPage())
        <div class="toolbar">
          <div class="row">
            <div class="col-xs-12 col-sm-offset-6 col-sm-6 text-right">{{ $data['products']->links('site.master.pagination') }}</div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  var view = Cookies.get('view');
  if( view ) {
    if (view == 'grid') {
      $("#grid-tab").addClass("change-view--active");
      $("#grid-div").show("fast");
    } else {
      $("#list-tab").addClass("change-view--active");
      $("#list-div").show("fast");
    }
  } else {
    Cookies.set('view', 'grid');
    $("#grid-tab").addClass("change-view--active");
    $("#grid-div").fadeOut("fast");
  }

  $("#grid-tab").on('click', function(){
    Cookies.set('view', 'grid');
    $("#list-tab").removeClass("change-view--active");
    $("#list-div").fadeOut("fast");
    $("#grid-tab").addClass("change-view--active");
    $("#grid-div").fadeIn("fast");
  });

  $("#list-tab").on('click', function(){
    Cookies.set('view', 'list');
    $("#grid-tab").removeClass("change-view--active");
    $("#grid-div").fadeOut("fast");
    $("#list-tab").addClass("change-view--active");
    $("#list-div").fadeIn("fast");
  });

  $("#soft_by").change(function() {
    var $option = $(this).find(':selected');
    var val = $option.val();
    var url = 'http://' + window.location.hostname + window.location.pathname;
    if (val != "") {
      val = val.split("-");
      url += "?orderBy=" + val[0] + "&order=" + val[1];
      window.location.href = url;
    }
  });
</script>
@endsection