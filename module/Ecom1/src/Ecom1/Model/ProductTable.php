<?php
namespace Ecom1\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProduct($product_id)
    {
        //$product_id  = (int) $product_id;
        $rowset = $this->tableGateway->select(array('product_id' => $product_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $product_id");
        }

        return [
            'product_name' => $row->product_name,
            'product_price' => $row->product_price
        ];
    }

    public function storeOrder($formData)
    {
        $customerData = array(
            'customer_name' => $formData['customer_name'],
            'mobile' => $formData['mobile'],
        );

        $customertable = new TableGateway('customer', $this->tableGateway->getAdapter());


        $customertable->insert($customerData);
        $custId = $customertable->getLastInsertValue();

        $totalprice = 0;

        foreach ($formData['price'] as $netprice) {
            $totalprice += (float) $netprice;
        }

        $orderDate = date("Y-m-d");

        $orderData = array(
            'customer_id' => $custId,
            'order_date' => $orderDate,
            'total_amount' => $totalprice,
        );


        $ordertable = new TableGateway('orders', $this->tableGateway->getAdapter());


        $ordertable->insert($orderData);
        $orderId = $ordertable->getLastInsertValue();


        $productNames = array();

        for ($i = 0; $i < count($formData['product_id']); $i++) {
            $productId = $formData['product_id'][$i];
            $productName = $formData['product_name'][$i];
            $productQuantity = $formData['quantity'][$i];
            $productPrice = $formData['price'][$i];

            $productNames[] = array(
                'product_name' => $productName,
                'price' => $productPrice,
                'quantity' => $productQuantity,
                'prod_price' => $productPrice * $productQuantity,
            );

            $data1 = array();
            $orderDetailsData = array(
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $productQuantity,
                'product_price' => $productQuantity * $productPrice,

            );

            $data1[] = $orderDetailsData;

            $orderDetailsTable = new TableGateway('order_details', $this->tableGateway->getAdapter());
            $orderDetailsTable->insert($orderDetailsData);
        }

        $data123 = array(
            'order_id' => $orderId,
            'product_id' => $productId,
            'orderData' => $orderData,
            'orderDetails' => $data1,
            'productNames' => $productNames,
        );

        return $data123;
    }
}
?>