<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class geralController extends Controller {
    
    private $iAb;
    private $iAltura;
    private $iTipoTinta;
    private $iAreaLateral;
    private $iAreaBase;
    private $iAreaTriangulo;
    private $iAreaTotal;
    private $iLitrosNecessarios;
    private $iQuantidadeLatas;
    private $iVolume;
    private $iPrecoFinal;

    const LATA_TIPO_1 = 127.90,
          LATA_TIPO_2 = 258.98,
          LATA_TIPO_3 = 344.34;

    public function getDadosEntrada($iAltura, $iAb, $iTipoTinta){
        $this->iAb        = $iAb;
        $this->iAltura    = $iAltura;
        $this->iTipoTinta = $iTipoTinta;

        $this->setAreaLateral();
        $this->setAreaBase();
        $this->setAreaTriangulo();
        $this->setAreaTotal();
        $this->quantidadeTinta();

        return $this->getDados();
    }
    
    private function setAreaLateral(){
        $iAlturaQuadrado = $this->iAltura * $this->iAltura;
        $iAbQuadrado     = $this->iAb * $this->iAb;

        $this->iAreaLateral = sqrt(($iAlturaQuadrado + $iAbQuadrado));
    }

    private function setAreaTotal(){
        $this->iAreaTotal = $this->iAreaBase + ($this->iAreaTriangulo * 4);
    }

    private function setAreaTriangulo(){
        $this->iAreaTriangulo = $this->iAb * $this->iAreaLateral;
    }

    private function setAreaBase(){
        $this->iAreaBase = ($this->iAb * $this->iAb) * 4;
    }

    private function setVolume(){
        $this->iVolume = ($this->iAreaBase *  $this->iAltura)/3;
    }

    private function setQuantidadeLitros(){
        $this->iLitrosNecessarios = $this->iAreaTotal / 4.76;
    }

    private function setQuantidadeLatas(){
        $this->iQuantidadeLatas = ceil($this->iLitrosNecessarios/18);
    }

    private function calculaDadosTinta(){
        $this->setQuantidadeLitros();
        $this->setQuantidadeLatas();
    }

    private function calculaPrecoTotal($iValorLata){
        $this->iPrecoFinal = $this->iQuantidadeLatas * $iValorLata;
    }

    private function quantidadeTinta(){
        $this->setVolume();
        $this->calculaDadosTinta();

        switch ($this->iTipoTinta) {
            case 1:
                $iValorLata = self::LATA_TIPO_1;
                break;
            case 2:
                $iValorLata = self::LATA_TIPO_2;
                break;
            case 3:
                $iValorLata = self::LATA_TIPO_3;
                break;
        }
        $this->calculaPrecoTotal($iValorLata);
    }

    private function getDados(){
        return " ab: {$this->iAb}                <br>
                  h: {$this->iAltura}            <br>
                 a1: {$this->iAreaLateral}       <br>
     Area Triângulo: {$this->iAreaTriangulo}     <br>
          Area Base: {$this->iAreaBase}          <br>
         Area Total: {$this->iAreaTotal}         <br>
      Tipo de Tinta: {$this->iTipoTinta}         <br>
             Litros: {$this->iLitrosNecessarios} <br>
              Latas: {$this->iQuantidadeLatas}   <br>
              Preço: {$this->iPrecoFinal}        <br>
             Volume: {$this->iVolume} ";
    }
}
