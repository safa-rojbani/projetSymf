<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use App\Form\CompanyType;;

class CompanyController extends AbstractController
{
    #[Route('/company', name: 'app_company')]
    public function createCompany(Request $request, ManagerRegistry $doctrine)
    {
    $this->doctrine = $doctrine;
    $Company = new Company();
    $form = $this->createForm(CompanyType::class, $Company);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $em = $doctrine->getManager();
    $em->persist($Company);
    $em->flush();

    $Company = new Company();
    $form = $this->createForm(CompanyType::class, $Company);
    
    
    }
    return $this->render('company/index.html.twig', [
    'formCompany' => $form->createView()
    ]);
    }
}
