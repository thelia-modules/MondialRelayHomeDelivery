<?php

namespace MondialRelayHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Propel\Runtime\Map\TableMap;
use MondialRelayHomeDelivery\Model\Map\MondialRelayHomeDeliveryPriceTableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Bridge\Propel\Attribute\Relation;
use Thelia\Api\Resource\PropelResourceInterface;
use Thelia\Api\Resource\PropelResourceTrait;
use Thelia\Model\Area;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/mondial-relay-home-delivery-price/{id}',
            name: 'api_mondial_relay_home_delivery_price_get_front'
        ),
        new GetCollection(
            uriTemplate: '/front/mondial-relay-home-delivery-prices',
            name: 'api_mondial_relay_home_delivery_price_get_collection_front'
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/mondial-relay-home-delivery-price/{id}',
            name: 'api_mondial_relay_home_delivery_price_get_admin'
        ),
        new GetCollection(
            uriTemplate: '/admin/mondial-relay-home-delivery-prices',
            name: 'api_mondial_relay_home_delivery_price_get_collection_admin'
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]]
)]
class MondialRelayHomeDeliveryPriceResource implements PropelResourceInterface
{
    use PropelResourceTrait;

    public const GROUP_ADMIN_READ = 'admin:mondial_relay_home_delivery_price:read';
    public const GROUP_FRONT_READ = 'front:mondial_relay_home_delivery_price:read';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?float $maxWeight = null;

    /**
     * @var float|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?float $price = null;

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $areaId = null;

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new MondialRelayHomeDeliveryPriceTableMap();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
