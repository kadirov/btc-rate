<?php declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class DateRangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFrom', DateType::class, ['widget' => 'single_text'])
            ->add('dateBy', DateType::class, ['widget' => 'single_text'])
            ->add('save', SubmitType::class, array('label' => 'Search'));
    }
}
