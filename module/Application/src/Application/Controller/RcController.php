<?php

/**
 *
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RcController extends AbstractActionController {

       /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }
    
    public function indexAction() {
          
    }
    
    public function tipificacionReiteradoAction() {
           $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\ReiteradoTipificacion');
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
//        $grid->datetimeColumn('createdAt', 'Y-m-d H:i:s');
//        $grid->datetimeColumn('updatedAt', 'Y-m-d H:i:s');
        $grid->hiddenColumn('createdAt');
        $grid->hiddenColumn('updatedAt');
        $grid->hiddenColumn('createdBy');
        $grid->hiddenColumn('lastUpdatedBy');
      
        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid);
    }

}
