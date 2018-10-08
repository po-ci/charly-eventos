<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_inventario")
 *
 * @author Cristian Incarnato
 */
class Inventario extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Proveedor:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Proveedor"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Proveedor")
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id")
     */
    protected $proveedor;
    
    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Numero Serie:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":300}})
     * @ORM\Column(name="numero_serie",type="string", length=300, unique=false, nullable=true)
     */
    protected $numeroSerie;
    
      /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Estado:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\InventarioEstado"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\InventarioEstado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    protected $estado;

    /**
     * @var string
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Descripcion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":300}})
     * @ORM\Column(name="descripcion",type="string", length=300, unique=false, nullable=true)
     */
    protected $descripcion;


    public function __construct() {
       
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
  

    function getProveedor() {
        return $this->proveedor;
    }

    function getNumeroSerie() {
        return $this->numeroSerie;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    function setNumeroSerie($numeroSerie) {
        $this->numeroSerie = $numeroSerie;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function getProducto() {
        return $this->producto;
    }

    function setProducto($producto) {
        $this->producto = $producto;
    }







  

}
