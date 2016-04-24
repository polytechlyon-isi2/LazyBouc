<?php
namespace LazyBouc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use LazyBouc\Domain\User;
use LazyBouc\Domain\Book;
use LazyBouc\Form\Type\UserType;
use LazyBouc\Form\Type\AdminUserType;
use LazyBouc\Form\Type\BookType;

//use Symfony\Component\Validator\Constraints\Email as EmailConstraint;

class AdminController {
    /**
     * Admin home page controller.
     *
     * @param Application $app Silex application
     */
    public function indexAction(Application $app) {
		$genres = $app['dao.genre']->findAll();
        $users = $app['dao.user']->findAll();
		$books = $app['dao.book']->findAll();
        return $app['twig']->render('admin.html.twig', array(
			'genres' => $genres,
			'books' => $books,
            'users' => $users));
    }
	
	/**
    * Signup controller.
    *
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function addUserAction(Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
		$user = new User();
		$userForm = $app['form.factory']->create(new UserType(), $user);
		$userForm->handleRequest($request);

		if ($userForm->isSubmitted() && $userForm->isValid()) {
			if(!filter_var($user->getMail(),FILTER_VALIDATE_EMAIL)){
				$app['session']->getFlashBag()->add('error', 'L\'adresse mail n\'est pas valide.');
			}
			else{
				// generate a random salt value
				$salt = substr(md5(time()), 0, 23);
				$user->setSalt($salt);
				$plainPassword = $user->getPassword();
				// find the default encoder
				$encoder = $app['security.encoder.digest'];
				// compute the encoded password
				$password = $encoder->encodePassword($plainPassword, $user->getSalt());
				$user->setPassword($password); 
				$user->setRole("ROLE_USER");
				$app['dao.user']->save($user);
				$app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été créé.');
			}
		}
		return $app['twig']->render('user_form.html.twig', array(
			'title' => 'Inscription',
			'genres' => $genres,
			'userForm' => $userForm->createView()));
	}
	
	/**
     * Edit user controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserAction( Request $request, Application $app) {
		$id = $app['user']->getId();
		$genres = $app['dao.genre']->findAll();
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
			$user->setRole("ROLE_USER");
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été mis à jour.');
        }
        return $app['twig']->render('user_form.html.twig', array(
			'genres' => $genres,
            'title' => 'Profil',
            'userForm' => $userForm->createView()));
    }
	
    /**
     * Edit user controller with id.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editAdminUserAction($id, Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new AdminUserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $app['dao.user']->saveWithoutPwd($user);
            $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été mis à jour.');
        }
        return $app['twig']->render('admin_user_form.html.twig', array(
			'genres' => $genres,
            'title' => 'Modifier l\'utilisateur',
            'userForm' => $userForm->createView()));
    }
    /**
     * Delete user controller.
     *
     * @param integer $id User id
     * @param Application $app Silex application
     */
    public function deleteUserAction($id, Application $app) {
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été supprimé.');
        return $this->indexAction($app);
    }
	
	/**
     * Add a new book.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
	public function addBookAction(Request $request, Application $app){
		$genres = $app['dao.genre']->findAll();
		$authors = $app['dao.author']->findAll();
		$book = new Book();
        $bookForm = $app['form.factory']->create(new BookType($genres,$authors), $book);
        $bookForm->handleRequest($request);
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {
			$genreId = $bookForm->get('genre')->getData();
			$authorId = $bookForm->get('author')->getData();
			$book->setGenre($app['dao.genre']->find($genreId));
			$book->setAuthor($app['dao.author']->find($authorId));
			// image processing
			$dir = 'images';
			$uploaded_file = $bookForm['image']->getData();
			if($uploaded_file!=null){
				$uploaded_file_info = pathinfo($uploaded_file->getClientOriginalName());
				$extension = strtolower($uploaded_file_info['extension']);
				if($extension=='png'||$extension=='jpg'||$extension=='gif'){
					$filename = 'cover_'.$book->getTitle().'_'.$book->getYear().'_'.date('Y-m-d-H-i-s').'.'.$extension;
					$uploaded_file->move($dir, $filename);
					$book->setImage($filename);
					$app['dao.book']->save($book);
					$app['session']->getFlashBag()->add('success', 'Le livre a bien été ajouté.');
				}
				else{
					$app['session']->getFlashBag()->add('error', 'L\'extension du fichier n\'est pas valide. Le fichier doit être au format jpg, png ou gif.');
				}
			}
			else{
				$app['dao.book']->save($book);
				$app['session']->getFlashBag()->add('success', 'Le livre a bien été ajouté.');
			}
        }
        return $app['twig']->render('book_form.html.twig', array(
			'genres' => $genres,
            'title' => 'Ajouter un livre',
            'bookForm' => $bookForm->createView()));
	}
	
	/**
     * Delete book controller.
     *
     * @param integer $id book id
     * @param Application $app Silex application
     */
    public function deleteBookAction($id, Application $app) {
        // Delete the book
        $app['dao.book']->delete($id);
        $app['session']->getFlashBag()->add('success', 'Le livre a bien été supprimé.');
        return $this->indexAction($app);
    }
	
	
	/**
     * Add a new book.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
	public function editBookAction($id, Request $request, Application $app){
		$genres = $app['dao.genre']->findAll();
		$authors = $app['dao.author']->findAll();
		$book = new Book();
		$book = $app['dao.book']->find($id);
		$book->setImage(null);
        $bookForm = $app['form.factory']->create(new BookType($genres,$authors), $book);
        $bookForm->handleRequest($request);
        if ($bookForm->isSubmitted() && $bookForm->isValid()) {
			$genreId = $bookForm->get('genre')->getData();
			$authorId = $bookForm->get('author')->getData();
			$book->setGenre($app['dao.genre']->find($genreId));
			$book->setAuthor($app['dao.author']->find($authorId));
			// image processing
			$dir = 'images';
			$uploaded_file = $bookForm['image']->getData();
			if($uploaded_file!=null){
				$uploaded_file_info = pathinfo($uploaded_file->getClientOriginalName());
				$extension = strtolower($uploaded_file_info['extension']);
				if($extension=='png'||$extension=='jpg'||$extension=='gif'){
					$filename = 'cover_'.$book->getTitle().'_'.$book->getYear().'_'.date('Y-m-d-H-i-s').'.'.$extension;
					$uploaded_file->move($dir, $filename);
					$book->setImage($filename);
					$app['dao.book']->save($book);
					$app['session']->getFlashBag()->add('success', 'Le livre a bien été ajouté.');
				}
				else{
					$app['session']->getFlashBag()->add('error', 'L\'extension du fichier n\'est pas valide. Le fichier doit être au format jpg, png ou gif.');
				}
			}
			else{
				$image = $app['dao.book']->find($id)->getImage();
				$book->setImage($image);
				$app['dao.book']->save($book);
				$app['session']->getFlashBag()->add('success', 'Le livre a bien été ajouté.');
			}
        }
        return $app['twig']->render('book_form.html.twig', array(
			'genres' => $genres,
            'title' => 'Modifier un livre',
            'bookForm' => $bookForm->createView()));
	}
	
	
}