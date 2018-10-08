<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_venta_item")
 *
 * @author Cristian Incarnato
 */
class VentaItem extends \DBAL\Entity\BaseEntity {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Annotation\Attributes({"type":"hidden"})
     */
    protected $id;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Venta:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Venta"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Venta")
     * @ORM\JoinColumn(name="venta_id", referencedColumnName="id")
     */
    protected $venta;

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
    protected $cantidad;
    
      /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Valor Total:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $valor;

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

    function getVenta() {
        return $this->venta;
    }

    function getProducto() {
        return $this->producto;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setVenta($venta) {
        $this->venta = $venta;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    function getValor() {
        return $this->valor;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    
    public function __toString() {
        return $this->producto . "(" . $this->cantidad . ")";
    }

}
