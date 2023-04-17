<?php
namespace Ecom1\Model;

class Customer
{
    public $customer_id;
    public $customer_name;
    public $mobile;

    public function exchangeArray($data)
    {
        $this->customer_id     = (!empty($data['customer_id'])) ? $data['customer_id'] : null;
        $this->customer_name = (!empty($data['customer_name'])) ? $data['customer_name'] : null;
        $this->mobile  = (!empty($data['mobile'])) ? $data['mobile'] : null;
    }

    // public function setInputFilter(InputFilterInterface $inputFilter)
    //  {
    //      throw new \Exception("Not used");
    //  }
}
?>