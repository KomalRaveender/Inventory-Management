<?php
namespace Ecom1\Model;

use Zend\Db\TableGateway\TableGateway;

class OrderTable
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

    public function getOrder($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getMaxOrderId()
    {
        $rowset = $this->tableGateway->select(function ($select) {
            $select->columns(array('max_order_id' => new \Zend\Db\Sql\Expression('MAX(id)')));
        });

        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not get max order ID");
        }   
        return $row['max_order_id'];
    }

    public function getProductData($id)
{
    $id = (int) $id;
    $rowset = $this->tableGateway->select(array('id' => $id));
    $row = $rowset->current();
    if (!$row) {
        throw new \Exception("Could not find row $id");
    }
    return array('name' => $row->name, 'price' => $row->price);
}

    public function saveOrder(Order $order)
    {
        $data = array(
            'customer_id' => $order->customer_id,
        );

        $id = (int) $order->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getOrder($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Customer id does not exist');
            }
        }
    }

    public function deleteCustomer($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    
}
?>