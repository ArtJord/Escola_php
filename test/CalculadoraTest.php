<?php 

require_once 'Calculadora.php';

use PHPUnit\Framework\TestCase;

class CalculadoraTest extends TestCase {
    public function testSomaDoisNumeros() {
        $calculadora = new Calculadora();
        $resultado = $calculadora->somar(2, 3);

        
        $this->assertEquals(5, $resultado);
    }
}