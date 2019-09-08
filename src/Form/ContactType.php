<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Department;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => true
            ])
            ->add('department', EntityType::class, [
                'label' => 'Département',
                'required' => true,
                'class' => Department::class,
                'choice_label' => 'name'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
