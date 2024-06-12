<?php
include 'EmpresaCable.php';
include 'Canal.php';
include 'Plan.php';
include 'Cliente.php';
include 'Contrato.php';
include 'ContratoWeb.php';

$clientes = [
    new Cliente("Cliente S.A.", "30-12345678-9", "Calle Falsa 123"),
    new Cliente("Empresa B", "30-87654321-0", "Avenida Siempre Viva 742"),
    new Cliente("Compañía C", "33-65432109-8", "Camino Largo 456")
];

$canal1 = new Canal("Deportivo", 150, true, false);
$canal2 = new Canal("Peliculas", 200, true, true);
$canal3 = new Canal("Musical", 100, false, false);



$planes = [
    new Plan(111, [$canal1, $canal2], 300, true),
    new Plan(222, [$canal2, $canal3], 250, false),
    new Plan(333, [$canal1, $canal3], 200, true)
];

$empresaCable = new EmpresaCable($clientes, $planes);

$contratoEmpresa = new Contrato("2023-04-01", "2023-10-01", $planes[0], 500, true, $clientes[0]);

$contratoWeb1 = new ContratoWeb("2023-04-01", "2023-10-01", $planes[1], 500 , true,$clientes[0], 15);
$contratoWeb2 = new ContratoWeb("2023-05-01", "2023-11-01", $planes[0], 500,true, $clientes[0],  10);

echo $contratoEmpresa->calcularImporte();
echo $contratoWeb1->calcularImporte();
echo $contratoWeb2->calcularImporte();

$empresaCable->incorporarPlan($planes[0]);

$empresaCable->incorporarPlan($planes[0]); 

$empresaCable->incorporarContrato($planes[0], $cliente[0], "2023-04-01", "2023-05-01", false);
$empresaCable->incorporarContrato($planes[1], $cliente[0], "2023-04-01", "2023-05-01", true);


$empresaCable->pagarContrato($contratoEmpresa);
$empresaCable->pagarContrato($contratoWeb1);

echo $empresaCable->retornarImporteContratos(111);
?>