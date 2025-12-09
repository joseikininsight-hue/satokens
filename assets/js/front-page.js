// =============================================================================
// Price Simulator
// =============================================================================
document.addEventListener('DOMContentLoaded', function() {
    const simulator = document.querySelector('.price-simulator');
    if (!simulator) return;

    const buildingTypeInputs = document.querySelectorAll('input[name="building_type"]');
    const areaCheckboxes = document.querySelectorAll('input[name="area[]"]');
    const gradeInputs = document.querySelectorAll('input[name="grade"]');
    const priceDisplay = document.getElementById('simulator-price');
    const summaryDisplay = document.getElementById('simulator-summary');

    function calculatePrice() {
        // 建物タイプを取得
        const buildingType = document.querySelector('input[name="building_type"]:checked');
        if (!buildingType) return;
        
        const size = buildingType.value;
        const sizeLabel = buildingType.dataset.label;

        // グレードを取得
        const grade = document.querySelector('input[name="grade"]:checked');
        if (!grade) return;
        
        const gradeMultiplier = parseFloat(grade.value);
        const gradeLabel = grade.dataset.label;

        // チェックされた塗装箇所を取得
        const checkedAreas = Array.from(areaCheckboxes).filter(cb => cb.checked);
        
        if (checkedAreas.length === 0) {
            priceDisplay.textContent = '0';
            summaryDisplay.textContent = '塗装箇所を選択してください';
            return;
        }

        // 合計金額を計算
        let totalPrice = 0;
        const areaLabels = [];

        checkedAreas.forEach(checkbox => {
            const priceKey = `data-price-${size}`;
            const basePrice = parseInt(checkbox.getAttribute(priceKey)) || 0;
            totalPrice += basePrice * gradeMultiplier;
            areaLabels.push(checkbox.value);
        });

        // 金額を表示（3桁区切り）
        priceDisplay.textContent = totalPrice.toLocaleString('ja-JP');

        // サマリーを表示
        const summary = `${sizeLabel} / ${areaLabels.join('・')} / ${gradeLabel}`;
        summaryDisplay.textContent = summary;
    }

    // イベントリスナーを設定
    buildingTypeInputs.forEach(input => {
        input.addEventListener('change', calculatePrice);
    });

    areaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculatePrice);
    });

    gradeInputs.forEach(input => {
        input.addEventListener('change', calculatePrice);
    });

    // 初期計算
    calculatePrice();
});

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

function initScrollReveal() {
    var revealElements = document.querySelectorAll('.scroll-reveal');
    
    if (revealElements.length === 0) return;

    // すぐにすべての要素を表示（デバッグ用）
    revealElements.forEach(function(el) {
        el.classList.add('is-visible');
    });
}

