<?php

namespace App\Form;

use App\Entity\Department;
use App\Entity\Field;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Electrical Engineering']
            ])
            ->add('status', ChoiceType::class, [
                'choices' => ['Accredited' => 'accredited', 'In Process of Accreditation' => 'in process', 'Pending' => 'pending']
            ])
            ->add('type', ChoiceType::class, [
                'choices' => ['Initial Training' => 'initial training', 'Continuing Training' => 'continuing training'],
                'placeholder' => 'Select'
            ])
            ->add('degree', ChoiceType::class, [
                'choices' => ['University License' => 'University License', 'University Masters' => 'University Masters'],
                'placeholder' => 'Select'
            ])
            ->add('department', EntityType::class, [
                'class' => Department::class,
                'placeholder' => 'Select'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Field::class,
        ]);
    }
}
