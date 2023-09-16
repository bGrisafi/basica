<?php
/*
  ./src/Controller/CategorieController.php
*/
namespace App\Controller;
use Ieps\Core\GenericController;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;

/**
* Contrôleur des categories
*
* @author Bruno Grisafi <b.grisafi.pro@gmail.com>
* @copyright 1997-2005 The PHP Group
* @version 1.0.1
*
*/
class CategorieController extends GenericController {

    /**
    * Action show des categories
    *
    * Affiche une categorie dans la vue show.html.twig
    *
    * @param int $id id de la categorie à afficher
    * @param Request Objet de type Request
    * @return Response objet de type Response
    */
    public function showAction(int $id, Request $request){
      $categorie = $this->_repository->find($id);
      return $this->render('categories/show.html.twig',[
        'categorie'   => $categorie
      ]);
    }

    /**
    * Action index des categories
    *
    * Affiche une liste de categories dans une vue
    *
    * @param string $vue nom de la vue
    * @param int $limit limite le nombre de categories à afficher
    * @return Response objet de type Response
    * @access public
    */

    public function indexAction(string $vue = 'index',int $limit = null){
     $categories = $this->_repository->findBy([], null , $limit);
     return $this->render('categories/'.$vue.'.html.twig',[
       'categories' => $categories
     ]);
    }


}
