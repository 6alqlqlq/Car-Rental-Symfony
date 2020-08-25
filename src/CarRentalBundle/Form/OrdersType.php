<?php

namespace CarRentalBundle\Form;

use CarRentalBundle\Entity\Order;
use CarRentalBundle\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pickupdate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Pick up date: ',
            ])
            ->add('returndate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Return  date: ',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
