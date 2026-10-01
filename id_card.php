<?php
// CyberSafe - Certified ID Card Generator
include "includes/db.php";
check_login();

$user_id = (int) $_SESSION['user_id'];

// Fetch user data
$stmt = mysqli_prepare($conn, "SELECT user_id, name, email, quiz_score, photo FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: login.php");
    exit;
}

// Generate CyberSafe ID (CS- + 5-digit zero-padded user_id)
$cybersafe_id = "CS-" . str_pad($user['user_id'], 5, "0", STR_PAD_LEFT);
$issue_date = date("d-M-Y");
$quiz_score = isset($user['quiz_score']) ? (int) $user['quiz_score'] : 0;
$photo = $user['photo'] ?? "";

// Score badge color
$score_color = "score-green";
if ($quiz_score < 5) {
    $score_color = "score-red";
} elseif ($quiz_score < 8) {
    $score_color = "score-yellow";
}

$title = "CyberSafe ID Card";
include "includes/header.php";
?>

<!-- HTML2Canvas CDN for PNG Download -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<div class="max-w-4xl mx-auto my-6">

  <!-- Page Title -->
  <div class="text-center mb-6 no-print">
    <div class="w-12 h-12 mx-auto mb-2.5 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shadow-lg shadow-[#B6FF2E]/10">
      <i data-lucide="id-card" class="w-6 h-6"></i>
    </div>
    <h1 class="text-2xl font-bold text-white">CyberSafe <span class="text-[#B6FF2E]">Certified ID Card</span></h1>
    <p class="text-xs text-[#94A3B8] mt-1">Official certificate showing your cybersecurity awareness credential</p>
  </div>

  <!-- Notice if quiz score is 0 -->
  <?php if ($quiz_score == 0) { ?>
    <div class="max-w-md mx-auto mb-6 p-4 rounded-xl bg-[#23262F] border border-[#323743] text-xs text-center no-print">
      <div class="text-[#B6FF2E] font-semibold mb-1 flex items-center justify-center gap-1.5">
        <i data-lucide="help-circle" class="w-4 h-4"></i>
        <span>Want to update your Quiz Score?</span>
      </div>
      <p class="text-[#94A3B8] mb-3">You can take the 10-question cyber quiz anytime to display your latest score on your ID card.</p>
      <a href="quiz.php" class="btn-green px-4 py-1.5 rounded-lg text-xs font-bold inline-flex items-center gap-1.5 shadow">
        <span>Take Quiz Now</span>
        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
      </a>
    </div>
  <?php } ?>

  <!-- ==============================================
       CYBERSAFE CERTIFIED ID CARD (Print & PNG Target)
       ============================================== -->
  <div class="id-card-wrapper">
    <div id="idCard">
      
      <!-- 1. Header -->
      <div class="id-card-header">
        <div class="flex items-center gap-2">
          <i data-lucide="shield-check" class="w-6 h-6 text-[#B6FF2E]"></i>
          <div>
            <div class="id-header-title">CyberSafe Certified ID</div>
            <div class="id-header-sub">OFFICIAL SECURITY CREDENTIAL</div>
          </div>
        </div>
        <!-- Smart Chip Graphic -->
        <div class="id-chip"></div>
      </div>

      <!-- 2. Body -->
      <div class="id-card-body">
        
        <!-- Circular User Photo -->
        <div class="id-photo">
          <?php if (!empty($photo) && (file_exists($photo) || file_exists(__DIR__ . '/' . $photo))) { ?>
            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo" crossorigin="anonymous" class="w-full h-full object-cover">
          <?php } else { ?>
            <i data-lucide="user" class="w-8 h-8 text-[#94A3B8]"></i>
          <?php } ?>
        </div>

        <!-- User Details -->
        <div class="id-details">
          <div class="id-name"><?php echo htmlspecialchars($user['name']); ?></div>
          <div class="id-number"><?php echo htmlspecialchars($cybersafe_id); ?></div>
          <div class="id-badge flex items-center gap-1 w-max">
            <i data-lucide="badge-check" class="w-3.5 h-3.5 text-[#B6FF2E]"></i>
            <span>Certified CyberSafe User</span>
          </div>
        </div>

        <!-- Quiz Score Box -->
        <div class="id-score-area">
          <div class="id-score-label">Quiz Score</div>
          <div class="id-score-num <?php echo $score_color; ?>">
            <?php echo $quiz_score; ?><span class="text-xs text-[#94A3B8] font-normal">/10</span>
          </div>
          <div class="text-[9px] text-[#94A3B8]">Awareness</div>
        </div>

      </div>

      <!-- 3. Footer -->
      <div class="id-card-footer">
        <div>
          <span>Issue Date: </span>
          <strong class="text-[#B6FF2E]"><?php echo htmlspecialchars($issue_date); ?></strong>
        </div>
        <div class="flex items-center gap-1.5">
          <i data-lucide="fingerprint" class="w-3.5 h-3.5 text-[#B6FF2E]"></i>
          <span>Verified Digital ID</span>
        </div>
      </div>

    </div>
  </div>

  <!-- Action Buttons (no-print) -->
  <div class="mt-6 flex flex-wrap justify-center items-center gap-3 no-print">
    
    <!-- Download PNG Button -->
    <button type="button" onclick="downloadCard()" class="btn-green py-2.5 px-5 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg">
      <i data-lucide="download" class="w-4 h-4"></i>
      <span>Download PNG</span>
    </button>

    <!-- Print Button -->
    <button type="button" onclick="window.print()" class="btn-outline py-2.5 px-5 rounded-xl text-xs font-bold flex items-center gap-2">
      <i data-lucide="printer" class="w-4 h-4"></i>
      <span>Print Card</span>
    </button>

    <!-- Upload/Change Photo Button -->
    <a href="upload_photo.php" class="py-2.5 px-4 rounded-xl bg-[#23262F] text-[#E2E8F0] hover:text-[#B6FF2E] hover:border-[#B6FF2E] border border-[#323743] text-xs flex items-center gap-2 transition-colors">
      <i data-lucide="camera" class="w-4 h-4"></i>
      <span><?php echo empty($photo) ? 'Upload Photo' : 'Change Photo'; ?></span>
    </a>

    <!-- Retake Quiz Button -->
    <a href="quiz.php" class="py-2.5 px-4 rounded-xl bg-[#23262F] text-[#E2E8F0] hover:text-[#B6FF2E] hover:border-[#B6FF2E] border border-[#323743] text-xs flex items-center gap-2 transition-colors">
      <i data-lucide="rotate-cw" class="w-4 h-4"></i>
      <span>Retake Quiz</span>
    </a>

  </div>

</div>

<!-- JavaScript for PNG Download -->
<script>
  function downloadCard() {
    var card = document.getElementById("idCard");
    html2canvas(card, {
      scale: 3,
      useCORS: true,
      allowTaint: true,
      backgroundColor: null
    }).then(function(canvas) {
      var link = document.createElement("a");
      link.download = "CyberSafe_Certified_ID_Card.png";
      link.href = canvas.toDataURL("image/png");
      link.click();
    }).catch(function(err) {
      console.error("Canvas error:", err);
      alert("Could not generate PNG download automatically. Using Print dialog instead.");
      window.print();
    });
  }
</script>

<?php include "includes/footer.php"; ?>
