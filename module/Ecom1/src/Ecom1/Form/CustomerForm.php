<?php

namespace Ecom1\Form;

use Zend\Form\Form;

class CustomerForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('customer');

        $this->add(array(
            'name' => 'customer_id',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'customer_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Customer Name ',
            ),
        ));
        $this->add(array(
            'name' => 'mobile',
            'type' => 'Text',
            'options' => array(
                'label' => '  Mobile  ',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submitbutton',
            ),
        ));
    }
}