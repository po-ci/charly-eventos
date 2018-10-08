<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_vendedor_pago")
 *
 * @author Cristian Incarnato
 */
class VendedorPago extends \DBAL\Entity\ExtendedEntity {

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
     * @ORM\OneToOne(targetEntity="CdiUser\Entity\User")
     * @ORM\JoinColumn(name="vendedor_id", referencedColumnName="id")
     */
    protected $vendedor;
    
      /**
     * @var integer
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Cantidad:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $cantidad = 1;

       /**
     * @var string
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Descripcion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":300}})
     * @ORM\Column(name="observaciones",type="string", length=300, unique=false, nullable=true)
     */
    protected $observaciones;

    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

 

    function getCantidad() {
        return $this->cantidad;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

   

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    
    function getVendedor() {
        return $this->vendedor;
    }

    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }





}
