<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/personne")
 */
class PersonneController extends AbstractController
{
    /**
     * @Route("/ajouter", name="personne_ajouter")
     */

public  function ajouter(EntityManagerInterface $em):Response
{
    //dump die
    //dump() // le vardump de symfony
    //dd('Ajouter personne !');
    //instancier une nouvelle personne
    $personne = new Personne();
    //on hydrate 
    $personne->setPrenom('Jean');
    $personne->setNom('DUJARDIN');
    //persister : mettre a dispo du "manager" Doctrine 
    $em->persist($personne);
    //flush equivaut à save
    $em->flush();
    //return $this->json($personne);
    return $this->redirectToRoute('home');
}


   /**
     * @Route("/enlever/{id}", name="personne_enlever")
     */
    //j'ajouter l'id ds la route et je lui dit que je veux supprimer la personne
    public  function enlever(Personne $personne, EntityManagerInterface $em):Response
    {
        //pas besoin de persister
        $em->remove($personne);
        $em->flush();
        //return $this->json($personne);
        return $this->redirectToRoute('home');
    }
    

/**
   * @Route("/liste", name="personne_liste" )
   */ 
  public function liste(PersonneRepository $repo):Response
  {
      $personnes = $repo->findAll();
      return $this->json($personnes);
  }



}
