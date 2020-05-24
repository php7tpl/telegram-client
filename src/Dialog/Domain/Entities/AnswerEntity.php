<?php

namespace App\Dialog\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use PhpLab\Core\Domain\Interfaces\Entity\ValidateEntityInterface;
use PhpLab\Core\Domain\Interfaces\Entity\EntityIdInterface;

class AnswerEntity implements ValidateEntityInterface, EntityIdInterface
{

    private $id = null;
    private $requestText = null;

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequestText()
    {
        return $this->requestText;
    }

    public function setRequestText($requestText): void
    {
        $this->requestText = $requestText;
    }

    public function validationRules()
    {
        return [
            /*'id' => [
                new Assert\NotBlank,
            ],*/
        ];
    }

}
