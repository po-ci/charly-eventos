<?php

/**
 *
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GestionController extends AbstractActionController {

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
        return $this->redirect()->toUrl('/user/login');
    }

    public function lugarAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Lugar');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('fotos');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid, "form" => $filtro);
    }

    public function rrppAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Rrpp');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('fotos');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid, "form" => $filtro);
    }

    public function flyerAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\LugarFlyer');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");

        $grid->addExtraColumn("Editar", "<a  class='btn btn-success fa fa-edit' onclick='showEditFlyer({{id}})' target='_blank' ></a>      ", "left", false);
        $grid->addExtraColumn("Imagen", "<image src='{{imagen}}' style='width:100px; height:100px' />", "left", false);



        $grid->prepare();
        return array('grid' => $grid, "form" => $filtro);
    }

    public function flyerUpAction() {
        /*
         * Recibo la informacion por GET
         */
        $aGetData = $this->getRequest()->getQuery();
        $id = $aGetData['id'];

        /*
         * Verifico si me llega un ID por POST
         */
        if (!$id) {
            $aPostData = $this->getRequest()->getPost();
            $id = $aPostData['id'];
        }

        /*
         * En el caso de que este el ID, busco el registro en la DB
         * En el caso que ID este null, creo un nuevo objeto
         */
        if ($id) {
            $object = $this->getEntityManager()->getRepository('\DBAL\Entity\LugarFlyer')->find($id);
            $new = false;
        } else {
            $object = new \DBAL\Entity\LugarFlyer();
        }

        /*
         * Declar el Formulario
         * Defino el Hidratador de Doctrine
         * Hago el Bind entre el Formulario y el objeto
         */
        $form = new \Application\Form\LugarFlyer($this->getEntityManager());
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getEntityManager()));
        $form->bind($object);

        /*
         * Verifico el Post, valido formulario y persisto en caso positivo
         */
        if ($this->getRequest()->isPost()) {

            $data = array_merge_recursive(
                    $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
            );


            $form->setData($data);

            $form->setInputFilter($form->InputFilter());
            if ($form->isValid()) {

                if ($this->zfcUserAuthentication()->hasIdentity()) {
                    $user = $this->zfcUserAuthentication()->getIdentity();
                }

                if ($new) {
                    $object->setCreatedBy($user);
                    $object->setLastUpdatedBy($user);
                } else {
                    $object->setLastUpdatedBy($user);
                }

                $size = new \Zend\Validator\File\Size(array('max' => 50000000)); //minimum bytes filesize
                $imageResolution = new \Zend\Validator\File\ImageSize(100, 100, 1280, 1040);
                $extension = new \Zend\Validator\File\Extension(array('jpg', 'png'));
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setValidators(array($size, $extension, $imageResolution), $File['picture']);

                if (!$adapter->isValid()) {

                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach ($dataError as $key => $row) {
                        $error[] = $row;
                    }
                    $persist = false;
                    $form->setMessages(array('picture' => $error));
                } else {
                    $adapter->setDestination(BASEDIR . '/media/flyer/');
                    if ($adapter->receive($File['picture'])) {
                        $newfile = $adapter->getFileName(null, true);
                        $srcPicture = BASEDIR . '/media/flyer/' . $adapter->getFileName(null, false);
                        $webPicture = '/media/flyer/' . $adapter->getFileName(null, false);
                        $object->setImagen($webPicture);

                        $this->getEntityManager()->persist($object);
                        $this->getEntityManager()->flush();


                        $form->bind($object);

                        $persist = true;
                    }
                }
            } else {
                $persist = false;
            }
        }
        /*
         * Paso la variable persist a la view
         * Defino terminal true para no renderizar el layout (ajax)
         */
        $view = new ViewModel(array('form' => $form,
            'persist' => $persist, "picture" => $webPicture));
        $view->setTerminal(true);
        return $view;
    }

    public function fotosAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\LugarFotos');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");

        $grid->addExtraColumn("Editar", "<a  class='btn btn-success fa fa-edit' onclick='showEditFoto({{id}})' target='_blank' ></a>      ", "left", false);
        $grid->addExtraColumn("Imagen", "<image src='{{imagen}}' style='width:100px; height:100px' />", "left", false);



        $grid->prepare();
        return array('grid' => $grid, "form" => $filtro);
    }

    public function fotoUpAction() {
        /*
         * Recibo la informacion por GET
         */
        $aGetData = $this->getRequest()->getQuery();
        $id = $aGetData['id'];

        /*
         * Verifico si me llega un ID por POST
         */
        if (!$id) {
            $aPostData = $this->getRequest()->getPost();
            $id = $aPostData['id'];
        }

        /*
         * En el caso de que este el ID, busco el registro en la DB
         * En el caso que ID este null, creo un nuevo objeto
         */
        if ($id) {
            $object = $this->getEntityManager()->getRepository('\DBAL\Entity\LugarFotos')->find($id);
            $new = false;
        } else {
            $object = new \DBAL\Entity\LugarFotos();
        }

        /*
         * Declar el Formulario
         * Defino el Hidratador de Doctrine
         * Hago el Bind entre el Formulario y el objeto
         */
        $form = new \Application\Form\LugarFoto($this->getEntityManager());
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getEntityManager()));
        $form->bind($object);

        /*
         * Verifico el Post, valido formulario y persisto en caso positivo
         */
        if ($this->getRequest()->isPost()) {

            $data = array_merge_recursive(
                    $this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray()
            );

           // var_dump($this->getRequest()->getFiles()->toArray());
            $form->setData($data);

            $form->setInputFilter($form->InputFilter());
            if ($form->isValid()) {

                if ($this->zfcUserAuthentication()->hasIdentity()) {
                    $user = $this->zfcUserAuthentication()->getIdentity();
                }

                if ($new) {
                    $object->setCreatedBy($user);
                    $object->setLastUpdatedBy($user);
                } else {
                    $object->setLastUpdatedBy($user);
                }

                $size = new \Zend\Validator\File\Size(array('max' => 50000000)); //minimum bytes filesize
                $imageResolution = new \Zend\Validator\File\ImageSize(100, 100, 1280, 1040);
                $extension = new \Zend\Validator\File\Extension(array('jpg', 'png'));
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setValidators(array($size, $extension, $imageResolution), $File['picture']);

                if (!$adapter->isValid()) {

                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach ($dataError as $key => $row) {
                        $error[] = $row;
                    }
                    $persist = false;
                    $form->setMessages(array('picture' => $error));
                } else {
                    $adapter->setDestination(BASEDIR . '/media/fotos/');
                    if ($adapter->receive($File['picture'])) {
                        $newfile = $adapter->getFileName(null, true);
                        $srcPicture = BASEDIR . '/media/fotos/' . $adapter->getFileName(null, false);
                        $webPicture = '/media/fotos/' . $adapter->getFileName(null, false);
                        $object->setImagen($webPicture);

                        $this->getEntityManager()->persist($object);
                        $this->getEntityManager()->flush();


                        $form->bind($object);

                        $persist = true;
                    }
                }
            } else {
                $persist = false;
            }
        }
        /*
         * Paso la variable persist a la view
         * Defino terminal true para no renderizar el layout (ajax)
         */
        $view = new ViewModel(array('form' => $form,
            'persist' => $persist, "picture" => $webPicture));
        $view->setTerminal(true);
        return $view;
    }

    public function eventoAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Evento');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('confirmados');
        $grid->hiddenColumn('contacto');
        $grid->hiddenColumn('invitados');
        $grid->hiddenColumn('actualizadoPor');
        $grid->datetimeColumn('fecha', "Y-m-d");
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");

        $grid->addExtraColumn("Invitados", "<a class='btn btn-primary fa fa-users' href='/gestion/invitados/{{id}}' target='_blank'></a>", "left", false);
        $grid->addExtraColumn("Confirmados", "<a class='btn btn-danger fa fa-check' href='/gestion/confirmados/{{id}}' target='_blank'></a>", "left", false);
        $grid->addExtraColumn("LINK Confirmar", "<a  href='https://palermonights.com/confirmar-evento/{{nombre}}' target='_blank'>https://palermonights.com/confirmar-evento/{{nombre}}</a>", "left", false);
        $grid->addExtraColumn("LINK Invitados", "<a  href='https://palermonights.com/eventos/{{nombre}}' target='_blank'>https://palermonights.com/eventos/{{nombre}}</a>", "left", false);


        $grid->prepare();
        return array('grid' => $grid, "form" => $filtro);
    }

    public function invitadosAction() {
        $id = $this->params("id");
        $evento = $this->getEntityManager()->getRepository('DBAL\Entity\Evento')->find($id);
        return array('evento' => $evento);
    }

    public function formatoAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Formato');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        //      $grid->longlongTextColumn("html", $length = 15);
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);

        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid);
    }

    public function invitadosGridAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }
        $grid = $this->getServiceLocator()->get('cdiGrid');
        $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Invitado');
        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        //      $grid->longlongTextColumn("html", $length = 15);
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);
//        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
//        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
//        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid);
    }

    public function confirmadosAction() {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $user = $this->zfcUserAuthentication()->getIdentity();
        }

        $grid = $this->getServiceLocator()->get('cdiGrid');
        if ($idEvento = $this->params("id")) {
            $query = $this->getEntityManager()
                    ->createQueryBuilder('u')
                    ->select('u')
                    ->from('\DBAL\Entity\Contacto', 'u')
                    ->leftJoin("DBAL\Entity\Confirmado", "c", "WITH", "u.id = c.contacto")
                    ->where('c.evento = :id')
                    ->setParameter("id", $idEvento);
            $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Contacto', $query);
            $evento = $this->getEntityManager()->getRepository('DBAL\Entity\Evento')->find($idEvento);
        } else {
            $source = new \CdiDataGrid\DataGrid\Source\Doctrine($this->getEntityManager(), '\DBAL\Entity\Contacto');
            $evento = false;
        }



        $grid->setUser($user);
        $grid->setSource($source);
        $grid->setRecordPerPage(30);
        $grid->hiddenColumn('fechaCreacion');
        $grid->hiddenColumn('fechaActualizacion');
        $grid->hiddenColumn('creadoPor');
        $grid->hiddenColumn('actualizadoPor');
        $grid->datetimeColumn('birthdate', "Y-m-d");
        //      $grid->longlongTextColumn("html", $length = 15);
        $grid->setTableClass("customClass");
//        $grid->setColumnFilter(false);
//        $grid->setColumnOrder(false);
//        $grid->addEditOption("Edit", "left", "btn btn-success fa fa-edit");
//        $grid->addDelOption("Del", "left", "btn btn-warning fa fa-trash");
//        $grid->addNewOption("Add", "btn btn-primary fa fa-plus", " Agregar");


        $grid->prepare();
        return array('grid' => $grid,"evento" => $evento);
    }

}
