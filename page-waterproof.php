<?php
/**
 * Template Name: 防水工事サービスページ（Photo Focused）
 * Template Post Type: page, service
 * Description: 写真活用を前提とした防水工事詳細ページ - 料金表・工法提案強化版
 * Author: Senior WordPress Engineer
 * Version: 3.0.0
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

// 構造化データ（CTA削除に伴い、最低限のサービス情報のみ保持）
$schema_service = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => '防水工事',
    'description' => '御殿場市・静岡県東部エリアの防水工事専門。ベランダ・屋上・外壁の雨漏り対策から大規模防水まで対応。',
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
    'serviceType' => '防水工事',
];
?>

<script type="application/ld+json">
<?php echo wp_json_encode($schema_service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>

<main id="main" class="service-page service-page--photo-focused" role="main">

    <section class="hero-visual">
        <div class="hero-visual__bg">
            <div class="hero-visual__image" style="background-image: url('https://images.unsplash.com/photo-1517646287270-a5a9ca602e5c?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="hero-visual__overlay"></div>
        </div>
        
        <div class="container">
            <div class="hero-visual__content">
                <span class="hero-visual__tag">WATERPROOFING</span>
                <h1 class="hero-visual__title">
                    <span class="d-block">雨から家を守る、</span>
                    <span class="d-block text-gradient">確かな防水技術。</span>
                </h1>
                <p class="hero-visual__lead">
                    一級防水施工技能士が提案する、<br>
                    美観と耐久性を兼ね備えた「本物」の施工。
                </p>
                <div class="trust-badges">
                    <span class="trust-badge"><i class="icon-check">✓</i> 最長<?php echo esc_html($warranty_years); ?>年保証</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 資格者施工</span>
                    <span class="trust-badge"><i class="icon-check">✓</i> 賠償保険加入</span>
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
                <h2 class="section-head__title">このような<span class="marker-blue">症状</span>はありませんか？</h2>
                <p class="section-head__desc">防水層の劣化サインを見逃すと、建物内部の腐食につながります。</p>
            </div>

            <div class="check-grid">
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&q=80&w=400" alt="雨漏りシミ" loading="lazy">
                        <div class="check-card__alert">危険</div>
                    </div>
                    <h3 class="check-card__title">天井・壁のシミ</h3>
                    <p class="check-card__text">雨水が侵入している確実な証拠です。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=400" alt="ひび割れ" loading="lazy">
                        <div class="check-card__alert">注意</div>
                    </div>
                    <h3 class="check-card__title">床面のひび割れ</h3>
                    <p class="check-card__text">表面の防水層が切れている状態です。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&q=80&w=400" alt="水たまり" loading="lazy">
                        <div class="check-card__alert">注意</div>
                    </div>
                    <h3 class="check-card__title">水たまり・コケ</h3>
                    <p class="check-card__text">排水不良や勾配の問題が考えられます。</p>
                </div>
                <div class="check-card">
                    <div class="check-card__img">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=400" alt="ドレン詰まり" loading="lazy">
                        <div class="check-card__alert">注意</div>
                    </div>
                    <h3 class="check-card__title">排水溝のサビ</h3>
                    <p class="check-card__text">ドレン周りの劣化は雨漏りの主原因です。</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--methods bg-gray">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">OUR METHODS</span>
                <h2 class="section-head__title">最適な<span class="marker-blue">防水工法</span>をご提案</h2>
                <p class="section-head__desc">建物の構造や用途、既存の状態に合わせてベストな工法を選定します。</p>
            </div>

            <div class="methods-list">
                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=600" alt="ウレタン防水施工例" loading="lazy">
                        <span class="method-badge method-badge--popular">人気 No.1</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">ウレタン防水</h3>
                            <span class="method-card__subtitle">あらゆる形状に対応する万能工法</span>
                        </div>
                        <p class="method-card__desc">
                            液状の防水材を塗布して層を作る工法です。複雑な形状のベランダや、室外機などの障害物がある場所でも継ぎ目のない完全な防水層を形成できます。
                        </p>
                        <ul class="method-card__features">
                            <li>継ぎ目なし</li>
                            <li>複雑な形状OK</li>
                            <li>コスト◎</li>
                        </ul>
                    </div>
                </article>

                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&q=80&w=600" alt="FRP防水施工例" loading="lazy">
                        <span class="method-badge method-badge--strong">高強度</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">FRP防水</h3>
                            <span class="method-card__subtitle">ガラス繊維で固める最強の防水</span>
                        </div>
                        <p class="method-card__desc">
                            強化プラスチック（FRP）を使用した被覆防水層を形成します。軽量かつ強靭で、歩行頻度の高いベランダや屋上に適しています。
                        </p>
                        <ul class="method-card__features">
                            <li>超高耐久</li>
                            <li>摩耗に強い</li>
                            <li>工期が短い</li>
                        </ul>
                    </div>
                </article>

                <article class="method-card">
                    <div class="method-card__visual">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80&w=600" alt="シート防水施工例" loading="lazy">
                        <span class="method-badge">広範囲</span>
                    </div>
                    <div class="method-card__content">
                        <div class="method-card__header">
                            <h3 class="method-card__title">シート防水</h3>
                            <span class="method-card__subtitle">広い屋上を効率よくカバー</span>
                        </div>
                        <p class="method-card__desc">
                            ゴムや塩ビのシートを貼り付ける工法です。工場生産されたシートを使用するため品質が均一で、広い面積の屋上防水に適しています。
                        </p>
                        <ul class="method-card__features">
                            <li>品質安定</li>
                            <li>広範囲に最適</li>
                            <li>対候性◎</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section section--price">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">PRICE GUIDE</span>
                <h2 class="section-head__title">場所別<span class="marker-blue">料金目安</span></h2>
                <p class="section-head__desc">「どこを直すといくらかかる？」<br>写真付きの目安プランをご紹介します。</p>
            </div>

            <div class="price-menu">
                <div class="price-card">
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&q=80&w=600" alt="ベランダ防水" loading="lazy">
                        <div class="price-card__label">ベランダ・バルコニー</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">ウレタン密着工法</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">75,000</span>
                            <span class="tax">（税込）〜</span>
                        </div>
                        <p class="price-card__note">※広さ10㎡以下の場合の目安</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 高圧洗浄</li>
                            <li><i class="icon-check"></i> 下地補修（軽微）</li>
                            <li><i class="icon-check"></i> ウレタン防水塗布</li>
                            <li><i class="icon-check"></i> トップコート仕上げ</li>
                        </ul>
                    </div>
                </div>

                <div class="price-card price-card--featured">
                    <div class="price-card__badge">おすすめ</div>
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1632759145354-f424eb5b3f11?auto=format&fit=crop&q=80&w=600" alt="屋上防水" loading="lazy">
                        <div class="price-card__label">戸建て 屋上</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">通気緩衝工法</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">250,000</span>
                            <span class="tax">（税込）〜</span>
                        </div>
                        <p class="price-card__note">※広さ30〜50㎡程度の場合の目安</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 高圧洗浄</li>
                            <li><i class="icon-check"></i> 下地調整・補修</li>
                            <li><i class="icon-check"></i> 通気シート貼り</li>
                            <li><i class="icon-check"></i> 脱気筒設置</li>
                            <li><i class="icon-check"></i> ウレタン防水・トップ</li>
                        </ul>
                    </div>
                </div>

                <div class="price-card">
                    <div class="price-card__image-holder">
                        <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&q=80&w=600" alt="トップコート塗り替え" loading="lazy">
                        <div class="price-card__label">メンテナンス</div>
                    </div>
                    <div class="price-card__body">
                        <h3 class="price-card__plan">トップコート塗り替え</h3>
                        <div class="price-card__price">
                            <span class="yen">¥</span>
                            <span class="amount">35,000</span>
                            <span class="tax">（税込）〜</span>
                        </div>
                        <p class="price-card__note">※ベランダ1箇所あたりの目安</p>
                        <hr class="price-card__divider">
                        <ul class="price-card__includes">
                            <li><i class="icon-check"></i> 表面洗浄・清掃</li>
                            <li><i class="icon-check"></i> プライマー塗布</li>
                            <li><i class="icon-check"></i> トップコート塗布</li>
                            <li><i class="icon-check"></i> ※防水層保護のため5年推奨</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <p class="price-note text-center">
                ※上記価格は目安です。下地の劣化状況、荷物の移動有無、足場の必要性などにより変動いたします。<br>
                正確な金額は現地調査の上、お見積り書にてご提示いたします。
            </p>
        </div>
    </section>

    <section class="section section--flow bg-light">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">WORK FLOW</span>
                <h2 class="section-head__title">施工の<span class="marker-blue">流れ</span></h2>
            </div>

            <div class="flow-steps">
                <div class="flow-step">
                    <div class="flow-step__num">01</div>
                    <div class="flow-step__content">
                        <h4>現地調査・診断</h4>
                        <p>雨漏りの原因や防水層の状態をプロが診断します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">02</div>
                    <div class="flow-step__content">
                        <h4>お見積り提出</h4>
                        <p>最適な工法と適正価格をご提案。内訳も明確です。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">03</div>
                    <div class="flow-step__content">
                        <h4>防水工事施工</h4>
                        <p>近隣への配慮を行い、有資格者が丁寧に施工します。</p>
                    </div>
                </div>
                <div class="flow-step">
                    <div class="flow-step__num">04</div>
                    <div class="flow-step__content">
                        <h4>完了検査・保証書</h4>
                        <p>仕上がりを確認後、保証書を発行してお引き渡しです。</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
:root {
    --c-primary: #0066cc;
    --c-primary-dark: #004c99;
    --c-secondary: #00b3b3;
    --c-accent: #ff9900;
    --c-text: #333333;
    --c-text-light: #666666;
    --c-bg-light: #f9f9f9;
    --c-bg-gray: #f0f4f8;
    --shadow-card: 0 10px 25px rgba(0,0,0,0.05);
    --shadow-hover: 0 15px 35px rgba(0,0,0,0.1);
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
    background: linear-gradient(45deg, var(--c-primary), var(--c-secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.marker-blue {
    background: linear-gradient(transparent 60%, rgba(0, 102, 204, 0.2) 60%);
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
    color: var(--c-primary);
    font-weight: bold;
    font-size: 0.9rem;
    letter-spacing: 0.15em;
    margin-bottom: 10px;
}
.section-head__title {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 15px;
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
    filter: brightness(0.8);
}
.hero-visual__overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.1) 100%);
}
.hero-visual__content {
    position: relative;
    z-index: 1;
    max-width: 700px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
.hero-visual__tag {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(5px);
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.3);
}
.hero-visual__title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 20px;
}
.hero-visual__title .text-gradient {
    background: linear-gradient(45deg, #fff, #b3e0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.hero-visual__lead {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 30px;
    opacity: 0.9;
}
.trust-badges {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}
.trust-badge {
    background: rgba(0,0,0,0.5);
    padding: 8px 15px;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 5px;
}
.trust-badge i { color: #00ff99; }
.hero-visual__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
}

/* Trouble Check */
.check-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}
.check-card {
    text-align: center;
}
.check-card__img {
    position: relative;
    border-radius: var(--radius-l);
    overflow: hidden;
    margin-bottom: 15px;
    box-shadow: var(--shadow-card);
    aspect-ratio: 4/3;
}
.check-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s;
}
.check-card:hover .check-card__img img {
    transform: scale(1.05);
}
.check-card__alert {
    position: absolute;
    top: 10px; right: 10px;
    background: #ff4d4d;
    color: #fff;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: bold;
}
.check-card__title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 5px;
}
.check-card__text {
    font-size: 0.9rem;
    color: var(--c-text-light);
}

/* Methods (Photo Focused) */
.methods-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 40px;
}
.method-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: transform 0.3s;
}
.method-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
.method-card__visual {
    position: relative;
    height: 220px;
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
.method-card__header { margin-bottom: 15px; }
.method-card__title {
    font-size: 1.4rem;
    font-weight: bold;
    color: var(--c-primary);
    margin-bottom: 5px;
}
.method-card__subtitle {
    display: block;
    font-size: 0.9rem;
    color: var(--c-text-light);
    font-weight: bold;
}
.method-card__desc {
    font-size: 0.95rem;
    margin-bottom: 20px;
    line-height: 1.7;
}
.method-card__features {
    list-style: none;
    padding: 0; margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.method-card__features li {
    background: var(--c-bg-gray);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    color: var(--c-text);
}

/* Price Menu (Card Style) */
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
    transform: scale(1.03);
    position: relative;
    z-index: 1;
}
.price-card--featured:hover { transform: scale(1.03) translateY(-5px); }

.price-card__badge {
    position: absolute;
    top: 0; right: 0;
    background: var(--c-primary);
    color: #fff;
    padding: 5px 15px;
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
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: #fff;
    padding: 20px 20px 10px;
    font-weight: bold;
    font-size: 1.1rem;
}

.price-card__body { padding: 25px; text-align: center; }
.price-card__plan {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--c-text);
}
.price-card__price {
    color: var(--c-primary);
    margin-bottom: 5px;
}
.price-card__price .yen { font-size: 1.2rem; font-weight: bold; vertical-align: top; }
.price-card__price .amount { font-size: 2.5rem; font-weight: 800; line-height: 1; letter-spacing: -1px; }
.price-card__price .tax { font-size: 0.9rem; font-weight: normal; color: var(--c-text-light); }
.price-card__note { font-size: 0.8rem; color: var(--c-text-light); margin-bottom: 15px; }

.price-card__divider {
    border: 0; border-top: 1px dashed #ddd; margin: 15px 0;
}
.price-card__includes {
    list-style: none; padding: 0; margin: 0; text-align: left;
}
.price-card__includes li {
    font-size: 0.9rem;
    margin-bottom: 8px;
    position: relative;
    padding-left: 20px;
}
.price-card__includes li i {
    position: absolute; left: 0; top: 4px;
    color: var(--c-primary); font-size: 0.8rem;
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
    padding: 20px;
    border-radius: var(--radius-m);
    box-shadow: var(--shadow-card);
    position: relative;
    text-align: center;
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
}
.flow-step h4 { font-size: 1.1rem; margin-bottom: 10px; font-weight: bold; }
.flow-step p { font-size: 0.9rem; color: var(--c-text-light); }

/* Responsive */
@media (max-width: 768px) {
    .hero-visual__title { font-size: 2.5rem; }
    .hero-visual { height: 500px; }
    .price-card--featured { transform: none; }
    .flow-steps { flex-direction: column; }
    .flow-step { text-align: left; display: flex; align-items: flex-start; gap: 15px; }
    .flow-step__num { margin-bottom: 0; flex-shrink: 0; }
}
</style>

<?php get_footer(); ?>