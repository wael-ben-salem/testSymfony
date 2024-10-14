<?php

namespace App\Form;

use App\Entity\Vol;
use App\Entity\Aeroport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Correct Import
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('villeDestination', TextType::class, [
                'label' => 'Ville de Destination',
            ])
            ->add('dateDeDepart', DateTimeType::class, [ // Updated Field Name
                'widget' => 'single_text',
                'label' => 'Date de Départ',
            ])
            ->add('dateDArrivee', DateTimeType::class, [ // Updated Field Name
                'widget' => 'single_text',
                'label' => 'Date d\'Arrivée',
            ])
            ->add('aeroport', EntityType::class, [
                'class' => Aeroport::class,
                'choice_label' => 'nom', // Adjust based on Aeroport entity
                'label' => 'Aéroport',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer Vol',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
