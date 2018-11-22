<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Message;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class AddUser
{
    /**
     * @Assert\Length(min=2, max=50)
     *
     * @var string
     */
    private $username;

    /**
     * @Assert\NotBlank
     *
     * @var string
     */
    private $fullName;

    /**
     * @Assert\Email
     *
     * @var email
     */
    private $email;

    /**
     * @Assert\Length(min=5, max=BCryptPasswordEncoder::MAX_PASSWORD_LENGTH)
     *
     * @var string
     */
    private $plainPassword;

    /**
     * @var array
     */
    private $roles = [];

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
