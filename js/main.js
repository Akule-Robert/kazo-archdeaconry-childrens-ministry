/* ============================================================
   KACM WEBSITE — MAIN JAVASCRIPT
   Kazo Archdeaconry Children's Ministry
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

  // ========================================================
  // 0. HERO SLIDESHOW
  // ========================================================
  var heroSlides = document.querySelectorAll('.hero-slide');
  var heroContents = document.querySelectorAll('.hero-content');
  if (heroSlides.length > 0) {
    var heroCurrent = 0;
    heroSlides[0].classList.add('active');
    if (heroContents[0]) heroContents[0].classList.add('active');
    setInterval(function () {
      heroSlides[heroCurrent].classList.remove('active');
      if (heroContents[heroCurrent]) heroContents[heroCurrent].classList.remove('active');
      heroCurrent = (heroCurrent + 1) % heroSlides.length;
      heroSlides[heroCurrent].classList.add('active');
      if (heroContents[heroCurrent]) heroContents[heroCurrent].classList.add('active');
    }, 5000);
  }

  // ========================================================
  // 1. MOBILE HAMBURGER MENU
  // ========================================================
  var hamburger = document.querySelector('.hamburger');
  var navLinks = document.querySelector('.nav-links');

  if (hamburger && navLinks) {
    hamburger.addEventListener('click', function () {
      hamburger.classList.toggle('active');
      navLinks.classList.toggle('active');
    });

    navLinks.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
      });
    });

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
  var navbar = document.querySelector('.navbar');
  if (navbar) {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    }
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

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
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
    var countObserver = new IntersectionObserver(function (entries) {
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

    countUpElements.forEach(function (el) { countObserver.observe(el); });
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
  // 6. TABS SYSTEM (Media page / homepage)
  // ========================================================
  var tabsNav = document.querySelector('.tabs-nav');
  if (tabsNav) {
    tabsNav.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var tabId = this.getAttribute('data-tab');
        tabsNav.querySelectorAll('.tab-btn').forEach(function (b) { b.classList.remove('active'); });
        document.querySelectorAll('.tab-panel').forEach(function (p) { p.classList.remove('active'); });
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

      var nameField = document.getElementById('contact-name');
      var nameGroup = nameField ? nameField.closest('.form-group') : null;
      if (nameField && nameField.value.trim().length < 2) {
        if (nameGroup) nameGroup.classList.add('error');
        valid = false;
      } else if (nameGroup) {
        nameGroup.classList.remove('error');
      }

      var emailField = document.getElementById('contact-email');
      var emailGroup = emailField ? emailField.closest('.form-group') : null;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (emailField && !emailRegex.test(emailField.value.trim())) {
        if (emailGroup) emailGroup.classList.add('error');
        valid = false;
      } else if (emailGroup) {
        emailGroup.classList.remove('error');
      }

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
          setTimeout(function () { successMsg.style.display = 'none'; }, 5000);
        }
      }
    });

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
  // 13. STATIC NEWSLETTER ARCHIVE TOGGLE
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

  // ========================================================
  // 14. FLUTTERWAVE DONATION MODAL
  // ========================================================
  var donateModal = document.getElementById('donate-modal');
  if (donateModal) {
    var openBtn = document.getElementById('open-donate-modal');
    var closeBtn = document.getElementById('modal-close');
    var selectedAmount = 20;
    var selectedMethod = '';

    var stepAmount = document.getElementById('modal-step-amount');
    var stepPayment = document.getElementById('modal-step-payment');
    var stepProcessing = document.getElementById('modal-processing');
    var stepSuccess = document.getElementById('modal-success');
    var stepError = document.getElementById('modal-error');

    var btnToPayment = document.getElementById('btn-to-payment');
    var btnProcessDonation = document.getElementById('btn-process-donation');
    var btnBackToAmount = document.getElementById('btn-back-to-amount');
    var btnCloseSuccess = document.getElementById('btn-close-success');
    var btnRetry = document.getElementById('btn-retry');
    var customAmountInput = document.getElementById('custom-amount');
    var amountDisplay = document.getElementById('selected-amount-display');
    var donatedAmount = document.getElementById('donated-amount');

    function resetModal() {
      stepAmount.style.display = 'block';
      stepPayment.style.display = 'none';
      stepProcessing.classList.remove('active');
      stepSuccess.classList.remove('active');
      stepError.classList.remove('active');
      donateModal.querySelectorAll('.amount-btn').forEach(function (b) { b.classList.remove('selected'); });
      donateModal.querySelectorAll('.pm-btn').forEach(function (b) { b.classList.remove('selected'); });
      selectedAmount = 20;
      selectedMethod = '';
      btnToPayment.disabled = true;
      btnProcessDonation.disabled = true;
      if (customAmountInput) customAmountInput.value = '';
      var defaultBtn = donateModal.querySelector('.amount-btn[data-amount="20"]');
      if (defaultBtn) defaultBtn.classList.add('selected');
    }

    openBtn.addEventListener('click', function (e) {
      e.preventDefault();
      resetModal();
      // Check if a card was preselected on the donate page
      var preselected = document.querySelector('.impact-card.selected');
      if (preselected) {
        var amt = parseInt(preselected.getAttribute('data-amount'));
        selectedAmount = amt || 20;
        btnToPayment.disabled = false;
        // Auto-select the matching modal amount button
        donateModal.querySelectorAll('.amount-btn').forEach(function (b) { b.classList.remove('selected'); });
        var match = donateModal.querySelector('.amount-btn[data-amount="' + selectedAmount + '"]');
        if (match) match.classList.add('selected');
      }
      donateModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    });

    function closeModal() {
      donateModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModal);
    donateModal.addEventListener('click', function (e) {
      if (e.target === donateModal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && donateModal.classList.contains('active')) closeModal();
    });

    donateModal.querySelectorAll('.amount-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        donateModal.querySelectorAll('.amount-btn').forEach(function (b) { b.classList.remove('selected'); });
        this.classList.add('selected');
        selectedAmount = parseInt(this.getAttribute('data-amount'));
        if (customAmountInput) customAmountInput.value = '';
        btnToPayment.disabled = false;
      });
    });

    if (customAmountInput) {
      customAmountInput.addEventListener('input', function () {
        var val = parseInt(this.value);
        if (val && val > 0) {
          donateModal.querySelectorAll('.amount-btn').forEach(function (b) { b.classList.remove('selected'); });
          selectedAmount = val;
          btnToPayment.disabled = false;
        } else if (!this.value) {
          btnToPayment.disabled = true;
        }
      });
    }

    btnToPayment.addEventListener('click', function () {
      stepAmount.style.display = 'none';
      stepPayment.style.display = 'block';
      amountDisplay.textContent = '$' + selectedAmount;
      btnProcessDonation.disabled = true;
    });

    btnBackToAmount.addEventListener('click', function () {
      stepPayment.style.display = 'none';
      stepAmount.style.display = 'block';
    });

    donateModal.querySelectorAll('.pm-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        donateModal.querySelectorAll('.pm-btn').forEach(function (b) { b.classList.remove('selected'); });
        this.classList.add('selected');
        selectedMethod = this.getAttribute('data-method');
        btnProcessDonation.disabled = false;
      });
    });

    btnProcessDonation.addEventListener('click', function () {
      stepPayment.style.display = 'none';
      stepProcessing.classList.add('active');

      setTimeout(function () {
        stepProcessing.classList.remove('active');
        var isSuccess = Math.random() < 0.9;
        if (isSuccess) {
          donatedAmount.textContent = '$' + selectedAmount;
          stepSuccess.classList.add('active');
        } else {
          stepError.classList.add('active');
        }
      }, 2000);
    });

    btnCloseSuccess.addEventListener('click', function () {
      closeModal();
      setTimeout(function () {
        window.scrollBy({ top: 300, behavior: 'smooth' });
      }, 300);
    });

    btnRetry.addEventListener('click', function () {
      stepError.classList.remove('active');
      stepPayment.style.display = 'block';
      btnProcessDonation.disabled = !selectedMethod;
    });
  }

  // ========================================================
  // 15. PROGRAM DETAIL MODAL
  // ========================================================
  var programModal = document.getElementById('program-modal');
  if (programModal) {
    var programData = {
      sports: {
        title: 'Sports Ministry',
        img: 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=800&q=80',
        desc: 'At KACM, we believe that sport is a powerful tool for sharing the Gospel. Through football, netball, athletics, and other sports activities, we create safe spaces where children and youth engage in healthy competition while learning values of teamwork, discipline, and respect — all rooted in the teachings of Christ.',
        list: [
          'Regular sports events organised across parishes in Kazo Archdeaconry',
          'Sports tournaments used as platforms for Gospel outreach and evangelism',
          'Children coached by trained volunteers who integrate Biblical teachings',
          'Inter-parish sports competitions to promote unity across the Archdeaconry'
        ]
      },
      mddp: {
        title: 'Music, Drama, Dance & Poetry',
        img: 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?auto=format&fit=crop&w=800&q=80',
        desc: 'Music, Drama, Dance, and Poetry are powerful expressions of faith. KACM uses the performing arts to communicate the Gospel creatively, giving children and youth a platform to express their faith, develop their God-given talents, and minister to their communities with confidence and joy.',
        list: [
          'Drama performances enacting Biblical stories and moral lessons',
          "Children's choirs leading worship in parish churches and community events",
          'Poetry and spoken word competitions for children to express their faith',
          'Dance groups performing at outreaches, Children\'s Sundays, and special events',
          'MDD&P activities conducted in English, Luganda, and Runyakitara'
        ]
      },
      outreach: {
        title: 'Community Outreaches',
        img: 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?auto=format&fit=crop&w=800&q=80',
        desc: 'Each year, KACM organises scheduled outreaches into communities across the Kazo Archdeaconry. These outreaches are moments of tangible grace — where the love of Christ is shown through practical action: food distribution, healthcare, education support, and prayer.',
        list: [
          'Distribution of food, clothing, and essential supplies to vulnerable families',
          'Free medical and health awareness camps in underserved communities',
          'School visits and educational awareness campaigns to reduce dropout rates',
          'Child protection sensitisation for parents, teachers, and community leaders',
          'Prayer and evangelism sessions in homes, schools, and public spaces'
        ]
      }
    };

    var modalTitle = document.getElementById('program-modal-title');
    var modalImg = document.getElementById('program-modal-img');
    var modalDesc = document.getElementById('program-modal-desc');
    var modalList = document.getElementById('program-modal-list');
    var modalClose = document.getElementById('program-modal-close');

    function openProgramModal(programKey) {
      var data = programData[programKey];
      if (!data) return;
      modalTitle.textContent = data.title;
      modalImg.src = data.img;
      modalImg.alt = data.title;
      modalDesc.textContent = data.desc;
      modalList.innerHTML = '';
      data.list.forEach(function (item) {
        var li = document.createElement('li');
        li.textContent = item;
        li.style.cssText = 'padding:8px 0; padding-left:24px; position:relative; font-size:15px;';
        var bullet = document.createElement('span');
        bullet.style.cssText = 'position:absolute; left:0; top:16px; width:8px; height:8px; background:var(--secondary); border-radius:50%;';
        li.appendChild(bullet);
        modalList.appendChild(li);
      });
      programModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeProgramModal() {
      programModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    document.querySelectorAll('.program-learn-more').forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        var program = this.getAttribute('data-program');
        openProgramModal(program);
      });
    });

    modalClose.addEventListener('click', closeProgramModal);
    programModal.addEventListener('click', function (e) {
      if (e.target === programModal) closeProgramModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && programModal.classList.contains('active')) closeProgramModal();
    });
  }

  // ========================================================
  // 16. GALLERY MODAL
  // ========================================================
  var galleryModal = document.getElementById('gallery-modal');
  if (galleryModal) {
    var galleryOpenBtn = document.getElementById('open-gallery-modal');
    var galleryCloseBtn = document.getElementById('gallery-modal-close');

    galleryOpenBtn.addEventListener('click', function (e) {
      e.preventDefault();
      galleryModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    });

    function closeGalleryModal() {
      galleryModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    galleryCloseBtn.addEventListener('click', closeGalleryModal);
    galleryModal.addEventListener('click', function (e) {
      if (e.target === galleryModal) closeGalleryModal();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && galleryModal.classList.contains('active')) closeGalleryModal();
    });

    // Gallery item click — show preview overlay
    var gmPreview = document.getElementById('gm-preview');
    var gmPreviewImg = document.getElementById('gm-preview-img');
    var gmPreviewLabel = document.getElementById('gm-preview-label');
    var gmPreviewClose = document.getElementById('gm-preview-close');

    galleryModal.querySelectorAll('.gm-item').forEach(function (item) {
      item.addEventListener('click', function () {
        var imgUrl = this.getAttribute('data-img');
        var label = this.getAttribute('data-label');
        if (imgUrl) {
          gmPreviewImg.src = imgUrl;
          gmPreviewImg.alt = label || '';
          if (gmPreviewLabel) gmPreviewLabel.textContent = label || '';
          gmPreview.style.display = 'flex';
        }
      });
    });

    if (gmPreviewClose) {
      gmPreviewClose.addEventListener('click', function () {
        gmPreview.style.display = 'none';
      });
    }
    if (gmPreview) {
      gmPreview.addEventListener('click', function (e) {
        if (e.target === gmPreview) {
          gmPreview.style.display = 'none';
        }
      });
    }
  }

});

/* Global: select an impact card on the donate page */
function selectDonateCard(el) {
  document.querySelectorAll('.impact-card').forEach(function (c) { c.classList.remove('selected'); });
  el.classList.add('selected');
}

/* Global: select a payment method card and open the modal */
function selectPayment(el) {
  document.querySelectorAll('.pm-card').forEach(function (c) { c.classList.remove('selected'); });
  el.classList.add('selected');
  // Open the donate modal
  var modal = document.getElementById('donate-modal');
  var openBtn = document.getElementById('open-donate-modal');
  if (modal && openBtn) {
    openBtn.click();
  }
}
