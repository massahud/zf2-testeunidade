<?php

use Calc\Model\Calculadora;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-01-05 at 14:09:17.
 * @group unidade
 * @small
 */
class CalculadoraTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Calculadora
     */
    protected $calculadora;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->calculadora = new Calculadora();
    }

    public function teclasValidasProvider() {
        return [
            array_merge(Calculadora::NUMEROS, Calculadora::OPERACOES, array(Calculadora::IGUAL))
        ];
    }

    public function numerosProvider() {
        return [Calculadora::NUMEROS];
    }

    public function operacoesProvider() {
        return [Calculadora::OPERACOES];
    }

    /**
     * @test
     */
    public function displayDeveSerVazioAoCriar() {
        Assert\that($this->calculadora->getDisplay())->string()->eq('');
    }

    /**
     * @test
     */
    public function registradorDeveConter0AoCriar() {
        Assert\that($this->calculadora->getRegistrador())->isArray()->noContent();
    }

    /**
     * @test
     * @dataProvider numerosProvider
     */
    public function teclaDeveMostrarNumeroTeclado($numero) {
        $this->calculadora->tecla($numero);
        Assert\that($this->calculadora->getDisplay())->eq($numero);
    }

    /**
     * @test
     * @dataProvider teclasValidasProvider
     */
    public function teclaDeveRetornarAPropriaCalculadora($tecla) {
        Assert\that($this->calculadora->tecla($tecla))->same($this->calculadora);
    }

    /**
     * @test
     */
    public function teclaDeveFazerAppendDeNumerosConsecutivos() {
        $this->calculadora->tecla(2)->tecla(4)->tecla(1);
        Assert\that($this->calculadora->getDisplay())->eq('241');
    }

    /**
     * @test
     * @dataProvider operacoesProvider
     * @covers Calc\Model\Calculadora::tecla
     */
    public function teclaPrimeiraOperacaoDeveColocarValorAtualEAPropriaOperacaoNoRegistrador($operacao) {
        $this->calculadora->tecla(4)->tecla(0)->tecla(7);
        $this->calculadora->tecla($operacao);
        Assert\that($this->calculadora->getRegistrador()[0])->eq(407);
        Assert\that($this->calculadora->getRegistrador()[1])->eq($operacao);
    }

}
