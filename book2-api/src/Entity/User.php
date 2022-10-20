<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Components\User\FullNameDto;
use App\Controller\UserCreateAction;
use App\Controller\UserFullNameAction;
use App\Controller\UserGetAdoultAction;
use App\Controller\UserGetMaxAgeAction;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource( operations: [
    new Get(),
    new Delete(),
    new GetCollection(),
    new Post(
        uriTemplate: '/users/my',
        controller: UserCreateAction::class,
        name: 'createUser'
    ),
    new Post(
        uriTemplate: '/users/full-name',
        controller: UserFullNameAction::class,
        input: FullNameDto::class,
        name: 'full-name'
    ),
    new Post(
        uriTemplate: '/users/auth',
        denormalizationContext: ['groups' => 'user:auth']
    ),
    new GetCollection(
        uriTemplate: '/max-age',
        controller: UserGetMaxAgeAction::class,
        name: 'getMaxAge'
    ),
    new GetCollection(
        uriTemplate: '/adults',
        controller: UserGetAdoultAction::class,
        name: 'getAdultAge'
    )],
    normalizationContext: ['groups' => 'user:read'],
    denormalizationContext: ['groups' => 'user:write']
)]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email]
    #[Groups(['user:write', 'user:read', 'user:auth'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:write', 'user:auth'])]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private ?int $age = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function getUserIdentifier(): string
    {
        return (string)$this->getId();
    }
    public function getUsername(): string
    {
        return $this->getEmail();
    }
}
