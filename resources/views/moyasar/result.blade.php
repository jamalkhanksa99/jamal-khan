<!DOCTYPE html>
<html dir="{{(app()->getLocale() == 'ar') ? 'rtl' : 'ltr'}}">
<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
    }

    h1 {
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }
</style>
<body>
<div class="card">
    @if($status == 2)
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark" style="color: #9ABC66;">✔</i>
        </div>
        <h1 style="color: #88B04B;">{{trans('global.payment.success.title')}}</h1>
        <p>{{trans('global.payment.success.content')}}</p>
        <br/>
        <p>{{trans('global.payment.redirect')}}</p>
    @else
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark" style="color: #bc6666;">✖</i>
        </div>
        <h1 style="color: #b04b4b;">{{trans('global.payment.failed.title')}}</h1>
        <p>{{trans('global.payment.failed.content')}}</p>
        <br/>
        <p>{{trans('global.payment.redirect')}}</p>
    @endif
</div>
</body>
</html>
