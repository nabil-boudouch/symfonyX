<?php

// src/Sdz/BlogBundle/Form/ArticleType.php

namespace Sdz\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('date', 'date')
                ->add('titre', 'text')
                ->add('contenu', 'textarea')
                ->add('auteur', 'text')
                ->add('image', new ImageType())
                /*
                 * Rappel :
                 * * - 1er argument : nom du champ, ici � categories � car c'est le nom de l'attribut
                 * * - 2e argument : type du champ, ici � collection � qui est une liste de quelque chose
                 * * - 3e argument : tableau d'options du champ
                 */
                /* ->add('categories',  'collection', array('type'         => new CategorieType(),
                  'allow_add'    => true,
                  'allow_delete' => true)) */
                ->add('categories', 'entity', array(
                    'class' => 'SdzBlogBundle:Categorie',
                    'property' => 'nom',
                    'multiple' => true,
                    'expanded' => false
                ))
        ;

        // On r�cup�re la factory (usine)
        $factory = $builder->getFormFactory();

        // On ajoute une fonction qui va �couter l'�v�nement PRE_SET_DATA
        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, // Ici, on d�finit l'�v�nement qui nous int�resse
                function(FormEvent $event) use ($factory) { // Ici, on d�finit une fonction qui sera ex�cut�e lors de l'�v�nement
                    $article = $event->getData();
                    // Cette condition est importante, on en reparle plus loin
                    if (null === $article) {
                        return; // On sort de la fonction lorsque $article vaut null
                    }
                    // Si l'article n'est pas encore publi�, on ajoute le champ publication
                    if (false === $article->getPublication()) {
                        $event->getForm()->add(
                                $factory->createNamed('publication', 'checkbox', null, array('required' => false))
                        );
                    } else { // Sinon, on le supprime
                        $event->getForm()->remove('publication');
                    }
                }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Sdz\BlogBundle\Entity\Article'
        ));
    }

    public function getName() {
        return 'sdz_blogbundle_articletype';
    }

}