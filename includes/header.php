<?php
// CyberSafe - Header Navigation File
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($title) ? $title . " - CyberSafe" : "CyberSafe - Cyber Security Awareness"; ?></title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- FontAwesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Project Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body class="min-h-screen flex flex-col bg-[#F8E7C9] text-[#064E3B]">

<!-- Navigation Bar -->
<header class="bg-[#064E3B] border-b border-[#043B2D] sticky top-0 z-50">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      
      <!-- Logo -->
      <a href="index.php" class="flex items-center gap-2 text-[#F8E7C9] font-bold text-lg">
        <span class="text-xl">🔒</span>
        <span>Cyber<span class="text-[#E6C88F]">Safe</span></span>
      </a>

      <!-- Desktop Links -->
      <nav class="hidden md:flex items-center gap-1 text-sm font-medium" id="mainNav">
        <a href="index.php" id="nav-home" class="nav-tab px-3 py-1.5 rounded <?php echo (!isset($title) || $title == 'Home') ? 'active' : 'text-[#F8E7C9]'; ?>">Home</a>
        <a href="learn.php" id="nav-safety" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Safety Tips') ? 'active' : 'text-[#F8E7C9]'; ?>">Safety Tips</a>
        <a href="password_analyzer.php" id="nav-analyzer" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Password Analyzer') ? 'active' : 'text-[#F8E7C9]'; ?>">Password Analyzer</a>
        <a href="password_generator.php" id="nav-generator" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Password Generator') ? 'active' : 'text-[#F8E7C9]'; ?>">Generator</a>
        <a href="phishing_detector.php" id="nav-phishing" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Phishing Detector') ? 'active' : 'text-[#F8E7C9]'; ?>">Phishing Detector</a>
        <a href="quiz.php" id="nav-quiz" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'Quiz') ? 'active' : 'text-[#F8E7C9]'; ?>">Quiz</a>
        <?php if (isset($_SESSION['user_id'])) { ?>
          <a href="id_card.php" id="nav-idcard" class="nav-tab px-3 py-1.5 rounded <?php echo (isset($title) && $title == 'CyberSafe ID Card') ? 'active' : 'text-[#F8E7C9] font-bold hover:text-white'; ?>"><i class="fa-solid fa-id-card mr-1"></i> ID Card</a>
        <?php } ?>
      </nav>

      <!-- Account Buttons -->
      <div class="hidden md:flex items-center gap-3 text-sm">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <a href="dashboard.php" class="px-3 py-1.5 rounded bg-[#043B2D] text-[#F8E7C9] border border-[#8FA89A] hover:border-[#F8E7C9] font-medium">Dashboard</a>
          <a href="logout.php" class="text-[#D9C7A5] hover:text-rose-300 text-xs">Logout</a>
        <?php } else { ?>
          <a href="login.php" class="text-[#F8E7C9] hover:text-white">Login</a>
          <a href="register.php" class="btn-green px-4 py-1.5 rounded text-xs">Register</a>
        <?php } ?>
      </div>

      <!-- Mobile Menu Button -->
      <button id="navToggle" class="md:hidden text-[#F8E7C9] p-2">
        <i class="fa-solid fa-bars"></i>
      </button>

    </div>
  </div>

  <!-- Mobile Dropdown -->
  <div id="navDropdown" class="hidden md:hidden bg-[#064E3B] border-t border-[#043B2D] px-4 py-3 space-y-2 text-sm">
    <a href="index.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Home</a>
    <a href="learn.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Safety Tips</a>
    <a href="password_analyzer.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Password Analyzer</a>
    <a href="password_generator.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Password Generator</a>
    <a href="phishing_detector.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Phishing Detector</a>
    <a href="quiz.php" class="mobile-nav-link block text-[#F8E7C9] py-1">Quiz</a>
    <?php if (isset($_SESSION['user_id'])) { ?>
      <a href="id_card.php" class="mobile-nav-link block text-[#F8E7C9] font-bold py-1">My ID Card</a>
      <a href="dashboard.php" class="mobile-nav-link block text-[#F8E7C9] font-bold py-1">Dashboard (<?php echo htmlspecialchars($_SESSION['name']); ?>)</a>
      <a href="logout.php" class="block text-rose-300 text-xs py-1">Logout</a>
    <?php } else { ?>
      <div class="pt-2 border-t border-[#043B2D] flex gap-2">
        <a href="login.php" class="px-3 py-1.5 rounded bg-[#043B2D] text-[#F8E7C9] text-xs">Login</a>
        <a href="register.php" class="btn-green px-4 py-1.5 rounded text-xs">Register</a>
      </div>
    <?php } ?>
  </div>
</header>

<!-- Main Page Container -->
<main class="flex-1 max-w-6xl w-full mx-auto px-4 py-8">
