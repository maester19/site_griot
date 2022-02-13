<?php

namespace App\Form;

use App\Entity\Chapitre;
use App\Entity\Storie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('storie', EntityType::class, [
                'class' => Storie::class,
                'choice_label' => 'titre',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'disabled' => true
                ]
            ])
            ->add('titre', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chapitre::class,
        ]);
    }
}