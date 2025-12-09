<?php
/**
 * Template Name: フロントページ（プレミアム塗装職人 完全版）
 * Description: 塗装の質感を表現したハイエンドLP。動的アニメーション、Before/After比較、
 *              ストーリーテリング、信頼性の可視化、マイクロインタラクションを実装。
 *              SEO最適化・構造化データ・アクセシビリティ完全対応。
 * Author: Senior WordPress Engineer
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// フロントページ用CSS/JSを読み込み
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'sato-front-page-css',
        get_template_directory_uri() . '/assets/css/front-page.css',
        ['sato-style'],
        filemtime(get_template_directory() . '/assets/css/front-page.css')
    );
    wp_enqueue_script(
        'sato-front-page-js',
        get_template_directory_uri() . '/assets/js/front-page.js',
        ['jquery'],
        filemtime(get_template_directory() . '/assets/js/front-page.js'),
        true
    );
}, 20);

get_header();

// =============================================================================
// 1. 設定・データ取得
// =============================================================================

// 会社情報
$company_name    = sato_get_company_name();
$company_name_full = sato_get_company_name(true);
$phone           = sato_get_phone();
$phone_link      = sato_get_phone_link();
$line_url        = sato_get_line_url();
$business_hours  = get_theme_mod('sato_business_hours', '8:00〜18:00');
$holiday_text    = get_theme_mod('sato_holiday', '日曜・祝日');
$warranty_years  = sato_get_warranty_years();
$years_business  = sato_get_years_in_business();
$address         = get_theme_mod('sato_address', '静岡県御殿場市');
$service_areas   = sato_get_service_areas();

// ヒーローセクション
$hero_catch1     = get_theme_mod('sato_hero_catch1', '住まいを守る、');
$hero_catch2     = get_theme_mod('sato_hero_catch2', '職人の技術と想い。');
$hero_sub        = get_theme_mod('sato_hero_subcatch', '国家資格 一級塗装技能士が施工する御殿場市の塗装専門店');

// 画像URL（カスタマイザーまたはデフォルト）
$hero_image_id   = get_theme_mod('sato_hero_image_1', 0);
$hero_image_url  = $hero_image_id ? wp_get_attachment_image_url($hero_image_id, 'hero') : 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=1920';

// 統計データ
$works_count     = wp_count_posts('works')->publish ?: 0;
$voice_count     = wp_count_posts('voice')->publish ?: 0;

// =============================================================================
// 2. 構造化データ (JSON-LD)
// =============================================================================
$schema_local_business = [
    '@context'    => 'https://schema.org',
    '@type'       => 'HousePainter',
    '@id'         => home_url('/#organization'),
    'name'        => $company_name_full,
    'image'       => $hero_image_url,
    'telephone'   => $phone,
    'email'       => get_theme_mod('sato_email', ''),
    'url'         => home_url('/'),
    'description' => get_theme_mod('sato_site_description', '静岡県御殿場市を中心に外壁塗装・屋根塗装を行う塗装専門店'),
    'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $address,
        'addressLocality' => '御殿場市',
        'addressRegion'   => '静岡県',
        'addressCountry'  => 'JP',
        'postalCode'      => str_replace('〒', '', get_theme_mod('sato_zip', '')),
    ],
    'geo' => [
        '@type'     => 'GeoCoordinates',
        'latitude'  => '35.3088',
        'longitude' => '138.9344',
    ],
    'priceRange' => '¥¥',
    'openingHoursSpecification' => [
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        'opens'     => '08:00',
        'closes'    => '18:00',
    ],
    'areaServed' => array_map(function($area) {
        return ['@type' => 'City', 'name' => $area];
    }, $service_areas),
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name'  => '塗装サービス',
        'itemListElement' => [
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => '外壁塗装']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => '屋根塗装']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => '防水工事']],
        ],
    ],
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_local_business, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="front-page" role="main">

    <!-- =========================================================================
         HERO SECTION - ファーストビュー
         ========================================================================= -->
    <section class="hero" aria-label="メインビジュアル">
        <!-- 背景レイヤー -->
        <div class="hero__bg">
            <div class="hero__bg-image" style="background-image: url('<?php echo esc_url($hero_image_url); ?>');" role="img" aria-label="職人が丁寧に塗装作業を行っている様子"></div>
            <div class="hero__bg-overlay"></div>
            <!-- ペイントテクスチャ装飾 -->
            <div class="hero__paint-texture"></div>
        </div>

        <!-- 浮遊するパーティクル（塗料の飛沫イメージ） -->
        <div class="hero__particles" aria-hidden="true">
            <span class="particle particle--1"></span>
            <span class="particle particle--2"></span>
            <span class="particle particle--3"></span>
            <span class="particle particle--4"></span>
            <span class="particle particle--5"></span>
        </div>

        <div class="container hero__container">
            <div class="hero__content">
                <!-- バッジ -->
                <div class="hero__badge animate-fade-in">
                    <span class="hero__badge-icon">
                        <?php sato_icon('award', 18); ?>
                    </span>
                    <span class="hero__badge-text">御殿場・裾野エリア No.1 の実績</span>
                </div>

                <!-- メインコピー -->
                <h1 class="hero__title">
                    <span class="hero__title-line hero__title-line--sub animate-slide-up" style="--delay: 0.1s">
                        <?php echo esc_html($hero_catch1); ?>
                    </span>
                    <span class="hero__title-line hero__title-line--main animate-slide-up" style="--delay: 0.2s">
                        <span class="text-gradient"><?php echo esc_html($hero_catch2); ?></span>
                    </span>
                </h1>

                <!-- サブコピー -->
                <p class="hero__subtitle animate-slide-up" style="--delay: 0.3s">
                    <?php echo esc_html($hero_sub); ?>
                </p>

                <!-- CTA群 -->
                <div class="hero__cta animate-slide-up" style="--delay: 0.4s">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--xl btn--glow">
                        <span class="btn__icon"><?php sato_icon('mail', 20); ?></span>
                        <span class="btn__text">無料お見積り・診断</span>
                        <span class="btn__arrow"><?php sato_icon('arrow-right', 18); ?></span>
                    </a>
                    
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line btn--lg" target="_blank" rel="noopener noreferrer">
                        <span class="btn__icon">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                        </span>
                        <span class="btn__text">LINEで気軽に相談</span>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- 電話番号 -->
                <div class="hero__phone animate-slide-up" style="--delay: 0.5s">
                    <span class="hero__phone-label">お電話でのご相談</span>
                    <a href="<?php echo esc_attr($phone_link); ?>" class="hero__phone-number">
                        <?php sato_icon('phone', 24); ?>
                        <span><?php echo esc_html($phone); ?></span>
                    </a>
                    <span class="hero__phone-hours"><?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）</span>
                </div>
            </div>

        </div>

        <!-- スクロールインジケーター -->
        <div class="hero__scroll animate-fade-in" style="--delay: 1s">
            <span class="hero__scroll-text">Scroll</span>
            <span class="hero__scroll-line"></span>
        </div>

        <!-- 波形区切り -->
        <div class="hero__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64 C288,120 576,0 864,64 C1152,128 1296,32 1440,64 L1440,120 L0,120 Z" fill="#ffffff"/>
            </svg>
        </div>
    </section>

    <!-- =========================================================================
         PROBLEM SECTION - お悩み解決
         ========================================================================= -->
    <section class="section problem" aria-labelledby="problem-heading">
        <div class="container">
            <!-- セクションヘッダー -->
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">TROUBLE</span>
                <h2 class="section__title scroll-reveal" id="problem-heading">
                    こんな<span class="marker marker--warning">お悩み</span>ありませんか？
                </h2>
            </header>

            <div class="problem__grid">
                <!-- 問題リスト -->
                <div class="problem__list scroll-reveal">
                    <ul class="check-list check-list--warning">
                        <li class="check-list__item">
                            <span class="check-list__icon"><?php sato_icon('alert-triangle', 20); ?></span>
                            <div class="check-list__content">
                                <strong>外壁にひび割れ（クラック）がある</strong>
                                <p>放置すると雨水が侵入し、構造材の腐食や雨漏りの原因になります。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon"><?php sato_icon('alert-triangle', 20); ?></span>
                            <div class="check-list__content">
                                <strong>壁を触ると白い粉がつく（チョーキング）</strong>
                                <p>塗膜が劣化して防水機能が低下しているサインです。早めの対策が必要です。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon"><?php sato_icon('alert-triangle', 20); ?></span>
                            <div class="check-list__content">
                                <strong>コケ・カビ・藻が発生している</strong>
                                <p>湿気がこもりやすくなっており、外壁材の劣化を加速させます。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon"><?php sato_icon('alert-triangle', 20); ?></span>
                            <div class="check-list__content">
                                <strong>色あせ・塗装の剥がれが目立つ</strong>
                                <p>美観だけでなく、建物を守る機能も低下しています。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon"><?php sato_icon('alert-triangle', 20); ?></span>
                            <div class="check-list__content">
                                <strong>前回の塗装から10年以上経過している</strong>
                                <p>一般的な塗料の耐用年数は10〜15年。定期的なメンテナンスが建物寿命を延ばします。</p>
                            </div>
                        </li>
                    </ul>

                    <div class="problem__cta">
                        <p class="problem__cta-text">
                            <strong>これらの症状を放置すると...</strong><br>
                            修繕費用が<span class="text-danger">2〜3倍</span>になることも。<br>
                            早めの診断で、建物の寿命と資産価値を守りましょう。
                        </p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--lg">
                            <?php sato_icon('check-circle', 20); ?>
                            無料診断を申し込む
                        </a>
                    </div>
                </div>

                <!-- ビジュアル -->
                <div class="problem__visual scroll-reveal" style="--delay: 0.2s">
                    <div class="problem__image-wrapper">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/Gemini_Generated_Image_i2horvi2horvi2ho.png" 
                             alt="外壁の劣化症状（ひび割れ・チョーキング・コケ）" 
                             class="problem__image"
                             loading="lazy"
                             width="600"
                             height="450">
                        <div class="problem__image-badge">
                            <span class="problem__image-badge-icon">📍</span>
                            <span>放置は危険です</span>
                        </div>
                    </div>
                    
                    <!-- デコレーション -->
                    <div class="problem__deco problem__deco--1" aria-hidden="true"></div>
                    <div class="problem__deco problem__deco--2" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         SOLUTION SECTION - 解決策の提示
         ========================================================================= -->
    <section class="section solution" aria-labelledby="solution-heading">
        <div class="solution__bg" aria-hidden="true">
            <div class="solution__bg-pattern"></div>
        </div>
        
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">SOLUTION</span>
                <h2 class="section__title scroll-reveal" id="solution-heading">
                    <?php echo esc_html($company_name); ?>が<br class="sp-only">
                    <span class="marker marker--primary">すべて解決</span>します
                </h2>
                <p class="section__lead scroll-reveal">
                    国家資格を持つ職人が、お客様の大切な住まいを<br class="pc-only">
                    丁寧な施工と確かな技術でお守りします。
                </p>
            </header>

            <!-- ソリューションカード -->
            <div class="solution__cards">
                <article class="solution-card scroll-reveal">
                    <div class="solution-card__number">01</div>
                    <div class="solution-card__icon">
                        <?php sato_icon('tool', 48); ?>
                    </div>
                    <h3 class="solution-card__title">徹底した下地処理</h3>
                    <p class="solution-card__text">
                        塗装の持ちを左右する下地処理を、手を抜かず丁寧に。ひび割れ補修・ケレン・高圧洗浄まで職人が責任を持って施工します。
                    </p>
                </article>

                <article class="solution-card scroll-reveal" style="--delay: 0.1s">
                    <div class="solution-card__number">02</div>
                    <div class="solution-card__icon">
                        <?php sato_icon('shield', 48); ?>
                    </div>
                    <h3 class="solution-card__title">高品質塗料で長持ち</h3>
                    <p class="solution-card__text">
                        日本ペイント・エスケー化研など一流メーカーの塗料を使用。シリコン・ラジカル・フッ素など、建物に最適な塗料をご提案。
                    </p>
                </article>

                <article class="solution-card scroll-reveal" style="--delay: 0.2s">
                    <div class="solution-card__number">03</div>
                    <div class="solution-card__icon">
                        <?php sato_icon('handshake', 48); ?>
                    </div>
                    <h3 class="solution-card__title">施工後も安心サポート</h3>
                    <p class="solution-card__text">
                        最長<?php echo esc_html($warranty_years); ?>年の保証書を発行。地域密着だから何かあればすぐに駆けつけます。定期点検で長期的にサポート。
                    </p>
                </article>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         REASON SECTION - 選ばれる理由
         ========================================================================= -->
    <section class="section reason" aria-labelledby="reason-heading">
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">REASON</span>
                <h2 class="section__title scroll-reveal" id="reason-heading">
                    <?php echo esc_html($company_name); ?>が<br class="sp-only">
                    <span class="marker marker--accent">選ばれる3つの理由</span>
                </h2>
            </header>

            <div class="reason__list">
                <!-- 理由1 -->
                <article class="reason-card scroll-reveal">
                    <div class="reason-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/unnamed-1.jpg" 
                             alt="職人による自社施工の様子" 
                             loading="lazy"
                             width="560"
                             height="400">
                        <span class="reason-card__number">01</span>
                    </div>
                    <div class="reason-card__body">
                        <h3 class="reason-card__title">
                            完全自社施工で<br>
                            <span class="highlight">適正価格・高品質</span>を実現
                        </h3>
                        <p class="reason-card__text">
                            大手リフォーム会社のように下請け業者に丸投げしません。職人直営店だからこそ、中間マージンがゼロ。同じ品質なら大手より<strong>20〜30%お安く</strong>ご提供できます。
                        </p>
                        <ul class="reason-card__points">
                            <li><?php sato_icon('check', 16); ?> 見積もりから施工まで一貫対応</li>
                            <li><?php sato_icon('check', 16); ?> 職人と直接話せる安心感</li>
                            <li><?php sato_icon('check', 16); ?> 無駄なコストを塗料と手間に還元</li>
                        </ul>
                    </div>
                </article>

                <!-- 理由2 -->
                <article class="reason-card reason-card--reverse scroll-reveal">
                    <div class="reason-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/unnamed-2.jpg" 
                             alt="カラーシミュレーションで色選び" 
                             loading="lazy"
                             width="560"
                             height="400">
                        <span class="reason-card__number">02</span>
                    </div>
                    <div class="reason-card__body">
                        <h3 class="reason-card__title">
                            イメージ通りの仕上がり<br>
                            <span class="highlight">徹底したカラー提案</span>
                        </h3>
                        <p class="reason-card__text">
                            「思っていた色と違う...」というトラブルを防ぐため、カラーシミュレーションと大型色見本板を使用。周辺環境との調和も考慮し、プロの視点で最適な色をご提案します。
                        </p>
                        <ul class="reason-card__points">
                            <li><?php sato_icon('check', 16); ?> PCでカラーシミュレーション</li>
                            <li><?php sato_icon('check', 16); ?> A4サイズの大型色見本</li>
                            <li><?php sato_icon('check', 16); ?> 近隣住宅との調和を考慮</li>
                        </ul>
                    </div>
                </article>

                <!-- 理由3 -->
                <article class="reason-card scroll-reveal">
                    <div class="reason-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/unnamed-3.jpg" 
                             alt="アフターフォロー・定期点検" 
                             loading="lazy"
                             width="560"
                             height="400">
                        <span class="reason-card__number">03</span>
                    </div>
                    <div class="reason-card__body">
                        <h3 class="reason-card__title">
                            地域密着だからできる<br>
                            <span class="highlight">迅速対応＆長期保証</span>
                        </h3>
                        <p class="reason-card__text">
                            工事完了後は最長<?php echo esc_html($warranty_years); ?>年の保証書を発行。地元に根ざした会社だからこそ、何かあった際はすぐに駆けつけます。施工後からが本当のお付き合いです。
                        </p>
                        <ul class="reason-card__points">
                            <li><?php sato_icon('check', 16); ?> 最長<?php echo esc_html($warranty_years); ?>年の品質保証</li>
                            <li><?php sato_icon('check', 16); ?> 定期的な無料点検</li>
                            <li><?php sato_icon('check', 16); ?> 迅速なトラブル対応</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         WORKS SECTION - 施工事例（Before/After）
         ========================================================================= -->
    <section class="section works" aria-labelledby="works-heading">
        <div class="works__bg" aria-hidden="true"></div>
        
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">WORKS</span>
                <h2 class="section__title scroll-reveal" id="works-heading">
                    <span class="marker marker--primary">施工事例</span>
                </h2>
                <p class="section__lead scroll-reveal">
                    劇的なビフォーアフターをご覧ください。<br>
                    スライダーを動かして比較できます。
                </p>
            </header>

            <div class="works__grid">
                <?php
                $works_query = sato_get_works(['posts_per_page' => 3]);
                
                if ($works_query->have_posts()) :
                    $work_index = 0;
                    while ($works_query->have_posts()) : $works_query->the_post();
                        $work_index++;
                        
                        // メタデータ取得
                        $before_id   = get_post_meta(get_the_ID(), '_works_before_image', true);
                        $after_id    = get_post_meta(get_the_ID(), '_works_after_image', true);
                        $client_name = get_post_meta(get_the_ID(), '_works_client_name', true);
                        $work_cost   = get_post_meta(get_the_ID(), '_works_cost', true);
                        $work_period = get_post_meta(get_the_ID(), '_works_period', true);
                        $paint_name  = get_post_meta(get_the_ID(), '_works_paint_name', true);
                        
                        // 画像URL
                        $before_url = $before_id ? wp_get_attachment_image_url($before_id, 'works-large') : 'https://placehold.co/800x600/cccccc/666666?text=Before';
                        $after_url  = $after_id ? wp_get_attachment_image_url($after_id, 'works-large') : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'works-large') : 'https://placehold.co/800x600/1e3a5f/ffffff?text=After');
                        
                        // タクソノミー
                        $categories = get_the_terms(get_the_ID(), 'works_category');
                        $areas      = get_the_terms(get_the_ID(), 'works_area');
                        $category_name = (!empty($categories) && !is_wp_error($categories)) ? $categories[0]->name : '';
                        $area_name     = (!empty($areas) && !is_wp_error($areas)) ? $areas[0]->name : '';
                ?>
                <article class="works-card scroll-reveal" style="--delay: <?php echo ($work_index - 1) * 0.1; ?>s">
                    <!-- Before/After スライダー -->
                    <div class="ba-slider" aria-label="<?php the_title_attribute(); ?>の施工前後比較">
                        <div class="ba-slider__after">
                            <img src="<?php echo esc_url($after_url); ?>" alt="施工後" loading="lazy">
                            <span class="ba-slider__label ba-slider__label--after">After</span>
                        </div>
                        <div class="ba-slider__before">
                            <img src="<?php echo esc_url($before_url); ?>" alt="施工前" loading="lazy">
                            <span class="ba-slider__label ba-slider__label--before">Before</span>
                        </div>
                        <input type="range" class="ba-slider__range" min="0" max="100" value="50" aria-label="比較スライダー">
                        <div class="ba-slider__handle">
                            <span class="ba-slider__handle-icon">
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- 情報 -->
                    <div class="works-card__body">
                        <div class="works-card__tags">
                            <?php if ($category_name) : ?>
                            <span class="tag tag--category"><?php echo esc_html($category_name); ?></span>
                            <?php endif; ?>
                            <?php if ($area_name) : ?>
                            <span class="tag tag--area"><?php echo esc_html($area_name); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="works-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        
                        <?php if ($client_name || $work_cost || $paint_name) : ?>
                        <dl class="works-card__meta">
                            <?php if ($client_name) : ?>
                            <div class="works-card__meta-item">
                                <dt><?php sato_icon('map-pin', 14); ?></dt>
                                <dd><?php echo esc_html($client_name); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ($work_cost) : ?>
                            <div class="works-card__meta-item">
                                <dt><?php sato_icon('tool', 14); ?></dt>
                                <dd><?php echo esc_html($work_cost); ?></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                        <?php endif; ?>
                        
                        <a href="<?php the_permalink(); ?>" class="works-card__link">
                            詳しく見る <?php sato_icon('arrow-right', 16); ?>
                        </a>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <p class="works__empty">現在、施工事例を準備中です。</p>
                <?php endif; ?>
            </div>

            <div class="section__footer scroll-reveal">
                <a href="<?php echo esc_url(home_url('/works/')); ?>" class="btn btn--outline btn--lg">
                    すべての施工事例を見る
                    <?php sato_icon('arrow-right', 18); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         PRICE SECTION - 料金プラン
         ========================================================================= -->
    <section class="section price" aria-labelledby="price-heading">
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">PRICE</span>
                <h2 class="section__title scroll-reveal" id="price-heading">
                    わかりやすい<span class="marker marker--accent">コミコミ価格</span>
                </h2>
                <p class="section__lead scroll-reveal">
                    足場・高圧洗浄・養生・下塗り・中塗り・上塗り・保証<br>
                    すべて含んだ明朗会計。追加料金なしで安心です。
                </p>
            </header>

            <div class="price__grid">
                <!-- エコノミープラン -->
                <article class="price-card scroll-reveal">
                    <header class="price-card__header">
                        <h3 class="price-card__name">エコノミー</h3>
                        <span class="price-card__grade">シリコン塗装</span>
                    </header>
                    <div class="price-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/Gemini_Generated_Image_i1pnnni1pnnni1pn.png" 
                             alt="シリコン塗料" 
                             loading="lazy">
                    </div>
                    <div class="price-card__price">
                        <span class="price-card__condition">延床30坪の場合</span>
                        <div class="price-card__amount">
                            <span class="price-card__currency">¥</span>
                            <span class="price-card__number">49.8</span>
                            <span class="price-card__unit">万円〜</span>
                        </div>
                        <span class="price-card__tax">(税込 54.7万円〜)</span>
                    </div>
                    <ul class="price-card__features">
                        <li><?php sato_icon('check', 16); ?> 耐久年数：8〜10年</li>
                        <li><?php sato_icon('check', 16); ?> 初期費用を抑えたい方向け</li>
                        <li><?php sato_icon('check', 16); ?> スタンダードな品質</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--block">
                        このプランで見積もり
                    </a>
                </article>

                <!-- スタンダードプラン（おすすめ） -->
                <article class="price-card price-card--featured scroll-reveal" style="--delay: 0.1s">
                    <span class="price-card__ribbon">人気No.1</span>
                    <header class="price-card__header">
                        <h3 class="price-card__name">スタンダード</h3>
                        <span class="price-card__grade">ラジカル塗装</span>
                    </header>
                    <div class="price-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/unnamed-5.jpg" 
                             alt="ラジカル塗料" 
                             loading="lazy">
                    </div>
                    <div class="price-card__price">
                        <span class="price-card__condition">延床30坪の場合</span>
                        <div class="price-card__amount">
                            <span class="price-card__currency">¥</span>
                            <span class="price-card__number">59.8</span>
                            <span class="price-card__unit">万円〜</span>
                        </div>
                        <span class="price-card__tax">(税込 65.7万円〜)</span>
                    </div>
                    <ul class="price-card__features">
                        <li><?php sato_icon('check', 16); ?> 耐久年数：12〜15年</li>
                        <li><?php sato_icon('check', 16); ?> コスパと耐久性の両立</li>
                        <li><?php sato_icon('check', 16); ?> 当店一番人気</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--primary btn--block">
                        このプランで見積もり
                    </a>
                </article>

                <!-- プレミアムプラン -->
                <article class="price-card scroll-reveal" style="--delay: 0.2s">
                    <header class="price-card__header">
                        <h3 class="price-card__name">プレミアム</h3>
                        <span class="price-card__grade">フッ素塗装</span>
                    </header>
                    <div class="price-card__image">
                        <img src="https://satokens.jp/wp-content/uploads/2025/12/unnamed-7.jpg" 
                             alt="フッ素塗料" 
                             loading="lazy">
                    </div>
                    <div class="price-card__price">
                        <span class="price-card__condition">延床30坪の場合</span>
                        <div class="price-card__amount">
                            <span class="price-card__currency">¥</span>
                            <span class="price-card__number">74.8</span>
                            <span class="price-card__unit">万円〜</span>
                        </div>
                        <span class="price-card__tax">(税込 82.2万円〜)</span>
                    </div>
                    <ul class="price-card__features">
                        <li><?php sato_icon('check', 16); ?> 耐久年数：15〜20年</li>
                        <li><?php sato_icon('check', 16); ?> 長期間メンテナンス不要</li>
                        <li><?php sato_icon('check', 16); ?> 最高級の仕上がり</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--outline btn--block">
                        このプランで見積もり
                    </a>
                </article>
            </div>

            <p class="price__note scroll-reveal">
                ※価格は目安です。建物の形状・劣化状況により変動します。正確な金額は無料現地調査にてご案内いたします。
            </p>
        </div>
    </section>

    <!-- =========================================================================
         PRICE SIMULATOR SECTION - 料金シミュレーション
         ========================================================================= -->
    <section class="section price-simulator" aria-labelledby="price-simulator-heading">
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">PRICE SIMULATOR</span>
                <h2 class="section__title scroll-reveal" id="price-simulator-heading">
                    料金シミュレーション
                </h2>
                <p class="section__lead scroll-reveal">
                    簡単3ステップで概算費用をすぐに確認できます
                </p>
            </header>

            <div class="simulator">
                <div class="simulator__steps">
                    <!-- Step 1: 建物タイプ -->
                    <div class="simulator__step">
                        <h3 class="simulator__step-title">
                            <?php sato_icon('home', 20); ?>
                            <span>1. 建物のタイプ</span>
                        </h3>
                        <div class="simulator__options">
                            <label class="simulator__option">
                                <input type="radio" name="building_type" value="30" data-label="戸建て（〜30坪）" checked>
                                <span class="simulator__option-inner">
                                    <?php sato_icon('home', 24); ?>
                                    <strong>戸建て（〜30坪）</strong>
                                    <small>一般的な戸建て住宅</small>
                                </span>
                            </label>
                            <label class="simulator__option">
                                <input type="radio" name="building_type" value="50" data-label="戸建て（30〜50坪）">
                                <span class="simulator__option-inner">
                                    <?php sato_icon('home', 24); ?>
                                    <strong>戸建て（30〜50坪）</strong>
                                    <small>少し大きめの住宅</small>
                                </span>
                            </label>
                            <label class="simulator__option">
                                <input type="radio" name="building_type" value="70" data-label="戸建て（50坪〜）">
                                <span class="simulator__option-inner">
                                    <?php sato_icon('home', 24); ?>
                                    <strong>戸建て（50坪〜）</strong>
                                    <small>大型住宅</small>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Step 2: 塗装箇所 -->
                    <div class="simulator__step">
                        <h3 class="simulator__step-title">
                            <?php sato_icon('check-square', 20); ?>
                            <span>2. 塗装箇所を選択</span>
                        </h3>
                        <div class="simulator__checkboxes">
                            <label class="simulator__checkbox">
                                <input type="checkbox" name="area[]" value="外壁" data-price-30="800000" data-price-50="1200000" data-price-70="1600000" checked>
                                <span class="simulator__checkbox-inner">
                                    <?php sato_icon('check', 18); ?>
                                    <strong>外壁塗装</strong>
                                    <small>80万円〜</small>
                                </span>
                            </label>
                            <label class="simulator__checkbox">
                                <input type="checkbox" name="area[]" value="屋根" data-price-30="500000" data-price-50="700000" data-price-70="900000">
                                <span class="simulator__checkbox-inner">
                                    <?php sato_icon('check', 18); ?>
                                    <strong>屋根塗装</strong>
                                    <small>50万円〜</small>
                                </span>
                            </label>
                            <label class="simulator__checkbox">
                                <input type="checkbox" name="area[]" value="付帯部" data-price-30="200000" data-price-50="300000" data-price-70="400000">
                                <span class="simulator__checkbox-inner">
                                    <?php sato_icon('check', 18); ?>
                                    <strong>付帯部塗装</strong>
                                    <small>20万円〜</small>
                                </span>
                            </label>
                            <label class="simulator__checkbox">
                                <input type="checkbox" name="area[]" value="防水" data-price-30="300000" data-price-50="400000" data-price-70="500000">
                                <span class="simulator__checkbox-inner">
                                    <?php sato_icon('check', 18); ?>
                                    <strong>防水工事</strong>
                                    <small>30万円〜</small>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Step 3: 塗料グレード -->
                    <div class="simulator__step">
                        <h3 class="simulator__step-title">
                            <?php sato_icon('award', 20); ?>
                            <span>3. 塗料のグレード</span>
                        </h3>
                        <div class="simulator__options simulator__options--grade">
                            <label class="simulator__option">
                                <input type="radio" name="grade" value="1.0" data-label="スタンダード" checked>
                                <span class="simulator__option-inner">
                                    <?php sato_icon('circle', 20); ?>
                                    <strong>スタンダード</strong>
                                    <small>シリコン塗料（耐用年数 10〜12年）</small>
                                </span>
                            </label>
                            <label class="simulator__option">
                                <input type="radio" name="grade" value="1.3" data-label="プレミアム">
                                <span class="simulator__option-inner">
                                    <?php sato_icon('star', 20); ?>
                                    <strong>プレミアム</strong>
                                    <small>フッ素塗料（耐用年数 15〜18年）</small>
                                </span>
                            </label>
                            <label class="simulator__option">
                                <input type="radio" name="grade" value="1.5" data-label="ハイグレード">
                                <span class="simulator__option-inner">
                                    <?php sato_icon('award', 20); ?>
                                    <strong>ハイグレード</strong>
                                    <small>無機塗料（耐用年数 20年〜）</small>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 結果表示 -->
                <div class="simulator__result">
                    <div class="simulator__result-inner">
                        <div class="simulator__result-summary">
                            <p class="simulator__result-label">概算お見積り金額</p>
                            <p class="simulator__result-price">
                                <span class="simulator__result-amount" id="simulator-price">800,000</span>
                                <span class="simulator__result-unit">円〜</span>
                            </p>
                            <p class="simulator__result-note">
                                選択内容：<span id="simulator-summary"></span>
                            </p>
                        </div>
                        <div class="simulator__result-actions">
                            <a href="<?php echo esc_url(home_url('/price/')); ?>" class="btn btn--primary btn--lg">
                                <?php sato_icon('file-text', 20); ?>
                                <span>詳しい料金表を見る</span>
                            </a>
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--lg">
                                <?php sato_icon('mail', 20); ?>
                                <span>無料で正確な見積りを依頼</span>
                            </a>
                        </div>
                        <p class="simulator__result-disclaimer">
                            ※この金額はあくまで概算です。実際の金額は建物の状態、使用する塗料、施工内容により変動します。<br>
                            正確なお見積りは無料の現地調査にてご案内いたします。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
