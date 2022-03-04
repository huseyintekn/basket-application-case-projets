@extends('master')
@section('title', 'Product')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="card border">
                                    <img src="{{asset('assets/panel/media/image/photo1.jpg')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">{{$product->name}}</p>
                                        <p>Fiyat : {{moneyFormat($product->price, 'TL')}}</p>
                                        <button type="button" class="btn btn-primary mr-2 mb-2" data-toggle="modal" data-action="{{route('app.product.modal', $product->product_id)}}"  style="cursor: pointer">
                                            <i class="fa fa-shopping-basket mr-2"></i><span>Sepete Ekle</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
