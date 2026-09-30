<?php
include "includes/db.php";

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($name == "" || $email == "" || $password == "") {
        $error = "Please fill in all the fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } elseif ($password != $confirm) {
        $error = "Passwords do not match. Please re-enter.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT user_id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "This email is already registered. Please sign in instead.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Account created successfully! You can now log in.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}

$title = "Register";
include "includes/header.php";
?>

<div class="max-w-md mx-auto my-8">
  <div class="cyber-box rounded-2xl p-6 sm:p-8">
    <div class="text-center mb-6">
      <div class="text-3xl mb-2">✨</div>
      <h1 class="text-2xl font-bold text-[#064E3B]">Create an Account</h1>
      <p class="text-xs text-[#35604F] mt-1">Join CyberSafe to save your test scores and track your habits</p>
    </div>

    <?php if ($error) { ?>
      <div class="p-3 rounded-lg bg-rose-100 border border-rose-300 text-rose-700 mb-4 text-xs flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation text-sm shrink-0"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php } ?>

    <?php if ($success) { ?>
      <div class="p-3 rounded-lg bg-[#DDEBD9] border border-[#064E3B] text-[#064E3B] mb-4 text-xs flex items-center justify-between gap-2">
        <span><?php echo htmlspecialchars($success); ?></span>
        <a href="login.php" class="underline font-bold text-[#064E3B]">Sign In</a>
      </div>
    <?php } ?>

    <form method="post" class="space-y-3.5 text-xs">
      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Your Name</label>
        <input 
          type="text" 
          name="name" 
          required 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
          placeholder="e.g. John Doe"
          value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
        >
      </div>

      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Email Address</label>
        <input 
          type="email" 
          name="email" 
          required 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
          placeholder="john@example.com"
          value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
        >
      </div>

      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Password</label>
        <div class="relative">
          <input 
            type="password" 
            name="password" 
            id="regPass"
            required 
            class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
            placeholder="At least 6 characters"
          >
          <button type="button" id="toggleRegVis" class="absolute right-3 top-3 text-[#35604F] hover:text-[#043B2D] text-xs">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Confirm Password</label>
        <input 
          type="password" 
          name="confirm" 
          required 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
          placeholder="Re-enter password"
        >
      </div>

      <button type="submit" name="register" class="btn-green w-full py-2.5 rounded-lg text-xs font-bold mt-2">
        Create Account
      </button>
    </form>

    <div class="mt-6 pt-4 border-t border-[#D9BF8F] text-center text-xs text-[#35604F]">
      Already have an account? 
      <a href="login.php" class="text-[#064E3B] font-semibold hover:underline ml-1">Log in here</a>
    </div>
  </div>
</div>

<script>
  var toggleBtn = document.getElementById('toggleRegVis');
  var passInput = document.getElementById('regPass');
  if (toggleBtn && passInput) {
    var vis = false;
    toggleBtn.addEventListener('click', function() {
      vis = !vis;
      passInput.type = vis ? 'text' : 'password';
      toggleBtn.innerHTML = vis ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
    });
  }
</script>

<?php include "includes/footer.php"; ?>
