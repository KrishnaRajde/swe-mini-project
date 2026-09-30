<?php
include "includes/db.php";
$title = "Home";
include "includes/header.php";
?>

<!-- Hero Header (Section 1: Home) -->
<div id="section-home" class="scroll-mt-24 text-center py-6 sm:py-10">
  <div class="text-4xl sm:text-5xl mb-3">🔒</div>
  <h1 class="text-2xl sm:text-4xl font-extrabold text-[#064E3B] tracking-tight mb-2">
    Cyber Security Awareness
  </h1>
  <p class="text-[#064E3B] font-medium text-sm sm:text-base mb-3">
    Stay Safe in the Digital World
  </p>
  <p class="text-xs sm:text-sm text-[#35604F] max-w-xl mx-auto mb-6">
    A simple web project built to help students and beginners understand basic cyber safety, identify online scams, and test password strengths.
  </p>
  <div class="flex flex-wrap items-center justify-center gap-3">
    <a href="#section-safety" class="btn-green px-5 py-2 rounded-lg text-xs font-bold">
      Get Started &darr;
    </a>
    <a href="#password-checker" class="btn-outline px-4 py-2 rounded-lg text-xs font-bold">
      Test Password &darr;
    </a>
  </div>
</div>

<!-- Section 2: Safety Tips & Fundamentals -->
<div id="section-safety" class="scroll-mt-24 space-y-4 max-w-4xl mx-auto mb-14">
  <div class="flex items-center justify-between pb-2 border-b border-[#D9BF8F]">
    <h2 class="text-lg font-bold text-[#064E3B] flex items-center gap-2">
      <span>🛡️</span> Cyber Safety Fundamentals
    </h2>
    <a href="learn.php" class="text-xs text-[#064E3B] hover:underline font-medium">
      View All 5 Modules &rarr;
    </a>
  </div>

  <!-- Card 1: What is Cyber Security? -->
  <div class="cyber-box rounded-xl p-5 sm:p-6 border-l-4 border-l-[#064E3B]">
    <h3 class="text-base font-bold text-[#064E3B] mb-2 flex items-center gap-2">
      <span>🛡️</span> What is Cyber Security?
    </h3>
    <p class="text-[#064E3B] text-sm leading-relaxed">
      Cyber Security is the practice of protecting computers, smartphones, networks, and personal data from digital attacks. In today's world, everything is connected to the internet — making it very important to stay safe online. Hackers use many tricks to steal your personal information, money, or damage your devices.
    </p>
  </div>

  <!-- Card 2: Why Does It Matter? -->
  <div class="cyber-box rounded-xl p-5 sm:p-6 border-l-4 border-l-amber-500">
    <h3 class="text-base font-bold text-amber-700 mb-3 flex items-center gap-2">
      <span>⚠️</span> Why Does It Matter?
    </h3>
    <ul class="space-y-2 text-sm text-[#064E3B]">
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
        <span>Over 4,000 cyber attacks happen every day worldwide.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
        <span>Phishing emails trick millions of users into giving away passwords.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
        <span>Weak passwords are the #1 cause of account hacking.</span>
      </li>
      <li class="flex items-center gap-2.5">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
        <span>Anyone with a phone or computer can become a victim if not careful.</span>
      </li>
    </ul>
  </div>

  <div class="text-center pt-2">
    <a href="learn.php" class="btn-green px-5 py-2 rounded-lg text-xs font-bold inline-block">
      Read Complete Safety Tips Guide &rarr;
    </a>
  </div>
</div>

<!-- Section 3: Clean & Simple Password Checker Tool -->
<div id="password-checker" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#D9BF8F]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 pb-3 border-b border-[#D9BF8F]">
      <div>
        <h3 class="text-lg font-bold text-[#064E3B] flex items-center gap-2">
          <span>🔑</span> Password Strength Checker
        </h3>
        <p class="text-xs text-[#35604F] mt-0.5">Test any password to see how strong it is and get instant tips.</p>
      </div>
      <button id="genBtn" type="button" class="btn-outline-green px-3 py-1.5 rounded-lg text-xs font-semibold self-start sm:self-auto">
        Generate Strong Password
      </button>
    </div>

    <?php if (isset($_SESSION['user_id'])) { ?>
      <!-- Password Input Field -->
      <div class="relative mb-3">
        <input 
          type="password" 
          id="pwdInput" 
          placeholder="Type a password to test..." 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] focus:border-[#064E3B] rounded-xl px-4 py-3 text-sm text-[#064E3B] placeholder-[#8A9A8C] focus:outline-none transition-colors"
        >
        <button type="button" id="eyeBtn" class="absolute right-3.5 top-3.5 text-[#35604F] hover:text-[#043B2D] text-sm" title="Show/hide password">
          <i class="fa-solid fa-eye"></i>
        </button>
      </div>

      <!-- Strength Meter Bar -->
      <div class="mb-4">
        <div class="flex justify-between items-center text-xs mb-1">
          <span class="text-[#35604F]">Strength: <strong id="pwdRating" class="text-[#35604F]">Not entered</strong></span>
          <span id="crackEstimate" class="text-[#35604F] text-[11px]"></span>
        </div>
        <div class="w-full bg-[#F3DDB5] rounded-full h-2 overflow-hidden">
          <div id="pwdBar" class="h-full bg-[#35604F] transition-all duration-300 w-0"></div>
        </div>
      </div>

      <!-- Simple Checklist -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs text-[#35604F] pt-3 border-t border-[#D9BF8F]">
        <div id="c-len" class="flex items-center gap-1.5"><i class="fa-solid fa-circle-xmark text-rose-600"></i> 10+ characters</div>
        <div id="c-num" class="flex items-center gap-1.5"><i class="fa-solid fa-circle-xmark text-rose-600"></i> Numbers (0-9)</div>
        <div id="c-mix" class="flex items-center gap-1.5"><i class="fa-solid fa-circle-xmark text-rose-600"></i> Capital letters</div>
        <div id="c-sym" class="flex items-center gap-1.5"><i class="fa-solid fa-circle-xmark text-rose-600"></i> Symbols (!@#$)</div>
      </div>
    <?php } else { ?>
      <!-- Login Prompt for Non-Logged-in Users -->
      <div class="text-center py-6">
        <div class="text-3xl mb-2">🔒</div>
        <h4 class="text-base font-bold text-[#064E3B] mb-1">Login Required to Use Password Checker</h4>
        <p class="text-xs text-[#35604F] mb-4 max-w-md mx-auto">
          Please sign in to your CyberSafe account to test passwords and generate secure keys.
        </p>
        <a href="login.php?msg=login_required" class="btn-green py-2 px-6 rounded-lg text-xs font-bold inline-block">
          Login to Access &rarr;
        </a>
      </div>
    <?php } ?>
  </div>
</div>

<!-- Section 4: Phishing Detector -->
<div id="section-phishing" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#D9BF8F]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-3 border-b border-[#D9BF8F]">
      <div>
        <h3 class="text-lg font-bold text-[#064E3B] flex items-center gap-2">
          <span>🎣</span> Phishing Detector Module
        </h3>
        <p class="text-xs text-[#35604F] mt-0.5">Detect scam emails, SMS alerts, and suspicious messages before you click.</p>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'phishing_detector.php' : 'login.php?msg=login_required'; ?>" class="btn-green py-2 px-5 rounded-lg text-xs font-bold self-start sm:self-auto shrink-0">
        Open Phishing Checker &rarr;
      </a>
    </div>

    <div class="grid sm:grid-cols-3 gap-4 text-xs">
      <div class="bg-[#FDF8EF] p-4 rounded-xl border border-[#D9BF8F]">
        <div class="text-rose-700 font-bold mb-1 flex items-center gap-1.5">
          <i class="fa-solid fa-triangle-exclamation"></i> Urgent Panic
        </div>
        <p class="text-[#35604F] leading-relaxed">
          "Your bank account will be blocked today! Update your KYC right now to avoid penalty."
        </p>
      </div>
      <div class="bg-[#FDF8EF] p-4 rounded-xl border border-[#D9BF8F]">
        <div class="text-amber-700 font-bold mb-1 flex items-center gap-1.5">
          <i class="fa-solid fa-gift"></i> Fake Lottery / Prize
        </div>
        <p class="text-[#35604F] leading-relaxed">
          "Congratulations! You won ₹1,00,000 cash prize. Click here to claim your reward immediately."
        </p>
      </div>
      <div class="bg-[#FDF8EF] p-4 rounded-xl border border-[#D9BF8F]">
        <div class="text-[#064E3B] font-bold mb-1 flex items-center gap-1.5">
          <i class="fa-solid fa-link"></i> Fake Short Links
        </div>
        <p class="text-[#35604F] leading-relaxed">
          Scammers use tinyurl or bit.ly links that take you to fake login forms to steal passwords.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Section 5: Cyber Security Quiz -->
<div id="section-quiz" class="max-w-4xl mx-auto scroll-mt-24 mb-14">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#D9BF8F]">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5 pb-3 border-b border-[#D9BF8F]">
      <div>
        <h3 class="text-lg font-bold text-[#064E3B] flex items-center gap-2">
          <span>❓</span> Cyber Security Awareness Quiz
        </h3>
        <p class="text-xs text-[#35604F] mt-0.5">Test what you know about passwords, scams, and safe browsing habits.</p>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'quiz.php' : 'login.php?msg=login_required'; ?>" class="btn-green py-2 px-5 rounded-lg text-xs font-bold self-start sm:self-auto shrink-0">
        Start 10-Question Quiz &rarr;
      </a>
    </div>

    <div class="grid sm:grid-cols-3 gap-3 text-xs text-[#064E3B]">
      <div class="flex items-center gap-3 bg-[#FDF8EF] p-3.5 rounded-xl border border-[#D9BF8F]">
        <span class="text-2xl text-[#064E3B]">📝</span>
        <div>
          <strong class="block text-[#064E3B]">10 Practical Questions</strong>
          <span class="text-[#35604F]">1 mark each, multiple choice</span>
        </div>
      </div>
      <div class="flex items-center gap-3 bg-[#FDF8EF] p-3.5 rounded-xl border border-[#D9BF8F]">
        <span class="text-2xl text-[#064E3B]">⚡</span>
        <div>
          <strong class="block text-[#064E3B]">Instant Results</strong>
          <span class="text-[#35604F]">Learn why each answer is right</span>
        </div>
      </div>
      <div class="flex items-center gap-3 bg-[#FDF8EF] p-3.5 rounded-xl border border-[#D9BF8F]">
        <span class="text-2xl text-[#064E3B]">🏆</span>
        <div>
          <strong class="block text-[#064E3B]">Check Your Knowledge</strong>
          <span class="text-[#35604F]">Score 7+ to pass with flying colors</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Section 6: CyberSafe Certified ID Card Showcase -->
<div id="section-idcard" class="max-w-4xl mx-auto scroll-mt-24 mb-16">
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#064E3B]/40 bg-gradient-to-r from-[#FDF8EF] via-[#FBF0DC] to-[#F3DDB5]">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="flex items-start gap-4">
        <div class="text-4xl text-[#064E3B] shrink-0 mt-1">🪪</div>
        <div>
          <h3 class="text-lg font-bold text-[#064E3B] flex items-center gap-2">
            Get Your Official CyberSafe Certified ID Card
          </h3>
          <p class="text-xs text-[#064E3B] mt-1.5 leading-relaxed max-w-xl">
            Complete the 10-question cyber quiz, upload your student profile photo, and generate your personalized, verified digital security credential ready for high-resolution PNG download and printing!
          </p>
          <div class="flex flex-wrap gap-2 mt-3 text-[11px] text-[#35604F]">
            <span class="px-2.5 py-1 rounded bg-[#F3DDB5] border border-[#D9BF8F]"><i class="fa-solid fa-camera text-[#064E3B] mr-1"></i> Profile Photo</span>
            <span class="px-2.5 py-1 rounded bg-[#F3DDB5] border border-[#D9BF8F]"><i class="fa-solid fa-shield text-[#064E3B] mr-1"></i> Quiz Score</span>
            <span class="px-2.5 py-1 rounded bg-[#F3DDB5] border border-[#D9BF8F]"><i class="fa-solid fa-id-card text-amber-700 mr-1"></i> Unique Cyber ID</span>
            <span class="px-2.5 py-1 rounded bg-[#F3DDB5] border border-[#D9BF8F]"><i class="fa-solid fa-download text-[#064E3B] mr-1"></i> PNG & Print</span>
          </div>
        </div>
      </div>
      <a href="<?php echo isset($_SESSION['user_id']) ? 'id_card.php' : 'login.php?msg=login_required'; ?>" class="btn-green px-6 py-3 rounded-xl text-xs font-bold shrink-0 text-center self-stretch md:self-auto shadow-lg hover:shadow-[#064E3B]/20">
        Generate ID Card &rarr;
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
      ? '<i class="fa-solid fa-circle-check text-[#064E3B]"></i> <span class="text-[#064E3B]">' + text + '</span>'
      : '<i class="fa-solid fa-circle-xmark text-rose-600"></i> <span>' + text + '</span>';
  }

  function checkPassword(pass) {
    if (!pass) {
      pwdBar.style.width = '0%';
      pwdRating.innerText = 'Not entered';
      pwdRating.className = 'text-[#35604F]';
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
      pwdRating.className = 'text-rose-700 font-bold';
      crackEstimate.innerText = 'Cracked in: a few seconds';
    } else if (score <= 60) {
      pwdBar.className = 'h-full bg-amber-500 transition-all duration-300';
      pwdRating.innerText = 'Medium - Can be improved';
      pwdRating.className = 'text-amber-700 font-bold';
      crackEstimate.innerText = 'Cracked in: a few hours or days';
    } else {
      pwdBar.className = 'h-full bg-[#064E3B] transition-all duration-300';
      pwdRating.innerText = 'Strong - Very safe!';
      pwdRating.className = 'text-[#064E3B] font-bold';
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
        eyeBtn.innerHTML = visible ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
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
        if (eyeBtn) eyeBtn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        checkPassword(pass);
      });
    }
  }
</script>

<?php include "includes/footer.php"; ?>
