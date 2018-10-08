<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_confirmados")
 *
 * @author Cristian Incarnato
 */
class Confirmado extends \DBAL\Entity\ExtendedEntity {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $id;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Evento:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Evento"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Evento")
     * @ORM\JoinColumn(name="evento_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $evento;

    /**
     * @Annotation\Exclude()
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Contacto")
     * @ORM\JoinColumn(name="contacto_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $contacto;

    /**
     * @Annotation\Exclude()
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Modo")
     * @ORM\JoinColumn(name="modo_id", referencedColumnName="id")
     */
    protected $modo;

    public function __construct() {
        $this->fotos = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getEvento() {
        return $this->evento;
    }

    function getContacto() {
        return $this->contacto;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setContacto($contacto) {
        $this->contacto = $contacto;
    }
    
    function getModo() {
        return $this->modo;
    }

    function setModo($modo) {
        $this->modo = $modo;
    }



}
