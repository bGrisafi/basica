<?php
/*
  ./src/Controller/ArticleController.php
*/
namespace App\Controller;
use Ieps\Core\GenericController;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;

/**
* Contrôleur des articles
*
* @author Bruno Grisafi <b.grisafi.pro@gmail.com>
* @copyright 1997-2005 The PHP Group
* @version 1.0.1
*
*/
class ArticleController extends GenericController {

    /**
    * Action show des articles
    *
    * Affiche un article dans la vue show.html.twig
    *
    * @param int $id id de l'article à afficher
    * @param Request Objet de type Request
    * @return Response objet de type Response
    */
    public function showAction(int $id, Request $request){
      $article = $this->_repository->find($id);
      return $this->render('articles/show.html.twig',[
        'article'   => $article
      ]);
    }

    /**
    * Action index des articles
    *
    * Affiche une liste d' articles dans une vue
    *
    * @param string $vue nom de la vue
    * @param array[] $orderBy détermine l'ordre des articles pour l'affichage
    * @param int $limit limite le nombre de articles à afficher
    * @param int $col_sm_value valeur déterminant la taille et le nombre d'articles sur une ligne lors de l'affichage
    * @return Response objet de type Response
    * @access public
    */

    public function indexAction(string $vue = 'index', array $orderBy = ['dateCreation' => 'DESC'] ,int $limit = null, int $col_sm_value = 6){
     $articles = $this->_repository->findBy([], $orderBy, $limit);
     $nbArticles = $this->_repository->countArticles();
     return $this->render('articles/'.$vue.'.html.twig',[
       'articles' => $articles,
       'nbArticles' => $nbArticles,
       'col_sm_value' => $col_sm_value
     ]);
    }

    /**
    * Action page des articles
    *
    * Affiche une liste d' articles dans une vue, correspondant à la page actuelle dans la pagination
    *
    * @param string $vue nom de la vue
    * @param array[] $orderBy détermine l'ordre des articles pour l'affichage
    * @param int $limit limite le nombre de articles à afficher
    * @param Request Objet de type Request
    * @param int $col_sm_value valeur déterminant la taille et le nombre d'articles sur une ligne lors de l'affichage
    * @return Response objet de type Response
    * @access public
    */

    public function pageAction(string $vue = '_liste', array $orderBy = ['dateCreation' => 'DESC'] ,int $limit = null, Request $request, int $col_sm_value = 6){
      $limit = $request->query->get('limit');
      $offset = $request->query->get('offset');
      $articles = $this->_repository->findBy([], $orderBy, $limit,$offset);
      return $this->render('articles/'.$vue.'.html.twig',[
        'articles' => $articles,
        'col_sm_value' => $col_sm_value
      ]);
    }

    /**
    * Action indexByCategorie des articles
    *
    * Affiche une liste d' articles correspondant à une catégorie dans une vue
    *
    * @param string $vue nom de la vue
    * @param int $categorie id de la catégorie correspondante
    * @param int $col_sm_value valeur déterminant la taille et le nombre d'articles sur une ligne lors de l'affichage
    * @access public
    * @return Response objet de type Response
    */

    public function indexByCategorieAction(string $vue = '_liste',int $categorie, int $col_sm_value = 3){
     $articles = $this->_repository->findByCategorie($categorie);
     return $this->render('articles/'.$vue.'.html.twig',[
       'articles' => $articles,
       'col_sm_value' => $col_sm_value
     ]);
    }

    /**
    * Action TwitterRss des articles
    *
    * Récupère un flux RSS à partir d'un compte twitter public
    *
    * @param string $user Utilisateur dont on souhaite récupérer les tweets
    * @param int $limit nombre de tweets que l'on souhaite afficher
    * @access public
    * @return Response objet de type Response
    */

    public function twitterRssAction(string $user = "ppgarcia75",int $limit = 10){
      $feedIo = \FeedIo\Factory::create()->getFeedIo();
      $url = 'http://twitrss.me/twitter_user_to_rss/?user=' . $user;
      $feed ="";

      try {//gestion des erreurs sur le flux
        $feed = $feedIo->read($url)->getFeed();
      } catch (\Exception $e) {
        return $this->render('articles/_error.html.twig', ['erreur'=> $e]);
      }

      return $this->render('articles/_twitterRss.html.twig',[
        'rss' => $feed,
        'limit' => $limit
      ]);
    }


}
