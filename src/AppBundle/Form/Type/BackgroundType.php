<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of BackgroundType
 *
 * @author grand coco
 */
class BackgroundType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('src');
        $builder->add('heureDate', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Background',
            
            'invalid_message_parameters' => array(),
            'extra_fields_message' => 'This form should not contain extra fields.',
            'csrf_protection' => false
        ]);
    }
    
}
