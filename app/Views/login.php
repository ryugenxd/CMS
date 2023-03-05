<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/login" method="post">
   <h2>Login</h2>
   <?php if(session()->getFlashdata('msg')): ?>
      <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
   <?php endif; ?>
   <div class="form-group">
      <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
   </div>
   <div class="form-group">
      <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
   </div>
   <div class="form-group form-check">
    <input type="checkbox" name="remember" class="form-check-input">
    <label class="form-check-label">Remember Me</label>
    </div>
   <div class="form-group">
      <button type="submit" class="btn btn-primary">Login</button>
   </div>
</form>

</body>
</html>