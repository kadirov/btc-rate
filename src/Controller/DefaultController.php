<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\Rate\Constants\CurrencyPair;
use App\Component\Rate\Provider\Interfaces\RateProviderInterface;
use App\Form\DateRangeType;
use App\Model\DateRange;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index_page")
     *
     * @param RateProviderInterface $rateProvider
     * @param Request $request
     * @return Response
     */
    public function mainAction(RateProviderInterface $rateProvider, Request $request): Response
    {
        $btcUsdRates = [];
        $btcEurRates = [];

        $dateRange = new DateRange();
        $form = $this->createForm(DateRangeType::class, $dateRange);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            try {
                $btcUsdRates =
                    $rateProvider->getRates($dateRange->getDateFrom(), $dateRange->getDateBy(), CurrencyPair::BTC_USD);

                $btcEurRates =
                    $rateProvider->getRates($dateRange->getDateFrom(), $dateRange->getDateBy(), CurrencyPair::BTC_EUR);
//            } catch (Throwable $e) {
//                throw new BadRequestHttpException('Wrong date');
//            }
        }

        return $this->render('index.html.twig', [
            'btcUsdRates' => $btcUsdRates,
            'btcEurRates' => $btcEurRates,
            'form' => $form->createView(),
        ]);
    }
}
