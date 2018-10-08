<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_cuotas")
 *
 * @author Cristian Incarnato
 */
class Cuota extends \DBAL\Entity\ExtendedEntity {

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
     * "label":"Marca y Modelo:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Venta"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Venta")
      * @ORM\JoinColumn(name="venta_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $venta;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Numero:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":999}})
     * @ORM\Column( type="integer", length=3, unique=false, nullable=true)
     */
    protected $numero;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Valor Total:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column(name="valor_total",type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $valorTotal;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Valor Total:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column(name="valor_cancelado",type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $valorCancelado;

    /**
     * @Annotation\Attributes({"type":"checkbox"})
     * @Annotation\Options({"label":"Activo:"})
     * @ORM\Column(type="boolean", unique=false, nullable=true, name="pagada")
     */
    protected $pagada;

    /**
     * @ORM\Column(type="datetime", unique=false, nullable=true, name="fecha_vencimiento")
     */
    protected $fechaVencimiento;

    /**
     * @ORM\Column(type="datetime", unique=false, nullable=true, name="fecha_pago")
     */
    protected $fechaPago;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getVenta() {
        return $this->venta;
    }

    function setVenta($venta) {
        $this->venta = $venta;
    }

    function getPagada() {
        return $this->pagada;
    }

    function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    function getFechaPago() {
        return $this->fechaPago;
    }

    function setPagada($pagada) {
        $this->pagada = $pagada;
    }

    function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    function setFechaPago($fechaPago) {
        $this->fechaPago = $fechaPago;
    }

    function getNumero() {
        return $this->numero;
    }

    function getValorTotal() {
        return $this->valorTotal;
    }

    function getValorCancelado() {
        return $this->valorCancelado;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    function setValorCancelado($valorCancelado) {
        $this->valorCancelado = $valorCancelado;
    }

    function getCliente() {
        return $this->cliente;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function __toString() {
        return $this->nombre;
    }

}
