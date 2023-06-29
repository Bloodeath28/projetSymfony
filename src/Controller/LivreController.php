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
        $publicKey = $_ENV['APP_SECRET_API_KEY_PUBLIC'];
        $privateKey = $_ENV['APP_SECRET_API_KEY_PRIVATE'];
        $ts = time();
        $hash = md5($ts . $privateKey . $publicKey);

        $client = new Client();

        try {
            $response = $client->request('GET', 'http://gateway.marvel.com/v1/public/comics', [
                'query' => [
                    'ts' => $ts,
                    'apikey' => $publicKey,
                    'hash' => $hash,
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            // Faites quelque chose avec la réponse JSON de l'API Marvel

            return $this->render('livre/index.html.twig', [
                'controller_name' => 'LivreController',
                'titre' => 'Livre',
                'content' => $content, // Transmettez le contenu de la réponse à votre template
            ]);
        } catch (\Exception $e) {
            // Gérez les erreurs de requête
            // Affichez ou loggez l'erreur selon vos besoins
            return new Response('Une erreur s\'est produite lors de la requête à l\'API Marvel.');
        }
    }
}
   