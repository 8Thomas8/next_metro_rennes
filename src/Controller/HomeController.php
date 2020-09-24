<?php

namespace App\Controller;

use App\Entity\Arret;
use App\Entity\NomArret;
use App\Entity\NomDestination;
use App\Forms\ArretForm;
use App\Forms\DestinationForm;
use App\Manager\ArretInfoManager;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\Component\Validator\Constraints\Timezone;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function GuzzleHttp\Psr7\str;

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
     * @param Request $requestArret
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws \Exception
     */
    public function index(Request $requestArret): Response
    {

        $search = new Arret();
        $depart = new Arret();
        $destinations = ["La Poterie", "J.F. Kennedy"];

        $formArret = $this->createForm(ArretForm::class, $search);
        $formArret->handleRequest($requestArret);

        if ($formArret->isSubmitted()) {

            $arretInfoManager = new ArretInfoManager();

            $result = array($arretInfoManager->getData($search->getNomArret(), $search->getDestination() == $destinations[0] ? 0 : 1, 1))[0];
            $records = array_column(array($result), 'records')[0];

            foreach ($records as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array)$data;

                $depart->setDestination($dataArray['destination']);
                $depart->setNomArret($dataArray['nomarret']);
                $depart->setDepart(new DateTime($dataArray['depart']));
                //$depart->setTimezone(new DateTimeZone('Europe/Paris'));

                $nowDateTime = new DateTime();
                $depart->setDiff(abs($nowDateTime->getTimestamp() - $depart->getDepart()->getTimestamp()));
            }
        }

        dump($depart);

        return new Response($this->twig->render('pages/home.html.twig', [
            'formArret' => $formArret->createView(),
            'depart' => $depart
        ]));
    }

}