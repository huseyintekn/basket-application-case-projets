<ul class="navbar-nav">
    <!-- begin::user menu -->
    <li class="nav-item dropdown">
        <a href="#" class="nav-link" title="User menu" data-toggle="dropdown">
            <i class="fa fa-shopping-basket" style="font-size: 40px"></i>
            <span id="basket" class="position-absolute top-0 translate-middle p-1 bg-danger border border-light rounded-circle" data-count="{{$baskets->sum('quantity')}}">{{$baskets->sum('quantity')}}</span>
        </a>
        <div id="basket-dropdown" class="dropdown-menu dropdown-menu-right dropdown-menu-big" style="width: 550px !important; padding: 20px!important;">
            <div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="basket-body">
                            @forelse($baskets as $basket)
                            <tr class="basket-row-{{$basket->basket_id}}">
                                <td>{{$basket->product->name}}</td>
                                <td id="price-{{$basket->basket_id}}" data-price="{{$basket->product->price * $basket->quantity}}">{{moneyFormat($basket->product->price, 'TL')}}</td>
                                <td class="text-center" id="quantity-{{$basket->basket_id}}" data-quantity="{{$basket->quantity}}">{{$basket->quantity}}</td>
                                <td class="text-right"><a href="#" id="{{$basket->basket_id}}" data-action="{{route('app.basket.destroy', $basket->basket_id)}}" onclick="basketDelet(this.id)"><i class="fa fa-trash text-danger"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td  class="text-center" colspan="4">
                                    <h5>
                                        <i class="fa fa-database"></i>
                                    </h5>
                                    <h4>Sepenizde Ürün Bulunmamaktadır.</h4>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <br>
                        <tfoot class="basket-tfoot">
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="3" class="text-right small font-weight-bold">Toplam Tutar : <span class="total">{{moneyFormat($discountRules['totalPrice'], "TL")}}</span></td>
                            </tr>
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="3" class="text-right small font-weight-bold">Toplam İndirim Tutarı : <span class="totalDiscount">{{moneyFormat($discountRules['totalDiscount'], "TL")}}</span></td>
                            </tr>
                            <tr>
                                <td colspan="1"></td>
                                <td colspan="3" class="text-right small text-success font-weight-bold">Ödenecek Tutar : <span class="discountedTotal">@if(count($discountRules['discounts']) > 0) {{  moneyFormat($discountRules['discountedTotal'], "TL")}} @else {{moneyFormat($discountRules['totalPrice'], "TL")}} @endif</span></td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="4">
                                    <a href="{{route('app.basket.index')}}" class="btn btn-primary text-white">Sepete Git</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </li>
    <!-- end::user menu -->
</ul>
