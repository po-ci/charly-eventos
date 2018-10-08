<?php

namespace DBAL\Entity;

use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Proxy\Proxy;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\InputFilter\InputFilter;
use Zend\Form\Annotation;
class BaseEntity extends \DBAL\Entity\AbstractEntity {

    /**
     * @var \DateTime createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="fecha_creacion")
     * @Annotation\Exclude()
     */
    protected $fechaCreacion;

    /**
     * @var \DateTime updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="fecha_actualizacion", nullable=true)
     * @Annotation\Exclude()
     */
    protected $fechaActualizacion;

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    function setFechaCreacion(\DateTime $fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setFechaActualizacion(\DateTime $fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    
    public function getId() {
        return $this->id;
    }

}
