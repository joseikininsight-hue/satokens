/**
 * Header JavaScript
 * 
 * サトー建装 - プレミアムヘッダー
 * 
 * @package Sato_Kenso
 * @version 2.1.0
 */

(function() {
    'use strict';

    // Elements
    var header = document.getElementById('site-header');
    var mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    var fixedCta = document.getElementById('fixed-cta');
    var body = document.body;

    if (!header) return;

    // Variables
    var lastScrollY = 0;
    var ticking = false;

    // Scroll Handler
    function handleScroll() {
        var currentScrollY = window.pageYOffset;

        // Scrolled class
        if (currentScrollY > 50) {
            header.classList.add('is-scrolled');
        } else {
            header.classList.remove('is-scrolled');
        }

        // Hide/show on scroll
        if (currentScrollY > lastScrollY && currentScrollY > 300) {
            header.classList.add('is-hidden');
        } else {
            header.classList.remove('is-hidden');
        }

        // Fixed CTA
        if (fixedCta) {
            if (currentScrollY > 400) {
                fixedCta.classList.add('is-visible');
                body.classList.add('has-fixed-cta');
            } else {
                fixedCta.classList.remove('is-visible');
                body.classList.remove('has-fixed-cta');
            }
        }

        lastScrollY = currentScrollY;
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(handleScroll);
            ticking = true;
        }
    }, { passive: true });

    handleScroll();

    // Mobile Menu
    function openMobileMenu() {
        if (!mobileMenu || !mobileMenuToggle) return;
        
        mobileMenu.classList.add('is-open');
        mobileMenu.setAttribute('aria-hidden', 'false');
        mobileMenuToggle.classList.add('is-active');
        mobileMenuToggle.setAttribute('aria-expanded', 'true');
        body.classList.add('menu-open');
        
        var firstFocusable = mobileMenu.querySelector('button, a');
        if (firstFocusable) {
            setTimeout(function() { firstFocusable.focus(); }, 100);
        }
    }

    function closeMobileMenu() {
        if (!mobileMenu || !mobileMenuToggle) return;
        
        mobileMenu.classList.remove('is-open');
        mobileMenu.setAttribute('aria-hidden', 'true');
        mobileMenuToggle.classList.remove('is-active');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        body.classList.remove('menu-open');
        mobileMenuToggle.focus();
    }

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            if (mobileMenu && mobileMenu.classList.contains('is-open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    // Close buttons
    var closeButtons = document.querySelectorAll('[data-close-menu]');
    for (var i = 0; i < closeButtons.length; i++) {
        closeButtons[i].addEventListener('click', closeMobileMenu);
    }

    // Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
            closeMobileMenu();
        }
    });

    // Submenu toggle
    var subMenuToggles = document.querySelectorAll('.mobile-menu__toggle-sub');
    for (var j = 0; j < subMenuToggles.length; j++) {
        subMenuToggles[j].addEventListener('click', function() {
            var parent = this.closest('.mobile-menu__item--has-children');
            if (!parent) return;
            
            var isOpen = parent.classList.contains('is-open');
            
            // Close others
            var allOpen = document.querySelectorAll('.mobile-menu__item--has-children.is-open');
            for (var k = 0; k < allOpen.length; k++) {
                if (allOpen[k] !== parent) {
                    allOpen[k].classList.remove('is-open');
                    var toggle = allOpen[k].querySelector('.mobile-menu__toggle-sub');
                    if (toggle) toggle.setAttribute('aria-expanded', 'false');
                }
            }
            
            parent.classList.toggle('is-open');
            this.setAttribute('aria-expanded', String(!isOpen));
        });
    }

    // Close menu on link click
    if (mobileMenu) {
        var menuLinks = mobileMenu.querySelectorAll('a');
        for (var l = 0; l < menuLinks.length; l++) {
            menuLinks[l].addEventListener('click', function() {
                setTimeout(closeMobileMenu, 100);
            });
        }
    }

    // Resize handler
    var resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth > 1024 && mobileMenu && mobileMenu.classList.contains('is-open')) {
                closeMobileMenu();
            }
        }, 250);
    }, { passive: true });

    // Focus trap
    if (mobileMenu) {
        mobileMenu.addEventListener('keydown', function(e) {
            if (e.key !== 'Tab') return;
            
            var focusable = mobileMenu.querySelectorAll('button, a, input, [tabindex]:not([tabindex="-1"])');
            if (focusable.length === 0) return;
            
            var first = focusable[0];
            var last = focusable[focusable.length - 1];
            
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        });
    }

})();
