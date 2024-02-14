<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numArticle', TextType::class, [
                'label' => "CODE",
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'w20 form-control my-2']
            ])
            ->add('designation', TextType::class, [
                'label' => "DESIGNATION",
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'w70 form-control my-2', 'placeholder' => "Saisir le nom de l'article"]
            ])
            ->add('prixUnitaire', TextType::class, [
                'label' => "PU",
                'label_attr' => ['class' => 'lab30'],
                'attr' => ['class' => 'w20 form-control my-2 right']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
