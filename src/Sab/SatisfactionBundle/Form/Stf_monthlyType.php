<?php

namespace Sab\SatisfactionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Stf_monthlyType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('humor', 'entity', array(
                    'class' => 'SatisfactionBundle:Stf_humor',
                    'property' => 'label',
                    'expanded' => true,
                ))
                ->add('equilibrium', 'entity', array(
                    'class' => 'SatisfactionBundle:Stf_equilibrium',
                    'property' => 'label',
                ))
                ->add('irritant')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Sab\SatisfactionBundle\Entity\Stf_monthly'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'sab_satisfactionbundle_stf_monthly';
    }

}
