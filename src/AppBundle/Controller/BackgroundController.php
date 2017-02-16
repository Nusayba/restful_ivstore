<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Background;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Form\Type\BackgroundType;

class BackgroundController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/backgrounds")
     */
    public function getBackgroundsAction(Request $request){
        $backgrounds = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Background')
                ->findAll();

        // Gestion de la réponse
        return array('backgrounds'=>$backgrounds);
    }
    
    /**
     * @Rest\View()
     * @Rest\Get("/backgrounds/{id}")
     */
    public function getBackgroundAction(Request $request)
    {
        $background = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Background')
                ->find($request->get('id'));
       
        if (empty($background)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Background not found'], Response::HTTP_NOT_FOUND);
        }

        return array('background'=>$background);
    }
    
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/backgrounds")
     */
    public function postBackgroundsAction(Request $request){
        $background = new Background();
        $form = $this->createForm(BackgroundType::class, $background);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($background);
            $em->flush();
            return "background ajouté";
        } else {
            return array('form'=>$form);
        }
    }
    
    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/backgrounds/{id}")
     */
    public function removeBackgroundAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $background = $em->getRepository('AppBundle:Background')
                    ->find($request->get('id'));
        
        if ($background) {
            $em->remove($background);
            $em->flush();
        }
    }
    
    /**
     * @Rest\View()
     * @Rest\Put("/backgrounds/{id}")
     */
    public function putBackgroundAction(Request $request)
    {
        $background = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Background')
                ->find($request->get('id'));

        if (empty($background)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Background not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(BackgroundType::class, $background);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->merge($background);
            $em->flush();
            return $background;
        } else {
            return $form;
        }
    }
    
    /**
     * @Rest\View()
     * @Rest\Patch("/backgrounds/{id}")
     */
    public function patchBackgroundsAction(Request $request)
    {
        $background = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Background')
                ->find($request->get('id')); 
        if (empty($background)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Background not found'], Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(BackgroundType::class,$background);
        
        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()), false);
           
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($background);
                $em->flush();
                return array("message"=>"test");
            }
        }
        return array("form"=>$form);
        
    }

}


