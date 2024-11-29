<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="vh-100 py-5">
        <h1>Bem-vindo(a)!</h1>
        <div class="d-flex gap-3">

          <a class="mt-5 btn btn-primary" href="/register">Cadastrar usuário</a>
          <?php if (!empty($users)): ?>
            <a class='mt-5 btn btn-secondary' href="/users">Ver lista de usuários</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>