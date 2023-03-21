<?php

namespace App\Form;

use App\Entity\XmlFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Validator\Constraints\File;

class FileUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('XmlFile', FileType::class, [
                'label' => 'Télécharger le fichier XML',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => ['text/xml', 'application/xml'],
                    'mimeTypesMessage' => "This document isn't valid.",
                    ])
                ],
                'data_class' => null               
            ])
            ->add('send', SubmitType::class)
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => XmlFile::class,
        ]);
    }
}
