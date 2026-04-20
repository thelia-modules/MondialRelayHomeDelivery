<?php

namespace MondialRelayHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use MondialRelayHomeDelivery\Api\State\MondialRelayHomeDeliveryDeliveryPriceProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use Thelia\Api\Bridge\Propel\Attribute\Relation;
use Thelia\Model\Area;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/front/mondial-relay-home-delivery-delivery-prices',
            name: 'api_mondial_relay_home_delivery_delivery_price_get_collection',
            provider: MondialRelayHomeDeliveryDeliveryPriceProvider::class
        )
    ],
    normalizationContext: ['groups' => ['front:mondial_relay_home_delivery_delivery_price:read']]
)]
class MondialRelayHomeDeliveryDeliveryPriceResource
{
    /**
     * @var float|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?float $price = null;

    /**
     * @var int|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?int $areaId = null;

    /**
     * @var int|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?int $deliveryDelay = null;

    /**
     * @var \DateTimeInterface|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?\DateTimeInterface $deliveryDate = null;

    /**
     * @var bool|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?bool $insuranceAvailable = null;

    /**
     * @var float|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?float $insurancePrice = null;

    /**
     * @var float|null
     */
    #[Groups(['front:mondial_relay_home_delivery_delivery_price:read'])]
    public ?float $insuranceRefValue = null;

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return void
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    /**
     * @param float|null $maxWeight
     * @return void
     */
    public function setMaxWeight(?float $maxWeight): void
    {
        $this->maxWeight = $maxWeight;
    }

    /**
     * @return int|null
     */
    public function getDeliveryDelay(): ?int
    {
        return $this->deliveryDelay;
    }

    /**
     * @param int|null $deliveryDelay
     * @return void
     */
    public function setDeliveryDelay(?int $deliveryDelay): void
    {
        $this->deliveryDelay = $deliveryDelay;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTimeInterface|null $deliveryDate
     * @return void
     */
    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @return bool|null
     */
    public function getInsuranceAvailable(): ?bool
    {
        return $this->insuranceAvailable;
    }

    /**
     * @param bool|null $insuranceAvailable
     * @return void
     */
    public function setInsuranceAvailable(?bool $insuranceAvailable): void
    {
        $this->insuranceAvailable = $insuranceAvailable;
    }

    /**
     * @return float|null
     */
    public function getInsurancePrice(): ?float
    {
        return $this->insurancePrice;
    }

    /**
     * @param float|null $insurancePrice
     * @return void
     */
    public function setInsurancePrice(?float $insurancePrice): void
    {
        $this->insurancePrice = $insurancePrice;
    }

    /**
     * @return float|null
     */
    public function getInsuranceRefValue(): ?float
    {
        return $this->insuranceRefValue;
    }

    /**
     * @param float|null $insuranceRefValue
     * @return void
     */
    public function setInsuranceRefValue(?float $insuranceRefValue): void
    {
        $this->insuranceRefValue = $insuranceRefValue;
    }

    /**
     * @return int|null
     */
    public function getAreaId(): ?int
    {
        return $this->areaId;
    }

    /**
     * @param int|null $areaId
     * @return void
     */
    public function setAreaId(?int $areaId): void
    {
        $this->areaId = $areaId;
    }
}
