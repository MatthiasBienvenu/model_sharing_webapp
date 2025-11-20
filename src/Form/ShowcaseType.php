<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Model;
use App\Entity\Showcase;
use App\Repository\ModelRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShowcaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $showcase = $options['data'] ?? null;
        $member = $showcase->getMember();
        $builder
            ->add('description')
            ->add('published')
            ->add('member', EntityType::class, [
                'class' => Member::class,
                'disabled' => true,
                'choice_label' => 'email'
            ])
            ->add('models', EntityType::class, [
                'class' => Model::class,
                'multiple' => true,
                'choice_label' => 'name',
                'query_builder' => function (ModelRepository $er) use ($member) {
                    return $er->createQueryBuilder('o')
                        ->leftJoin('o.vault', 'i')
                        ->leftJoin('i.member', 'm')
                        ->andWhere('m.id = :memberId')
                        ->setParameter('memberId', $member->getId());
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Showcase::class,
        ]);
    }
}
