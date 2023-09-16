<?php
/*
  ./src/Controller/PageController.php
*/
namespace App\Controller;
use Ieps\Core\GenericController;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\Request;

/**
* Contrôleur des pages
*
* @author Bruno Grisafi <b.grisafi.pro@gmail.com>
* @copyright 1997-2005 The PHP Group
* @version 1.0.1
*
*/
class PageController extends GenericController {

    /**
    * Action show des pages
    *
    * Affiche une page dans la vue show.html.twig
    *
    * @param int $id id de la page actuelle
    * @param Request Objet de type Request
    * @return Response objet de type Response
    */

    public function showAction(int $id, Request $request){
      $page = $this->_repository->find($id);
      return $this->render('pages/show.html.twig',[
        'page'   => $page
      ]);
    }



    /**
    * Action index des pages
    *
    * Affiche une liste de pages dans la vue index.html.twig
    *
    * @param int $currentId Id de la page actuelle
    * @return Response objet de type Response
    * @access public
    */
    public function indexAction(int $currentId = null){
      $pages = $this->_repository->findAll();
      return $this->render('pages/index.html.twig',[
        'pages' => $pages,
        'currentId' => $currentId
      ]);
    }

}
