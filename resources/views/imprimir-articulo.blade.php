<html>
  <H1 align="center"> Listado de Articulos </H1>
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
                 <th>Codigo</th>

                 <th>Nombre</th>
                 <th>Stock</th>
                 <th>Descripcion</th>
                 <th>Estado</th>
                 <th>Categoria</th>
                 
             </tr>

                    
            
            
        </tbody>
        @foreach ($arti as $a) 
        <tr>
                    
            
            <td>{{$a->codigo}}</td>
            <td>{{$a->nombre}}</td>
            <td>{{$a->stock}}</td>
            <td>{{$a->descripcion}}</td>
            <td>{{$a->estado}}</td>
            <td>{{$a->categoriaID}}</td>

        </tr>
               
                
        @endforeach
    </table>
  
</div> 

</html>
