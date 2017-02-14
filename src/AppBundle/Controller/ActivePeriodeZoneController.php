<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\ActivePeriodeZone;
use AppBundle\Entity\Zone;
use AppBundle\Form\Type\ActivePeriodeType;

class ActivePeriodeZoneController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"activePeriodeZone"})
     * @Rest\Get("/zones/{id}/activePeriodes")
     */
    public function getActivePeriodesAction(Request $request)
    {
        $zone = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Zone')
                ->find($request->get('id')); 

        if (empty($zone)) {
            return $this->zoneNotFound();
        }

        return array("activePeriodes"=>$zone->getActivePeriodes());
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"activePeriodeZone"})
     * @Rest\Post("/Zones/{id}/activePeriodes")
     */
    public function postActivePeriodesAction(Request $request)
    {
        $zone = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Zone')
                ->findOneById($request->get('id'));

        if (empty($zone)) {
            return $this->zoneNotFound();
        }

        $activePeriode = new \AppBundle\Entity\ActivePeriodeZone();
        $activePeriode->setZone($zone); 
        $form = $this->createForm(ActivePeriodeType::class, $activePeriode);

        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($activePeriode);
                $em->flush();
                return array("activePeriode"=>$activePeriode);
            } else {
                return array("form"=>$form);
            }
        
    }
    
    private function zoneNotFound()
    {
        return \FOS\RestBundle\View\View::create(['message' => 'Zone not found'], Response::HTTP_NOT_FOUND);
    }

}
