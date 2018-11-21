<?php

namespace HostAndGuestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class experienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')->add('description',TextareaType::class)->add('lieu')
            ->add('prix')
            ->add('capacitegroupe')
            ->add('critere',TextareaType::class)
            ->add('rencontrelieu')
            ->add('date')
            ->add('categorie',ChoiceType::class,array('choices'=>array('Sport'=>'Sport','Culture'=>'Culture','Divertisement'=>'Divertisement','Autres'=>'Autres')))
            ->add('images',FileType::class, array('label' => 'Images','data_class'=>null))
            ->add('save',SubmitType::class) ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HostAndGuestBundle\Entity\experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hostandguestbundle_experience';
    }


}
