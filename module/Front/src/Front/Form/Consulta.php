<?php

namespace Front\Form;

use Zend\Form\Form,
    Doctrine\Common\Persistence\ObjectManager,
    DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator,
    Zend\Form\Annotation\AnnotationBuilder;
use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import

class Consulta extends Form {

    public function __construct() {
        // we want to ignore the name passed
        parent::__construct('Contacto');

        $this->setAttribute('id', 'Consulta');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('role', "form");
        $this->setAttribute('action', "javascript:submitConsulta()");
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
                'label' => 'Nombre y apellido',
            )
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'required' => true,
                'class' => "form-control",
            ),
            'options' => array(
                'label' => 'Email',
            )
        ));


        $this->add(array(
            'name' => 'texto',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'required' => true,
                'class' => "form-control",
            ),
            'options' => array(
                'label' => 'Consulta',
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
                'value' => 'Enviar'
            )
        ));
    }

    public function InputFilter() {

        $inputFilter = new InputFilter();
        $factory = new InputFactory();

 

        return $inputFilter;
    }

}
