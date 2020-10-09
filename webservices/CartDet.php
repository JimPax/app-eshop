<?php

class CartDet implements JsonSerializable
{
    private $quantity;
    private $code;
    private $name;
    private $price;
    private $img;
    private $fprice;

    function CartDet(){
        $this->quantity = "";
        $this->code = "";
        $this->name = "";
        $this->price = "";
        $this->img = "";
        $this->fprice = "";
    }

    function jsonSerialize()
    {
        return [
          'quantity' => $this->quantity,
          'code' => $this->code,
          'name' => $this->name,
          'price' => $this->price,
          'img' => $this->img,
          'fprice' => $this->fprice
        ];
    }

    public function getFprice()
    {
        return $this->fprice;
    }

    public function setFprice($fprice)
    {
        $this->fprice = $fprice;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

?>