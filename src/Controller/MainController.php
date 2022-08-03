<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Sortie;
use App\Entity\Ville;
use App\Form\AccueilFiltrageFormType;
use App\Form\VilleSearchType;
use App\Repository\CampusRepository;
use App\Repository\SortieRepository;
use App\Repository\UserRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */
    public function index(AccueilFiltrageFormType $accueilFiltrageFormType, Request $request, SortieRepository $sortieRepository): Response
    {

        $filtreForm = $this->createForm(AccueilFiltrageFormType::class);
        $filtreForm->handleRequest($request);


        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('main/index.html.twig',
            ['filtreForm' => $filtreForm->createView(),
                'sorties' => $sortieRepository->findAll()]);
    }

    /**
     * @Route("/gestion_ville", name="gestion_ville")
     */
    public function gestionville(VilleRepository  $villeRepository, Request $request,EntityManagerInterface $entityManager): Response
    {
        $ville = new Ville();
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');

        $villeForm = $this->createForm(VilleSearchType::class,$ville);
        $villeForm->handleRequest($request);
        if($villeForm->isSubmitted()){
            if ($ville->getNom() != ""){
                $villes = $villeRepository->findVilleSearchbar($ville->getNom());
            }
            else{
                $villes = $villeRepository-> findAll();
            }
        }
        else {
            $villes = $villeRepository-> findAll();
        }
        return $this->render('main/gestionville.html.twig',["villes" => $villes,'villeForm' =>$villeForm->createView()]);
    }

    /**
     * @Route("/ville_edit/{id}", name="ville_edit")
     */

    public function edit(Request $request,int $id,VilleRepository  $villeRepository,EntityManagerInterface $entityManager): Response
    {
        $ville =($villeRepository->find($id));

        $villeForm = $this->createForm(VilleSearchType::class,$ville);

        $villeForm->handleRequest($request);
        //si on submit le formulaire
        if($villeForm->isSubmitted()){
            //ajout de la produit en base

            $entityManager->persist($ville);
            $entityManager->flush();

            $this->addFlash('success', 'ville modifié!');
            //on affiche la liste des produits
            return $this->redirectToRoute('gestion_ville');
        }

        //on envoit le formulaire a la page d'ajout de category
        return $this->render('main/ville_edit.html.twig',['villeForm' =>$villeForm->createView()]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('main/profil.html.twig', ["user" => $user ]);
    }

}
