<?php

namespace App\Form;

use App\Entity\Classroom;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nsc', TextType::class)
          
            ->add('email', EmailType::class)
            ->add(
                'Clasrroom', EntityType::class,
                [
                    'class' => Classroom::class,
                    'choice_label' => 'name',
                    'expanded' => false, //on peut choisir une seule
                    'multiple' => false,

                ]
                
            )
            
            
            ->add('save',SubmitType::class);
          
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
