<?php

namespace App\Form;

use App\configurations\MedicalCartConfig;
use App\Entity\MedicalCart;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicalCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('surname',TextType::class)
            ->add('passport',TextType::class)
            ->add('job',TextType::class)
            ->add('policy',TextType::class)
            ->add('insurance_program',TextType::class)
            ->add('type', ChoiceType::class, [
                'choices'  => MedicalCartConfig::getCartType()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalCart::class,
        ]);
    }
}
