<?php

namespace App\Services;

use App\Enums\AvlNodeEnum;

class DataStructureAndAlgorithmsService
{
    public $root;

    // Retorna a altura de um nó
    private function height($node) {
        if ($node === null) {
            return 0;
        }
        return $node->height;
    }

    // Retorna o fator de balanceamento de um nó
    private function balanceFactor($node) {
        return $this->height($node->left) - $this->height($node->right);
    }

    // Atualiza a altura de um nó
    private function updateHeight($node) {
        $node->height = max($this->height($node->left), $this->height($node->right)) + 1;
    }

    // Realiza a rotação para a direita
    private function rotateRight($y) {
        $x = $y->left;
        $temp = $x->right;

        $x->right = $y;
        $y->left = $temp;

        $this->updateHeight($y);
        $this->updateHeight($x);

        return $x;
    }

    // Realiza a rotação para a esquerda
    private function rotateLeft($x) {
        $y = $x->right;
        $temp = $y->left;

        $y->left = $x;
        $x->right = $temp;

        $this->updateHeight($x);
        $this->updateHeight($y);

        return $y;
    }

    // Insere um valor na árvore
    public function insert($value) {
        $this->root = $this->insertRecursive($this->root, $value);
    }

    private function insertRecursive($node, $value) {
        if ($node === null) {
            return new AvlNodeEnum($value);
        }

        if ($value < $node->value) {
            $node->left = $this->insertRecursive($node->left, $value);
        } elseif ($value > $node->value) {
            $node->right = $this->insertRecursive($node->right, $value);
        } else {
            return $node; // Valor já existe
        }

        // Atualiza a altura do nó atual
        $this->updateHeight($node);

        // Verifica e realiza as rotações necessárias para balancear a árvore
        $balance = $this->balanceFactor($node);

        // Caso de desbalanceamento à esquerda
        if ($balance > 1 && $value < $node->left->value) {
            return $this->rotateRight($node);
        }
        // Caso de desbalanceamento à direita
        if ($balance < -1 && $value > $node->right->value) {
            return $this->rotateLeft($node);
        }
        // Caso de desbalanceamento esquerda-direita
        if ($balance > 1 && $value > $node->left->value) {
            $node->left = $this->rotateLeft($node->left);
            return $this->rotateRight($node);
        }
        // Caso de desbalanceamento direita-esquerda
        if ($balance < -1 && $value < $node->right->value) {
            $node->right = $this->rotateRight($node->right);
            return $this->rotateLeft($node);
        }

        return $node;
    }

    // Remove um valor da árvore
    public function remove($value) {
        $this->root = $this->removeRecursive($this->root, $value);
    }

    private function removeRecursive($node, $value) {
        if ($node === null) {
            return $node;
        }

        if ($value < $node->value) {
            $node->left = $this->removeRecursive($node->left, $value);
        } elseif ($value > $node->value) {
            $node->right = $this->removeRecursive($node->right, $value);
        } else {
            if ($node->left === null || $node->right === null) {
                $node = ($node->left === null) ? $node->right : $node->left;
            } else {
                $minRight = $this->minValueNode($node->right);
                $node->value = $minRight->value;
                $node->right = $this->removeRecursive($node->right, $minRight->value);
            }
        }

        if ($node === null) {
            return $node;
        }

        $this->updateHeight($node);

        $balance = $this->balanceFactor($node);

        if ($balance > 1 && $this->balanceFactor($node->left) >= 0) {
            return $this->rotateRight($node);
        }
        if ($balance > 1 && $this->balanceFactor($node->left) < 0) {
            $node->left = $this->rotateLeft($node->left);
            return $this->rotateRight($node);
        }
        if ($balance < -1 && $this->balanceFactor($node->right) <= 0) {
            return $this->rotateLeft($node);
        }
        if ($balance < -1 && $this->balanceFactor($node->right) > 0) {
            $node->right = $this->rotateRight($node->right);
            return $this->rotateLeft($node);
        }

        return $node;
    }

    // Encontra o nó com o menor valor
    private function minValueNode($node) {
        $current = $node;
        while ($current->left !== null) {
            $current = $current->left;
        }
        return $current;
    }

    // Exibe a árvore em ordem
    public function inorder() {
        $this->inorderRecursive($this->root);
    }

    private function inorderRecursive($node) {
        if ($node !== null) {
            $this->inorderRecursive($node->left);
            $this->inorderRecursive($node->right);
        }
    }
}
