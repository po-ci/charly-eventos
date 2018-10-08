<?php

namespace Application\Form;

use Zend\Form\Form,
    Doctrine\Common\Persistence\ObjectManager,
    DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator,
    Zend\Form\Annotation\AnnotationBuilder;
use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import

class LugarFoto extends Form {

    public function __construct($entityManager) {
        // we want to ignore the name passed
        parent::__construct('LugarFoto');

        $this->setAttribute('id', 'LugarFoto');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', "form-horizontal");
        $this->setAttribute('role', "form");
        $this->setAttribute('action', "/gestion/foto-up");
        //Id de Conversacion
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));



        $this->add(array(
            'name' => 'lugar',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'attributes' => array(
                'required' => false,
                "class" => "form-control",
            ),
            'options' => array(
                'object_manager' => $entityManager,
                'target_class' => 'DBAL\Entity\Lugar',
                'display_empty_item' => true,
                'empty_item_label' => '---',
                'property' => 'nombre',
                'label' => "Lugar",
                'description' => '',
            ),
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
            'type' => 'Zend\Form\Element\File',
            'name' => 'picture',
            'options' => array(
                'label' => 'Imagen',
                'description' => 'La imagen a enviar debe tener formato JPG o PNG y un peso maximo de 5Mb'
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
                'type' => 'submit',
                'value' => 'Enviar'
            )
        ));
    }

    public function InputFilter() {

        $inputFilter = new InputFilter();
        $factory = new InputFactory();

        $inputFilter->add($factory->createInput(array(
                    'name' => 'picture',
                    'required' => true,
        )));

        return $inputFilter;
    }

}
