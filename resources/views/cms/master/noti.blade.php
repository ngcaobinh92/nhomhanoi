@php
$rq = array();
$CMSNotificationModel = new App\Models\CMSNotificationModel;
$new = $CMSNotificationModel::select('id')->where('user_id', '>', 0)->where('status', 1)->count();
$total = $CMSNotificationModel::select('id')->where('user_id', '>', 0)->count();
$noti_list = $CMSNotificationModel::where('user_id', '>', 0)->orderBy('id', 'DESC')->limit(4)->get();
@endphp

<ul class="notifications">
	<li>
		<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
			<i class="fa fa-envelope"></i>
			<span class="badge">{{$new}}</span>
		</a>

		<div class="dropdown-menu notification-menu">
			<div class="notification-title">
				<span class="pull-right label label-default">{{$total}}</span>
				{{ trans('cms.tin_nhan') }}
			</div>

			<div class="content">
				<ul class="noticms">
					@foreach($noti_list as $noti)
					@php
					$user = DB::table('users')->where('id', $noti->user_id)->first();
					@endphp
					<li>
						<a href="cms/notified/detail/{{$noti->id}}" class="clearfix">
							<figure class="image">
								<img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-circle" />
							</figure>
							<span class="title">{{$user->name}}</span>
							<span class="message @if(strlen($noti->content) > 800){{'truncate'}}@endif">@if($noti->status == 1)<b>{{$noti->content}}</b>@else{{$noti->content}}@endif<br>{{$noti->created_at->format('d/m/Y H:m:i')}}</span>
						</a>
					</li>
					@endforeach
				</ul>

				<hr />

				<div class="text-right">
					<a href="cms/notified/list" class="view-more">View All</a>
				</div>
			</div>
		</div>
	</li>
</ul>

<span class="separator"></span>