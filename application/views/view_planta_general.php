<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

</head>

<body class="dt-example">
	<div class="container">
                
                <div class="row">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-success">N° UTC Histórico</a>
      
                    </div>

  </a>
                    
</div>
          <?php
                           
                            $i=0;
                            $fila="";
                            foreach($resultado as $dato){
                                $i++;
                                if($dato['velocidad']<50){
                                    $class = "danger";
                                }elseif ($dato['velocidad']>50 && $dato['velocidad']<75) {
                                    $class = "warning";
                                }else{
                                    $class = "success";
                                }
  
                                
                                $fila .= "<a href='#' class='list-group-item list-group-item-$class'>
                                            <div class='col-md-3'>".$dato['pd']."</div>
                                            <div class='col-md-3'>".$dato['velocidad']."</div>
                                            <div class='col-md-3'>".$dato['actual']."</div>
                                            <div class='col-md-3'>".$dato['historico']."</div>
                                        </a>";
                            }
                            //echo $fila;
                            ?>
        </div>
</body>
</html>