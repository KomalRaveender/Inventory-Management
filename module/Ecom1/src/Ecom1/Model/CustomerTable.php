<?php
namespace Ecom1\Model;

use Zend\Db\TableGateway\TableGateway;

class CustomerTable
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

    public function getCustomer($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveCustomer(Customer $customer)
    {
        $data = array(
            'customer_name' => $customer->customer_name,
            'mobile'  => $customer->mobile,
        );

        $customer_id = (int) $customer->customer_id;
        if ($customer_id == 0) {
            $this->tableGateway->insert($data);
            $customer_id = $this->tableGateway->getLastInsertValue();
        } else {
            if ($this->getCustomer($customer_id)) {
                $this->tableGateway->update($data, array('customer_id' => $customer_id));
            } else {
                throw new \Exception('Customer id does not exist');
            }
        }
        return $customer_id;
    }

    public function deleteCustomer($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
?>