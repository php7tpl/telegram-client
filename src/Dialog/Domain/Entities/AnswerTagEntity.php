<?php

namespace App\Dialog\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class AnswerTagEntity implements ValidateEntityInterface, EntityIdInterface
{

    private $id = null;

    private $tagId = null;

    private $answerId = null;

    public function validationRules()
    {
        return [
            /*'id' => [
                new Assert\NotBlank,
            ],
            'tagId' => [
                new Assert\NotBlank,
            ],
            'answerId' => [
                new Assert\NotBlank,
            ],*/
        ];
    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTagId($value) : void
    {
        $this->tagId = $value;
    }

    public function getTagId()
    {
        return $this->tagId;
    }

    public function setAnswerId($value) : void
    {
        $this->answerId = $value;
    }

    public function getAnswerId()
    {
        return $this->answerId;
    }


}

