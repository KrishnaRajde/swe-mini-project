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
      <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shadow-lg shadow-[#B6FF2E]/10">
        <i data-lucide="user-plus" class="w-7 h-7"></i>
      </div>
      <h1 class="text-2xl font-bold text-white">Create an <span class="text-[#B6FF2E]">Account</span></h1>
      <p class="text-xs text-[#94A3B8] mt-1">Join CyberSafe to save your test scores and track your habits</p>
    </div>

    <?php if ($error) { ?>
      <div class="p-3 rounded-lg bg-rose-950/40 border border-rose-500/40 text-rose-300 mb-4 text-xs flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-rose-400"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php } ?>

    <?php if ($success) { ?>
      <div class="p-3 rounded-lg bg-[#B6FF2E]/15 border border-[#B6FF2E]/40 text-[#B6FF2E] mb-4 text-xs flex items-center justify-between gap-2">
        <span class="flex items-center gap-1.5"><i data-lucide="check-circle-2" class="w-4 h-4"></i><?php echo htmlspecialchars($success); ?></span>
        <a href="login.php" class="underline font-bold text-[#B6FF2E]">Sign In</a>
      </div>
    <?php } ?>

    <form method="post" class="space-y-3.5 text-xs">
      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Your Name</label>
        <input 
          type="text" 
          name="name" 
          required 
          class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
          placeholder="e.g. John Doe"
          value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
        >
      </div>

      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Email Address</label>
        <input 
          type="email" 
          name="email" 
          required 
          class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
          placeholder="john@example.com"
          value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
        >
      </div>

      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Password</label>
        <div class="relative">
          <input 
            type="password" 
            name="password" 
            id="regPass" 
            required 
            class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
            placeholder="At least 6 characters"
          >
          <button type="button" id="toggleRegVis" class="absolute right-3 top-3 text-[#94A3B8] hover:text-[#B6FF2E] text-xs">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Confirm Password</label>
        <input 
          type="password" 
          name="confirm" 
          required 
          class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
          placeholder="Re-enter password"
        >
      </div>

      <button type="submit" name="register" class="btn-green w-full py-2.5 rounded-lg text-xs font-bold mt-2 shadow-lg">
        Create Account
      </button>
    </form>

    <div class="mt-6 pt-4 border-t border-[#323743] text-center text-xs text-[#94A3B8]">
      Already have an account? 
      <a href="login.php" class="text-[#B6FF2E] font-semibold hover:underline ml-1">Log in here</a>
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
