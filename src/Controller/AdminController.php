<?php
namespace LazyBouc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use LazyBouc\Domain\User;
//use LazyBouc\Domain\Book;
use LazyBouc\Form\Type\UserType;
//use LazyBouc\Form\Type\BookType;

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
        return $app['twig']->render('admin.html.twig', array(
			'genres' => $genres,
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
	
	/*$emailConstraint = new EmailConstraint();
	$validator = $this->get('validator');
    $errors = $validator->validate($user)->validateValue(
        $email,
        $emailConstraint 
    );*/
	
	if ($userForm->isSubmitted() && $userForm->isValid() && count($errors) > 0) {
		// generate a random salt value
		$salt = substr(md5(time()), 0, 23);
		$user->setSalt($salt);
		$plainPassword = $user->getPassword();
		// find the default encoder
		$encoder = $app['security.encoder.digest'];
		// compute the encoded password
		$password = $encoder->encodePassword($plainPassword, $user->getSalt());
		$user->setPassword($password); 
		$app['dao.user']->save($user);
		$app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été créé.');
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
		$id = $app["user"]->getId();
		$genres = $app['dao.genre']->findAll();
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été mis à jour.');
        }
        return $app['twig']->render('user_form.html.twig', array(
			'genres' => $genres,
            'title' => 'Modifier l\'utilisateur',
            'userForm' => $userForm->createView()));
    }
	
    /**
     * Edit user controller with id.
     *
     * @param integer $id User id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
    public function editUserActionWithId($id, Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
        $user = $app['dao.user']->find($id);
        $userForm = $app['form.factory']->create(new UserType(), $user);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $plainPassword = $user->getPassword();
            // find the encoder for the user
            $encoder = $app['security.encoder_factory']->getEncoder($user);
            // compute the encoded password
            $password = $encoder->encodePassword($plainPassword, $user->getSalt());
            $user->setPassword($password); 
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été mis à jour.');
        }
        return $app['twig']->render('user_form.html.twig', array(
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
        // Delete all associated comments
        $app['dao.comment']->deleteAllByUser($id);
        // Delete the user
        $app['dao.user']->delete($id);
        $app['session']->getFlashBag()->add('success', 'L\'utilisateur a bien été supprimé.');
        return $app->redirect('/admin');
    }
}