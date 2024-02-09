<?php

namespace App\Controller;

use App\Form\SearchPokemonType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, PokemonRepository $pokemonRepository): Response
    {
        $form = $this->createForm(SearchPokemonType::class);
        $form->handleRequest($request);
$research = false;
$pokemon = [];

        if($form->isSubmitted() && $form->isValid()){
            $formSearch = $form->getData();

            $pokemon = $pokemonRepository->search($formSearch);
       $research =true;
        }
        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'research' => $research,
            'pokemon' => $pokemon
        ]);
    }
}
