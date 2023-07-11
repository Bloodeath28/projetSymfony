<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    public function index(): Response
    {
        // Obtenez les clés d'API à partir des variables d'environnement
        $publicKey = $_ENV['APP_SECRET_API_KEY_PUBLIC'];
        $privateKey = $_ENV['APP_SECRET_API_KEY_PRIVATE'];
        $ts = time();

        // Créez une instance de client Guzzle
        $client = new Client([
            'base_uri' => 'https://gateway.marvel.com:443/v1/public/',
            'verify' => false,
        ]);

        try {
            // Calcul du hash
            $hash = md5($ts . $privateKey . $publicKey);

            // Effectuez la requête API avec Guzzle
            $response = $client->request('GET', 'comics', [
                'query' => [
                    'format' => 'comic',
                    'apikey' => $publicKey,
                    'hash' => $hash,
                    'ts' => $ts,
                ],
            ]);

            // Récupérez le corps de la réponse
            $body = $response->getBody()->getContents();

            // Traitez les données de la réponse comme vous le souhaitez
            $data = json_decode($body, true);

            // Par exemple, affichez le titre du premier comic
            $firstComicTitle = $data['data']['results'][0]['title'];

            // Retournez une réponse à votre template
            return $this->render('livre/index.html.twig', [
                'controller_name' => 'LivreController',
                'titre' => 'Livre',
                'first_comic_title' => $firstComicTitle,
            ]);
        } catch (\Exception $e) {
            // Gérez les erreurs de requête ici
            return new Response('Erreur lors de la requête API : ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            var_dump($e->getMessage());
        }
    }
}
var_dump($body);
