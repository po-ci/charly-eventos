<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_existencia")
 *
 * @author Cristian Incarnato
 */
class Existencia extends \DBAL\Entity\ExtendedEntity {

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
     * "label":"Producto:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Producto"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Producto")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
     */
    protected $producto;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Disponibles:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $disponibles;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text", "disabled":"disabled"})
     * @Annotation\Options({"label":"Reservados:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $reservados;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text", "disabled":"disabled"})
     * @Annotation\Options({"label":"Vendidos:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $vendidos;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    function getMarcaModelo() {
        return $this->marcaModelo;
    }

    function getDisponibles() {
        return $this->disponibles;
    }

    function getReservados() {
        return $this->reservados;
    }

    function getVendidos() {
        return $this->vendidos;
    }

    function setMarcaModelo($marcaModelo) {
        $this->marcaModelo = $marcaModelo;
    }

    function setDisponibles($disponibles) {
        $this->disponibles = $disponibles;
    }

    function setReservados($reservados) {
        $this->reservados = $reservados;
    }

    function setVendidos($vendidos) {
        $this->vendidos = $vendidos;
    }



}
