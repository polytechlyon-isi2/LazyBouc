<?php
namespace LazyBouc\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractType
{
	private $authors;
	private $genres;
	/**
	 * Constructor.
	 *
	 * @param array $genres List the genres
	 * @param array $authors List the authors
	 */
	public function __construct(array $genres, array $authors)
	{
		$this->genres = $genres;
		$this->authors = $authors;
	}
		
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$choicesGenre = array();
		$choicesAuthor = array();
        foreach ($this->genres as $id => $genre) {
            $cle = $genre->__toString();
            $choicesGenre[$cle] = $id;
        }
		foreach ($this->authors as $id => $author) {
            $cle = $author->__toString();
            $choicesAuthor[$cle] = $id;
        }
	
        $builder
			->add('title', 'text', array(
				'label' => 'Titre'
			))
			->add('year', 'number', array(
				'label' => 'Année'
			))
            ->add('image', 'file', array(
				'label' => 'Image',
				'required' => false
			))
			->add('longSummary', 'textarea', array(
				'label' => 'Résumé',
				                'attr' => array(
                    'rows' => '4',
                )
			))
			->add('shortSummary', 'textarea', array(
				'label' => 'Résumé synthétique',
				                'attr' => array(
                    'rows' => '2',
                )
			))
			->add('price', 'number', array(
				'label' => 'Prix'
			))
			->add('genre', 'choice', array(
                'label' => "Genre",
                'choices' => $choicesGenre,
                'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
                'expanded' => false, 
                'multiple' => false,
                'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
            ))
			->add('author', 'choice', array(
                'label' => "Auteur",
                'choices' => $choicesAuthor,
                'choices_as_values' => true, // Future valeur par défaut dans Symfony 3.x
                'expanded' => false, 
                'multiple' => false,
                'mapped' => false  // ce champ n'est pas mis en correspondance avec la propriété de l'objet
            ));
    }
    public function getName()
    {
        return 'book';
    }
}