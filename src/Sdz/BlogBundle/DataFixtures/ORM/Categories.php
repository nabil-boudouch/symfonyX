<?php
// src/Sdz/BlogBundle/DataFixtures/ORM/Categories.php
 
namespace Sdz\BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sdz\BlogBundle\Entity\Categorie;
 
class Categories implements FixtureInterface
{
  // Dans l'argument de la m�thode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de cat�gorie � ajouter
    $noms = array('Symfony2', 'Doctrine2', 'Tutoriel', 'Evenement');
 
    foreach($noms as $i => $nom)
    {
      // On cr�e la cat�gorie
      $liste_categories[$i] = new Categorie();
      $liste_categories[$i]->setNom($nom);
 
      // On la persiste
      $manager->persist($liste_categories[$i]);
    }
 
    // On d�clenche l'enregistrement
    $manager->flush();
  }
}