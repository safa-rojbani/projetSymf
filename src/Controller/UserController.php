<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function createUser(Request $request, ManagerRegistry $doctrine)
{
$this->doctrine = $doctrine;
$User = new User();
$form = $this->createForm(UserType::class, $User);
$form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {
$em = $doctrine->getManager();
$em->persist($User);
$em->flush();

$User = new User();
    $form = $this->createForm(UserType::class, $User);

}
return $this->render('user/index.html.twig', [
'formUser' => $form->createView()
]);
}
    
}
