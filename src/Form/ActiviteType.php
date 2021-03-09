<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Centre;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DescreptionActivite')
            ->add('PrixActivite')
            ->add('Centre', EntityType::class, [
                // looks for choices from this entity
                'class' => Centre::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom_centre',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
