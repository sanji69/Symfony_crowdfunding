<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/06/2018
 * Time: 09:38
 */

namespace App\Form;


use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesActivedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actived', ChoiceType::class, array(
                'choices' => array(
                    'Activez' => 1,
                    'Desactivez' => 0
                )));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Articles::class
        ));
    }








}




