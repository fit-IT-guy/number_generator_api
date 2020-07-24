<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'id'                => 'email',
                    'class'             => 'form-control',
                    'placeholder'       => 'Enter Email',
                    'aria-describedby'  => 'emailHelp',
                ]
            ])
            ->add('password', RepeatedType::class, [            // создает дубликат поля ввода, чьи значения должны совпадать
                'type'              => PasswordType::class,                 // указываем тип этого поля
                'invalid_message'   => 'The password fields must match.',   // сообщение в случае не свопадения значений
                'required'          => true,
                'first_options'     => ['label' => 'Password'],
                'second_options'    => ['label' => 'Repeat Password'],
                'mapped'            => false,                               // не присваем значение объекту сразу, сделаем это в контроллере после его кодирования
                'constraints' => [                                          // правила валидации
                    new NotBlank([                                          // не может быть null
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        'max' => 4096,                                      // из соображений безопасности Symfony
                    ]),
                ],
                'options' => [
                    'attr' => [
                        'id'                => 'password',
                        'class'             => 'form-control',
                        'placeholder'       => 'Enter Password',
                        'aria-describedby'  => 'emailHelp',
                    ]
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}