@extends('layouts.auth.default')
@section('content')
    <div class="row justify-content-center">
        <div class="mx-4">
            <div class="p-4" style="text-align: center;">
                <h1>{{ trans('global.app_name') }}</h1>
                <p class="text-muted">{{ trans('global.reset_password_mobile') }}</p>
                <p class="text-muted">{{ trans('global.reset_password_mobile_redirect') }}</p>
            </div>
        </div>
    </div>
@endsection
