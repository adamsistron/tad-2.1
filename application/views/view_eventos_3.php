<?php
//$this->load->view('menu');
?>
<!DOCTYPE HTML>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <link rel="shortcut icon" type="image/ico" href="<?php echo base_url('images/pdvsa.ico');?>">
		<title>Casos: <?php echo $estatus; ?> de <?php echo $anio; ?> </title>
                <script type="text/javascript" src="<?php echo base_url('js/jquery.min_1.js');?>"></script>
                
               
                <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css');?>">
                <script src="<?php echo base_url('js/jquery-ui.js');?>"></script>
		
<html>
<script type="text/javascript">
$(function() {
$( ".dialog" ).dialog({
    autoOpen: false,

    show: {
      effect: "clip",
      duration: 500
    },
    hide: {
      effect: "clip",
      duration: 400
    },
    resizable: false,
    modal: true,
    width:'auto',
    height: 450
});

  });    
    
$(function () {

    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {

                    // Remove special edition notes
                    name = name.split('*');
                    
                    //alert(name[0]+name[1]);

                    // Split into brand and version
                    //version = name.match(/([0-9]+[\.0-9x]*)/);
                    version = name[1];
                    
                    brand = name[0];

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push([version, columns[1][i]]);
                    }
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });

            // Create the chart
            $('#container').highcharts({
                /*chart: {
                    type: 'column'
                },*/
                chart: {
                type: 'column',
                    events: {
                    drillup: function (e) {
                        $("#tabla").hide();
                        //$("#tabla").empty();
                       
                    }
                    }        
                },
                exporting: {
            /*buttons: {
                customButton: {
                    text: 'Investigaciones',
                    onclick: function () {
                        
                        //javascript:history.back(1);                
                        window.location.href = "<?php //echo base_url('casos/casos_1');?>";
        //alert('You pressed the button!');
                    }
                }
            }*/
        },
                title: {
                    text: 'Total de Eventos No deseados'
                },
                subtitle: {
                    text: 'Click en la columna para ver detalle por N/F/R'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'N° de Casos',
                        align: 'high'
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
                                    
                                    casos_3(this.series.name, this.name,$("#anio").val(),$("#estatus").val());
                                }
                            }
                        }
                    }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
                },

                series: [{
                    name: 'Filiales',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    drillUpButton: {
                        relativeTo: 'spacingBox',
                        position: {
                            y: 30,
                            x: -10
                        },
                        theme: {
                            fill: 'white',
                            'stroke-width': 1,
                            stroke: 'silver',
                            r: 0,
                            states: {
                                hover: {
                                    fill: 'gray'
                                },
                                select: {
                                    stroke: '#039',
                                    fill: 'gray'
                                }
                            }
                            }
                        },      
                    series: drilldownSeries,
                    
                },
                        
                        
                    
                credits: {
                enabled: false
                },
                colors: ['#2f7ed8', '#DF013A', '#8bbc21', '#F7FE2E', '#1aadce', '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a']
            });
        }
    });
});
function casos_3(filial, region, anio, estatus){
        
        //$("#cargando").show();
        $("#tabla").hide();
        
        $.ajax({
        url:"<?php echo base_url('casos/casos_3');?>",
        type: "POST",
        data:{
        filial:filial,region:region,anio:anio,estatus:estatus
        },
        success: function(data) {
            $("#tabla").empty();
            $("#tabla").append(data);
            $("#tabla").show();
            
            $("#opent").dialog( "open" );
       
        }});
    
        //$("#cargando").hide();
        //$("#tabla").show("slow");
        }


		</script>
	</head>
	<body>
            
            
<script src="<?php echo base_url('Highcharts-4.0.4/js/highcharts.js');?>"></script>
<script src="<?php echo base_url('Highcharts-4.0.4/js/modules/exporting.js');?>"></script>
<script src="<?php echo base_url('Highcharts-4.0.4/js/modules/data.js');?>"></script>
<script src="<?php echo base_url('Highcharts-4.0.4/js/modules/drilldown.js');?>"></script>

<pre id="tsv" style="display:none">filial*region	1%
<?php echo $datos;?></pre>
<input type="hidden" id="anio" value="<?php //echo $anio; ?>"/>
<input type="hidden" id="estatus" value="<?php //echo $estatus; ?>"/>
        <center>
            <div id="container" class="container-fluid"></div>
            <div id="tabla" ></div>
        </center>

        
        <link rel="stylesheet" href="<?php echo base_url('css/jquery-ui.css');?>">
                <script src="<?php echo base_url('js/jquery-ui.js');?>"></script>
<div id="opent" class="dialog" title="Detalle Avance vs Histórico"></div>

<!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->


	</body>
</html>
