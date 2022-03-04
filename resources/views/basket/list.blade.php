@extends('master')
@section('title', 'Basket')
@section('content')
<div class="container-fluid">
    <div class="row app-block">
        <div class="col-md-8 app-content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-left font-weight-bold" width="20"><input type="checkbox"></th>
                                            <th class="text-left font-weight-bold" width="400">NAME</th>
                                            <th class="text-left font-weight-bold" width="100">PRİCE</th>
                                            <th class="text-center font-weight-bold" width="500">QUANTITY</th>
                                            <th class="text-right font-weight-bold" width="100">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="basket-body">
                                        @forelse($baskets as $basket)
                                        <tr class="basket-row-{{$basket->basket_id}}">
                                            <td class="text-left"><input type="checkbox" id="delete-all"></td>
                                            <td class="text-left">{{$basket->product->name ?? ""}}</td>
                                            <td class="text-left" id="price-{{$basket->basket_id}}" data-price="{{$basket->product->price * $basket->quantity}}">{{$basket->product->price ?? ""}}</td>
                                            <td class="text-right" id="quantity-{{$basket->basket_id}}" data-quantity="{{$basket->quantity}}">
                                                <form id="data-basket-{{$basket->basket_id}}" mehod="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="hidden" value="{{$basket->product_id}}" name="product_id">
                                                        <input type="hidden" value="{{$basket->category_id}}" name="category_id">
                                                        <input type="number" id="quantity-{{$basket->basket_id}}" name="quantity" min="1" class="form-control-sm" value="{{$basket->quantity}}" data-quantity="{{$basket->quantity}}" style="width: 70px">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-outline-primary btn-square btn-sm" id="{{$basket->basket_id}}" data-toggle="data-update" data-form="data-basket-{{$basket->basket_id}}" data-action="{{route('app.basket.update', $basket->product->product_id)}}"><i class="fa fa-refresh mr-2"></i> Güncelle</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-right"><a href="#" class="btn btn-danger btn-sm" id="{{$basket->basket_id}}" data-action="{{route('app.basket.destroy', $basket->basket_id)}}" onclick="basketDelet(this.id)"><i class="fa fa-trash text-white"></i></a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td  class="text-center" colspan="5">
                                                <h1 style="font-size: 70px">
                                                    <i class="fa fa-database"></i>
                                                </h1>
                                                <h4>No Data Found</h4>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot class="basket-tfoot">
                                        <tr>
                                            <td colspan="3">TOPLAM</td>
                                            <td colspan="2" class="text-right total">{{moneyFormat($discountRules['totalPrice'], "TL")}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="5">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="" id="message-list"></div>
                                @forelse($discountRules['discounts'] as $message)
                                <h5 class="text-success alert-message">{{ $message['discountReason']}}</h5>
                                @empty
                                <div></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 app-sidebar">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary btn-block file-upload-btn text-white" href="{{route('app.order.store')}}">Siparişi Tamamla</a>
                </div>
                <div class="app-sidebar-menu" tabindex="1" style="overflow: hidden; outline: none;">
                    <div class="list-group list-group-flush">
                        <a class="list-group-item d-flex align-items-center">
                            <span class="font-weight-bold">Toplam Adet</span>
                            <span class="small ml-auto font-weight-bold totalQuantity">{{$discountRules['totalQuantity']}}</span>
                        </a>
                        <a class="list-group-item d-flex align-items-center">
                            <span class="font-weight-bold">Toplam Tutar</span>
                            <span class="small ml-auto font-weight-bold total">{{moneyFormat($discountRules['totalPrice'], "TL")}}</span>
                        </a>
                        <a class="list-group-item d-flex align-items-cente text-dark">
                            <span class="font-weight-bold">Toplam İndirim Tutarı</span>
                            <span class="small ml-auto font-weight-bold totalDiscount">{{moneyFormat($discountRules['totalDiscount'], "TL")}}</span>
                        </a>
                        <a class="list-group-item d-flex align-items-cente text-dark">
                            <span class="text-success font-weight-bold">Ödenecek Tutar</span>
                            <span class="ml-auto text-success font-weight-bold discountedTotal">@if(count($discountRules['discounts']) > 0) {{  moneyFormat($discountRules['discountedTotal'], "TL")}} @else {{moneyFormat($discountRules['totalPrice'], "TL")}} @endif</span>
                        </a>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary btn-block file-upload-btn text-white" href="{{route('app.order.store')}}">Siparişi Tamamla</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
