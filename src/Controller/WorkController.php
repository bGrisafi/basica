<?php
/*
  ./src/Controller/WorkController.php
*/
namespace App\Controller;
use Ieps\Core\GenericController;
use App\Entity\Work;
use Symfony\Component\HttpFoundation\Request;

/**
* Contrôleur des works
*
* @author Bruno Grisafi <b.grisafi.pro@gmail.com>
* @copyright 1997-2005 The PHP Group
* @version 1.0.1
*
*/
class WorkController extends GenericController {


    /**
    * Action show des works
    *
    * Affiche une work dans la vue show.html.twig
    *
    * @param int $id id du work à afficher
    * @param Request Objet de type Request
    * @return Response objet de type Response
    */

    public function showAction(int $id, Request $request){
      $work = $this->_repository->find($id);
      return $this->render('works/show.html.twig',[
        'work'   => $work
      ]);
    }



    /**
    * Action index des works
    *
    * Affiche une liste de works dans une vue
    *
    * @param string $vue nom de la vue
    * @param array[] $orderBy détermine l'ordre des works pour l'affichage
    * @param int $limit limite le nombre de works à afficher
    * @return Response objet de type Response
    * @access public
    */

    public function indexAction(string $vue = 'index', array $orderBy = ['dateCreation' => 'DESC'] ,int $limit = null){
       $works = $this->_repository->findBy([], $orderBy, $limit);
       return $this->render('works/'.$vue.'.html.twig',[
         'works' => $works
       ]);
    }

    /**
    * Action similar des works
    *
    * Affiche une liste de works similaire au work actuel dans une vue
    *
    * @param string $vue nom de la vue
    * @param mixed[] $tags tableau contentant les objets tag
    * @param int $limit limite le nombre de works à afficher
    * @return Response objet de type Response
    * @access public
    */
    public function similarAction(string $vue = '_similar', $tags ,int $limit = null){
      $works = $this->_repository->findAllByTag($tags, $limit);
      return $this->render('works/'.$vue.'.html.twig',[
        'works' => $works
      ]);
    }

    /**
    * Action more des works
    *
    * Affiche une liste de works dans une vue, les ajoutant a ceux déjà présents à l'affichage (ajax)
    *
    * @param string $vue nom de la vue
    * @param array[] $orderBy détermine l'ordre des works pour l'affichage
    * @param int $limit limite le nombre de works à afficher
    * @param int $offset offset à appliquer lors que la requète SQL
    * @return Response objet de type Response
    * @access public
    */

    public function moreAction(string $vue = '_liste', array $orderBy = ['dateCreation' => 'DESC'] ,int $limit = null,$offset = 0, Request $request){
      $limit = $request->query->get('limit');
      $offset = $request->query->get('offset');
      $works = $this->_repository->findBy([], $orderBy, $limit, $offset);
      if (empty($works)) {
        return $this->render('works/noMore.html.twig');
      }
      return $this->render('works/'.$vue.'.html.twig',[
        'works' => $works
      ]);
    }
}
