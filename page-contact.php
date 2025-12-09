<?php
/**
 * Template Name: お問い合わせページ
 * Template Post Type: page
 * Description: AJAXフォーム機能付きの統合コンタクトページ
 * Author: Senior WordPress Engineer
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// データ取得
// =============================================================================
$company_name = sato_get_company_name();
$phone        = sato_get_phone();
$phone_link   = sato_get_phone_link();
$line_url     = sato_get_line_url();
$hours        = get_theme_mod('sato_business_hours', '8:00〜18:00');
$holiday      = get_theme_mod('sato_holiday', '日曜日・祝日');
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "お問い合わせ | <?php echo esc_js($company_name); ?>",
    "description": "お見積り依頼、現地調査のご予約、その他ご相談はこちらから。お電話、LINE、専用フォームより受け付けております。",
    "url": "<?php echo esc_url(get_permalink()); ?>",
    "mainEntity": {
        "@type": "Organization",
        "name": "<?php echo esc_js($company_name); ?>",
        "telephone": "<?php echo esc_js($phone); ?>",
        "contactPoint": [
            {
                "@type": "ContactPoint",
                "telephone": "<?php echo esc_js($phone); ?>",
                "contactType": "customer service",
                "areaServed": "JP",
                "availableLanguage": "Japanese"
            }
        ]
    }
}
</script>

<main id="main" class="contact-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1596524430615-b46475ddff6e?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">お問い合わせ</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">CONTACT</span>
                <h1 class="page-header__title">お問い合わせ</h1>
                <p class="page-header__lead">
                    お見積り・現地調査・ご相談は無料です。<br>
                    些細なことでもお気軽にご連絡ください。
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#ffffff"/></svg>
        </div>
    </section>

    <section class="section contact-methods">
        <div class="service-container">
            <div class="contact-methods__grid">
                <div class="method-box method-box--phone">
                    <div class="method-box__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <h2 class="method-box__title">お電話でのご相談</h2>
                    <p class="method-box__desc">お急ぎの方や、直接話したい方はこちら</p>
                    <a href="<?php echo esc_attr($phone_link); ?>" class="method-box__link">
                        <span class="tel-number"><?php echo esc_html($phone); ?></span>
                    </a>
                    <p class="method-box__note">受付：<?php echo esc_html($hours); ?> / 定休：<?php echo esc_html($holiday); ?></p>
                </div>

                <?php if ($line_url) : ?>
                <div class="method-box method-box--line">
                    <div class="method-box__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                    </div>
                    <h2 class="method-box__title">LINEでのご相談</h2>
                    <p class="method-box__desc">写真を送って簡単見積もり・チャット相談</p>
                    <a href="<?php echo esc_url($line_url); ?>" class="method-box__link btn--line" target="_blank" rel="noopener noreferrer">
                        LINEで友だち追加
                    </a>
                    <p class="method-box__note">24時間受付中（順次返信）</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section contact-form-section bg-gray" id="form">
        <div class="service-container">
            <div class="form-wrapper">
                <div class="form-head">
                    <h2 class="form-title">メールフォーム</h2>
                    <p class="form-desc">
                        以下のフォームに必要事項をご入力の上、「送信する」ボタンを押してください。<br>
                        通常2営業日以内に担当者よりご連絡いたします。
                    </p>
                </div>

                <form id="sato-contact-form" class="h-adr" method="post">
                    <input type="hidden" class="p-country-name" value="Japan">
                    <?php wp_nonce_field('sato_ajax_nonce', 'nonce'); ?>
                    <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">

                    <div class="form-group">
                        <label class="form-label">ご用件 <span class="badge-required">必須</span></label>
                        <div class="form-radio-group">
                            <label><input type="radio" name="service" value="無料診断・お見積り依頼" checked> 無料診断・お見積り依頼</label>
                            <label><input type="radio" name="service" value="資料請求"> 資料請求</label>
                            <label><input type="radio" name="service" value="ご質問・ご相談"> ご質問・ご相談</label>
                            <label><input type="radio" name="service" value="採用について"> 採用について</label>
                            <label><input type="radio" name="service" value="その他"> その他</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="name">お名前 <span class="badge-required">必須</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="例：佐藤 太郎" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">電話番号 <span class="badge-required">必須</span></label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="例：090-1234-5678" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">メールアドレス <span class="badge-required">必須</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="例：info@example.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">ご住所 <span class="badge-any">任意</span></label>
                        <p class="form-note">※現地調査をご希望の場合はご入力ください</p>
                        <div class="input-address">
                            <input type="text" class="p-postal-code form-control zip" placeholder="〒 郵便番号" size="8" maxlength="8">
                            <input type="text" name="address" id="address" class="p-region p-locality p-street-address p-extended-address form-control" placeholder="例：静岡県御殿場市...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">お問い合わせ内容 <span class="badge-required">必須</span></label>
                        <textarea name="message" id="message" class="form-control" rows="8" placeholder="ご相談内容や、建物の気になる症状などをご記入ください。" required></textarea>
                    </div>

                    <div class="form-privacy">
                        <label>
                            <input type="checkbox" name="privacy" required>
                            <a href="<?php echo home_url('/privacy-policy/'); ?>" target="_blank">プライバシーポリシー</a>に同意する
                        </label>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn btn--primary btn--submit" id="submit-btn">
                            送信する
                            <span class="spinner" id="loading-spinner"></span>
                        </button>
                    </div>

                    <div id="form-message" class="form-message"></div>
                </form>
            </div>
        </div>
    </section>

    <section class="section section--faq-link">
        <div class="service-container text-center">
            <h2 class="section-title-sm">よくあるご質問</h2>
            <p class="section-desc">お問い合わせの前に、よくあるご質問をご確認いただけます。</p>
            <a href="<?php echo home_url('/faq/'); ?>" class="btn btn--outline">FAQを見る</a>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* 共通設定 */
:root {
    --c-prm: #0d47a1;
    --c-acc: #f59e0b;
    --c-txt: #333;
    --c-bg-gray: #f8fafc;
    --c-danger: #ef4444;
    --c-success: #10b981;
    --radius-l: 16px;
    --radius-m: 8px;
    --shadow-card: 0 4px 6px -1px rgba(0,0,0,0.05);
    --container-max: 1200px;
    --container-pad: 20px;
}

/* コンテナ */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

.text-center { text-align: center; }
.bg-gray { background-color: var(--c-bg-gray); }

/* Page Header */
.page-header {
    position: relative;
    padding: 120px 0 80px;
    color: #fff;
    overflow: hidden;
    background-color: var(--c-prm);
}
.page-header__bg { position: absolute; inset: 0; z-index: 0; }
.page-header__bg-image { width: 100%; height: 100%; background-size: cover; background-position: center; filter: brightness(0.6); }
.page-header__bg-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(13,71,161,0.8), rgba(21,101,192,0.6)); }
.page-header__content { position: relative; z-index: 1; text-align: center; }
.page-header__tag { display: inline-block; padding: 6px 16px; border: 1px solid rgba(255,255,255,0.3); border-radius: 30px; font-size: 0.85rem; margin-bottom: 20px; letter-spacing: 0.1em; font-family: "DIN Alternate", sans-serif; }
.page-header__title { font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 20px; }
.page-header__lead { font-size: 1.1rem; opacity: 0.95; line-height: 1.8; }
.page-header__wave { position: absolute; bottom: -1px; left: 0; width: 100%; line-height: 0; z-index: 2; }
.page-header__wave svg { width: 100%; height: 60px; }

/* Breadcrumb */
.breadcrumb { padding: 20px 0; font-size: 0.85rem; color: rgba(255,255,255,0.8); position: relative; z-index: 2; }
.breadcrumb__list { display: flex; flex-wrap: wrap; align-items: center; list-style: none; padding: 0; margin: 0; gap: 8px; }
.breadcrumb__link { color: inherit; text-decoration: none; }
.breadcrumb__link:hover { color: #fff; }
.breadcrumb__separator { opacity: 0.5; }

/* Contact Methods */
.contact-methods { padding: 60px 0; }
.contact-methods__grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 900px;
    margin: 0 auto;
}
.method-box {
    background: #fff;
    padding: 40px 30px;
    border-radius: var(--radius-l);
    text-align: center;
    box-shadow: var(--shadow-card);
    border: 1px solid #eee;
}
.method-box__icon {
    width: 60px; height: 60px;
    margin: 0 auto 20px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
}
.method-box--phone .method-box__icon { background: #e3f2fd; color: var(--c-prm); }
.method-box--line .method-box__icon { background: #dcfce7; color: #16a34a; }

.method-box__title { font-size: 1.25rem; font-weight: bold; margin-bottom: 10px; }
.method-box__desc { font-size: 0.9rem; color: #666; margin-bottom: 20px; }
.method-box__link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 15px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}
.method-box--phone .method-box__link {
    background: var(--c-prm);
    color: #fff;
    font-size: 1.8rem;
    font-family: "DIN Alternate", sans-serif;
}
.method-box--phone .method-box__link:hover { opacity: 0.9; transform: translateY(-2px); }
.method-box--line .method-box__link {
    background: #06c755;
    color: #fff;
    font-size: 1.1rem;
}
.method-box--line .method-box__link:hover { background: #05b04a; transform: translateY(-2px); }

.method-box__note { font-size: 0.8rem; color: #888; margin-top: 15px; }

/* Contact Form */
.contact-form-section { padding: 80px 0; }
.form-wrapper {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 60px;
    border-radius: var(--radius-l);
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
}
.form-head { text-align: center; margin-bottom: 40px; }
.form-title { font-size: 1.8rem; font-weight: bold; margin-bottom: 15px; color: var(--c-prm); }
.form-desc { font-size: 0.95rem; color: #666; }

.form-group { margin-bottom: 25px; }
.form-label { display: block; font-weight: bold; margin-bottom: 8px; font-size: 1rem; }
.badge-required { background: var(--c-danger); color: #fff; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; margin-left: 5px; vertical-align: middle; }
.badge-any { background: #94a3b8; color: #fff; font-size: 0.7rem; padding: 2px 6px; border-radius: 4px; margin-left: 5px; vertical-align: middle; }
.form-note { font-size: 0.8rem; color: #888; margin: -5px 0 8px; }

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
    transition: 0.2s;
}
.form-control:focus { border-color: var(--c-prm); outline: none; box-shadow: 0 0 0 3px rgba(13,71,161,0.1); }

.form-radio-group { display: flex; flex-wrap: wrap; gap: 15px; }
.form-radio-group label {
    display: flex; align-items: center; gap: 5px; cursor: pointer;
    border: 1px solid #ddd; padding: 10px 15px; border-radius: 6px;
    background: #f9f9f9; transition: 0.2s;
}
.form-radio-group label:has(input:checked) {
    background: #e3f2fd; border-color: var(--c-prm); color: var(--c-prm); font-weight: bold;
}

.input-address { display: flex; flex-wrap: wrap; gap: 10px; }
.zip { width: 120px; }
.p-region { flex: 1; }

.form-privacy { text-align: center; margin: 30px 0; font-size: 0.95rem; }
.form-privacy a { color: var(--c-prm); text-decoration: underline; }

.form-submit { text-align: center; }
.btn--submit {
    width: 100%; max-width: 300px; padding: 15px; font-size: 1.2rem;
    display: inline-flex; align-items: center; justify-content: center;
    position: relative;
}
.btn--submit:disabled { opacity: 0.7; cursor: not-allowed; }

/* Message Area */
.form-message {
    margin-top: 20px;
    padding: 15px;
    border-radius: 6px;
    display: none;
    text-align: center;
    font-weight: bold;
}
.form-message.success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; display: block; }
.form-message.error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; display: block; }

/* Spinner */
.spinner {
    display: none;
    width: 20px; height: 20px; border: 2px solid #fff; border-top-color: transparent;
    border-radius: 50%; animation: spin 0.8s linear infinite; margin-left: 10px;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* FAQ Link */
.section--faq-link { padding: 40px 0 80px; }
.section-title-sm { font-size: 1.5rem; font-weight: bold; margin-bottom: 10px; }
.btn--outline {
    border: 2px solid var(--c-prm); color: var(--c-prm); background: transparent;
    padding: 10px 30px; border-radius: 50px; text-decoration: none; font-weight: bold;
    display: inline-block; transition: 0.3s;
}
.btn--outline:hover { background: var(--c-prm); color: #fff; }

/* Responsive */
@media (max-width: 768px) {
    .page-header { padding: 100px 0 60px; }
    .form-wrapper { padding: 30px 20px; }
    .form-radio-group { flex-direction: column; gap: 10px; }
    .input-address { flex-direction: column; }
    .zip { width: 100%; }
}
</style>

<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>

<script>
jQuery(document).ready(function($) {
    $('#sato-contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $btn = $('#submit-btn');
        var $spinner = $('#loading-spinner');
        var $message = $('#form-message');
        
        // UI更新
        $btn.prop('disabled', true);
        $spinner.show();
        $message.removeClass('success error').hide();
        
        // フォームデータ取得
        var formData = new FormData(this);
        formData.append('action', 'sato_contact_form_submit');
        
        // AJAX送信
        $.ajax({
            url: satoData.ajaxUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $form[0].reset();
                    $message.addClass('success').html(response.data.message).fadeIn();
                    // コンバージョン計測用のイベント発火（必要であれば）
                    // if(typeof gtag !== 'undefined') gtag('event', 'generate_lead');
                } else {
                    $message.addClass('error').html(response.data.message).fadeIn();
                    $btn.prop('disabled', false);
                }
            },
            error: function() {
                $message.addClass('error').html('通信エラーが発生しました。しばらく経ってから再度お試しください。').fadeIn();
                $btn.prop('disabled', false);
            },
            complete: function() {
                $spinner.hide();
                // 成功時はボタンを無効のままにする（連打防止）
                if (!$message.hasClass('success')) {
                    $btn.prop('disabled', false);
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>