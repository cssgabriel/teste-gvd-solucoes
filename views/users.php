<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="vh-100 py-5">
        <h1>Usuários</h1>
        <div class="d-flex flex-column gap-3 mt-5">
          <?php foreach ($users as $user): ?>
            <div class="rounded p-3 border">
              <p class="mb-0">Nome: <?= $user->name; ?></p>
              <p class="mb-0">Email: <?= $user->email; ?></p>
              <p class="mb-0">Idade: <?= $user->age; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>