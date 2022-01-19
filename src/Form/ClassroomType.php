<?php

namespace App\Form;

use App\Entity\ClassRoom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class,  [ 'label'=> 'Class Name', 'attr' =>[
                'placeholder' => 'ClassName HERE',
                'class' => 'form-control'
            ]])
            ->add('Save', SubmitType::class , [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClassRoom::class,
        ]);
    }
}
