<?php

namespace MondialRelayHomeDelivery\Api\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use MondialRelayHomeDelivery\Api\Resource\MondialRelayHomeDeliveryDeliveryPriceResource;
use MondialRelayHomeDelivery\Model\MondialRelayHomeDeliveryInsuranceQuery;
use MondialRelayHomeDelivery\Model\MondialRelayHomeDeliveryPriceQuery;
use MondialRelayHomeDelivery\Model\MondialRelayHomeDeliveryZoneConfigurationQuery;
use MondialRelayHomeDelivery\MondialRelayHomeDelivery;
use Propel\Runtime\ActiveQuery\Criteria;
use Symfony\Component\HttpFoundation\RequestStack;
use Thelia\Model\AreaDeliveryModuleQuery;
use Thelia\Model\CountryAreaQuery;
use Thelia\Model\CountryQuery;
use Thelia\Model\ModuleQuery;
use Thelia\Model\StateQuery;

class MondialRelayHomeDeliveryDeliveryPriceProvider implements ProviderInterface
{
    public function __construct(
        private RequestStack $requestStack
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $request = $this->requestStack->getCurrentRequest();
        $countryId = $request?->query->get('country_id');
        $stateId = $request?->query->get('state_id');
        $mode = $request?->query->get('mode');
        $insuranceRequested = filter_var($request?->query->get('insurance', false), FILTER_VALIDATE_BOOLEAN);

        $results = [];

        if ($countryId && null !== $country = CountryQuery::create()->findPk($countryId)) {
            $state = $stateId ? StateQuery::create()->findPk($stateId) : null;

            $countryInAreaList = CountryAreaQuery::findByCountryAndState($country, $state);
            $areaIdList = [];

            $module = ModuleQuery::create()->findOneByCode(MondialRelayHomeDelivery::getModuleCode());

            foreach ($countryInAreaList as $countryInArea) {
                if (AreaDeliveryModuleQuery::create()
                        ->filterByAreaId($countryInArea->getAreaId())
                        ->filterByModule($module)
                        ->count() > 0) {
                    $areaIdList[] = $countryInArea->getAreaId();
                }
            }

            $zones = MondialRelayHomeDeliveryZoneConfigurationQuery::create()
                ->filterByAreaId($areaIdList, Criteria::IN)
                ->find();

            $cart = null;
            $cartWeight = 0;
            $cartValue = 0;

            foreach ($zones as $zone) {
                $deliveryPrice = MondialRelayHomeDeliveryPriceQuery::create()
                    ->filterByAreaId($zone->getAreaId())
                    ->filterByMaxWeight($cartWeight, Criteria::GREATER_EQUAL)
                    ->orderByMaxWeight(Criteria::ASC)
                    ->findOne();

                if ($deliveryPrice) {
                    $resource = new MondialRelayHomeDeliveryDeliveryPriceResource();
                    $resource->price = $deliveryPrice->getPriceWithTax();
                    $resource->maxWeight = $deliveryPrice->getMaxWeight();
                    $resource->areaId = $deliveryPrice->getAreaId();
                    $resource->deliveryDelay = $zone->getDeliveryTime();
                    $resource->deliveryDate = (new \DateTime())->add(new \DateInterval("P" . $zone->getDeliveryTime() . "D"));

                    if ($insuranceRequested) {
                        $insurance = MondialRelayHomeDeliveryInsuranceQuery::create()
                            ->filterByMaxValue($cartValue, Criteria::GREATER_EQUAL)
                            ->orderByMaxValue(Criteria::ASC)
                            ->findOne();
                        if ($insurance) {
                            $resource->insuranceAvailable = true;
                            $resource->insurancePrice = $insurance->getPriceWithTax();
                            $resource->insuranceRefValue = $insurance->getMaxValue();
                        } else {
                            $resource->insuranceAvailable = false;
                        }
                    } else {
                        $resource->insuranceAvailable = false;
                    }

                    $results[] = $resource;
                }
            }
        }

        return $results;
    }
}
