<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_clientes")
 *
 * @author Cristian Incarnato
 */
class Cliente extends \DBAL\Entity\ExtendedEntity {

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
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $nombre;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Apellido:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $apellido;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"DNI:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $dni;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Direccion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":50}})
     * @ORM\Column(type="string", length=50, unique=false, nullable=true)
     */
    protected $direccion;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Telefono:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $telefono;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Email:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":30}})
     * @Annotation\Validator({"name":"EmailAddress"})
     * @ORM\Column(type="string", length=30, unique=false, nullable=true)
     */
    protected $email;

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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getDni() {
        return $this->dni;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getEmail() {
        return $this->email;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    function getDireccion() {
        return $this->direccion;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    
    public function __toString() {
        return $this->nombre . " " . $this->apellido;
    }

}
