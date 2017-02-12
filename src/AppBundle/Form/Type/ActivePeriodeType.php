<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivePeriodeType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom');
        $builder->add('dateDebut', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                ->add('dateFin', \Symfony\Component\Form\Extension\Core\Type\DateTimeType::class)
                ->add('zone', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class,array("class"=>"AppBundle:Zone"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\ActivePeriodeZone',
            'csrf_protection' => false
        ]);
    }
}
