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

        $dataSens0 = [];
        $dataSens1 = [];
        $nextArret0 = new Arret();
        $nextArret0->setNomArret("");
        $nextArret0->setArrivee("");
        $nextArret0->setDestination("");
        $nextArret0->setError("Aucune donnée pour le moment.");

        $nextArret1 = new Arret();
        $nextArret1->setNomArret("");
        $nextArret1->setArrivee("");
        $nextArret1->setDestination("");
        $nextArret1->setError("Aucune donnée pour le moment.");





        if ($formArret->isSubmitted()) {
            $arretInfoManager = new ArretInfoManager();
            $dataResponse = array($arretInfoManager->getData($search->getNomArret()))[0];
            $records = array_column(array($dataResponse), 'records')[0];

            foreach ($records as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;

                if ($dataArray["sens"] == 0) {
                    array_push($dataSens0, $dataArray);
                } else if ($dataArray["sens"] == 1) {
                    array_push($dataSens1, $dataArray);
                }
            }

            if (sizeof($dataSens0) != 0) {
                $nextArret0->setNomArret($dataSens0[0]['nomarret']);
                $nextArret0->setDestination($dataSens0[0]['destination']);
//            $nextArret0->setArrivee($dataSens0[0]['arrivee']);
                $nextArret0->setError('');
            }

            if (sizeof($dataSens1) != 0) {
                $nextArret1->setNomArret($dataSens1[0]['nomarret']);
                $nextArret1->setDestination($dataSens1[0]['destination']);
//            $nextArret1->setArrivee($dataSens0[0]['arrivee']);
                $nextArret1->setError('');

            }

            $nowDateTime = new \DateTime();

//            $nextArret0->setDiff($nowDateTime->diff($nextArret0->getArrivee()));
//            $nextArret1->setDiff($nowDateTime->diff($nextArret1->getArrivee()));

        }

        return new Response($this->twig->render('pages/home.html.twig', [
            'formArret' => $formArret->createView(),
            '$dataSens0' => $dataSens0,
            '$dataSens1' => $dataSens1,
            'nextArret0' => $nextArret0,
            'nextArret1' => $nextArret1
        ]));
    }

}