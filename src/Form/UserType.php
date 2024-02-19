<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PhpOffice\PhpSpreadsheet\Shared\PasswordHasher;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class,[
                'label' => 'username :',
                'label_attr' => [ 'class'=>'lab30'],
                'attr' => ['class' => 'form-control w30 my-2', 'autocomplete' => 'off']
            ])
            // ->add('roles')
            ->add('plainPassword',PasswordType::class,[
                'label' => 'Password :',
                'label_attr' => ['class'=> 'lab30'],
                'attr' => ['class'=> 'form-control w30 my-2', 'autocomplete' => 'off','placeholder'=>"ne pas saisir pour ne pas modifier"],
                'mapped' => false, // to block the autosave of symfony with persist and flush.
                'required' => false, 
                
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
