<?php

namespace App\Form;

use App\Entity\BienImmo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienImmoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Type')
            ->add('Prix')
            ->add('Ville')
            ->add('Superficie')
            ->add('Pieces')
            ->add('Annee', null, [
                'widget' => 'single_text',
            ])
            ->add('Equipements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BienImmo::class,
        ]);
    }
}
