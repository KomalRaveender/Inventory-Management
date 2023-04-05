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

    public function getProduct($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveProduct(Product $product)
    {
        $data = array(
            'product_name' => $product->product_name,
            'product_price'  => $product->product_price,
        );

        $product_id = (int) $product->product_id;
        if ($product_id == 0) {
            $this->tableGateway->insert($data);
            //$product_id = $this->tableGateway->getLastInsertValue();
        } else {
            if ($this->getProduct($product_id)) {
                $this->tableGateway->update($data, array('product_id' => $product_id));
            } else {
                throw new \Exception('Customer id does not exist');
            }
        }
    }

    public function deleteProduct   ($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
?>