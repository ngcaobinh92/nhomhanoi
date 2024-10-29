<div class="col-xs-12 col-sm-4 col-md-3">
  <div class=" left-menu">
    <div class="box-colection">
      <div class="title-collection-menu-l">SẢN PHẨM</div>
      <ul class="list-collections list-cate-banner list-index">
        @foreach ($categories as $category_list)
          @if($category_list->slug == 'san-pham' && count($category_list->child) > 0)
            @foreach ($category_list->child as $category)
            <li class="menu_lv1 item-sub-cat">
              <a href="{{$category->slug}}">
                <i class="fa fa-angle-double-right" aria-hidden="true"></i> {{$category->title}}
              </a>
              @if(count($category->child) > 0)
              <i class="fa fa-plus btn-cate" aria-hidden="true"></i>
              <ul style="display:none">
                @foreach ($category->child as $child)
                <li><a href="{{$child->slug}}">{{$child->title}}</a></li>
                @endforeach
              </ul>
              @endif
            </li>
            @endforeach
          @endif
        @endforeach
      </ul>
    </div>
  </div>
  <div class="module moduleship">
    <div class="modcontent clearfix">
      <div class="row re-ship-phone">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon1"></span>
            <p class="des"><span>Tư vấn 24/7</span> Miễn phí</p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon2"></span>
            <p class="des">Vận chuyển <span>theo yêu cầu</span></p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon3"></span>
            <p class="des">Nhận hàng <span>Nhận tiền</span></p>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="item">
            <span class="icon icon4"></span>
            <p class="des">Gọi ngay <span><a href="tel:{{$configs->hotline}}">{{$configs->hotline}}</a></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>