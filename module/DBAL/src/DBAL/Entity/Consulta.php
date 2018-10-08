<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_consulta")
 *
 * @author Cristian Incarnato
 */
class Consulta extends \DBAL\Entity\ExtendedEntity {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    protected $id;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text","required" : true})
     * @Annotation\Options({"label":"Nombre:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":90}})
     * @ORM\Column(type="string", length=90, unique=false, nullable=true)
     */
    protected $nombre;
    
       /**
     * @var string
     * @Annotation\Attributes({"type":"text","required" : true})
     * @Annotation\Options({"label":"email:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":90}})
     * @ORM\Column(type="string", length=90, unique=false, nullable=true)
     */
    protected $email;
    
       /**
     * @var string
     * @Annotation\Attributes({"type":"text","required" : true})
     * @Annotation\Options({"label":"Consulta:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":10000}})
     * @ORM\Column(type="text",  unique=false, nullable=true)
     */
    protected $texto;


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
  

    public function __construct() {

    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEmail() {
        return $this->email;
    }

    function getTexto() {
        return $this->texto;
    }

    function getEvento() {
        return $this->evento;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }



}
