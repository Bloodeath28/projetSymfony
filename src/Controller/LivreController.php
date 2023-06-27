<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;


class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(): Response
{
    // Créer une instance de Client
    $client = new Client();

    try {
        // Effectuer une requête GET à l'API
        $response = $client->request('GET', 'https://api.example.com/livres');

        // Obtenir le corps de la réponse
        $data = $response->getBody()->getContents();

        // Traitement des données de la réponse de l'API
        // ...

        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'titre' => 'Livres',
            'api_data' => $data, // Passer les données de l'API au template
        ]);
    } catch (\Exception $e) {
        // Gérer les erreurs de connexion à l'API
        // ...

        // Retourner une réponse d'erreur
        return new Response('Une erreur s\'est produite lors de la connexion à l\'API.');
    }
}


    

}
