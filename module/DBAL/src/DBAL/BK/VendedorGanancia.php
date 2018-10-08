<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_vendedor_ganancia")
 *
 * @author Cristian Incarnato
 */
class VendedorGanancia extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Options({"label":"Porcentaje:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":100}})
     * @ORM\Column( type="integer", length=2, unique=false, nullable=true)
     */
    protected $porcentaje;


    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    function getVendedor() {
        return $this->vendedor;
    }

    function getPorcentaje() {
        return $this->porcentaje;
    }

    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

    function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }







}
