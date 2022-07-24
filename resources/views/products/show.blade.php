@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image"> <img alt="" src="https://picsum.photos/seed/picsum/500/500" id="main_product_image" width="350"> </div>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <li><img alt="" onclick="changeImage(this)" src="https://picsum.photos/seed/picsum/500/500" width="70"></li>
                            <li><img alt="" onclick="changeImage(this)" src="https://picsum.photos/500/500/?blur" width="70"></li>
                            <li><img alt="" onclick="changeImage(this)" src="https://picsum.photos/500/500" width="70"></li>
                            <li><img alt="" onclick="changeImage(this)" src="https://picsum.photos/500/500?grayscale" width="70"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $product->name }}</h3> <span class="heart"><em class='bx bx-heart'></em></span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <p>{{ $product->description }}</p>
                    </div>
                    <h3>₹ {{ $product->price }}</h3>
                    <div class="ratings d-flex flex-row align-items-center">
                        <div class="d-flex flex-row"> <em class='bx bxs-star'></em> <em class='bx bxs-star'></em> <em class='bx bxs-star'></em> <em class='bx bxs-star'></em> <em class='bx bx-star'></em> </div>
                        <span>441 reviews</span>
                    </div>
                    <div class="mt-5"> <span class="fw-bold">Color</span>
                        <div class="colors">
                            <ul id="marker">
                                <li id="marker-1"></li>
                                <li id="marker-2"></li>
                                <li id="marker-3"></li>
                                <li id="marker-4"></li>
                                <li id="marker-5"></li>
                            </ul>
                        </div>
                    </div>
                    <form action="/stripe/{{ $product->id }}" method="post">
                        @csrf
                        <div class="buttons d-flex flex-row mt-5 gap-3"> 
                            <button class="btn btn-outline-dark">Buy Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(element) {
        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;
    }
</script>
@endsection