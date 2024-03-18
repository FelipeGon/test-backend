<?php

namespace App\Validators;

class PasswordValidator
{
    // Método para validar senha
    public static function validatePassword($password)
    {
        // Verifica se a senha tem pelo menos 8 caracteres
        if (strlen($password) < 8) {
            return false;
        }

        // Verifica se a senha contém pelo menos uma letra maiúscula
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Verifica se a senha contém pelo menos uma letra minúscula
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Verifica se a senha contém pelo menos um número
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // Verifica se a senha contém pelo menos um caractere especial
        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
            return false;
        }

        return true;
    }

    // Método para filtrar uma senha (remover espaços em branco e caracteres especiais)
    public static function filterPassword($password) {
        // Remove espaços em branco no início e no final da senha
        $password = trim($password);
        
        // Remove caracteres especiais
        $password = preg_replace('/[^A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>]/', '', $password);

        return $password;
    }
}
