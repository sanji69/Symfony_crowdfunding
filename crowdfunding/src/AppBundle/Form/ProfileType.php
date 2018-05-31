<?php
namespace AppBundleForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder->add('nom');
       $builder->add('prenom');
   }

   public function getParent()
   {
       return 'FOS\UserBundle\Form\Type\ProfileFormType';

   }

   public function getBlockPrefix()
   {
       return 'app_user_profile';
   }

   // For Symfony 2.x
   public function getNom()
   {
       return $this->getBlockPrefix();
   }

   public function getPrenom()
   {
       return $this->getBlockPrefix();
   }
}
