<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>500 - Internal Server Error</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="{{asset('')}}">
    <!-- Font -->
    <link href="public/css/maintain.css" rel="stylesheet">
    
</head>
<style type="text/css">

</style>
<body>
    <div id='stars'></div>
    <div id='stars2'></div>
    <div class="main-area center-text"> 
        <div class="display-table">
            <div class="display-table-cell">
              <h1 class='title font-white'><b>500 Lỗi Máy chủ Nội bộ</b></h1>
              <p class='desc font-white'>{!! trans('lang.500') !!}<br/>Chúng tôi hiện đang cố gắng khắc phục sự cố. Trong thời gian chờ đợi, bạn có thể:</p>
              <a class="notify-btn" href="/"><b>{{ trans('lang.return_home') }}</b></a>
            </div>
        </div>
    </div>
</body>
</html>