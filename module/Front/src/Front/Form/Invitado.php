<?php

namespace Front\Form;

use Zend\Form\Form,
    Doctrine\Common\Persistence\ObjectManager,
    DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator,
    Zend\Form\Annotation\AnnotationBuilder;
use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import

class Invitado extends Form {

    public function __construct() {
        // we want to ignore the name passed
        parent::__construct('Invitado');

        $this->setAttribute('id', 'Invitado');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('role', "form");
        $this->setAttribute('action', "javascript:addInvitado()");



//Id de Conversacion
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'evento',
            'type' => 'Zend\Form\Element\Hidden',
        ));



        $this->add(array(
            'name' => 'nombre',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => true,
                'class' => "form-control",
            ),
            'options' => array(
                'label' => 'Nombre',
            )
        ));


        $this->add(array(
            'name' => 'celular',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => true,
                'class' => "form-control",
            ),
            'options' => array(
                'label' => 'Celular',
            )
        ));




        $this->addSubmitAndCsrf();
    }

    protected function addSubmitAndCsrf() {
//        $this->add(array(
//            'type' => 'Zend\Form\Element\Csrf',
//            'name' => 'csrf'
//        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => '+',
                'class' => "btn btn-success"
            )
        ));
    }

    public function InputFilter() {

        $inputFilter = new InputFilter();
        $factory = new InputFactory();

    

        return $inputFilter;
    }

}
