@extends('user.layouts.default')

@section('title')
    {{ __('titles.checkout') }}
@endsection

@section('inline_styles')
@endsection

@section('content')
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-1">
                <div class="box">
                    <h2 class="title-2">Your Items</h2>
                    <ul>
                        @foreach($courseRelations as $courseRelation)
                            <li>
                                <h3><img class="userimg" src="{{ asset($courseRelation->course->course_avatar) }}" alt=""> {{ $courseRelation->course->title }} - {{ $courseRelation->course->user->name }} - @if($courseRelation->course->promotion_price) <span style="color:red">${{ $courseRelation->course->promotion_price }}</span> <strike>${{ $courseRelation->course->origin_price }} </strike> @else ${{ $courseRelation->course->origin_price }} @endif </h3><br>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-md-offset-1">
                <form action="{{route('cart_items.checkout.post')}}" method="POST">
                    @csrf
                    <div class="box">
                        <h2 class="title-2">Your Delivery Information</h2>
                        <div class="form-group">
                            <label class="control-label" for="textarea">Name *</label> <input class="form-control" name="customer_name" placeholder="Your Name" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textarea">Email *</label> <input class="form-control" name="customer_email" placeholder="Your Email" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textarea">Phone Number *</label> <input class="form-control"  name="customer_phone" placeholder="Phone Number" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textarea">Address *</label> <input class="form-control" name="customer_address" placeholder="Your address" type="text">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="textarea">Note</label> <input class="form-control" name="customer_note" placeholder="Note" type="textarea">
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="get_ads"> <small>Give me your ads.</small></label>
                        </div>
                    </div>
                    <div class="mb30"></div>
                    <div class="form-group">
                        <div class="page-ads box">
                            <p><i class="fa fa-shield"></i> &ensp; Secure Connection</p>
                            <div class="checkbox">
                                <i class="fa fa-check-square"></i> &ensp; By completing your purchase you agree to these <a href="#">Terms of Service</a>
                            </div>
                            <br>
                            <input class="btn btn-common" type="submit" value="Submit for order">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('inline_scripts')
<script type="text/javascript">
</script>
@endsection