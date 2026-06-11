<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inventario - Medu</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #059669; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #059669; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8fafc; color: #475569; font-weight: bold; text-transform: uppercase; font-size: 10px;}
        .bajo-stock { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Medu - Reporte de Inventario</h1>
        <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Medicina / Presentación</th>
                <th>Categoría</th>
                <th>Ubicación</th>
                <th>Cód. Barras</th>
                <th>Precio de venta</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicinas as $medicina)
            <tr>
                <td>
                    <strong>{{ $medicina->nombre_comercial }} {{ $medicina->concentracion ? '('.$medicina->concentracion.')' : '' }}</strong><br>
                    <span style="color:#666; font-size:10px">{{ $medicina->principio_activo }}</span>
                </td>
                <td>{{ $medicina->categoria?->nombre ?? '--' }}</td>
                <td>{{ $medicina->ubicacion ?? '--' }}</td>
                <td>{{ $medicina->codigo_barras ?? '--' }}</td>
                <td>${{ number_format($medicina->precio_venta, 2) }}</td>
                <td class="{{ $medicina->stock_actual <= $medicina->stock_minimo ? 'bajo-stock' : '' }}">
                    {{ $medicina->stock_actual }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
