<?php

/**
 *
 */

namespace Front\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FronteraController extends AbstractActionController {

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

    public function confirmarEventoAction() {
        $nombre = $this->params('nombre');

        $evento = $this->getEntityManager()->getRepository('\DBAL\Entity\Evento')->findOneBy(array("nombre" => $nombre));


        if ($nombre && $evento) {
            $fb = new \Facebook\Facebook([
                'app_id' => '1501329223445004',
                'app_secret' => 'fd76de4b5f965f4cb627bddacef05093',
                'default_graph_version' => 'v2.5',
            ]);


            $helper = $fb->getRedirectLoginHelper();

            $code = $this->getRequest()->getQuery('code');

            if ($code == null) {

                $permissions = ['email', 'user_birthday']; // optional
                $loginUrl = $helper->getLoginUrl('https://palermonights.com/confirmar-evento/' . $nombre, $permissions);
            } else {
                try {
                    $accessToken = $helper->getAccessToken();
                } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }

                if (isset($accessToken)) {
                    $_SESSION['facebook_access_token'] = (string) $accessToken;
// Now you can redirect to another page and use the
// access token from $_SESSION['facebook_access_token']


                    $fb->setDefaultAccessToken($accessToken);
                    try {
                  
                        $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday', $accessToken, ['fields' => 'id,name,email,first_name,last_name']);
                        $userNode = $response->getGraphUser();
                    } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                        echo 'Graph returned an error: ' . $e->getMessage();
                        exit;
                    } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                        exit;
                    }

                    if (!$evento->getContacto()) {
                        $contacto = $this->saveContacto($userNode);

                        $evento->setContacto($contacto);
                        $this->getEntityManager()->persist($evento);
                        $this->getEntityManager()->flush();

                        return $this->redirect()->toRoute('confirmar-evento', array('controller' => "Application\Controller\Frontera",
                                    'action' => "e",
                                    'nombre' => $evento->getNombre()));
                    } else {

                        return $this->redirect()->toRoute('confirmar-evento', array('controller' => "Application\Controller\Frontera",
                                    'action' => "e",
                                    'nombre' => $evento->getNombre()));
                    }
                }
            }

            $logout = $this->getRequest()->getQuery('logout');
            if ($logout == "yes") {
                unset($_SESSION['facebook_access_token']);
            }


            if ($evento->getContacto()) {
                //verifico si el login actual de facebook es el cumpleañero
                if ($_SESSION['facebook_access_token'] != null) {
                    // echo $_SESSION['facebook_access_token'];
                    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
                    try {
                           $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday', $accessToken, ['fields' => 'id,name,email,first_name,last_name']);
                    
                        $userNode = $response->getGraphUser();
                    } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                        echo 'Graph returned an error: ' . $e->getMessage();
                        exit;
                    } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                        exit;
                    }


                    if ($userNode->getEmail() == $evento->getContacto()->getEmail()) {
                        $formInvitado = new \Front\Form\Invitado();
                        $formInvitado->get('evento')->setValue($evento->getId());
                    } else {
                        $formInvitado = null;
                    }
                } else {
                    $formInvitado = null;
                }
            }



            return array('evento' => $evento, 'loginUrl' => $loginUrl, "formInvitado" => $formInvitado);
        } else {
            return "error";
        }
    }

    public function eventosAction() {


        $nombre = $this->params('nombre');
        $evento = $this->getEntityManager()->getRepository('\DBAL\Entity\Evento')->findOneBy(array("nombre" => $nombre));




        if ($nombre && $evento) {
            $fb = new \Facebook\Facebook([
                'app_id' => '1501329223445004',
                'app_secret' => 'fd76de4b5f965f4cb627bddacef05093',
                'default_graph_version' => 'v2.5',
            ]);


            $helper = $fb->getRedirectLoginHelper();

            $code = $this->getRequest()->getQuery('code');
            $modo = $this->getRequest()->getQuery('modo');

            if ($code == null) {

                $permissions = ['email', 'user_birthday']; // optional

                $formTipo = new \Front\Form\Tipo($this->getEntityManager());

                if ($this->getRequest()->isPost()) {
                    $aPostData = $this->getRequest()->getPost();
                    $formTipo->setData($aPostData);

                    $formTipo->setInputFilter($formTipo->InputFilter());
                    if ($formTipo->isValid()) {
                        $loginUrl = $helper->getLoginUrl('https://palermonights.com/eventos/' . $nombre . '?modo=' . $aPostData["modo"], $permissions);

                        return $this->redirect()->toUrl($loginUrl);
                    } else {
                        //echo "Form No Valid";
                    }
                }
            } else {

                try {
                    $accessToken = $helper->getAccessToken();
                } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;
                } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                    exit;
                }

                if (isset($accessToken)) {
                    $_SESSION['facebook_access_token'] = (string) $accessToken;
// Now you can redirect to another page and use the
// access token from $_SESSION['facebook_access_token']


                    $fb->setDefaultAccessToken($accessToken);
                    try {
                          $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday', $accessToken, ['fields' => 'id,name,email,first_name,last_name']);
                          $userNode = $response->getGraphUser();
              
                          
                    } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                        echo 'Graph returned an error: ' . $e->getMessage();
                        exit;
                    } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                        echo 'Facebook SDK returned an error: ' . $e->getMessage();
                        exit;
                    }

                    $contacto = $this->saveContacto($userNode);
                    if ($contacto != $evento->getContacto()) {

//                    Verifico si el contacto ya esta en el evento
                        $query = $this->getEntityManager()
                                ->createQueryBuilder('u')
                                ->select('u')
                                ->from('\DBAL\Entity\Confirmado', 'u')
                                ->where("u.contacto= :contacto")
                                ->andWhere("u.evento= :evento")
                                ->setParameter("contacto", $contacto)
                                ->setParameter("evento", $evento);
                        $confirmado = $query->getQuery()->getOneOrNullResult();


                        if (!$confirmado) {

                            $oModo = $this->getEntityManager()->getRepository('\DBAL\Entity\Modo')->find($modo);
                            $confirmado = new \DBAL\Entity\Confirmado();
                            $confirmado->setContacto($contacto);
                            $confirmado->setModo($oModo);
                            $evento->addConfirmados($confirmado);
                            $this->getEntityManager()->persist($confirmado);
                            $this->getEntityManager()->persist($evento);
                            $this->getEntityManager()->flush();

                            return $this->redirect()->toRoute('eventos', array('controller' => "Application\Controller\Frontera",
                                        'action' => "e",
                                        'nombre' => $evento->getNombre()));
                        } else {
                            $oModo = $this->getEntityManager()->getRepository('\DBAL\Entity\Modo')->find($modo);
                            $confirmado->setModo($oModo);
                            $this->getEntityManager()->persist($confirmado);
                            $this->getEntityManager()->flush();
                            return $this->redirect()->toRoute('eventos', array('controller' => "Application\Controller\Frontera",
                                        'action' => "e",
                                        'nombre' => $evento->getNombre()));
                        }
                    } else {
                        return $this->redirect()->toRoute('eventos', array('controller' => "Application\Controller\Frontera",
                                    'action' => "e",
                                    'nombre' => $evento->getNombre()));
                    }
                }
            }

            if (count($evento->getConfirmados())) {
                foreach ($evento->getConfirmados() as $confirmado) {
                    $tipos[$confirmado->getModo()->getNombre()] ++;
                }
            }


            return array('evento' => $evento, 'loginUrl' => $loginUrl, "formInvitado" => $formInvitado, "formTipo" => $formTipo, "tipos" => $tipos);
        } else {
            return "ERROR";
        }
    }

    public function delInvitadoAction() {

        $aPostData = $this->getRequest()->getPost();
        $id = $aPostData['id'];
        $object = $this->getEntityManager()->getRepository('DBAL\Entity\Invitado')->find($id);

        if ($id) {
            $this->getEntityManager()->remove($object);
            $this->getEntityManager()->flush();
            $result = true;
        } else {
            $result = false;
        }

        $view = new ViewModel(array('result' => $result));
        $view->setTerminal(true);
        return $view;
    }

    public function invitadoAction() {


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
            $object = $this->getEntityManager()->getRepository('DBAL\Entity\Invitado')->find($id);
            $new = false;
        } else {
            $object = new \DBAL\Entity\Invitado();
            $new = true;
        }

        /*
         * Declar el Formulario
         * Defino el Hidratador de Doctrine
         * Hago el Bind entre el Formulario y el objeto
         */
        $form = new \Front\Form\Invitado();
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getEntityManager()));
        $form->bind($object);

        /*
         * Verifico el Post, valido formulario y persisto en caso positivo
         */
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            $form->setInputFilter($form->InputFilter());
            if ($form->isValid()) {



                $this->getEntityManager()->persist($object);
                $this->getEntityManager()->flush();
                $form->bind($object);
                $persist = true;
            } else {
                var_dump($form->getMessages());
                $persist = false;
            }
        }

        /*
         * Paso la variable persist a la view
         * Defino terminal true para no renderizar el layout (ajax)
         */
        $view = new ViewModel(array('form' => $form,
            'persist' => $persist, 'object' => $object));
        $view->setTerminal(true);
        return $view;
    }

    protected function testAction() {
        $fb = new \Facebook\Facebook([
            'app_id' => '1501329223445004',
            'app_secret' => 'fd76de4b5f965f4cb627bddacef05093',
            'default_graph_version' => 'v2.5',
        ]);

        $_SESSION['facebook_access_token'];

        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
            var_dump($userNode);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }

    protected function saveContacto($userNode) {

        $contact = $this->getEntityManager()->getRepository('\DBAL\Entity\Contacto')->findOneBy(array("facebookId" => $userNode->getId()));

        if (!$contact) {
            $contact = new \DBAL\Entity\Contacto();
        }
        try {

            $contact->setEmail($userNode->getEmail());
            $contact->setName($userNode->getFirstName());
            $contact->setLastname($userNode->getLastName());
            $contact->setFullname($userNode->getName());

            $contact->setFacebookId($userNode->getId());
            $contact->setFacebookUrl($userNode->getLink());
        } catch (Exception $ex) {
            
        }


        try {
            $birthday = $userNode->getBirthday();
        } catch (Exception $ex) {
            
        }

        $meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre',
            '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        );

        if ($birthday) {
            $contact->setBirthdate($birthday);


            $month = $birthday->format("m");
            $day = $birthday->format("d");
            $birthdayText = $day . " de " . $meses[$month];
            $birthdayNum = $month . $day;

            $year = $birthday->format("Y");



            $nowDateTime = new \DateTime("now");

            $interval = $nowDateTime->diff($birthday);
            $age = $interval->format("%y");

            $contact->setBirthdayNum($birthdayNum);
            $contact->setBirthdayText($birthdayText);
            if ($age) {
                $contact->setAge($age);
            }
        }


        try {
            if ($userNode->getLocation()) {

                $locationId = $userNode->getLocation()->getId();
                $locationName = $userNode->getLocation()->getName();
            }
        } catch (Exception $ex) {
            
        }

        if ($locationName) {
            $contact->setFacebookLocationId($locationId);
            $contact->setFacebookLocationName($locationName);

            $explodeLocation = explode(",", $locationName);

            if (count($explodeLocation) == 4) {
                $facebookNeighborhood = $explodeLocation[0];
                $facebookCity = $explodeLocation[1];
                $facebookProvince = $explodeLocation[2];
                $facebookCountry = $explodeLocation[3];
            }


            if (count($explodeLocation) == 3) {
                $facebookNeighborhood = $explodeLocation[0];
                $facebookCity = $explodeLocation[0];
                $facebookProvince = $explodeLocation[1];
                $facebookCountry = $explodeLocation[2];
            }

            if (count($explodeLocation) == 2) {
                $facebookNeighborhood = $explodeLocation[0];
                $facebookCity = $explodeLocation[0];
                $facebookProvince = $explodeLocation[1];
                $facebookCountry = $explodeLocation[1];
            }

            if (count($explodeLocation) == 1) {
                $facebookNeighborhood = $explodeLocation[0];
                $facebookCity = $explodeLocation[0];
                $facebookProvince = $explodeLocation[0];
            }

            if (preg_match("/argentina/i", $locationName)) {
                $facebookProvince = null;
                $facebookCountry = "Argentina";
            }

            if (preg_match("/Buenos\sAires/i", $locationName)) {
                $facebookCountry = "Argentina";
                $facebookProvince = "Buenos Aires";
            }

            if (preg_match("/nuñez|recoleta|palermo|caballito|flores|retiro|puerto madero|san telmo|belgrano|villa crespo|san cristobal|la boca|villa luro|la boca|parque patricios|velez sarfield|villa deboto|villa soldati|abasto|almagro|barracas|chacarita|colegiales|liniers|monserrat|parque avallaneda|nueva pompeya|paternal|san nicolas|versalles|                  villa ortuzar|villa urquiza|agronomia|balvanera|barrio norte|boedo|constitucion|Coghlan|floresta|mataderos|monte castro|parque chacabuco|saavedra|villa crespo|villa lugano|villa pueyrredon|villa santa rita|villa del parque/i", $locationName, $match)) {
                $facebookNeighborhood = $match;
                $facebookCity = "Ciudad Autónoma de Buenos Aires";
                $facebookCountry = "Argentina";
                $facebookProvince = "Buenos Aires";
            }


            if (preg_match("/Ciudad.*\sde\sBuenos\sAires/i", $locationName)) {
                $facebookCity = "Ciudad Autónoma de Buenos Aires";
                $facebookProvince = "Buenos Aires";
                $facebookCountry = "Argentina";
            }


            if (preg_match("/distrito\sfederal/i", $locationName) && $facebookCountry == "Argentina") {
                $facebookCity = "Ciudad Autónoma de Buenos Aires";
                $facebookProvince = "Buenos Aires";
            }

            $contact->setFacebookCountry($facebookCountry);
            $contact->setFacebookProvince($facebookProvince);
            $contact->setFacebookCity($facebookCity);
            $contact->setFacebookNeighborhood($facebookNeighborhood);
        }

        $this->getEntityManager()->persist($contact);
        $this->getEntityManager()->flush();


        return $contact;
    }

    public function privacyPolicyAction() {
        
    }

    public function consultaAction() {

        $object = new \DBAL\Entity\Consulta();

        /*
         * Declar el Formulario
         * Defino el Hidratador de Doctrine
         * Hago el Bind entre el Formulario y el objeto
         */
        $form = new \Front\Form\Consulta();
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getEntityManager()));
        $form->bind($object);

        $idEvento = $this->params("id");
        if ($idEvento) {
            $form->get("evento")->setValue($idEvento);
        }

        /*
         * Verifico el Post, valido formulario y persisto en caso positivo
         */
        $post = false;
        if ($this->getRequest()->isPost()) {
            $post = true;
            $form->setData($this->getRequest()->getPost());

            $form->setInputFilter($form->InputFilter());
            if ($form->isValid()) {



                $this->getEntityManager()->persist($object);
                $this->getEntityManager()->flush();
                $form->bind($object);
                $persist = true;

                $mailService = $this->getServiceLocator()->get('acmailer.mailservice.default');
                $mailService->setSubject("Consulta por evento: " . $object->getEvento()->getNombre())
                        ->setTemplate('front/email/consulta', array(
                            'object' => $object));

                $message = $mailService->getMessage();
                $message->addTo('info@charlyruez.com', "Charly Ruez");
                $message->addTo('cristian.cdi@gmail.com', "Cristian Incarnato");
                $message->setReplyTo($object->getEmail(), $object->getNombre());
                $result = $mailService->send();
                if ($result->isValid()) {
                    // echo 'Message sent. Congratulations!';
                } else {
                    if ($result->hasException()) {
                        echo sprintf('An error occurred. Exception: \n %s', $result->getException()->getTraceAsString());
                    } else {
                        echo sprintf('An error occurred. Message: %s', $result->getMessage());
                    }
                }
            } else {
                var_dump($form->getMessages());
                $persist = false;
            }
        }

        /*
         * Paso la variable persist a la view
         * Defino terminal true para no renderizar el layout (ajax)
         */
        $view = new ViewModel(array('form' => $form,
            'persist' => $persist, 'object' => $object, "post" => $post));
        $view->setTerminal(true);
        return $view;
    }

    public function faceLogoutAction() {
        $fb = new \Facebook\Facebook([
            'app_id' => '1501329223445004',
            'app_secret' => 'fd76de4b5f965f4cb627bddacef05093',
            'default_graph_version' => 'v2.5',
        ]);
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);


        unset($_SESSION['facebook_access_token']);
        echo 'Logout ';
    }

    public function faceAction() {
        $fb = new \Facebook\Facebook([
            'app_id' => '1501329223445004',
            'app_secret' => 'fd76de4b5f965f4cb627bddacef05093',
            'default_graph_version' => 'v2.5',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (isset($accessToken)) {
// Logged in!
            $_SESSION['facebook_access_token'] = (string) $accessToken;

// Now you can redirect to another page and use the
// access token from $_SESSION['facebook_access_token']

            try {
                $response = $fb->get('/me');
                $userNode = $response->getGraphUser();
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            echo 'Logged in as ' . $userNode->getName();
        }
    }

}
