<?php declare(strict_types=1);

namespace App\Form;

use App\Model\DateRange;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DateRangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateFrom', DateType::class, ['widget' => 'single_text'])
            ->add('dateBy', DateType::class, ['widget' => 'single_text'])
            ->add('save', SubmitType::class, array('label' => 'Search'));

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var DateRange $dateRange */
            $dateRange = $event->getData();

            $by = new DateTime();
            $by->setTimestamp($dateRange->getDateBy()->getTimestamp());
            $by->modify('+23 hours');
            $dateRange->setDateBy($by);
        });
    }
}
