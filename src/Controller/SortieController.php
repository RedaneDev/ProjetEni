<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\CreerUneSortieType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sortie")
 */
class SortieController extends AbstractController
{
    /**
     * @Route("/créer", name="sortie_créer")
     */
    public function créer(EntityManagerInterface $entityManager){
        $sortie =new Sortie();
        $sortieForm = $this->createForm(CreerUneSortieType::class,$sortie);

        if($sortieForm->isSubmitted()){
            $entityManager->persist($sortie);
            $entityManager->flush();
            // redirect page liste des sorties
            $this->redirectToRoute('gestion_ville');
        }
        return $this->render('sortie/ajoutersortie.html.twig',['sortieForm' =>$sortieForm->createView()]);

    }

    /**
     * @Route("/show/{id}", name="sortie_show")
     */
    public function show(Sortie $sortie, SortieRepository $sortieRepository, int $id){

        $sortie = ($sortieRepository->find($id));
        return $this->render('sortie/show.html.twig',['sortie' => $sortie]);

    }
}