<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            border: 0.5 solid #000;
            width: 160px;
            border-spacing : 0 0;
            border-collapse : collapse;
        }
        td, th{
            border: 0.5 solid #000;
            padding: 3px;
            margin: 0px;     
        }
        .w-50{
            width: 320px;
        }
        .w-40{
            width: 256px;
        }
        .w-20{
            width: 128px;
        }
        .w-25{
            width: 160px;
        }
        .w-15{
            width: 96px;
        }
        .w-10{
            width: 64px;
        }
        .w-12{
            width: 72px;
        }
        .w-80{
            width: 520px;
        }
        .w-b{
            width: 408px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="w-b">&nbsp;</td>
            <td class="w-12">FECHA</td>
            <td class="w-25">{{ $correlativo->created_at}} </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w-15">MUNICIPIO</td>
            <td class="w-25"> {{$correlativo->municipio}}</td>
            <td class="w-20">N° DE PARTIDA</td>
            <td class="w-12"> {{$correlativo->n_partida}}</td>
            <td class="w-15">PROYECTO</td>
            <td class="w-10"> {{$correlativo->proyecto}}</td>
        </tr>
    </table>
    <table>
        <td class="w-20">BENEFICIARIO</td>
        <td class="w-80"> {{$correlativo->name}}</td>
    </table>
    <br><br>
    <table>
        <tr>
            <th colspan="4">DETALLES</th>
        </tr>
        <tr>
            <th class="w-40">PRODUCTO</th>
            <th class="w-20">CANT.</th>
            <th class="w-20">V. UNITARIO</th>
            <th class="w-20">V. TOTAL</th>
        </tr>
        @foreach ($detalles as $detalle)
        <tr>
            <td class="w-40">{{ $detalle->name }}</td>
            <td class="w-20">{{ $detalle->cantidad }}</td>
            <td class="w-20">{{ $detalle->valor }}</td>
            <td class="w-20">{{ $detalle->subtotal }}</td>  
        </tr>
            
        @endforeach
    </table>
</body>
</html>
