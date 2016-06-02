<?php

namespace WebLinks\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class LinkType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', 'textarea');
    }

    public function getName()
    {
        return "link";
    }
}