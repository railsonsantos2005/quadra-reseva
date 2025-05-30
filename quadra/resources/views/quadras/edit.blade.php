<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Quadra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Quadra</h1>
        <form action="{{ route('quadras.update', $quadra) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da Quadra</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $quadra->nome }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Quadra</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $quadra->tipo }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Disponível?</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="disponivel" name="disponivel" {{ $quadra->disponivel ? 'checked' : '' }}>
                    <label class="form-check-label" for="disponivel">
                        Sim
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $quadra->descricao }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Quadra</button>
            <a href="{{ route('quadras.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
