<?php

namespace CarRentalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carBrand')
            ->add('carModel')
            ->add('year')
            ->add('capacity')
            ->add('doors')
            ->add('engine')
            ->add('gearbox')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('image',FileType::class,[ 'data_class' => null])
            ->add('price');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarRentalBundle\Entity\Car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'carrentalbundle_car';
    }


}
