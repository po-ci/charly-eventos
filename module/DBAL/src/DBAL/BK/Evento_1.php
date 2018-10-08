<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ec_evento")
 *
 * @author Cristian Incarnato
 */
class Evento extends \DBAL\Entity\ExtendedEntity {

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
     * @Annotation\Attributes({"type":"text","required" : true})
     * @Annotation\Options({"label":"Nombre Evento (Sin Espacios):"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":60}})
     * @Annotation\Validator({"name":"Alnum", "options":{"allow_white_space":false}})
     * @ORM\Column(type="string", length=60, unique=true, nullable=true)
     */
    protected $nombre;

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
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Flyer:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\LugarFlyer"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\LugarFlyer")
     * @ORM\JoinColumn(name="lugar_flyer_id", referencedColumnName="id")
     */
    protected $lugarFlyer;

    /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"Formato:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Formato"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Formato")
     * @ORM\JoinColumn(name="formato_id", referencedColumnName="id")
     */
    protected $formato;

    /**
     * @var \DateTime fechaVenta
     * @Annotation\Attributes({"type":"date",  "data-date-format": "YYYY/MM/DD","required" : true})
     * @Annotation\Options({"label":"Fecha:",  "format":"Y-m-d"})
     * @ORM\Column(type="datetime", name="fecha", nullable=true)
     */
    protected $fecha;
    
      /**
     * @var string
     * @Annotation\Attributes({"type":"text","required" : true})
     * @Annotation\Options({"label":"Horario:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":23}})
     * @ORM\Column(type="string", length=2, unique=false, nullable=true)
     */
    protected $horario;

    /**
       * @Annotation\Exclude()
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Contacto")
     * @ORM\JoinColumn(name="contacto_id", referencedColumnName="id")
     */
    protected $contacto;
    
     /**
     * @Annotation\Type("DoctrineModule\Form\Element\ObjectSelect")
     * @Annotation\Options({
     * "label":"RRPP:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Rrpp"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Rrpp")
     * @ORM\JoinColumn(name="rrpp_id", referencedColumnName="id")
     */
    protected $rrpp;

    /**
     * @Annotation\Exclude()
     * @ORM\ManyToMany(targetEntity="\DBAL\Entity\Contacto")
     * @ORM\JoinTable(name="\DBAL\Entity\Confirmado",
     *      joinColumns={@ORM\JoinColumn(name="evento_id", referencedColumnName="id" , onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="contacto_id", referencedColumnName="id" , onDelete="CASCADE")}
     *      )
     * */
    protected $confirmados;

    /**
     * @Annotation\Exclude()
     * @ORM\OneToMany(targetEntity="DBAL\Entity\Invitado", mappedBy="evento")
     */
    protected $invitados;

    public function __construct() {
        $this->confirmados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->invitados = new \Doctrine\Common\Collections\ArrayCollection();
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

    function getFecha() {
        return $this->fecha;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setFecha(\DateTime $fecha) {
        $this->fecha = $fecha;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getLugarFlyer() {
        return $this->lugarFlyer;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setLugarFlyer($lugarFlyer) {
        $this->lugarFlyer = $lugarFlyer;
    }

    function getFormato() {
        return $this->formato;
    }

    function setFormato($formato) {
        $this->formato = $formato;
    }

    function getContacto() {
        return $this->contacto;
    }

    function setContacto($contacto) {
        $this->contacto = $contacto;
    }

    function getConfirmados() {
        return $this->confirmados;
    }

    function setConfirmados($confirmados) {
        $this->confirmados = $confirmados;
    }

    function addConfirmados(\DBAL\Entity\Contacto $contacto) {
        $this->confirmados[] = $contacto;
    }

    function removeConfirmados(\DBAL\Entity\Contacto $contacto) {
        $this->confirmados->removeElement($contacto);
    }
    function getInvitados() {
        return $this->invitados;
    }

    function setInvitados($invitados) {
        $this->invitados = $invitados;
    }

    function addInvitados(\DBAL\Entity\Invitado $invitado){
         $this->invitados[] = $invitado;
    }

    function getRrpp() {
        return $this->rrpp;
    }

    function setRrpp($rrpp) {
        $this->rrpp = $rrpp;
    }

    function getHorario() {
        return $this->horario;
    }

    function setHorario($horario) {
        $this->horario = $horario;
    }

    public function __toString() {
        return $this->nombre;
    }



}
