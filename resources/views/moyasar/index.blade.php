<!DOCTYPE html>
<html dir="{{$language == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <title>{{env('APP_NAME')}}</title>
    <!-- Other Tags -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.6.1/moyasar.css">

    <!-- jQuery Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Moyasar Scripts -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.6.1/moyasar.js"></script>
</head>
<style>
    /* Center the loader */
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 120px;
        height: 120px;
        margin: -76px 0 0 -76px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #1ED0C6;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
<body>
<div class="loader"></div>
<div class="mysr-form"></div>
</body>
<script>
    Moyasar.init({
        // Required
        // Specify where to render the form
        element: '.mysr-form',

        // Required
        // Amount in the smallest currency unit
        amount: {{$orderAmount}},

        // Required
        // Currency of the payment transation
        currency: 'SAR',

        // Optional
        // Order Metadata
        metadata: {
            'order_id': '{{$orderID}}'
        },

        // Required
        // A small description of the current payment process
        description: '{{$orderDescription}}',

        // Required
        publishable_api_key: '{{config('moyasar.publishable_key')}}',

        // Optional
        // Language
        language: '{{$language}}',

        // Required
        // This URL is used to redirect the user when payment process has completed
        // Payment can be either a success or a failure, which you need to verify on you system (We will show this in a couple of lines)
        callback_url: '{{env('APP_URL')}}/payments/moyasar/{{$orderCallbackEndpoint}}?language={{$language}}',

        // Optional
        // Required payments methods
        // Default: ['creditcard', 'applepay', 'stcpay']
        methods: [
            'creditcard',
        ],
    });
</script>
<script>
    $(document).ready(function () {
        $('.loader').hide();
    });
</script>
</html>
