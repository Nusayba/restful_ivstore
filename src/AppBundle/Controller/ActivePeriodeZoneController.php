<?php

namespace AppBundle\Controller\ActivePeriodeZone;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ActivePeriodeZoneController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/zones/{id}/activePeriodes")
     */
    public function getActivePeriodesAction()
    {
        
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/zones/{id}/activePeriodes")
     */
    public function postActivePeriodesAction()
    {
        return $this->render('AppBundle:ActivePeriodeZone:postActivePeriodes.html.twig', array(
            // ...
        ));
    }

}
