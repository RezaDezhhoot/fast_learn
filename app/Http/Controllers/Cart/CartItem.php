<?php

namespace App\Http\Controllers\Cart;

use App\Models\Course;

class CartItem
{
    public $id;
    public $title;
    public $image;
    public $quantity;
    public $price;
    public $basePrice;
    public $discount;

    public function __construct($course )
    {
        $this->id = $course->id;
        $this->title = $course->title;
        $this->image = $course->image;
        $this->price = $course->price;
        $this->basePrice = $course->basePrice;
    }

    public function price()
    {
        return ($this->basePrice) ;
    }


    public function discount()
    {
        return ($this->basePrice - $this->price);
    }

    public function total()
    {
        return $this->price() - $this->discount();
    }
}
