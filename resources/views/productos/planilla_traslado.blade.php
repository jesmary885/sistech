<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de ventas</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px
        }

        #datos{
            text-align: left;
            float: left;
            margin-top: 0%;
            margin-left: 0%;
            margin-right: 0%;
           
        }

        #datos p{
            text-align: left;

           
        }

        .fechas{
            text-align: center;
            font-weight: bold;

           
        }

        #fo{
            text-align: center;
            font-size: 10px;
        }

        #encabezado {
            text-align: left;
            margin-left: 35%;
            margin-right: 35%;
            font-size: 15px;
        }

        #fact{
            float: right;
            text-align: center;
            margin-top: 2%;
            margin-left: 2%;
            margin-right: 2%;
            font-size: 20px;
            background: #33afff;
            border-radius: 8px;
            font-weight: bold;
        }

        #cliente{
            text-align: left;
        }

        section{
            clear: left;
        }

        #fact,
        #fv,
        #fa
        #f {
            color: #ffffff;
            font-size: 15px;            
        }

        #faproveedor {
            width: 40%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 15px;
        }


        #faproveedor thead{
            padding: 20px;
            background: #33afff;
            text-align: left;
            border-bottom: 1px solid #ffffff;

        }

        #faccomprador {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            border-spacing: 0;
            margin-bottom: 15px;
        }

        #faccomprador thead{
            padding: 20px;
            background: #33afff;
            text-align: center;
            border-bottom: 1px solid #ffffff;

        }

        #facproducto {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            text-align: center;
            border: 1px solid #000;
            margin-bottom: 15px;
        }

        #facproducto thead{
            padding: 20px;
            background: #33afff;
            text-align: center;
            border-bottom: 1px solid #000;
        }

        #f{
            padding: 20px;
            background: #33afff;
            text-align: center;
            border-bottom: 1px solid #000;
        }

        #facproducto th, td{
            border: 1px solid;
        }

        img{
            margin-left: 0%;
        }


    </style>
</head>
<body>
    <header>
        <div>
            <img src="img/logotech_2.jpg" alt="logo">
        </div>
        <div>
            <table id="datos">
                <thead>
                    <tr>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <p>RU: {{$empresa->nro_documento}} <br>
                                {{$empresa->direccion}} <br>
                                Telefono: {{$empresa->telefono}} <br>
                                Email:  {{$empresa->email}}<br><br>
                                Fecha de emisión: {{$fecha_actual}} <br>
                                Usuario emisor: {{$usuario}}
                            </p>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </header>
    <br>
    <br>
    <br>
    <br>

   
       

    <section>
        <div>
            <p class="fechas">Traslado desde {{$sucursal_inicial}} hasta {{$sucursal_destino}}</p>
        </div>
        <div>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th>CANTIDAD</th>
                        <th>PRODUCTO (MODELO)</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($cant_cod_barra as $pr)
                        @for ($i = 0; $i < $cant_total; $i++)
                            <tr>
                                <td class="text-center text-xs m-0 p-0">{{ $pr[$produ_s_r[$i]] }}</td>
                                <td class="text-center text-xs m-0 p-0">{{ $produ_s_r[$i] }}</td>
                            </tr>
                        @endfor
                    @endforeach
                </tbody>
                <tfoot>
                    <tr id="f" >
                         <th colspan="1">
                            <p align="center">{{$total_registros}}</p>
                        </th>
                        <td>
                            <p align="center"></p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    
    </section>
    <br>
    <br>

</body>
</html>