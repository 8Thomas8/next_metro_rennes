<?php

namespace App\Controller;

use App\Entity\Arret;
use App\Forms\ArretForm;
use App\Manager\ArretInfoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController
{
    /**
     * @var Environment
     */
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="Home")
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request): Response
    {

        $search = new Arret();
        $formArret = $this->createForm(ArretForm::class, $search);
        $formArret->handleRequest($request);

        $result0 = [];
        $result1 = [];
        $dataSens0 = [];
        $dataSens1 = [];
        $nextArret0 = new Arret();
        $nextArret0->setNomArret("");
        $nextArret0->setDepart("");
        $nextArret0->setDestination("");
        $nextArret0->setError("Aucune donnée pour le moment.");

        $nextArret1 = new Arret();
        $nextArret1->setNomArret("");
        $nextArret1->setDepart("");
        $nextArret1->setDestination("");
        $nextArret1->setError("Aucune donnée pour le moment.");


        if ($formArret->isSubmitted()) {
            $arretInfoManager = new ArretInfoManager();

            $result0 = array($arretInfoManager->getData($search->getNomArret(), 0))[0];
            $records0 = array_column(array($result0), 'records')[0];

            foreach ($records0 as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;
                array_push($dataSens0, $dataArray);
            }

            $result1 = array($arretInfoManager->getData($search->getNomArret(), 1))[0];
            $records1 = array_column(array($result1), 'records')[0];

            foreach ($records1 as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;
                array_push($dataSens1, $dataArray);
            }

            if (sizeof($dataSens0) != 0) {
                $nextArret0->setNomArret($dataSens0[0]['nomarret']);
                $nextArret0->setDestination($dataSens0[0]['destination']);
                $nextArret0->setDepart($dataSens0[0]['depart']);
                $nextArret0->setError('');
            }

            if (sizeof($dataSens1) != 0) {
                $nextArret1->setNomArret($dataSens1[0]['nomarret']);
                $nextArret1->setDestination($dataSens1[0]['destination']);
                $nextArret1->setDepart($dataSens0[0]['depart']);
                $nextArret1->setError('');

            }

            $nowDateTime = new \DateTime();

//            $nextArret0->setDiff($nowDateTime->diff($nextArret0->getDepart()));
//            $nextArret1->setDiff($nowDateTime->diff($nextArret1->getDepart()));

        }

        dump($formArret);
        dump($dataSens0);
        dump($dataSens1);
        dump($nextArret0);
        dump($nextArret1);

        return new Response($this->twig->render('pages/home.html.twig', [
            'formArret' => $formArret->createView(),
            '$dataSens0' => $dataSens0,
            '$dataSens1' => $dataSens1,
            'nextArret0' => $nextArret0,
            'nextArret1' => $nextArret1
        ]));
    }

}