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
                'attr' => ['placeholder' => 'john.doe']
            ])
            ->add('firstName', TextType::class, [
                'attr' => ['placeholder' => 'John']
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['placeholder' => 'Doe']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'john.doe@example.com']
            ])
            ->add('plainPassword', PasswordType::class, [
                'hash_property_path' => 'password',
                'mapped' => false
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password', 'hash_property_path' => 'password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => ['Male' => 'Male', 'Female' => 'Female'],
                'placeholder' => 'Choose'
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => ['placeholder' => '0612-345-678']
            ])
            ->add('employeeId', IntegerType::class, [
                'attr' => ['placeholder' => '1234']
            ])
            ->add('cardId', TextType::class, [
                'attr' => ['placeholder' => 'K987345']
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'widget' => 'single_text',
                'empty_data' => null
            ])
            ->add('imageFile', VichImageType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_token_id' => 'user_csrf'
        ]);
    }
}
