<?php

namespace App\Dialog\Domain\Repositories\Eloquent;

use App\Dialog\Domain\Entities\AnswerTagEntity;
use App\Dialog\Domain\Interfaces\Repositories\AnswerTagRepositoryInterface;
use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Helpers\EntityHelper;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;

class AnswerTagRepository extends BaseEloquentCrudRepository implements AnswerTagRepositoryInterface
{

    public function tableName(): string
    {
        return 'dialog_answer_tag';
    }

    public function getEntityClass(): string
    {
        return AnswerTagEntity::class;
    }

    public function relations()
    {
        return [

        ];
    }

    public function allByTagIds(array $tagIds): Collection
    {
        $array = $this->getQueryBuilder()
            ->select(['answer_id'])
            ->whereIn('tag_id', $tagIds)
            ->groupBy(['answer_id'])
            ->havingRaw('COUNT(*) = ' . count($tagIds))
            ->get();
        $entityClass = $this->getEntityClass();
        $collection = EntityHelper::createEntityCollection($entityClass, $array->toArray());
        return $collection;
    }

}
