<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('number', PhoneNumberType::class, ['default_region' => PhoneNumberUtil::UNKNOWN_REGION, 'format' => PhoneNumberFormat::INTERNATIONAL, 'required' => false])
            ->add('username')
            ->add('password', PasswordType::class, [
                'required' => false, 
                // 'empty_data' => '',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Garder vide si aucun changement.',  
                ],
                'constraints' => [
                new Length([
                    'min' => 6,
                    'minMessage' => 'Le mot de passe doit au moins faire {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),],
            ])

            ->add('profilePicture', FileType::class, [
                'label' => 'Photo de profil',
                'mapped' => false,
                'required' => false,
                // 'attr' => [ 'class' => 'form-control', 'accept' => 'image/*'],
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '1024k',
                //         'mimeTypes' => [
                //             'image/jpeg',
                //             'image/png',
                //             'image/gif',
                //         ],
                //         'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF)',
                //     ])
                // ],
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
