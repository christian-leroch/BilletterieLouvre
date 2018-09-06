<?php

// src/TicketingBundle/Controller/BookingController.php

namespace TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends Controller
{
    /**
     * @Route("/booking")
     */
    public function indexAction()
    {
        return $this->render('booking/index.html.twig');
    }
}