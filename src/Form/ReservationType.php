<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Evenement;
use App\Entity\Centre;
use App\Entity\Client;
use App\Entity\Materiels;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Client', EntityType::class, [
            // looks for choices from this entity
            'class' => Client::class,

            // uses the User.username property as the visible option string
            'choice_label' => 'nom',

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])
            ->add('Centre', EntityType::class, [
                // looks for choices from this entity
                'class' => Centre::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom_centre',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('Evenement', EntityType::class, [
                // looks for choices from this entity
                'class' => Evenement::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'descrption_event',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('Materiels', EntityType::class, [
                // looks for choices from this entity
                'class' => Materiels::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'Nom_mat',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
