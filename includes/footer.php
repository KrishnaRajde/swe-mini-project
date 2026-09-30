<?php
// CyberSafe - Footer File
?>
</main>

<footer class="bg-[#064E3B] border-t border-[#043B2D] py-6 text-center text-xs text-[#D9C7A5] mt-auto">
  <div class="max-w-6xl mx-auto px-4">
    <p class="font-medium text-[#F8E7C9]">
      Cyber Security Awareness Website | SWE Mini Project
    </p>
  </div>
</footer>

<!-- GSAP and ScrollTrigger CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<script>
  // Mobile navigation menu toggle
  var navToggle = document.getElementById('navToggle');
  var navDropdown = document.getElementById('navDropdown');
  if (navToggle && navDropdown) {
    navToggle.addEventListener('click', function() {
      navDropdown.classList.toggle('hidden');
    });

    // Close mobile menu when any nav link is tapped
    var mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        navDropdown.classList.add('hidden');
      });
    });
  }

  // GSAP ScrollTrigger: Scrollspy tab highlight & animations
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    // List of sections and their corresponding navbar tab ID
    var navSections = [
      { sectionId: 'section-home', navId: 'nav-home' },
      { sectionId: 'section-safety', navId: 'nav-safety' },
      { sectionId: 'password-checker', navId: 'nav-analyzer' },
      { sectionId: 'section-phishing', navId: 'nav-phishing' },
      { sectionId: 'section-quiz', navId: 'nav-quiz' }
    ];

    function activateTab(navId) {
      var allTabs = document.querySelectorAll('.nav-tab');
      allTabs.forEach(function(tab) {
        tab.classList.remove('active');
        tab.classList.remove('text-[#F8E7C9]', 'font-bold', 'border-b-2', 'border-[#F8E7C9]');
        tab.classList.add('text-[#F8E7C9]');
      });

      var activeTab = document.getElementById(navId);
      if (activeTab) {
        activeTab.classList.remove('text-[#F8E7C9]');
        activeTab.classList.add('active');
      }
    }

    // Attach ScrollTrigger to each section that exists on the current page
    navSections.forEach(function(item) {
      var sec = document.getElementById(item.sectionId);
      if (sec) {
        ScrollTrigger.create({
          trigger: sec,
          start: 'top 45%',
          end: 'bottom 45%',
          onEnter: function() {
            activateTab(item.navId);
          },
          onEnterBack: function() {
            activateTab(item.navId);
          }
        });
      }
    });

    // Handle top of page edge case
    window.addEventListener('scroll', function() {
      if (window.scrollY < 80) {
        var homeEl = document.getElementById('section-home');
        if (homeEl) {
          activateTab('nav-home');
        }
      }
    });

    // Smooth card entrance animations
    gsap.utils.toArray('.cyber-box').forEach(function(card) {
      gsap.from(card, {
        scrollTrigger: {
          trigger: card,
          start: 'top 90%',
          toggleActions: 'play none none none'
        },
        opacity: 0,
        y: 20,
        duration: 0.5,
        ease: 'power2.out'
      });
    });
  }
</script>

</body>
</html>
