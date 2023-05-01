<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 10:44
 */

namespace LRN\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstadisticasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoria')
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
            'data_class' => 'LRN\LRNProtectBundle\Entity\Estadisticas'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lrn_backendbundle_conceptos';
    }
}
