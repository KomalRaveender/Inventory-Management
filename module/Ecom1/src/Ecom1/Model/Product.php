<?php
namespace Ecom1\Model;

class Product
{
    public $product_id;
    public $product_name;
    public $product_price;

    public function exchangeArray($data)
    {
        $this->product_id     = (!empty($data['product_id'])) ? $data['product_id'] : null;
        $this->product_name = (!empty($data['product_name'])) ? $data['product_name'] : null;
        $this->product_price  = (!empty($data['product_price'])) ? $data['product_price'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }
}
?>