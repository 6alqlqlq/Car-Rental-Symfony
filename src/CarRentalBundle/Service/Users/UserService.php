<?php


namespace CarRentalBundle\Service\Users;


use CarRentalBundle\Entity\User;
use CarRentalBundle\Repository\UserRepository;
use CarRentalBundle\Service\Users\UserServiceInterface;
use Symfony\Component\Security\Core\Security;


class UserService implements UserServiceInterface
{
    private $security;
    private $userRepository;

    public function __construct(Security $security,UserRepository $userRepository){
        $this->security=$security;
        $this->userRepository=$userRepository;

    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email'=>$email]);
    }

    public function findOneById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function findOne(User $user): ?User
    {
        return $this->userRepository->find($user);
    }

    /**
     * @return null|User|object
     */
    public function currentUser(): ?User
    {
        return $this->security->getUser();
    }

    public function update(User $user): bool
    {
        return $this->userRepository->update($user);
    }
}