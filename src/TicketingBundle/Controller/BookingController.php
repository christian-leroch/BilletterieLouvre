<?php

// src/TicketingBundle/Controller/BookingController.php

namespace TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;
use TicketingBundle\Entity\Booking;

class BookingController extends Controller
{
    /**
     * @Route("/booking")
     */
    public function indexAction()
    {
        $booking = new Booking();
        $booking->setDate(new \DateTime('now'));
        $booking->setTicketType(false);
        $booking->setNbTicket('1');

        $form = $this->createFormBuilder($booking)
            ->add('date',DateType::class , array(
                    'label' => '1 . Choisissez la date de votre visite',
                    'widget' => 'single_text',
                    'attr' => ['id' => ''])
            )
            ->add('ticketType', ChoiceType::class, array(
                    'label' => '2 . Choisissez votre horaire d\'accès au musée',
                    'choices' => array('Journée' => 'Journee', 'Demi-journée (accès au musée à partir de 14h00)' => 'Demi-journee'),
                    'expanded'  => true,
                    'multiple'  => false,)
            )
            ->add('nbTicket', IntegerType::class, array(
                    'label' => 'Nombre de billets ',
                    'data' => 1,
                    'attr' => array('min'=> 1, 'max' => 1000),)
            )
            ->getForm();

        return $this->render('booking/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}