<?php
// src/Sdz/BlogBundle/Entity/Article.php
 
namespace Sdz\BlogBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
 
/**
 * Sdz\BlogBundle\Entity\Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
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
   * @var datetime $date
   *
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;
 
  /**
   * @var string $titre
   *
   * @ORM\Column(name="titre", type="string", length=255)
   */
  private $titre;
 
  /**
   * @var string $titre
   *
   * @ORM\Column(name="auteur", type="string", length=255)
   */
  private $auteur;
 
  /**
   * @ORM\Column(name="publication", type="boolean")
   */
  private $publication;
 
  /**
   * @var text $contenu
   *
   * @ORM\Column(name="contenu", type="text")
   */
  private $contenu;
   
  /**
   * @ORM\Column(type="date", nullable=true)
   */
  private $dateEdition;
   
  /**
   * @Gedmo\Slug(fields={"titre"})
   * @ORM\Column(length=128, unique=true)
   */
  private $slug;
 
  /**
   * @ORM\OneToOne(targetEntity="Sdz\BlogBundle\Entity\Image", cascade={"persist", "remove"})
   */
  private $image;
 
  /**
   * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Categorie", cascade={"persist"})
   */
  private $categories;
 
  /**
   * @ORM\OneToMany(targetEntity="Sdz\BlogBundle\Entity\Commentaire", mappedBy="article")
   */
  private $commentaires; // Ici commentaires prend un « s », car un article a plusieurs commentaires !
 
 
  public function __construct()
  {
    $this->date     = new \Datetime;
    $this->publication  = true;
    $this->categories   = new \Doctrine\Common\Collections\ArrayCollection();
    $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
  }
   
  /**
   * @ORM\preUpdate
   * Callback pour mettre à jour la date d'édition à chaque modification de l'entité
   */
  public function updateDate()
  {
    $this->setDateEdition(new \Datetime());
  }
 
  /**
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }
 
  /**
   * @param datetime $date
   * @return Article
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
   * @param string $titre
   * @return Article
   */
  public function setTitre($titre)
  {
    $this->titre = $titre;
    return $this;
  }
 
  /**
   * @return string
   */
  public function getTitre()
  {
    return $this->titre;
  }
 
  /**
   * @param text $contenu
   * @return Article
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
   * @param boolean $publication
   * @return Article
   */
  public function setPublication($publication)
  {
    $this->publication = $publication;
    return $this;
  }
 
  /**
   * @return boolean
   */
  public function getPublication()
  {
    return $this->publication;
  }
 
  /**
   * @param string $auteur
   * @return Article
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
   * @param Sdz\BlogBundle\Entity\Image $image
   * @return Article
   */
  public function setImage(\Sdz\BlogBundle\Entity\Image $image = null)
  {
    $this->image = $image;
    return $this;
  }
 
  /**
   * @return Sdz\BlogBundle\Entity\Image
   */
  public function getImage()
  {
    return $this->image;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Categorie $categorie
   * @return Article
   */
  public function addCategorie(\Sdz\BlogBundle\Entity\Categorie $categorie)
  {
    $this->categories[] = $categorie;
    return $this;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Categorie $categorie
   */
  public function removeCategorie(\Sdz\BlogBundle\Entity\Categorie $categorie)
  {
    $this->categories->removeElement($categorie);
  }
 
  /**
   * @return Doctrine\Common\Collections\Collection
   */
  public function getCategories()
  {
    return $this->categories;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Commentaire $commentaire
   * @return Article
   */
  public function addCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaire)
  {
    $this->commentaires[] = $commentaire;
    return $this;
  }
 
  /**
   * @param Sdz\BlogBundle\Entity\Commentaire $commentaire
   */
  public function removeCommentaire(\Sdz\BlogBundle\Entity\Commentaire $commentaire)
  {
    $this->commentaires->removeElement($commentaire);
  }
 
  /**
   * @return Doctrine\Common\Collections\Collection
   */
  public function getCommentaires()
  {
    return $this->commentaires;
  }
 
  /**
   * @param datetime $dateEdition
   * @return Article
   */
  public function setDateEdition(\Datetime $dateEdition)
  {
    $this->dateEdition = $dateEdition;
    return $this;
  }
 
  /**
   * @return date 
   */
  public function getDateEdition()
  {
    return $this->dateEdition;
  }
 
  /**
   * @param string $slug
   * @return Article
   */

  public function setSlug($slug)
  {
    $this->slug = $slug;
    return $this;
  }
 
  /**
   * @return string 
   */
  public function getSlug()
  {
    return $this->slug;
  }

    /**
     * Add categories
     *
     * @param \Sdz\BlogBundle\Entity\Categorie $categories
     * @return Article
     */
    public function addCategory(\Sdz\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Sdz\BlogBundle\Entity\Categorie $categories
     */
    public function removeCategory(\Sdz\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }
}
