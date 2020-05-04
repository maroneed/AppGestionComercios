



<html>
  <H1 align="center"> Listado de ingresos </H1>
  <style>
    
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    

    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    table {
   width: 100%;
   margin: 0 auto;
   border: 1px solid;
   }
   table th {
   color: #000000;
   background-color: #74A4E8;
   text-align:center; 
   }
   tr:nth-child(odd) {
    background-color:#f2f2f2;
    text-align:center;
   }
   tr:nth-child(even) {
    background-color:#D2DBE7;
    text-align:center;

   }

    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
  </style>


<div>
    <table>
        <tbody>
             <tr>
                 <th>Comprobante</th>

                 <th>Serie</th>
                 <th>Numero</th>
                 <th>Fecha</th>
                 <th>Iva</th>
                 <th>Cliente</th>
                 
             </tr>

                    
            
            
        </tbody>
        @foreach ($ingr as $i) 
        <tr>
                    
            
            <td>{{$i->tipo_comprobante}}</td>
            <td>{{$i->serie_comprobante}}</td>
            <td>{{$i->num_comprobante}}</td>
            <td>{{$i->fecha_hora}}</td>
            <td>{{$i->impuesto}}</td>
            <td>{{$i->proveedorID}}</td>

        </tr>
               
                
        @endforeach
    </table>
  
</div> 

</html>
