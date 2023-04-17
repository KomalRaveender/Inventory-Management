<?php
namespace Ecom1\Controller;

use Zend\ProgressBar\Adapter\Console;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Ecom1\Model\Product;
use Ecom1\Model\Customer;
use Ecom1\Model\ProductTable;
use Ecom1\Form\CustomerForm;
use Ecom1\Model\Order;
use Zend\View\Model\JsonModel;
use Ecom1\Form\ProductForm;

class Ecom1Controller extends AbstractActionController
{
    
    public function indexAction()
    {
        // Fetch all customers
        $customers = $this->getCustomerTable()->fetchAll();
        
    }

    public function fetchAction()
    {
        $productId = $this->params()->fromRoute('id');

        $product = $this->getProductTable()->getProduct($productId);

        return $this->getResponse()->setContent(json_encode([
            'product_name' => $product['product_name'],
            'product_price' => $product['product_price']
        ]));

    }

    public function ordernowAction()
    {
        $formData = $this->getRequest()->getPost();

        $tableGateway = $this->getServiceLocator()->get('Order\Model\OrderTableGateway');

        $ProductTable = new ProductTable($tableGateway);
       
        //  $cust_details =$this->getCustomerTable()->getCustomer($formData['orderData']['customer_id']);
        
        $result = $ProductTable->storeOrder($formData);
        
        $cust_details =$this->getCustomerTable()->getCustomer($result['orderData']['customer_id']);
        // echo("<pre>");
        // print_r($cust_details);
        // echo("</pre>");
        // die();
        return new ViewModel([
            'result' => $result,'cust_details' => $cust_details
        ]);


    }

    protected $CustomerTable;

    public function getCustomerTable()
    {
        if (!$this->CustomerTable) {
            $sm = $this->getServiceLocator();
            $this->CustomerTable = $sm->get('Ecom1\Model\CustomerTable');
        }
        return $this->CustomerTable;
    }

    protected $OrderTable;

    public function getOrderTable()
    {
        if (!$this->OrderTable) {
            $sm = $this->getServiceLocator();
            $this->OrderTable = $sm->get('Ecom1\Model\OrderTable');
        }
        return $this->OrderTable;
    }

    protected $getProductTable;
    public function getProductTable()
    {
        if (!$this->getProductTable) {
            $sm = $this->getServiceLocator();
            $this->ProductTable = $sm->get('Ecom1\Model\ProductTable');
        }
        return $this->ProductTable;
    }

}
?>