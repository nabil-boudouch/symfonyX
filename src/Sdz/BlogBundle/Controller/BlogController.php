<?php
 
// src/Sdz/BlogBundle/Controller/BlogController.php
 
namespace Sdz\BlogBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sdz\BlogBundle\Entity\Article;
use Sdz\BlogBundle\Form\ArticleType;
use Sdz\BlogBundle\Form\ArticleEditType;
 

class BlogController extends Controller
{
  public function indexAction($page)
  {
    $articles = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('SdzBlogBundle:Article')
                     ->getArticles(3, $page); // 3 articles par page : c'est totalement arbitraire !
 
    // On ajoute ici les variables page et nb_page � la vue
    return $this->render('SdzBlogBundle:Blog:index.html.twig', array(
      'articles'   => $articles,
      'page'       => $page,
      'nombrePage' => ceil(count($articles)/3)
    ));
  }
 
public function voirAction(Article $article)
  {
    // � ce stade, la variable $article contient une instance de la classe Article
    // Avec l'id correspondant � l'id contenu dans la route !
 
    // On r�cup�re ensuite les articleCompetence pour l'article $article
    // On doit le faire � la main pour l'instant, car la relation est unidirectionnelle
    // C'est-�-dire que $article->getArticleCompetences() n'existe pas !
    $listeArticleCompetence = $this->getDoctrine()
                                   ->getManager()
                                   ->getRepository('SdzBlogBundle:ArticleCompetence')
                                   ->findByArticle($article->getId());
 
    return $this->render('SdzBlogBundle:Blog:voir.html.twig', array(
      'article'                 => $article,
      'listeArticleCompetence'  => $listeArticleCompetence
    ));
  }
 
  public function ajouterAction()
  {
    $article = new Article();
 
    // On cr�e le formulaire gr�ce � l'ArticleType
    $form = $this->createForm(new ArticleType(), $article);
 
    // On r�cup�re la requ�te
    $request = $this->getRequest();
 
    // On v�rifie qu'elle est de type POST
    if ($request->getMethod() == 'POST') {
      // On fait le lien Requ�te <-> Formulaire
      $form->bind($request);
 
      // On v�rifie que les valeurs entr�es sont correctes
      // (Nous verrons la validation des objets en d�tail dans le prochain chapitre)
      if ($form->isValid()) {
        // On enregistre notre objet $article dans la base de donn�es
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
 
        // On d�finit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien ajout�');
 
        // On redirige vers la page de visualisation de l'article nouvellement cr��
        return $this->redirect($this->generateUrl('sdzblog_voir', array('id' => $article->getId())));
      }
    }
 
    // � ce stade :
    // - Soit la requ�te est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requ�te est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau
 
    return $this->render('SdzBlogBundle:Blog:ajouter.html.twig', array(
      'form' => $form->createView(),
    ));
  }
 
 public function modifierAction(Article $article)
  {
    // On utiliser le ArticleEditType
    $form = $this->createForm(new ArticleEditType(), $article);
 
    $request = $this->getRequest();
 
    if ($request->getMethod() == 'POST') {
      $form->bind($request);
 
      if ($form->isValid()) {
        // On enregistre l'article
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
 
        // On d�finit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien modifi�');
 
        return $this->redirect($this->generateUrl('sdzblog_voir', array('id' => $article->getId())));
      }
    }
 
    return $this->render('SdzBlogBundle:Blog:modifier.html.twig', array(
      'form'    => $form->createView(),
      'article' => $article
    ));
  }
 
 public function supprimerAction(Article $article)
  {
    // On cr�e un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de prot�ger la suppression d'article contre cette faille
    $form = $this->createFormBuilder()->getForm();
 
    $request = $this->getRequest();
    if ($request->getMethod() == 'POST') {
      $form->bind($request);
 
      if ($form->isValid()) {
        // On supprime l'article
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();
 
        // On d�finit un message flash
        $this->get('session')->getFlashBag()->add('info', 'Article bien supprim�');
 
        // Puis on redirige vers l'accueil
        return $this->redirect($this->generateUrl('sdzblog_accueil'));
      }
    }
 
    // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('SdzBlogBundle:Blog:supprimer.html.twig', array(
      'article' => $article,
      'form'    => $form->createView()
    ));
  }
 
  public function menuAction($nombre)
  {
    $liste = $this->getDoctrine()
                  ->getManager()
                  ->getRepository('SdzBlogBundle:Article')
                  ->findBy(
                    array(),          // Pas de crit�re
                    array('date' => 'desc'), // On trie par date d�croissante
                    $nombre,         // On s�lectionne $nombre articles
                    0                // � partir du premier
                  );
 
    return $this->render('SdzBlogBundle:Blog:menu.html.twig', array(
      'liste_articles' => $liste // C'est ici tout l'int�r�t : le contr�leur passe les variables n�cessaires au template !
    ));
  }
}