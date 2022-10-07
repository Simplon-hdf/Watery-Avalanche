<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Transaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class TransactionType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reason',TextType::class)
            ->add('amount',NumberType::class)
            ->add('deposit_identity',TextType::class)
            ->add('type',TextType::class)
            ->add('id_sender', EntityType::class, array(
                'class' => Account::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.id_user = :val')
                    ->setParameter('val', $this->security->getUser())
                    ->orderBy('u.iban', 'ASC');
                },'choice_label' => 'iban',))
            ->add('id_receiver', EntityType::class, array(
                'class' => Account::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.id_user = :val')
                    ->setParameter('val', $this->security->getUser())
                    ->orderBy('u.iban', 'ASC');
                },'choice_label' => 'iban',))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
