<?php

namespace LRN\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PasoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('imagen','file',array('required'=>false))
            ->add('titulo')
            ->add('explicacion')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LRN\LRNProtectBundle\Entity\Paso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lrn_backendbundle_paso';
    }
}
