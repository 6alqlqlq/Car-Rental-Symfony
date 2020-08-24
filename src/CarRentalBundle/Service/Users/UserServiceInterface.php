<?php


namespace CarRentalBundle\Service\Users;


use CarRentalBundle\Entity\User;

interface UserServiceInterface
{
    public function findOneByEmail(string $email): ?User;

    public function findOneById(int $id): ?User;

    public function findOne(User $user): ?User;

    public function currentUser(): ?User;

    public function update(User $user) :bool;


}