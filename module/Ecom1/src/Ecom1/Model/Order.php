<?php
namespace Ecom1\Model;

class Order
{
    public $order_id;
    public $customer_id;
    public $order_date;
    public $total_amount;

    public function exchangeArray($data)
    {
        $this->order_id     = (!empty($data['order_id'])) ? $data['order_id'] : null;
        $this->customer_id = (!empty($data['customer_id'])) ? $data['customer_id'] : null;
        $this->order_date  = (!empty($data['order_date'])) ? $data['order_date'] : null;
        $this->total_amount  = (!empty($data['total_amount'])) ? $data['total_amount'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }
}
?>