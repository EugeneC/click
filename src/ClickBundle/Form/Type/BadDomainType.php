<?php

namespace ClickBundle\Form\Type;

use CoreDomain\BadDomain\Model\BadDomain;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type;

/**
 * Bad Domain form
 */
class BadDomainType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Type\UrlType::class, ['required' => true])
            ->add('save', Type\SubmitType::class, ['label' => 'Add bad domain'])
            ->getForm();
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'extra_fields_message' => 'This form should not contain extra fields: {{ extra_fields }}',
                'data_class'           => BadDomain::class,
                'csrf_protection'      => false
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return '';
    }
}
