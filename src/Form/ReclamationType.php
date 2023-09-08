<?php

namespace App\Form;
// src/Form/ReclamationType.php

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

//            ->add('assistId', TextType::class, [
//                'label' => 'Assistant ID',
//                'attr' => ['class' => 'form-control']
//            ])
            ->add('dateRec', DateType::class, [
                'label' => 'Reclamation Date',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Subject',
                'attr' => ['class' => 'form-control']
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Content',
                'attr' => ['class' => 'form-control']
            ])
            ->add('etat', TextType::class, [
                'label' => 'Status',
                'attr' => ['class' => 'form-control']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
