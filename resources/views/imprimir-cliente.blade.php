



<html>
  <H1 align="center"> Listado de Proveedores </H1>
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
                 <th>Nombre</th>

                 <th>Indentificacion</th>
                 <th>Documento</th>
                 <th>Direccion</th>
                 <th>Telefono</th>
                 <th>Email</th>
                 
             </tr>

                    
            
            
        </tbody>
        @foreach ($clie as $c) 
        <tr>
                    
            
            <td>{{$c->nombre}}</td>
            <td>{{$c->tipo_documento}}</td>
            <td>{{$c->num_documento}}</td>
            <td>{{$c->direccion}}</td>
            <td>{{$c->telefono}}</td>
            <td>{{$c->email}}</td>

        </tr>
               
                
        @endforeach
    </table>
  
</div> 

</html>
