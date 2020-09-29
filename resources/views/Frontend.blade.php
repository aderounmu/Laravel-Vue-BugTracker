<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script> window.Laravel = { csrfToken: '{{csrf_token()}}'}</script>
    <title>Bug Tracker Application</title>
    <link rel="stylesheet" href="{{secure_asset('css/app.css')}}">
</head>
<body>

    <div id="app">
        <application></application>
    </div>
</body>
<script src="{{asset('js/app.js')}}"></script>
</html>