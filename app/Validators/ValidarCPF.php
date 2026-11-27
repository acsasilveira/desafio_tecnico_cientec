<?php

namespace Acsa\SistemaCidadao\Validators;

class ValidarCPF{

    public function validar(string $cpf): bool{
        $digitos = preg_replace('/\D/', '', $cpf);

        if ($digitos === null || strlen($digitos) !== 11) {
            return false;
        }

        if (preg_match('/^(\d)\1{10}$/', $digitos)) {
            return false;
        }

        for ($qtdDigitos = 9; $qtdDigitos < 11; $qtdDigitos++) {
            $soma = 0;

            for ($indice = 0; $indice < $qtdDigitos; $indice++) {
                $soma += (int) $digitos[$indice] * (($qtdDigitos + 1) - $indice);
            }

            $dv = ((10 * $soma) % 11) % 10;

            if ((int) $digitos[$qtdDigitos] !== $dv) {
                return false;
            }
        }

        return true;

    }
}

?>