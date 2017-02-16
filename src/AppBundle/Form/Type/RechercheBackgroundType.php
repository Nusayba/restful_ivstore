<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of RechercheBackgroundTYPE
 *
 * @author Administrateur
 */
class RechercheBackgroundType extends AbstractType{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder->add("heureDate", \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => '\AppBundle\DTO\RechercheBackgroundDTO',
            
            'invalid_message_parameters' => array(),
            'extra_fields_message' => 'This form should not contain extra fields.',
            'csrf_protection' => false
        ]);
    }

}
