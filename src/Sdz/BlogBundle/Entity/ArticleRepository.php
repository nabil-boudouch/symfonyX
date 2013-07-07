<?php
// src/Sdz/BlogBundle/Entity/ArticleRepository.php
 
namespace Sdz\BlogBundle\Entity;
 
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
 
class ArticleRepository extends EntityRepository
{
  // On ajoute deux arguments : le nombre d'articles par page, ainsi que la page courante
  public function getArticles($nombreParPage, $page)
  {
    // On déplace la vérification du numéro de page dans cette méthode
    if ($page < 1) {
      throw new \InvalidArgumentException('L\'argument $page ne peut être inférieur à 1 (valeur : "'.$page.'").');
    }
 
    // La construction de la requête reste inchangée
    $query = $this->createQueryBuilder('a')
                  ->leftJoin('a.image', 'i')
                    ->addSelect('i')
                  ->leftJoin('a.categories', 'cat')
                    ->addSelect('cat')
                  ->orderBy('a.date', 'DESC')
                  ->getQuery();
 
    // On définit l'article à partir duquel commencer la liste
    $query->setFirstResult(($page-1) * $nombreParPage)
    // Ainsi que le nombre d'articles à afficher
          ->setMaxResults($nombreParPage);
 
    // Enfin, on retourne l'objet Paginator correspondant à la requête construite
    // (n'oubliez pas le use correspondant en début de fichier)
    return new Paginator($query);
  }
}
?>