<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotNull;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                "required" => false
            ])
            ->add('description')
            ->add('attaque')
            ->add('defense')
            ->add('pointDeVie')
            ->add('picture', FileType::class,[
                'label' => 'photo',
                "mapped" => false,
                "required" => false,
                "constraints" => [
                    new NotNull([
                        "groups" => ["ajout"],
                        "message" => "veuillez saisir une photo"
                    ]),
                    new File ([
                        'maxSize' => '1024K',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez ajouter une image',
                        'maxSizeMessage' => 'Le fichier est trop volumineux'
                    ])
                ]
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
'choice_label' => 'libelle',
'multiple' => true,
"by_reference" => false
            ])
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
