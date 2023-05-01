<?php

namespace LRN\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TutorialType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreRedSocial')
            ->add('descripcion')
            ->add('fechaPublicacion')
            ->add('pdf','file',array('required'=>false))
            ->add('imagen','file',array('required'=>false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LRN\LRNProtectBundle\Entity\Tutorial'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lrn_backendbundle_tutorial';
    }
}
