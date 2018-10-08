<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_producto")
 *
 * @author Cristian Incarnato
 */
class Producto extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Options({"label":"Marca:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":100}})
     * @ORM\Column(type="string", length=100, unique=false, nullable=true)
     */
    protected $marca;
    
      /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Modelo:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":200}})
     * @ORM\Column(type="string", length=200, unique=false, nullable=true)
     */
    protected $modelo;

      /**
     * @var 
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Costo:"})
     * @Annotation\Filter({"name":"PregReplace", "options":{"pattern":"/\./", "replacement":""}})
     * @Annotation\Filter({"name":"PregReplace", "options":{"pattern":"/,/", "replacement":"."}})
     * @ORM\Column(type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $costo;
    
        /**
     * @var 
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Precio:"})
     * @ORM\Column(type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $precio;
    
    
      /**
       * @Annotation\Attributes({"type":"checkbox"})
     * @Annotation\Options({"label":"Activo:"})
     * @ORM\Column(type="boolean", unique=false, nullable=true, name="pagada")
     */
    protected $activo;
    
    
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
     * @Annotation\Options({"label":"Entregados:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $entregados;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text", "disabled":"disabled"})
     * @Annotation\Options({"label":"Vendidos:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $vendidos;



    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function getCosto() {
        return $this->costo;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setCosto($costo) {
        $this->costo = $costo;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function getActivo() {
        return $this->activo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

            public function __toString() {
        return $this->marca." ".$this->modelo;
    }
    
    function getDisponibles() {
        return $this->disponibles;
    }

    function getEntregados() {
        return $this->entregados;
    }

    function getVendidos() {
        return $this->vendidos;
    }

    function setDisponibles($disponibles) {
        $this->disponibles = $disponibles;
    }

    function setEntregados($entregados) {
        $this->entregados = $entregados;
    }

    function setVendidos($vendidos) {
        $this->vendidos = $vendidos;
    }





}
