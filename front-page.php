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

            <!-- 実績バッジ（右サイド） -->
            <div class="hero__stats animate-fade-in" style="--delay: 0.6s">
                <div class="hero__stat-card">
                    <div class="hero__stat-icon"><?php sato_icon('image', 28); ?></div>
                    <div class="hero__stat-number" data-count="<?php echo esc_attr($works_count); ?>">0</div>
                    <div class="hero__stat-label">施工実績</div>
                </div>
                <div class="hero__stat-card">
                    <div class="hero__stat-icon"><?php sato_icon('shield-check', 28); ?></div>
                    <div class="hero__stat-number"><?php echo esc_html($warranty_years); ?><small>年</small></div>
                    <div class="hero__stat-label">最長保証</div>
                </div>
                <div class="hero__stat-card">
                    <div class="hero__stat-icon"><?php sato_icon('award', 28); ?></div>
                    <div class="hero__stat-number"><?php echo esc_html($years_business); ?><small>年</small></div>
                    <div class="hero__stat-label">創業</div>
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
         TRUST BADGES - 信頼の証
         ========================================================================= -->
    <section class="trust-badges" aria-label="信頼の証">
        <div class="container">
            <ul class="trust-badges__list">
                <li class="trust-badges__item scroll-reveal">
                    <div class="trust-badges__icon">
                        <?php sato_icon('certificate', 32); ?>
                    </div>
                    <div class="trust-badges__content">
                        <strong class="trust-badges__title">一級塗装技能士</strong>
                        <span class="trust-badges__desc">国家資格保有の職人が直接施工</span>
                    </div>
                </li>
                <li class="trust-badges__item scroll-reveal" style="--delay: 0.1s">
                    <div class="trust-badges__icon">
                        <?php sato_icon('home', 32); ?>
                    </div>
                    <div class="trust-badges__content">
                        <strong class="trust-badges__title">完全自社施工</strong>
                        <span class="trust-badges__desc">下請けなし・中間マージン0円</span>
                    </div>
                </li>
                <li class="trust-badges__item scroll-reveal" style="--delay: 0.2s">
                    <div class="trust-badges__icon">
                        <?php sato_icon('shield-check', 32); ?>
                    </div>
                    <div class="trust-badges__content">
                        <strong class="trust-badges__title">最長<?php echo esc_html($warranty_years); ?>年保証</strong>
                        <span class="trust-badges__desc">施工後も安心のアフターサポート</span>
                    </div>
                </li>
                <li class="trust-badges__item scroll-reveal" style="--delay: 0.3s">
                    <div class="trust-badges__icon">
                        <?php sato_icon('map-pin', 32); ?>
                    </div>
                    <div class="trust-badges__content">
                        <strong class="trust-badges__title">地域密着<?php echo esc_html($years_business); ?>年</strong>
                        <span class="trust-badges__desc">御殿場市・裾野市を中心に対応</span>
                    </div>
                </li>
            </ul>
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
                            <span class="check-list__icon">⚠️</span>
                            <div class="check-list__content">
                                <strong>外壁にひび割れ（クラック）がある</strong>
                                <p>放置すると雨水が侵入し、構造材の腐食や雨漏りの原因になります。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon">⚠️</span>
                            <div class="check-list__content">
                                <strong>壁を触ると白い粉がつく（チョーキング）</strong>
                                <p>塗膜が劣化して防水機能が低下しているサインです。早めの対策が必要です。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon">⚠️</span>
                            <div class="check-list__content">
                                <strong>コケ・カビ・藻が発生している</strong>
                                <p>湿気がこもりやすくなっており、外壁材の劣化を加速させます。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon">⚠️</span>
                            <div class="check-list__content">
                                <strong>色あせ・塗装の剥がれが目立つ</strong>
                                <p>美観だけでなく、建物を守る機能も低下しています。</p>
                            </div>
                        </li>
                        <li class="check-list__item">
                            <span class="check-list__icon">⚠️</span>
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
         VOICE SECTION - お客様の声
         ========================================================================= -->
    <section class="section voice" aria-labelledby="voice-heading">
        <div class="voice__bg" aria-hidden="true"></div>
        
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">VOICE</span>
                <h2 class="section__title scroll-reveal" id="voice-heading">
                    <span class="marker marker--primary">お客様の声</span>
                </h2>
                <p class="section__lead scroll-reveal">
                    実際にご依頼いただいたお客様からの<br>
                    生の声をご紹介します。
                </p>
            </header>

            <div class="voice__slider" role="region" aria-label="お客様の声スライダー">
                <div class="voice__track">
                    <?php
                    $voice_query = sato_get_voices(['posts_per_page' => 6]);
                    
                    if ($voice_query->have_posts()) :
                        while ($voice_query->have_posts()) : $voice_query->the_post();
                            $client_area    = get_post_meta(get_the_ID(), '_voice_client_area', true);
                            $client_initial = get_post_meta(get_the_ID(), '_voice_client_initial', true);
                            $client_age     = get_post_meta(get_the_ID(), '_voice_client_age', true);
                            $service_type   = get_post_meta(get_the_ID(), '_voice_service_type', true);
                            $rating         = get_post_meta(get_the_ID(), '_voice_rating', true) ?: 5;
                    ?>
                    <article class="voice-card">
                        <div class="voice-card__rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $star_class = $i <= $rating ? 'star--filled' : 'star--empty';
                                echo '<span class="star ' . $star_class . '">★</span>';
                            }
                            ?>
                        </div>
                        
                        <blockquote class="voice-card__content">
                            <?php echo wp_kses_post(wpautop(get_the_content())); ?>
                        </blockquote>
                        
                        <footer class="voice-card__footer">
                            <div class="voice-card__avatar">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('voice-avatar', ['alt' => '']); ?>
                                <?php else : ?>
                                    <span class="voice-card__avatar-placeholder">
                                        <?php echo mb_substr($client_initial ?: 'お客様', 0, 1); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="voice-card__info">
                                <cite class="voice-card__name">
                                    <?php echo esc_html($client_area); ?> <?php echo esc_html($client_initial); ?>
                                    <?php if ($client_age) : ?>
                                    <span class="voice-card__age"><?php echo esc_html($client_age); ?></span>
                                    <?php endif; ?>
                                </cite>
                                <?php if ($service_type) : ?>
                                <span class="voice-card__service"><?php echo esc_html($service_type); ?></span>
                                <?php endif; ?>
                            </div>
                        </footer>
                    </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                    <p class="voice__empty">お客様の声を準備中です。</p>
                    <?php endif; ?>
                </div>

                <!-- ナビゲーション -->
                <?php if ($voice_query->post_count > 1) : ?>
                <div class="voice__nav">
                    <button class="voice__nav-btn voice__nav-btn--prev" aria-label="前へ">
                        <?php sato_icon('chevron-left', 24); ?>
                    </button>
                    <button class="voice__nav-btn voice__nav-btn--next" aria-label="次へ">
                        <?php sato_icon('chevron-right', 24); ?>
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <div class="section__footer scroll-reveal">
                <a href="<?php echo esc_url(home_url('/voice/')); ?>" class="btn btn--outline btn--lg">
                    すべてのお客様の声を見る
                    <?php sato_icon('arrow-right', 18); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         FLOW SECTION - ご依頼の流れ
         ========================================================================= -->
    <section class="section flow" aria-labelledby="flow-heading">
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">FLOW</span>
                <h2 class="section__title scroll-reveal" id="flow-heading">
                    ご依頼の<span class="marker marker--accent">流れ</span>
                </h2>
                <p class="section__lead scroll-reveal">
                    お問い合わせから施工完了まで、<br>
                    丁寧にサポートいたします。
                </p>
            </header>

            <ol class="flow__steps">
                <li class="flow-step scroll-reveal">
                    <div class="flow-step__number">
                        <span>01</span>
                    </div>
                    <div class="flow-step__content">
                        <h3 class="flow-step__title">お問い合わせ</h3>
                        <p class="flow-step__text">
                            お電話・LINE・お問い合わせフォームよりお気軽にご連絡ください。ご相談だけでも大歓迎です。
                        </p>
                    </div>
                    <div class="flow-step__icon">
                        <?php sato_icon('phone', 32); ?>
                    </div>
                </li>

                <li class="flow-step scroll-reveal" style="--delay: 0.1s">
                    <div class="flow-step__number">
                        <span>02</span>
                    </div>
                    <div class="flow-step__content">
                        <h3 class="flow-step__title">現地調査・診断</h3>
                        <p class="flow-step__text">
                            専門スタッフがお伺いし、建物の状態を詳しく診断。劣化状況を写真付きでご報告します。
                        </p>
                    </div>
                    <div class="flow-step__icon">
                        <?php sato_icon('search', 32); ?>
                    </div>
                </li>

                <li class="flow-step scroll-reveal" style="--delay: 0.2s">
                    <div class="flow-step__number">
                        <span>03</span>
                    </div>
                    <div class="flow-step__content">
                        <h3 class="flow-step__title">お見積り・ご提案</h3>
                        <p class="flow-step__text">
                            診断結果をもとに、最適なプランとお見積りをご提示。カラーシミュレーションも承ります。
                        </p>
                    </div>
                    <div class="flow-step__icon">
                        <?php sato_icon('certificate', 32); ?>
                    </div>
                </li>

                <li class="flow-step scroll-reveal" style="--delay: 0.3s">
                    <div class="flow-step__number">
                        <span>04</span>
                    </div>
                    <div class="flow-step__content">
                        <h3 class="flow-step__title">ご契約・着工</h3>
                        <p class="flow-step__text">
                            ご納得いただけましたらご契約。近隣へのご挨拶も当社で行い、責任を持って施工開始します。
                        </p>
                    </div>
                    <div class="flow-step__icon">
                        <?php sato_icon('tool', 32); ?>
                    </div>
                </li>

                <li class="flow-step scroll-reveal" style="--delay: 0.4s">
                    <div class="flow-step__number">
                        <span>05</span>
                    </div>
                    <div class="flow-step__content">
                        <h3 class="flow-step__title">完工・お引き渡し</h3>
                        <p class="flow-step__text">
                            施工完了後、仕上がりをご確認いただきお引き渡し。保証書を発行し、アフターサポート開始です。
                        </p>
                    </div>
                    <div class="flow-step__icon">
                        <?php sato_icon('check-circle', 32); ?>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    <!-- =========================================================================
         FAQ SECTION - よくある質問
         ========================================================================= -->
    <section class="section faq" aria-labelledby="faq-heading">
        <div class="faq__bg" aria-hidden="true"></div>
        
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">FAQ</span>
                <h2 class="section__title scroll-reveal" id="faq-heading">
                    よくある<span class="marker marker--primary">ご質問</span>
                </h2>
            </header>

            <div class="faq__list" role="list">
                <?php
                // 注目FAQまたは通常FAQ取得
                $faq_query = new WP_Query([
                    'post_type'      => 'faq',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'meta_query'     => [
                        [
                            'key'     => '_faq_is_featured',
                            'value'   => '1',
                            'compare' => '=',
                        ],
                    ],
                    'orderby'        => 'meta_value_num',
                    'meta_key'       => '_faq_display_order',
                    'order'          => 'ASC',
                ]);
                
                // 注目FAQがなければ通常取得
                if (!$faq_query->have_posts()) {
                    $faq_query = sato_get_faqs(['posts_per_page' => 5]);
                }
                
                if ($faq_query->have_posts()) :
                    $faq_index = 0;
                    while ($faq_query->have_posts()) : $faq_query->the_post();
                        $faq_index++;
                ?>
                <details class="faq-item scroll-reveal" style="--delay: <?php echo ($faq_index - 1) * 0.05; ?>s">
                    <summary class="faq-item__question">
                        <span class="faq-item__q">Q</span>
                        <span class="faq-item__text"><?php the_title(); ?></span>
                        <span class="faq-item__toggle">
                            <?php sato_icon('chevron-down', 20); ?>
                        </span>
                    </summary>
                    <div class="faq-item__answer">
                        <span class="faq-item__a">A</span>
                        <div class="faq-item__content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </details>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <div class="section__footer scroll-reveal">
                <a href="<?php echo esc_url(home_url('/faq/')); ?>" class="btn btn--outline btn--lg">
                    すべてのFAQを見る
                    <?php sato_icon('arrow-right', 18); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         AREA SECTION - 対応エリア
         ========================================================================= -->
    <section class="section area" aria-labelledby="area-heading">
        <div class="container">
            <header class="section__header section__header--center">
                <span class="section__label scroll-reveal">AREA</span>
                <h2 class="section__title scroll-reveal" id="area-heading">
                    <span class="marker marker--accent">対応エリア</span>
                </h2>
            </header>

            <div class="area__content">
                <div class="area__map scroll-reveal">
                    <?php
                    $google_map = get_theme_mod('sato_google_map', '');
                    if ($google_map) :
                    ?>
                    <iframe 
                        src="<?php echo esc_url($google_map); ?>" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="対応エリアマップ">
                    </iframe>
                    <?php else : ?>
                    <div class="area__map-placeholder">
                        <?php sato_icon('map-pin', 48); ?>
                        <p>静岡県東部エリアを中心に対応</p>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="area__info scroll-reveal" style="--delay: 0.1s">
                    <h3 class="area__info-title">
                        <?php sato_icon('map-pin', 24); ?>
                        主な対応エリア
                    </h3>
                    <ul class="area__list">
                        <?php foreach ($service_areas as $area) : ?>
                        <li class="area__item"><?php echo esc_html($area); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="area__note">
                        <?php echo esc_html(get_theme_mod('sato_area_note', 'その他、静岡県東部エリアもご対応可能です。まずはお気軽にお問い合わせください。')); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         CTA SECTION - お問い合わせ誘導
         ========================================================================= -->
    <section class="cta" aria-labelledby="cta-heading">
        <div class="cta__bg">
            <div class="cta__bg-gradient"></div>
            <div class="cta__bg-pattern" aria-hidden="true"></div>
        </div>

        <div class="container">
            <div class="cta__content scroll-reveal">
                <header class="cta__header">
                    <h2 class="cta__title" id="cta-heading">
                        外壁・屋根のお悩み、<br>
                        <span class="cta__title-highlight">無料で診断</span>いたします
                    </h2>
                    <p class="cta__lead">
                        「まずは価格だけ知りたい」という方も大歓迎。<br>
                        強引な営業は一切いたしませんので、安心してお問い合わせください。
                    </p>
                </header>

                <div class="cta__actions">
                    <!-- 電話 -->
                    <div class="cta__phone">
                        <span class="cta__phone-label">お電話でのご相談</span>
                        <a href="<?php echo esc_attr($phone_link); ?>" class="cta__phone-number">
                            <?php sato_icon('phone', 28); ?>
                            <span><?php echo esc_html($phone); ?></span>
                        </a>
                        <span class="cta__phone-hours">
                            受付 <?php echo esc_html($business_hours); ?>（<?php echo esc_html($holiday_text); ?>休）
                        </span>
                    </div>

                    <div class="cta__divider">
                        <span>または</span>
                    </div>

                    <!-- ボタン -->
                    <div class="cta__buttons">
                        <span class="cta__buttons-label">WEBで簡単 60秒入力</span>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--xl btn--block btn--glow">
                            <?php sato_icon('mail', 22); ?>
                            無料お見積り依頼
                            <?php sato_icon('arrow-right', 20); ?>
                        </a>
                        
                        <?php if ($line_url) : ?>
                        <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line btn--lg btn--block" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>
                            LINEで気軽に相談
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 安心ポイント -->
                <ul class="cta__assurance">
                    <li><?php sato_icon('check-circle', 18); ?> 見積り無料</li>
                    <li><?php sato_icon('check-circle', 18); ?> 相談無料</li>
                    <li><?php sato_icon('check-circle', 18); ?> 出張無料</li>
                    <li><?php sato_icon('check-circle', 18); ?> しつこい営業なし</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         NEWS SECTION - お知らせ
         ========================================================================= -->
    <?php
    $news_query = sato_get_news(['posts_per_page' => 3]);
    if ($news_query->have_posts()) :
    ?>
    <section class="section news" aria-labelledby="news-heading">
        <div class="container">
            <header class="section__header">
                <div class="section__header-left">
                    <span class="section__label scroll-reveal">NEWS</span>
                    <h2 class="section__title scroll-reveal" id="news-heading">お知らせ</h2>
                </div>
                <a href="<?php echo esc_url(home_url('/news/')); ?>" class="section__header-link scroll-reveal">
                    一覧を見る <?php sato_icon('arrow-right', 16); ?>
                </a>
            </header>

            <ul class="news__list">
                <?php
                while ($news_query->have_posts()) : $news_query->the_post();
                    $categories = get_the_terms(get_the_ID(), 'news_category');
                    $category_name = (!empty($categories) && !is_wp_error($categories)) ? $categories[0]->name : 'お知らせ';
                ?>
                <li class="news-item scroll-reveal">
                    <a href="<?php the_permalink(); ?>" class="news-item__link">
                        <time class="news-item__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <span class="news-item__category"><?php echo esc_html($category_name); ?></span>
                        <span class="news-item__title"><?php the_title(); ?></span>
                    </a>
                </li>
                <?php endwhile; wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>

</main>

<!-- =============================================================================
     STYLES
     ============================================================================= -->
<style>
/* =============================================================================
   CSS Variables
   ============================================================================= */
:root {
    /* Colors */
    --color-primary: #0d47a1;
    --color-primary-dark: #002171;
    --color-primary-light: #5472d3;
    --color-secondary: #ff6f00;
    --color-secondary-dark: #c43e00;
    --color-secondary-light: #ffa040;
    --color-accent: #f59e0b;
    --color-success: #22c55e;
    --color-warning: #eab308;
    --color-danger: #ef4444;
    --color-line: #06c755;
    
    --color-text: #1a1a1a;
    --color-text-light: #666666;
    --color-text-muted: #999999;
    --color-bg: #ffffff;
    --color-bg-light: #f8fafc;
    --color-bg-dark: #0f172a;
    --color-border: #e2e8f0;
    
    /* Typography */
    --font-base: 'Noto Sans JP', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    --font-heading: 'Noto Sans JP', sans-serif;
    --font-en: 'Inter', 'Roboto', sans-serif;
    
    /* Spacing */
    --section-padding: 100px;
    --section-padding-sp: 60px;
    --container-width: 1200px;
    --container-padding: 20px;
    
    /* Border Radius */
    --radius-sm: 4px;
    --radius-md: 8px;
    --radius-lg: 16px;
    --radius-xl: 24px;
    --radius-full: 9999px;
    
    /* Shadows */
    --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
    --shadow-2xl: 0 25px 50px -12px rgba(0,0,0,0.25);
    --shadow-glow: 0 0 40px rgba(13, 71, 161, 0.3);
    
    /* Transitions */
    --transition-fast: 0.15s ease;
    --transition-base: 0.3s ease;
    --transition-slow: 0.5s ease;
    --transition-bounce: 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* =============================================================================
   Base Styles
   ============================================================================= */
*, *::before, *::after {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: var(--font-base);
    color: var(--color-text);
    line-height: 1.8;
    background: var(--color-bg);
    overflow-x: hidden;
}

.front-page {
    overflow: hidden;
}

.container {
    max-width: var(--container-width);
    margin: 0 auto;
    padding: 0 var(--container-padding);
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}

a {
    text-decoration: none;
    color: inherit;
    transition: var(--transition-base);
}

/* Utility Classes */
.sp-only { display: none; }
.pc-only { display: inline; }

@media (max-width: 768px) {
    .sp-only { display: inline; }
    .pc-only { display: none; }
}

.text-gradient {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.text-danger {
    color: var(--color-danger);
    font-weight: 700;
}

.marker {
    position: relative;
    padding: 0 0.2em;
}

.marker::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 40%;
    z-index: -1;
    transition: var(--transition-base);
}

.marker--primary::after {
    background: rgba(13, 71, 161, 0.15);
}

.marker--accent::after {
    background: rgba(245, 158, 11, 0.3);
}

.marker--warning::after {
    background: rgba(239, 68, 68, 0.2);
}

.highlight {
    background: linear-gradient(transparent 60%, rgba(245, 158, 11, 0.3) 60%);
    padding: 0 0.1em;
}

/* =============================================================================
   Icon Styles
   ============================================================================= */
.icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* =============================================================================
   Button Styles
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
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: all var(--transition-base);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn:hover::before {
    left: 100%;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn:active {
    transform: translateY(0);
}

.btn--primary {
    background: var(--color-primary);
    color: #fff;
}

.btn--primary:hover {
    background: var(--color-primary-dark);
    box-shadow: var(--shadow-lg);
}

.btn--accent {
    background: var(--color-accent);
    color: #fff;
}

.btn--accent:hover {
    background: var(--color-secondary-dark);
    box-shadow: var(--shadow-lg);
}

.btn--outline {
    background: transparent;
    border-color: var(--color-primary);
    color: var(--color-primary);
}

.btn--outline:hover {
    background: var(--color-primary);
    color: #fff;
}

.btn--line {
    background: var(--color-line);
    color: #fff;
}

.btn--line:hover {
    background: #05b04a;
}

.btn--lg {
    padding: 1em 2.5em;
    font-size: 1.0625rem;
}

.btn--xl {
    padding: 1.125em 3em;
    font-size: 1.125rem;
}

.btn--block {
    width: 100%;
}

.btn--glow {
    box-shadow: 0 4px 20px rgba(13, 71, 161, 0.4);
}

.btn--glow:hover {
    box-shadow: 0 6px 30px rgba(13, 71, 161, 0.5);
}

.btn__icon {
    display: flex;
}

.btn__arrow {
    display: flex;
    transition: transform var(--transition-base);
}

.btn:hover .btn__arrow {
    transform: translateX(4px);
}

/* =============================================================================
   Section Styles
   ============================================================================= */
.section {
    padding: var(--section-padding) 0;
    position: relative;
}

@media (max-width: 768px) {
    .section {
        padding: var(--section-padding-sp) 0;
    }
}

.section__header {
    margin-bottom: 3rem;
}

.section__header--center {
    text-align: center;
}

.section__header--center .section__lead {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.section__label {
    display: inline-block;
    font-family: var(--font-en);
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    color: var(--color-primary);
    margin-bottom: 0.5rem;
}

.section__title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 900;
    line-height: 1.3;
    margin: 0 0 1rem;
}

.section__lead {
    font-size: 1rem;
    color: var(--color-text-light);
    margin: 0;
}

.section__footer {
    text-align: center;
    margin-top: 3rem;
}

.section__header-left {
    display: inline-block;
}

.section__header-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5em;
    font-weight: 600;
    color: var(--color-primary);
}

.section__header-link:hover {
    gap: 0.75em;
}

@media (min-width: 768px) {
    .section__header:not(.section__header--center) {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }
}

/* =============================================================================
   Animation Classes
   ============================================================================= */
.animate-fade-in {
    opacity: 0;
    animation: fadeIn 0.8s ease calc(var(--delay, 0s) + 0.3s) forwards;
}

.animate-slide-up {
    opacity: 0;
    transform: translateY(30px);
    animation: slideUp 0.8s ease calc(var(--delay, 0s) + 0.3s) forwards;
}

.scroll-reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s ease, transform 0.8s ease;
    transition-delay: var(--delay, 0s);
}

.scroll-reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}

@keyframes fadeIn {
    to { opacity: 1; }
}

@keyframes slideUp {
    to { opacity: 1; transform: translateY(0); }
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

@keyframes scrollLine {
    0% { transform: scaleY(0); transform-origin: top; }
    50% { transform: scaleY(1); transform-origin: top; }
    51% { transform: scaleY(1); transform-origin: bottom; }
    100% { transform: scaleY(0); transform-origin: bottom; }
}

/* =============================================================================
   HERO SECTION
   ============================================================================= */
.hero {
    position: relative;
    min-height: 100vh;
    min-height: 100svh;
    display: flex;
    align-items: center;
    background: var(--color-bg-light);
    overflow: hidden;
}

.hero__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.hero__bg-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    animation: bgZoom 30s ease infinite alternate;
}

@keyframes bgZoom {
    0% { transform: scale(1); }
    100% { transform: scale(1.1); }
}

.hero__bg-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.97) 0%,
        rgba(255,255,255,0.85) 40%,
        rgba(255,255,255,0.6) 70%,
        rgba(255,255,255,0.3) 100%
    );
}

.hero__paint-texture {
    position: absolute;
    inset: 0;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
}

.hero__particles {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.particle {
    position: absolute;
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.particle--1 {
    width: 20px;
    height: 20px;
    background: rgba(13, 71, 161, 0.15);
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.particle--2 {
    width: 15px;
    height: 15px;
    background: rgba(245, 158, 11, 0.2);
    top: 60%;
    left: 20%;
    animation-delay: 1s;
}

.particle--3 {
    width: 25px;
    height: 25px;
    background: rgba(13, 71, 161, 0.1);
    top: 30%;
    right: 15%;
    animation-delay: 2s;
}

.particle--4 {
    width: 12px;
    height: 12px;
    background: rgba(245, 158, 11, 0.15);
    top: 70%;
    right: 25%;
    animation-delay: 3s;
}

.particle--5 {
    width: 18px;
    height: 18px;
    background: rgba(13, 71, 161, 0.12);
    top: 45%;
    right: 10%;
    animation-delay: 4s;
}

.hero__container {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 60px;
    align-items: center;
    width: 100%;
    padding-top: 80px;
    padding-bottom: 80px;
}

.hero__content {
    max-width: 700px;
}

.hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: var(--color-primary);
    color: #fff;
    font-size: 0.875rem;
    font-weight: 700;
    border-radius: var(--radius-full);
    margin-bottom: 1.5rem;
}

.hero__badge-icon {
    display: flex;
}

.hero__title {
    margin: 0 0 1.5rem;
    line-height: 1.2;
}

.hero__title-line {
    display: block;
}

.hero__title-line--sub {
    font-size: clamp(1.5rem, 4vw, 2rem);
    font-weight: 700;
    color: var(--color-text);
}

.hero__title-line--main {
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 900;
    letter-spacing: -0.02em;
}

.hero__subtitle {
    font-size: clamp(1rem, 2vw, 1.25rem);
    color: var(--color-text);
    margin: 0 0 2rem;
    font-weight: 500;
}

.hero__cta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
}

.hero__phone {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem 1rem;
}

.hero__phone-label {
    font-size: 0.875rem;
    color: var(--color-text-light);
}

.hero__phone-number {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: var(--font-en);
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 900;
    color: var(--color-primary);
    letter-spacing: 0.02em;
}

.hero__phone-number:hover {
    color: var(--color-primary-dark);
}

.hero__phone-hours {
    font-size: 0.8125rem;
    color: var(--color-text-muted);
}

.hero__stats {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.hero__stat-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.25rem 1.5rem;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    text-align: center;
    min-width: 130px;
}

.hero__stat-icon {
    color: var(--color-primary);
    margin-bottom: 0.5rem;
}

.hero__stat-number {
    font-family: var(--font-en);
    font-size: 2rem;
    font-weight: 900;
    color: var(--color-primary);
    line-height: 1;
}

.hero__stat-number small {
    font-size: 0.5em;
}

.hero__stat-label {
    font-size: 0.75rem;
    color: var(--color-text-light);
    margin-top: 0.25rem;
}

.hero__scroll {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    z-index: 2;
}

.hero__scroll-text {
    font-family: var(--font-en);
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--color-text-muted);
}

.hero__scroll-line {
    width: 1px;
    height: 40px;
    background: var(--color-primary);
    animation: scrollLine 2s ease-in-out infinite;
}

.hero__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    z-index: 2;
    line-height: 0;
}

.hero__wave svg {
    width: 100%;
    height: 80px;
}

@media (max-width: 1024px) {
    .hero__container {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .hero__stats {
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .hero__stat-card {
        min-width: 100px;
        padding: 1rem;
    }
}

@media (max-width: 768px) {
    .hero {
        min-height: auto;
        padding: 120px 0 100px;
    }
    
    .hero__bg-overlay {
        background: linear-gradient(
            180deg,
            rgba(255,255,255,0.95) 0%,
            rgba(255,255,255,0.9) 100%
        );
    }
    
    .hero__cta {
        flex-direction: column;
    }
    
    .hero__cta .btn {
        width: 100%;
    }
    
    .hero__scroll {
        display: none;
    }
    
    .hero__wave svg {
        height: 50px;
    }
}

/* =============================================================================
   TRUST BADGES
   ============================================================================= */
.trust-badges {
    padding: 40px 0;
    background: var(--color-bg);
    border-bottom: 1px solid var(--color-border);
}

.trust-badges__list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.trust-badges__item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.trust-badges__icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-radius: 50%;
    color: var(--color-primary);
}

.trust-badges__content {
    flex: 1;
    min-width: 0;
}

.trust-badges__title {
    display: block;
    font-size: 1rem;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 0.125rem;
}

.trust-badges__desc {
    font-size: 0.8125rem;
    color: var(--color-text-light);
}

@media (max-width: 1024px) {
    .trust-badges__list {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .trust-badges__list {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .trust-badges__icon {
        width: 56px;
        height: 56px;
    }
}

/* =============================================================================
   PROBLEM SECTION
   ============================================================================= */
.problem {
    background: var(--color-bg);
}

.problem__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.problem__list {
    order: 2;
}

.problem__visual {
    order: 1;
    position: relative;
}

.check-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.check-list__item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--color-border);
}

.check-list__item:last-child {
    border-bottom: none;
}

.check-list__icon {
    flex-shrink: 0;
    font-size: 1.5rem;
    line-height: 1;
}

.check-list__content strong {
    display: block;
    font-size: 1rem;
    margin-bottom: 0.25rem;
}

.check-list--warning .check-list__content strong {
    color: var(--color-danger);
}

.check-list__content p {
    margin: 0;
    font-size: 0.875rem;
    color: var(--color-text-light);
}

.problem__cta {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #fef2f2;
    border-radius: var(--radius-lg);
    border-left: 4px solid var(--color-danger);
}

.problem__cta-text {
    margin: 0 0 1rem;
    font-size: 0.9375rem;
    line-height: 1.7;
}

.problem__image-wrapper {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-2xl);
}

.problem__image {
    width: 100%;
    height: auto;
}

.problem__image-badge {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: rgba(239, 68, 68, 0.9);
    color: #fff;
    font-size: 0.875rem;
    font-weight: 700;
    border-radius: var(--radius-full);
}

.problem__deco {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    z-index: -1;
}

.problem__deco--1 {
    width: 200px;
    height: 200px;
    background: rgba(239, 68, 68, 0.15);
    top: -50px;
    left: -50px;
}

.problem__deco--2 {
    width: 150px;
    height: 150px;
    background: rgba(13, 71, 161, 0.1);
    bottom: -30px;
    right: -30px;
}

@media (max-width: 1024px) {
    .problem__grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .problem__visual {
        order: 1;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .problem__list {
        order: 2;
    }
}

/* =============================================================================
   SOLUTION SECTION
   ============================================================================= */
.solution {
    background: var(--color-bg-light);
    position: relative;
    overflow: hidden;
}

.solution__bg {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.solution__bg-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.03;
    background-image: radial-gradient(var(--color-primary) 1px, transparent 1px);
    background-size: 30px 30px;
}

.solution__cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.solution-card {
    position: relative;
    padding: 2.5rem 2rem;
    background: var(--color-bg);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-lg);
    text-align: center;
    transition: var(--transition-base);
}

.solution-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
}

.solution-card__number {
    position: absolute;
    top: -15px;
    right: 20px;
    font-family: var(--font-en);
    font-size: 3rem;
    font-weight: 900;
    color: var(--color-primary);
    opacity: 0.1;
    line-height: 1;
}

.solution-card__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-radius: 50%;
    color: var(--color-primary);
}

.solution-card__title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 1rem;
    color: var(--color-text);
}

.solution-card__text {
    font-size: 0.9375rem;
    color: var(--color-text-light);
    margin: 0;
    line-height: 1.8;
}

@media (max-width: 1024px) {
    .solution__cards {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
    }
}

/* =============================================================================
   REASON SECTION
   ============================================================================= */
.reason {
    background: var(--color-bg);
}

.reason__list {
    display: flex;
    flex-direction: column;
    gap: 60px;
}

.reason-card {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

.reason-card--reverse {
    direction: rtl;
}

.reason-card--reverse > * {
    direction: ltr;
}

.reason-card__image {
    position: relative;
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.reason-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.reason-card:hover .reason-card__image img {
    transform: scale(1.05);
}

.reason-card__number {
    position: absolute;
    top: -10px;
    left: -10px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: var(--color-primary);
    color: #fff;
    font-family: var(--font-en);
    font-size: 1.5rem;
    font-weight: 900;
    border-radius: 50%;
    box-shadow: var(--shadow-lg);
    z-index: 1;
}

.reason-card__body {
    padding: 1rem 0;
}

.reason-card__title {
    font-size: clamp(1.25rem, 2.5vw, 1.75rem);
    font-weight: 700;
    line-height: 1.4;
    margin: 0 0 1rem;
    color: var(--color-text);
}

.reason-card__text {
    font-size: 1rem;
    color: var(--color-text-light);
    margin: 0 0 1.5rem;
    line-height: 1.8;
}

.reason-card__points {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.reason-card__points li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    color: var(--color-text);
}

.reason-card__points .icon {
    color: var(--color-success);
}

@media (max-width: 1024px) {
    .reason-card,
    .reason-card--reverse {
        grid-template-columns: 1fr;
        gap: 30px;
        direction: ltr;
    }
}

/* =============================================================================
   WORKS SECTION - Before/After Slider
   ============================================================================= */
.works {
    background: var(--color-bg-light);
    position: relative;
}

.works__bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(13, 71, 161, 0.02) 100%);
}

.works__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.works-card {
    background: var(--color-bg);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: var(--transition-base);
}

.works-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-2xl);
}

/* Before/After Slider */
.ba-slider {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    user-select: none;
    touch-action: pan-y;
}

.ba-slider__after,
.ba-slider__before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.ba-slider__before {
    clip-path: inset(0 50% 0 0);
    z-index: 2;
}

.ba-slider__after img,
.ba-slider__before img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ba-slider__label {
    position: absolute;
    top: 12px;
    padding: 4px 12px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #fff;
    border-radius: var(--radius-sm);
    z-index: 3;
}

.ba-slider__label--before {
    left: 12px;
    background: rgba(0, 0, 0, 0.7);
}

.ba-slider__label--after {
    right: 12px;
    background: var(--color-primary);
}

.ba-slider__range {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    opacity: 0;
    cursor: ew-resize;
    z-index: 10;
}

.ba-slider__handle {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 4px;
    background: #fff;
    transform: translateX(-50%);
    z-index: 5;
    pointer-events: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

.ba-slider__handle::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 48px;
    height: 48px;
    background: #fff;
    border-radius: 50%;
    box-shadow: var(--shadow-lg);
}

.ba-slider__handle-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    gap: 0;
    color: var(--color-primary);
    z-index: 1;
}

.works-card__body {
    padding: 1.25rem;
}

.works-card__tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.tag {
    display: inline-block;
    padding: 0.25em 0.75em;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: var(--radius-full);
}

.tag--category {
    background: #dbeafe;
    color: var(--color-primary);
}

.tag--area {
    background: #fef3c7;
    color: #92400e;
}

.works-card__title {
    font-size: 1.0625rem;
    font-weight: 700;
    margin: 0 0 0.75rem;
    line-height: 1.4;
}

.works-card__title a {
    color: var(--color-text);
}

.works-card__title a:hover {
    color: var(--color-primary);
}

.works-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin: 0 0 0.75rem;
}

.works-card__meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.8125rem;
    color: var(--color-text-light);
}

.works-card__meta-item dt {
    display: flex;
    color: var(--color-text-muted);
}

.works-card__link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-primary);
}

.works-card__link:hover {
    gap: 0.75rem;
}

.works__empty {
    grid-column: 1 / -1;
    text-align: center;
    color: var(--color-text-muted);
    padding: 3rem;
}

@media (max-width: 1024px) {
    .works__grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .works__grid {
        grid-template-columns: 1fr;
    }
}

/* =============================================================================
   PRICE SECTION
   ============================================================================= */
.price {
    background: var(--color-bg);
}

.price__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    align-items: stretch;
}

.price-card {
    position: relative;
    display: flex;
    flex-direction: column;
    background: var(--color-bg);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: var(--transition-base);
}

.price-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.price-card--featured {
    border: 2px solid var(--color-accent);
    transform: scale(1.05);
    box-shadow: 0 10px 40px rgba(245, 158, 11, 0.2);
    z-index: 1;
}

.price-card--featured:hover {
    transform: scale(1.05) translateY(-4px);
}

.price-card__ribbon {
    position: absolute;
    top: 16px;
    right: -32px;
    width: 120px;
    padding: 6px 0;
    background: var(--color-danger);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 700;
    text-align: center;
    transform: rotate(45deg);
    z-index: 2;
}

.price-card__header {
    padding: 1.25rem;
    background: var(--color-bg-light);
    text-align: center;
    border-bottom: 1px solid var(--color-border);
}

.price-card--featured .price-card__header {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
}

.price-card__name {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    color: var(--color-text);
}

.price-card__grade {
    display: block;
    font-size: 0.8125rem;
    color: var(--color-text-light);
    margin-top: 0.25rem;
}

.price-card__image {
    height: 160px;
    overflow: hidden;
}

.price-card__image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.price-card:hover .price-card__image img {
    transform: scale(1.1);
}

.price-card__price {
    padding: 1.5rem;
    text-align: center;
    background: #fffbf5;
}

.price-card--featured .price-card__price {
    background: linear-gradient(135deg, #fffbeb 0%, #fff7e6 100%);
}

.price-card__condition {
    font-size: 0.75rem;
    color: var(--color-text-light);
}

.price-card__amount {
    font-family: var(--font-en);
    font-weight: 900;
    color: var(--color-primary);
    line-height: 1;
    margin: 0.5rem 0;
}

.price-card--featured .price-card__amount {
    color: var(--color-accent);
}

.price-card__currency {
    font-size: 1.25rem;
    vertical-align: top;
}

.price-card__number {
    font-size: 2.5rem;
}

.price-card__unit {
    font-size: 1rem;
}

.price-card__tax {
    font-size: 0.75rem;
    color: var(--color-text-muted);
}

.price-card__features {
    list-style: none;
    margin: 0;
    padding: 1.25rem;
    flex: 1;
}

.price-card__features li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
    font-size: 0.9375rem;
    border-bottom: 1px dashed var(--color-border);
}

.price-card__features li:last-child {
    border-bottom: none;
}

.price-card__features .icon {
    color: var(--color-success);
    flex-shrink: 0;
}

.price-card .btn {
    margin: 0 1.25rem 1.25rem;
}

.price__note {
    text-align: center;
    font-size: 0.8125rem;
    color: var(--color-text-muted);
    margin-top: 2rem;
}

@media (max-width: 1024px) {
    .price__grid {
        grid-template-columns: 1fr;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .price-card--featured {
        transform: none;
        order: -1;
    }
    
    .price-card--featured:hover {
        transform: translateY(-4px);
    }
}

/* =============================================================================
   VOICE SECTION
   ============================================================================= */
.voice {
    background: var(--color-bg-light);
    position: relative;
    overflow: hidden;
}

.voice__bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 60%;
    background: linear-gradient(180deg, var(--color-bg) 0%, transparent 100%);
}

.voice__slider {
    position: relative;
    overflow: hidden;
    margin: 0 -20px;
    padding: 0 20px;
}

.voice__track {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 20px;
    margin-bottom: -20px;
    scrollbar-width: none;
}

.voice__track::-webkit-scrollbar {
    display: none;
}

.voice-card {
    flex: 0 0 350px;
    scroll-snap-align: start;
    background: var(--color-bg);
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
}

.voice-card__rating {
    display: flex;
    gap: 2px;
    margin-bottom: 1rem;
}

.star {
    font-size: 1.25rem;
    line-height: 1;
}

.star--filled {
    color: #fbbf24;
}

.star--empty {
    color: #e5e7eb;
}

.voice-card__content {
    font-size: 0.9375rem;
    line-height: 1.8;
    color: var(--color-text);
    margin: 0 0 1.5rem;
}

.voice-card__content p {
    margin: 0;
}

.voice-card__footer {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--color-border);
}

.voice-card__avatar {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--color-bg-light);
}

.voice-card__avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.voice-card__avatar-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--color-primary);
    background: #dbeafe;
}

.voice-card__info {
    flex: 1;
    min-width: 0;
}

.voice-card__name {
    display: block;
    font-size: 0.9375rem;
    font-weight: 700;
    font-style: normal;
    color: var(--color-text);
}

.voice-card__age {
    font-size: 0.8125rem;
    font-weight: 400;
    color: var(--color-text-muted);
    margin-left: 0.5rem;
}

.voice-card__service {
    display: block;
    font-size: 0.8125rem;
    color: var(--color-text-light);
}

.voice__nav {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.voice__nav-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background: var(--color-bg);
    border: 1px solid var(--color-border);
    border-radius: 50%;
    color: var(--color-text);
    cursor: pointer;
    transition: var(--transition-base);
}

.voice__nav-btn:hover {
    background: var(--color-primary);
    border-color: var(--color-primary);
    color: #fff;
}

.voice__empty {
    text-align: center;
    color: var(--color-text-muted);
    padding: 3rem;
}

@media (max-width: 640px) {
    .voice-card {
        flex: 0 0 calc(100vw - 80px);
    }
}

/* =============================================================================
   FLOW SECTION
   ============================================================================= */
.flow {
    background: var(--color-bg);
}

.flow__steps {
    list-style: none;
    margin: 0;
    padding: 0;
    counter-reset: flow-counter;
}

.flow-step {
    display: grid;
    grid-template-columns: 80px 1fr 80px;
    gap: 30px;
    align-items: center;
    padding: 2rem 0;
    border-bottom: 1px dashed var(--color-border);
    position: relative;
}

.flow-step:last-child {
    border-bottom: none;
}

.flow-step::before {
    content: '';
    position: absolute;
    left: 40px;
    top: 100%;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, var(--color-primary) 0%, transparent 100%);
    transform: translateX(-50%);
}

.flow-step:last-child::before {
    display: none;
}

.flow-step__number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: var(--color-primary);
    border-radius: 50%;
    position: relative;
    z-index: 1;
}

.flow-step__number span {
    font-family: var(--font-en);
    font-size: 1.5rem;
    font-weight: 900;
    color: #fff;
}

.flow-step__content {
    flex: 1;
}

.flow-step__title {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 0.5rem;
    color: var(--color-text);
}

.flow-step__text {
    font-size: 0.9375rem;
    color: var(--color-text-light);
    margin: 0;
    line-height: 1.7;
}

.flow-step__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: var(--color-bg-light);
    border-radius: var(--radius-lg);
    color: var(--color-primary);
}

@media (max-width: 768px) {
    .flow-step {
        grid-template-columns: 60px 1fr;
        gap: 20px;
    }
    
    .flow-step__number {
        width: 60px;
        height: 60px;
    }
    
    .flow-step__number span {
        font-size: 1.25rem;
    }
    
    .flow-step__icon {
        display: none;
    }
    
    .flow-step::before {
        left: 30px;
    }
}

/* =============================================================================
   FAQ SECTION
   ============================================================================= */
.faq {
    background: var(--color-bg-light);
    position: relative;
}

.faq__bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(13, 71, 161, 0.02) 0%, transparent 100%);
}

.faq__list {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background: var(--color-bg);
    border-radius: var(--radius-lg);
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

/* =============================================================================
   FAQ SECTION (続き)
   ============================================================================= */
.faq-item__question {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    cursor: pointer;
    list-style: none;
    font-weight: 600;
    transition: var(--transition-base);
}

.faq-item__question::-webkit-details-marker {
    display: none;
}

.faq-item__question:hover {
    background: var(--color-bg-light);
}

.faq-item__q {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: var(--color-primary);
    color: #fff;
    font-family: var(--font-en);
    font-size: 1rem;
    font-weight: 700;
    border-radius: 50%;
}

.faq-item__text {
    flex: 1;
    font-size: 1rem;
    color: var(--color-text);
}

.faq-item__toggle {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: var(--color-text-muted);
    transition: transform var(--transition-base);
}

.faq-item[open] .faq-item__toggle {
    transform: rotate(180deg);
}

.faq-item__answer {
    display: flex;
    gap: 1rem;
    padding: 0 1.5rem 1.5rem;
    animation: fadeSlideDown 0.3s ease;
}

@keyframes fadeSlideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.faq-item__a {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: var(--color-accent);
    color: #fff;
    font-family: var(--font-en);
    font-size: 1rem;
    font-weight: 700;
    border-radius: 50%;
}

.faq-item__content {
    flex: 1;
    font-size: 0.9375rem;
    color: var(--color-text-light);
    line-height: 1.8;
}

.faq-item__content p {
    margin: 0;
}

.faq-item__content p + p {
    margin-top: 1em;
}

/* =============================================================================
   AREA SECTION
   ============================================================================= */
.area {
    background: var(--color-bg);
}

.area__content {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 40px;
    align-items: start;
}

.area__map {
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
}

.area__map iframe {
    display: block;
}

.area__map-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 400px;
    background: var(--color-bg-light);
    color: var(--color-text-light);
    text-align: center;
    gap: 1rem;
}

.area__info {
    padding: 2rem;
    background: var(--color-bg-light);
    border-radius: var(--radius-xl);
}

.area__info-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 1.5rem;
    color: var(--color-primary);
}

.area__list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem 1rem;
    list-style: none;
    margin: 0 0 1.5rem;
    padding: 0;
}

.area__item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
    font-size: 0.9375rem;
    border-bottom: 1px dashed var(--color-border);
}

.area__item::before {
    content: '📍';
    font-size: 0.875rem;
}

.area__note {
    font-size: 0.875rem;
    color: var(--color-text-light);
    margin: 0;
    padding: 1rem;
    background: var(--color-bg);
    border-radius: var(--radius-md);
    border-left: 3px solid var(--color-primary);
}

@media (max-width: 1024px) {
    .area__content {
        grid-template-columns: 1fr;
    }
    
    .area__map iframe,
    .area__map-placeholder {
        height: 300px;
    }
}

@media (max-width: 640px) {
    .area__list {
        grid-template-columns: 1fr;
    }
}

/* =============================================================================
   CTA SECTION
   ============================================================================= */
.cta {
    position: relative;
    padding: 100px 0;
    color: #fff;
    overflow: hidden;
}

.cta__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.cta__bg-gradient {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
}

.cta__bg-pattern {
    position: absolute;
    inset: 0;
    opacity: 0.1;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.cta__content {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

.cta__header {
    margin-bottom: 3rem;
}

.cta__title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 900;
    line-height: 1.3;
    margin: 0 0 1rem;
}

.cta__title-highlight {
    position: relative;
    display: inline-block;
}

.cta__title-highlight::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 8px;
    background: var(--color-accent);
    opacity: 0.8;
    z-index: -1;
}

.cta__lead {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
    line-height: 1.8;
}

.cta__actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    margin-bottom: 2rem;
}

.cta__phone {
    text-align: center;
}

.cta__phone-label {
    display: block;
    font-size: 0.875rem;
    opacity: 0.8;
    margin-bottom: 0.5rem;
}

.cta__phone-number {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-family: var(--font-en);
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 900;
    color: #fff;
    letter-spacing: 0.02em;
    transition: var(--transition-base);
}

.cta__phone-number:hover {
    transform: scale(1.05);
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

.cta__phone-hours {
    display: block;
    font-size: 0.8125rem;
    opacity: 0.7;
    margin-top: 0.5rem;
}

.cta__divider {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    font-size: 0.8125rem;
    opacity: 0.8;
}

.cta__buttons {
    min-width: 300px;
}

.cta__buttons-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--color-accent);
    margin-bottom: 0.75rem;
}

.cta__buttons .btn {
    margin-bottom: 0.75rem;
}

.cta__buttons .btn:last-child {
    margin-bottom: 0;
}

.cta__assurance {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1rem 2rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.cta__assurance li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
}

.cta__assurance .icon {
    color: var(--color-success);
}

@media (max-width: 768px) {
    .cta {
        padding: 60px 0;
    }
    
    .cta__actions {
        flex-direction: column;
        padding: 1.5rem;
        gap: 1.5rem;
    }
    
    .cta__divider {
        width: 100%;
        height: auto;
        padding: 0.5rem;
        border-radius: var(--radius-full);
    }
    
    .cta__buttons {
        width: 100%;
        min-width: auto;
    }
}

/* =============================================================================
   NEWS SECTION
   ============================================================================= */
.news {
    background: var(--color-bg);
    padding: 60px 0;
}

.news__list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.news-item {
    border-bottom: 1px solid var(--color-border);
}

.news-item:last-child {
    border-bottom: none;
}

.news-item__link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 0;
    transition: var(--transition-base);
}

.news-item__link:hover {
    padding-left: 1rem;
    background: var(--color-bg-light);
    margin: 0 -1rem;
    padding-right: 1rem;
    border-radius: var(--radius-md);
}

.news-item__date {
    flex-shrink: 0;
    font-family: var(--font-en);
    font-size: 0.875rem;
    color: var(--color-text-muted);
}

.news-item__category {
    flex-shrink: 0;
    display: inline-block;
    padding: 0.25em 0.75em;
    font-size: 0.75rem;
    font-weight: 600;
    background: var(--color-primary);
    color: #fff;
    border-radius: var(--radius-sm);
}

.news-item__title {
    flex: 1;
    font-size: 0.9375rem;
    color: var(--color-text);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.news-item__link:hover .news-item__title {
    color: var(--color-primary);
}

@media (max-width: 640px) {
    .news-item__link {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .news-item__title {
        flex-basis: 100%;
        white-space: normal;
    }
}

/* =============================================================================
   RESPONSIVE ADJUSTMENTS
   ============================================================================= */
@media (max-width: 1280px) {
    :root {
        --container-width: 1024px;
    }
}

@media (max-width: 1024px) {
    :root {
        --section-padding: 80px;
    }
}

@media (max-width: 768px) {
    :root {
        --section-padding: 60px;
        --container-padding: 16px;
    }
    
    .section__title {
        font-size: 1.75rem;
    }
    
    .section__header {
        margin-bottom: 2rem;
    }
    
    .section__footer {
        margin-top: 2rem;
    }
}

@media (max-width: 480px) {
    .btn--xl {
        padding: 1em 2em;
        font-size: 1rem;
    }
    
    .btn--lg {
        padding: 0.875em 1.5em;
        font-size: 0.9375rem;
    }
}

/* =============================================================================
   PRINT STYLES
   ============================================================================= */
@media print {
    .hero,
    .cta,
    .voice__nav,
    .hero__scroll {
        display: none;
    }
    
    .section {
        padding: 40px 0;
        page-break-inside: avoid;
    }
    
    .btn {
        border: 1px solid #000;
        background: transparent !important;
        color: #000 !important;
    }
}

/* =============================================================================
   ACCESSIBILITY IMPROVEMENTS
   ============================================================================= */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    .hero__bg-image {
        animation: none;
    }
    
    .scroll-reveal {
        opacity: 1;
        transform: none;
    }
}

:focus-visible {
    outline: 3px solid var(--color-primary);
    outline-offset: 2px;
}

.btn:focus-visible {
    outline: 3px solid var(--color-accent);
    outline-offset: 2px;
}

/* Skip Link */
.skip-link {
    position: absolute;
    top: -100%;
    left: 50%;
    transform: translateX(-50%);
    padding: 1rem 2rem;
    background: var(--color-primary);
    color: #fff;
    font-weight: 700;
    border-radius: var(--radius-md);
    z-index: 9999;
    transition: top 0.3s ease;
}

.skip-link:focus {
    top: 10px;
}
</style>

<!-- =============================================================================
     JAVASCRIPT
     ============================================================================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // =========================================================================
    // 1. Scroll Reveal Animation
    // =========================================================================
    const scrollRevealElements = document.querySelectorAll('.scroll-reveal');
    
    const scrollRevealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                scrollRevealObserver.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.1
    });
    
    scrollRevealElements.forEach(el => scrollRevealObserver.observe(el));

    // =========================================================================
    // 2. Counter Animation
    // =========================================================================
    const counters = document.querySelectorAll('[data-count]');
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.count, 10);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                
                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        el.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        el.textContent = target;
                    }
                };
                
                updateCounter();
                counterObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(el => counterObserver.observe(el));

    // =========================================================================
    // 3. Before/After Slider
    // =========================================================================
    const baSliders = document.querySelectorAll('.ba-slider');
    
    baSliders.forEach(slider => {
        const rangeInput = slider.querySelector('.ba-slider__range');
        const beforeLayer = slider.querySelector('.ba-slider__before');
        const handle = slider.querySelector('.ba-slider__handle');
        
        if (!rangeInput || !beforeLayer || !handle) return;
        
        const updateSlider = (value) => {
            beforeLayer.style.clipPath = `inset(0 ${100 - value}% 0 0)`;
            handle.style.left = `${value}%`;
        };
        
        // Initialize
        updateSlider(50);
        
        // Range input event
        rangeInput.addEventListener('input', (e) => {
            updateSlider(e.target.value);
        });
        
        // Touch/Mouse drag support
        let isDragging = false;
        
        const startDrag = (e) => {
            isDragging = true;
            updatePosition(e);
        };
        
        const endDrag = () => {
            isDragging = false;
        };
        
        const updatePosition = (e) => {
            if (!isDragging && e.type !== 'click') return;
            
            const rect = slider.getBoundingClientRect();
            let clientX;
            
            if (e.touches && e.touches[0]) {
                clientX = e.touches[0].clientX;
            } else {
                clientX = e.clientX;
            }
            
            let position = ((clientX - rect.left) / rect.width) * 100;
            position = Math.max(0, Math.min(100, position));
            
            rangeInput.value = position;
            updateSlider(position);
        };
        
        slider.addEventListener('mousedown', startDrag);
        slider.addEventListener('mousemove', updatePosition);
        slider.addEventListener('mouseup', endDrag);
        slider.addEventListener('mouseleave', endDrag);
        
        slider.addEventListener('touchstart', startDrag, { passive: true });
        slider.addEventListener('touchmove', updatePosition, { passive: true });
        slider.addEventListener('touchend', endDrag);
    });

    // =========================================================================
    // 4. Voice Slider Navigation
    // =========================================================================
    const voiceSlider = document.querySelector('.voice__slider');
    
    if (voiceSlider) {
        const track = voiceSlider.querySelector('.voice__track');
        const prevBtn = voiceSlider.querySelector('.voice__nav-btn--prev');
        const nextBtn = voiceSlider.querySelector('.voice__nav-btn--next');
        
        if (track && prevBtn && nextBtn) {
            const cards = track.querySelectorAll('.voice-card');
            const cardWidth = cards[0]?.offsetWidth + 24 || 374; // card width + gap
            
            prevBtn.addEventListener('click', () => {
                track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            });
            
            nextBtn.addEventListener('click', () => {
                track.scrollBy({ left: cardWidth, behavior: 'smooth' });
            });
        }
    }

    // =========================================================================
    // 5. Smooth Scroll for Anchor Links
    // =========================================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerOffset = 80;
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
    // 6. FAQ Accordion - Ensure Only One Open
    // =========================================================================
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        item.addEventListener('toggle', function() {
            if (this.open) {
                faqItems.forEach(otherItem => {
                    if (otherItem !== this && otherItem.open) {
                        otherItem.open = false;
                    }
                });
            }
        });
    });

    // =========================================================================
    // 7. Lazy Load Images Enhancement
    // =========================================================================
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    } else {
        // Fallback for browsers that don't support native lazy loading
        const lazyImages = document.querySelectorAll('img[loading="lazy"]');
        
        const lazyImageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                    lazyImageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => lazyImageObserver.observe(img));
    }

    // =========================================================================
    // 8. Scroll-based Header Animation (if header exists)
    // =========================================================================
    const header = document.querySelector('.site-header');
    
    if (header) {
        let lastScroll = 0;
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
            
            if (currentScroll > lastScroll && currentScroll > 500) {
                header.classList.add('is-hidden');
            } else {
                header.classList.remove('is-hidden');
            }
            
            lastScroll = currentScroll;
        }, { passive: true });
    }

    // =========================================================================
    // 9. Performance: Debounce resize events
    // =========================================================================
    let resizeTimeout;
    
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Recalculate values that depend on viewport size
            const voiceTrack = document.querySelector('.voice__track');
            if (voiceTrack) {
                const cards = voiceTrack.querySelectorAll('.voice-card');
                // Update card calculations if needed
            }
        }, 250);
    }, { passive: true });

    // =========================================================================
    // 10. Accessibility: Respect reduced motion preference
    // =========================================================================
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    
    if (prefersReducedMotion.matches) {
        document.documentElement.style.scrollBehavior = 'auto';
        
        // Disable all scroll reveal animations
        scrollRevealElements.forEach(el => {
            el.classList.add('is-visible');
        });
    }

    // =========================================================================
    // 11. Console greeting (Development)
    // =========================================================================
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        console.log('%c🎨 サトー建装 フロントページ', 'font-size: 20px; font-weight: bold; color: #0d47a1;');
        console.log('%cPremium Paint Company Template v2.0', 'font-size: 12px; color: #666;');
    }
});
</script>

<?php get_footer(); ?>
