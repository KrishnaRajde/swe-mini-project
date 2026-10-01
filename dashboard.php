<?php
// CyberSafe - User Dashboard (Lime Spark & Graphite Theme with Lucide SVG Icons)
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
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#323743]">
    <div>
      <h1 class="text-2xl sm:text-3xl font-bold text-white">
        Hello, <span class="text-[#B6FF2E]"><?php echo htmlspecialchars($user['name']); ?></span>
      </h1>
      <p class="text-xs sm:text-sm text-[#94A3B8] mt-1">
        Welcome to your CyberSafe student security awareness dashboard.
      </p>
    </div>
    <div class="flex items-center gap-2">
      <a href="id_card.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg">
        <i data-lucide="id-card" class="w-4 h-4"></i>
        <span>My ID Card</span>
      </a>
      <a href="logout.php" class="p-2 rounded-xl bg-[#23262F] border border-[#323743] text-rose-400 hover:text-rose-300 text-xs font-semibold flex items-center transition-colors" title="Logout">
        <i data-lucide="log-out" class="w-4 h-4"></i>
      </a>
    </div>
  </div>

  <!-- Key Metrics Row -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    
    <!-- Card 1: User Profile -->
    <div class="cyber-box rounded-2xl p-5 border border-[#323743] flex items-center gap-4">
      <div class="w-14 h-14 rounded-full border-2 border-[#B6FF2E] overflow-hidden bg-[#181A20] shrink-0 flex items-center justify-center shadow-md shadow-[#B6FF2E]/10">
        <?php if (!empty($photo) && (file_exists($photo) || file_exists(__DIR__ . '/' . $photo))) { ?>
          <img src="<?php echo htmlspecialchars($photo); ?>" alt="Photo" class="w-full h-full object-cover">
        <?php } else { ?>
          <i data-lucide="user" class="w-6 h-6 text-[#94A3B8]"></i>
        <?php } ?>
      </div>
      <div class="min-w-0 flex-1">
        <div class="text-xs text-[#94A3B8] font-medium">Logged-in User</div>
        <div class="text-base font-bold text-white truncate"><?php echo htmlspecialchars($user['name']); ?></div>
        <div class="text-[11px] text-[#B6FF2E] font-mono"><?php echo htmlspecialchars($cybersafe_id); ?></div>
      </div>
      <a href="upload_photo.php" class="text-[#94A3B8] hover:text-[#B6FF2E] text-xs p-1.5 transition-colors rounded-lg hover:bg-[#181A20]" title="Change photo">
        <i data-lucide="camera" class="w-4 h-4"></i>
      </a>
    </div>

    <!-- Card 2: Latest Quiz Score -->
    <div class="cyber-box rounded-2xl p-5 border border-[#323743] flex items-center justify-between">
      <div>
        <div class="text-xs text-[#94A3B8] font-medium">Latest Quiz Score</div>
        <div class="text-2xl font-extrabold text-[#B6FF2E] mt-0.5">
          <span><?php echo $quiz_score; ?></span>
          <span class="text-[#94A3B8] text-sm font-normal">/ 10</span>
        </div>
        <div class="text-[11px] mt-1.5">
          <?php echo $quiz_score >= 8 
            ? '<span class="text-[#B6FF2E] flex items-center gap-1 font-semibold"><i data-lucide="award" class="w-3.5 h-3.5"></i> Excellent awareness</span>' 
            : ($quiz_score >= 5 
              ? '<span class="text-amber-400 flex items-center gap-1 font-semibold"><i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Passing score</span>' 
              : '<span class="text-rose-400 flex items-center gap-1 font-semibold"><i data-lucide="book-open" class="w-3.5 h-3.5"></i> Needs practice</span>'); ?>
        </div>
      </div>
      <a href="quiz.php" class="btn-outline px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
        <i data-lucide="play" class="w-3.5 h-3.5"></i>
        <span>Take Quiz</span>
      </a>
    </div>

    <!-- Card 3: CyberSafe Certified ID -->
    <div class="cyber-box rounded-2xl p-5 border border-[#B6FF2E]/30 bg-gradient-to-br from-[#23262F] to-[#181A20] flex items-center justify-between">
      <div>
        <div class="text-xs text-[#B6FF2E] font-semibold flex items-center gap-1.5">
          <i data-lucide="shield-check" class="w-4 h-4"></i> Certified ID Card
        </div>
        <div class="text-sm font-bold text-white mt-1">Ready for Print / PNG</div>
        <div class="text-[11px] text-[#94A3B8] mt-0.5">Official student security credential</div>
      </div>
      <a href="id_card.php" class="btn-green px-3.5 py-1.5 rounded-lg text-xs font-bold shrink-0 shadow flex items-center gap-1.5">
        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
        <span>View Card</span>
      </a>
    </div>

  </div>

  <!-- Quick Cyber Security Tips -->
  <div class="cyber-box rounded-2xl p-6 border border-[#323743]">
    <div class="flex items-center gap-2.5 mb-4">
      <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
        <i data-lucide="lightbulb" class="w-4 h-4"></i>
      </div>
      <h2 class="text-base font-bold text-white">Essential Cyber Security Tips</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
      <div class="p-3.5 rounded-xl bg-[#181A20] border border-[#323743] flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="key-round" class="w-4 h-4"></i>
        </div>
        <div>
          <strong class="text-white block mb-1">Use Strong &amp; Unique Passwords</strong>
          <p class="text-[#94A3B8] leading-relaxed">
            Never reuse the same password across multiple websites. If one service gets hacked, your other accounts will remain safe.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#181A20] border border-[#323743] flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 shrink-0">
          <i data-lucide="alert-triangle" class="w-4 h-4"></i>
        </div>
        <div>
          <strong class="text-white block mb-1">Beware of Urgent Messages</strong>
          <p class="text-[#94A3B8] leading-relaxed">
            Banks, colleges, and government agencies will never ask for your password, PIN, or OTP over SMS, phone call, or email.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#181A20] border border-[#323743] flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="wifi" class="w-4 h-4"></i>
        </div>
        <div>
          <strong class="text-white block mb-1">Avoid Banking on Public Wi-Fi</strong>
          <p class="text-[#94A3B8] leading-relaxed">
            Public Wi-Fi networks in cafes or stations can be eavesdropped. Use your mobile data hotspot when making financial transactions.
          </p>
        </div>
      </div>

      <div class="p-3.5 rounded-xl bg-[#181A20] border border-[#323743] flex items-start gap-3">
        <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="refresh-cw" class="w-4 h-4"></i>
        </div>
        <div>
          <strong class="text-white block mb-1">Keep Software &amp; Apps Updated</strong>
          <p class="text-[#94A3B8] leading-relaxed">
            Regular operating system and browser updates patch security vulnerabilities before cyber criminals can exploit them.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Shortcut Modules Grid (5 Core Modules) -->
  <div>
    <div class="flex items-center justify-between mb-4">
      <div class="flex items-center gap-2">
        <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
          <i data-lucide="layers" class="w-4 h-4"></i>
        </div>
        <h2 class="text-base font-bold text-white">
          Cyber Security Modules &amp; Tools
        </h2>
      </div>
      <span class="text-xs text-[#94A3B8]">Diploma Project Features</span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      
      <!-- 1. Quiz -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between border border-[#323743]">
        <div>
          <div class="w-11 h-11 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] mb-3.5">
            <i data-lucide="help-circle" class="w-5 h-5"></i>
          </div>
          <h3 class="text-sm font-bold text-white mb-1.5">Cyber Security Quiz</h3>
          <p class="text-xs text-[#94A3B8] leading-relaxed mb-4">
            Test your online safety knowledge with 10 questions and update your latest certified score.
          </p>
        </div>
        <a href="quiz.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center shadow flex items-center justify-center gap-1.5">
          <span>Start Quiz</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 2. Phishing Detector -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between border border-[#323743]">
        <div>
          <div class="w-11 h-11 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] mb-3.5">
            <i data-lucide="mail-warning" class="w-5 h-5"></i>
          </div>
          <h3 class="text-sm font-bold text-white mb-1.5">Phishing Detector</h3>
          <p class="text-xs text-[#94A3B8] leading-relaxed mb-4">
            Paste suspicious emails, SMS, or WhatsApp messages to scan for scam patterns and red flags.
          </p>
        </div>
        <a href="phishing_detector.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center shadow flex items-center justify-center gap-1.5">
          <span>Open Detector</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 3. Password Analyzer -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between border border-[#323743]">
        <div>
          <div class="w-11 h-11 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] mb-3.5">
            <i data-lucide="key-round" class="w-5 h-5"></i>
          </div>
          <h3 class="text-sm font-bold text-white mb-1.5">Password Analyzer</h3>
          <p class="text-xs text-[#94A3B8] leading-relaxed mb-4">
            Check password complexity, estimate crack times, and view instant security suggestions.
          </p>
        </div>
        <a href="password_analyzer.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center shadow flex items-center justify-center gap-1.5">
          <span>Analyze Password</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 4. Password Generator -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between border border-[#323743]">
        <div>
          <div class="w-11 h-11 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] mb-3.5">
            <i data-lucide="zap" class="w-5 h-5"></i>
          </div>
          <h3 class="text-sm font-bold text-white mb-1.5">Password Generator</h3>
          <p class="text-xs text-[#94A3B8] leading-relaxed mb-4">
            Generate strong random passwords using browser cryptography and copy them in one click.
          </p>
        </div>
        <a href="password_generator.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold text-center shadow flex items-center justify-center gap-1.5">
          <span>Generate Password</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
      </div>

      <!-- 5. ID Card Generator -->
      <div class="cyber-box rounded-2xl p-5 flex flex-col justify-between sm:col-span-2 lg:col-span-2 border border-[#B6FF2E]/30">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
          <div class="flex items-start gap-3">
            <div class="w-11 h-11 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
              <i data-lucide="id-card" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-sm font-bold text-white mb-1">CyberSafe ID Card Generator</h3>
              <p class="text-xs text-[#94A3B8] leading-relaxed max-w-lg">
                View your personalized digital ID card featuring your photo, unique CyberSafe ID, quiz score, and official verification badge.
              </p>
            </div>
          </div>
          <div class="flex items-center gap-2 self-end sm:self-center">
            <a href="upload_photo.php" class="btn-outline py-2 px-3 rounded-xl text-xs font-semibold flex items-center gap-1.5">
              <i data-lucide="camera" class="w-3.5 h-3.5"></i>
              <span>Photo</span>
            </a>
            <a href="id_card.php" class="btn-green py-2 px-4 rounded-xl text-xs font-bold flex items-center gap-1.5 shadow-lg">
              <i data-lucide="eye" class="w-3.5 h-3.5"></i>
              <span>View Card</span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<?php include "includes/footer.php"; ?>
