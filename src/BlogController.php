<?php
namespace ISA\Workshop;

use Silex\Application;

/**
 * Class BlogController
 * @package ISA\Workshop
 */
class BlogController
{
    /**
     * @param Application $app
     * @return string
     */
    public function showHomePage(Application $app) : string
    {
        $params = [
            'recent' => [
                'First Title', 'Second Title', 'Third Title'
            ],
            'trending' => [
                'First trending', 'Second trending', 'Third trending'
            ]
        ];


        return $app['twig']->render('index.twig', $params);
    }
}
