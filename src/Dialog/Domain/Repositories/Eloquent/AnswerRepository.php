<?php

namespace App\Dialog\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use App\Dialog\Domain\Entities\AnswerEntity;
use App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface;

class AnswerRepository extends BaseEloquentCrudRepository implements AnswerRepositoryInterface
{

    public function tableName() : string
    {
        return 'dialog_answer';
    }

    public function getEntityClass() : string
    {
        return AnswerEntity::class;
    }


}

