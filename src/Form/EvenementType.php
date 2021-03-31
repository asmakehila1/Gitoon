<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix_event',TextType::class,['label' => 'Prix Evenement', 'attr' => ['class'=>'input-text input-text--primary-style','style' => 'margin-bottom:15px']])
            ->add('descrption_event',TextType::class,['label' => 'Description Evenement', 'attr' => ['class'=>'input-text input-text--primary-style','style' => 'margin-bottom:15px']])
            ->add('photo_event',FileType::class, array('data_class' => null))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
