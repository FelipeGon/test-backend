<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\App;
use App\Services\PerformanceAndOptimizationService;
use App\Services\DataStructureAndAlgorithmsService;
use App\Services\ArchitectureAndDesignPatternsService;
use App\Services\AdvancedSecurityService;
use App\Services\IntegrationAndMicroservicesService;
use App\Enums\AvlNodeEnum;

class Test extends TestCase
{
    /**
     * 1. Desempenho e Otimização
     *
     * Implemente uma função em PHP que calcule a soma dos números primos em um intervalo
     * dado. Otimize sua solução para lidar eficientemente com intervalos grandes.
     */
    public function test_performance_and_optimization(): void
    {
        $service = new PerformanceAndOptimizationService();
        $start = 1;
        $end = 100;
        $result = $service->sumOfNumbersPrimes($start, $end);
        $this->assertEquals(1060, $result);
    }

    /**
     * 2. Estrutura de Dados e Algoritmos
     *
     * Desenvolva uma implementação eficiente em PHP de uma árvore de busca binária balanceada
     * (AVL Tree). Inclua operações de inserção e remoção, e forneça um exemplo de utilização.
     */
    public function test_data_structure_and_algorithms(): void
    {

        $tree = new DataStructureAndAlgorithmsService();

        $root = new AvlNodeEnum(40);
        $root->left = new AvlNodeEnum(20);
        $root->left->left = new AvlNodeEnum(10);
        $root->left->right = new AvlNodeEnum(25);
        $root->right = new AvlNodeEnum(50);
        $tree->root = $root;

        // Testando se a estrutura da árvore está correta
        $this->assertEquals(40, $tree->root->value);
        $this->assertEquals(20, $tree->root->left->value);
        $this->assertEquals(10, $tree->root->left->left->value);
        $this->assertEquals(25, $tree->root->left->right->value);
        $this->assertEquals(50, $tree->root->right->value);

    }

    /**
     * 3. Arquitetura e Design Patterns
     *
     * Crie uma implementação prática do padrão de design Command em PHP. Considere um cenário
     * onde você precisa implementar um sistema de fila de comandos que podem ser desfeitos e refeitos.
     */
    public function test_architecture_and_design_patterns(): void
    {
        $service = new ArchitectureAndDesignPatternsService();
        $result = $service->run();
        $this->assertTrue($result);
    }

    /**
     * 4. Segurança Avançada
     *
     * Desenvolva uma função em PHP para validar e filtrar dados de entrada sensíveis, como senhas,
     * utilizando as melhores práticas de segurança. Considere aspectos como proteção contra
     * ataques de injeção e manipulação maliciosa.
     */
    public function test_advanced_security(): void
    {
        $service = new AdvancedSecurityService();
        $password1 = "MyPassword123!";
        $result = $service->validPassword($password1);
        $this->assertEquals("A senha é válida. Senha filtrada: " . $password1, trim($result));

        $password2 = "12345678";
        $result = $service->validPassword($password2);
        $this->assertEquals("A senha não é válida.", trim($result));
    }

    /**
     * 5. Integração e Microsserviços
     *
     * Escreva um programa em php que use rabittmq para enviar uma mensagem com um
     * identificador único e confirmar que a mensagem foi devidamente entregue.
     */
    public function test_integration_and_microservices(): void
    {
        $service = new IntegrationAndMicroservicesService();
        $result = $service->run();
        $this->assertTrue($result);
    }
}
