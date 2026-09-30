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
      <div class="text-3xl mb-2">🔒</div>
      <h1 class="text-2xl font-bold text-[#064E3B]">Welcome Back</h1>
      <p class="text-xs text-[#35604F] mt-1">Sign in to view your quiz scores and safety dashboard</p>
    </div>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'login_required' && empty($error)) { ?>
      <div class="p-3 rounded-lg bg-amber-100 border border-amber-300 text-amber-700 mb-4 text-xs flex items-center gap-2">
        <i class="fa-solid fa-lock text-sm shrink-0"></i>
        <span>Please log in to your account to access that feature.</span>
      </div>
    <?php } ?>

    <?php if ($error) { ?>
      <div class="p-3 rounded-lg bg-rose-100 border border-rose-300 text-rose-700 mb-4 text-xs flex items-center gap-2">
        <i class="fa-solid fa-circle-exclamation text-sm shrink-0"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
      </div>
    <?php } ?>

    <form method="post" class="space-y-4 text-xs">
      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Email Address</label>
        <input 
          type="email" 
          name="email" 
          required 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
          placeholder="name@example.com"
        >
      </div>

      <div>
        <label class="block text-[#064E3B] font-semibold mb-1">Password</label>
        <div class="relative">
          <input 
            type="password" 
            name="password" 
            id="loginPass"
            required 
            class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-lg px-3.5 py-2.5 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
            placeholder="••••••••"
          >
          <button type="button" id="toggleLoginVis" class="absolute right-3 top-3 text-[#35604F] hover:text-[#043B2D] text-xs">
            <i class="fa-solid fa-eye"></i>
          </button>
        </div>
      </div>

      <button type="submit" name="login" class="btn-green w-full py-2.5 rounded-lg text-xs font-bold mt-2">
        Sign In
      </button>
    </form>

    <div class="mt-6 pt-4 border-t border-[#D9BF8F] text-center text-xs text-[#35604F]">
      Don't have an account? 
      <a href="register.php" class="text-[#064E3B] font-semibold hover:underline ml-1">Create one here</a>
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
      toggleBtn.innerHTML = vis ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
    });
  }
</script>

<?php include "includes/footer.php"; ?>
