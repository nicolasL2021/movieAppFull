<?php

namespace App\Entity;

use App\Repository\XmlFileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: XmlFileRepository::class)]
class XmlFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private $XmlFilename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setXmlFileName($XmlFilename)
    {
        $this->XmlFilename = $XmlFilename;
        return $this;
    }

    public function getXmlFileName(): string
    {
        return $this->XmlFilename;
    }
}
