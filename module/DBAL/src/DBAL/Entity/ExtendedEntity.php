<?php

namespace DBAL\Entity;

use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Doctrine\ORM\Proxy\Proxy;
use Gedmo\Mapping\Annotation as Gedmo;
use Zend\InputFilter\InputFilter;
use Zend\Form\Annotation;
class ExtendedEntity extends \DBAL\Entity\BaseEntity {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="CdiUser\Entity\User")
   * @ORM\JoinColumn(name="creado_por_id", referencedColumnName="id")
     * @Annotation\Exclude()
     */
    protected $creadoPor;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="CdiUser\Entity\User")
       * @ORM\JoinColumn(name="actualizado_por_id", referencedColumnName="id")
     * @Annotation\Exclude()
     */
    protected $actualizadoPor;

    

    function getCreadoPor() {
        return $this->creadoPor;
    }

    function getActualizadoPor() {
        return $this->actualizadoPor;
    }

    function setCreadoPor($creadoPor) {
        $this->creadoPor = $creadoPor;
    }

    function setActualizadoPor($actualizadoPor) {
        $this->actualizadoPor = $actualizadoPor;
    }


}
