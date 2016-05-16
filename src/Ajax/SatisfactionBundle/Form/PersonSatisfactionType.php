<?php

namespace Ajax\SatisfactionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Ajax\SatisfactionBundle\Entity\PSHumorType;
use Ajax\SatisfactionBundle\Entity\PSEquilibriumType;

class PersonSatisfactionType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ynChoices      = array( 1 => 'Oui', 0 => 'Non' );

        $builder->add( 'month', 'hidden');

        $builder->add( 'year', 'hidden');

        $builder->add('psHumorType',            'entity',   array(  "class"         => "AjaxSatisfactionBundle:PSHumorType",
                                                                    "choice_label"  => function ( $psHumorType ) {
                                                                        return $psHumorType->getHumorName();
                                                                    },
                                                                    "query_builder" => function ( EntityRepository $er ) {
                                                                        return $er->createQueryBuilder('u')->orderBy('u.id', 'DESC');
                                                                    },
                                                                    "label"         => "Humeur",
                                                                    "data_class"    => "Ajax\SatisfactionBundle\Entity\PSHumorType",
                                                                    "required"      => TRUE, 
                                                                    "expanded"      => TRUE,
                                                                    "multiple"      => FALSE ));

        $builder->add( 'mainIrritant',          'text',     array( "required"  => FALSE,
                                                                   "label"     => "Quel est votre principal irritant ?" ));

        $builder->add('psEquilibriumType',      'entity',   array(  "class"         => "AjaxSatisfactionBundle:PSEquilibriumType",
                                                                    "choice_label"  => function ( $psEquilibriumType ) {
                                                                        return $psEquilibriumType->getEquilibriumName();
                                                                    },
                                                                    "query_builder" => function ( EntityRepository $er ) {
                                                                        return $er->createQueryBuilder('u')->orderBy('u.id', 'DESC');
                                                                    },
                                                                    "data_class"    => "Ajax\SatisfactionBundle\Entity\PSEquilibriumType",
                                                                    "required"      => TRUE, 
                                                                    "expanded"      => TRUE,
                                                                    "multiple"      => FALSE,
                                                                    "label"         => "Equilibre vie pro-perso" ));
        
        $builder->add( 'availabilityManager',   'choice',   array(  "choices"   => $ynChoices,
                                                                    "expanded"  => TRUE,
                                                                    "multiple"  => FALSE,
                                                                    "required"  => TRUE,
                                                                    "label"     => "Mon manager est-il suffisamment disponible ?" ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ajax\SatisfactionBundle\Entity\PersonSatisfaction'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'satisfaction_form';
    }
}
