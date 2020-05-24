<?php

namespace App\Dialog\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use App\Dialog\Domain\Entities\TagEntity;
use App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface;

class TagRepository extends BaseEloquentCrudRepository implements TagRepositoryInterface
{

    public function tableName() : string
    {
        return 'dialog_tag';
    }

    public function getEntityClass() : string
    {
        return TagEntity::class;
    }

    public function relations()
    {
        return [

        ];
    }

}
