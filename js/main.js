/* ============================================================
   KACM WEBSITE — MAIN JAVASCRIPT
   Kazo Archdeaconry Children's Ministry
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

  // ========================================================
  // 1. MOBILE HAMBURGER MENU
  // ========================================================
  const hamburger = document.querySelector('.hamburger');
  const navLinks = document.querySelector('.nav-links');

  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function () {
      hamburger.classList.toggle('active');
      navLinks.classList.toggle('active');
    });

    // Close menu when a nav link is clicked
    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
      });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
      if (!hamburger.contains(e.target) && !navLinks.contains(e.target)) {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
      }
    });
  }

  // ========================================================
  // 2. STICKY NAV SCROLL EFFECT
  // ========================================================
  const navbar = document.querySelector('.navbar');
  if (navbar) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // ========================================================
  // 3. SMOOTH SCROLL FOR ANCHOR LINKS
  // ========================================================
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        var navHeight = document.querySelector('.navbar') ? document.querySelector('.navbar').offsetHeight : 72;
        var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 20;
        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
      }
    });
  });

  // ========================================================
  // 4. COUNT-UP ANIMATION FOR IMPACT STATS
  // ========================================================
  var countUpElements = document.querySelectorAll('.count[data-target]');
  var counted = {};

  function animateCountUp(el) {
    var target = parseInt(el.getAttribute('data-target'));
    var suffix = el.getAttribute('data-suffix') || '+';
    var duration = 2000;
    var startTime = null;
    var startVal = 0;

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      // Ease-out
      var eased = 1 - Math.pow(1 - progress, 3);
      var current = Math.floor(eased * target);
      el.textContent = current + suffix;
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target + suffix;
      }
    }

    requestAnimationFrame(step);
  }

  if (countUpElements.length > 0) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var el = entry.target;
          var id = el.getAttribute('data-target') + el.getAttribute('data-suffix');
          if (!counted[id]) {
            counted[id] = true;
            animateCountUp(el);
          }
        }
      });
    }, { threshold: 0.5 });

    countUpElements.forEach(function (el) { observer.observe(el); });
  }

  // ========================================================
  // 5. TESTIMONIAL CAROUSEL
  // ========================================================
  var carousel = document.querySelector('.testimonial-carousel');
  if (carousel) {
    var slides = carousel.querySelectorAll('.testimonial-slide');
    var dotsContainer = carousel.querySelector('.carousel-dots');
    var currentSlide = 0;
    var slideInterval;

    // Create dots
    if (dotsContainer && slides.length > 1) {
      slides.forEach(function (_, i) {
        var dot = document.createElement('button');
        dot.setAttribute('aria-label', 'Testimonial ' + (i + 1));
        if (i === 0) dot.classList.add('active');
        dot.addEventListener('click', function () { goToSlide(i); });
        dotsContainer.appendChild(dot);
      });
    }

    function goToSlide(index) {
      slides[currentSlide].classList.remove('active');
      if (dotsContainer) {
        dotsContainer.children[currentSlide].classList.remove('active');
      }
      currentSlide = index;
      slides[currentSlide].classList.add('active');
      if (dotsContainer) {
        dotsContainer.children[currentSlide].classList.add('active');
      }
      resetInterval();
    }

    function nextSlide() {
      var next = (currentSlide + 1) % slides.length;
      goToSlide(next);
    }

    function resetInterval() {
      clearInterval(slideInterval);
      slideInterval = setInterval(nextSlide, 5000);
    }

    if (slides.length > 1) {
      slideInterval = setInterval(nextSlide, 5000);
    }
  }

  // ========================================================
  // 6. TABS SYSTEM (Media page)
  // ========================================================
  var tabsNav = document.querySelector('.tabs-nav');
  if (tabsNav) {
    tabsNav.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var tabId = this.getAttribute('data-tab');

        // Deactivate all
        tabsNav.querySelectorAll('.tab-btn').forEach(function (b) { b.classList.remove('active'); });
        document.querySelectorAll('.tab-panel').forEach(function (p) { p.classList.remove('active'); });

        // Activate selected
        this.classList.add('active');
        var panel = document.getElementById(tabId);
        if (panel) panel.classList.add('active');
      });
    });
  }

  // ========================================================
  // 7. LIGHTBOX
  // ========================================================
  var lightbox = document.getElementById('lightbox');
  var lightboxImg = document.getElementById('lightbox-img');

  if (lightbox && lightboxImg) {
    document.querySelectorAll('.gallery-grid img, .lightbox-trigger').forEach(function (img) {
      img.addEventListener('click', function () {
        lightboxImg.src = this.src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox || e.target.classList.contains('lightbox-close')) {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && lightbox.classList.contains('active')) {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  }

  // ========================================================
  // 8. CONTACT FORM VALIDATION + MOCK SUBMISSION
  // ========================================================
  var contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      var valid = true;

      // Validate name
      var nameField = document.getElementById('contact-name');
      var nameGroup = nameField ? nameField.closest('.form-group') : null;
      if (nameField && nameField.value.trim().length < 2) {
        if (nameGroup) nameGroup.classList.add('error');
        valid = false;
      } else if (nameGroup) {
        nameGroup.classList.remove('error');
      }

      // Validate email
      var emailField = document.getElementById('contact-email');
      var emailGroup = emailField ? emailField.closest('.form-group') : null;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (emailField && !emailRegex.test(emailField.value.trim())) {
        if (emailGroup) emailGroup.classList.add('error');
        valid = false;
      } else if (emailGroup) {
        emailGroup.classList.remove('error');
      }

      // Validate message
      var msgField = document.getElementById('contact-message');
      var msgGroup = msgField ? msgField.closest('.form-group') : null;
      if (msgField && msgField.value.trim().length < 20) {
        if (msgGroup) msgGroup.classList.add('error');
        valid = false;
      } else if (msgGroup) {
        msgGroup.classList.remove('error');
      }

      if (valid) {
        var successMsg = document.getElementById('form-success');
        if (successMsg) {
          successMsg.style.display = 'block';
          contactForm.reset();
          // Hide success after 5 seconds
          setTimeout(function () { successMsg.style.display = 'none'; }, 5000);
        }
      }
    });

    // Clear errors on input
    contactForm.querySelectorAll('input, textarea, select').forEach(function (field) {
      field.addEventListener('input', function () {
        var group = this.closest('.form-group');
        if (group) group.classList.remove('error');
      });
    });
  }

  // ========================================================
  // 9. NEWSLETTER SIGNUP (Mock)
  // ========================================================
  document.querySelectorAll('.newsletter-form').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var emailInput = form.querySelector('input[type="email"]');
      var email = emailInput ? emailInput.value.trim() : '';
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email && emailRegex.test(email)) {
        // Show inline success
        var btn = form.querySelector('button');
        var originalText = btn ? btn.textContent : 'Subscribe';
        if (btn) {
          btn.textContent = 'Subscribed!';
          btn.style.background = '#2e7d32';
          btn.style.borderColor = '#2e7d32';
          btn.disabled = true;
          setTimeout(function () {
            btn.textContent = originalText;
            btn.style.background = '';
            btn.style.borderColor = '';
            btn.disabled = false;
          }, 3000);
        }
        if (emailInput) emailInput.value = '';
      }
    });
  });

  // ========================================================
  // 10. SCROLL-TRIGGERED FADE-IN ANIMATIONS
  // ========================================================
  var fadeElements = document.querySelectorAll('.fade-in');
  if (fadeElements.length > 0) {
    var fadeObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          fadeObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -30px 0px' });

    fadeElements.forEach(function (el) { fadeObserver.observe(el); });
  }

  // ========================================================
  // 11. WHATSAPP BUTTON
  // ========================================================
  var whatsappBtn = document.querySelector('.whatsapp-float');
  if (whatsappBtn) {
    whatsappBtn.addEventListener('click', function () {
      var phone = this.getAttribute('data-phone') || '+256700000000';
      var message = encodeURIComponent('Hello KACM! I would like to learn more about your ministry.');
      window.open('https://wa.me/' + phone.replace(/[^0-9]/g, '') + '?text=' + message, '_blank');
    });
  }

  // ========================================================
  // 12. ACTIVE NAV LINK HIGHLIGHT
  // ========================================================
  var currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-links a').forEach(function (link) {
    var href = link.getAttribute('href');
    if (href === currentPage) {
      link.classList.add('active');
    }
  });

  // ========================================================
  // 13. STATIC NEWSLETTER ARCHIVE TOGGLE (Media page)
  // ========================================================
  var archiveToggles = document.querySelectorAll('.archive-toggle');
  archiveToggles.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var target = document.getElementById(this.getAttribute('data-target'));
      if (target) {
        var isHidden = target.style.display === 'none' || !target.style.display;
        target.style.display = isHidden ? 'block' : 'none';
        this.textContent = isHidden ? 'Hide Archive' : 'View Past Newsletters';
      }
    });
  });

});
