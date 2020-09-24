<?php

namespace App\Controller;

use App\Entity\Arret;
use App\Forms\ArretForm;
use App\Manager\ArretInfoManager;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\Component\Validator\Constraints\Timezone;
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
     * @throws \Exception
     */
    public function index(Request $request): Response
    {

        $search = new Arret();
        $formArret = $this->createForm(ArretForm::class, $search);
        $formArret->handleRequest($request);

        $dataSens0 = [];
        $dataSens1 = [];
        $nextDepart0 = new Arret();
        $nextDepart0->setNomArret("");
        $nextDepart0->setDepart(new DateTime());
        $nextDepart0->setDestination("");
        $nextDepart0->setError("Aucune donnée pour le moment.");

        $nextDepart1 = new Arret();
        $nextDepart1->setNomArret("");
        $nextDepart1->setDepart(new DateTime());
        $nextDepart1->setDestination("");
        $nextDepart1->setError("Aucune donnée pour le moment.");

        if ($formArret->isSubmitted()) {
            $arretInfoManager = new ArretInfoManager();

            $result0 = array($arretInfoManager->getData($search->getNomArret(), 0, 1))[0];
            $records0 = array_column(array($result0), 'records')[0];

            foreach ($records0 as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;
                array_push($dataSens0, $dataArray);
            }

            $result1 = array($arretInfoManager->getData($search->getNomArret(), 1, 1))[0];
            $records1 = array_column(array($result1), 'records')[0];

            foreach ($records1 as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;
                array_push($dataSens1, $dataArray);
            }

            if (sizeof($dataSens0) != 0) {
                $nextDepart0->setNomArret($dataSens0[0]['nomarret']);
                $nextDepart0->setDestination($dataSens0[0]['destination']);
                $date0 = new DateTime($dataSens0[0]['depart']);
                $date0->setTimezone(new DateTimeZone('Europe/Paris'));
                $nextDepart0->setDepart($date0);
                $nextDepart0->setError('');
            }

            if (sizeof($dataSens1) != 0) {
                $nextDepart1->setNomArret($dataSens1[0]['nomarret']);
                $nextDepart1->setDestination($dataSens1[0]['destination']);
                $date1 = new DateTime($dataSens0[0]['depart']);
                $date1->setTimezone(new DateTimeZone('Europe/Paris'));
                $nextDepart1->setDepart(new DateTime($dataSens1[0]['depart']) );
                $nextDepart1->setError('');

            }


            $nowDateTime = new DateTime();

            $nextDepart0->setDiff(abs($nowDateTime->getTimestamp() - $nextDepart0->getDepart()->getTimestamp()));
            $nextDepart1->setDiff(abs($nowDateTime->getTimestamp() - $nextDepart1->getDepart()->getTimestamp()));

        }

        dump($formArret);
        dump($dataSens0);
        dump($dataSens1);
        dump($nextDepart0);
        dump($nextDepart1);

        return new Response($this->twig->render('pages/home.html.twig', [
            'formArret' => $formArret->createView(),
            '$dataSens0' => $dataSens0,
            '$dataSens1' => $dataSens1,
            'nextDepart0' => $nextDepart0,
            'nextDepart1' => $nextDepart1
        ]));
    }

}