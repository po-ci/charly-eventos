<?php

namespace Front\Form;

use Zend\Form\Form,
    Doctrine\Common\Persistence\ObjectManager,
    DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator,
    Zend\Form\Annotation\AnnotationBuilder;
use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import

class Tipo extends Form {

    public function __construct($entityManager) {
        // we want to ignore the name passed
        parent::__construct('Tipo');

        $this->setAttribute('id', 'Tipo');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('role', "form");
        //$this->setAttribute('action', "javascript:submitConsulta()");
        //Id de Conversacion
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));


        $this->add(array(
            'name' => 'evento',
            'type' => 'Zend\Form\Element\Hidden',
        ));


         /*
         * Input Select - Array (Example estados)
         */
        $this->add(array(
            'name' => 'modo',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'required' => true,
                "class" => "form-control"
            ),
            'options' => array(
                'object_manager' => $entityManager,
                'target_class' => 'DBAL\Entity\Modo',
                'property' => 'nombre',
                  'display_empty_item' => true,
                'empty_item_label' => 'Seleccionar',
            ),
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
                "class" => "btn btn-facebook-p marginTop5",
                'type' => 'submit',
                'value' => 'Confirmar Evento'
            )
        ));
    }

    public function InputFilter() {

        $inputFilter = new InputFilter();
        $factory = new InputFactory();
   /*
         * Input Filter: Required and Not Empty
         */
        $inputFilter->add($factory->createInput(array(
                    'name' => 'modo',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'not_empty',
                        ),
                    ),
        )));
 

        return $inputFilter;
    }

}
