<?php
class ReporteCompromisosController {
    public function mostrar(){
        require_once 'models/reporteCompromiso.php';
        $reporteCompromisoc = new ReporteCompromiso();
        $reporteCompromisos = $reporteCompromisoc->mostrarReporteCompromiso(intval($_GET['fila']));
        require_once 'views/compromiso/mostrarReporte.php';
    }
}
?>