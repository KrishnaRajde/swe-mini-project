<?php
// CyberSafe - Password Generator Module
include "includes/db.php";
check_login();

$title = "Password Generator";
include "includes/header.php";
?>

<div class="max-w-2xl mx-auto">
  <!-- Header -->
  <div class="mb-6 text-center sm:text-left">
    <h1 class="text-2xl sm:text-3xl font-bold text-[#064E3B] mb-2 flex items-center justify-center sm:justify-start gap-2.5">
      <span>⚡</span> Password Generator
    </h1>
    <p class="text-sm text-[#35604F]">
      Generate secure, random passwords directly in your browser using cryptographically secure random values.
    </p>
  </div>

  <!-- Generator Card -->
  <div class="cyber-box rounded-2xl p-6 sm:p-7 border border-[#D9BF8F] mb-6">
    
    <!-- Generated Password Display -->
    <label class="block text-xs font-semibold text-[#064E3B] mb-2">
      Generated Secure Password:
    </label>
    <div class="flex flex-col sm:flex-row items-stretch gap-2 mb-6">
      <div class="relative flex-1">
        <input 
          type="text" 
          id="generatedPassword" 
          readonly 
          class="w-full bg-[#FDF8EF] border border-[#D9BF8F] text-[#064E3B] font-mono text-base sm:text-lg px-4 py-3 rounded-xl focus:outline-none select-all"
          placeholder="Click generate below..."
        >
      </div>
      <button 
        type="button" 
        id="copyBtn" 
        class="btn-green px-5 py-3 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shrink-0 transition-all"
      >
        <i class="fa-regular fa-copy text-sm"></i>
        <span id="copyText">Copy Password</span>
      </button>
    </div>

    <!-- Generator Options -->
    <div class="border-t border-[#D9BF8F] pt-5 space-y-5">
      
      <!-- Length Slider & Number Input -->
      <div>
        <div class="flex justify-between items-center mb-2">
          <label class="text-xs font-semibold text-[#064E3B]">Password Length:</label>
          <span class="text-sm font-bold text-[#064E3B] font-mono bg-[#F3DDB5] px-2.5 py-0.5 rounded border border-[#D9BF8F]">
            <span id="lengthDisplay">16</span> characters
          </span>
        </div>
        <div class="flex items-center gap-3">
          <input 
            type="range" 
            id="lengthRange" 
            min="6" 
            max="32" 
            value="16" 
            class="w-full accent-[#064E3B] cursor-pointer"
          >
          <input 
            type="number" 
            id="lengthNum" 
            min="6" 
            max="32" 
            value="16" 
            class="w-16 bg-[#FDF8EF] border border-[#D9BF8F] text-[#064E3B] text-center text-xs py-1.5 rounded-lg focus:outline-none focus:border-[#064E3B] font-mono"
          >
        </div>
      </div>

      <!-- Character Sets Checkboxes -->
      <div>
        <label class="block text-xs font-semibold text-[#064E3B] mb-2.5">Include Character Types:</label>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
          <label class="flex items-center gap-2.5 p-3 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] hover:border-[#064E3B] cursor-pointer transition-colors">
            <input type="checkbox" id="chkUpper" checked class="accent-[#064E3B] w-4 h-4 rounded">
            <span class="text-[#064E3B]">Uppercase Letters (A-Z)</span>
          </label>
          <label class="flex items-center gap-2.5 p-3 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] hover:border-[#064E3B] cursor-pointer transition-colors">
            <input type="checkbox" id="chkLower" checked class="accent-[#064E3B] w-4 h-4 rounded">
            <span class="text-[#064E3B]">Lowercase Letters (a-z)</span>
          </label>
          <label class="flex items-center gap-2.5 p-3 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] hover:border-[#064E3B] cursor-pointer transition-colors">
            <input type="checkbox" id="chkNumbers" checked class="accent-[#064E3B] w-4 h-4 rounded">
            <span class="text-[#064E3B]">Numbers (0-9)</span>
          </label>
          <label class="flex items-center gap-2.5 p-3 rounded-xl bg-[#FDF8EF] border border-[#D9BF8F] hover:border-[#064E3B] cursor-pointer transition-colors">
            <input type="checkbox" id="chkSymbols" checked class="accent-[#064E3B] w-4 h-4 rounded">
            <span class="text-[#064E3B]">Special Symbols (!@#$%)</span>
          </label>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3">
        <button 
          type="button" 
          id="generateBtn" 
          class="btn-green w-full sm:w-auto px-6 py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-lg"
        >
          <i class="fa-solid fa-arrows-rotate"></i>
          <span>Generate New Password</span>
        </button>

        <a href="password_analyzer.php" class="text-xs text-[#35604F] hover:text-[#043B2D] transition-colors flex items-center gap-1">
          <i class="fa-solid fa-shield-halved"></i>
          <span>Test strength in Password Analyzer &rarr;</span>
        </a>
      </div>

    </div>
  </div>

  <!-- Educational Info Box -->
  <div class="cyber-box rounded-xl p-5 text-xs text-[#064E3B]">
    <h4 class="font-bold text-[#064E3B] mb-2 text-sm flex items-center gap-2">
      <span>💡</span> Why Use a Random Password Generator?
    </h4>
    <p class="text-[#35604F] leading-relaxed mb-2">
      Humans usually create passwords based on names, birthdays, or phone numbers which are very easy for hackers to guess. Random passwords generated using cryptographically secure random values (crypto.getRandomValues) provide the highest defense against dictionary and automated brute-force attacks.
    </p>
  </div>
</div>

<script>
  var lengthRange = document.getElementById('lengthRange');
  var lengthNum = document.getElementById('lengthNum');
  var lengthDisplay = document.getElementById('lengthDisplay');

  var chkUpper = document.getElementById('chkUpper');
  var chkLower = document.getElementById('chkLower');
  var chkNumbers = document.getElementById('chkNumbers');
  var chkSymbols = document.getElementById('chkSymbols');

  var generatedPassword = document.getElementById('generatedPassword');
  var generateBtn = document.getElementById('generateBtn');
  var copyBtn = document.getElementById('copyBtn');
  var copyText = document.getElementById('copyText');

  // Character sets
  var uppercaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  var lowercaseChars = "abcdefghijklmnopqrstuvwxyz";
  var numberChars = "0123456789";
  var symbolChars = "!@#$%^&*()_+~`|}{[]:;?><,./-=";

  // Sync slider and number input
  function updateLength(val) {
    var length = parseInt(val);
    if (isNaN(length)) length = 16;
    if (length < 6) length = 6;
    if (length > 32) length = 32;

    lengthRange.value = length;
    lengthNum.value = length;
    lengthDisplay.innerText = length;
    generatePassword();
  }

  lengthRange.addEventListener('input', function() {
    updateLength(this.value);
  });

  lengthNum.addEventListener('input', function() {
    updateLength(this.value);
  });

  // Cryptographically secure random integer between 0 and max (exclusive)
  function getSecureRandomInt(max) {
    if (window.crypto && window.crypto.getRandomValues) {
      var arr = new Uint32Array(1);
      window.crypto.getRandomValues(arr);
      return arr[0] % max;
    } else {
      return Math.floor(Math.random() * max);
    }
  }

  // Generate Password Function
  function generatePassword() {
    var length = parseInt(lengthRange.value);
    var pool = "";

    if (chkUpper.checked) pool += uppercaseChars;
    if (chkLower.checked) pool += lowercaseChars;
    if (chkNumbers.checked) pool += numberChars;
    if (chkSymbols.checked) pool += symbolChars;

    if (pool === "") {
      generatedPassword.value = "Select at least one character type!";
      generatedPassword.classList.remove('text-[#064E3B]');
      generatedPassword.classList.add('text-rose-700');
      return;
    }

    generatedPassword.classList.remove('text-rose-700');
    generatedPassword.classList.add('text-[#064E3B]');

    var result = "";
    for (var i = 0; i < length; i++) {
      var idx = getSecureRandomInt(pool.length);
      result += pool.charAt(idx);
    }

    generatedPassword.value = result;
  }

  generateBtn.addEventListener('click', generatePassword);
  [chkUpper, chkLower, chkNumbers, chkSymbols].forEach(function(chk) {
    chk.addEventListener('change', generatePassword);
  });

  // Copy to clipboard
  copyBtn.addEventListener('click', function() {
    var pass = generatedPassword.value;
    if (!pass || pass.indexOf("Select at least") !== -1) return;

    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(pass).then(showCopiedFeedback);
    } else {
      generatedPassword.select();
      document.execCommand('copy');
      showCopiedFeedback();
    }
  });

  function showCopiedFeedback() {
    copyText.innerText = "Copied!";
    copyBtn.classList.remove('btn-green');
    copyBtn.classList.add('bg-[#043B2D]', 'text-[#F8E7C9]');
    setTimeout(function() {
      copyText.innerText = "Copy Password";
      copyBtn.classList.remove('bg-[#043B2D]', 'text-[#F8E7C9]');
      copyBtn.classList.add('btn-green');
    }, 2000);
  }

  // Generate an initial password on page load
  generatePassword();
</script>

<?php include "includes/footer.php"; ?>
