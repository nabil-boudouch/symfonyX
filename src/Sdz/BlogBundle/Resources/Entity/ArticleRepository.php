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
    // On d�place la v�rification du num�ro de page dans cette m�thode
    if ($page < 1) {
      throw new \InvalidArgumentException('L\'argument $page ne peut �tre inf�rieur � 1 (valeur : "'.$page.'").');
    }
 
    // La construction de la requ�te reste inchang�e
    $query = $this->createQueryBuilder('a')
                  ->leftJoin('a.image', 'i')
                    ->addSelect('i')
                  ->leftJoin('a.categories', 'cat')
                    ->addSelect('cat')
                  ->orderBy('a.date', 'DESC')
                  ->getQuery();
 
    // On d�finit l'article � partir duquel commencer la liste
    $query->setFirstResult(($page-1) * $nombreParPage)
    // Ainsi que le nombre d'articles � afficher
          ->setMaxResults($nombreParPage);
 
    // Enfin, on retourne l'objet Paginator correspondant � la requ�te construite
    // (n'oubliez pas le use correspondant en d�but de fichier)
    return new Paginator($query);
  }
}
?>