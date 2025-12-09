/**
 * サトー建装 メインJavaScript
 * スクロールアニメーション、インタラクション処理
 */

(function() {
    'use strict';

    // =============================================================================
    // Scroll Reveal Animation (IntersectionObserver)
    // =============================================================================
    function initScrollReveal() {
        const revealElements = document.querySelectorAll('.scroll-reveal');
        
        if (revealElements.length === 0) return;

        // IntersectionObserver がサポートされているか確認
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        // 一度表示したら監視を解除（パフォーマンス向上）
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => {
                observer.observe(el);
            });
        } else {
            // IntersectionObserver 非対応ブラウザのフォールバック
            revealElements.forEach(el => {
                el.classList.add('is-visible');
            });
        }
    }

    // =============================================================================
    // Before/After Slider (BA Slider)
    // =============================================================================
    function initBASliders() {
        const sliders = document.querySelectorAll('.ba-slider');
        
        sliders.forEach(slider => {
            const range = slider.querySelector('.ba-slider__range');
            const before = slider.querySelector('.ba-slider__before');
            const handle = slider.querySelector('.ba-slider__handle');

            if (!range || !before) return;

            function updateSlider(value) {
                const percent = value + '%';
                if (before) {
                    before.style.clipPath = `inset(0 ${100 - value}% 0 0)`;
                }
                if (handle) {
                    handle.style.left = percent;
                }
            }

            // 初期値を設定
            updateSlider(range.value);

            // スライダー変更時
            range.addEventListener('input', function() {
                updateSlider(this.value);
            });
        });
    }

    // =============================================================================
    // Smooth Scroll for Anchor Links
    // =============================================================================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // # だけの場合はスキップ
                if (href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // =============================================================================
    // Lazy Load Images (Native + Fallback)
    // =============================================================================
    function initLazyLoad() {
        // ネイティブ lazy loading が使えない場合のフォールバック
        if (!('loading' in HTMLImageElement.prototype)) {
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                            }
                            imageObserver.unobserve(img);
                        }
                    });
                });

                lazyImages.forEach(img => imageObserver.observe(img));
            }
        }
    }

    // =============================================================================
    // Initialize on DOM Ready
    // =============================================================================
    function init() {
        initScrollReveal();
        initBASliders();
        initSmoothScroll();
        initLazyLoad();
    }

    // DOM が読み込まれたら初期化
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
