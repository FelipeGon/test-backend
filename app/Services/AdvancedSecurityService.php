<?php

namespace App\Services;

use App\Validators\PasswordValidator;

class AdvancedSecurityService
{
    /**
     *
     * @return ?string
     */
    public function validPassword(?string $password): ?string
    {
        $passwordValidator = new PasswordValidator();
        if ($passwordValidator->validatePassword($password)) {
            $filteredPassword = $passwordValidator->filterPassword($password);
            return "A senha é válida. Senha filtrada: $filteredPassword\n";
        } else {
            return "A senha não é válida.\n";
        }
    }
}
