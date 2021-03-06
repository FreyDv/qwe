<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label'=>'Name', // выводит название именно с этого класса
                'required' => true, // обязательно к заполнению (по дефолту тру)
//                'constraints'=> [    //блок для задания валидационых павраметров
//                    new NotBlank([],'Should be fill')      // Валидация на заполненую форму
//                ]                                          // и вывод сообщения если это не так
            ])
            ->add('price',NumberType::class,[
                'label'=>'Price',
                'scale'=> 2,
                'html5' => true,
                'attr'=>[
                    'step'=>'1'
                ]
            ])
            ->add('quantity',NumberType::class,[
                'label' => 'quantity'

            ])
            ->add('description')
            ->add('isPublished')
            ->add('isDeleted')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
