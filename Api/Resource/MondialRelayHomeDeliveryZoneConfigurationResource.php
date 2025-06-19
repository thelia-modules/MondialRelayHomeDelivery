<?php

namespace MondialRelayHomeDelivery\Api\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Propel\Runtime\Map\TableMap;
use MondialRelayHomeDelivery\Model\Map\MondialRelayHomeDeliveryZoneConfigurationTableMap;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Thelia\Api\Resource\PropelResourceInterface;
use Thelia\Api\Resource\PropelResourceTrait;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/front/mondial-relay-home-delivery-zone-configuration/{id}',
            name: 'api_mondialrelay_home_delivery_zone_configuration_get_front'
        ),
        new GetCollection(
            uriTemplate: '/front/mondial-relay-home-delivery-zone-configurations',
            name: 'api_mondialrelay_home_delivery_zone_configuration_get_collection_front'
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_FRONT_READ]]
)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/admin/mondial-relay-home-delivery-zone-configuration/{id}',
            name: 'api_mondialrelay_home_delivery_zone_configuration_get_admin'
        ),
        new GetCollection(
            uriTemplate: '/admin/mondial-relay-home-delivery-zone-configurations',
            name: 'api_mondialrelay_home_delivery_zone_configuration_get_collection_admin'
        ),
    ],
    normalizationContext: ['groups' => [self::GROUP_ADMIN_READ]]
)]
class MondialRelayHomeDeliveryZoneConfigurationResource implements PropelResourceInterface
{
    use PropelResourceTrait;

    public const GROUP_ADMIN_READ = 'admin:mondialrelay_home_delivery_zone_configuration:read';
    public const GROUP_FRONT_READ = 'front:mondialrelay_home_delivery_zone_configuration:read';

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $id = null;

    /**
     * @var int|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?int $areaId = null;

    /**
     * @var string|null
     */
    #[Groups([self::GROUP_ADMIN_READ, self::GROUP_FRONT_READ])]
    public ?string $deliveryTime = null;

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
     * @return string|null
     */
    public function getDeliveryTime(): ?string
    {
        return $this->deliveryTime;
    }

    /**
     * @param string|null $deliveryTime
     * @return void
     */
    public function setDeliveryTime(?string $deliveryTime): void
    {
        $this->deliveryTime = $deliveryTime;
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

    /**
     * @return TableMap|null
     */
    #[Ignore]
    public static function getPropelRelatedTableMap(): ?TableMap
    {
        return new MondialRelayHomeDeliveryZoneConfigurationTableMap();
    }
}
