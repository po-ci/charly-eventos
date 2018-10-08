<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_lugar_fotos")
 *
 * @author Cristian Incarnato
 */
class LugarFotos extends \DBAL\Entity\ExtendedEntity {

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
     * "label":"Lugar:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Lugar"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id")
     */
    protected $lugar;

        /**
     * @var string
     * @ORM\Column(type="string", length=80, unique=false, nullable=true, name="imagen")
     */
    protected $imagen;
    
    
    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Nombre:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $nombre;


    public function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getLugar() {
        return $this->lugar;
    }


    function setLugar($lugar) {
        $this->lugar = $lugar;
    }


    function getImagen() {
        return $this->imagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }





}
