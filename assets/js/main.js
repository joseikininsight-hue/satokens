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
        var revealElements = document.querySelectorAll('.scroll-reveal');
        
        if (revealElements.length === 0) return;

        // IntersectionObserver がサポートされているか確認
        if ('IntersectionObserver' in window) {
            var observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.1
            };

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        // 一度表示したら監視を解除（パフォーマンス向上）
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            revealElements.forEach(function(el) {
                observer.observe(el);
            });
        } else {
            // IntersectionObserver 非対応ブラウザのフォールバック
            revealElements.forEach(function(el) {
                el.classList.add('is-visible');
            });
        }
    }

    // =============================================================================
    // Before/After Slider (BA Slider)
    // =============================================================================
    function initBASliders() {
        var sliders = document.querySelectorAll('.ba-slider');
        
        sliders.forEach(function(slider) {
            var range = slider.querySelector('.ba-slider__range');
            var before = slider.querySelector('.ba-slider__before');
            var handle = slider.querySelector('.ba-slider__handle');

            if (!range || !before) return;

            function updateSlider(value) {
                var percent = value + '%';
                if (before) {
                    before.style.clipPath = 'inset(0 ' + (100 - value) + '% 0 0)';
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
        document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                
                // # だけの場合はスキップ
                if (href === '#') return;

                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    var header = document.querySelector('.site-header');
                    var headerHeight = header ? header.offsetHeight : 0;
                    var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

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
            var lazyImages = document.querySelectorAll('img[loading="lazy"]');
            
            if ('IntersectionObserver' in window) {
                var imageObserver = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            var img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                            }
                            imageObserver.unobserve(img);
                        }
                    });
                });

                lazyImages.forEach(function(img) {
                    imageObserver.observe(img);
                });
            }
        }
    }

    // =============================================================================
    // Initialize
    // =============================================================================
    function init() {
        initScrollReveal();
        initBASliders();
        initSmoothScroll();
        initLazyLoad();
    }

    // =============================================================================
    // 複数の方法で初期化を確実に実行
    // =============================================================================
    
    // 方法1: DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        // 方法2: 既にDOMが読み込まれている場合は即実行
        init();
    }
    
    // 方法3: windowのloadイベントでも再確認（フォールバック）
    window.addEventListener('load', function() {
        // is-visibleが一つも付与されていなければ再初期化
        if (document.querySelectorAll('.scroll-reveal.is-visible').length === 0) {
            init();
        }
    });

    // 方法4: jQueryが存在する場合はjQueryのreadyも使用
    if (typeof jQuery !== 'undefined') {
        jQuery(document).ready(function() {
            // 少し遅延させて確実に実行
            setTimeout(function() {
                if (document.querySelectorAll('.scroll-reveal.is-visible').length === 0) {
                    init();
                }
            }, 100);
        });
    }

})();
