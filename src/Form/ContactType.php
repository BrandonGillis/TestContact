<?php

namespace App\Form;

use App\Entity\Department;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3])
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3])
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ]
            ])
            ->add('department', EntityType::class, [
                'label' => 'Département',
                'required' => true,
                'class' => Department::class,
                'choice_label' => 'name'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }
}
