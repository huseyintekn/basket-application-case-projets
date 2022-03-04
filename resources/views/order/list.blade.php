@extends('master')
@section('title', 'Order')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-left font-weight-bold" width="20"><input type="checkbox"></th>
                                            <th class="text-left font-weight-bold" width="80">Image</th>
                                            <th class="text-left font-weight-bold" width="800">Product Name</th>
                                            <th class="text-left font-weight-bold" width="100">Unit Price</th>
                                            <th class="text-center font-weight-bold" width="200">Quantity</th>
                                            <th class="text-left font-weight-bold" width="100">Total</th>
                                            <th class="text-right font-weight-bold" width="100">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="order-body">
                                        @forelse($orders as $order)
                                            <tr class="order-row-{{$order->order_id}}">
                                                <td class="text-left"><input type="checkbox" id="delete-all"></td>
                                                <td class="text-left"><img src="{{asset('assets/panel/media/image/photo1.jpg')}}" class="card-img-top" width="200" height="auto"></td>
                                                <td class="text-left">{{$order->orderItem->product->name ?? ""}}</td>
                                                <td class="text-left">{{moneyFormat($order->orderItem->unitPrice, "TL")}}</td>
                                                <td class="text-center">{{$order->orderItem->quantity ?? ""}}</td>
                                                <td class="text-left">{{moneyFormat($order->orderItem->total, "TL")}}</td>
                                                <td class="text-right"><a href="{{route('app.order.destroy', $order->order_id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"></i></a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td  class="text-center" colspan="7">
                                                    <h1 style="font-size: 70px">
                                                        <i class="fa fa-database"></i>
                                                    </h1>
                                                    <h4>No Data Found</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                        @if(count($orders) > 0)
                                        <tfoot class="order-tfoot">
                                            <tr>
                                                <td colspan="3">TOPLAM</td>
                                                <td colspan="1" class="text-left total">{{ moneyFormat($orders->sum('orderItem.unitPrice'), 'TL')}} </td>
                                                <td colspan="1" class="text-center total">{{ $orders->sum('orderItem.quantity')}} </td>
                                                <td colspan="1" class="text-left total">{{ moneyFormat($orders->sum('total'), 'TL')}} </td>
                                                <td colspan="1" class="text-right total"></td>
                                            </tr>
                                        </tfoot>
                                        @endif
                                    </table>
                                    <div class="" id="message-list"></div>
                                  {{--  @forelse($total['discounts'] as $message)
                                        <h5 class="text-success alert-message">{{ $message['discountReason']}}</h5>
                                    @empty
                                        <div></div>
                                    @endforelse--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
