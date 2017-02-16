<?php



namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Description of testController
 *
 * @author Administrateur
 */
class testController extends Controller{
    
    /**
     * 
     * @param \AppBundle\Controller\Request $request
     * 
     * @Route("/Backgrounds/{id}", name="get_background")
     * @Method("GET")
     */
    public function getBackgroundAction(Request $request)
    {
        
        $dto = new \AppBundle\DTO\RechercheBackgroundDTO();
        $form = $this->createForm(\AppBundle\Form\Type\RechercheBackgroundType::class, $dto);
        
        
        
        if ($request->isMethod('POST')) {
            
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->get('doctrine.orm.entity_manager')
                            ->getRepository('AppBundle:Background');
                $background= $em->find($request->get('heureDate'));
                
                if (empty($background)){
                    return array('message' => 'Background not found');
                }
                
                return 'test';
                
            }
        }

        return $this->render('background/getBackground.html.twig',array('form'=>$form->createView()));
        //return array('form'=>$form->createView());       
    }
}
