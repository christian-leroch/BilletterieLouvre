<?php
// src\TicketingBundle\Form\BookingType.php

namespace TicketingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use TicketingBundle\Entity\Booking;


class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ticketDate',DateType::class , array(
                    'label' => '1 . Choisissez la date de votre visite',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'html5' => false,
                    'attr' => ['class' => 'datepicker'])
            )
            ->add('ticketType', ChoiceType::class, array(
                'label' => '2 . Choisissez votre horaire d\'accès au musée',
                'choices' => array('Journée' => 'Journee', 'Demi-journée (accès au musée à partir de 14h00)' => 'Demi-journee'),
                'expanded'  => true,
                'multiple'  => false)
            )
            ->add('nbTickets', IntegerType::class, array(
                'label' => 'Nombre de billets ',
                'data' => 1,
                'attr' => array('min'=> 1, 'max' => 1000))
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,
        ));
    }
}