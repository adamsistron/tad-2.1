<?php
$this->load->view('menu_3'); 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>Casos de Cambio de Clasificación</title>

		<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js');?>"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">        
    
    function verificaciones_4(anio,estatus){
        window.location.href = "<?php echo base_url('verificaciones/verificaciones_5');?>/"+anio+'/'+estatus;
    }
$(function () {
    
    //casos_2();
    
    $('#container_verificaciones_4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Casos de Cambio de Clasificación en los últimos <?php echo $anios; ?> años'
        },
        subtitle: {
            text: 'Fuente: SIEV'
        },
        xAxis: {
            categories: <?php echo $caterorias; ?>,
            title: {
                text: 'Años'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'N° de Cambio de Clasificación',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        tooltip: {
            valueSuffix: ' Cambio de Clasificación'
        },
        
        exporting: {
            buttons: {
                customButton: {
                    text: 'Ir al Inicio',
                    onclick: function () {
                        
                        //javascript:history.back(1);                
                        window.location.href = "<?php echo base_url('verificaciones/verificaciones_1');?>";
        //alert('You pressed the button!');
                    }
                }
            }
        },
        plotOptions: {
            column: {
                //stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black',
                    style: {
                        textShadow: '0 0 3px white, 0 0 3px white'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            //alert('Año: ' + this.category + ', N° Casos: ' + this.y + ', Estatus: ' + this.series.name);
                            verificaciones_4(this.category, this.series.name);
                        }
                    }
                }
            }
        },
        /*legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },*/
        credits: {
            enabled: false
        },
        series:  <?php echo $serie_data; ?>,
        colors: ['#2f7ed8', '#DF013A', '#8bbc21', '#F7FE2E', '#1aadce', 
   '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a']
    });
});


		</script>
	</head>
	<body>
<!--            
<script src="../Highcharts-4.0.4/js/highcharts.js"></script>
<script src="../Highcharts-4.0.4/js/modules/exporting.js"></script>-->
<script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/data.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/drilldown.js');?>"></script>
<!--<script src="../Highcharts-4.0.4/js/modules/data.js"></script>
<script src="../Highcharts-4.0.4/js/modules/drilldown.js"></script>-->

<div id="container_verificaciones_4" style="min-width: 300px; max-width: 90%; height: 500px;margin: 0 auto">p</div>




<pre id="tsv" style="display:none">BARIVEN*ORIENTE	1%
EXPLORACIÓN Y PRODUCCIÓN*ORIENTE	1%
INTEVEP*METROPOLITANA	1%
PDVSA*CENTRO-SUR	1%
PDVSA*COMERCIO Y SUMINISTRO	2%
PDVSA*OCCIDENTE	10%</pre>
	</body>
</html>
