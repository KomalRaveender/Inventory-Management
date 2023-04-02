<?php

namespace Ecom1\Form;

use Zend\Form\Form;

class ProductForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('customer');

        $this->add(array(
            'name' => 'product_id',
            'options' => array(
                'label' => 'Product Id '
            )
        ));
        $this->add(array(
            'name' => 'product_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Name',
            ),
        ));
        $this->add(array(
            'name' => 'product_price',
            'type' => 'Text',
            'options' => array(
                'label' => 'Product Name',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Fetch',
                'id' => 'submitbutton',
            ),
        ));
    }
}