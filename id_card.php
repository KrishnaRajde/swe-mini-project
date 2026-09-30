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
    <div class="text-3xl mb-1">🪪</div>
    <h1 class="text-2xl font-bold text-[#064E3B]">CyberSafe Certified ID Card</h1>
    <p class="text-xs text-[#35604F] mt-1">Official certificate showing your cybersecurity awareness credential</p>
  </div>

  <!-- Notice if quiz score is 0 -->
  <?php if ($quiz_score == 0) { ?>
    <div class="max-w-md mx-auto mb-6 p-4 rounded-xl bg-[#F3DDB5] border border-[#D9BF8F] text-xs text-center no-print">
      <div class="text-[#064E3B] font-semibold mb-1">Want to update your Quiz Score?</div>
      <p class="text-[#35604F] mb-3">You can take the 10-question cyber quiz anytime to display your latest score on your ID card.</p>
      <a href="quiz.php" class="btn-green px-4 py-1.5 rounded-lg text-xs font-bold inline-block">Take Quiz Now &rarr;</a>
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
          <span class="text-[#064E3B] text-xl"><i class="fa-solid fa-shield-halved"></i></span>
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
          <?php if (!empty($photo) && file_exists($photo)) { ?>
            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo" class="w-full h-full object-cover">
          <?php } else { ?>
            <span class="text-3xl text-[#35604F]"><i class="fa-solid fa-user"></i></span>
          <?php } ?>
        </div>

        <!-- User Details -->
        <div class="id-details">
          <div class="id-name"><?php echo htmlspecialchars($user['name']); ?></div>
          <div class="id-number"><?php echo htmlspecialchars($cybersafe_id); ?></div>
          <div class="id-badge">
            <i class="fa-solid fa-circle-check mr-1 text-[#064E3B]"></i> Certified CyberSafe User
          </div>
        </div>

        <!-- Quiz Score Box -->
        <div class="id-score-area">
          <div class="id-score-label">Quiz Score</div>
          <div class="id-score-num <?php echo $score_color; ?>">
            <?php echo $quiz_score; ?><span class="text-xs text-[#35604F] font-normal">/10</span>
          </div>
          <div class="text-[9px] text-[#35604F]">Awareness</div>
        </div>

      </div>

      <!-- 3. Footer -->
      <div class="id-card-footer">
        <div>
          <span>Issue Date: </span>
          <strong class="text-[#064E3B]"><?php echo htmlspecialchars($issue_date); ?></strong>
        </div>
        <div class="flex items-center gap-1.5">
          <i class="fa-solid fa-fingerprint text-[#064E3B]"></i>
          <span>Verified Digital ID</span>
        </div>
      </div>

    </div>
  </div>

  <!-- Action Buttons (no-print) -->
  <div class="mt-6 flex flex-wrap justify-center items-center gap-3 no-print">
    
    <!-- Download PNG Button -->
    <button type="button" onclick="downloadCard()" class="btn-green py-2.5 px-5 rounded-xl text-xs font-bold flex items-center gap-2 shadow-lg">
      <i class="fa-solid fa-download"></i>
      <span>Download PNG</span>
    </button>

    <!-- Print Button -->
    <button type="button" onclick="window.print()" class="btn-outline py-2.5 px-5 rounded-xl text-xs font-bold flex items-center gap-2">
      <i class="fa-solid fa-print"></i>
      <span>Print Card</span>
    </button>

    <!-- Upload/Change Photo Button -->
    <a href="upload_photo.php" class="py-2.5 px-4 rounded-xl bg-[#F3DDB5] text-[#064E3B] hover:text-[#043B2D] border border-[#D9BF8F] text-xs flex items-center gap-2 transition-colors">
      <i class="fa-solid fa-camera"></i>
      <span><?php echo empty($photo) ? 'Upload Photo' : 'Change Photo'; ?></span>
    </a>

    <!-- Retake Quiz Button -->
    <a href="quiz.php" class="py-2.5 px-4 rounded-xl bg-[#F3DDB5] text-[#064E3B] hover:text-[#043B2D] border border-[#D9BF8F] text-xs flex items-center gap-2 transition-colors">
      <i class="fa-solid fa-arrows-rotate"></i>
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
      backgroundColor: null
    }).then(function(canvas) {
      var link = document.createElement("a");
      link.download = "CyberSafe_Certified_ID_Card.png";
      link.href = canvas.toDataURL("image/png");
      link.click();
    });
  }
</script>

<?php include "includes/footer.php"; ?>
