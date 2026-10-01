<?php
include "includes/db.php";

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT user_id, name, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Incorrect email or password. Please try again.";
    }
}

$title = "Login";
include "includes/header.php";
?>

<div class="max-w-md mx-auto my-8">
  <div class="cyber-box rounded-2xl p-6 sm:p-8">
    <div class="text-center mb-6">
      <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shadow-lg shadow-[#B6FF2E]/10">
        <i data-lucide="lock" class="w-7 h-7"></i>
      </div>
      <h1 class="text-2xl font-bold text-white">Welcome <span class="text-[#B6FF2E]">Back</span></h1>
      <p class="text-xs text-[#94A3B8] mt-1">Sign in to view your quiz scores and safety dashboard</p>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'login_required' && empty($error)) { ?>
      <div class="p-3 rounded-lg bg-amber-950/40 border border-amber-500/40 text-amber-300 mb-4 text-xs flex items-center gap-2">
        <i data-lucide="lock" class="w-4 h-4 shrink-0 text-amber-400"></i>
        <span>Please log in to your account to access that feature.</span>
      </div>
    <?php } ?>

    <?php if ($error) { ?>
      <div class="p-3 rounded-lg bg-rose-950/40 border border-rose-500/40 text-rose-300 mb-4 text-xs flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 text-rose-400"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php } ?>

    <form method="post" class="space-y-4 text-xs">
      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Email Address</label>
        <input 
          type="email" 
          name="email" 
          required 
          class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
          placeholder="name@example.com"
        >
      </div>

      <div>
        <label class="block text-[#E2E8F0] font-semibold mb-1">Password</label>
        <div class="relative">
          <input 
            type="password" 
            name="password" 
            id="loginPass" 
            required 
            class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg px-3.5 py-2.5 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
            placeholder="••••••••"
          >
          <button type="button" id="toggleLoginVis" class="absolute right-3 top-3 text-[#94A3B8] hover:text-[#B6FF2E] text-xs">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <button type="submit" name="login" class="btn-green w-full py-2.5 rounded-lg text-xs font-bold mt-2 shadow-lg">
        Sign In
      </button>
    </form>

    <div class="mt-6 pt-4 border-t border-[#323743] text-center text-xs text-[#94A3B8]">
      Don't have an account? 
      <a href="register.php" class="text-[#B6FF2E] font-semibold hover:underline ml-1">Create one here</a>
    </div>
  </div>
</div>

<script>
  var toggleBtn = document.getElementById('toggleLoginVis');
  var passInput = document.getElementById('loginPass');
  if (toggleBtn && passInput) {
    var vis = false;
    toggleBtn.addEventListener('click', function() {
      vis = !vis;
      passInput.type = vis ? 'text' : 'password';
      this.innerHTML = vis ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
    });
  }
</script>

<?php include "includes/footer.php"; ?>
