<?php
// CyberSafe - Safety Tips (Lime Spark & Graphite Theme with Lucide SVG Icons)
include "includes/db.php";
check_login();
$title = "Safety Tips";
include "includes/header.php";

$tipsList = [
    [
        "icon" => "mail-warning",
        "title" => "Phishing & Fake Messages",
        "desc" => "Phishing is when scammers send fake emails, SMS, or WhatsApp messages pretending to be your bank, delivery service, or a friend. Their goal is to get your password or OTP.",
        "points" => [
            "Always check the sender's actual email address, not just their display name.",
            "Never click on unknown or shortened links in urgent messages.",
            "No bank or company will ever call or message you to ask for your OTP or PIN."
        ]
    ],
    [
        "icon" => "key-round",
        "title" => "Creating Strong Passwords",
        "desc" => "Using the same password everywhere is very dangerous. If one small website gets hacked, attackers will try that same password on your email, social media, and banking.",
        "points" => [
            "Use at least 12 characters combining letters, numbers, and symbols.",
            "Never use easy-to-guess info like your name, birthday, or '123456'.",
            "Consider using a trusted password manager (like Bitwarden or Google Password Manager) to remember them."
        ]
    ],
    [
        "icon" => "shield-alert",
        "title" => "Malware & Ransomware",
        "desc" => "Malware is malicious software (like viruses or spyware) that can steal your data or spy on your keystrokes. Ransomware locks your personal files and asks for money to unlock them.",
        "points" => [
            "Only download apps from official sources like Google Play, Apple App Store, or official websites.",
            "Avoid downloading cracked software, cheats, or free movies from shady websites.",
            "Regularly back up your important photos and documents to Google Drive or an external pendrive."
        ]
    ],
    [
        "icon" => "wifi",
        "title" => "Using Public Wi-Fi Safely",
        "desc" => "Free Wi-Fi at cafes, railway stations, and hotels is usually not secure. Other people connected to the same network might be able to intercept the websites you visit.",
        "points" => [
            "Never open net banking or make UPI/card payments on public Wi-Fi.",
            "Use your mobile data (hotspot) instead when doing anything sensitive.",
            "Turn off Wi-Fi auto-connect on your phone so it doesn't automatically join random open networks."
        ]
    ],
    [
        "icon" => "refresh-cw",
        "title" => "Keep Your Apps and Phone Updated",
        "desc" => "When your phone, laptop, or browser asks you to update, don't keep clicking 'Remind me tomorrow'. Most updates are issued to fix dangerous security bugs.",
        "points" => [
            "Turn on automatic updates for your phone operating system (Android/iOS) and Windows.",
            "Keep your web browsers (Chrome, Edge, Firefox) updated to the latest version.",
            "Delete old apps on your phone that you don't use anymore."
        ]
    ],
    [
        "icon" => "fingerprint",
        "title" => "Turn on Two-Factor Authentication (2FA)",
        "desc" => "Two-Factor Authentication adds a second step when you sign in (like an OTP sent to your phone or an authenticator code). Even if someone steals your password, they cannot log in without this code.",
        "points" => [
            "Turn on 2FA first on your Gmail/Google account and your primary social accounts.",
            "Use authenticator apps (like Google Authenticator) whenever possible.",
            "Save your backup codes in a safe place in case you lose your phone."
        ]
    ]
];
?>

<div class="max-w-4xl mx-auto">
  <!-- Page Header -->
  <div class="mb-8 text-center sm:text-left">
    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 flex items-center justify-center sm:justify-start gap-2.5">
      <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E]">
        <i data-lucide="shield-check" class="w-5 h-5"></i>
      </div>
      <span>Cyber Safety <span class="text-[#B6FF2E]">Tips</span></span>
    </h1>
    <p class="text-sm text-[#94A3B8]">
      Simple, practical guidelines to keep your accounts and personal data safe online.
    </p>
  </div>

  <!-- Tips Cards Grid -->
  <div class="grid md:grid-cols-2 gap-5 mb-10">
    <?php foreach ($tipsList as $tip) { ?>
      <div class="cyber-box rounded-xl p-5 flex flex-col justify-between border border-[#323743]">
        <div>
          <div class="flex items-center gap-2.5 mb-3">
            <div class="w-9 h-9 rounded-xl bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] shrink-0">
              <i data-lucide="<?php echo $tip['icon']; ?>" class="w-4 h-4"></i>
            </div>
            <h2 class="text-base font-bold text-white"><?php echo $tip['title']; ?></h2>
          </div>
          <p class="text-xs text-[#94A3B8] leading-relaxed mb-4">
            <?php echo $tip['desc']; ?>
          </p>
        </div>

        <div class="bg-[#181A20] rounded-lg p-3.5 border border-[#323743] text-xs">
          <strong class="text-[#B6FF2E] block mb-2 font-semibold flex items-center gap-1.5">
            <i data-lucide="check" class="w-3.5 h-3.5"></i>
            <span>Best Practices:</span>
          </strong>
          <ul class="space-y-1.5 text-[#E2E8F0]">
            <?php foreach ($tip['points'] as $pt) { ?>
              <li class="flex items-start gap-2">
                <span class="text-[#B6FF2E] text-xs mt-0.5">&bull;</span>
                <span><?php echo $pt; ?></span>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- Bottom CTA -->
  <div class="cyber-box rounded-xl p-6 text-center border-t-2 border-t-[#B6FF2E] border border-[#323743]">
    <h3 class="text-base font-bold text-white mb-1">Want to test what you know?</h3>
    <p class="text-xs text-[#94A3B8] mb-4">Take our quick 10-question cyber quiz to see how cyber-aware you are.</p>
    <a href="quiz.php" class="btn-green py-2.5 px-6 rounded-lg text-xs font-bold inline-flex items-center gap-2 shadow-lg">
      <span>Start the Quiz</span>
      <i data-lucide="arrow-right" class="w-4 h-4"></i>
    </a>
  </div>
</div>

<?php include "includes/footer.php"; ?>
