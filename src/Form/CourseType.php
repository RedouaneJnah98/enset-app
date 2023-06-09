<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Department;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Algorithmic and Programming']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Some text...', 'rows' => '8']
            ])
            ->add('totalSession', NumberType::class, [
                'attr' => ['placeholder' => '8']
            ])
            ->add('hours', NumberType::class, [
                'attr' => ['placeholder' => '32 hours']
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'placeholder' => 'choose'
            ])
            ->add('shortName', TextType::class, [
                'attr' => ['placeholder' => 'Java OOP']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
