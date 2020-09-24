<?php

namespace App\Forms;

use App\Entity\Arret;
use App\Entity\NomArret;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArretForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomArret', ChoiceType::class, [
                'choices' => [
                    'Clique ici pour choisir !' => '-1',
                    'J.F. Kennedy' => 'J.F. Kennedy',
                    'Italie' => 'Italie',
                    'Anatole France' => 'Anatole France',
                    'Charles de Gaulle' => 'Charles de Gaulle',
                    'Clemenceau' => 'Clemenceau',
                    'Gares' => 'Gares',
                    'Henri Fréville' => 'Henri Fréville',
                    'Jacques Cartier' => 'Jacques Cartier',
                    'La Poterie' => 'La Poterie',
                    'Le Blosne' => 'Le Blosne',
                    'Pontchaillou' => 'Pontchaillou',
                    'République' => 'République',
                    'Sainte-Anne' => 'Sainte-Anne',
                    'Triangle' => 'Triangle',
                    'Villejean-Université' => 'Villejean-Université'
                ],
                'required' => true,
                'label' => false
            ])
            ->add('destination', ChoiceType::class, [
                'choices' => [
                    'Clique ici pour choisir !' => '-1',
                    'J.F. Kennedy' => 'J.F. Kennedy',
                    'La Poterie' => 'La Poterie'
                ],
                'required' => true,
                'label' => false
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Arret::class,
            'method' => 'get',
            'csrf' => false
        ]);
    }
}