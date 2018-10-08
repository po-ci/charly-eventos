<?php

namespace DBAL\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="ctn_venta")
 *
 * @author Cristian Incarnato
 */
class Venta extends \DBAL\Entity\ExtendedEntity {

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
     * "label":"Cliente:",
     * "empty_option": "",
     * "target_class":"DBAL\Entity\Cliente"})
     * @ORM\ManyToOne(targetEntity="DBAL\Entity\Cliente")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    protected $cliente;

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
    protected $cantidad = 1;

    /**
     * @var integer
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Remito:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true)
     */
    protected $remito;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Valor Total:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column(name="valor_total", type="decimal", precision=19, scale=2, nullable=true)
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
     * @Annotation\Options({"label":"Cerrada:"})
     * @ORM\Column(type="boolean", unique=false, nullable=true, name="cerrada")
     */
    protected $cerrada;

    /**
     * @var string
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Cantidad de Cuotas:"})
     * @Annotation\Validator({"name":"Between", "options":{"min":0, "max":9999999}})
     * @ORM\Column( type="integer", length=11, unique=false, nullable=true,name="cantidad_cuotas")
     */
    protected $cantidadCuotas = 3;



    /**
     * @var \DateTime fechaVenta
     * @Annotation\Attributes({"type":"date"})
     * @Annotation\Options({"label":"Fecha Venta:"})
     * @ORM\Column(type="datetime", name="fecha_venta", nullable=true)
     */
    protected $fechaVenta;

    /**
     * @var string
     * @Annotation\Attributes({"type":"textarea"})
     * @Annotation\Options({"label":"Descripcion:"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":0, "max":300}})
     * @ORM\Column(name="observaciones",type="string", length=300, unique=false, nullable=true)
     */
    protected $observaciones;

    /**
     * @ORM\OneToMany(targetEntity="DBAL\Entity\Cuota", mappedBy="venta")
     * */
    private $cuotas;

    public function addCuota(\DBAL\Entity\Cuota $cuota){
        $this->cuotas[] = $cuota;
    }

    public function __construct() {
        $this->cuotas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getCantidadCuotas() {
        return $this->cantidadCuotas;
    }

    function setCantidadCuotas($cantidadCuotas) {
        $this->cantidadCuotas = $cantidadCuotas;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getVendedor() {
        return $this->vendedor;
    }

    function getValor() {
        return $this->valor;
    }

    function getCuotas() {
        return $this->cuotas;
    }

    function getFechaVenta() {
        return $this->fechaVenta;
    }

    function getItems() {
        return $this->items;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setVendedor($vendedor) {
        $this->vendedor = $vendedor;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setCuotas($cuotas) {
        $this->cuotas = $cuotas;
    }

    function setFechaVenta(\DateTime $fechaVenta) {
        $this->fechaVenta = $fechaVenta;
    }

    function setItems($items) {
        $this->items = $items;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
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

    function getValorTotal() {
        return $this->valorTotal;
    }



    function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }



    function getValorCancelado() {
        return $this->valorCancelado;
    }

    function setValorCancelado($valorCancelado) {
        $this->valorCancelado = $valorCancelado;
    }

    function getCerrada() {
        return $this->cerrada;
    }

    function setCerrada($cerrada) {
        $this->cerrada = $cerrada;
    }

    function getRemito() {
        return $this->remito;
    }

    function setRemito($remito) {
        $this->remito = $remito;
    }

    public function __toString() {
        return (string) "" . $this->id . " (" . $this->vendedor . ") [" . $this->cliente . "] {" . $this->producto . "}";
    }

}
