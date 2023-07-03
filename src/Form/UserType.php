<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Role\Role;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['placeholder' => 'john.doe', 'class' => 'form-control'],
            ])
            ->add('firstName', TextType::class, [
                'attr' => ['placeholder' => 'John', 'class' => 'form-control']
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['placeholder' => 'Doe', 'class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'john.doe@example.com', 'class' => 'form-control'],
//                'mapped' => false
            ])
            ->add('plainPassword', PasswordType::class, [
                'hash_property_path' => 'password',
                'mapped' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password', 'hash_property_path' => 'password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => ['Male' => 'Male', 'Female' => 'Female'],
                'attr' => ['placeholder' => 'Choose', 'class' => 'form-control'],
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => ['placeholder' => '0612-345-678', 'class' => 'form-control']
            ])
            ->add('employeeId', TextType::class, [
                'attr' => ['placeholder' => '1234', 'class' => 'form-control'],
//                'mapped' => false
            ])
            ->add('cardId', TextType::class, [
                'attr' => ['placeholder' => 'K987345', 'class' => 'form-control'],
//                'mapped' => false
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'attr' => ['class' => 'form-control'],
                'widget' => 'single_text',
                'empty_data' => null
            ])
            ->add('imageFile', VichImageType::class, [
                'attr' => ['class' => 'form-control'],
                'allow_delete' => false,
                'allow_file_upload' => false,
                'download_label' => false,
                'image_uri' => false
            ])
            ->add('field', EntityType::class, [
                'class' => 'App\Entity\Field',
                'placeholder' => 'Select'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_token_id' => 'user_csrfToken',
//            'validation_groups' => false
        ]);
    }
}
