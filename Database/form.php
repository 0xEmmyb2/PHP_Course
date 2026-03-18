<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <style>
    .error  { color: red;   font-size: 13px; display: block; margin-top: 4px; }
    .input-error { border: 1px solid red; }
    input   { display: block; margin-bottom: 4px; padding: 8px; width: 300px; }
    button  { padding: 8px 20px; margin-top: 12px; }
  </style>
</head>
<body>

<h2>Create an account</h2>

<!-- General DB error (not tied to a specific field) -->
<?php if (!empty($errors['db'])): ?>
    <p class="error"><?= htmlspecialchars($errors['db']) ?></p>
<?php endif; ?>

<form action="register.php" method="POST">

  
  <label for="username">Username</label>
  <input
    type="text"
    id="username"
    name="username"
    placeholder="e.g john doe"
    maxlength="50"
    required
  >
  

  
  <label for="email">Email</label>
  <input
    type="email"
    id="email"
    name="email"
    placeholder="you@example.com"
    maxlength="150"
    required
  >
  

  
  <label for="password">Password</label>
  <input
    type="password"
    id="password"
    name="password"
    minlength="8"
    required
  >
  

  <button type="submit">Register</button>

</form>
</body>
</html>