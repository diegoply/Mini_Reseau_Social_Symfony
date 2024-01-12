<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add("title", TextType::class, ["label"=> "titre",
             "required" => false,
             "constraints" => new Length(["min" => 0, "max" => 150, "minMessage" => "Le titre doit faire entre 0 et 150 caractères", "maxMessage" => "Le contenue doit faire entre 0 et 150 caractères"]),
             ])
            ->add("content", TextareaType::class, ["label" => "Contenu", "required" => true,
            "constraints" => [
                new Length(["min" => 5, "max" => 320, "minMessage" => "Le contenue doit faire entre 5 et 320 caractères", "maxMessage" => "Le contenue doit faire entre 5 et 320 caractères"]),
                new NotBlank(["message" => "le contenue ne doit pas être vide !"])
            ],
            
        ])        
            ->add("image", UrlType::class, ["label" => "URL de l'image",
                "required" => false,
                "constraints" => [new Url(["message" => "L'image doit être une URL valide"])
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => Post::class
        ]);
    }

}