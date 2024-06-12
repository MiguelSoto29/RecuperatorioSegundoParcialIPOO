<?php

class ContratoWeb extends Contrato {
    private $porcentajeDescuento;

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente, $porcentajeDescuento) {
        parent::__construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente);
        $this->porcentajeDescuento = $porcentajeDescuento !== null ? $porcentajeDescuento : 10;
    }

    public function getPorcentajeDescuento() {
        return $this->porcentajeDescuento;
    }

    public function setPorcentajeDescuento($porcentajeDescuento) {
        $this->porcentajeDescuento = $porcentajeDescuento;
    }

    public function calcularImporte() {

        $importeBase = parent::calcularImporte();

        $descuento = ($importeBase * $this->getPorcentajeDescuento()) / 100;
        $importeFinalConDescuento = $importeBase - $descuento;

        return $importeFinalConDescuento;
    }

    public function __toString() {
        return parent::__toString() . " | Porcentaje de descuento: " . $this->porcentajeDescuento;
    }


}