<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Quadras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciamento de Quadras</h1>
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('quadras.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Buscar quadras...">
                    <button class="btn btn-outline-primary" type="submit">Buscar</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('quadras.create') }}" class="btn btn-primary">Nova Quadra</a>
            </div>
        </div>
        
        <div class="row">
            @foreach($quadras as $quadra)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $quadra->nome }}</h5>
                        <p class="card-text">
                            <strong>Tipo:</strong> {{ $quadra->tipo }}<br>
                            <strong>Status:</strong> 
                            <span class="badge {{ $quadra->disponivel ? 'bg-success' : 'bg-danger' }}">
                                {{ $quadra->disponivel ? 'Disponível' : 'Indisponível' }}
                            </span>
                        </p>
                        @if($quadra->descricao)
                            <p class="card-text">{{ $quadra->descricao }}</p>
                        @endif
                        <div class="mt-3">
                            <a href="{{ route('quadras.edit', $quadra) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('quadras.destroy', $quadra) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover esta quadra?')">Remover</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
