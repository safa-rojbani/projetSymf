<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères.',
                ]),
            ],
        ])
            ->add('adresse',TextType::class)
            ->add('identifiant',TextType::class)
            ->add('tel',IntegerType::class)
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email(),
                    new NotBlank(),
                    
                ],
            ])
            ->add('password', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Le mot de passe doit contenir au moins une lettre majuscule.',
                    ]),
                    
                ],
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
