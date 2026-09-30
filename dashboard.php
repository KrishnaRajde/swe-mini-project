<?php
// CyberSafe - User Dashboard
include "includes/db.php";
check_login();

$user_id = (int) $_SESSION['user_id'];

// Get user details from single users table
$stmt = mysqli_prepare($conn, "SELECT user_id, name, email, quiz_score, photo FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

$title = "Dashboard";
include "includes/header.php";

$quiz_score = isset($user['quiz_score']) ? (int) $user['quiz_score'] : 0;
$photo = $user['photo'] ?? "";
$cybersafe_id = "CS-" . str_pad($user['user_id'], 5, "0", STR_PAD_LEFT);
?>

<div class="max-w-5xl mx-auto space-y-6">

  <!-- Welcome Banner -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#D9BF8F]">
    <div>
      <h1 class="text-2xl sm:text-3xl font-bold text-[#064E3B]">
        Hello, <?php echo htmlspecialchars($user['name']); ?> 👋
      </h1>
      <p class="text-xs sm:text-sm text-[#35604F] mt-1">
        Welcome to your CyberSafe student security awareness dashboard.
      </p>
    </div>
    <div class="flex items-center gap-2">
      <a href="id_card.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg">
        <i class="fa-solid fa-id-card"></i>
        <span>My ID Card</span>
      </a>
      <a href="logout.php" class="p-2 rounded-xl bg-[#F3DDB5] border border-[#D9BF8F] text-rose-700 hover:text-rose-800 text-xs font-semibold flex items-center transition-colors" title="Logout">
        <i class="fa-solid fa-right-from-bracket"></i>
      </a>
    </div>
  </div>

  <!-- Key Metrics Row -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
    <!-- Card 1: User Profile -->
    <div class="cyber-box rounded-2xl p-5 border border-[#D9BF8F] flex items-center gap-4">
      <div class="w-14 h-14 rounded-full border-2 border-[#064E3B] overflow-hidden bg-[#FDF8EF] shrink-0 flex items-center justify-center">
        <?php if (!empty($photo) && file_exists($photo)) { ?>
          <img src="<?php echo htmlspecialchars($photo); ?>" alt="Photo" class="w-full h-full object-cover">
        <?php } else { ?>
          <i class="fa-solid fa-user text-xl text-[#35604F]"></i>
        <?php } ?>
      </div>
      <div class="min-w-0 flex-1">
        <div class="text-xs text-[#35604F] font-medium">Logged-in User</div>
        <div class="text-base font-bold text-[#064E3B] truncate"><?php echo htmlspecialchars($user['name']); ?></div>
        <div class="text-[11px] text-[#064E3B] font-mono"><?php echo htmlspecialchars($cybersafe_id); ?></div>
      </div>
      <a href="upload_photo.php" class="text-[#35604F] hover:text-[#043B2D] text-xs p-1" title="Change photo">
        <i class="fa-solid fa-camera"></i>
      </a>
    </div>

    <!-- Card 2: Latest Quiz Score -->
    <div class="cyber-box rounded-2xl p-5 border border-[#D9BF8F] flex items-center justify-between">
      <div>
        <div class="text-xs text-[#35604F] font-medium">Latest Quiz Score</div>
        <div class="text-2xl font-extrabold text-[#064E3B] mt-0.5">
          <span class="text-[#064E3B]"><?php echo $quiz_score; ?></span>
          <span class="text-[#35604F] text-sm font-normal">/ 10</span>
        </div>
        <div class="text-[11px] text-[#35604F] mt-1">
          <?php echo $quiz_score >= 8 ? '🌟 Excellent awareness' : ($quiz_score >= 5 ? '👍 Passing score' : '📚 Needs practice'); ?>
        </div>
      </div>
      <a href="quiz.php" class="btn-outline px-3 py-1.5 rounded-lg text-xs font-bold">
        Take Quiz
      </a>
    </div>

    <!-- Card 3: CyberSafe Certified ID -->
    <div class="cyber-box rounded-2xl p-5 border border-[#064E3B]/40 bg-gradient-to-br from-[#FDF8EF] to-[#F3DDB5] flex items-center justify-between">
      <div>
        <div class="text-xs text-[#064E3B] font-semibold flex items-center gap-1.5">
          <i class="fa-solid fa-shield-halved"></i> Certified ID Card
        </div>
        <div class="text-sm font-bold text-[#064E3B] mt-1">Ready for Print / PNG</div>
        <div class="text-[11px] text-[#35604F] mt-0.5">Official student security credential</div>
      </div>
      <a href="id_card.php" class="btn-green px-3.5 py-1.5 rounded-lg text-xs font-bold shrink-0">
        View Card
      </a>
    </div>

  </div>

  <!-- Quick Cyber Security Tips (Hardcoded list, 3-4 items) -->
  <div class="cyber-box rounded-2xl p-6 border border-[#D9BF8F]">
    <div class="flex items-center gap-2 mb-4">
      <span class="text-xl">💡</span>
      <h2 class="text-base font-bold text-[#064E3B]">Essential Cyber Security Tips</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
      <div class="p-3.5 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] flex items-start gap-3">
        <span class="text-[#064E3B] text-lg mt-0.5"><i class="fa-solid fa-key"></i></span>
        <div>
          <strong class="text-[#064E3B] block mb-1">Use Strong & Unique Passwords</strong>
          <p class="text-[#35604F] leading-relaxed">
            Never reuse the same password across multiple websites. If one service gets hacked, your other accounts will remain safe.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] flex items-start gap-3">
        <span class="text-amber-700 text-lg mt-0.5"><i class="fa-solid fa-triangle-exclamation"></i></span>
        <div>
          <strong class="text-[#064E3B] block mb-1">Beware of Urgent Messages</strong>
          <p class="text-[#35604F] leading-relaxed">
            Banks, colleges, and government agencies will never ask for your password, PIN, or OTP over SMS, phone call, or email.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] flex items-start gap-3">
        <span class="text-[#064E3B] text-lg mt-0.5"><i class="fa-solid fa-wifi"></i></span>
        <div>
          <strong class="text-[#064E3B] block mb-1">Avoid Banking on Public Wi-Fi</strong>
          <p class="text-[#35604F] leading-relaxed">
            Public Wi-Fi networks in cafes or stations can be eavesdropped. Use your mobile data hotspot when making financial transactions.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] flex items-start gap-3">
        <span class="text-[#064E3B] text-lg mt-0.5"><i class="fa-solid fa-arrows-rotate"></i></span>
        <div>
          <strong class="text-[#064E3B] block mb-1">Keep Software & Apps Updated</strong>
          <p class="text-[#35604F] leading-relaxed">
            Regular operating system and browser updates patch security vulnerabilities before cyber criminals can exploit them.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Shortcut Modules Grid (5 Core Modules) -->
  <div>
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-base font-bold text-[#064E3B] flex items-center gap-2">
        <span>⚡</span> Cyber Security Modules & Tools
      </h2>
      <span class="text-xs text-[#35604F]">Diploma Project Features</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      
      <!-- 1. Quiz -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between">
        <div>
          <div class="w-10 h-10 rounded-xl bg-[#F3DDB5] flex items-center justify-center text-xl mb-3">
            ❓
          </div>
          <h3 class="text-sm font-bold text-[#064E3B] mb-1.5">Cyber Security Quiz</h3>
          <p class="text-xs text-[#35604F] leading-relaxed mb-4">
            Test your online safety knowledge with 10 questions and update your latest certified score.
          </p>
        </div>
        <a href="quiz.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center">
          Start Quiz &rarr;
        </a>
      </div>

      <!-- 2. Phishing Detector -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between">
        <div>
          <div class="w-10 h-10 rounded-xl bg-[#F3DDB5] flex items-center justify-center text-xl mb-3">
            🎣
          </div>
          <h3 class="text-sm font-bold text-[#064E3B] mb-1.5">Phishing Detector</h3>
          <p class="text-xs text-[#35604F] leading-relaxed mb-4">
            Paste suspicious emails, SMS, or WhatsApp messages to scan for scam patterns and red flags.
          </p>
        </div>
        <a href="phishing_detector.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center">
          Open Detector &rarr;
        </a>
      </div>

      <!-- 3. Password Analyzer -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between">
        <div>
          <div class="w-10 h-10 rounded-xl bg-[#F3DDB5] flex items-center justify-center text-xl mb-3">
            🔑
          </div>
          <h3 class="text-sm font-bold text-[#064E3B] mb-1.5">Password Analyzer</h3>
          <p class="text-xs text-[#35604F] leading-relaxed mb-4">
            Check password complexity, estimate crack times, and view instant security suggestions.
          </p>
        </div>
        <a href="password_analyzer.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center">
          Analyze Password &rarr;
        </a>
      </div>

      <!-- 4. Password Generator -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between">
        <div>
          <div class="w-10 h-10 rounded-xl bg-[#F3DDB5] flex items-center justify-center text-xl mb-3">
            ⚡
          </div>
          <h3 class="text-sm font-bold text-[#064E3B] mb-1.5">Password Generator</h3>
          <p class="text-xs text-[#35604F] leading-relaxed mb-4">
            Generate strong random passwords using browser cryptography and copy them in one click.
          </p>
        </div>
        <a href="password_generator.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center">
          Generate Password &rarr;
        </a>
      </div>

      <!-- 5. ID Card Generator -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between sm:col-span-2 lg:col-span-2 border border-[#064E3B]/30">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
          <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#F3DDB5] border border-[#D9BF8F] flex items-center justify-center text-xl shrink-0">
              🪪
            </div>
            <div>
              <h3 class="text-sm font-bold text-[#064E3B] mb-1">CyberSafe ID Card Generator</h3>
              <p class="text-xs text-[#35604F] leading-relaxed max-w-lg">
                View your personalized digital ID card featuring your photo, unique CyberSafe ID, quiz score, and official verification badge.
              </p>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-center">
            <a href="upload_photo.php" class="btn-outline py-2 px-3 rounded-xl text-xs font-semibold flex items-center gap-1.5">
              <i class="fa-solid fa-camera"></i> Photo
            </a>
            <a href="id_card.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-1.5 shadow-lg">
              <i class="fa-solid fa-eye"></i> View Card
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<?php include "includes/footer.php"; ?>
