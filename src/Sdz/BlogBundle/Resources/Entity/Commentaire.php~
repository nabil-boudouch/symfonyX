<?php
// src/Sdz/Blog/Bundle/Entity/Commentaire.php
 
namespace Sdz\BlogBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\CommentaireRepository")
 */
class Commentaire
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
 
  /**
   * @ORM\Column(name="auteur", type="string", length=255)
   */
  private $auteur;
 
  /**
   * @ORM\Column(name="contenu", type="text")
   */
  private $contenu;
 
  /**
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;
 
  /**
   * @ORM\ManyToOne(targetEntity="Sdz\BlogBundle\Entity\Article", inversedBy="commentaires")
   * @ORM\JoinColumn(nullable=false)
   */
  private $article;
 
  public function __construct()
  {
    $this->date = new \Datetime();
  }
 
  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }
 
  /**
   * @param string $auteur
   * @return Commentaire
   */
  public function setAuteur($auteur)
  {
    $this->auteur = $auteur;
    return $this;
  }
 
  /**
   * @return string
   */
  public function getAuteur()
  {
    return $this->auteur;
  }
 
  /**
   * @param text $contenu
   * @return Commentaire
   */
  public function setContenu($contenu)
  {
    $this->contenu = $contenu;
    return $this;
  }
 
  /**
   * @return text
   */
  public function getContenu()
  {
    return $this->contenu;
  }
 
  /**
   * @param datetime $date
   * @return Commentaire
   */
  public function setDate(\Datetime $date)
  {
    $this->date = $date;
    return $this;
  }
 
  /**
   * @return datetime
   */
  public function getDate()
  {
    return $this->date;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Article $article
   * @return Commentaire
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
}
