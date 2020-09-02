<main class="form">
    <form>
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" class="form-control" id="inputName">
        </div>
        <div class="form-group row">
            <div class="col-6">
                <label for="inputNascimento">Data de Nascimento</label>
                <input class="form-control" type="date" value="2011-08-19T13:45:00" id="inputNascimento">
            </div>
            <div class="col-6">
                <label for="inputCpf">Cpf</label>
                <input type="number" class="form-control" id="inputCpf">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <label for="inputCurso">Curso</label>
                <select id="inputCurso" class="form-control">
                    <option selected>Selecione...</option>
                    <option>Analise e desenvolvimento de sistemas</option>
                    <option>Engenharia de Software</option>
                </select>
            </div>
            <div class="col-6">
                <label for="inputEmail">Email</label>
                <input type="text" class="form-control" id="inputEmail">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-6">
                <label for="inputEndereco">Endereço</label>
                <input type="text" class="form-control" id="inputEndereco">
            </div>
            <div class="col-3">
                <label for="inputComplemento">Complemento</label>
                <input type="text" class="form-control" id="inputComplemento">
            </div>
            <div class="col-3">
                <label for="inputCep">Cep</label>
                <input type="number" class="form-control" id="inputCep">
            </div>
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