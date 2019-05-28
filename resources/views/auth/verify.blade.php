{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if (session('resent'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                        {{ __('If you did not receive the email') }}, <a--}}
{{--                                href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('user.layouts.default')

@section('title')
    Verify Email
@endsection

@section('inline_styles')
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-box posting">
                        <div class="alert alert-danger alert-lg" role="alert">
                            <h1 class="postin-title text-center">Verify Email</h1>
                            @if (session('resent'))
                                <div class="text-center" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <div class="text-center">
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }}, <a
                                        href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('inline_scripts')
@endsection

