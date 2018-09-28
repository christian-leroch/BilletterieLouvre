<?php

// src/TicketingBundle/Controller/BookingController.php

namespace TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use TicketingBundle\Entity\Booking;
use TicketingBundle\Form\BookingType;

class BookingController extends Controller
{
    /**
     * Matches /booking exactly
     *
     * @Route("/booking", name="booking_index"))
     */
    public function indexAction(Request $request)
    {
        $booking = new Booking();
        $booking->setTicketDate(new \DateTime('now'));
        $booking->setTicketType(false);
        $booking->setNbTickets('1');

        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$booking` variable has also been updated
            $booking = $form->getData();

            // ... perform some action, such as saving the booking to the database
            // for example, if Booking is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->render('booking/details.html.twig');
        }

        return $this->render('booking/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * * Matches /details exactly
     *
     * @Route("/details", name="booking_details"))
     */
    public function detailsAction()
    {
        return $this->render('booking/details.html.twig');
    }
}