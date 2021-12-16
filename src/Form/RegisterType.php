<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,[
                'label' => 'Prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'John',
                    'class' => 'form_input',
                ],
            ])
            ->add('lastname',TextType::class,[
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30
                ]),
                'attr' => [
                    'placeholder' => 'Durant',
                    'class' => 'form_input',
                ],
            ])
            ->add('email',EmailType::class,[
                'label' => 'Email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 60]),
                'attr' =>[
                    'placeholder' => 'DurantJohn@mail.com',
                    'class' => 'form_input',
                ],
            ])
            ->add('gender', ChoiceType::class,
                [
                    'label'    => 'Genre',
                    'attr' => ['class' => 'form_input'],
                    'choices'  =>
                        [
                            'Homme' => 'Homme',
                            'Femme'  => 'Femme',
                        ],
                    'expanded' => true,
                    'multiple' => false
                ]
            )
            ->add('birthdate',BirthdayType::class,[
                'years' => range(date('Y'), date('Y') -100),
                'label' => 'Date de naissance'

            ])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'label' => 'Mot de passe',
                'required' => true,
                'first_options' => ['label' => "Mot de passe"],
                'second_options' => ['label' => "Confirmez votre mot de passe"],
                'attr' =>[
                    'class' => 'form_input',
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label' => "S'inscrire",
                'attr' =>[
                    'class' => 'form_validate',
                ]
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
