<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rang', TextType::class, [
                'label' => 'RANG:',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'form-control w30 my-2',]

            ])
            ->add('libelle', TextType::class, [
                'label' => 'LIBELLE :',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'form-control w30 my-2',]
            ])


            ->add('url', TextType::class, [
                'label' => 'URL :',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'form-control w70 my-2',]

            ])


            ->add('icon', TextType::class, [
                'label' => 'ICON :',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'form-control w30 my-2',]
            ])
            ->add('role', TextType::class, [
                'label' => 'ROLE :',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'form-control w30 my-2',]
            ])

            ->add('parent', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'libelle',
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class'=>'form-select w70 my-2',],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
