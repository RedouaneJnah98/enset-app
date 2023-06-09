<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('semester', TextType::class)
            ->add('year', DateType::class)
            ->add('roomNo', TextType::class)
            ->add('field', EntityType::class, [
                'class' => 'App\Entity\Field',
                'placeholder' => 'Select'
            ])
            ->add('course', EntityType::class, [
                'class' => 'App\Entity\Course',
                'placeholder' => 'Select'
            ])
            ->add('professor', EntityType::class, [
                'class' => 'App\Entity\User',
                'placeholder' => 'Choose',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
