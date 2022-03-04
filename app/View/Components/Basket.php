<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Repository\App\Basket\BasketRepository;
use App\Models\Basket as Baskets;
use Illuminate\Support\Facades\DB;
class Basket extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected  $baskets;

    public function __construct(BasketRepository $basket)
    {
        $this->baskets = $basket;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data['baskets'] = $this->baskets->getByFields(['custemers_id'=>1], ['product']);
        $data['discountRules'] = $this->baskets->discountRules();

       // $data['unitePriceTotal'] = $this->baskets->getByFields(['customer_id'=>1], ['product'])->sum('orderItem.unitPrice');
       // $data['orderTotal'] = $this->baskets->getByFields(['customer_id'=>1], ['orderItem'])->sum('total');

        return view('components.basket', $data);
    }

}
