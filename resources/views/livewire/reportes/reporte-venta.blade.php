<div>

    <div class="card">
        @if ($cantidad_venta)
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">VENTAS REALIZADAS</th>
                            <th class="text-center">TOTAL EN VENTAS</th>
                            <th class="text-center">COSTO DE VENTAS</th>
                            <th class="text-center">GANANCIAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{$cantidad_venta[0]->cantidad}}</td>
                            <td class="text-center">S/ {{$total_venta[0]->quantity}}</td>
                            <td class="text-center">S/ {{$costo_venta[0]->quantity}}</td>
                            <td class="text-center">S/ {{($total_venta[0]->quantity)-($costo_venta[0]->quantity)}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex">
                    <button class="btn btn-success btn-sm mt-2" wire:click="export_excel" title="Eliminar producto"> <i class="far fa-file-excel"></i> Exportar a excel</button>
                    <button class="btn btn-info btn-sm mt-2 ml-2" wire:click="export_pdf" title="Eliminar producto"> <i class="far fa-file-pdf"></i> Exportar a PDF</button>
                </div>
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
    </div>
    @if ($data2)

    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Chart showing browser market shares. Clicking on individual columns
            brings up more detailed data. This chart makes use of the drilldown
            feature in Highcharts to easily switch between datasets.
        </p>
    </figure>

   

    <style>
        .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    </style>
     

    <script>
           // Create the chart
           Highcharts.chart('container', {
    chart: {
    type: 'column'
    },
    title: {
    text: 'Total en ventas por sucursal'
    },
    subtitle: {
    text: ''
    },
    accessibility: {
    announceNewData: {
        enabled: true
    }
    },
    xAxis: {
    type: 'category'
    },
    yAxis: {
    title: {
        text: 'Porcentaje en total en ventas'
    }
    },
    legend: {
    enabled: false
    },
    plotOptions: {
    series: {
        borderWidth: 0,
        dataLabels: {
        enabled: true,
        format: '{point.y:.1f}%'
        }
    }
    },
    tooltip: {
    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
    series: [
    {
        name: "Negocio",
        colorByPoint: true,
        data: <?= $data2 ?> 
    }
    ],
});
    </script>

    @endif


</div>
