<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchPokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textSearch',TextType::class,[
                "label" => "Recherche textuelle",
                'required' => false
            ])
            ->add('typeSearch',EntityType::class,[
'class'=> Type::class,
'multiple'=>true,
'label' => "Recherche par type",
'required' => false

            ])
            ->add('pvMin',NumberType::class,[
                "label" => "Point de vie minimum",
                'required' => false
                                           ])
       ->add('attaqueMin',NumberType::class,[
        "label" => "Point d\'attaque minimum",
        'required' => false

                                           ])
                   ->add('defenseMin',NumberType::class,[
                    "label" => "Point de défense minimum",
                    'required' => false

                                           ])
                                           ->add('pvMax',NumberType::class,[
                                            "label" => "Point de vie maximum",
                                            'required' => false

                                            ])
        ->add('attaqueMax',NumberType::class,[
            "label" => "Point d\'attaque maximum",
            'required' => false

                                            ])
                    ->add('defenseMax',NumberType::class,[
                        "label" => "Point de défense maximum",
                        'required' => false

                                            ])
->add("submit",SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
