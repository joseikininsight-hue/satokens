<?php
/**
 * Footer Template
 * 
 * サトー建装 - プレミアムフッター
 * CTAセクション、会社情報、サイトマップ、SNSリンク対応
 * 
 * @package Sato_Kenso
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// 会社情報取得
$company_name      = sato_get_company_name();
$company_name_full = sato_get_company_name(true);
$phone             = sato_get_phone();
$phone_link        = sato_get_phone_link();
$fax               = get_theme_mod('sato_fax', '');
$email             = get_theme_mod('sato_email', '');
$line_url          = sato_get_line_url();
$business_hours    = get_theme_mod('sato_business_hours', '8:00〜18:00');
$holiday_text      = get_theme_mod('sato_holiday', '日曜・祝日');
$address           = get_theme_mod('sato_address', '');
$zip               = get_theme_mod('sato_zip', '');
$warranty_years    = sato_get_warranty_years();
$service_areas     = sato_get_service_areas();

// SNS
$instagram    = get_theme_mod('sato_instagram', '');
$facebook     = get_theme_mod('sato_facebook', '');
$twitter      = get_theme_mod('sato_twitter', '');
$youtube      = get_theme_mod('sato_youtube', '');
$google_business = get_theme_mod('sato_google_business', '');

// 会社情報
$representative = get_theme_mod('sato_representative', '');
$established    = get_theme_mod('sato_established', '');
$license        = get_theme_mod('sato_license', '');

// 現在のページ判定
$is_contact_page = is_page('contact') || is_page('お問い合わせ');
?>

    <!-- =========================================================================
         FOOTER CTA SECTION (お問い合わせページ以外で表示)
         ========================================================================= -->
    <?php if (!$is_contact_page) : ?>
    <section class="footer-cta" aria-labelledby="footer-cta-heading">
        <div class="footer-cta__bg">
            <div class="footer-cta__pattern" aria-hidden="true"></div>
        </div>
        
        <div class="container">
            <div class="footer-cta__content">
                <div class="footer-cta__text">
                    <h2 class="footer-cta__title" id="footer-cta-heading">
                        外壁・屋根のお悩み、<br class="sp-only">
                        <span class="footer-cta__highlight">無料</span>でご相談ください
                    </h2>
                    <p class="footer-cta__lead">
                        お見積り・現地調査は完全無料。<br>
                        まずはお気軽にお問い合わせください。
                    </p>
                    
                    <ul class="footer-cta__features">
                        <li>
                            <?php sato_icon('check-circle', 18); ?>
                            <span>見積り無料</span>
                        </li>
                        <li>
                            <?php sato_icon('check-circle', 18); ?>
                            <span>出張無料</span>
                        </li>
                        <li>
                            <?php sato_icon('check-circle', 18); ?>
                            <span>相談無料</span>
                        </li>
                        <li>
                            <?php sato_icon('check-circle', 18); ?>
                            <span>しつこい営業なし</span>
                        </li>
                    </ul>
                </div>
                
                <div class="footer-cta__actions">
                    <!-- 電話 -->
                    <div class="footer-cta__phone">
                        <span class="footer-cta__phone-label">お電話でのご相談</span>
                        <a href="<?php echo esc_attr($phone_link); ?>" class="footer-cta__phone-number">
                            <?php sato_icon('phone', 28); ?>
                            <span><?php echo esc_html($phone); ?></span>
                        </a>
                        <span class="footer-cta__phone-hours">
                            受付 <?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）
                        </span>
                    </div>
                    
                    <!-- ボタン -->
                    <div class="footer-cta__buttons">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--xl btn--block">
                            <?php sato_icon('mail', 22); ?>
                            <span>無料お見積り・相談</span>
                            <?php sato_icon('arrow-right', 20); ?>
                        </a>
                        
                        <?php if ($line_url) : ?>
                        <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line btn--lg btn--block" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                            <span>LINEで気軽に相談</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- =========================================================================
         MAIN FOOTER
         ========================================================================= -->
    <footer id="site-footer" class="site-footer" role="contentinfo">
        
        <!-- Footer Top: 会社情報 & ナビゲーション -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-main__grid">
                    
                    <!-- 会社情報 -->
                    <div class="footer-company">
                        <div class="footer-company__logo">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-company__logo-link" rel="home">
                                    <span class="footer-company__logo-text"><?php echo esc_html($company_name); ?></span>
                                </a>
                            <?php endif; ?>
                            <p class="footer-company__tagline">外壁塗装・屋根塗装専門店</p>
                        </div>
                        
                        <div class="footer-company__info">
                            <?php if ($company_name_full) : ?>
                            <p class="footer-company__name"><?php echo esc_html($company_name_full); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($zip || $address) : ?>
                            <address class="footer-company__address">
                                <?php sato_icon('map-pin', 16); ?>
                                <span><?php echo esc_html($zip); ?> <?php echo esc_html($address); ?></span>
                            </address>
                            <?php endif; ?>
                            
                            <div class="footer-company__contact">
                                <a href="<?php echo esc_attr($phone_link); ?>" class="footer-company__phone">
                                    <?php sato_icon('phone', 16); ?>
                                    <span>TEL: <?php echo esc_html($phone); ?></span>
                                </a>
                                
                                <?php if ($fax) : ?>
                                <span class="footer-company__fax">
                                    <?php sato_icon('phone', 16); ?>
                                    <span>FAX: <?php echo esc_html($fax); ?></span>
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <p class="footer-company__hours">
                                <?php sato_icon('clock', 16); ?>
                                <span>営業時間: <?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）</span>
                            </p>
                        </div>
                        
                        <!-- SNS Links -->
                        <?php if ($instagram || $facebook || $twitter || $youtube || $line_url) : ?>
                        <div class="footer-social">
                            <span class="footer-social__label">Follow Us</span>
                            <div class="footer-social__links">
                                <?php if ($line_url) : ?>
                                <a href="<?php echo esc_url($line_url); ?>" class="footer-social__link footer-social__link--line" target="_blank" rel="noopener noreferrer" aria-label="LINE">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($instagram) : ?>
                                <a href="<?php echo esc_url($instagram); ?>" class="footer-social__link footer-social__link--instagram" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($facebook) : ?>
                                <a href="<?php echo esc_url($facebook); ?>" class="footer-social__link footer-social__link--facebook" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($twitter) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" class="footer-social__link footer-social__link--twitter" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($youtube) : ?>
                                <a href="<?php echo esc_url($youtube); ?>" class="footer-social__link footer-social__link--youtube" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($google_business) : ?>
                                <a href="<?php echo esc_url($google_business); ?>" class="footer-social__link footer-social__link--google" target="_blank" rel="noopener noreferrer" aria-label="Googleビジネスプロフィール">
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/></svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- ナビゲーション -->
                    <div class="footer-nav">
                        <!-- サービス -->
                        <div class="footer-nav__column">
                            <h3 class="footer-nav__title">サービス</h3>
                            <ul class="footer-nav__list">
                                <li><a href="<?php echo esc_url(home_url('/service/exterior/')); ?>">外壁塗装</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/roof/')); ?>">屋根塗装</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/waterproof/')); ?>">防水工事</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/repair/')); ?>">補修・修繕</a></li>
                                <li><a href="<?php echo esc_url(home_url('/price/')); ?>">料金案内</a></li>
                            </ul>
                        </div>
                        
                        <!-- 会社情報 -->
                        <div class="footer-nav__column">
                            <h3 class="footer-nav__title">会社情報</h3>
                            <ul class="footer-nav__list">
                                <li><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
                                <li><a href="<?php echo esc_url(home_url('/company/#greeting')); ?>">代表挨拶</a></li>
                                <li><a href="<?php echo esc_url(home_url('/staff/')); ?>">スタッフ紹介</a></li>
                                <li><a href="<?php echo esc_url(home_url('/company/#access')); ?>">アクセス</a></li>
                                <li><a href="<?php echo esc_url(home_url('/news/')); ?>">お知らせ</a></li>
                            </ul>
                        </div>
                        
                        <!-- お客様向け -->
                        <div class="footer-nav__column">
                            <h3 class="footer-nav__title">お客様向け</h3>
                            <ul class="footer-nav__list">
                                <li><a href="<?php echo esc_url(home_url('/works/')); ?>">施工事例</a></li>
                                <li><a href="<?php echo esc_url(home_url('/voice/')); ?>">お客様の声</a></li>
                                <li><a href="<?php echo esc_url(home_url('/faq/')); ?>">よくある質問</a></li>
                                <li><a href="<?php echo esc_url(home_url('/flow/')); ?>">ご依頼の流れ</a></li>
                                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">お問い合わせ</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- 対応エリア -->
                    <div class="footer-area">
                        <h3 class="footer-area__title">
                            <?php sato_icon('map-pin', 18); ?>
                            対応エリア
                        </h3>
                        <ul class="footer-area__list">
                            <?php foreach ($service_areas as $area) : ?>
                            <li><?php echo esc_html($area); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <p class="footer-area__note">
                            その他エリアもお気軽にご相談ください
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Footer Middle: 資格・保証バッジ -->
        <div class="footer-badges">
            <div class="container">
                <ul class="footer-badges__list">
                    <li class="footer-badges__item">
                        <div class="footer-badges__icon">
                            <?php sato_icon('certificate', 28); ?>
                        </div>
                        <div class="footer-badges__content">
                            <strong>一級塗装技能士</strong>
                            <span>国家資格保有</span>
                        </div>
                    </li>
                    <li class="footer-badges__item">
                        <div class="footer-badges__icon">
                            <?php sato_icon('shield-check', 28); ?>
                        </div>
                        <div class="footer-badges__content">
                            <strong>最長<?php echo esc_html($warranty_years); ?>年保証</strong>
                            <span>安心の長期保証</span>
                        </div>
                    </li>
                    <li class="footer-badges__item">
                        <div class="footer-badges__icon">
                            <?php sato_icon('home', 28); ?>
                        </div>
                        <div class="footer-badges__content">
                            <strong>完全自社施工</strong>
                            <span>中間マージン0円</span>
                        </div>
                    </li>
                    <li class="footer-badges__item">
                        <div class="footer-badges__icon">
                            <?php sato_icon('award', 28); ?>
                        </div>
                        <div class="footer-badges__content">
                            <strong>地域密着</strong>
                            <span>迅速対応</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Footer Bottom: コピーライト & 法的リンク -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom__inner">
                    <nav class="footer-legal" aria-label="法的情報">
                        <ul class="footer-legal__list">
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">プライバシーポリシー</a></li>
                            <li><a href="<?php echo esc_url(home_url('/sitemap/')); ?>">サイトマップ</a></li>
                            <?php if ($license) : ?>
                            <li><span>建設業許可: <?php echo esc_html($license); ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    
                    <p class="footer-copyright">
                        <small>&copy; <?php echo date('Y'); ?> <?php echo esc_html($company_name_full ?: $company_name); ?> All Rights Reserved.</small>
                    </p>
                </div>
            </div>
        </div>
        
    </footer>

    <!-- =========================================================================
         PAGE TOP BUTTON
         ========================================================================= -->
    <button type="button" class="page-top" id="page-top" aria-label="ページトップへ戻る">
        <?php sato_icon('chevron-up', 24); ?>
    </button>

    <!-- =========================================================================
         FOOTER STYLES
         ========================================================================= -->
    <style>
    /* =============================================================================
       Footer Variables
       ============================================================================= */
    :root {
        --footer-bg: #0f172a;
        --footer-bg-light: #1e293b;
        --footer-text: #94a3b8;
        --footer-text-light: #64748b;
        --footer-heading: #f8fafc;
        --footer-link-hover: #ffffff;
        --footer-border: rgba(255, 255, 255, 0.1);
        --footer-accent: var(--color-accent, #f59e0b);
    }

    /* =============================================================================
       Footer CTA Section
       ============================================================================= */
    .footer-cta {
        position: relative;
        padding: 80px 0;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        color: #fff;
        overflow: hidden;
    }

    .footer-cta__bg {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .footer-cta__pattern {
        position: absolute;
        inset: 0;
        opacity: 0.05;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .footer-cta__content {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 60px;
        align-items: center;
    }

    .footer-cta__title {
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 900;
        line-height: 1.4;
        margin: 0 0 1rem;
    }

    .footer-cta__highlight {
        position: relative;
        display: inline-block;
    }

    .footer-cta__highlight::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 2px;
        width: 100%;
        height: 8px;
        background: var(--footer-accent);
        opacity: 0.6;
        z-index: -1;
    }

    .footer-cta__lead {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0 0 1.5rem;
        line-height: 1.7;
    }

    .footer-cta__features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem 1.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-cta__features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
    }

    .footer-cta__features .icon {
        color: var(--color-success, #22c55e);
    }

    .footer-cta__actions {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        min-width: 320px;
    }

    .footer-cta__phone {
        text-align: center;
    }

    .footer-cta__phone-label {
        display: block;
        font-size: 0.875rem;
        opacity: 0.8;
        margin-bottom: 0.5rem;
    }

    .footer-cta__phone-number {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: var(--font-en, sans-serif);
        font-size: clamp(1.75rem, 3vw, 2.25rem);
        font-weight: 900;
        color: #fff;
        letter-spacing: 0.02em;
        transition: transform 0.3s ease;
    }

    .footer-cta__phone-number:hover {
        transform: scale(1.05);
    }

    .footer-cta__phone-hours {
        display: block;
        font-size: 0.8125rem;
        opacity: 0.7;
        margin-top: 0.5rem;
    }

    .footer-cta__buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    @media (max-width: 1024px) {
        .footer-cta__content {
            grid-template-columns: 1fr;
            gap: 40px;
            text-align: center;
        }

        .footer-cta__features {
            justify-content: center;
        }

        .footer-cta__actions {
            min-width: auto;
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .footer-cta {
            padding: 60px 0;
        }

        .footer-cta__features {
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
    }

    /* =============================================================================
       Footer Main
       ============================================================================= */
    .footer-main {
        background: var(--footer-bg);
        padding: 80px 0 60px;
    }

    .footer-main__grid {
        display: grid;
        grid-template-columns: 1.2fr 2fr 1fr;
        gap: 60px;
    }

    @media (max-width: 1024px) {
        .footer-main__grid {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
    }

    @media (max-width: 768px) {
        .footer-main {
            padding: 60px 0 40px;
        }

        .footer-main__grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }

    /* =============================================================================
       Footer Company Info
       ============================================================================= */
    .footer-company {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .footer-company__logo {
        margin-bottom: 0.5rem;
    }

    .footer-company__logo a {
        display: inline-block;
    }

    .footer-company__logo img {
        max-height: 50px;
        width: auto;
        filter: brightness(0) invert(1);
    }

    .footer-company__logo-text {
        font-size: 1.5rem;
        font-weight: 900;
        color: var(--footer-heading);
        letter-spacing: -0.02em;
    }

    .footer-company__tagline {
        font-size: 0.75rem;
        color: var(--footer-text-light);
        margin: 0.25rem 0 0;
        letter-spacing: 0.05em;
    }

    .footer-company__info {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }

    .footer-company__name {
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--footer-heading);
        margin: 0;
    }

    .footer-company__address {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-style: normal;
        color: var(--footer-text);
        line-height: 1.6;
    }

    .footer-company__address .icon {
        flex-shrink: 0;
        margin-top: 0.125rem;
        color: var(--footer-text-light);
    }

    .footer-company__contact {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem 1rem;
    }

    .footer-company__phone,
    .footer-company__fax {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--footer-text);
        transition: color 0.3s ease;
    }

    .footer-company__phone:hover {
        color: var(--footer-link-hover);
    }

    .footer-company__phone .icon,
    .footer-company__fax .icon {
        color: var(--footer-text-light);
    }

    .footer-company__hours {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--footer-text);
        margin: 0;
    }

    .footer-company__hours .icon {
        color: var(--footer-text-light);
    }

    /* =============================================================================
       Footer Social
       ============================================================================= */
    .footer-social {
        margin-top: 0.5rem;
    }

    .footer-social__label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--footer-text-light);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.75rem;
    }

    .footer-social__links {
        display: flex;
        gap: 0.5rem;
    }

    .footer-social__link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: var(--footer-bg-light);
        border-radius: 50%;
        color: var(--footer-text);
        transition: all 0.3s ease;
    }

    .footer-social__link:hover {
        transform: translateY(-3px);
    }

    .footer-social__link--line:hover {
        background: #06c755;
        color: #fff;
    }

    .footer-social__link--instagram:hover {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        color: #fff;
    }

    .footer-social__link--facebook:hover {
        background: #1877f2;
        color: #fff;
    }

    .footer-social__link--twitter:hover {
        background: #000;
        color: #fff;
    }

    .footer-social__link--youtube:hover {
        background: #ff0000;
        color: #fff;
    }

    .footer-social__link--google:hover {
        background: #4285f4;
        color: #fff;
    }

    /* =============================================================================
       Footer Navigation
       ============================================================================= */
    .footer-nav {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    @media (max-width: 1024px) {
        .footer-nav {
            grid-column: 1 / -1;
            order: 3;
        }
    }

    @media (max-width: 640px) {
        .footer-nav {
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
    }

    .footer-nav__title {
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--footer-heading);
        margin: 0 0 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--footer-border);
    }

    .footer-nav__list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-nav__list li {
        margin-bottom: 0.5rem;
    }

    .footer-nav__list a {
        display: inline-flex;
        align-items: center;
        font-size: 0.875rem;
        color: var(--footer-text);
        transition: all 0.3s ease;
        position: relative;
        padding-left: 0;
    }

    .footer-nav__list a::before {
        content: '';
        position: absolute;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--footer-accent);
        transition: width 0.3s ease;
    }

    .footer-nav__list a:hover {
        color: var(--footer-link-hover);
        padding-left: 1rem;
    }

    .footer-nav__list a:hover::before {
        width: 0.5rem;
    }

    /* =============================================================================
       Footer Area
       ============================================================================= */
    .footer-area {
        background: var(--footer-bg-light);
        padding: 1.5rem;
        border-radius: 12px;
    }

    @media (max-width: 1024px) {
        .footer-area {
            grid-column: 2;
            grid-row: 1;
        }
    }

    @media (max-width: 768px) {
        .footer-area {
            grid-column: 1;
            grid-row: auto;
        }
    }

    .footer-area__title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
        font-weight: 700;
        color: var(--footer-heading);
        margin: 0 0 1rem;
    }

    .footer-area__title .icon {
        color: var(--footer-accent);
    }

    .footer-area__list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.375rem 1rem;
        list-style: none;
        margin: 0 0 1rem;
        padding: 0;
    }

    .footer-area__list li {
        font-size: 0.8125rem;
        color: var(--footer-text);
        padding: 0.25rem 0;
        border-bottom: 1px dashed var(--footer-border);
    }

    .footer-area__note {
        font-size: 0.75rem;
        color: var(--footer-text-light);
        margin: 0;
        line-height: 1.5;
    }

    /* =============================================================================
       Footer Badges
       ============================================================================= */
    .footer-badges {
        background: var(--footer-bg-light);
        padding: 30px 0;
        border-top: 1px solid var(--footer-border);
        border-bottom: 1px solid var(--footer-border);
    }

    .footer-badges__list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-badges__item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    .footer-badges__item:hover {
        background: rgba(255, 255, 255, 0.06);
    }

    .footer-badges__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        border-radius: 50%;
        color: #fff;
        flex-shrink: 0;
    }

    .footer-badges__content {
        display: flex;
        flex-direction: column;
    }

    .footer-badges__content strong {
        font-size: 0.875rem;
        font-weight: 700;
        color: var(--footer-heading);
        line-height: 1.3;
    }

    .footer-badges__content span {
        font-size: 0.75rem;
        color: var(--footer-text-light);
    }

    @media (max-width: 1024px) {
        .footer-badges__list {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .footer-badges__list {
            grid-template-columns: 1fr;
        }
    }

    /* =============================================================================
       Footer Bottom
       ============================================================================= */
    .footer-bottom {
        background: var(--footer-bg);
        padding: 20px 0;
    }

    .footer-bottom__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .footer-legal__list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem 1.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-legal__list a,
    .footer-legal__list span {
        font-size: 0.75rem;
        color: var(--footer-text-light);
        transition: color 0.3s ease;
    }

    .footer-legal__list a:hover {
        color: var(--footer-link-hover);
    }

    .footer-copyright {
        margin: 0;
    }

    .footer-copyright small {
        font-size: 0.75rem;
        color: var(--footer-text-light);
    }

    @media (max-width: 768px) {
        .footer-bottom__inner {
            flex-direction: column;
            text-align: center;
        }

        .footer-legal__list {
            justify-content: center;
        }
    }

    /* =============================================================================
       Page Top Button
       ============================================================================= */
    .page-top {
        position: fixed;
        bottom: 100px;
        right: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: var(--color-primary);
        color: #fff;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s ease;
        z-index: 800;
    }

    .page-top.is-visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .page-top:hover {
        background: var(--color-primary-dark);
        transform: translateY(-3px);
    }

    @media (max-width: 1024px) {
        .page-top {
            bottom: calc(var(--fixed-cta-height, 60px) + 20px);
            right: 16px;
            width: 44px;
            height: 44px;
        }
    }

    /* =============================================================================
       Button Styles (Footer specific)
       ============================================================================= */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5em;
        padding: 0.875em 2em;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.5;
        border: 2px solid transparent;
        border-radius: 9999px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn--accent {
        background: var(--color-accent, #f59e0b);
        color: #fff;
    }

    .btn--accent:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .btn--line {
        background: #06c755;
        color: #fff;
    }

    .btn--line:hover {
        background: #05b04a;
    }

    .btn--lg {
        padding: 1em 2em;
    }

    .btn--xl {
        padding: 1.125em 2.5em;
        font-size: 1.0625rem;
    }

    .btn--block {
        width: 100%;
    }

    /* =============================================================================
       Utility Classes
       ============================================================================= */
    .sp-only {
        display: none;
    }

    @media (max-width: 640px) {
        .sp-only {
            display: inline;
        }
    }

    /* =============================================================================
       Print Styles
       ============================================================================= */
    @media print {
        .footer-cta,
        .footer-badges,
        .footer-social,
        .page-top {
            display: none !important;
        }

        .site-footer {
            background: #fff !important;
            color: #000 !important;
        }

        .footer-main {
            background: #fff !important;
            padding: 40px 0 !important;
        }

        .footer-company__logo img {
            filter: none !important;
        }

        .footer-company__logo-text,
        .footer-nav__title,
        .footer-area__title,
        .footer-company__name {
            color: #000 !important;
        }

        .footer-nav__list a,
        .footer-company__address,
        .footer-company__phone,
        .footer-company__hours,
        .footer-area__list li {
            color: #333 !important;
        }
    }

    /* =============================================================================
       Reduced Motion
       ============================================================================= */
    @media (prefers-reduced-motion: reduce) {
        .page-top,
        .footer-social__link,
        .footer-nav__list a,
        .footer-cta__phone-number {
            transition: none;
        }
    }
    </style>

    <!-- =========================================================================
         FOOTER JAVASCRIPT
         ========================================================================= -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        'use strict';

        // =========================================================================
        // Page Top Button
        // =========================================================================
        const pageTopBtn = document.getElementById('page-top');

        if (pageTopBtn) {
            // Show/hide button based on scroll position
            const togglePageTopBtn = () => {
                if (window.pageYOffset > 500) {
                    pageTopBtn.classList.add('is-visible');
                } else {
                    pageTopBtn.classList.remove('is-visible');
                }
            };

            window.addEventListener('scroll', togglePageTopBtn, { passive: true });
            togglePageTopBtn(); // Initial check

            // Scroll to top on click
            pageTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // =========================================================================
        // Smooth scroll for anchor links in footer
        // =========================================================================
        document.querySelectorAll('.site-footer a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerOffset = 100;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // =========================================================================
        // External link handling (add rel attributes for security)
        // =========================================================================
        document.querySelectorAll('.site-footer a[target="_blank"]').forEach(link => {
            if (!link.hasAttribute('rel')) {
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });

        // =========================================================================
        // Lazy load footer animations (optional enhancement)
        // =========================================================================
        if ('IntersectionObserver' in window) {
            const footerObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        footerObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.footer-badges__item, .footer-nav__column').forEach(el => {
                footerObserver.observe(el);
            });
        }
    });
    </script>

<?php wp_footer(); ?>

</body>
</html>
