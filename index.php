<?php
include "includes/db.php";
$title = "Home";
include "includes/header.php";
?>

<!-- Hero Header (Section 1: Home) -->
<div id="section-home" class="scroll-mt-24 text-center py-6 sm:py-10">
  <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shadow-xl shadow-[#B6FF2E]/10">
    <i data-lucide="shield-check" class="w-8 h-8"></i>
  </div>
  <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight mb-2">
    Cyber Security <span class="text-[#B6FF2E]">Awareness</span>
  </h1>
  <p class="text-[#B6FF2E] font-medium text-sm sm:text-base mb-3">
    Stay Safe in the Digital World
  </p>
  <p class="text-xs sm:text-sm text-[#94A3B8] max-w-xl mx-auto mb-6">
    A simple web project built to help students and beginners understand basic cyber safety, identify online scams, and test password strengths.
  </p>
  <div class="flex flex-wrap items-center justify-center gap-3">
    <a href="#section-safety" class="btn-green px-5 py-2.5 rounded-lg text-xs font-bold shadow-lg flex items-center gap-1.5">
      <span>Get Started</span>
      <i data-lucide="arrow-down" class="w-3.5 h-3.5"></i>
    </a>
    <a href="#password-checker" class="btn-outline px-4 py-2.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
      <span>Test Password</span>
      <i data-lucide="key-round" class="w-3.5 h-3.5"></i>
    </a>
  </div>
</div>

<!-- Section 2: Safety Tips & Fundamentals -->
<div id="section-safety" class="scroll-mt-24 space-y-4 max-w-4xl mx-auto mb-14">
  <div class="flex items-center justify-between pb-2 border-b border-[#323743]">
    <h2 class="text-lg font-bold text-white flex items-center gap-2.5">
      <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
        <i data-lucide="shield" class="w-4 h-4"></i>
      </div>
      <span>Cyber Safety Fundamentals</span>
    </h2>
    <a href="learn.php" class="text-xs text-[#B6FF2E] hover:underline font-medium flex items-center gap-1">
      <span>View All 5 Modules</span>
      <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
    </a>
  </div>

  <!-- Card 1: What is Cyber Security? -->
  <div class="cyber-box rounded-xl p-5 sm:p-6 border-l-4 border-l-[#B6FF2E] border border-[#323743]">
    <h3 class="text-base font-bold text-white mb-2 flex items-center gap-2">
      <i data-lucide="shield-alert" class="w-5 h-5 text-[#B6FF2E]"></i>
      <span>What is Cyber Security?</span>
    </h3>
    <p class="text-[#E2E8F0] text-sm leading-relaxed">
      Cyber Security is the practice of protecting computers, smartphones, networks, and personal data from digital attacks. In today's world, everything is connected to the internet — making it very important to stay safe online. Hackers use many tricks to steal your personal information, money, or damage your devices.
    </p>
  </div>

  <!-- Card 2: Why Does It Matter? -->
  <div class="cyber-box rounded-xl p-5 sm:p-6 border-l-4 border-l-amber-500 border border-[#323743]">
    <h3 class="text-base font-bold text-amber-400 mb-3 flex items-center gap-2">
      <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-400"></i>
      <span>Why Does It Matter?</span>
    </h3>
    <ul class="space-y-2 text-sm text-[#E2E8F0]">
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
        <span>Over 4,000 cyber attacks happen every day worldwide.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
        <span>Phishing emails trick millions of users into giving away passwords.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
        <span>Weak passwords are the #1 cause of account hacking.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shrink-0"></span>
        <span>Anyone with a phone or computer can become a victim if not careful.</span>
      </li>
    </ul>
  </div>

  <div class="text-center pt-2">
    <a href="learn.php" class="btn-green px-5 py-2.5 rounded-lg text-xs font-bold inline-block shadow-lg">
      Read Complete Safety Tips Guide &rarr;
    </a>
  </div>
</div>

<!-- Section 3: Clean & Simple Password Checker Tool -->
<div id="password-checker" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#323743]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 pb-3 border-b border-[#323743]">
      <div>
        <h3 class="text-lg font-bold text-white flex items-center gap-2.5">
          <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
            <i data-lucide="key-round" class="w-4 h-4"></i>
          </div>
          <span>Password Strength Checker</span>
        </h3>
        <p class="text-xs text-[#94A3B8] mt-0.5">Test any password to see how strong it is and get instant tips.</p>
      </div>
      <button id="genBtn" type="button" class="btn-outline-green px-3 py-1.5 rounded-lg text-xs font-semibold self-start sm:self-auto flex items-center gap-1.5">
        <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
        <span>Generate Strong Password</span>
      </button>
    </div>

    <?php if (isset($_SESSION['user_id'])) { ?>
      <!-- Password Input Field -->
      <div class="relative mb-3">
        <input 
          type="password" 
          id="pwdInput" 
          placeholder="Type a password to test..." 
          class="w-full bg-[#181A20] border border-[#323743] focus:border-[#4B5563] rounded-xl px-4 py-3 text-sm text-white placeholder-[#64748B] focus:outline-none transition-colors"
        >
        <button type="button" id="eyeBtn" class="absolute right-3.5 top-3.5 text-[#94A3B8] hover:text-[#B6FF2E] text-sm" title="Show/hide password">
          <i data-lucide="eye" class="w-4 h-4"></i>
        </button>
      </div>

      <!-- Strength Meter Bar -->
      <div class="mb-4">
        <div class="flex justify-between items-center text-xs mb-1">
          <span class="text-[#94A3B8]">Strength: <strong id="pwdRating" class="text-[#94A3B8]">Not entered</strong></span>
          <span id="crackEstimate" class="text-[#B6FF2E] text-[11px] font-mono"></span>
        </div>
        <div class="w-full bg-[#2A2E39] rounded-full h-2 overflow-hidden">
          <div id="pwdBar" class="h-full bg-[#94A3B8] transition-all duration-300 w-0"></div>
        </div>
      </div>

      <!-- Simple Checklist -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs text-[#94A3B8] pt-3 border-t border-[#323743]">
        <div id="c-len" class="flex items-center gap-1.5"><i data-lucide="x-circle" class="w-3.5 h-3.5 text-rose-500"></i> 10+ characters</div>
        <div id="c-num" class="flex items-center gap-1.5"><i data-lucide="x-circle" class="w-3.5 h-3.5 text-rose-500"></i> Numbers (0-9)</div>
        <div id="c-mix" class="flex items-center gap-1.5"><i data-lucide="x-circle" class="w-3.5 h-3.5 text-rose-500"></i> Capital letters</div>
        <div id="c-sym" class="flex items-center gap-1.5"><i data-lucide="x-circle" class="w-3.5 h-3.5 text-rose-500"></i> Symbols (!@#$)</div>
      </div>
    <?php } else { ?>
      <!-- Login Prompt for Non-Logged-in Users -->
      <div class="text-center py-6">
        <div class="w-12 h-12 mx-auto mb-2.5 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
          <i data-lucide="lock" class="w-6 h-6"></i>
        </div>
        <h4 class="text-base font-bold text-white mb-1">Login Required to Use Password Checker</h4>
        <p class="text-xs text-[#94A3B8] mb-4 max-w-md mx-auto">
          Please sign in to your CyberSafe account to test passwords and generate secure keys.
        </p>
        <a href="login.php?msg=login_required" class="btn-green py-2 px-6 rounded-lg text-xs font-bold inline-block shadow-lg">
          Login to Access &rarr;
        </a>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Section 4: Phishing Detector -->
<div id="section-phishing" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#323743]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-3 border-b border-[#323743]">
      <div>
        <h3 class="text-lg font-bold text-white flex items-center gap-2.5">
          <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
            <i data-lucide="mail-warning" class="w-4 h-4"></i>
          </div>
          <span>Phishing Detector Module</span>
        </h3>
        <p class="text-xs text-[#94A3B8] mt-0.5">Detect scam emails, SMS alerts, and suspicious messages before you click.</p>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'phishing_detector.php' : 'login.php?msg=login_required'; ?>" class="btn-green py-2 px-5 rounded-lg text-xs font-bold self-start sm:self-auto shrink-0 shadow flex items-center gap-1.5">
        <span>Open Phishing Checker</span>
        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
      </a>
    </div>

    <div class="grid sm:grid-cols-3 gap-4 text-xs">
      <div class="bg-[#181A20] p-4 rounded-xl border border-[#323743]">
        <div class="text-rose-400 font-bold mb-1.5 flex items-center gap-2">
          <i data-lucide="alert-triangle" class="w-4 h-4"></i>
          <span>Urgent Panic</span>
        </div>
        <p class="text-[#94A3B8] leading-relaxed">
          "Your bank account will be blocked today! Update your KYC right now to avoid penalty."
        </p>
      </div>
      <div class="bg-[#181A20] p-4 rounded-xl border border-[#323743]">
        <div class="text-amber-400 font-bold mb-1.5 flex items-center gap-2">
          <i data-lucide="gift" class="w-4 h-4"></i>
          <span>Fake Lottery / Prize</span>
        </div>
        <p class="text-[#94A3B8] leading-relaxed">
          "Congratulations! You won ₹1,00,000 cash prize. Click here to claim your reward immediately."
        </p>
      </div>
      <div class="bg-[#181A20] p-4 rounded-xl border border-[#323743]">
        <div class="text-[#B6FF2E] font-bold mb-1.5 flex items-center gap-2">
          <i data-lucide="link" class="w-4 h-4"></i>
          <span>Fake Short Links</span>
        </div>
        <p class="text-[#94A3B8] leading-relaxed">
          Scammers use tinyurl or bit.ly links that take you to fake login forms to steal passwords.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Section 5: Cyber Security Quiz -->
<div id="section-quiz" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#323743]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-3 border-b border-[#323743]">
      <div>
        <h3 class="text-lg font-bold text-white flex items-center gap-2.5">
          <div class="w-7 h-7 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
            <i data-lucide="help-circle" class="w-4 h-4"></i>
          </div>
          <span>Cyber Security Awareness Quiz</span>
        </h3>
        <p class="text-xs text-[#94A3B8] mt-0.5">Test what you know about passwords, scams, and safe browsing habits.</p>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'quiz.php' : 'login.php?msg=login_required'; ?>" class="btn-green py-2 px-5 rounded-lg text-xs font-bold self-start sm:self-auto shrink-0 shadow flex items-center gap-1.5">
        <span>Start 10-Question Quiz</span>
        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
      </a>
    </div>

    <div class="grid sm:grid-cols-3 gap-3 text-xs text-[#E2E8F0]">
      <div class="flex items-center gap-3 bg-[#181A20] p-3.5 rounded-xl border border-[#323743]">
        <div class="w-10 h-10 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="clipboard-list" class="w-5 h-5"></i>
        </div>
        <div>
          <strong class="block text-white">10 Practical Questions</strong>
          <span class="text-[#94A3B8]">1 mark each, multiple choice</span>
        </div>
      </div>
      <div class="flex items-center gap-3 bg-[#181A20] p-3.5 rounded-xl border border-[#323743]">
        <div class="w-10 h-10 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="zap" class="w-5 h-5"></i>
        </div>
        <div>
          <strong class="block text-white">Instant Results</strong>
          <span class="text-[#94A3B8]">Learn why each answer is right</span>
        </div>
      </div>
      <div class="flex items-center gap-3 bg-[#181A20] p-3.5 rounded-xl border border-[#323743]">
        <div class="w-10 h-10 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
          <i data-lucide="award" class="w-5 h-5"></i>
        </div>
        <div>
          <strong class="block text-white">Check Your Knowledge</strong>
          <span class="text-[#94A3B8]">Score 7+ to pass with flying colors</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Section 6: CyberSafe Certified ID Card Showcase -->
<div id="section-idcard" class="max-w-4xl mx-auto scroll-mt-24 mb-16">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#B6FF2E]/30 bg-gradient-to-r from-[#23262F] via-[#2A2E38] to-[#181A20]">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-start gap-4">
        <div class="w-14 h-14 rounded-2xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0 shadow-lg shadow-[#B6FF2E]/10">
          <i data-lucide="id-card" class="w-7 h-7"></i>
        </div>
        <div>
          <h3 class="text-lg font-bold text-white flex items-center gap-2">
            Get Your Official <span class="text-[#B6FF2E]">CyberSafe Certified ID Card</span>
          </h3>
          <p class="text-xs text-[#94A3B8] mt-1.5 leading-relaxed max-w-xl">
            Complete the 10-question cyber quiz, upload your student profile photo, and generate your personalized, verified digital security credential ready for high-resolution PNG download and printing!
          </p>
          <div class="flex flex-wrap gap-2 mt-3 text-[11px] text-[#94A3B8]">
            <span class="px-2.5 py-1 rounded bg-[#181A20] border border-[#323743] flex items-center gap-1.5"><i data-lucide="camera" class="w-3.5 h-3.5 text-[#B6FF2E]"></i> Profile Photo</span>
            <span class="px-2.5 py-1 rounded bg-[#181A20] border border-[#323743] flex items-center gap-1.5"><i data-lucide="shield" class="w-3.5 h-3.5 text-[#B6FF2E]"></i> Quiz Score</span>
            <span class="px-2.5 py-1 rounded bg-[#181A20] border border-[#323743] flex items-center gap-1.5"><i data-lucide="hash" class="w-3.5 h-3.5 text-amber-400"></i> Unique Cyber ID</span>
            <span class="px-2.5 py-1 rounded bg-[#181A20] border border-[#323743] flex items-center gap-1.5"><i data-lucide="download" class="w-3.5 h-3.5 text-[#B6FF2E]"></i> PNG &amp; Print</span>
          </div>
        </div>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'id_card.php' : 'login.php?msg=login_required'; ?>" class="btn-green px-6 py-3 rounded-xl text-xs font-bold shrink-0 text-center self-stretch md:self-auto shadow-lg flex items-center justify-center gap-2">
        <span>Generate ID Card</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </a>
    </div>
  </div>
</div>

<script>
  var pwdInput = document.getElementById('pwdInput');
  var pwdBar = document.getElementById('pwdBar');
  var pwdRating = document.getElementById('pwdRating');
  var crackEstimate = document.getElementById('crackEstimate');
  var eyeBtn = document.getElementById('eyeBtn');
  var genBtn = document.getElementById('genBtn');

  var cLen = document.getElementById('c-len');
  var cNum = document.getElementById('c-num');
  var cMix = document.getElementById('c-mix');
  var cSym = document.getElementById('c-sym');

  function setCheck(el, text, ok) {
    el.innerHTML = ok 
      ? '<i data-lucide="check-circle" class="w-3.5 h-3.5 text-[#B6FF2E] inline"></i> <span class="text-[#B6FF2E]">' + text + '</span>'
      : '<i data-lucide="x-circle" class="w-3.5 h-3.5 text-rose-500 inline"></i> <span>' + text + '</span>';
    if (typeof lucide !== 'undefined') lucide.createIcons();
  }

  function checkPassword(pass) {
    if (!pass) {
      pwdBar.style.width = '0%';
      pwdRating.innerText = 'Not entered';
      pwdRating.className = 'text-[#94A3B8]';
      crackEstimate.innerText = '';
      setCheck(cLen, '10+ characters', false);
      setCheck(cNum, 'Numbers (0-9)', false);
      setCheck(cMix, 'Capital letters', false);
      setCheck(cSym, 'Symbols (!@#$)', false);
      return;
    }

    var hasLen = pass.length >= 10;
    var hasNum = /[0-9]/.test(pass);
    var hasMix = /[A-Z]/.test(pass) && /[a-z]/.test(pass);
    var hasSym = /[^A-Za-z0-9]/.test(pass);

    setCheck(cLen, '10+ characters', hasLen);
    setCheck(cNum, 'Numbers (0-9)', hasNum);
    setCheck(cMix, 'Capital letters', hasMix);
    setCheck(cSym, 'Symbols (!@#$)', hasSym);

    var score = 0;
    if (pass.length >= 8) score += 20;
    if (pass.length >= 12) score += 20;
    if (hasNum) score += 20;
    if (hasMix) score += 20;
    if (hasSym) score += 20;

    pwdBar.style.width = score + '%';

    if (score <= 40) {
      pwdBar.className = 'h-full bg-rose-500 transition-all duration-300';
      pwdRating.innerText = 'Weak - Easy to guess';
      pwdRating.className = 'text-rose-400 font-bold';
      crackEstimate.innerText = 'Cracked in: a few seconds';
    } else if (score <= 60) {
      pwdBar.className = 'h-full bg-amber-500 transition-all duration-300';
      pwdRating.innerText = 'Medium - Can be improved';
      pwdRating.className = 'text-amber-400 font-bold';
      crackEstimate.innerText = 'Cracked in: a few hours or days';
    } else {
      pwdBar.className = 'h-full bg-[#B6FF2E] transition-all duration-300';
      pwdRating.innerText = 'Strong - Very safe!';
      pwdRating.className = 'text-[#B6FF2E] font-bold';
      crackEstimate.innerText = 'Cracked in: centuries';
    }
  }

  if (pwdInput) {
    pwdInput.addEventListener('input', function() {
      checkPassword(pwdInput.value);
    });

    // Eye toggle
    var visible = false;
    if (eyeBtn) {
      eyeBtn.addEventListener('click', function() {
        visible = !visible;
        pwdInput.type = visible ? 'text' : 'password';
        eyeBtn.innerHTML = visible ? '<i data-lucide="eye-off" class="w-4 h-4"></i>' : '<i data-lucide="eye" class="w-4 h-4"></i>';
        if (typeof lucide !== 'undefined') lucide.createIcons();
      });
    }

    // Generate strong password
    if (genBtn) {
      genBtn.addEventListener('click', function() {
        var chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ23456789!@#$%^&*";
        var pass = "";
        for (var i = 0; i < 14; i++) {
          pass += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        pwdInput.value = pass;
        pwdInput.type = 'text';
        visible = true;
        if (eyeBtn) {
          eyeBtn.innerHTML = '<i data-lucide="eye-off" class="w-4 h-4"></i>';
          if (typeof lucide !== 'undefined') lucide.createIcons();
        }
        checkPassword(pass);
      });
    }
  }
</script>

<?php include "includes/footer.php"; ?>
