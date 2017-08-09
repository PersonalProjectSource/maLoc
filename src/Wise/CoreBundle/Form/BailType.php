<?php

namespace Wise\CoreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('loyer')
            ->add('meuble')
            ->add('caution')
            ->add('dateDebut', DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime'
            ))
            ->add('dateBailEnded', DateTimeType::class, array(
                'widget' => 'single_text',
                'input' => 'datetime'
            ))
            ->add('type')
            ->add('actif');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wise\CoreBundle\Entity\Bail',
            'csrf_protection' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wise_corebundle_bail';
    }


}
