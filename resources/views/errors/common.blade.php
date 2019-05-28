@extends('user.layouts.default')

@section('title')
    {{ $error_code . ' Error' }}
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
                            <h1 class="postin-title text-center">{{ $error_code . ' Error' }}</h1>
                            <p class="text-center"> {{ $error_message }} </p>
                            {{--                            <p class="text-center">Sorry, this is not the web page you are looking for. </p>--}}
                            <a href="{{ route('home') }}"><p class="text-center">« Back to home</p></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    {{ dd(\Auth::user()) }}--}}
@endsection

@section('inline_scripts')
@endsection
