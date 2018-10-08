<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_proveedores")
 *
 * @author Cristian Incarnato
 */
class Proveedor extends \DBAL\Entity\ExtendedEntity {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Attributes({"type":"hidden"})
     */
    protected $id;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Nombre:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":100}})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true)
     */
    protected $nombre;

    /**
     * @var string
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Descripcion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":300}})
     * @ORM\Column(name="descripcion",type="string", length=300, unique=false, nullable=true)
     */
    protected $descripcion;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function __toString() {
        return $this->nombre;
    }



}
