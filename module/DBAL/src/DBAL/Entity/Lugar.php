<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_lugar")
 *
 * @author Cristian Incarnato
 */
class Lugar extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Options({"label":"Direccion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":50}})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true)
     */
    protected $direccion;
    
       /**
     * @var 
     * @ORM\OneToMany(targetEntity="DBAL\Entity\LugarFotos", mappedBy="lugar")
     */
    protected $fotos;

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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function getDireccion() {
        return $this->direccion;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

        
    public function __toString() {
        return $this->nombre;
    }
    function getFotos() {
        return $this->fotos;
    }

    function setFotos($fotos) {
        $this->fotos = $fotos;
    }



}
