<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 16/04/2015
 * Time: 19:57
 */

namespace LRN\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('temaRelacionado')
            ->add('pdf','file',array('required'=>false))
            ->add('imagen','file',array('required'=>false))
            ->add('nombre')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LRN\LRNProtectBundle\Entity\Documentos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lrn_backendbundle_documentos';
    }
}
