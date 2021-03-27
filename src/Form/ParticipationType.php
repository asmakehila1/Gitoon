<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Repository\EvenementRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
            ->add('client')
            ->add('evenement', EntityType::class, [
            'class' => Evenement::class,
            'query_builder' => function (EvenementRepository $er) {
                return $er->createQueryBuilder('u')
                    ->where('u.date_debut <= :date')
                    ->andWhere('u.date_fin >= :date')
                    ->setParameter(":date" , (new \DateTime())->format("Y-m-d"));
            },
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
