<?php
// src/Sdz/BlogBundle/Entity/ArticleCompetence.php
 
namespace Sdz\BlogBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 */
class ArticleCompetence
{
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Article")
   */
  private $article;
 
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Competence")
   */
  private $competence;
 
  /**
   * @ORM\Column()
   */
  private $niveau; // Ici j'ai un attribut de relation, que j'ai appelé « niveau »
 
  /**
   * @param string $niveau
   * @return Article_Competence
   */
  public function setNiveau($niveau)
  {
    $this->niveau = $niveau;
    return $this;
  }
 
  /**
   * @return string
   */
  public function getNiveau()
  {
    return $this->niveau;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Article $article
   * @return ArticleCompetence
   */
  public function setArticle(\Sdz\BlogBundle\Entity\Article $article)
  {
    $this->article = $article;
    return $this;
  }
 
  /**
   * @return Sdz\BlogBundle\Entity\Article
   */
  public function getArticle()
  {
    return $this->article;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Competence $competence
   * @return ArticleCompetence
   */
  public function setCompetence(\Sdz\BlogBundle\Entity\Competence $competence)
  {
    $this->competence = $competence;
    return $this;
  }
 
  /**
   * @return Sdz\BlogBundle\Entity\Competence
   */
  public function getCompetence()
  {
    return $this->competence;
  }
}
