<?php

namespace App\Form;

use App\Entity\Servant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name'/* , null, ['label'=>'Nom'] */)
            ->add('Class'/* , null, ['label' => 'Classe'] */,ChoiceType::class,[
                'choices' => $this->getChoices()/* array(
                'Archer' => 'Archer',
                'Assassin' => 'Assassin',
                'Berserker' => 'Berserker',
                'Caster' => 'Caster',
                'Lancer' => 'Lancer',
                'Rider' => 'Rider',
                'Saber' => 'Saber'
            )
            ]) */])
            ->add('Noble_Phantasme')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Servant::class,
            'translation_domain' => 'forms'
        ]);
    }
    private function getChoices()
    {
        $choice = array(
            0=>'Archer',
            1=>'Assassin',
            2=>'Berserker',
            3=>'Caster',
            4=>'Lancer',
            5=>'Rider',
            6=>'Saber'
        );
        $output = [];
        foreach ($choice as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
