<?php

namespace LRN\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titular')
            ->add('foto','file',array('required'=>false))
            ->add('texto','textarea')
            ->add('nombreAutor')
            ->add('fechaArticulo')
            ->add('categoria')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LRN\LRNProtectBundle\Entity\Noticias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lrn_backendbundle_noticias';
    }
}
