<div class="modal" tabindex="-1" role="dialog" id="exampleModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sepete Ürün Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="basket-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="m-b-30 m-t-30 list-group list-group-flush">
                                <li class="list-group-item">
                                    <p class="font-weight-bold" for="">Ürün Adı</p>
                                    <span>{{$product->name}}</span>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-bold" for="">Kategori</p>
                                    <span>{{$product->category_id}}</span>
                                </li>
                                <li class="list-group-item">
                                    <p class="font-weight-bold" for="">Ürün Fiyatı</p>
                                    <span>{{$product->price}} TL</span>
                                </li>
                                <li class="list-group-item">
                                    <label class="font-weight-bold" for="">Ürün Adet</label>
                                    <div class="input-group">
                                        <input type="hidden" value="{{$product->category_id}}" name="category_id">
                                        <input type="hidden" id="product_id" value="{{$product->product_id}}" name="product_id">
                                        <input type="number" class="form-control" name="quantity" value="1" min="1" autocomplete="off">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-square" data-form="basket-form" data-toggle="data-create" data-action="{{route('app.basket.store')}}" style="cursor: pointer"><i class="fa fa-save mr-1"></i>| Sepete Ekle</button>
                <button type="button" class="btn btn-outline-dark btn-square" data-dismiss="modal"><i class="fa fa-close mr-1"></i>| Kapat</button>
            </div>
        </div>
    </div>
</div>
