<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resumo da Venda</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Resumo da Venda #{{ $sale->id }}</h1>
    <p><strong>Cliente:</strong> {{ $sale->client->name ?? 'N/A' }}</p>
    <p><strong>Usuário:</strong> {{ $sale->user->name }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($sale->total, 2, ',', '.') }}</p>
    <p><strong>Data de Criação:</strong> {{ $sale->created_at->format('d/m/Y H:i') }}</p>

    <h2>Itens da Venda</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Preço Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>R$ {{ number_format($item->unit_price, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($item->total_price, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>