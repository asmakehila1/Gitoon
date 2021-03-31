<?php

namespace App\Form;

use App\Entity\Materiels;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class MaterielsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom',  TextType::class ,[
                'required' => true
            ])
            ->add('prix', IntegerType::class, [
                'required' => true
            ] )
            ->add('dureeLocation', IntegerType::class, [
                'required' => true
            ] )
            ->add('quantite', IntegerType::class, [
                'required' => true
            ] )
            ->add('statu', null, [
                'required' => true
            ])
            ->add('photo', FileType::class,array('data_class' => null, 'required'=> false))

            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiels::class,
        ]);
    }
}
