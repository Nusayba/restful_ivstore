<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\ActivePeriodeZone;
use AppBundle\Entity\Zone;

class ZoneController extends Controller
{
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT, serializerGroups={"zone"})
     * @Rest\Delete("/zones/{id}")
     */
    public function removeZoneAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $zone = $em->getRepository('AppBundle:Zone')
                    ->find($request->get('id'));

        if (!$zone) {
            return;
        }

        foreach ($zone->getActivePeriodes() as $activePeriode) {
            $em->remove($activePeriode);
        }
        $em->remove($zone);
        $em->flush();
    }

}
