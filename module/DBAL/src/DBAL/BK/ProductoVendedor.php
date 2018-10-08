<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_producto_vendedor")
 *
 * @author Cristian Incarnato
 */
class ProductoVendedor extends \DBAL\Entity\ExtendedEntity {

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
     * "label":"Vendedor:",
     * "empty_option": "",
     * "target_class":"CdiUser\Entity\User"})
     * @ORM\ManyToOne(targetEntity="CdiUser\Entity\User")
     * @ORM\JoinColumn(name="vendedor_id", referencedColumnName="id")
     */
    protected $vendedor;

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
     * @var integer
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Cantidad:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $disponibles;
    
      /**
     * @var integer
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Cantidad:"})
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

    function getProducto() {
        return $this->producto;
    }

    function getCantidad() {
        return $this->cantidad;
    }


    function setProducto($producto) {
        $this->producto = $producto;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }


    function getVendedor() {
        return $this->vendedor;
    }

    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

    function getDisponibles() {
        return $this->disponibles;
    }

    function getVendidos() {
        return $this->vendidos;
    }

    function setDisponibles($disponibles) {
        $this->disponibles = $disponibles;
    }

    function setVendidos($vendidos) {
        $this->vendidos = $vendidos;
    }







}
