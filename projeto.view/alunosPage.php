<main class="content">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Matrícula</th>
                <th scope="col">Nome</th>
                <th scope="col">Status</th>
                <th scope="col">Curso</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($alunos as $aluno) : ?>
            <tr>
                <td> <?= $aluno->nr_matricula ?> </td>
                <td> <?= $aluno->nm_principal ?> </td>
                <td> <?= $aluno->fg_status ?> </td>
                <td> <?= $aluno->cd_curso ?> </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</main>