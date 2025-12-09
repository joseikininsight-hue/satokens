<?php
/**
 * Template Name: 屋根塗装サービスページ（Creative & Photo）
 * Template Post Type: page, service
 * Description: 写真活用・料金プラン重視の屋根塗装LP（ドローンなし版）
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
$company_name    = sato_get_company_name();
$warranty_years  = sato_get_warranty_years();

// 構造化データ
$schema_service = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => '屋根塗装',
    'description' => '一級塗装技能士による屋根塗装サービス。遮熱塗料、断熱塗料対応。無料現地調査実施中。',
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
    'serviceType' => '屋根塗装',
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="service-page service-page--roof-creative" role="main">

    <section class="hero-visual">
        <div class="hero-visual__bg">
            <div class="hero-visual__image" style="background-image: url('https://images.unsplash.com/photo-1628624747186-a941c476b7ef?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="hero-visual__overlay"></div>
        </div>
        
        <div class="container">
            <div class="hero-visual__content">
                <span class="hero-visual__tag">ROOF PAINTING</span>
                <h1 class="hero-visual__title">
                    <span class="d-block">過酷な環境から、</span>
                    <span class="d-block text-gradient">家を守る盾となる。</span>
                </h1>
                <p class="hero-visual__lead">
                    紫外線・雨・風を一番に受ける場所だから。<br>
                    一級技能士が選ぶ「本物」の塗料で守り抜きます。
                </p>
                <div class="trust-badges">
                    <span class="trust-badge"><i class="icon-check">✓</i> 遮熱・断熱対応</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 最長<?php echo esc_html($warranty_years); ?>年保証</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 完全自社施工</span>
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
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">CHECK LIST</span>
                <h2 class="section-head__title">屋根からの<span class="marker-blue">SOSサイン</span></h2>
                <p class="section-head__desc">普段見えない場所だからこそ、プロの診断が必要です。<br>以下の症状があれば塗り替えの時期です。</p>
            </div>

            <div class="check-grid">
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&q=80&w=400" alt="屋根の色あせ" loading="lazy">
                        <div class="check-card__alert check-card__alert--warning">注意</div>
                    </div>
                    <h3 class="check-card__title">色あせ・変色</h3>
                    <p class="check-card__text">防水機能が低下し始めています。一番初期のサインです。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=400" alt="コケや藻" loading="lazy">
                        <div class="check-card__alert check-card__alert--warning">警告</div>
                    </div>
                    <h3 class="check-card__title">コケ・藻の発生</h3>
                    <p class="check-card__text">屋根材が水分を含んでいます。放置すると素材が脆くなります。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=400" alt="ひび割れ" loading="lazy">
                        <div class="check-card__alert check-card__alert--danger">危険</div>
                    </div>
                    <h3 class="check-card__title">ひび割れ・欠け</h3>
                    <p class="check-card__text">雨水が侵入している状態です。雨漏り直前の危険信号です。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=400" alt="金属のサビ" loading="lazy">
                        <div class="check-card__alert check-card__alert--danger">危険</div>
                    </div>
                    <h3 class="check-card__title">金属部のサビ</h3>
                    <p class="check-card__text">板金やトタンのサビは穴あきの原因に。早急な処置が必要です。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--methods bg-gray">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">PAINT SELECTION</span>
                <h2 class="section-head__title">ご予算・目的に合わせた<span class="marker-blue">塗料選び</span></h2>
                <p class="section-head__desc">耐久年数とコストのバランスで選べる3つのグレードをご用意しました。</p>
            </div>

            <div class="methods-list">
                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&q=80&w=600" alt="シリコン塗料" loading="lazy">
                        <span class="method-badge">Standard</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">シリコン塗料</h3>
                            <span class="method-card__subtitle">コストパフォーマンス重視</span>
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
                            最も一般的で実績のある塗料です。カラーバリエーションも豊富で、初期費用を抑えつつ一定の耐久性を確保したい方に最適です。
                        </p>
                    </div>
                </article>

                <article class="method-card method-card--featured">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1632759145354-f424eb5b3f11?auto=format&fit=crop&q=80&w=600" alt="ラジカル塗料" loading="lazy">
                        <span class="method-badge method-badge--popular">人気 No.1</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">ラジカル制御塗料</h3>
                            <span class="method-card__subtitle">次世代のスタンダード</span>
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
                            紫外線による塗膜劣化を抑える新技術を採用。シリコンと変わらない価格帯で、ワンランク上の耐久性を実現した今一番選ばれている塗料です。
                        </p>
                    </div>
                </article>

                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1518481852452-9415b262eba4?auto=format&fit=crop&q=80&w=600" alt="フッ素・遮熱塗料" loading="lazy">
                        <span class="method-badge method-badge--strong">高機能</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">フッ素・遮熱塗料</h3>
                            <span class="method-card__subtitle">長持ち＆快適性を追求</span>
                        </div>
                        <div class="method-card__spec">
                            <dl>
                                <dt>耐久年数</dt>
                                <dd>15〜20年</dd>
                            </dl>
                            <dl>
                                <dt>機能性</dt>
                                <dd>遮熱効果</dd>
                            </dl>
                        </div>
                        <p class="method-card__desc">
                            東京ドーム等の大型建築にも使われる超高耐久塗料。遮熱効果のあるタイプなら、夏場の2階の室温上昇を抑え、光熱費削減にも貢献します。
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section section--price">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">PRICE PLANS</span>
                <h2 class="section-head__title">屋根材別<span class="marker-blue">料金プラン</span></h2>
                <p class="section-head__desc">
                    足場代・洗浄・下地補修・3回塗り・保証まで。<br>
                    すべて含んだ安心の「コミコミ価格」です。
                </p>
            </div>

            <div class="price-menu">
                <div class="price-card">
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&q=80&w=600" alt="スレート屋根" loading="lazy">
                        <div class="price-card__label">スレート屋根</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">ラジカル塗装プラン</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">19.8</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="price-card__note">※屋根面積 60㎡ / 足場代別途</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 高圧洗浄</li>
                            <li><i class="icon-check"></i> ひび割れ補修</li>
                            <li><i class="icon-check"></i> 縁切り（タスペーサー）</li>
                            <li><i class="icon-check"></i> 3回手塗り仕上げ</li>
                        </ul>
                    </div>
                </div>

                <div class="price-card price-card--featured">
                    <div class="price-card__badge">遮熱効果で快適</div>
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=600" alt="金属屋根" loading="lazy">
                        <div class="price-card__label">金属屋根（トタン・ガルバ）</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">遮熱シリコンプラン</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">22.0</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="price-card__note">※屋根面積 60㎡ / 足場代別途</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 高圧洗浄・ケレン</li>
                            <li><i class="icon-check"></i> 強力サビ止め</li>
                            <li><i class="icon-check"></i> 遮熱塗料2回塗り</li>
                            <li><i class="icon-check"></i> 釘浮き補修</li>
                        </ul>
                    </div>
                </div>

                <div class="price-card">
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=600" alt="瓦屋根" loading="lazy">
                        <div class="price-card__label">セメント瓦・モニエル瓦</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">高耐久フッ素プラン</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">26.8</span>
                            <span class="unit">万円〜</span>
                            <span class="tax">（税込）</span>
                        </div>
                        <p class="price-card__note">※屋根面積 60㎡ / 足場代別途</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 高圧トルネード洗浄</li>
                            <li><i class="icon-check"></i> 専用シーラー下塗り</li>
                            <li><i class="icon-check"></i> フッ素塗料2回塗り</li>
                            <li><i class="icon-check"></i> 漆喰チェック</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <p class="price-note text-center">
                ※上記価格は目安です。屋根の勾配（急勾配は割増）、現在の劣化状況により変動いたします。<br>
                正確な金額は現地調査の上、詳細なお見積り書にてご提示いたします。
            </p>
        </div>
    </section>

    <section class="section section--flow bg-light">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">WORK FLOW</span>
                <h2 class="section-head__title">施工の<span class="marker-blue">流れ</span></h2>
                <p class="section-head__desc">見えない部分だからこそ、工程ごとの写真を撮影し、<br>完了報告書として提出いたします。</p>
            </div>

            <div class="flow-steps">
                <div class="flow-step">
                    <div class="flow-step__num">01</div>
                    <div class="flow-step__content">
                        <h4>現地調査・診断</h4>
                        <p>専門家が屋根に上がり、劣化状況を詳しくチェック。最適なプランを作成します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">02</div>
                    <div class="flow-step__content">
                        <h4>足場架設・洗浄</h4>
                        <p>安全な足場を組み、長年の汚れを高圧洗浄で根こそぎ落とします。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">03</div>
                    <div class="flow-step__content">
                        <h4>下地調整・補修</h4>
                        <p>ひび割れ補修、金属部のサビ止め、縁切りなど、塗装前の重要な工程です。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">04</div>
                    <div class="flow-step__content">
                        <h4>3回塗り・検査</h4>
                        <p>下塗り・中塗り・上塗りを実施。完了検査後、足場を解体して引き渡しです。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    屋根のメンテナンス、<br>
                    <span class="highlight">気になった時</span>が始めどき。
                </h2>
                <p class="creative-bottom__text">
                    雨漏りしてからでは、修理費用が高額になってしまいます。<br>
                    まずは現在の屋根の状態を把握することから始めませんか？<br>
                    無理な営業は一切いたしません。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">まずは現状を知りたい方</span>
                            <span class="link-card__main">無料現地調査を予約</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <a href="<?php echo esc_url(home_url('/works/?category=roof')); ?>" class="link-card link-card--secondary">
                        <div class="link-card__icon">📷</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">ビフォーアフターを見る</span>
                            <span class="link-card__main">屋根塗装の施工事例</span>
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
:root {
    --c-primary: #1e3a5f; /* Deep Navy Blue for Roof */
    --c-primary-light: #4a6fa5;
    --c-accent: #e67e22; /* Burnt Orange for contrast */
    --c-text: #333333;
    --c-text-light: #666666;
    --c-bg-light: #f9f9f9;
    --c-bg-gray: #f0f4f8;
    --shadow-card: 0 10px 25px rgba(30, 58, 95, 0.08);
    --shadow-hover: 0 15px 35px rgba(30, 58, 95, 0.15);
    --radius-l: 16px;
    --radius-m: 8px;
    --font-base: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", sans-serif;
}

body {
    font-family: var(--font-base);
    color: var(--c-text);
    line-height: 1.6;
}

img {
    max-width: 100%;
    height: auto;
    vertical-align: bottom;
}

/* Utilities */
.text-center { text-align: center; }
.d-block { display: block; }
.bg-light { background-color: var(--c-bg-light); }
.bg-gray { background-color: var(--c-bg-gray); }
.text-gradient {
    background: linear-gradient(45deg, #fff, #a5c0e0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.marker-blue {
    background: linear-gradient(transparent 60%, rgba(30, 58, 95, 0.15) 60%);
    font-weight: bold;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Section Common */
.section { padding: 80px 0; }
.section-head { margin-bottom: 60px; }
.section-head__sub {
    display: block;
    color: var(--c-primary-light);
    font-weight: bold;
    font-size: 0.9rem;
    letter-spacing: 0.15em;
    margin-bottom: 10px;
    font-family: sans-serif;
}
.section-head__title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    color: var(--c-primary);
}
.section-head__desc {
    color: var(--c-text-light);
    max-width: 600px;
    margin: 0 auto;
}

/* Hero Visual */
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
    /* Zoom effect */
    animation: zoomSlow 20s infinite alternate;
}
@keyframes zoomSlow { from { transform: scale(1); } to { transform: scale(1.1); } }

.hero-visual__overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(to right, rgba(10, 25, 45, 0.8) 0%, rgba(30, 58, 95, 0.4) 100%);
}
.hero-visual__content {
    position: relative;
    z-index: 1;
    max-width: 700px;
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
}
.hero-visual__title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 25px;
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
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(5px);
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid rgba(255,255,255,0.2);
}
.trust-badge i { color: #64ffda; }
.hero-visual__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

/* Trouble Check Grid */
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
.check-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }

.check-card__img {
    position: relative;
    border-radius: var(--radius-l) var(--radius-l) 0 0;
    overflow: hidden;
    margin-bottom: 15px;
    aspect-ratio: 4/3;
}
.check-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

.check-card__title {
    font-size: 1.15rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--c-primary);
}
.check-card__text {
    font-size: 0.9rem;
    color: var(--c-text-light);
    padding: 0 15px;
    line-height: 1.6;
}

/* Methods (Grades) */
.methods-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}
.method-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: transform 0.3s;
    border: 1px solid #eee;
}
.method-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
.method-card--featured {
    border: 2px solid var(--c-primary-light);
    transform: scale(1.02);
}
.method-card--featured:hover { transform: scale(1.02) translateY(-5px); }

.method-card__visual {
    position: relative;
    height: 200px;
}
.method-card__visual img {
    width: 100%; height: 100%; object-fit: cover;
}
.method-badge {
    position: absolute;
    top: 15px; left: 15px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 5px 12px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: bold;
}
.method-badge--popular { background: var(--c-accent); }
.method-badge--strong { background: var(--c-primary); }

.method-card__content { padding: 25px; }
.method-card__header { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
.method-card__title {
    font-size: 1.3rem;
    font-weight: bold;
    color: var(--c-primary);
    margin-bottom: 5px;
}
.method-card__subtitle {
    display: block;
    font-size: 0.85rem;
    color: var(--c-text-light);
    font-weight: bold;
}
.method-card__spec {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    background: var(--c-bg-light);
    padding: 10px;
    border-radius: var(--radius-m);
}
.method-card__spec dl { margin: 0; text-align: center; width: 48%; }
.method-card__spec dt { font-size: 0.75rem; color: var(--c-text-light); margin-bottom: 3px; }
.method-card__spec dd { font-size: 1rem; font-weight: bold; margin: 0; color: var(--c-primary); }

.method-card__desc {
    font-size: 0.95rem;
    line-height: 1.7;
    color: var(--c-text);
}

/* Price Menu (Photo Card Style) */
.price-menu {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
    align-items: flex-start;
}
.price-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    border: 1px solid #eee;
    transition: transform 0.3s;
}
.price-card:hover { transform: translateY(-5px); }

.price-card--featured {
    border: 2px solid var(--c-primary);
    position: relative;
    z-index: 1;
    transform: scale(1.03);
}
.price-card--featured:hover { transform: scale(1.03) translateY(-5px); }

.price-card__badge {
    position: absolute;
    top: 0; right: 0;
    background: var(--c-primary);
    color: #fff;
    padding: 6px 15px;
    font-size: 0.85rem;
    font-weight: bold;
    border-bottom-left-radius: 10px;
    z-index: 2;
}

.price-card__image-holder {
    position: relative;
    height: 180px;
}
.price-card__image-holder img {
    width: 100%; height: 100%; object-fit: cover;
}
.price-card__label {
    position: absolute;
    bottom: 0; left: 0; width: 100%;
    background: linear-gradient(to top, rgba(30, 58, 95, 0.9), transparent);
    color: #fff;
    padding: 20px 20px 10px;
    font-weight: bold;
    font-size: 1.1rem;
}

.price-card__body { padding: 25px; text-align: center; }
.price-card__plan {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--c-primary);
}
.price-card__price {
    color: var(--c-accent);
    margin-bottom: 5px;
    font-family: sans-serif;
}
.price-card__price .yen { font-size: 1.2rem; font-weight: bold; vertical-align: top; }
.price-card__price .amount { font-size: 2.8rem; font-weight: 800; line-height: 1; letter-spacing: -1px; }
.price-card__price .unit { font-size: 1.2rem; font-weight: bold; }
.price-card__price .tax { font-size: 0.8rem; font-weight: normal; color: var(--c-text-light); display: block; margin-top: 5px;}
.price-card__note { font-size: 0.8rem; color: var(--c-text-light); margin-bottom: 15px; }

.price-card__divider {
    border: 0; border-top: 1px dashed #ddd; margin: 15px 0;
}
.price-card__includes {
    list-style: none; padding: 0; margin: 0; text-align: left;
}
.price-card__includes li {
    font-size: 0.95rem;
    margin-bottom: 10px;
    position: relative;
    padding-left: 24px;
    color: var(--c-text);
}
.price-card__includes li i {
    position: absolute; left: 0; top: 4px;
    color: var(--c-primary); font-size: 0.9rem;
}

.price-note { font-size: 0.9rem; color: var(--c-text-light); margin-top: 20px; }

/* Flow */
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
    border-top: 4px solid var(--c-primary);
}
.flow-step__num {
    display: inline-block;
    width: 40px; height: 40px;
    line-height: 40px;
    background: var(--c-primary);
    color: #fff;
    border-radius: 50%;
    font-weight: bold;
    margin-bottom: 15px;
    box-shadow: 0 3px 8px rgba(30, 58, 95, 0.3);
}
.flow-step h4 { font-size: 1.1rem; margin-bottom: 10px; font-weight: bold; color: var(--c-primary); }
.flow-step p { font-size: 0.9rem; color: var(--c-text-light); line-height: 1.6; }

/* Creative Bottom (Soft Link) */
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
    color: var(--c-primary);
}
.creative-bottom__title .highlight {
    background: linear-gradient(transparent 60%, rgba(230, 126, 34, 0.2) 60%);
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
    border-color: var(--c-primary-light);
}
.link-card__icon { font-size: 1.5rem; }
.link-card__content { text-align: left; }
.link-card__sub { display: block; font-size: 0.75rem; color: var(--c-text-light); margin-bottom: 2px; }
.link-card__main { display: block; font-size: 1.1rem; font-weight: bold; color: var(--c-primary); }
.link-card__arrow { margin-left: auto; color: var(--c-primary-light); font-weight: bold; }

.link-card--secondary .link-card__main { color: var(--c-text); }

/* Responsive */
@media (max-width: 768px) {
    .hero-visual__title { font-size: 2.2rem; }
    .hero-visual { height: 500px; }
    .trust-badges { justify-content: center; }
    .price-card--featured { transform: none; }
    .price-card--featured:hover { transform: translateY(-5px); }
    .flow-steps { flex-direction: column; }
    .flow-step { text-align: left; display: flex; align-items: flex-start; gap: 15px; }
    .flow-step__num { margin-bottom: 0; flex-shrink: 0; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
</style>