<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de ingreso</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }
 
        #imagen{
        width: 100px;
        }
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        @foreach ($comp as $c)
        <header>
            <div id="logo">
                <img src="img/logo2.png" alt="incanatoIT" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Su local</b><br>José Gálvez 1368, Chongoyape - San nicolas, CABA<br>Telefono:(+51)931742904<br>Email:sulocal@gmail.com
                </p>
            </div>
            <div id="fact">
                <p>{{$c->tipo_comprobante}}<br>
                {{$c->serie_comprobante}}-{{$c->num_comprobante}}</p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="faproveedor">
                    <thead>                        
                        <tr>
                            <th id="fap">Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a). {{$c->nombre}}<br>
                            {{$c->tipo_documento}}: {{$c->num_documento}}<br>
                            Dirección: {{$c->direccion}}<br>
                            Teléfono: {{$c->telefono}}<br>
                            Email: {{$c->email}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>EMPLEADO</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$c->usuarioID}}</td>
                            <td>{{$c->fecha_hora}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>CANT</th>
                            <th>DESCRIPCION</th>
                            <th>PRECIO UNIT</th>
                            <th>DESC.</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detal as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->articulo}}</td>
                            <td>{{$det->precio_venta}}</td>
                            <td>{{$det->descuento}}</td>
                            <td>{{$det->cantidad*$det->precio_compra-$det->descuento}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($comp as $c)
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>SUBTOTAL</th>
                            <td>$ {{round($c->total_ingreso-($c->total_ingreso*$c->impuesto/100),2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Impuesto</th>
                            <td>$ {{round($c->total_ingreso * $c->impuesto/100,2)}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>$ {{$c->total_ingreso}}</td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias por su ingreso!</b></p>
            </div>
        </footer>
    </body>
</html>