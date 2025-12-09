<?php
/**
 * Template Name: サービス一覧ページ
 * Template Post Type: page
 * Description: 全サービス（外壁・屋根・防水・補修）への導線となるインデックスページ
 * Author: Senior WordPress Engineer
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// 設定・データ取得
// =============================================================================
$company_name = sato_get_company_name();
$phone        = sato_get_phone();
$phone_link   = sato_get_phone_link();
$line_url     = sato_get_line_url();

// 構造化データ（ItemList）
$schema_list = [
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'url' => home_url('/service/exterior/'),
            'name' => '外壁塗装'
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'url' => home_url('/service/roof/'),
            'name' => '屋根塗装'
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'url' => home_url('/service/waterproof/'),
            'name' => '防水工事'
        ],
        [
            '@type' => 'ListItem',
            'position' => 4,
            'url' => home_url('/service/repair/'),
            'name' => '補修・修繕'
        ]
    ]
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_list, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="service-archive" role="main">

    <section class="archive-hero">
        <div class="archive-hero__bg">
            <div class="archive-hero__image" style="background-image: url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="archive-hero__overlay"></div>
        </div>
        
        <div class="service-container">
            <div class="archive-hero__content">
                <span class="archive-hero__tag">OUR SERVICES</span>
                <h1 class="archive-hero__title">
                    <span class="d-block">建物の価値を守る、</span>
                    <span class="d-block text-gradient">プロの技術。</span>
                </h1>
                <p class="archive-hero__lead">
                    塗装から防水、細かな補修まで。<br>
                    住まいのメンテナンスに関するあらゆるお悩みに、<br class="pc-only">
                    一級技能士が最適なソリューションをご提供します。
                </p>
            </div>
        </div>

        <div class="archive-hero__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <div class="service-container">
        <nav class="breadcrumb" aria-label="パンくずリスト">
            <ol class="breadcrumb__list">
                <li class="breadcrumb__item">
                    <a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a>
                </li>
                <li class="breadcrumb__separator">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                </li>
                <li class="breadcrumb__item">
                    <span class="breadcrumb__current">サービス一覧</span>
                </li>
            </ol>
        </nav>
    </div>

    <section class="section service-list">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">SERVICE LINEUP</span>
                <h2 class="section-head__title">事業<span class="marker-blue">内容</span></h2>
                <p class="section-head__desc">
                    お客様の大切な資産である建物を守るため、<br>
                    4つの専門分野でトータルサポートいたします。
                </p>
            </div>

            <div class="service-grid">
                <article class="service-card" data-aos="fade-up">
                    <a href="<?php echo home_url('/service/exterior/'); ?>" class="service-card__link">
                        <div class="service-card__image-box">
                            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&q=80&w=800" alt="外壁塗装" class="service-card__image">
                            <div class="service-card__overlay">
                                <span class="service-card__more">詳細を見る</span>
                            </div>
                            <span class="service-card__num">01</span>
                        </div>
                        <div class="service-card__body">
                            <div class="service-card__header">
                                <span class="service-card__en">Exterior Painting</span>
                                <h3 class="service-card__title">外壁塗装</h3>
                            </div>
                            <p class="service-card__desc">
                                建物の美観を蘇らせるだけでなく、紫外線や雨風から守る「保護」としての塗装を提供します。ラジカル・フッ素・無機など、ご要望に合わせた最適な塗料をご提案。
                            </p>
                            <ul class="service-card__tags">
                                <li>ひび割れ対策</li>
                                <li>チョーキング</li>
                                <li>美観再生</li>
                            </ul>
                            <div class="service-card__arrow">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                </article>

                <article class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?php echo home_url('/service/roof/'); ?>" class="service-card__link">
                        <div class="service-card__image-box">
                            <img src="https://images.unsplash.com/photo-1632759145351-1d592919f522?auto=format&fit=crop&q=80&w=800" alt="屋根塗装" class="service-card__image">
                            <div class="service-card__overlay">
                                <span class="service-card__more">詳細を見る</span>
                            </div>
                            <span class="service-card__num">02</span>
                        </div>
                        <div class="service-card__body">
                            <div class="service-card__header">
                                <span class="service-card__en">Roof Painting</span>
                                <h3 class="service-card__title">屋根塗装</h3>
                            </div>
                            <p class="service-card__desc">
                                最も過酷な環境にある屋根を、遮熱・断熱塗料で守ります。夏の暑さ対策や、屋根材の劣化防止に。普段見えない場所だからこそ、プロの診断が必要です。
                            </p>
                            <ul class="service-card__tags">
                                <li>遮熱・断熱</li>
                                <li>スレート・瓦</li>
                                <li>サビ止め</li>
                            </ul>
                            <div class="service-card__arrow">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                </article>

                <article class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <a href="<?php echo home_url('/service/waterproof/'); ?>" class="service-card__link">
                        <div class="service-card__image-box">
                            <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=800" alt="防水工事" class="service-card__image">
                            <div class="service-card__overlay">
                                <span class="service-card__more">詳細を見る</span>
                            </div>
                            <span class="service-card__num">03</span>
                        </div>
                        <div class="service-card__body">
                            <div class="service-card__header">
                                <span class="service-card__en">Waterproofing</span>
                                <h3 class="service-card__title">防水工事</h3>
                            </div>
                            <p class="service-card__desc">
                                ベランダ、バルコニー、陸屋根の雨漏りを未然に防ぎます。ウレタン防水、FRP防水など、施工箇所の形状や用途に合わせた工法で、水の侵入をシャットアウト。
                            </p>
                            <ul class="service-card__tags">
                                <li>ベランダ・屋上</li>
                                <li>雨漏り防止</li>
                                <li>ウレタン・FRP</li>
                            </ul>
                            <div class="service-card__arrow">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                </article>

                <article class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?php echo home_url('/service/repair/'); ?>" class="service-card__link">
                        <div class="service-card__image-box">
                            <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=800" alt="補修・修繕" class="service-card__image">
                            <div class="service-card__overlay">
                                <span class="service-card__more">詳細を見る</span>
                            </div>
                            <span class="service-card__num">04</span>
                        </div>
                        <div class="service-card__body">
                            <div class="service-card__header">
                                <span class="service-card__en">Repair & Maintenance</span>
                                <h3 class="service-card__title">補修・修繕</h3>
                            </div>
                            <p class="service-card__desc">
                                シーリングの打ち替え、ひび割れ補修、雨漏り修理など、建物の「困った」を解決します。塗装前の下地処理のみや、部分的な小工事も喜んで承ります。
                            </p>
                            <ul class="service-card__tags">
                                <li>シーリング</li>
                                <li>雨漏り修理</li>
                                <li>部分補修</li>
                            </ul>
                            <div class="service-card__arrow">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section class="section service-features bg-gray">
        <div class="service-container">
            <div class="features-wrapper">
                <div class="features-head">
                    <h2 class="features-title">
                        <span class="features-title__sub">WHY CHOOSE US</span>
                        <?php echo esc_html($company_name); ?>が<br>選ばれる理由
                    </h2>
                    <p class="features-desc">
                        私たちは単なる塗装屋ではありません。<br>
                        建物の状態を正しく診断し、最適な処置を施す「家の医者」です。
                    </p>
                </div>
                
                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                        </div>
                        <h3>国家資格・一級技能士</h3>
                        <p>知識と経験に裏打ちされた、確かな技術力で施工します。</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <h3>詳細な診断・報告</h3>
                        <p>現地調査報告書を提出し、納得いただけるプランをご提案。</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <h3>安心の長期保証</h3>
                        <p>施工後も安心。塗料グレードに応じた品質保証書を発行します。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    お住まいの悩み、<br>
                    <span class="highlight">まるごと解決</span>します。
                </h2>
                <p class="creative-bottom__text">
                    「どこに頼めばいいかわからない」「いくらかかるか知りたい」<br>
                    そんな時は、まず無料診断をご利用ください。<br>
                    しつこい営業は一切いたしません。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">現状を知りたい方</span>
                            <span class="link-card__main">無料診断・見積り予約</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="link-card link-card--line" target="_blank" rel="noopener noreferrer">
                        <div class="link-card__icon">💬</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">気軽に相談したい方</span>
                            <span class="link-card__main">LINEで写真を送って相談</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* * 共通設定（各サービスページと変数を統一）
 */
:root {
    --c-prm: #0d47a1; /* Primary Blue */
    --c-acc: #f59e0b; /* Accent Orange */
    --c-txt: #333333;
    --c-txt-light: #666666;
    --c-bg-light: #f9f9f9;
    --c-bg-gray: #f0f4f8;
    
    --shadow-float: 0 15px 30px rgba(0,0,0,0.1);
    --shadow-card: 0 5px 15px rgba(0,0,0,0.05);
    
    --radius-l: 16px;
    --radius-m: 8px;
    
    --font-jp: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", sans-serif;
    --font-en: "DIN Alternate", "Roboto", sans-serif;
    
    /* コンテナ幅設定 */
    --container-max: 1200px;
    --container-pad: 20px;
}

body {
    font-family: var(--font-jp);
    color: var(--c-txt);
    line-height: 1.6;
}

img { max-width: 100%; height: auto; vertical-align: bottom; }
.bg-light { background-color: var(--c-bg-light); }
.bg-gray { background-color: var(--c-bg-gray); }
.text-center { text-align: center; }
.d-block { display: block; }
.pc-only { display: inline; }
.sp-only { display: none; }

/* * コンテナ設定（重要：横幅制御）
 */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

/* * HERO SECTION
 */
.archive-hero {
    position: relative;
    height: 500px;
    display: flex;
    align-items: center;
    color: #fff;
    overflow: hidden;
}
.archive-hero__bg {
    position: absolute;
    inset: 0;
    z-index: -1;
}
.archive-hero__image {
    width: 100%; height: 100%;
    background-size: cover;
    background-position: center;
}
.archive-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(13, 71, 161, 0.9) 0%, rgba(2, 33, 113, 0.5) 100%);
}
.archive-hero__content {
    position: relative;
    z-index: 1;
    max-width: 800px;
}
.archive-hero__tag {
    display: inline-block;
    border: 1px solid rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(5px);
    padding: 6px 20px;
    border-radius: 30px;
    font-family: var(--font-en);
    font-size: 0.9rem;
    letter-spacing: 0.15em;
    margin-bottom: 20px;
}
.archive-hero__title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
}
.text-gradient {
    background: linear-gradient(45deg, #fff, #93c5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.archive-hero__lead {
    font-size: 1.1rem;
    line-height: 1.8;
    opacity: 0.95;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
.archive-hero__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

/* * BREADCRUMB
 */
.breadcrumb {
    padding: 20px 0;
    font-size: 0.85rem;
    color: var(--c-txt-light);
}
.breadcrumb__list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
}
.breadcrumb__link {
    color: var(--c-txt-light);
    text-decoration: none;
    transition: 0.2s;
}
.breadcrumb__link:hover { color: var(--c-prm); }
.breadcrumb__separator { color: #ccc; display: flex; align-items: center; }

/* * SERVICE LIST (Grid Layout)
 */
.section { padding: 80px 0; }
.section-head { margin-bottom: 60px; }
.section-head__sub {
    display: block;
    color: var(--c-prm);
    font-family: var(--font-en);
    font-weight: bold;
    letter-spacing: 0.1em;
    font-size: 0.9rem;
    margin-bottom: 10px;
}
.section-head__title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    color: #1a202c;
}
.section-head__desc {
    color: var(--c-txt-light);
    max-width: 600px;
    margin: 0 auto;
    font-size: 1rem;
}
.marker-blue { background: linear-gradient(transparent 60%, rgba(13, 71, 161, 0.15) 60%); font-weight: bold; }

.service-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
}

.service-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #eee;
    height: 100%; /* Equal height */
    display: flex;
    flex-direction: column;
}
.service-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-float);
}

.service-card__link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.service-card__image-box {
    position: relative;
    height: 250px;
    overflow: hidden;
}
.service-card__image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}
.service-card:hover .service-card__image { transform: scale(1.05); }

.service-card__overlay {
    position: absolute;
    inset: 0;
    background: rgba(13, 71, 161, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.service-card:hover .service-card__overlay { opacity: 1; }

.service-card__more {
    color: #fff;
    border: 1px solid #fff;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: bold;
    letter-spacing: 0.1em;
}

.service-card__num {
    position: absolute;
    top: 20px;
    left: 20px;
    font-family: var(--font-en);
    font-size: 3rem;
    font-weight: 900;
    color: rgba(255,255,255,0.2);
    line-height: 1;
}

.service-card__body {
    padding: 30px;
    flex: 1;
    display: flex;
    flex-direction: column;
    position: relative;
}

.service-card__header {
    margin-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
}
.service-card__en {
    display: block;
    font-family: var(--font-en);
    font-size: 0.85rem;
    color: var(--c-prm);
    font-weight: bold;
    margin-bottom: 5px;
    letter-spacing: 0.05em;
}
.service-card__title {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    color: var(--c-txt);
}
.service-card__desc {
    font-size: 0.95rem;
    color: var(--c-txt-light);
    line-height: 1.7;
    margin-bottom: 20px;
    flex: 1;
}
.service-card__tags {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 15px;
}
.service-card__tags li {
    font-size: 0.8rem;
    background: var(--c-bg-gray);
    color: var(--c-txt-light);
    padding: 4px 12px;
    border-radius: 4px;
}
.service-card__arrow {
    position: absolute;
    bottom: 30px;
    right: 30px;
    color: var(--c-prm);
    transition: transform 0.3s;
}
.service-card:hover .service-card__arrow { transform: translateX(5px); }

/* * FEATURES SECTION
 */
.service-features {
    background: var(--c-bg-gray);
}
.features-wrapper {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 60px;
    align-items: center;
}
.features-head {
    text-align: left;
}
.features-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 20px;
    line-height: 1.3;
}
.features-title__sub {
    display: block;
    font-size: 0.9rem;
    color: var(--c-prm);
    font-family: var(--font-en);
    margin-bottom: 10px;
}
.features-desc {
    font-size: 1rem;
    color: var(--c-txt-light);
}

.features-list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.feature-item {
    background: #fff;
    padding: 25px;
    border-radius: var(--radius-l);
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
}
.feature-item__icon {
    width: 60px;
    height: 60px;
    background: var(--c-bg-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: var(--c-prm);
}
.feature-item h3 {
    font-size: 1.1rem;
    margin-bottom: 10px;
    font-weight: bold;
}
.feature-item p {
    font-size: 0.85rem;
    color: var(--c-txt-light);
    margin: 0;
    line-height: 1.5;
}

/* * CREATIVE BOTTOM
 */
.creative-bottom {
    padding: 100px 0;
    position: relative;
    background: #fff;
    overflow: hidden;
}
.creative-bottom__bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    z-index: 0;
}
.creative-bottom__inner {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}
.creative-bottom__title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #0f172a;
}
.creative-bottom__title .highlight {
    background: linear-gradient(transparent 60%, rgba(245, 158, 11, 0.3) 60%);
}
.creative-bottom__text {
    font-size: 1.05rem;
    margin-bottom: 40px;
    color: #475569;
}
.creative-bottom__links {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}
.link-card {
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    padding: 20px 30px;
    border-radius: 50px;
    text-decoration: none;
    color: #333;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.3s;
    border: 1px solid rgba(0,0,0,0.05);
    min-width: 280px;
}
.link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border-color: var(--c-prm);
}
.link-card__icon { font-size: 1.5rem; }
.link-card__content { text-align: left; }
.link-card__sub { display: block; font-size: 0.75rem; color: #94a3b8; margin-bottom: 2px; }
.link-card__main { display: block; font-size: 1.1rem; font-weight: bold; color: var(--c-prm); }
.link-card__arrow { margin-left: auto; color: #cbd5e1; font-weight: bold; }
.link-card--line .link-card__main { color: #06c755; }
.link-card--line:hover { border-color: #06c755; }

/* * RESPONSIVE
 */
@media (max-width: 900px) {
    .service-grid {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
    }
    .features-wrapper {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .features-head {
        text-align: center;
    }
    .features-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .pc-only { display: none; }
    .sp-only { display: inline; }
    .archive-hero__title { font-size: 2.2rem; }
    .archive-hero { height: 400px; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
</style>

<?php get_footer(); ?>