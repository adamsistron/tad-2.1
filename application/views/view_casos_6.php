<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>Estatus de Casos</title>

		<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js');?>"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
                    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Population',
            data: [<?php echo $serie_data;?>],
            dataLabels: {
                enabled: true,

            }
        }]
    });
});
		</script>
	</head>
	<body>
            
<script src="../Highcharts-4.0.4/js/highcharts.js"></script>
<script src="../Highcharts-4.0.4/js/modules/exporting.js"></script>

    <div id="container" style="min-width: 300px; max-width: 90%; height: 600px;margin: 0 auto"></div>


</html>
