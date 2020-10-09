<?php

class Product implements JsonSerializable {
    private $code;
    private $name;
    private $description;
    private $price;
    private $items;
    private $img_path_list;

    function Product() {
        $this->code = "";
        $this->name = "";
        $this->description = "";
        $this->price = "";
        $this->items = "";
        $this->img_path_list = Array();
    }

    function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'name' =>  $this->name,
            'description' =>  $this->description,
            'price' => $this->price,
            'items' => $this->items,
            'img_path_list' => $this->img_path_list
        ];
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }


    public function getImgPathList()
    {
        return $this->img_path_list;
    }


    public function setImgPathList($img_path_list)
    {
        $this->img_path_list = $img_path_list;
    }
    public function addImageInPathList($img_path)
    {
        $this->img_path_list[] = $img_path;
    }

}
?>