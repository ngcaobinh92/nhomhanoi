<section style="background:#fff">
  <div class="container">
    <div class="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
          <span class="divider"></span>
        </li>
        @if (count($data['breadcrumb']) > 0)
          @php
            $last_key = count($data['breadcrumb']) - 1;
          @endphp
          @foreach ($data['breadcrumb'] as $key => $value)
            @if ($key == $last_key)
              <li>{{$value['title']}}</li>
            @else
              <li>
                <a href="{{$value['slug']}}">{{$value['title']}}</a>
                <span class="divider"></span>
              </li>
            @endif
          @endforeach
        @endif
      </ul>
    </div>
  </div>
</section>