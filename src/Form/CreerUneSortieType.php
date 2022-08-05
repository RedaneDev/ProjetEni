<?php

namespace App\Form;

use App\Entity\Sortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Time;

class CreerUneSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('dateHeureDebut', DateTimeType::class, [
                'html5' => true,
            ])
            ->add('dateLimiteInscription', DateTimeType::class, [
                'html5' => true,
            ])
            ->add('nbInscriptionsMax')
            ->add('duree')


            ->add('infosSortie', TextareaType::class)

            ->add('campus', EntityType::class, [
                'class' => 'App\Entity\Campus',
                'choice_label' => 'nom',
                'required' => false,])

            ->add('lieu', EntityType::class, [
                'class' => 'App\Entity\Lieu',
                'choice_label' => 'nom',
                'required' => false,])
            //Todo longitude et latitude
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
