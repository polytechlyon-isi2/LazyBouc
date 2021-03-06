<?php
namespace LazyBouc\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
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
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Mot de passe'),
                'second_options'  => array('label' => 'Répéter le mot de passe'),
            ));
    }
    public function getName()
    {
        return 'user';
    }
}