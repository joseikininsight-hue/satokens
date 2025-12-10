<?php
/**
 * Header Template
 * 
 * サトー建装 - プレミアムヘッダー
 * スティッキーヘッダー、メガメニュー、モバイルドロワー対応
 * 
 * @package Sato_Kenso
 * @version 2.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// 会社情報取得
$company_name   = sato_get_company_name();
$phone          = sato_get_phone();
$phone_link     = sato_get_phone_link();
$line_url       = sato_get_line_url();
$business_hours = get_theme_mod('sato_business_hours', '8:00〜18:00');
$holiday_text   = get_theme_mod('sato_holiday', '日曜・祝日');

// ページ判定
$is_front       = is_front_page();
$is_transparent = $is_front;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Favicon -->
    <?php if (has_site_icon()) : ?>
        <?php wp_site_icon(); ?>
    <?php else : ?>
        <link rel="icon" type="image/svg+xml" href="<?php echo SATO_THEME_URI; ?>/assets/images/favicon.svg">
    <?php endif; ?>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class($is_transparent ? 'has-transparent-header' : ''); ?>>
<?php wp_body_open(); ?>

<!-- Skip Link for Accessibility -->
<a href="#main" class="skip-link"><?php esc_html_e('メインコンテンツへスキップ', 'sato-kenso'); ?></a>

<!-- =========================================================================
     HEADER
     ========================================================================= -->
<header id="site-header" class="site-header <?php echo $is_transparent ? 'site-header--transparent' : ''; ?>" role="banner">
    
    <!-- Top Bar (PC Only) - ニュースティッカー追加 -->
    <div class="header-topbar">
        <div class="header-topbar__inner">
            <!-- 左側：ニュースティッカー -->
            <div class="header-topbar__left">
                <?php
                $latest_news = sato_get_news(['posts_per_page' => 1]);
                if ($latest_news->have_posts()) :
                    $latest_news->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="header-topbar__news">
                    <span class="header-topbar__news-label">NEWS</span>
                    <span class="header-topbar__news-title"><?php echo wp_trim_words(get_the_title(), 30, '...'); ?></span>
                    <span class="header-topbar__news-date"><?php echo get_the_date('Y.m.d'); ?></span>
                </a>
                <?php
                    wp_reset_postdata();
                else :
                ?>
                <span class="header-topbar__info">
                    <?php sato_icon('clock', 14); ?>
                    <span><?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）</span>
                </span>
                <?php endif; ?>
            </div>
            
            <!-- 右側：連絡先・SNS -->
            <div class="header-topbar__right">
                <span class="header-topbar__info header-topbar__info--hours">
                    <?php sato_icon('clock', 14); ?>
                    <span><?php echo esc_html($business_hours); ?></span>
                </span>
                <span class="header-topbar__info header-topbar__info--area">
                    <?php sato_icon('map-pin', 14); ?>
                    <span>御殿場市・静岡県東部対応</span>
                </span>
                
                <?php if ($line_url) : ?>
                <a href="<?php echo esc_url($line_url); ?>" class="header-topbar__link header-topbar__link--line" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                    LINE
                </a>
                <?php endif; ?>
                
                <!-- SNSリンク -->
                <?php
                $instagram = get_theme_mod('sato_instagram', '');
                $facebook = get_theme_mod('sato_facebook', '');
                if ($instagram || $facebook) :
                ?>
                <div class="header-topbar__social">
                    <?php if ($instagram) : ?>
                    <a href="<?php echo esc_url($instagram); ?>" class="header-topbar__social-link" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ($facebook) : ?>
                    <a href="<?php echo esc_url($facebook); ?>" class="header-topbar__social-link" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="header-main">
        <div class="header-main__inner">
            
            <!-- Logo -->
            <div class="header-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo__link" rel="home">
                        <span class="header-logo__text"><?php echo esc_html($company_name); ?></span>
                        <span class="header-logo__tagline">外壁塗装・屋根塗装専門店</span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Desktop Navigation -->
            <nav class="header-nav" role="navigation" aria-label="メインナビゲーション">
                <ul class="header-nav__list">
                    <!-- ホームボタン（常に表示） -->
                    <li class="header-nav__item header-nav__item--home">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-nav__link header-nav__link--home <?php echo $is_front ? 'is-current' : ''; ?>" aria-label="ホーム">
                            <?php sato_icon('home', 18); ?>
                        </a>
                    </li>
                <?php
                if (has_nav_menu('primary')) {
                    // wp_nav_menuを使用する場合、itemsのみ出力
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 2,
                        'items_wrap'     => '%3$s', // ul無しでliのみ出力
                    ]);
                } else {
                    ?>
                        <li class="header-nav__item header-nav__item--has-children">
                            <a href="<?php echo esc_url(home_url('/service/')); ?>" class="header-nav__link">
                                サービス
                                <?php sato_icon('chevron-down', 12); ?>
                            </a>
                            <ul class="header-nav__submenu">
                                <li><a href="<?php echo esc_url(home_url('/service/exterior/')); ?>">外壁塗装</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/roof/')); ?>">屋根塗装</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/waterproof/')); ?>">防水工事</a></li>
                                <li><a href="<?php echo esc_url(home_url('/service/repair/')); ?>">補修・修繕</a></li>
                            </ul>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/works/')); ?>" class="header-nav__link">施工事例</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/price/')); ?>" class="header-nav__link">料金案内</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/voice/')); ?>" class="header-nav__link">お客様の声</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/company/')); ?>" class="header-nav__link">会社案内</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/faq/')); ?>" class="header-nav__link">よくある質問</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="<?php echo esc_url(home_url('/news/')); ?>" class="header-nav__link">お知らせ</a>
                        </li>
                    <?php
                }
                ?>
                </ul>
            </nav>

            <!-- Header Actions (PC) -->
            <div class="header-actions">
                <a href="<?php echo esc_attr($phone_link); ?>" class="header-phone">
                    <span class="header-phone__icon">
                        <?php sato_icon('phone', 18); ?>
                    </span>
                    <span class="header-phone__content">
                        <span class="header-phone__label">お電話でのご相談</span>
                        <span class="header-phone__number"><?php echo esc_html($phone); ?></span>
                    </span>
                </a>
                
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--header">
                    <?php sato_icon('mail', 16); ?>
                    <span>無料相談</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button type="button" class="header-toggle" id="mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="メニューを開く">
                <span class="header-toggle__bar"></span>
                <span class="header-toggle__bar"></span>
                <span class="header-toggle__bar"></span>
            </button>
        </div>
    </div>
</header>

<!-- =========================================================================
     MOBILE MENU (Drawer)
     ========================================================================= -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="mobile-menu__overlay" data-close-menu></div>
    
    <div class="mobile-menu__drawer">
        <!-- Drawer Header -->
        <div class="mobile-menu__header">
            <div class="mobile-menu__logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="mobile-menu__logo-text"><?php echo esc_html($company_name); ?></span>
                <?php endif; ?>
            </div>
            <button type="button" class="mobile-menu__close" data-close-menu aria-label="メニューを閉じる">
                <?php sato_icon('close', 24); ?>
            </button>
        </div>

        <!-- Drawer Content -->
        <div class="mobile-menu__content">
            <!-- Navigation -->
            <nav class="mobile-menu__nav" role="navigation" aria-label="モバイルナビゲーション">
                <ul class="mobile-menu__list">
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('home', 20); ?>
                            <span>ホーム</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item mobile-menu__item--has-children">
                        <button type="button" class="mobile-menu__link mobile-menu__toggle-sub" aria-expanded="false">
                            <?php sato_icon('tool', 20); ?>
                            <span>サービス</span>
                            <?php sato_icon('chevron-down', 18); ?>
                        </button>
                        <ul class="mobile-menu__submenu">
                            <li><a href="<?php echo esc_url(home_url('/service/exterior/')); ?>">外壁塗装</a></li>
                            <li><a href="<?php echo esc_url(home_url('/service/roof/')); ?>">屋根塗装</a></li>
                            <li><a href="<?php echo esc_url(home_url('/service/waterproof/')); ?>">防水工事</a></li>
                            <li><a href="<?php echo esc_url(home_url('/service/repair/')); ?>">補修・修繕</a></li>
                        </ul>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/works/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('image', 20); ?>
                            <span>施工事例</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/price/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('certificate', 20); ?>
                            <span>料金案内</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/voice/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('award', 20); ?>
                            <span>お客様の声</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/company/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('home', 20); ?>
                            <span>会社案内</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/faq/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('info', 20); ?>
                            <span>よくある質問</span>
                        </a>
                    </li>
                    <li class="mobile-menu__item">
                        <a href="<?php echo esc_url(home_url('/news/')); ?>" class="mobile-menu__link">
                            <?php sato_icon('calendar', 20); ?>
                            <span>お知らせ</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- CTA Buttons -->
            <div class="mobile-menu__cta">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--block btn--lg">
                    <?php sato_icon('mail', 20); ?>
                    無料お見積り・相談
                </a>
                
                <?php if ($line_url) : ?>
                <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line btn--block" target="_blank" rel="noopener noreferrer">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                    LINEで気軽に相談
                </a>
                <?php endif; ?>
            </div>

            <!-- Contact Info -->
            <div class="mobile-menu__contact">
                <a href="<?php echo esc_attr($phone_link); ?>" class="mobile-menu__phone">
                    <span class="mobile-menu__phone-icon">
                        <?php sato_icon('phone', 24); ?>
                    </span>
                    <span class="mobile-menu__phone-content">
                        <span class="mobile-menu__phone-number"><?php echo esc_html($phone); ?></span>
                        <span class="mobile-menu__phone-hours"><?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）</span>
                    </span>
                </a>
            </div>

            <!-- Company Info -->
            <div class="mobile-menu__info">
                <p class="mobile-menu__company"><?php echo esc_html(sato_get_company_name(true)); ?></p>
                <p class="mobile-menu__address"><?php echo esc_html(get_theme_mod('sato_address', '')); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     FIXED CTA (Mobile)
     ========================================================================= -->
<div class="fixed-cta" id="fixed-cta">
    <a href="<?php echo esc_attr($phone_link); ?>" class="fixed-cta__btn fixed-cta__btn--phone">
        <?php sato_icon('phone', 22); ?>
        <span>電話</span>
    </a>
    <?php if ($line_url) : ?>
    <a href="<?php echo esc_url($line_url); ?>" class="fixed-cta__btn fixed-cta__btn--line" target="_blank" rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
        <span>LINE</span>
    </a>
    <?php endif; ?>
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="fixed-cta__btn fixed-cta__btn--contact">
        <?php sato_icon('mail', 22); ?>
        <span>無料相談</span>
    </a>
</div>

<!-- Main Content Wrapper -->
<main id="main" class="site-main" role="main">
