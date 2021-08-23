<?php

namespace App;

class Cart {

    public $items=null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item,$id){
        $storedItem = ['qty'=>request()->get('qty'),'price'=>$item->price,'item'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']=request()->get('qty')+$storedItem['qty'];
        $storedItem['price'] = $item->price*$storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty+=request()->get('qty');
        $this->totalPrice += $item->price;
    }

}
