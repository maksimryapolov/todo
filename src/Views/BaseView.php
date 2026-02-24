<?php

declare(strict_types=1);

namespace App\Views;

use App\Entity\IEntity;

abstract class BaseView
{
    /**
     * @param IEntity $entity
     * @return array
     */
    abstract protected function getEntitySpecificData(IEntity $entity): array;

    /**
     * @param IEntity $entity
     * @return array
     */
    public function getListData(IEntity $entity): array
    {
        $baseData = $this->getBaseListData($entity);
        $customData = $this->getEntitySpecificData($entity);
        return array_merge($baseData, $customData);
    }

    /**
     * @param IEntity $entity
     * @return array{
     *     id: int,
     *     name: string,
     *     slug: string
     * }
     */
    private function getBaseListData(IEntity $entity): array
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'slug' => $entity->getCode(),
        ];
    }
}
