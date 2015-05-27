<?php
//$this->load->view('menu');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>Estatus de Casos</title>

		<script type="text/javascript" src="<?php echo base_url('js/jquery.min_1.js');?>"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
    function casos_2(anio,estatus){
        window.location.href = "<?php echo base_url('casos/casos_2');?>/"+anio+'/'+estatus;
    }
$(function () {
    
    //casos_2();
    
    $('#container_casos_1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estatus de Casos de Investigación últimos <?php echo $anios; ?> años'
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
                text: 'N° de Casos',
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
            valueSuffix: ' Casos'
        },

        plotOptions: {
            column: {
                //stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: 'black',
                    //y: 18,
                    style: {
                        fontSize: '13px',
                        //fontWeight: 'bolder',
                        //fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px white'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            //alert('Año: ' + this.category + ', N° Casos: ' + this.y + ', Estatus: ' + this.series.name);
                            casos_2(this.category, this.series.name);
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
        exporting: {
            enabled: true
        },
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

<script src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
<script src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>


<div id="container_casos_1" style="min-width: 300px; max-width: 90%; height: 500px;margin: 0 auto"></div>

</html>

