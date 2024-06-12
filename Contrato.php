<?php

class Contrato{
    
  
    private $fechaInicio;   
    private $fechaVencimiento;
    private $objPlan;
    private $estado;  
    private $costo;
    private $seRennueva;
    private $objCliente;

    public function __construct($fechaInicio, $fechaVencimiento, $objPlan,$costo,$seRennueva,$objCliente){
    
       $this->fechaInicio = $fechaInicio;
       $this->fechaVencimiento = $fechaVencimiento;
       $this->objPlan = $objPlan;
       $this->estado = 'AL DIA';
       $this->costo = $costo;
       $this->seRennueva = $seRennueva;
       $this->objCliente = $objCliente;
           

    }


    public function getFechaInicio(){
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio){
         $this->fechaInicio= $fechaInicio;
    }

    public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento){
         $this->fechaVencimiento= $fechaVencimiento;
    }


    public function getObjPlan(){
        return $this->objPlan;
    }

    public function setObjPlan($objPlan){
         $this->objPlan= $objPlan;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
         $this->estado= $estado;
    }

    public function getCosto(){
       return $this->costo;
    }

    public function setCosto($costo){
         $this->costo= $costo;
    }

     public function getSeRennueva(){
        return $this->seRennueva;
    }

    public function setSeRennueva($seRennueva){
         $this->seRennueva= $seRennueva;
    }


    public function getObjCliente(){
        return $this->objCliente;
    }

    public function setObjCliente($objCliente){
         $this->objCliente= $objCliente;
    }

    public function diasContratoVencido() {
        $diasVencidos = 0; 
        $fechaActual = new DateTime(); 
        $fechaVencimiento = new DateTime($this->fechaVencimiento); 
    
       
        if ($fechaActual > $fechaVencimiento) {
            $intervalo = $fechaVencimiento->diff($fechaActual); 
            $diasVencidos = $intervalo->days; 
        }
    
  
        return $diasVencidos;
    }


     public function actualizarEstadoContrato() {
     $fechaActual = new DateTime(); 
     $fechaVencimiento = new DateTime($this->fechaVencimiento); 

     if ($fechaActual > $fechaVencimiento) { 
          $intervalo = $fechaVencimiento->diff($fechaActual); 
          $diasVencidos = $intervalo->days;

          if ($diasVencidos > 10) {
               $this->estado = 'SUSPENDIDO'; 
          } else {
               $this->estado = 'MOROSO'; 
          }
        } else {
          $this->estado = 'AL DIA'; 
            }
     }

     public function calcularImporte() {
          $importeFinal = $this->objPlan->getImporte(); 
          foreach ($this->objPlan->getColCanales() as $canal) {
              $importeFinal += $canal->getImporte(); 
          }
          return $importeFinal;
      }

      public function __toString(){
        $cadena = "Fecha inicio: ".$this->getFechaInicio()."\n";
        $cadena = "Fecha Vencimiento: ".$this->getFechaVencimiento()."\n";
        $cadena = $cadena. "Plan: ".$this->getObjPlan()."\n";
        $cadena = $cadena. "Estado: ".$this->getEstado()."\n";
        $cadena = $cadena. "Costo: ".$this->getCosto()."\n";
        $cadena = $cadena. "Se renueva: ".$this->getSeRennueva()."\n";
        $cadena = $cadena. "Cliente: ".$this->getObjCliente()."\n";

 
        return $cadena;
     }
}