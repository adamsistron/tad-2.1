<?php
//$this->load->view('menu_2');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>Verificaciones por Año</title>

		<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>
                
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
                <?php 
                
                $estatus_1='';
                $search='%20';
                $replace=' ';
                $subject= $estatus;
                $estatus_1= rawurldecode($subject);
                $org = rawurldecode($org);
                $filial=rawurldecode($filial);
                ?>
                    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Verificaciones con estatus <?php echo $estatus_1; ?> de <?php echo $anio; ?>  por Verificadores de <?php echo $org; ?> / <?php echo $filial; ?>'
        },
        subtitle: {
            text: 'Fuente: SIEV'
        },
        xAxis: {
            type: 'category',
            labels: {rotation:315
                
            },
            title: {
                text: 'Verificadores'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nro de Verificaciones'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Verificaciones <?php echo $estatus_1; ?>  en <?php echo $anio; ?> <b></b>'
        },  
        
        exporting: {
            buttons: {
                customButton: {
                    text: 'Atrás',
                    onclick: function () {
        javascript:history.back(1);                
        //window.location.href = "<?php echo base_url('verificaciones/verificaciones_1');?>";
                    }
                }
            }
        },
        
        plotOptions: {
            series: {
                borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:f}'
                    },
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        if (this.series != null) {                    
                            //desc_estado
                            verificaciones_3($("#anio").val(),$("#estatus").val(),this.name);
                            //verificaciones_3('2014','APTO','DELUCAL');
                        }
                    }
                }
            }
            }
        },        
        
        credits: {
            enabled: false
        },
        series: [{
            name: 'Verificadores',
            data: [<?php echo $serie_data;?>],
            dataLabels: {
                enabled: true,

            }
        }]
    });
});

function verificaciones_3(anio, estatus, id_usuario){
        
        //$("#cargando").show();
       // $("#tabla").hide("slow");
        
        $.ajax({
        url:"<?php echo base_url('verificaciones/verificaciones_3');?>",
        type: "POST",
        data:{
        anio:anio,estatus:estatus,id_usuario:id_usuario
        },
        success: function(data) {
            $("#tabla").empty();
            $("#tabla").append(data);
       
        }});
    
        //$("#cargando").hide();
        $("#tabla").show();
        } 

		</script>
	</head>
	<body>
<input type="hidden" id="anio" value="<?php echo $anio; ?>"/>
<input type="hidden" id="estatus" value="<?php echo $estatus_1; ?>"/>     


    <div id="container" style="min-width: 300px; max-width: 90%; height: 400px;margin: 0 auto"></div>
    <div id="tabla" style="min-width: 300px; max-width: 90%; height: 600px;margin: 0 auto"></div>
    
</body>
</html>
