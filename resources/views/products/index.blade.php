@extends('layouts.app')

@section('content')
<div class="container">
    <div class="shop-default shop-cards shop-tech">
        <div class="row">
            @empty($products)
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <strong>No products found!</strong>
                </div>
            </div>
            @else
            @foreach ($products as $product)
            <div class="col-sm-6 mb-4">
                <div class="block product no-border z-depth-2-top z-depth-2--hover">
                    <div class="block-image">
                        <a href="#">
                            <img src="https://via.placeholder.com/550x350/FFB6C1/000000" alt="" class="rounded mx-auto d-block">
                        </a>
                    </div>
                    <div class="block-body text-center">
                        <h3 class="heading heading-5 strong-600 text-capitalize">
                            <a href="#">
                                {{ $product->name }}
                            </a>
                        </h3>
                        <p class="product-description">
                            {{ $product->description }}
                        </p>
                        <div class="product-colors mt-2">
                            <div class="color-switch float-wrapper">
                                ₹ {{ $product->price }}
                            </div>
                        </div>
                        <div class="product-buttons mt-4">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <button type="button" class="btn-icon" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Favorite">
                                        <em class="fa fa-heart"></em>
                                    </button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn-icon" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Compare">
                                        <em class="fa fa-share"></em>
                                    </button>
                                </div>
                                <div class="col-8">
                                    <a href="/products/{{ $product->id }}" class="btn btn-block btn-primary btn-circle btn-icon-left">
                                        <em class="fa fa-shopping-cart"></em>Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            @endempty
        </div>
    </div>
</div>
@endsection