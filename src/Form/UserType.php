<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    private $security;

    public function __construct(SecurityBundleSecurity $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('number', PhoneNumberType::class, ['default_region' => PhoneNumberUtil::UNKNOWN_REGION, 'format' => PhoneNumberFormat::INTERNATIONAL, 'required' => false])
            ->add('username')
            ->add('password', PasswordType::class, [
                'required' => false, 
                'empty_data' => '',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Keep it empty if you wish to keep your actual password.',  
                ],
                'constraints' => [
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),],
            ])
            ->add('profilePicture', FileType::class, [
                'label' => 'Photo de profil (JPG, PNG)', 
                'mapped' => false,
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
