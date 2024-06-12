<?php
class EmpresaCable{
    private $coleccionPlanes;
    private $coleccionContratos;

    public function __construct($coleccionContratos, $coleccionPlanes) {
        $this->coleccionPlanes = $coleccionContratos;
        $this->coleccionContratos = $coleccionPlanes;
    }
    public function getColeccionPlanes() {
        return $this->coleccionPlanes;
    }
    public function setColeccionPlanes($coleccionPlanes) {
        $this->coleccionPlanes = $coleccionPlanes;
    }
    public function getColeccionContratos() {
        return $this->coleccionContratos;
    }
    public function setColeccionContratos($coleccionContratos) {
        $this->coleccionContratos = $coleccionContratos;
    }

    public function incorporarPlan($objPlan){
        $i = 0; 
        $bandera = false; 
    
        $coleccionPlanes = $this->getColeccionPlanes();
    
        while($i < count($this->coleccionPlanes) && !$bandera){
            $j = 0; 
            while($j < count($coleccionPlanes[$i]) && !$bandera) {
                $plan = $coleccionPlanes[$i][$j];
                if ($plan->getColCanales() == $objPlan->getColCanales() && $plan->getIncluyeMG() == $objPlan->getIncluyeMG()) {
                    $bandera = true; 
                }
                $j++;
            }
            $i++; 
        }
        if (!$bandera) {
            $this->coleccionPlanes[] = $objPlan;
        }
    }

    public function incorporarContrato($objPlan, $objCliente, $fechaDesde, $fechaVenc, $esViaWeb) {
        if($esViaWeb){
            $nuevoContrato = new ContratoWeb($objPlan, $objCliente, $fechaDesde, $fechaVenc, $esViaWeb);
        }else{
            $nuevoContrato = new Contrato($fechaDesde, $fechaVenc, $objPlan,null,null,$objCliente);
        }

        $this->coleccionContratos[] = $nuevoContrato;
    }

    public function retornarImporteContratos($codigoPlan) {
        $sumaImportes = 0;
    
        foreach ($this->coleccionContratos as $contrato) {
            if ($contrato->getPlan()->getCodigo() == $codigoPlan) {
                $sumaImportes += $contrato->getImporte();
            }
        }

        return $sumaImportes;
    }

    
    public function pagarContratoYRetornarImporte($objContrato) {
        $objContrato->setEstado("pagado");
        return $objContrato->getImporte();
    }
    
    public function __toString(){
        return "Coleccion de planes: ".$this->getColeccionPlanes()."\n".
        "Coleccion de contratos: ".$this->getColeccionContratos()."\n";
    }
}


?>