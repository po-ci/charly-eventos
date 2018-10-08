<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_info_formato")
 *
 * @author Cristian Incarnato
 */
class Formato extends \DBAL\Entity\ExtendedEntity {

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
     * @ORM\Column(type="string", length=60, unique=false, nullable=true)
     */
    protected $nombre;
    
    
      /**
     * @var string
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"HTML:"})
     * @ORM\Column(type="text", unique=false, nullable=true)
     */
    protected $html;


    public function __construct() {
        
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

    function getHtml() {
        return $this->html;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setHtml($html) {
        $this->html = $html;
    }
    
    public function __toString() {
        return $this->nombre;
    }




}
