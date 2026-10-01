<?php
// CyberSafe - Phishing Detector Module (Lime Spark & Graphite Theme with Lucide SVG Icons)
include "includes/db.php";
check_login();

$message = "";
$flags = [];
$result = "";

if (isset($_POST['check'])) {
    $message = trim($_POST['message']);
    $text = strtolower($message);

    if ($message != "") {
        $urgent = ["urgent", "immediately", "act now", "within 24 hours", "account suspended", "account will be blocked", "verify now", "last warning"];
        $money = ["you have won", "lottery", "prize", "claim your reward", "cashback", "free gift", "refund", "gift card"];
        $personal = ["otp", "password", "pin", "cvv", "bank details", "aadhaar", "kyc", "login details", "card number"];
        $shortLinks = ["bit.ly", "tinyurl", "goo.gl", "t.co", "is.gd", "cutt.ly"];

        foreach ($urgent as $w) {
            if (strpos($text, $w) !== false) {
                $flags[] = "Creates false urgency or panic (e.g., \"" . $w . "\")";
            }
        }
        foreach ($money as $w) {
            if (strpos($text, $w) !== false) {
                $flags[] = "Promises free money or lottery prizes (e.g., \"" . $w . "\")";
            }
        }
        foreach ($personal as $w) {
            if (strpos($text, $w) !== false) {
                $flags[] = "Asks for sensitive personal info (e.g., \"" . $w . "\")";
            }
        }
        foreach ($shortLinks as $w) {
            if (strpos($text, $w) !== false) {
                $flags[] = "Uses a shortened link (" . $w . ") which hides where the link actually goes";
            }
        }

        if (strpos($text, "http://") !== false) {
            $flags[] = "Contains an insecure web link (http instead of secure https)";
        }
        if (preg_match('/https?:\/\/\d+\.\d+\.\d+\.\d+/', $text)) {
            $flags[] = "The link uses raw numbers (IP address) instead of a real company website name";
        }
        if (strpos($text, "dear customer") !== false || strpos($text, "dear user") !== false) {
            $flags[] = "Uses a generic greeting ('Dear customer') instead of addressing you by name";
        }
        if (substr_count($message, "!") >= 3) {
            $flags[] = "Uses too many exclamation marks (!!!) to make it look dramatic";
        }

        $count = count($flags);
        if ($count == 0) {
            $result = "Looks Safe";
        } elseif ($count <= 2) {
            $result = "Suspicious";
        } else {
            $result = "Likely Phishing";
        }
    }
}

$title = "Phishing Detector";
include "includes/header.php";
?>

<div class="max-w-3xl mx-auto">
  <!-- Header -->
  <div class="mb-6 text-center sm:text-left">
    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 flex items-center justify-center sm:justify-start gap-2.5">
      <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
        <i data-lucide="mail-warning" class="w-5 h-5"></i>
      </div>
      <span>Phishing Message <span class="text-[#B6FF2E]">Detector</span></span>
    </h1>
    <p class="text-sm text-[#94A3B8]">
      Got a weird email, SMS, or WhatsApp message? Paste it here to check for common scam warning signs.
    </p>
  </div>

  <!-- Input Form -->
  <div class="cyber-box rounded-xl p-5 sm:p-6 mb-6 border border-[#323743]">
    <form method="post">
      <label class="block text-xs font-semibold text-white mb-2">
        Paste the suspicious message or email text below:
      </label>
      <textarea 
        name="message" 
        id="msgBox" 
        rows="6" 
        class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-lg p-3 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
        placeholder="Example: Dear customer, your account will be blocked within 24 hours. Please click http://... to verify your KYC."
        required
      ><?php echo htmlspecialchars($message); ?></textarea>

      <!-- Quick sample buttons -->
      <div class="mt-2.5 flex flex-wrap items-center gap-2 text-xs">
        <span class="text-[#94A3B8]">Try a sample:</span>
        <button type="button" class="sample-btn px-2.5 py-1 rounded bg-[#181A20] text-[#E2E8F0] hover:text-[#B6FF2E] border border-[#323743] hover:border-[#B6FF2E] transition-colors" data-type="bank">
          Bank KYC Scam
        </button>
        <button type="button" class="sample-btn px-2.5 py-1 rounded bg-[#181A20] text-[#E2E8F0] hover:text-[#B6FF2E] border border-[#323743] hover:border-[#B6FF2E] transition-colors" data-type="lottery">
          Lottery Prize Scam
        </button>
        <button type="button" class="sample-btn px-2.5 py-1 rounded bg-[#181A20] text-[#E2E8F0] hover:text-[#B6FF2E] border border-[#323743] hover:border-[#B6FF2E] transition-colors" data-type="normal">
          Normal Message
        </button>
      </div>

      <div class="mt-5 flex justify-end">
        <button type="submit" name="check" class="btn-green px-6 py-2.5 rounded-lg text-xs font-bold flex items-center gap-2 shadow-lg">
          <span>Check Message</span>
          <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </button>
      </div>
    </form>
  </div>

  <!-- Results Section -->
  <?php if ($result != "") { 
      $cardColor = "border-[#B6FF2E]/60 bg-[#B6FF2E]/10";
      $textColor = "text-[#B6FF2E]";
      $lucideIcon = "check-circle-2";
      $summary = "We didn't find any common phishing keywords or red flags.";

      if ($result == "Suspicious") {
          $cardColor = "border-amber-500/60 bg-amber-950/30";
          $textColor = "text-amber-400";
          $lucideIcon = "alert-triangle";
          $summary = "Be careful! This message contains some suspicious signs often used in scams.";
      } elseif ($result == "Likely Phishing") {
          $cardColor = "border-rose-500/60 bg-rose-950/30";
          $textColor = "text-rose-400";
          $lucideIcon = "alert-circle";
          $summary = "Warning! This message has multiple red flags commonly seen in phishing scams. Do not click links or share details!";
      }
  ?>
    <div class="rounded-xl p-5 border-2 <?php echo $cardColor; ?> mb-6">
      <div class="flex items-center gap-3 mb-2">
        <i data-lucide="<?php echo $lucideIcon; ?>" class="w-6 h-6 <?php echo $textColor; ?>"></i>
        <h3 class="text-lg font-bold <?php echo $textColor; ?>">
          Result: <?php echo $result; ?>
        </h3>
      </div>
      <p class="text-xs text-[#E2E8F0] mb-3"><?php echo $summary; ?></p>

      <?php if (count($flags) > 0) { ?>
        <div class="bg-[#181A20] rounded-lg p-3.5 border border-[#323743] text-xs">
          <strong class="text-white block mb-1.5">Warning signs detected:</strong>
          <ul class="space-y-1.5 text-[#E2E8F0]">
            <?php foreach ($flags as $f) { ?>
              <li class="flex items-start gap-2">
                <span class="text-rose-400 font-bold">&bull;</span>
                <span><?php echo htmlspecialchars($f); ?></span>
              </li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <!-- Helpful advice -->
  <div class="cyber-box rounded-xl p-5 text-xs text-[#E2E8F0] border border-[#323743]">
    <h4 class="font-bold text-[#B6FF2E] mb-2 text-sm flex items-center gap-2">
      <i data-lucide="lightbulb" class="w-4 h-4 text-[#B6FF2E]"></i>
      <span>Quick Safety Tips</span>
    </h4>
    <ul class="space-y-1 text-[#94A3B8]">
      <li>&bull; Never share OTPs, PINs, or passwords with anyone over call or SMS.</li>
      <li>&bull; Check the sender's email address closely to make sure it's genuine.</li>
      <li>&bull; If an email looks urgent, open the official app or website directly instead of clicking links.</li>
    </ul>
  </div>
</div>

<script>
  var msgBox = document.getElementById('msgBox');
  var samples = {
    bank: "URGENT: Dear customer, your bank account will be blocked within 24 hours due to pending KYC verification. Please click http://192.168.1.1/update-kyc and submit your OTP immediately to avoid disruption!",
    lottery: "CONGRATULATIONS!! You have won a cash prize of ₹25,000 in our lucky draw! Claim your reward today at bit.ly/free-reward-gift card before it expires!",
    normal: "Hey, can you review the report we discussed this morning? It's saved in the project folder on Google Drive. Thanks!"
  };

  document.querySelectorAll('.sample-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var t = this.getAttribute('data-type');
      if (samples[t]) {
        msgBox.value = samples[t];
      }
    });
  });
</script>

<?php include "includes/footer.php"; ?>
