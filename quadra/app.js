let quadras = [];

// Carregar todas as quadras
async function carregarQuadras() {
    try {
        const response = await axios.get('data/quadras.json');
        quadras = response.data;
        renderizarQuadras();
    } catch (error) {
        console.error('Erro ao carregar quadras:', error);
        alert('Erro ao carregar as quadras. Por favor, tente novamente.');
    }
}

// Buscar quadras
function buscarQuadras() {
    const busca = document.getElementById('busca').value.toLowerCase();
    const quadrasFiltradas = quadras.filter(quadra => 
        quadra.nome.toLowerCase().includes(busca) ||
        quadra.tipo.toLowerCase().includes(busca) ||
        (quadra.descricao && quadra.descricao.toLowerCase().includes(busca))
    );
    renderizarQuadras(quadrasFiltradas);
}

// Renderizar quadras
function renderizarQuadras(quadrasParaRenderizar = quadras) {
    const container = document.getElementById('quadras');
    container.innerHTML = '';

    quadrasParaRenderizar.forEach(quadra => {
        const card = document.createElement('div');
        card.className = 'col-md-4 mb-4';
        card.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">${quadra.nome}</h5>
                    <p class="card-text">
                        <strong>Tipo:</strong> ${quadra.tipo}<br>
                        <strong>Status:</strong>
                        <span class="badge ${quadra.disponivel ? 'bg-success' : 'bg-danger'}">
                            ${quadra.disponivel ? 'Disponível' : 'Indisponível'}
                        </span>
                    </p>
                    ${quadra.descricao ? `<p class="card-text">${quadra.descricao}</p>` : ''}
                    <div class="mt-3">
                        <button class="btn btn-sm btn-warning" onclick="editarQuadra(${quadra.id})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="removerQuadra(${quadra.id})">
                            <i class="fas fa-trash"></i> Remover
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(card);
    });
}

// Salvar nova quadra
async function salvarQuadra() {
    const novaQuadra = {
        id: Date.now(),
        nome: document.getElementById('nome').value,
        tipo: document.getElementById('tipo').value,
        disponivel: document.getElementById('disponivel').checked,
        descricao: document.getElementById('descricao').value
    };

    quadras.push(novaQuadra);
    salvarNoLocalStorage();
    renderizarQuadras();
    $('#novaQuadraModal').modal('hide');
    limparFormularioNovaQuadra();
}

// Editar quadra
async function editarQuadra(id) {
    const quadra = quadras.find(q => q.id === id);
    if (quadra) {
        document.getElementById('idEditar').value = quadra.id;
        document.getElementById('nomeEditar').value = quadra.nome;
        document.getElementById('tipoEditar').value = quadra.tipo;
        document.getElementById('disponivelEditar').checked = quadra.disponivel;
        document.getElementById('descricaoEditar').value = quadra.descricao || '';
        $('#editarQuadraModal').modal('show');
    }
}

// Atualizar quadra
async function atualizarQuadra() {
    const id = parseInt(document.getElementById('idEditar').value);
    const quadra = quadras.find(q => q.id === id);
    
    if (quadra) {
        quadra.nome = document.getElementById('nomeEditar').value;
        quadra.tipo = document.getElementById('tipoEditar').value;
        quadra.disponivel = document.getElementById('disponivelEditar').checked;
        quadra.descricao = document.getElementById('descricaoEditar').value;
        
        salvarNoLocalStorage();
        renderizarQuadras();
        $('#editarQuadraModal').modal('hide');
    }
}

// Remover quadra
async function removerQuadra(id) {
    if (confirm('Tem certeza que deseja remover esta quadra?')) {
        quadras = quadras.filter(q => q.id !== id);
        salvarNoLocalStorage();
        renderizarQuadras();
    }
}

// Limpar formulário de nova quadra
function limparFormularioNovaQuadra() {
    document.getElementById('nome').value = '';
    document.getElementById('tipo').value = '';
    document.getElementById('disponivel').checked = true;
    document.getElementById('descricao').value = '';
}

// Salvar no localStorage
function salvarNoLocalStorage() {
    localStorage.setItem('quadras', JSON.stringify(quadras));
}

// Carregar do localStorage
function carregarDoLocalStorage() {
    const quadrasSalvas = localStorage.getItem('quadras');
    if (quadrasSalvas) {
        quadras = JSON.parse(quadrasSalvas);
        renderizarQuadras();
    }
}

// Inicializar a aplicação
document.addEventListener('DOMContentLoaded', () => {
    carregarDoLocalStorage();
});
