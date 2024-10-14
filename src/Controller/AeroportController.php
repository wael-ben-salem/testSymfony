<?php

namespace App\Controller;

use App\Entity\Aeroport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AeroportType;



class AeroportController extends AbstractController
{

   // question numero 3
    #[Route('/list', name: 'aeroport_list')]
    public function listAeroports(EntityManagerInterface $entityManager): Response
    {
        $aeroports = $entityManager->getRepository(Aeroport::class)->findAll();

        return $this->render('aeroport/list.html.twig', [
            'aeroports' => $aeroports,
        ]);
    }


   //question numero 4.
   #[Route('/aeroport/add', name: 'app_aeroport_add')]
   public function addAeroport(Request $request, EntityManagerInterface $entityManager): Response
   {
       $aeroport = new Aeroport();
       $form = $this->createForm(AeroportType::class, $aeroport);
       $form->handleRequest($request);
   
       if ($form->isSubmitted() && $form->isValid()) {
           $entityManager->persist($aeroport);
           $entityManager->flush();
   
           return $this->redirectToRoute('aeroport_list');
       }
   
       return $this->render('aeroport/add.html.twig', [
           'form' => $form->createView(),
       ]);
   }
   
}