<?php

namespace App\Form;

use App\Entity\Master;
use App\Entity\Servant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MasterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('MagicType')
            ->add('Servant', EntityType::class, [
                'class' => Servant::class,
                'choice_label' => 'ClassName',
                'multiple' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Master::class,
            'translation_domain' => 'forms'
        ]);
    }
}
