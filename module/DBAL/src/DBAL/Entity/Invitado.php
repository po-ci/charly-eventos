<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_invitado")
 *
 * @author Cristian Incarnato
 */
class Invitado extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Nombre:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $nombre;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Celular:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":50}})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true)
     */
    protected $celular;
    
    
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
          $this->fotos = new ArrayCollection();
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

    function getCelular() {
        return $this->celular;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function getEvento() {
        return $this->evento;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

        
  
        
    public function __toString() {
        return $this->nombre;
    }


}
