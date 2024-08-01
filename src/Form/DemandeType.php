<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Votre nom complet'
                ]
            ])
            ->add('Telephone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone'
                ]
            ])
            ->add('Email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Votre adresse email'
                ]
            ])
            ->add('Ville', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Votre ville en France'
                ]
            ])
            ->add('VilleAppartement', ChoiceType::class, [
                'label' => 'Ville de l\'appartement',
                'choices' => [
                    'Casablanca' => 'casablanca',
                    'Rabat' => 'rabat',
                    'Marrakech' => 'marrakech',
                    'Fès' => 'fes',
                    'Tangier' => 'tangier',
                    'Agadir' => 'agadir',
                    'Oujda' => 'oujda',
                    'Tétouan' => 'tetouan',
                    'Essaouira' => 'essaouira',
                    'El Jadida' => 'el_jadida',
                ],
                'placeholder' => 'Sélectionnez la ville de votre prochain appartement',
                'required' => true,
            ])
            ->add('Superficie', ChoiceType::class, [
                'label' => 'Superficie',
                'choices' => [
                    'Moins de 60 m²' => 'moins_60',
                    'Entre 60 m² et 80 m²' => '60_80',
                    'Entre 80 m² et 100 m²' => '80_100',
                    'Entre 100 m² et 120 m²' => '100_120',
                ],
                'placeholder' => 'Sélectionnez la superficie souhaitée',
                'required' => false, // Set to true if you want this field to be mandatory
            ])
            ->add('Chambres', ChoiceType::class, [
                'label' => 'Nombre de chambres',
                'choices' => [
                    '1 chambre' => 1,
                    '2 chambres' => 2,
                    '3 chambres' => 3,
                    '4 chambres' => 4,
                    '5 chambres ou plus' => 5,
                ],
                'placeholder' => 'Sélectionnez le nombre de chambres',
                'required' => false, // Set to true if you want this field to be mandatory
            ])
            ->add('SalleBain', ChoiceType::class, [
                'label' => 'Nombre de salles de bain',
                'choices' => [
                    '1 salle de bain' => 1,
                    '2 salles de bain' => 2,
                ],
                'placeholder' => 'Sélectionnez le nombre de salles de bain',
                'required' => false, // Set to true if you want this field to be mandatory
            ])
            ->add('Balcon')
            ->add('Terrasse')
            ->add('Ascenseur')
            ->add('Piscine')
            ->add('Parking')
            ->add('Garage')
            ->add('Prix', NumberType::class, [
                'label' => 'Prix',
                'attr' => [
                    'placeholder' => 'Veuillez nous indiquer votre buget'
                ]
            ])
            ->add('Message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Si vous avez autres informations ou des détails supplémentaires à nous communiquer qui ne sont pas indiqués dans le formulaire, hésitez pas à nous les faire savoir ici.
'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
