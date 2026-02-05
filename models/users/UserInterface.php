<?php


namespace models\users;

//Pas de propriétés dans une interface: seulement des constantes et des methodes
interface UserInterface
{
    public function UserRegister(string $email, string $password, string $role = "user"): bool;
    public function UserLogin(string $email, string $password): bool;
    public function ChangeAccountStatus(int $user_id, bool $account_status): bool;
    public function AssignRole(int $user_id, string $role);
    public function ResetPassword();
    public function UpdatePassword(string $email);
    public function DeleteUserAccount();
    public function GetAllUsers(): array;

}