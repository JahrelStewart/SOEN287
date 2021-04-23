<?php

class cartItems {
    public $item_name; 
    public $item_image;
    public $item_link;
    public $item_quantity;
    public $item_price;
     
    function __construct($name, $image, $link, $quantity, $price) {
        $this->item_name = $name;
        $this->item_image = $image;
        $this->item_link = $link;
        $this->item_quantity = $quantity;      
        $this->item_price = $price;  
    }                  
}

?>