<?php
/**
 * Template Name: 外壁塗装サービスページ（Layout Fix）
 * Template Post Type: page, service
 * Description: コンテナ幅修正済みの外壁塗装LP
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

// 構造化データ
$schema_service = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => '外壁塗装',
    'description' => '一級塗装技能士による高品質な外壁塗装。ラジカル塗料、フッ素塗料、多彩模様塗料など幅広く対応。',
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
    'serviceType' => '外壁塗装',
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="service-page service-page--exterior" role="main">

    <section class="hero-visual">
        <div class="hero-visual__bg">
            <div class="hero-visual__image" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="hero-visual__overlay"></div>
        </div>
        
        <div class="service-container">
            <div class="hero-visual__content">
                <span class="hero-visual__tag">EXTERIOR PAINTING</span>
                <h1 class="hero-visual__title">
                    <span class="d-block">家の「顔」を、</span>
                    <span class="d-block text-gradient">美しく守り抜く。</span>
                </h1>
                <p class="hero-visual__lead">
                    新築のような輝きを取り戻すだけでなく、<br>
                    建物の寿命を延ばすための「技術」があります。
                </p>
                <div class="trust-badges">
                    <span class="trust-badge"><i class="icon-check">✓</i> 一級塗装技能士</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 最長<?php echo esc_html($warranty_years); ?>年保証</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 色選びサポート</span>
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
                <h2 class="section-head__title">外壁の<span class="marker-blue">塗り替えサイン</span></h2>
                <p class="section-head__desc">以下の症状が見られたら、防水機能が低下している証拠です。<br>早めのメンテナンスが、建物を長持ちさせます。</p>
            </div>

            <div class="check-grid">
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1596638787647-904d822d751e?auto=format&fit=crop&q=80&w=400" alt="チョーキング現象" loading="lazy">
                        <div class="check-card__alert check-card__alert--warning">初期</div>
                    </div>
                    <h3 class="check-card__title">白い粉が手につく</h3>
                    <p class="check-card__text">「チョーキング現象」といい、塗膜が紫外線で分解され防水機能を失い始めています。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=400" alt="外壁のひび割れ" loading="lazy">
                        <div class="check-card__alert check-card__alert--orange">注意</div>
                    </div>
                    <h3 class="check-card__title">ひび割れ（クラック）</h3>
                    <p class="check-card__text">0.3mm以上のひび割れは雨水が侵入する入り口となり、構造材を傷める原因になります。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1607472586893-edb57bdc0e39?auto=format&fit=crop&q=80&w=400" alt="シーリング劣化" loading="lazy">
                        <div class="check-card__alert check-card__alert--orange">注意</div>
                    </div>
                    <h3 class="check-card__title">目地のひび・痩せ</h3>
                    <p class="check-card__text">サイディングの継ぎ目にあるゴム（シーリング）の劣化は、雨漏りの直接的な原因になります。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1516455590571-18256e5bb9ff?auto=format&fit=crop&q=80&w=400" alt="カビ・コケ" loading="lazy">
                        <div class="check-card__alert check-card__alert--red">危険</div>
                    </div>
                    <h3 class="check-card__title">カビ・コケの発生</h3>
                    <p class="check-card__text">外壁が常に水分を含んでいる状態です。外壁材自体が脆くなっている可能性があります。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--methods bg-gray">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">PAINT SELECTION</span>
                <h2 class="section-head__title">目的に合わせた<span class="marker-blue">塗料選び</span></h2>
                <p class="section-head__desc">耐久年数とコストのバランスで選べる3つのグレード。<br>お客様のライフプランに合わせてご提案します。</p>
            </div>

            <div class="methods-list">
                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?auto=format&fit=crop&q=80&w=600" alt="シリコン塗料" loading="lazy">
                        <span class="method-badge">Economy</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">シリコン塗料</h3>
                            <span class="method-card__subtitle">コスト重視のスタンダード</span>
                        </div>
                        <div class="method-card__spec">
                            <dl>
                                <dt>耐久年数</dt>
                                <dd>8〜10年</dd>
                            </dl>
                            <dl>
                                <dt>初期費用</dt>
                                <dd>抑えめ</dd>
                            </dl>
                        </div>
                        <p class="method-card__desc">
                            最も普及しているスタンダードな塗料です。カラーバリエーションが豊富で、初期費用を抑えたい方、こまめに塗り替えたい方におすすめです。
                        </p>
                    </div>
                </article>

                <article class="method-card method-card--featured">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1600596542815-e32c8ec2205e?auto=format&fit=crop&q=80&w=600" alt="ラジカル塗料" loading="lazy">
                        <span class="method-badge method-badge--popular">人気 No.1</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">ラジカル制御塗料</h3>
                            <span class="method-card__subtitle">コスパ最強の次世代塗料</span>
                        </div>
                        <div class="method-card__spec">
                            <dl>
                                <dt>耐久年数</dt>
                                <dd>12〜15年</dd>
                            </dl>
                            <dl>
                                <dt>コスパ</dt>
                                <dd>★★★★★</dd>
                            </dl>
                        </div>
                        <p class="method-card__desc">
                            紫外線による劣化を抑える新技術を採用。シリコンと変わらない価格帯で、ワンランク上の耐久性を実現。現在最も選ばれている塗料です。
                        </p>
                    </div>
                </article>

                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&q=80&w=600" alt="フッ素塗料" loading="lazy">
                        <span class="method-badge method-badge--strong">超高耐久</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">フッ素・無機塗料</h3>
                            <span class="method-card__subtitle">長期間メンテナンス不要</span>
                        </div>
                        <div class="method-card__spec">
                            <dl>
                                <dt>耐久年数</dt>
                                <dd>15〜20年</dd>
                            </dl>
                            <dl>
                                <dt>耐久性</dt>
                                <dd>最高級</dd>
                            </dl>
                        </div>
                        <p class="method-card__desc">
                            商業施設や橋梁にも使われる最高グレードの塗料。一度の工事で長持ちさせたい方、トータルの維持費（ライフサイクルコスト）を抑えたい方に。
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section section--price">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">PRICE PLANS</span>
                <h2 class="section-head__title">外壁塗装<span class="marker-orange">参考プラン</span></h2>
                <p class="section-head__desc">
                    延床面積30坪（約100㎡）の戸建住宅を想定した目安です。<br>
                    足場・洗浄・下地補修・3回塗り・保証すべて込みの安心価格。
                </p>
            </div>

            <div class="price-grid">
                <div class="menu-card">
                    <div class="menu-card__image">
                        <img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&q=80&w=600" alt="エコノミープラン" loading="lazy">
                        <div class="menu-card__label">シリコンプラン</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">エコノミーパック</h3>
                        <div class="menu-card__price">
                            <span class="yen">¥</span>
                            <span class="num">49.8</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="menu-card__note">※30坪 / 足場代込み</p>
                        <div class="menu-card__details">
                            <ul>
                                <li>高圧洗浄・養生</li>
                                <li>下地調整</li>
                                <li>シリコン3回塗り</li>
                                <li>5年保証</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="menu-card menu-card--recommend">
                    <div class="recommend-badge">一番人気</div>
                    <div class="menu-card__image">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=600" alt="スタンダードプラン" loading="lazy">
                        <div class="menu-card__label">ラジカルプラン</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">スタンダードパック</h3>
                        <div class="menu-card__price">
                            <span class="yen">¥</span>
                            <span class="num">59.8</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="menu-card__note">※30坪 / 足場代込み</p>
                        <div class="menu-card__details">
                            <ul>
                                <li>高圧洗浄・養生</li>
                                <li>下地調整・補修</li>
                                <li>ラジカル3回塗り</li>
                                <li>7年保証</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-card__image">
                        <img src="https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&q=80&w=600" alt="プレミアムプラン" loading="lazy">
                        <div class="menu-card__label">フッ素・無機プラン</div>
                    </div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">プレミアムパック</h3>
                        <div class="menu-card__price">
                            <span class="yen">¥</span>
                            <span class="num">74.8</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="menu-card__note">※30坪 / 足場代込み</p>
                        <div class="menu-card__details">
                            <ul>
                                <li>高圧洗浄・養生</li>
                                <li>徹底した下地補修</li>
                                <li>フッ素/無機3回塗り</li>
                                <li>10年保証</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <p class="price-disclaimer">
                ※上記は目安価格です。建物の形状、窓の多さ、現在の劣化状況、付帯部（雨樋など）の塗装範囲により変動いたします。<br>
                正確な金額は現地調査の上、詳細なお見積り書にてご提示いたします。
            </p>
        </div>
    </section>

    <section class="section section--flow bg-light">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">WORK FLOW</span>
                <h2 class="section-head__title">施工の<span class="marker-blue">流れ</span></h2>
                <p class="section-head__desc">手抜きなしの3回塗りが基本です。<br>見えない下地処理こそ、徹底的にこだわります。</p>
            </div>

            <div class="flow-steps">
                <div class="flow-step">
                    <div class="flow-step__num">01</div>
                    <div class="flow-step__content">
                        <h4>現地調査・診断</h4>
                        <p>外壁の劣化状況や面積を正確に計測。お客様のご要望をヒアリングします。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">02</div>
                    <div class="flow-step__content">
                        <h4>足場・洗浄</h4>
                        <p>近隣へ配慮した足場設置と、長年の汚れを落とす高圧洗浄を行います。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">03</div>
                    <div class="flow-step__content">
                        <h4>下地補修・養生</h4>
                        <p>ひび割れやシーリングを補修。窓などを汚さないよう養生します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">04</div>
                    <div class="flow-step__content">
                        <h4>3回手塗り</h4>
                        <p>下塗り・中塗り・上塗り。塗膜の厚みを確保し、耐久性を高めます。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">05</div>
                    <div class="flow-step__content">
                        <h4>完了検査</h4>
                        <p>塗り残しがないか厳しくチェック。足場解体後、清掃してお引き渡しです。</p>
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
                    <span class="highlight">色選び</span>から、<br>
                    一緒に楽しみませんか？
                </h2>
                <p class="creative-bottom__text">
                    「どんな色が合うかわからない」「失敗したくない」<br>
                    そんな不安も、カラーシミュレーションや塗り板見本で解決。<br>
                    世界に一つだけの、素敵な我が家に生まれ変わらせます。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">🎨</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">まずは相談したい</span>
                            <span class="link-card__main">無料診断・見積り予約</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/works/?category=exterior')); ?>" class="link-card link-card--secondary">
                        <div class="link-card__icon">🏠</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">色選びの参考に</span>
                            <span class="link-card__main">外壁塗装の施工事例</span>
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
/* * 共通設定・変数（各サービスページと変数を統一）
 */
:root {
    --c-ext-main: #0d47a1; /* Deep Blue */
    --c-ext-light: #e3f2fd;
    --c-ext-accent: #f59e0b; /* Warm Orange */
    
    --font-jp: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", sans-serif;
    --font-en: "DIN Alternate", "Roboto", sans-serif;
    
    --shadow-float: 0 15px 30px rgba(0,0,0,0.1);
    --shadow-card: 0 5px 15px rgba(0,0,0,0.05);
    
    --radius-l: 16px;
    --radius-m: 8px;
    
    /* コンテナ幅設定（ここが重要） */
    --container-max: 1200px;
    --container-pad: 20px;
}

body {
    font-family: var(--font-jp);
    color: #333;
    line-height: 1.6;
}

img { max-width: 100%; height: auto; vertical-align: bottom; }
.bg-light { background-color: #ffffff; }
.bg-gray { background-color: #f8fafc; }
.text-center { text-align: center; }
.d-block { display: block; }
.pc-only { display: inline; }
.sp-only { display: none; }

/* * コンテナ設定（これで横幅いっぱいになるのを防ぎます）
 */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

/* Section Common */
.section { padding: 80px 0; }
.section-head { margin-bottom: 60px; }
.section-head__sub {
    display: block;
    color: var(--c-ext-main);
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
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    font-size: 1rem;
}
.marker-blue { background: linear-gradient(transparent 60%, rgba(13, 71, 161, 0.15) 60%); font-weight: bold; }
.marker-orange { background: linear-gradient(transparent 60%, rgba(245, 158, 11, 0.2) 60%); font-weight: bold; }
.marker-green { background: linear-gradient(transparent 60%, rgba(16, 185, 129, 0.2) 60%); font-weight: bold; }

/* * HERO SECTION
 */
.hero-visual {
    position: relative;
    height: 600px;
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
    animation: zoomSlow 20s infinite alternate;
}
@keyframes zoomSlow { from { transform: scale(1); } to { transform: scale(1.1); } }

.hero-visual__overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(to right, rgba(10, 25, 45, 0.8) 0%, rgba(13, 71, 161, 0.4) 100%);
}
.hero-visual__content {
    position: relative;
    z-index: 1;
    max-width: 750px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.3);
}
.hero-visual__tag {
    display: inline-block;
    background: rgba(255,255,255,0.1);
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
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
}
.text-gradient {
    background: linear-gradient(45deg, #fff, #93c5fd);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.hero-visual__lead {
    font-size: 1.15rem;
    line-height: 1.8;
    margin-bottom: 35px;
    opacity: 0.95;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
.trust-badges {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}
.trust-badge {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 0.95rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid rgba(255,255,255,0.3);
}
.trust-badge i { color: #facc15; }
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
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
}
.check-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: 0.3s;
    text-align: center;
    padding-bottom: 20px;
}
.check-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-float); }

.check-card__img {
    position: relative;
    border-radius: var(--radius-l) var(--radius-l) 0 0;
    overflow: hidden;
    margin-bottom: 15px;
    aspect-ratio: 4/3;
}
.check-card__img img { width: 100%; height: 100%; object-fit: cover; transition: 0.4s; }
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
.check-card__alert--orange { background: #ea580c; }
.check-card__alert--red { background: #dc2626; }

.check-card__title { font-size: 1.15rem; font-weight: bold; margin-bottom: 10px; color: #1e293b; padding-top: 5px; }
.check-card__text { font-size: 0.9rem; color: #64748b; padding: 0 15px; line-height: 1.6; }

/* * METHODS & PRICE (Card Styles)
 */
.price-grid, .methods-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    align-items: flex-start;
}
.menu-card, .method-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    border: 1px solid #e2e8f0;
    transition: transform 0.3s;
}
.menu-card:hover, .method-card:hover { transform: translateY(-5px); }

.menu-card--recommend, .method-card--featured {
    border: 2px solid var(--c-ext-main);
    position: relative;
    z-index: 1;
    transform: scale(1.03);
}
.menu-card--recommend:hover, .method-card--featured:hover { transform: scale(1.03) translateY(-5px); }

.recommend-badge, .method-badge {
    position: absolute;
    top: 0; right: 0;
    background: var(--c-ext-main);
    color: #fff;
    padding: 6px 15px;
    font-size: 0.85rem;
    font-weight: bold;
    border-bottom-left-radius: 10px;
    z-index: 2;
}

.menu-card__image, .method-card__visual {
    position: relative;
    height: 180px;
}
.menu-card__image img, .method-card__visual img { width: 100%; height: 100%; object-fit: cover; }
.menu-card__label {
    position: absolute;
    bottom: 0; left: 0; width: 100%;
    background: linear-gradient(to top, rgba(13, 71, 161, 0.8), transparent);
    color: #fff;
    padding: 20px 20px 10px;
    font-weight: bold;
    font-size: 1.1rem;
}

.menu-card__content, .method-card__content { padding: 25px; text-align: center; }
.menu-card__title, .method-card__title { font-size: 1.25rem; font-weight: bold; margin-bottom: 10px; color: #1e293b; }
.menu-card__price { color: var(--c-ext-main); margin-bottom: 5px; font-family: var(--font-en); }
.menu-card__price .yen { font-size: 1.2rem; font-weight: bold; vertical-align: top; }
.menu-card__price .num { font-size: 2.8rem; font-weight: 800; line-height: 1; letter-spacing: -1px; }
.menu-card__price .unit { font-size: 1.2rem; font-weight: bold; }
.menu-card__price .tax { font-size: 0.8rem; font-weight: normal; color: #94a3b8; display: block; margin-top: 5px;}
.menu-card__note { font-size: 0.8rem; color: #64748b; margin-bottom: 15px; background: #f1f5f9; display: inline-block; padding: 2px 8px; border-radius: 4px;}

.menu-card__details { text-align: left; border-top: 1px dashed #e2e8f0; padding-top: 15px; margin-top: 15px; }
.menu-card__details ul { list-style: none; padding: 0; margin: 0; }
.menu-card__details li { font-size: 0.9rem; margin-bottom: 8px; padding-left: 24px; position: relative; color: #334155; }
.menu-card__details li::before {
    content: '✔';
    position: absolute; left: 0;
    color: var(--c-ext-accent);
    font-weight: bold;
    font-size: 0.8rem;
}

.method-card__subtitle { display: block; font-size: 0.85rem; color: #64748b; font-weight: bold; }
.method-card__desc { font-size: 0.95rem; line-height: 1.7; color: #475569; }

.price-disclaimer { font-size: 0.85rem; color: #64748b; text-align: center; margin-top: 30px; }

/* * FLOW (Step Cards)
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
    border-top: 4px solid var(--c-ext-main);
}
.flow-step__num {
    display: inline-block;
    width: 40px; height: 40px;
    line-height: 40px;
    background: var(--c-ext-main);
    color: #fff;
    border-radius: 50%;
    font-family: var(--font-en);
    font-weight: bold;
    margin-bottom: 15px;
    box-shadow: 0 3px 8px rgba(13, 71, 161, 0.3);
}
.flow-step h4 { font-size: 1.1rem; margin-bottom: 10px; font-weight: bold; color: #1e293b; }
.flow-step p { font-size: 0.9rem; color: #64748b; line-height: 1.6; }

/* * CREATIVE BOTTOM (Link Area)
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
    border-color: var(--c-ext-main);
}
.link-card__icon { font-size: 1.5rem; }
.link-card__content { text-align: left; }
.link-card__sub { display: block; font-size: 0.75rem; color: #94a3b8; margin-bottom: 2px; }
.link-card__main { display: block; font-size: 1.1rem; font-weight: bold; color: var(--c-ext-main); }
.link-card__arrow { margin-left: auto; color: #cbd5e1; font-weight: bold; }
.link-card--secondary .link-card__main { color: #333; }
.link-card--line .link-card__main { color: #06c755; }
.link-card--line:hover { border-color: #06c755; }

/* * RESPONSIVE
 */
@media (max-width: 900px) {
    .price-grid, .methods-list {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin: 0 auto;
    }
}

@media (max-width: 768px) {
    .pc-only { display: none; }
    .sp-only { display: inline; }
    .hero-visual__title { font-size: 2.2rem; }
    .hero-visual { height: 500px; }
    .trust-badges { justify-content: center; }
    .menu-card--recommend { transform: none; }
    .menu-card--recommend:hover { transform: translateY(-5px); }
    .flow-steps { flex-direction: column; }
    .flow-step { text-align: left; display: flex; align-items: flex-start; gap: 15px; }
    .flow-step__num { margin-bottom: 0; flex-shrink: 0; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
</style>

<?php get_footer(); ?>