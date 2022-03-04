<div class="navigation">
    <div class="navigation-menu-tab">
        <div class="flex-grow-1">
            <ul>
                <li>
                    <a data-toggle="tooltip" data-placement="right" title="Apps" data-nav-target="#apps" style="cursor:pointer">
                        <i data-feather="command"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- begin::navigation menu -->
    <div class="navigation-menu-body">
        <!-- begin::navigation-logo -->
        <div>
            <div id="navigation-logo">
                <a href="#">
                    <H5>Hüseyin TEKİN</H5>
                </a>
            </div>
        </div>
        <!-- end::navigation-logo -->
        <div class="navigation-menu-group">
            <div  class="open" id="apps">
                <ul>
                    <li class="navigation-divider">Web Apps</li>
                    <li>
                        <a href="{{route('app.product.index')}}">
                            <span>Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('app.order.index')}}">
                            <span>Order</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end::navigation menu -->
</div>
