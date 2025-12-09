<?php
/**
 * Template Name: 補修・修繕サービスページ（Layout Fix）
 * Template Post Type: page, service
 * Description: デザイン・レイアウト修正済みの補修修繕LP
 * Author: Senior WordPress Engineer
 * Version: 3.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// 設定・データ取得
// =============================================================================
$company_name    = sato_get_company_name();
$warranty_years  = sato_get_warranty_years();
$phone_link      = sato_get_phone_link();
$line_url        = sato_get_line_url();

// 構造化データ
$schema_service = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => '補修・修繕工事',
    'description' => '外壁のひび割れ、シーリング打ち替え、雨漏り修理など、建物の補修・修繕を専門的に対応。',
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => sato_get_company_name(true),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => '御殿場市',
            'addressRegion' => '静岡県',
            'addressCountry' => 'JP',
        ],
    ],
    'serviceType' => ['シーリング工事', 'ひび割れ補修', '雨漏り修理', '外壁補修'],
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="service-page service-page--repair" role="main">

    <section class="hero-visual">
        <div class="hero-visual__bg">
            <div class="hero-visual__image" style="background-image: url('https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="hero-visual__overlay"></div>
        </div>
        
        <div class="service-container">
            <div class="hero-visual__content">
                <span class="hero-visual__tag">REPAIR & MAINTENANCE</span>
                <h1 class="hero-visual__title">
                    <span class="d-block">小さな傷ひとつ、</span>
                    <span class="d-block text-gradient">見逃さないプロの目。</span>
                </h1>
                <p class="hero-visual__lead">
                    塗装の仕上がりは「下地」で決まる。<br>
                    補修専門の技術で、建物の寿命を延ばします。
                </p>
                <div class="trust-badges">
                    <span class="trust-badge"><i class="icon-check">✓</i> 部分補修OK</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 雨漏り診断</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 緊急対応可</span>
                </div>
            </div>
        </div>

        <div class="hero-visual__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,64C960,75,1056,85,1152,80C1248,75,1344,53,1392,42.7L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <section class="section section--trouble">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">SELF CHECK</span>
                <h2 class="section-head__title">建物からの<span class="marker-green">SOSサイン</span></h2>
                <p class="section-head__desc">塗装よりも先に「補修」が必要です。<br>放置すると雨水が侵入し、構造材を腐らせてしまいます。</p>
            </div>

            <div class="check-grid">
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&q=80&w=400" alt="外壁のひび割れ" loading="lazy">
                        <div class="check-card__alert check-card__alert--warning">要注意</div>
                    </div>
                    <h3 class="check-card__title">ひび割れ（クラック）</h3>
                    <p class="check-card__text">髪の毛ほどの細いヒビでも、毛細管現象で水を吸い込みます。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1607472586893-edb57bdc0e39?auto=format&fit=crop&q=80&w=400" alt="シーリング切れ" loading="lazy">
                        <div class="check-card__alert check-card__alert--danger">危険</div>
                    </div>
                    <h3 class="check-card__title">シーリングの切れ・痩せ</h3>
                    <p class="check-card__text">目地のゴムが切れると、そこは水の入り口になります。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1558618047-f4b511a2e0d0?auto=format&fit=crop&q=80&w=400" alt="コンクリート爆裂" loading="lazy">
                        <div class="check-card__alert check-card__alert--critical">緊急</div>
                    </div>
                    <h3 class="check-card__title">爆裂・欠損</h3>
                    <p class="check-card__text">内部の鉄筋が錆びて膨張し、コンクリートを破壊しています。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1525785967371-87ba44b3e6cf?auto=format&fit=crop&q=80&w=400" alt="雨染み" loading="lazy">
                        <div class="check-card__alert check-card__alert--critical">緊急</div>
                    </div>
                    <h3 class="check-card__title">室内の雨染み</h3>
                    <p class="check-card__text">すでに内部まで水が回っています。早急な調査が必要です。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--menu bg-gray">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">REPAIR MENU</span>
                <h2 class="section-head__title">補修・修繕<span class="marker-green">メニュー</span></h2>
                <p class="section-head__desc">
                    「塗装はまだ早いけど、ここだけ直したい」<br>
                    そんなご要望にも、プロの技術でお応えします。
                </p>
            </div>

            <div class="menu-grid">
                <div class="menu-card menu-card--featured">
                    <div class="menu-card__badge">塗装とセットで必須</div>
                    <div class="menu-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&q=80&w=600" alt="シーリング打ち替え" loading="lazy">
                        <div class="menu-card__label">シーリング工事</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">シーリング打ち替え</h3>
                        <p class="menu-card__desc">
                            サイディングの継ぎ目やサッシ周りのゴム状パッキンを交換します。既存を撤去して新しく打つ「打ち替え」が基本です。
                        </p>
                        <div class="menu-card__price">
                            <span class="label">参考価格</span>
                            <span class="amount">800<small>円〜/m</small></span>
                        </div>
                        <ul class="menu-card__points">
                            <li>高耐久オートン使用可</li>
                            <li>サッシ周り防水</li>
                            <li>外壁目地打ち替え</li>
                        </ul>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=600" alt="ひび割れ補修" loading="lazy">
                        <div class="menu-card__label">ひび割れ補修</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">クラック補修</h3>
                        <p class="menu-card__desc">
                            ひび割れの深さに応じて、Vカットシール工法やエポキシ樹脂注入など、最適な工法で強度を回復させます。
                        </p>
                        <div class="menu-card__price">
                            <span class="label">参考価格</span>
                            <span class="amount">15,000<small>円〜/箇所</small></span>
                        </div>
                        <ul class="menu-card__points">
                            <li>Vカット工法</li>
                            <li>エポキシ樹脂注入</li>
                            <li>フィラー擦り込み</li>
                        </ul>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&q=80&w=600" alt="雨漏り修理" loading="lazy">
                        <div class="menu-card__label">雨漏り修理</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">雨漏り調査・修理</h3>
                        <p class="menu-card__desc">
                            原因特定が最重要。目視調査、散水試験、赤外線調査などで侵入経路を特定し、確実に水を止めます。
                        </p>
                        <div class="menu-card__price">
                            <span class="label">参考価格</span>
                            <span class="amount">30,000<small>円〜</small></span>
                        </div>
                        <ul class="menu-card__points">
                            <li>原因調査・特定</li>
                            <li>緊急応急処置</li>
                            <li>内装復旧工事</li>
                        </ul>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=600" alt="鉄部塗装" loading="lazy">
                        <div class="menu-card__label">鉄部・木部・部分塗装</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">部分補修・塗装</h3>
                        <p class="menu-card__desc">
                            鉄階段のサビ止め、ウッドデッキの防腐塗装、雨樋の交換など、建物の付帯部分のメンテナンスも承ります。
                        </p>
                        <div class="menu-card__price">
                            <span class="label">参考価格</span>
                            <span class="amount">別途見積り</span>
                        </div>
                        <ul class="menu-card__points">
                            <li>鉄部サビ止め</li>
                            <li>木部防腐処理</li>
                            <li>雨樋交換・補修</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <p class="price-disclaimer">
                ※上記価格は目安です。劣化状況、足場の必要有無、使用材料により変動いたします。<br>
                正確な金額は現地調査の上、お見積り書にてご提示いたします。
            </p>
        </div>
    </section>

    <section class="section section--flow bg-light">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">WORK FLOW</span>
                <h2 class="section-head__title">補修工事の<span class="marker-green">流れ</span></h2>
            </div>

            <div class="flow-steps">
                <div class="flow-step">
                    <div class="flow-step__num">01</div>
                    <div class="flow-step__content">
                        <h4>現地調査・原因特定</h4>
                        <p>専門家が現地を訪問し、不具合の状況と原因を詳しく調査します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">02</div>
                    <div class="flow-step__content">
                        <h4>お見積り・ご提案</h4>
                        <p>「部分補修で済むか」「全体改修が必要か」最適なプランをご提案します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">03</div>
                    <div class="flow-step__content">
                        <h4>補修・修繕工事</h4>
                        <p>下地処理を徹底し、再発を防ぐ確実な施工を行います。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">04</div>
                    <div class="flow-step__content">
                        <h4>確認・お引き渡し</h4>
                        <p>施工箇所の写真を撮影し、報告書として提出いたします。</p>
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
                    小さな「困った」も、<br>
                    <span class="highlight">プロにお任せ</span>ください。
                </h2>
                <p class="creative-bottom__text">
                    「これだけで頼んでもいいのかな？」というご相談も大歓迎です。<br>
                    建物を長く守るために、早めのメンテナンスをお手伝いします。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">🛠</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">今の状態を見てほしい</span>
                            <span class="link-card__main">無料現地調査を予約</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/works/?category=repair')); ?>" class="link-card link-card--secondary">
                        <div class="link-card__icon">📷</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">どんな工事をするの？</span>
                            <span class="link-card__main">補修工事の施工事例</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* * 共通変数・設定（外壁・屋根と統一）
 */
:root {
    --c-repair-main: #0066cc; /* Standard Blue */
    --c-repair-accent: #10b981; /* Repair/Green */
    
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

    /* コンテナ幅統一 */
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

/* * コンテナ設定（レイアウト崩れ防止）
 */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

/* * Section Headers
 */
.section { padding: 80px 0; }
.section-head { margin-bottom: 60px; }
.section-head__sub {
    display: block;
    color: var(--c-repair-accent);
    font-family: var(--font-en);
    font-weight: bold;
    font-size: 0.9rem;
    letter-spacing: 0.15em;
    margin-bottom: 10px;
}
.section-head__title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    color: var(--c-repair-main);
}
.section-head__desc {
    color: var(--c-txt-light);
    max-width: 600px;
    margin: 0 auto;
    font-size: 1rem;
}
.marker-green {
    background: linear-gradient(transparent 60%, rgba(16, 185, 129, 0.2) 60%);
    font-weight: bold;
}

/* * HERO SECTION
 */
.hero-visual {
    position: relative;
    height: 550px;
    display: flex;
    align-items: center;
    color: #fff;
    overflow: hidden;
}
.hero-visual__bg {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    z-index: -1;
}
.hero-visual__image {
    width: 100%; height: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(0.7);
    animation: zoomSlow 20s infinite alternate;
}
@keyframes zoomSlow { from { transform: scale(1); } to { transform: scale(1.1); } }

.hero-visual__overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(to right, rgba(0, 50, 100, 0.7) 0%, rgba(0,0,0,0.2) 100%);
}
.hero-visual__content {
    position: relative;
    z-index: 1;
    max-width: 700px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.3);
}
.hero-visual__tag {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    padding: 6px 18px;
    border-radius: 30px;
    font-size: 0.9rem;
    letter-spacing: 0.1em;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.3);
    font-family: var(--font-en);
}
.hero-visual__title {
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
}
.text-gradient {
    background: linear-gradient(45deg, #fff, #a3d9cf);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.hero-visual__lead {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 35px;
    opacity: 0.95;
}
.trust-badges {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}
.trust-badge {
    background: rgba(0,0,0,0.4);
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid rgba(255,255,255,0.2);
}
.trust-badge i { color: var(--c-repair-accent); }
.hero-visual__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

/* * TROUBLE CHECK (Cards)
 */
.check-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}
.check-card {
    text-align: center;
    background: #fff;
    border-radius: var(--radius-l);
    padding-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: 0.3s;
}
.check-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-float); }

.check-card__img {
    position: relative;
    border-radius: var(--radius-l) var(--radius-l) 0 0;
    overflow: hidden;
    margin-bottom: 15px;
    aspect-ratio: 4/3;
}
.check-card__img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.4s;
}
.check-card:hover .check-card__img img { transform: scale(1.05); }

.check-card__alert {
    position: absolute;
    top: 10px; right: 10px;
    color: #fff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
.check-card__alert--warning { background: #f59e0b; }
.check-card__alert--danger { background: #ef4444; }
.check-card__alert--critical { background: #d32f2f; animation: pulse 2s infinite; }

@keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.8; } 100% { opacity: 1; } }

.check-card__title {
    font-size: 1.15rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--c-repair-main);
}
.check-card__text {
    font-size: 0.9rem;
    color: var(--c-text-light);
    padding: 0 15px;
    line-height: 1.6;
}

/* * MENU CARDS
 */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
    align-items: flex-start;
}
.menu-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    border: 1px solid #eee;
    transition: transform 0.3s;
}
.menu-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-float); }

.menu-card--featured {
    border: 2px solid var(--c-repair-accent);
    position: relative;
    z-index: 1;
}
.menu-card__badge {
    position: absolute;
    top: 0; right: 0;
    background: var(--c-repair-accent);
    color: #fff;
    padding: 6px 15px;
    font-size: 0.8rem;
    font-weight: bold;
    border-bottom-left-radius: 10px;
    z-index: 2;
}

.menu-card__image-holder {
    position: relative;
    height: 200px;
}
.menu-card__image-holder img {
    width: 100%; height: 100%; object-fit: cover;
}
.menu-card__label {
    position: absolute;
    bottom: 0; left: 0; width: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: #fff;
    padding: 20px 20px 10px;
    font-weight: bold;
    font-size: 1.1rem;
}

.menu-card__content { padding: 25px; text-align: center; }
.menu-card__title {
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--c-repair-main);
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
}
.menu-card__desc {
    font-size: 0.9rem;
    color: var(--c-text);
    margin-bottom: 15px;
    min-height: 3em;
}
.menu-card__price {
    display: flex;
    align-items: baseline;
    gap: 5px;
    background: var(--c-bg-light);
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}
.menu-card__price .label { font-size: 0.8rem; color: var(--c-text-light); margin-right: auto; }
.menu-card__price .amount { font-size: 1.4rem; font-weight: bold; color: var(--c-repair-main); font-family: sans-serif; }
.menu-card__price small { font-size: 0.9rem; font-weight: normal; }

.menu-card__points {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.menu-card__points li {
    font-size: 0.8rem;
    background: #eef2f6;
    padding: 4px 10px;
    border-radius: 20px;
    color: var(--c-text-light);
}

.price-disclaimer {
    font-size: 0.85rem;
    color: var(--c-text-light);
    text-align: center;
    margin-top: 20px;
}

/* * FLOW STEPS
 */
.flow-steps {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}
.flow-step {
    flex: 1;
    min-width: 200px;
    background: #fff;
    padding: 25px 20px;
    border-radius: var(--radius-m);
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    position: relative;
    text-align: center;
    border-top: 4px solid var(--c-repair-accent);
}
.flow-step__num {
    display: inline-block;
    width: 40px; height: 40px;
    line-height: 40px;
    background: var(--c-repair-accent);
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    font-family: var(--font-en);
    margin-bottom: 15px;
    box-shadow: 0 3px 8px rgba(16, 185, 129, 0.3);
}
.flow-step h4 { font-size: 1.1rem; margin-bottom: 10px; font-weight: bold; color: var(--c-repair-main); }
.flow-step p { font-size: 0.9rem; color: var(--c-text-light); line-height: 1.6; }

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
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
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
    color: var(--c-repair-main);
}
.creative-bottom__title .highlight {
    background: linear-gradient(transparent 60%, rgba(16, 185, 129, 0.2) 60%);
}
.creative-bottom__text {
    font-size: 1.05rem;
    margin-bottom: 40px;
    color: var(--c-text-light);
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
    color: var(--c-text);
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.3s;
    border: 1px solid rgba(0,0,0,0.05);
    min-width: 280px;
}
.link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    border-color: var(--c-repair-accent);
}
.link-card__icon { font-size: 1.5rem; }
.link-card__content { text-align: left; }
.link-card__sub { display: block; font-size: 0.75rem; color: var(--c-text-light); margin-bottom: 2px; }
.link-card__main { display: block; font-size: 1.1rem; font-weight: bold; color: var(--c-repair-main); }
.link-card__arrow { margin-left: auto; color: var(--c-repair-accent); font-weight: bold; }

.link-card--secondary .link-card__main { color: var(--c-text); }

/* * RESPONSIVE
 */
@media (max-width: 768px) {
    .hero-visual__title { font-size: 2.2rem; }
    .hero-visual { height: 500px; }
    .menu-grid { grid-template-columns: 1fr; }
    .flow-steps { flex-direction: column; }
    .flow-step { text-align: left; display: flex; align-items: flex-start; gap: 15px; }
    .flow-step__num { margin-bottom: 0; flex-shrink: 0; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
    .sp-only { display: inline; }
    .pc-only { display: none; }
}
</style>