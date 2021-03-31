<?php

namespace App\Form;

use App\Entity\Centre;
use App\Entity\Client;
use App\Entity\Reclamation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_reclamation',TextType::class,['label' => 'Type', 'attr' => ['class'=>'input-text input-text--primary-style','style' => 'margin-bottom:15px']])
            ->add('objet_reclamation',TextType::class,['label' => 'Objet', 'attr' => ['class'=>'input-text input-text--primary-style','style' => 'margin-bottom:15px']])
            ->add('image_reclamation',FileType::class,['label' => 'Image', 'attr' => ['class'=>'btn','style' => 'margin-bottom:15px','value'=>'choisir image'],'data_class' => null])
            ->add('description_reclamation',TextType::class,['label' => 'Description', 'attr' => ['class'=>'input-text input-text--primary-style','style' => 'margin-bottom:15px']])
            ->add("Ajouter",SubmitType::class,['attr'=>['class'=>'btn btn-primary','style'=>'width:100%;margin-bottom:15px']])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
