<main class="form">
    <form>
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" id="inputName">
        </div>
        <div class="form-group">
            <label for="inputCpf">Cpf</label>
            <input type="number" class="form-control" id="inputCpf">
        </div>
        <div class="form-group">
            <label for="inputCurso">Curso</label>
            <select id="inputCurso" class="form-control">
                <option selected>Selecione...</option>
                <option>Analise e desenvolvimento de sistemas</option>
                <option>Engenharia de Software</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputCep">Cep</label>
            <input type="number" class="form-control" id="inputCep">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" checked type="checkbox" id="alunoAtivo">
                <label class="form-check-label" for="alunoAtivo">
                    Ativo
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</main>