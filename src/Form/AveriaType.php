<?php

namespace App\Form;

use App\Entity\Averia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;

class AveriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha', DateType::class, [
               'widget' => 'single_text',
               'input'  => 'datetime_immutable'
            ])
            ->add('descripcion')
            ->add('poliza')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Averia::class,
        ]);
    }
}
