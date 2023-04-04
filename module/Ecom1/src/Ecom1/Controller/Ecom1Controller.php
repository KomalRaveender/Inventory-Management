<?php
namespace Ecom1\Controller;

use Ecom1\Model\Product;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Ecom1\Model\Customer;         
use Ecom1\Form\CustomerForm;
use Ecom1\Model\Order;
use Ecom1\Form\ProductForm;

class Ecom1Controller extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel(array(
            'customers' => $this->getCustomerTable()->fetchAll(),
        ));
    }

    public function addcustomerAction()
     {
         $form = new CustomerForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $customer = new customer();
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $customer->exchangeArray($form->getData());
                 $customer_id = $this->getCustomerTable()->saveCustomer($customer);
                 $order = new Order();
                 $order->customer_id = $customer_id;
                    $this->getOrderTable()->saveOrder($order);
                 return $this->redirect()->toRoute('ecom1');
             }
         }
         return array('form' => $form);
     }

     public function addproductAction()
     {
         $form = new ProductForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $product = new Product();
             $form->setInputFilter($product->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $product->exchangeArray($form->getData());
                 $this->getAlbumTable()->saveEcom1($product);

                 // Redirect to list of product
                 return $this->redirect()->toRoute('ecom1');
             }
         }
         return array('form' => $form);
     }

     public function getproductAction()
     {
         $form = new ProductForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $album = new Product();
             $form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $album->exchangeArray($form->getData());
                 $this->getAlbumTable()->saveAlbum($album);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('ecom1');
             }
         }
         return array('form' => $form);
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
        if (!$this->ProductTable) {
            $sm = $this->getServiceLocator();
            $this->ProductTable = $sm->get('Ecom1\Model\ProductTable');
        }
        return $this->ProductTable;
    }
}
?>