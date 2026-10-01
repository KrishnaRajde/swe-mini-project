<?php
// CyberSafe - Header Navigation File (Lime Spark & Graphite Theme)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title . " - CyberSafe" : "CyberSafe - Cyber Security Awareness"; ?></title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            lime: '#B6FF2E',
            graphite: '#23262F',
            darkbg: '#181A20',
          }
        }
      }
    }
  </script>
  
  <!-- Lucide SVG Icons Library -->
  <script src="https://unpkg.com/lucide@latest"></script>
  
  <!-- FontAwesome Icons (Fallback & Utility) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Project Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body class="min-h-screen flex flex-col bg-[#181A20] text-[#E2E8F0]">

<!-- Navigation Bar -->
<header class="bg-[#23262F] border-b border-[#323743] sticky top-0 z-50 shadow-md">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      
      <!-- Modern Brand Logo with Lucide SVG Shield -->
      <a href="index.php" class="flex items-center gap-2.5 text-white font-bold text-lg hover:text-[#B6FF2E] transition-colors group">
        <div class="w-8 h-8 rounded-lg bg-[#B6FF2E]/10 border border-[#B6FF2E]/30 flex items-center justify-center text-[#B6FF2E] group-hover:bg-[#B6FF2E] group-hover:text-[#23262F] transition-all">
          <i data-lucide="shield-check" class="w-5 h-5"></i>
        </div>
        <span class="tracking-tight">Cyber<span class="text-[#B6FF2E]">Safe</span></span>
      </a>

      <!-- Desktop Links -->
      <nav class="hidden md:flex items-center gap-1 text-sm font-medium" id="mainNav">
        <a href="index.php" id="nav-home" class="nav-tab px-3 py-1.5 rounded <?php echo (!isset($title) || $title == 'Home') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Home</a>
        <a href="learn.php" id="nav-safety" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Safety Tips') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Safety Tips</a>
        <a href="password_analyzer.php" id="nav-analyzer" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Password Analyzer') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Password Analyzer</a>
        <a href="password_generator.php" id="nav-generator" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Password Generator') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Generator</a>
        <a href="phishing_detector.php" id="nav-phishing" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Phishing Detector') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Phishing Detector</a>
        <a href="quiz.php" id="nav-quiz" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Quiz') ? 'active' : 'text-[#94A3B8] hover:text-[#B6FF2E]'; ?>">Quiz</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
          <a href="id_card.php" id="nav-idcard" class="nav-tab px-3 py-1.5 rounded flex items-center gap-1.5 <?php echo (isset($title) && $title == 'CyberSafe ID Card') ? 'active' : 'text-[#94A3B8] font-bold hover:text-[#B6FF2E]'; ?>">
            <i data-lucide="id-card" class="w-4 h-4"></i>
            <span>ID Card</span>
          </a>
        <?php } ?>
      </nav>

      <!-- Account Buttons -->
      <div class="hidden md:flex items-center gap-3 text-sm">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <a href="dashboard.php" class="px-3 py-1.5 rounded bg-[#181A20] text-[#B6FF2E] border border-[#323743] hover:border-[#B6FF2E] font-medium transition-colors flex items-center gap-1.5">
            <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
            <span>Dashboard</span>
          </a>
          <a href="logout.php" class="text-[#94A3B8] hover:text-rose-400 text-xs transition-colors flex items-center gap-1">
            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
            <span>Logout</span>
          </a>
        <?php } else { ?>
          <a href="login.php" class="text-[#E2E8F0] hover:text-[#B6FF2E] text-xs font-semibold px-2 py-1 transition-colors">Login</a>
          <a href="register.php" class="btn-green px-4 py-1.5 rounded-lg text-xs font-bold shadow flex items-center gap-1.5">
            <i data-lucide="user-plus" class="w-3.5 h-3.5"></i>
            <span>Register</span>
          </a>
        <?php } ?>
      </div>

      <!-- Mobile Menu Button -->
      <button id="navToggle" class="md:hidden text-[#E2E8F0] p-2 hover:text-[#B6FF2E]">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </button>

    </div>
  </div>

  <!-- Mobile Dropdown -->
  <div id="navDropdown" class="hidden md:hidden bg-[#23262F] border-t border-[#323743] px-4 py-3 space-y-2 text-sm">
    <a href="index.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Home</a>
    <a href="learn.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Safety Tips</a>
    <a href="password_analyzer.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Password Analyzer</a>
    <a href="password_generator.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Password Generator</a>
    <a href="phishing_detector.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Phishing Detector</a>
    <a href="quiz.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] py-1">Quiz</a>
    <?php if (isset($_SESSION['user_id'])) { ?>
      <a href="id_card.php" class="mobile-nav-link block text-[#B6FF2E] font-bold py-1 flex items-center gap-1.5">
        <i data-lucide="id-card" class="w-4 h-4"></i>
        <span>My ID Card</span>
      </a>
      <a href="dashboard.php" class="mobile-nav-link block text-[#E2E8F0] hover:text-[#B6FF2E] font-bold py-1 flex items-center gap-1.5">
        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
        <span>Dashboard (<?php echo htmlspecialchars($_SESSION['name']); ?>)</span>
      </a>
      <a href="logout.php" class="block text-rose-400 text-xs py-1 flex items-center gap-1">
        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
        <span>Logout</span>
      </a>
    <?php } else { ?>
      <div class="pt-2 border-t border-[#323743] flex gap-2">
        <a href="login.php" class="px-3 py-1.5 rounded bg-[#181A20] text-[#E2E8F0] border border-[#323743] text-xs">Login</a>
        <a href="register.php" class="btn-green px-4 py-1.5 rounded-lg text-xs font-bold">Register</a>
      </div>
    <?php } ?>
  </div>
</header>

<!-- Main Page Container -->
<main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">
