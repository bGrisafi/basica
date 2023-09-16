<?php
/*
  ./src/Controller/TagController.php
*/
namespace App\Controller;
use Ieps\Core\GenericController;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Request;

/**
* Contrôleur des tags
*
* @author Bruno Grisafi <b.grisafi.pro@gmail.com>
* @copyright 1997-2005 The PHP Group
* @version 1.0.1
*
*/
class TagController extends GenericController {

    /**
    * Action show des tags
    *
    * Affiche un tag dans la vue show.html.twig
    *
    * @param int $id id du tag à afficher
    * @param Request Objet de type Request
    * @return Response objet de type Response
    */
    public function showAction(int $id, Request $request){
      $tag = $this->_repository->find($id);
      return $this->render('tags/show.html.twig',[
        'tag'   => $tag
      ]);
    }



}
