<?php
// src/Sdz/BlogBundle/Entity/Competence.php
 
namespace Sdz\BlogBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\CompetenceRepository")
 */
class Competence
{
  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
 
  /**
   * @var string $nom
   *
   * @ORM\Column(name="nom", type="string", length=255)
   */
  private $nom;
 
 
  /**
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }
 
  /**
   * @param string $nom
   * @return Competence
   */
  public function setNom($nom)
  {
    $this->nom = $nom;
    return $this;
  }
 
  /**
   * @return string 
   */
  public function getNom()
  {
    return $this->nom;
  }
}
