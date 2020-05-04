<?php
   $con = new mysqli("localhost","root","","ventas"); // Conectar a la BD
   
   $sql = "SELECT a.nombre as Alias, Sum(dv.cantidad) as Expri1 FROM detalle_venta dv inner join articulo a on dv.articuloID = a.id group by dv.articuloID"; // Consulta SQL
   $query = $con->query($sql); // Ejecutar la consulta SQL
   $data = array(); // Array donde vamos a guardar los datos
   
   while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
       $data[]=$r; // Guardar los resultados en la variable $data
       

  }
  $consulta = "SELECT count(id) as cantidad from ingreso WHERE LEFT(fecha_hora,10)=CURDATE()";
  $resultado = mysqli_query($con,$consulta);
  $row = mysqli_fetch_assoc($resultado);
  $ingreso = $row['cantidad'];
   
  $consulta2 = "SELECT count(id) as cantidad from venta WHERE LEFT(fecha_hora,10)=CURDATE()";
  $resultado2 = mysqli_query($con,$consulta2);
  $row = mysqli_fetch_assoc($resultado2);
  $venta = $row['cantidad'];

  $consulta3 = "SELECT sum(total_venta) as cantidad from venta WHERE LEFT(fecha_hora,10)=CURDATE()";
  $resultado3 = mysqli_query($con,$consulta3);
  $row = mysqli_fetch_assoc($resultado3);
  $total = $row['cantidad'];

  //ventas por mes 

  $enero = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '01'";
  $resultado4 = mysqli_query($con,$enero);
  $row = mysqli_fetch_assoc($resultado4);
  $ventaEnero = $row['cantidad'];

  $febrero = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '02'";
  $resultado5 = mysqli_query($con,$febrero);
  $row = mysqli_fetch_assoc($resultado5);
  $ventaFebrero = $row['cantidad'];

  $marzo = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '03'";
  $resultado6 = mysqli_query($con,$marzo);
  $row = mysqli_fetch_assoc($resultado6);
  $ventaMarzo = $row['cantidad'];

  $abril = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '04'";
  $resultado7 = mysqli_query($con,$abril);
  $row = mysqli_fetch_assoc($resultado7);
  $ventaAbril = $row['cantidad'];

  $mayo = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '05'";
  $resultado8 = mysqli_query($con,$mayo);
  $row = mysqli_fetch_assoc($resultado8);
  $ventaMayo = $row['cantidad'];

  $junio = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '06'";
  $resultado9 = mysqli_query($con,$junio);
  $row = mysqli_fetch_assoc($resultado9);
  $ventaJunio = $row['cantidad'];

  $julio = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '07'";
  $resultado10 = mysqli_query($con,$julio);
  $row = mysqli_fetch_assoc($resultado10);
  $ventaJulio = $row['cantidad'];

  $agosto = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '08'";
  $resultado11 = mysqli_query($con,$agosto);
  $row = mysqli_fetch_assoc($resultado11);
  $ventaAgosto = $row['cantidad'];

  $septiembre = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '09'";
  $resultado12 = mysqli_query($con,$septiembre);
  $row = mysqli_fetch_assoc($resultado12);
  $ventaSeptiembre = $row['cantidad'];

  $octubre = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '10'";
  $resultado13 = mysqli_query($con,$octubre);
  $row = mysqli_fetch_assoc($resultado13);
  $ventaOctubre = $row['cantidad'];

  $noviembre = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '11'";
  $resultado14 = mysqli_query($con,$noviembre);
  $row = mysqli_fetch_assoc($resultado14);
  $ventaNoviembre = $row['cantidad'];

  $diciembre = "SELECT count(id) as cantidad FROM venta WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '12'";
  $resultado15 = mysqli_query($con,$diciembre);
  $row = mysqli_fetch_assoc($resultado15);
  $ventaDiciembre = $row['cantidad'];

  //lo mas vendido del mes

  $consulta16 = "SELECT a.nombre as Alias, Sum(dv.cantidad) as Expri1 FROM detalle_venta dv inner join articulo a on dv.articuloID = a.id inner join venta v on dv.ventaID = v.id where YEAR(v.fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(v.fecha_hora) = MONTH(CURRENT_DATE()) group by dv.articuloID"; // Consulta SQL
  $resultado16 = $con->query($consulta16); // Ejecutar la consulta SQL
  $info = array(); // Array donde vamos a guardar los datos
   
   while($r = $resultado16->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
       $info[]=$r; // Guardar los resultados en la variable $data
       

  }
   //compras por mes 

  $eneroIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '01'";
  $resultado17 = mysqli_query($con,$eneroIng);
  $row = mysqli_fetch_assoc($resultado17);
  $ingresoEnero = $row['cantidad'];

  $febreroIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '02'";
  $resultado18 = mysqli_query($con,$febreroIng);
  $row = mysqli_fetch_assoc($resultado18);
  $ingresoFebrero = $row['cantidad'];

  $marzoIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '03'";
  $resultado19 = mysqli_query($con,$marzoIng);
  $row = mysqli_fetch_assoc($resultado19);
  $ingresoMarzo = $row['cantidad'];

  $abrilIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '04'";
  $resultado20 = mysqli_query($con,$abrilIng);
  $row = mysqli_fetch_assoc($resultado20);
  $ingresoAbril = $row['cantidad'];

  $mayoIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '05'";
  $resultado21 = mysqli_query($con,$mayoIng);
  $row = mysqli_fetch_assoc($resultado21);
  $ingresoMayo = $row['cantidad'];

  $junioIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '06'";
  $resultado22 = mysqli_query($con,$junioIng);
  $row = mysqli_fetch_assoc($resultado22);
  $ingresoJunio = $row['cantidad'];

  $julioIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '07'";
  $resultado23 = mysqli_query($con,$julioIng);
  $row = mysqli_fetch_assoc($resultado23);
  $ingresoJulio = $row['cantidad'];

  $agostoIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '08'";
  $resultado24 = mysqli_query($con,$agostoIng);
  $row = mysqli_fetch_assoc($resultado24);
  $ingresoAgosto = $row['cantidad'];

  $septiembreIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '09'";
  $resultado24 = mysqli_query($con,$septiembreIng);
  $row = mysqli_fetch_assoc($resultado24);
  $ingresoSeptiembre = $row['cantidad'];

  $octubreIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '10'";
  $resultado25 = mysqli_query($con,$octubreIng);
  $row = mysqli_fetch_assoc($resultado25);
  $ingresoOctubre = $row['cantidad'];

  $noviembreIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '11'";
  $resultado26 = mysqli_query($con,$noviembreIng);
  $row = mysqli_fetch_assoc($resultado26);
  $ingresoNoviembre = $row['cantidad'];

  $diciembreIng = "SELECT count(id) as cantidad FROM ingreso WHERE YEAR(fecha_hora) = YEAR(CURRENT_DATE()) AND MONTH(fecha_hora) = '12'";
  $resultado27 = mysqli_query($con,$diciembreIng);
  $row = mysqli_fetch_assoc($resultado27);
  $ingresoDiciembre = $row['cantidad'];

?>

@extends('layouts.admin')
@section('contenido')
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
 <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$ingreso}}</h3>

              <p>Compras del dia</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">ver detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$venta}}</h3>

              <p>Ventas del dia</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Vencimientos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalle<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6 col-sm-6 col-xs-12"> 
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>${{$total}}</h3>

              <p>Caja del dia</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              
              <i class="fa fa-th"></i>
              
              <h3 class="box-title" >Ventas año en curso</h3>
              <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <body>
        <canvas id="myChart2" width="400" height="300"></canvas>
    </body>
    <script>
        var ctx2= document.getElementById("myChart2").getContext("2d");
        var myChart2= new Chart(ctx2,{
            type:"bar",
            data:{
                labels:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                
                datasets:[{
                        label:'Ventas',
                        data:[
                          {{$ventaEnero}},{{$ventaFebrero}},{{$ventaMarzo}},{{$ventaAbril}}
                        ],
                        backgroundColor:[
                            'rgb(255,102,102)',
                            'rgb(255,178,102)',
                            'rgb(102,255,255)',
                            'rgb(102,178,255)',
                            'rgb(102,102,255)',
                            'rgb(178,102,255)',
                            'rgb(255,102,255)',
                            'rgb(255,102,178)',
                            'rgb(192,192,192)',
                            'rgb(255,255,102)',
                            'rgb(178,255,102)',
                            'rgb(102,255,102)',
                            'rgb(102,255,178)',
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>
              
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Compras año en curso</h3>
              <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <body>
        <canvas id="myChart4" width="400" height="300"></canvas>
    </body>
    <script>
        var ctx4= document.getElementById("myChart4").getContext("2d");
        var myChart4= new Chart(ctx4,{
            type:"line",
            data:{
                labels:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                
                datasets:[{
                        label:'Compras',
                        data:[
                          {{$ingresoEnero}},{{$ingresoFebrero}},{{$ingresoMarzo}},{{$ingresoAbril}},{{$ingresoMayo}},{{$ingresoJunio}},{{$ingresoJulio}},{{$ingresoAgosto}},{{$ingresoSeptiembre}},{{$ingresoOctubre}},{{$ingresoNoviembre}},{{$ingresoDiciembre}}
                        ],
                        backgroundColor:[
                            'rgb(255,102,102)',
                            'rgb(255,178,102)',
                            'rgb(102,255,255)',
                            'rgb(102,178,255)',
                            'rgb(102,102,255)',
                            'rgb(178,102,255)',
                            'rgb(255,102,255)',
                            'rgb(255,102,178)',
                            'rgb(192,192,192)',
                            'rgb(255,255,102)',
                            'rgb(178,255,102)',
                            'rgb(102,255,102)',
                            'rgb(102,255,178)',
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List -->
          
          <!-- /.box -->

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Lo más vendido</h3>
              <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <body>
                <canvas id="myChart" width="400" height="300"></canvas>
              </body>
              <script>
                  var ctx= document.getElementById("myChart").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"doughnut",
            data:{
                labels:[<?php foreach($data as $d):?>
                          "<?php echo $d->Alias;?>",
                          <?php endforeach; ?>],
                
                datasets:[{
                        label:'Compras',
                        data:[
                          <?php foreach($data as $d):?>
                          <?php echo $d->Expri1;?>,
                          <?php endforeach; ?>
                        ],
                        backgroundColor:[
                            'rgb(255,102,102)',
                            'rgb(255,178,102)',
                            'rgb(102,255,255)',
                            'rgb(102,178,255)',
                            'rgb(102,102,255)',
                            'rgb(178,102,255)',
                            'rgb(255,102,255)',
                            'rgb(255,102,178)',
                            'rgb(192,192,192)',
                            'rgb(255,255,102)',
                            'rgb(178,255,102)',
                            'rgb(102,255,102)',
                            'rgb(102,255,178)',


                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- solid sales graph -->
          
          <div class="box box-solid bg-teal-gradient">
          
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Lo mas vendido del mes</h3>
              <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
             
              

              
              
    <body>
        <canvas id="myChart3" width="400" height="300"></canvas>
    </body>
    <script>
        var ctx3= document.getElementById("myChart3").getContext("2d");
        var myChart3= new Chart(ctx3,{
            type:"pie",
            data:{
                labels:[<?php foreach($info as $d):?>
                          "<?php echo $d->Alias;?>",
                          <?php endforeach; ?>],
                
                datasets:[{
                        label:'Compras',
                        data:[
                          <?php foreach($info as $d):?>
                          <?php echo $d->Expri1;?>,
                          <?php endforeach; ?>
                        ],
                        backgroundColor:[
                            'rgb(255,102,102)',
                            'rgb(255,178,102)',
                            'rgb(102,255,255)',
                            'rgb(102,178,255)',
                            'rgb(102,102,255)',
                            'rgb(178,102,255)',
                            'rgb(255,102,255)',
                            'rgb(255,102,178)',
                            'rgb(192,192,192)',
                            'rgb(255,255,102)',
                            'rgb(178,255,102)',
                            'rgb(102,255,102)',
                            'rgb(102,255,178)',










                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>
              
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

          <!-- Calendar -->
          
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
@endsection