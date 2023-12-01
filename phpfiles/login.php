<?php

$login = $app->login();

?>

<div class="d-flex justify-content-center align-items-center vh-100">
<div class="px-2">

<div class="text-center mb-5">
<h3>Reservas</h3>
</div>

<form action="" method="post">
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control rounded-4" required placeholder="name@example.com" autocomplete="off">
</div>
<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="pass" class="form-control rounded-4" required placeholder="Password">
</div>

<div class="d-grid gap-2">
<button type="submit" name="signin" class="btn btn-primary rounded-4">Sign In</button>
</div>
</form>

</div>
</div>
