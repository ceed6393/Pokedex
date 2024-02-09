<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PokemonController extends AbstractController
{
    #[Route('/', name: 'app_pokemon')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/index.html.twig', [
"pokemon" => $pokemonRepository->findAll()

        ]);
    }

    #[Route('/ajout', name: 'app_pokemon_ajout')]
    public function addPokemon(Request $request, SluggerInterface $slugger, EntityManagerInterface $em): Response
    {
$form = $this->createForm(PokemonType::class, new Pokemon(),
[
    'validation_groups' =>['ajout'],
    
]);
$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()){
    $pokemon = $form->getData();
    $image = $form->get('picture')->getData();
    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    // this is needed to safely include the file name as part of the URL
    $safeFilename = $slugger->slug($originalFilename);
    $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

    $image->move(
        $this->getParameter('poke_picture'),
        $newFilename
    );

$pokemon->setPicture($newFilename);
$em->persist($pokemon);
$em->flush();

return new RedirectResponse($this->generateUrl('app_pokemon'));
}


        return $this->render('pokemon/add.html.twig', [
            "form" => $form->createView()
        ]);
    }
    #[Route('/delete/{id}', name: "app_delete_pokemon")]
    public function remove(Pokemon $pokemon,EntityManagerInterface $em, Filesystem $fs) {
        $fs->remove($this->getParameter("poke_picture").'/'. $pokemon->getPicture());
        $em->remove($pokemon);
$em->flush();


return new RedirectResponse($this->generateUrl("app_pokemon"));
}

#[Route('/edit/{id}', name: "app_edit_pokemon")]
public function edit(Pokemon $pokemon, Request $request, EntityManagerInterface $em, Filesystem $fs, SluggerInterface $slugger){
    $form=$this->createForm(PokemonType::class, $pokemon);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
        $pokemon = $form->getData();
        $image=$form->get('picture')->getData();
if($image){
    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    // this is needed to safely include the file name as part of the URL
    $safeFilename = $slugger->slug($originalFilename);
    $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

    $fs->remove($this->getParameter("poke_picture").'/'. $pokemon->getPicture());
    $image->move(
        $this->getParameter('poke_picture'),
        $newFilename
    );
    $pokemon->setPicture($newFilename);
}
$em->flush();
return new RedirectResponse($this->generateUrl("app_pokemon"));
    }

    return $this->render("pokemon/edit.html.twig", [
"form" => $form->createView(),
"pokemon" => $pokemon

    ]); 
}

#[Route('/pokemon/{id}', requirements: ['id' => '\d+'], name: "app_detail_pokemon")]
public function  detail(Pokemon $pokemon){
    return $this->render("pokemon/detail.html.twig", [
        "pokemon" =>  $pokemon
    ]);
}
}
