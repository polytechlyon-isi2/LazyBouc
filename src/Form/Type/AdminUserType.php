<?php
namespace LazyBouc\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', 'text')
			->add('firstname', 'text', array(
				'label' => 'Prénom'
			))
			->add('lastname', 'text', array(
				'label' => 'Nom'
			))
			->add('mail', 'email')
            ->add('role', 'choice', array(
                'choices' => array('ROLE_ADMIN' => 'Admin', 'ROLE_USER' => 'User')
            ));
    }
    public function getName()
    {
        return 'user';
    }
}