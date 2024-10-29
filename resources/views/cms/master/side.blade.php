<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">Navigation</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
        @php if(!isset($module)){$module = '';}
          (\Session::has('website_language') == true) ? $lang = \Session::get('website_language') : $lang = 'vi';
        @endphp
        @foreach(App\Models\CMSMenuModel::where('menu_id', '0')->where('status', '1')->orderBy('order','DESC')->get() as $menu)
	        @php
            $menu->child = App\Models\CMSMenuModel::where('menu_id', $menu->id)->where('status', '1')->orderBy('order','DESC')->get();
	        @endphp
	        <li class="@if(count($menu->child) > 0){{'nav-parent'}}@endif @if($module == $menu->url){{'nav-active nav-expanded'}}@endif">
            <a href="@if(count($menu->child) == 0){{'cms/'.$menu->url}}@else{{'javascript:;'}}@endif">
            	<i class="fa fa-copy" aria-hidden="true"></i>
            	<span>{{ trans('cms.'.$menu->translate) }}</span>
            </a>
            @if(count($menu->child) > 0)
              <ul class="nav nav-children">
                @foreach($menu->child as $child)
                <li>
                  <a href="{{'cms/'.$menu->url.'/'.$child->url}}">
			            	<i class="fa fa-copy" aria-hidden="true"></i>
                  	<span>{{ trans('cms.'.$child->translate) }}</span>
                  </a>
                </li>
                @endforeach
              </ul>
            @endif
	        </li>
        @endforeach

				@if($adminLogin->role == 0)
          <li class="@if($module == 'setting'){{'nav-active nav-expanded'}}@endif">
            <a href="cms/setting">
	          	<i class="fa fa-cog" aria-hidden="true"></i>
	            <span>{{ trans('cms.setting') }}</span>
	          </a>
          </li>
        @endif
				</ul>
			</nav>
		</div>
	</div>
</aside>