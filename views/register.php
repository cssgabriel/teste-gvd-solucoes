<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="vh-100 py-5  mx-auto w-50">
        <p class="fw-bold h4">Preencha o formulário abaixo para cadastrar um usuário</p>

        <form class="mt-4 border p-4 rounded" method="post">
          <input type="hidden" name="csfr_token" value="<?= csfr(); ?>" required />

          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="name" class="form-control" id="name" name="name" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Idade</label>
            <input type="number" min="1" max="150" step="1" class="form-control" id="age" name="age" required />
          </div>

          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
      </div>
    </div>
  </div>
</div>