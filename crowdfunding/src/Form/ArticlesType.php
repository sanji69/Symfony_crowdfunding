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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        die('form');
        $builder
            ->add('title', TextType::class)
            ->add('goal', IntegerType::class)
            ->add('content', TextareaType::class)
        ;
//        die('end form');
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




