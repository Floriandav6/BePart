<?php


namespace App\Form;


use App\Data\SearchData;

use App\Entity\Categorie;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    /* formulaire de filtres en fonction des catégories */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder

          ->add('categories', EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Categorie::class,
                'expanded' => true,
                'multiple' => true
    ])

      ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=> SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false

        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
