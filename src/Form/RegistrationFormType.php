<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            
            ->add('number', PhoneNumberType::class, ['default_region' => 'FR', 'format' => PhoneNumberFormat::NATIONAL, 'required' => false]);

            // ->get('number')
            //     ->addModelTransformer(new CallbackTransformer (
            //         function ($number): ?string {
                        
            //         },
            //         function ($number):  {
                        
            //         }
            //     ))
        ;
    } 

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}



// namespace App\Form;

// use App\Entity\User;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
// use Symfony\Component\Form\Extension\Core\Type\PasswordType;
// use libphonenumber\PhoneNumberFormat;
// use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Validator\Constraints\IsTrue;
// use Symfony\Component\Validator\Constraints\Length;
// use Symfony\Component\Validator\Constraints\NotBlank;

// class RegistrationFormType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('email')
//             ->add('username')
//             ->add('agreeTerms', CheckboxType::class, [
//                 'mapped' => false,
//                 'constraints' => [
//                     new IsTrue([
//                         'message' => 'You should agree to our terms.',
//                     ]),
//                 ],
//             ])
//             ->add('plainPassword', PasswordType::class, [
//                 // instead of being set onto the object directly,
//                 // this is read and encoded in the controller
//                 'mapped' => false,
//                 'attr' => ['autocomplete' => 'new-password'],
//                 'constraints' => [
//                     new NotBlank([
//                         'message' => 'Please enter a password',
//                     ]),
//                     new Length([
//                         'min' => 6,
//                         'minMessage' => 'Your password should be at least {{ limit }} characters',
//                         // max length allowed by Symfony for security reasons
//                         'max' => 4096,
//                     ]),
//                 ],
//             ])
            
//             ->add('number', PhoneNumberType::class, ['default_region' => 'FR', 'format' => PhoneNumberFormat::NATIONAL, 'required' => false]) ;
//     } 

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => User::class,
//         ]);
//     }
// }