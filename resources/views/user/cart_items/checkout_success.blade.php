@extends('user.layouts.default')

@section('title')
    {{ __('titles.checkout_success') }}
@endsection

@section('inline_styles')
@endsection

@section('content')
    {{ Breadcrumbs::render('checkout_success') }} <br>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-box posting">
                        <div class="alert alert-success alert-lg" role="alert">
                            <h2 class="postin-title">✔ {{ __('messages.order_successfully') }}</h2>
                            <p>{{ __('messages.will_contact') }}</p>
                            <p>{{ __('messages.back_to_home_p1') }}<a href="{{route('home')}} "><strong>home
                                        page</strong></a>{{ __('messages.back_to_home_p2') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('inline_scripts')
    <script type="text/javascript">
    </script>
@endsection