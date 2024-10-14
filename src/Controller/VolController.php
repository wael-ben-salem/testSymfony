<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Form\VolType;
use App\Repository\AeroportRepository;
use App\Repository\VolRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolController extends AbstractController
{
    #[Route('/vols', name: 'vol_index', methods: ['GET'])]
    public function index(VolRepository $volRepository): Response
    {
        $vols = $volRepository->findAll();

        return $this->render('vol/index.html.twig', [
            'vols' => $vols,
        ]);
    }

    #[Route('/vol/new', name: 'vol_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, AeroportRepository $aeroportRepository): Response
    {
        $vol = new Vol();
        $form = $this->createForm(VolType::class, $vol);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
    
            // Manually convert DateTime fields to DateTimeImmutable
            $data->setDateDeDepart(new \DateTimeImmutable($data->getDateDeDepart()->format('Y-m-d H:i:s')));
            $data->setDateDArrivee(new \DateTimeImmutable($data->getDateDArrivee()->format('Y-m-d H:i:s')));
    
            // Assuming you're linking to Aeroport
            $aeroport = $data->getAeroport(); // Get the Aeroport entity from the form data
            if ($aeroport) {
                // Set the airport for the Vol entity
                $vol->setAeroport($aeroport);
            } else {
                throw $this->createNotFoundException('Aéroport non trouvé.');
            }
    
            // Persist the Vol entity
            $entityManager->persist($vol);
            $entityManager->flush();
    
            return $this->redirectToRoute('vol_index');
        }
    
        return $this->render('vol/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/vol/{id}', name: 'vol_show')]
public function show(Vol $vol): Response
{
    return $this->render('vol/show.html.twig', [
        'vol' => $vol,
    ]);
}
    
}
