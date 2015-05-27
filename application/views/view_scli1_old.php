<?php
$this->load->view('menu');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Sistema de Control de LLenaderos</title>
                
                <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js');?>"></script>
                <style type="text/css">
		</style>
		<script type="text/javascript">
$(function () {

    $('#container').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Velocidad de Despachos en <?php echo $dato1[0]; ?>',
            margin: 10,
            style: {
                    color: '#1F2B37',
                    fontSize: '13px'        
                    }
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        credits: {
            enabled: false
        },
        // the value axis
        yAxis: {
            min: 0,
            max: 120,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: ''
            },
            plotBands: [{
                from: 0,
                to: 50,
                color: '#DF5353' // green #DF5353
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D' // yellow
            }, {
                from: 75,
                to: 100,
                color: '#55BF3B' // red
            }]
        },

        series: [{
            name: 'Velocidad',
            data: [<?php echo $dato1[1]; ?> ],
            tooltip: {
                valueSuffix: ' '
            }
        }]

    },
    
        // Add some life
        function (chart) {
            if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
                        newVal,
                        inc = 0;

                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 200) {
                        newVal = point.y - inc;
                    }

                    point.update(newVal);

                }, 3000);
            }
        });
});
$(function () {

    $('#container2').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Avance / Historico en  <?php echo $dato1[0]; ?>',
            margin: 10,
            style: {
                    color: '#1F2B37',
                    fontSize: '13px'        
                    }
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        credits: {
            enabled: false
        },
        // the value axis
        yAxis: {
            min: 0,
            max: 120,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: ''
            },
            plotBands: [{
                from: 0,
                to: 50,
                color: '#DF5353' // green #DF5353
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D' // yellow
            }, {
                from: 75,
                to: 100,
                color: '#55BF3B' // red
            }]
        },

        series: [{
            name: 'Velocidad',
            data: [<?php echo $dato2; ?> ],
            tooltip: {
                valueSuffix: ' '
            }
        }]

    },
    
        // Add some life
        function (chart) {
            if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
                        newVal,
                        inc = 0;

                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 200) {
                        newVal = point.y - inc;
                    }

                    point.update(newVal);

                }, 3000);
            }
        });
});
$(function () {

    $('#container3').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Avance / Programado en  <?php echo $dato1[0]; ?>',
            margin: 10,
            style: {
                    color: '#1F2B37',
                    fontSize: '13px'        
                    }
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        credits: {
            enabled: false
        },           
        // the value axis
        yAxis: {
            min: 0,
            max: 120,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: ''
            },
            plotBands: [{
                from: 0,
                to: 50,
                color: '#DF5353' // green #DF5353
            }, {
                from: 50,
                to: 75,
                color: '#DDDF0D' // yellow
            }, {
                from: 75,
                to: 100,
                color: '#55BF3B' // red
            }]
        },

        series: [{
            name: 'Velocidad',
            data: [<?php echo $dato3; ?> ],
            tooltip: {
                valueSuffix: ''
            }
        }]

    },
    
        // Add some life
        function (chart) {
            if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
                        newVal,
                        inc = 0;

                    newVal = point.y + inc;
                    if (newVal < 0 || newVal > 200) {
                        newVal = point.y - inc;
                    }

                    point.update(newVal);

                }, 3000);
            }
        });
});
$(function () {
   
    $('#container4').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Volumen de Despacho por Producto',
            margin: 10,
            style: {
                    color: '#1F2B37',
                    fontSize: '13px'        
                    }
        },
        subtitle: {
            text: 'Fuente: SCLI'
        },
        xAxis: {
            categories: ['Productos'],
            title: {
                text: 'Productos'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Volumen de Despacho (BLS)',
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
            valueSuffix: ' Despachados'
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
                        //textShadow: '0 0 3px black'
                    }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            alert(this.category+this.series.name);
                            //nomina_lenel(this.series.name);
                        }
                    }
                }
            }
        },
        exporting: {
            enabled: true
        },
        credits: {
            enabled: false
        },
        series:  <?php echo $serie_data; ?>,
        colors: ['#5a99e0', '#d8352f', '#1d9d63', '#ff692a', '#1aadce', 
   '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a']
    });
  
});
$(function () {
    $('#container5').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Despacho / Historico',
            style: {
                    color: '#1F2B37',
                    fontSize: '13px'        
                    }
        },
        xAxis: {
            categories: ['<?php echo $dato1[0]; ?>']
        },
        yAxis: [{
            min: 0,
            title: {
                text: 'UTC'
            }
        
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },        
        series: [{
            name: 'Historico',
            color: 'rgba(165,170,217,1)',
            data: [<?php echo $historico; ?>],
            pointPadding: 0.3,
            pointPlacement: -0.2
        }, {
            name: 'Despachado',
            color: 'rgba(126,86,134,.9)',
            data: [<?php echo $despachado; ?>],
            pointPadding: 0.4,
            pointPlacement: -0.2
        }]
    });
}); 
function update_chart(){

     planta= $('#planta').val();
   
   $.post("<?php echo base_url('scli/scli_2');?>", {planta:planta}, function(data){
        alert(data.series_data[5]);

        if('ok'=='ok'){
          
       //  var chart = $('#container').highcharts();   
        // chart.series[0].setData(data.series_data[2]);
        // chart.redraw();
         $('#container').highcharts().title.text=data.series_data[5];
         $('#container').highcharts().redraw();
        // $('#container2').highcharts().series[0].setData(data.series_data[3]);
         //$('#container3').highcharts().series[0].setData(data.series_data[4]);
         //$('#container4').highcharts().series[0].setData(<?php //echo $serie_data; ?>);
         //$('#container5').highcharts().series[0].setData(data.series_data[0]);
         //$('#container5').highcharts().series[1].setData(data.series_data[1]);
         
        }
        else{
        alert(data.mensaje_error);
    }
    },"json");
           
 }
 function scli_1(){
        
 //var e = document.getElementById("MySelectOption");
 //alert($('#planta').val());
         planta= $('#planta').val();    
              $.ajax({
                url:"<?php echo base_url('scli/scli_2');?>",
                type: "POST",
                data:{planta:planta},
                success: function(response) {
                   alert(response);
                }
            });
    
           update_chart();
        }

		</script>
	</head>
	<body>
<select id="planta"name='plantas' id='plantas' onchange='update_chart();' >
                    <option value='0'></option>
                    <option value='Planta Dist. San Lorenzo'>Planta Dist. San Lorenzo</option>
                    <option value='Planta Dist. Bajo Grande'>Planta Dist. Bajo Grande</option>
                    <option value='Planta Dist. El Vigia'>Planta Dist. El Vigia</option>
                    <option value='Planta Dist. Barquisimeto'>Planta Dist. Barquisimeto</option>
                    <option value='Planta Dist. Maturin'>Planta Dist. Maturin</option>
                    <option value='Planta Dist. Cardon'>Planta Dist. Cardon</option>
                    <option value='Planta Dist. Puerto La Cruz'>Planta Dist. Puerto La Cruz</option>
                    <option value='Planta Dist. Yagua'>Planta Dist. Yagua</option>
                    <option value='Planta Dist. Catia La Mar'>Planta Dist. Catia La Mar</option>
                    <option value='Planta Dist. Guatire'>Planta Dist. Guatire</option>
                    <option value='Planta Dist. Puerto Ordaz'>Planta Dist. Puerto Ordaz</option>
                    <option value='Planta Dist. San Tome'>Planta Dist. San Tome</option>
                    <option value='Planta Dist. El Palito'>Planta Dist. El Palito</option>
                </select><br/>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/highcharts-more.js');?>"></script>
                <script type="text/javascript" src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>

             
<!--<div id="primero" style="margin: 0; width: 100%; height: 33%; border: 1px solid #D9D9D9;">                
    <div id="container" style="width: 32%; height: 30%; float: left; border: 1px solid #D9D9D9; "></div>
    <div id="container3" style="width: 32%; height: 30%; float: right; border: 1px solid #D9D9D9;"></div>
    <div id="container2" style="width: 32%; height: 30%;"></div>
</div>
<div id="segundo" style="margin: 0; width: 100%; height: 33%; border: 1px solid #D9D9D9;">                
    <div id="container4" style="width: 32%; height: 30%; float: left; border: 1px solid #D9D9D9; "></div>
    <div id="container5" style="width: 32%; height: 30%; float: right; border: 1px solid #D9D9D9; "></div>
</div>-->
                
<table style="margin:auto; width:90%; height: 30%" cellpadding="0" cellspacing="0" border="0" >
                    <tbody>
                        <tr>
                            <td style="width: 33%; height: 320px" id="container"></td>
                            <td style="width: 33%" id="container3"></td>
                            <td style="width: 33%" id="container2"></td>
                        </tr>
                        <tr>
                            <td style="width: 33%; height: 320px" id="container4"></td>
                            <td style="width: 33%" id=""></td>
                            <td style="width: 33%" id="container5"></td>
                        </tr>
                    </tbody>
                </table>
	</body>
</html>
