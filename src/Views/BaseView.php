<?php

declare(strict_types=1);

namespace App\Views;

use App\Entity\IEntity;

abstract class BaseView
{
    /**
     */
    abstract protected function getEntitySpecificData(IEntity $entity): array;

    /**
     */
    public function getListData(IEntity $entity): array
    {
        $baseData = $this->getBaseListData($entity);
        $customData = $this->getEntitySpecificData($entity);
        return array_merge($baseData, $customData);
    }

    /**
     * @return array{
     *     id: int,
     *     name: string,
     *     slug: string
     * }
     */
    private function getBaseListData(IEntity $entity)
    {
        return [
            'id' => $entity->getId(),
            'name' => $entity->getName(),
            'slug' => $entity->getCode(),
        ];
    }
}
