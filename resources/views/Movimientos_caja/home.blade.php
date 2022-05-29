<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movimientos en caja del día</title>
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
        #fa {
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
            border-bottom: 1px solid #ffffff;
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
            <p class="fechas">Movimientos en caja de sucursal "{{$sucursal}}" del día {{$fecha}}</p>
        </div>
        <div>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Detalle</th>
                        <th class="text-center">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_egreso=0;
                    $total_ingreso=0;
                    $total_transferencia=0;
                    ?>
                    @foreach ($movimientos as $movimiento)
                    <?php
                    if($movimiento->tipo_movimiento == 1){
                        $tipoMovimiento = 'Ingreso';
                        $tipoMovimiento_bg = 'bg-green-200';
                        $total_ingreso = $total_ingreso + $movimiento->cantidad;
                    }
                    elseif($movimiento->tipo_movimiento == 2) {
                        $tipoMovimiento = 'Egreso';
                        $tipoMovimiento_bg = 'bg-red-200';
                        $total_egreso = $total_egreso + $movimiento->cantidad;
                    }
                    else{
                        $tipoMovimiento = 'Transferencia';
                        $tipoMovimiento_bg = 'bg-yellow-200';
                        $total_transferencia = $total_transferencia + $movimiento->cantidad;
                    }


                    ?>

                    <tr class="{{$tipoMovimiento_bg}}">
                        <td class="text-center">{{$tipoMovimiento}} </td>
                        <td class="text-center">{{$movimiento->cantidad}}</td>
                        <td class="text-center">{{$movimiento->observacion}}</td>
                        <td class="text-center">{{$movimiento->user->name}} {{$movimiento->user->apellido}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
           
            <p class="fechas">Totales</p>
            <table id="facproducto">
                <thead>
                    <tr id="fa">
                        <th class="text-center">Ingresos</th>
                        <th class="text-center">Egresos</th>
                        <th class="text-center">Transferencias</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td class="text-center">{{$total_ingreso}} </td>
                        <td class="text-center">{{$total_egreso}}</td>
                        <td class="text-center">{{$total_transferencia}}</td>
                    </tr>
       
                </tbody>
            </table>
        </div>
    </section>
    <br>
    <br>

</body>
</html>