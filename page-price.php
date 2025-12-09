<?php
/**
 * Template Name: 料金一覧ページ
 * Template Post Type: page
 * Description: 料金シミュレーション機能付きの総合料金表ページ
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
$phone_link   = sato_get_phone_link();
$line_url     = sato_get_line_url();

?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "PriceSpecification",
    "name": "外壁塗装・屋根塗装 料金表",
    "description": "<?php echo esc_js($company_name); ?>の塗装工事、防水工事、補修工事の標準価格表です。",
    "priceCurrency": "JPY",
    "minPrice": "498000",
    "maxPrice": "1200000",
    "provider": {
        "@type": "LocalBusiness",
        "name": "<?php echo esc_js($company_name); ?>"
    }
}
</script>

<main id="main" class="price-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">料金案内</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">PRICE LIST</span>
                <h1 class="page-header__title">料金案内</h1>
                <p class="page-header__lead">
                    安さだけではなく、<br class="sp-only">「長持ち」する品質を適正価格で。<br>
                    足場代から保証まで含んだ<br class="sp-only">わかりやすいパック料金です。
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#f8fafc"/></svg>
        </div>
    </section>

    <section class="section section--simulation">
        <div class="service-container">
            <div class="simulator-box">
                <div class="simulator-header">
                    <h2 class="simulator-title">
                        <span class="icon">🖩</span> 
                        外壁塗装<span class="highlight">10秒見積もり</span>シミュレーション
                    </h2>
                    <p class="simulator-desc">
                        建物の坪数と塗料グレードを選ぶだけで、概算費用がわかります。<br>
                        ※足場代・洗浄・下地処理を含んだ目安金額です。
                    </p>
                </div>

                <div class="simulator-body">
                    <div class="simulator-form">
                        <div class="form-group">
                            <label>建物の坪数（延床面積）</label>
                            <div class="range-wrap">
                                <input type="range" id="sim-size" min="20" max="60" step="5" value="30">
                                <div class="range-value"><span id="sim-size-val">30</span> 坪</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>希望する塗料グレード</label>
                            <div class="radio-group">
                                <label class="radio-card">
                                    <input type="radio" name="sim-grade" value="1.0" checked>
                                    <span class="radio-card__inner">
                                        <span class="grade">シリコン</span>
                                        <span class="durability">耐久 8-10年</span>
                                    </span>
                                </label>
                                <label class="radio-card featured">
                                    <input type="radio" name="sim-grade" value="1.2">
                                    <span class="radio-card__inner">
                                        <span class="badge">人気</span>
                                        <span class="grade">ラジカル</span>
                                        <span class="durability">耐久 12-15年</span>
                                    </span>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="sim-grade" value="1.5">
                                    <span class="radio-card__inner">
                                        <span class="grade">フッ素/無機</span>
                                        <span class="durability">耐久 15年以上</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="simulator-result">
                        <p class="result-label">工事費用の目安（税込）</p>
                        <div class="result-price">
                            <span class="prefix">約</span>
                            <span id="sim-result">60</span>
                            <span class="suffix">万円</span>
                        </div>
                        <p class="result-note">※建物の形状や劣化状況により変動します。正確な金額は現地調査にて算出いたします。</p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--block">
                            この条件で詳しく見積もる
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--exterior bg-gray">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">EXTERIOR</span>
                <h2 class="section-head__title">外壁塗装の<span class="marker-blue">パック料金</span></h2>
                <p class="section-head__desc">
                    足場・高圧洗浄・下地補修・3回塗り・保証まで全て含んだ安心価格。<br>
                    追加料金は原則発生しません。（30坪基準）
                </p>
            </div>

            <div class="price-grid">
                <div class="menu-card">
                    <div class="menu-card__image"><img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&q=80&w=600" alt="エコノミー" loading="lazy"><div class="menu-card__label">シリコンプラン</div></div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">エコノミーパック</h3>
                        <p class="menu-card__desc">コストを抑えつつ基本性能を確保。こまめに塗り替えたい方に。</p>
                        <div class="menu-card__price"><span class="yen">¥</span><span class="num">49.8</span><span class="unit">万円〜</span><span class="tax">（税込）</span></div>
                        <div class="menu-card__details"><ul><li>耐用年数：8〜10年</li><li>保証期間：5年</li><li>コスト：★☆☆☆☆</li></ul></div>
                    </div>
                </div>
                <div class="menu-card menu-card--recommend">
                    <div class="recommend-badge">コスパ No.1</div>
                    <div class="menu-card__image"><img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=600" alt="スタンダード" loading="lazy"><div class="menu-card__label">ラジカルプラン</div></div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">スタンダードパック</h3>
                        <p class="menu-card__desc">最新技術で紫外線劣化を抑制。価格と耐久性のバランスが最高です。</p>
                        <div class="menu-card__price"><span class="yen">¥</span><span class="num">59.8</span><span class="unit">万円〜</span><span class="tax">（税込）</span></div>
                        <div class="menu-card__details"><ul><li>耐用年数：12〜15年</li><li>保証期間：7年</li><li>コスト：★★★☆☆</li></ul></div>
                    </div>
                </div>
                <div class="menu-card">
                    <div class="menu-card__image"><img src="https://images.unsplash.com/photo-1600607687644-c7171b42498b?auto=format&fit=crop&q=80&w=600" alt="プレミアム" loading="lazy"><div class="menu-card__label">フッ素・無機プラン</div></div>
                    <div class="menu-card__content">
                        <h3 class="menu-card__title">プレミアムパック</h3>
                        <p class="menu-card__desc">圧倒的な耐久性。長期間メンテナンス不要でトータルコストはお得。</p>
                        <div class="menu-card__price"><span class="yen">¥</span><span class="num">74.8</span><span class="unit">万円〜</span><span class="tax">（税込）</span></div>
                        <div class="menu-card__details"><ul><li>耐用年数：15年以上</li><li>保証期間：10年</li><li>コスト：★★★★★</li></ul></div>
                    </div>
                </div>
            </div>
            
            <div class="price-table-wrap">
                <h3 class="price-table-title">坪数別 料金早見表（ラジカル塗料の場合）</h3>
                <table class="price-table">
                    <thead>
                        <tr>
                            <th>坪数（延床面積）</th>
                            <th>20坪</th>
                            <th>30坪</th>
                            <th>40坪</th>
                            <th>50坪</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>価格目安（税込）</th>
                            <td>約45万円〜</td>
                            <td class="highlight">約60万円〜</td>
                            <td>約75万円〜</td>
                            <td>約90万円〜</td>
                        </tr>
                    </tbody>
                </table>
                <p class="price-note">※上記は「外壁塗装のみ」の概算です。屋根塗装を同時に行う場合、足場代が節約でき、セット割引が適用されます。</p>
            </div>
        </div>
    </section>

    <section class="section section--roof">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">ROOF</span>
                <h2 class="section-head__title">屋根塗装の<span class="marker-orange">料金プラン</span></h2>
                <p class="section-head__desc">過酷な環境の屋根こそ、遮熱・断熱塗料での保護をおすすめします。</p>
            </div>

            <div class="price-list-row">
                <div class="price-item">
                    <div class="price-item__head">
                        <h3>シリコン塗装</h3>
                        <span class="price">19.8<small>万円〜</small></span>
                    </div>
                    <p class="price-item__desc">コストを抑えたい方に。一般的なスレート屋根の塗り替え。</p>
                </div>
                <div class="price-item price-item--rec">
                    <div class="badge">おすすめ</div>
                    <div class="price-item__head">
                        <h3>遮熱シリコン塗装</h3>
                        <span class="price">24.8<small>万円〜</small></span>
                    </div>
                    <p class="price-item__desc">夏の2階の暑さを軽減。省エネ効果も期待できる人気プラン。</p>
                </div>
                <div class="price-item">
                    <div class="price-item__head">
                        <h3>フッ素・無機塗装</h3>
                        <span class="price">29.8<small>万円〜</small></span>
                    </div>
                    <p class="price-item__desc">最高レベルの耐久性。紫外線が強い地域に最適です。</p>
                </div>
            </div>
            <p class="price-note text-center">※屋根面積60㎡想定の価格です。勾配（傾斜）がきつい場合は別途足場費用がかかる場合があります。</p>
        </div>
    </section>

    <section class="section section--other bg-gray">
        <div class="service-container">
            <div class="grid-2col">
                <div class="other-price-box">
                    <h3 class="box-title">
                        <span class="icon">💧</span> 防水工事
                    </h3>
                    <ul class="price-list-simple">
                        <li>
                            <span class="label">ベランダトップコート</span>
                            <span class="price">30,000<small>円〜 / 1箇所</small></span>
                        </li>
                        <li>
                            <span class="label">ウレタン防水（密着工法）</span>
                            <span class="price">5,500<small>円〜 / ㎡</small></span>
                        </li>
                        <li>
                            <span class="label">FRP防水（改修）</span>
                            <span class="price">6,500<small>円〜 / ㎡</small></span>
                        </li>
                    </ul>
                </div>

                <div class="other-price-box">
                    <h3 class="box-title">
                        <span class="icon">🛠</span> 補修・修繕
                    </h3>
                    <ul class="price-list-simple">
                        <li>
                            <span class="label">シーリング打ち替え</span>
                            <span class="price">800<small>円〜 / m</small></span>
                        </li>
                        <li>
                            <span class="label">シーリング増し打ち</span>
                            <span class="price">500<small>円〜 / m</small></span>
                        </li>
                        <li>
                            <span class="label">雨漏り調査・修理</span>
                            <span class="price">30,000<small>円〜</small></span>
                        </li>
                        <li>
                            <span class="label">雨樋・破風板塗装</span>
                            <span class="price">別途お見積り</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section section--common">
        <div class="service-container">
            <div class="section-head text-center">
                <span class="section-head__sub">DETAILS</span>
                <h2 class="section-head__title">共通工事・オプション</h2>
                <p class="section-head__desc">塗装工事に伴う付帯工事の単価目安です。</p>
            </div>

            <div class="common-table-wrap">
                <table class="common-table">
                    <tr>
                        <th>仮設足場</th>
                        <td>800円〜 / ㎡</td>
                        <td>安全性と施工品質確保のため必須です。飛散防止ネット含む。</td>
                    </tr>
                    <tr>
                        <th>高圧洗浄</th>
                        <td>200円〜 / ㎡</td>
                        <td>長年の汚れ、カビ、コケを洗い流し、塗料の密着を良くします。</td>
                    </tr>
                    <tr>
                        <th>バイオ洗浄</th>
                        <td>400円〜 / ㎡</td>
                        <td>しつこいカビやコケを根元から分解・除去する特殊洗浄です。</td>
                    </tr>
                    <tr>
                        <th>軒天塗装</th>
                        <td>1,000円〜 / m</td>
                        <td>屋根の裏側部分。湿気に強い塗料を使用します。</td>
                    </tr>
                    <tr>
                        <th>雨樋塗装</th>
                        <td>1,200円〜 / m</td>
                        <td>紫外線で劣化しやすい塩ビを守り、美観を整えます。</td>
                    </tr>
                </table>
            </div>
            
            <div class="price-alert">
                <h4 class="alert-title">⚠️ お見積りに関するご注意</h4>
                <p>
                    上記価格はあくまで「目安」です。実際の価格は、建物の劣化状況、使用する塗料の種類、塗装範囲、足場の架け方などによって変動いたします。<br>
                    <?php echo esc_html($company_name); ?>では、現地調査を行った上で、お客様のご要望とご予算に合わせた<strong>「正確で分かりやすいお見積書」</strong>を無料で作成しております。<br>
                    追加料金のかからない明朗会計をお約束しますので、まずはお気軽にご相談ください。
                </p>
            </div>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    正確な金額を知りたい方へ。<br>
                    <span class="highlight">無料お見積り</span>実施中
                </h2>
                <p class="creative-bottom__text">
                    「他社との比較見積もり」も大歓迎です。<br>
                    プロの目でお家を診断し、最適なプランをご提案します。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">現地調査を依頼</span>
                            <span class="link-card__main">無料診断・見積り予約</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="link-card link-card--line" target="_blank" rel="noopener noreferrer">
                        <div class="link-card__icon">💬</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">写真を送って概算見積もり</span>
                            <span class="link-card__main">LINEで相談する</span>
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
/* Variables (Unified) */
:root {
    --c-prm: #0d47a1;
    --c-acc: #f59e0b;
    --c-txt: #333;
    --c-bg-gray: #f8fafc;
    --radius-l: 16px;
    --radius-m: 8px;
    --shadow-card: 0 4px 6px -1px rgba(0,0,0,0.05);
    --container-max: 1200px;
    --container-pad: 20px;
}

/* Base */
body { font-family: "Helvetica Neue", Arial, sans-serif; color: var(--c-txt); line-height: 1.6; }
img { max-width: 100%; height: auto; }
.bg-gray { background-color: var(--c-bg-gray); }
.text-center { text-align: center; }
.service-container { max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-pad); box-sizing: border-box; }
.sp-only { display: none; }
@media (max-width: 768px) { .sp-only { display: inline; } }

/* Section Header */
.section { padding: 80px 0; }
.section-head { margin-bottom: 60px; }
.section-head__sub { display: block; color: var(--c-prm); font-weight: bold; letter-spacing: 0.1em; font-size: 0.9rem; margin-bottom: 10px; font-family: "DIN Alternate", sans-serif; }
.section-head__title { font-size: 2.2rem; font-weight: bold; margin-bottom: 15px; color: #1a202c; }
.section-head__desc { color: #666; max-width: 600px; margin: 0 auto; }
.marker-blue { background: linear-gradient(transparent 60%, rgba(13, 71, 161, 0.15) 60%); }
.marker-orange { background: linear-gradient(transparent 60%, rgba(245, 158, 11, 0.2) 60%); }
.marker-green { background: linear-gradient(transparent 60%, rgba(16, 185, 129, 0.2) 60%); }

/* Page Header */
.page-header { position: relative; padding: 120px 0 80px; color: #fff; overflow: hidden; background-color: var(--c-prm); }
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
.breadcrumb__separator { opacity: 0.5; }

/* Simulator */
.simulator-box {
    background: #fff;
    border-radius: var(--radius-l);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 900px;
    margin: 0 auto;
    border: 1px solid #e2e8f0;
}
.simulator-header {
    background: linear-gradient(135deg, var(--c-prm) 0%, #1e40af 100%);
    padding: 30px;
    color: #fff;
    text-align: center;
}
.simulator-title { font-size: 1.8rem; font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 10px; }
.simulator-title .icon { font-size: 2rem; }
.simulator-title .highlight { color: #ffd700; }
.simulator-desc { font-size: 0.9rem; opacity: 0.9; }

.simulator-body { padding: 40px; display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px; }
.form-group { margin-bottom: 30px; }
.form-group label { display: block; font-weight: bold; margin-bottom: 15px; color: var(--c-prm); font-size: 1.1rem; }

/* Range Slider */
.range-wrap { display: flex; align-items: center; gap: 20px; }
input[type=range] { flex: 1; -webkit-appearance: none; width: 100%; background: transparent; }
input[type=range]::-webkit-slider-thumb { -webkit-appearance: none; height: 24px; width: 24px; border-radius: 50%; background: var(--c-acc); cursor: pointer; margin-top: -10px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 4px; cursor: pointer; background: #e2e8f0; border-radius: 2px; }
.range-value { font-size: 2rem; font-weight: bold; color: var(--c-prm); font-family: "DIN Alternate", sans-serif; width: 100px; text-align: right; }

/* Radio Cards */
.radio-group { display: flex; flex-direction: column; gap: 10px; }
.radio-card { position: relative; cursor: pointer; }
.radio-card input { position: absolute; opacity: 0; }
.radio-card__inner {
    display: flex; justify-content: space-between; align-items: center;
    padding: 15px 20px; border: 2px solid #e2e8f0; border-radius: 8px;
    transition: 0.2s;
}
.radio-card input:checked + .radio-card__inner {
    border-color: var(--c-prm); background: #f0f7ff; color: var(--c-prm);
}
.radio-card.featured input:checked + .radio-card__inner {
    border-color: var(--c-acc); background: #fffbeb; color: #b45309;
}
.radio-card .grade { font-weight: bold; font-size: 1.1rem; }
.radio-card .durability { font-size: 0.85rem; color: #666; }
.radio-card input:checked + .radio-card__inner .durability { color: inherit; }
.radio-card .badge { 
    position: absolute; top: -10px; right: 10px; 
    background: #e53e3e; color: #fff; font-size: 0.7rem; padding: 2px 8px; border-radius: 4px; 
}

/* Result Area */
.simulator-result {
    background: #f8fafc;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    border: 2px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.result-label { font-size: 1rem; font-weight: bold; color: #666; margin-bottom: 10px; }
.result-price { color: var(--c-prm); font-family: "DIN Alternate", sans-serif; line-height: 1; margin-bottom: 15px; }
.result-price .prefix { font-size: 1.2rem; font-weight: bold; color: #333; }
.result-price #sim-result { font-size: 4rem; font-weight: 900; letter-spacing: -2px; }
.result-price .suffix { font-size: 1.2rem; font-weight: bold; color: #333; }
.result-note { font-size: 0.8rem; color: #888; margin-bottom: 20px; text-align: left; }

/* Price Grid (Exterior) - Same as previous pages */
.price-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 50px; align-items: flex-start; }
.menu-card { background: #fff; border-radius: var(--radius-l); overflow: hidden; box-shadow: var(--shadow-card); border: 1px solid #e2e8f0; transition: 0.3s; }
.menu-card:hover { transform: translateY(-5px); }
.menu-card--recommend { border: 2px solid var(--c-prm); position: relative; z-index: 1; transform: scale(1.03); }
.menu-card--recommend:hover { transform: scale(1.03) translateY(-5px); }
.recommend-badge { position: absolute; top: 0; right: 0; background: var(--c-prm); color: #fff; padding: 6px 15px; font-size: 0.85rem; font-weight: bold; border-bottom-left-radius: 10px; z-index: 2; }
.menu-card__image { position: relative; height: 160px; }
.menu-card__image img { width: 100%; height: 100%; object-fit: cover; }
.menu-card__label { position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(13, 71, 161, 0.8), transparent); color: #fff; padding: 15px; font-weight: bold; font-size: 1.1rem; }
.menu-card__content { padding: 25px; text-align: center; }
.menu-card__title { font-size: 1.25rem; font-weight: bold; margin-bottom: 10px; color: #1e293b; }
.menu-card__desc { font-size: 0.85rem; color: #666; margin-bottom: 15px; min-height: 3em; }
.menu-card__price { color: var(--c-prm); margin-bottom: 5px; font-family: var(--font-en); }
.menu-card__price .yen { font-size: 1.2rem; font-weight: bold; vertical-align: top; }
.menu-card__price .num { font-size: 2.8rem; font-weight: 800; line-height: 1; }
.menu-card__price .unit { font-size: 1.2rem; font-weight: bold; }
.menu-card__price .tax { font-size: 0.8rem; color: #999; display: block; }
.menu-card__details { text-align: left; border-top: 1px dashed #e2e8f0; padding-top: 15px; margin-top: 15px; }
.menu-card__details ul { list-style: none; padding: 0; margin: 0; }
.menu-card__details li { font-size: 0.9rem; margin-bottom: 5px; padding-left: 20px; position: relative; color: #334155; }
.menu-card__details li::before { content: '✔'; position: absolute; left: 0; color: var(--c-acc); font-weight: bold; font-size: 0.8rem; }

/* Price Table */
.price-table-wrap { overflow-x: auto; background: #fff; padding: 30px; border-radius: var(--radius-l); box-shadow: var(--shadow-card); }
.price-table-title { font-size: 1.2rem; font-weight: bold; margin-bottom: 20px; color: var(--c-prm); border-left: 5px solid var(--c-acc); padding-left: 15px; }
.price-table { width: 100%; border-collapse: collapse; min-width: 600px; }
.price-table th, .price-table td { padding: 15px; border: 1px solid #e2e8f0; text-align: center; }
.price-table th { background: #f1f5f9; color: #1e293b; font-weight: bold; }
.price-table td.highlight { background: #fffbeb; color: #b45309; font-weight: bold; font-size: 1.1rem; }
.price-note { font-size: 0.85rem; color: #666; margin-top: 15px; }

/* Roof List */
.price-list-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
.price-item { background: #fff; border: 1px solid #e2e8f0; border-radius: var(--radius-m); padding: 20px; position: relative; }
.price-item--rec { border: 2px solid var(--c-acc); }
.price-item .badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: var(--c-acc); color: #fff; font-size: 0.75rem; padding: 2px 10px; border-radius: 20px; font-weight: bold; }
.price-item__head { text-align: center; margin-bottom: 10px; border-bottom: 1px dashed #eee; padding-bottom: 10px; }
.price-item__head h3 { font-size: 1.1rem; font-weight: bold; margin-bottom: 5px; }
.price-item__head .price { font-size: 1.5rem; font-weight: bold; color: var(--c-prm); font-family: var(--font-en); }
.price-item__head small { font-size: 1rem; }
.price-item__desc { font-size: 0.85rem; color: #666; line-height: 1.5; }

/* Other (Waterproof/Repair) */
.grid-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
.other-price-box { background: #fff; border-radius: var(--radius-l); padding: 30px; box-shadow: var(--shadow-card); }
.box-title { font-size: 1.4rem; font-weight: bold; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.price-list-simple { list-style: none; padding: 0; margin: 0; }
.price-list-simple li { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px dashed #e2e8f0; }
.price-list-simple li:last-child { border-bottom: none; }
.price-list-simple .label { font-weight: bold; color: #333; }
.price-list-simple .price { font-weight: bold; color: var(--c-prm); font-family: var(--font-en); font-size: 1.1rem; }
.price-list-simple small { font-size: 0.8rem; color: #666; font-weight: normal; margin-left: 5px; }

/* Common Costs */
.common-table-wrap { max-width: 800px; margin: 0 auto 40px; }
.common-table { width: 100%; border-collapse: collapse; background: #fff; }
.common-table th, .common-table td { padding: 15px; border-bottom: 1px solid #eee; text-align: left; }
.common-table th { width: 30%; background: #f8fafc; font-weight: bold; color: #1e293b; }
.price-alert { max-width: 800px; margin: 0 auto; background: #fff7ed; border: 1px solid #fdba74; padding: 20px; border-radius: 8px; }
.alert-title { color: #c2410c; font-weight: bold; margin-bottom: 10px; font-size: 1.1rem; }
.price-alert p { font-size: 0.9rem; color: #444; line-height: 1.7; margin: 0; }

/* Creative Bottom */
.creative-bottom { padding: 100px 0; position: relative; background: #fff; overflow: hidden; }
.creative-bottom__bg { position: absolute; inset: 0; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); z-index: 0; }
.creative-bottom__inner { position: relative; z-index: 1; max-width: 800px; margin: 0 auto; text-align: center; }
.creative-bottom__title { font-size: 2.2rem; font-weight: bold; margin-bottom: 20px; color: #0f172a; }
.creative-bottom__title .highlight { background: linear-gradient(transparent 60%, rgba(245, 158, 11, 0.3) 60%); }
.creative-bottom__text { font-size: 1.05rem; margin-bottom: 40px; color: #475569; }
.creative-bottom__links { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
.link-card { display: flex; align-items: center; gap: 15px; background: #fff; padding: 20px 30px; border-radius: 50px; text-decoration: none; color: #333; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid rgba(0,0,0,0.05); min-width: 280px; }
.link-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color: var(--c-prm); }
.btn--accent { background: var(--c-acc); color: #fff; padding: 12px 30px; border-radius: 50px; font-weight: bold; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
.btn--accent:hover { background: #d97706; transform: translateY(-2px); }
.btn--block { width: 100%; justify-content: center; margin-top: 15px; }

/* Responsive */
@media (max-width: 900px) {
    .simulator-body { grid-template-columns: 1fr; }
    .price-grid, .price-list-row { grid-template-columns: 1fr; max-width: 500px; margin: 0 auto 30px; }
    .grid-2col { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .page-header { padding: 100px 0 60px; }
    .page-header__title { font-size: 2rem; }
    .common-table th, .common-table td { display: block; width: 100%; }
    .common-table th { background: #eee; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('sim-size');
    const output = document.getElementById('sim-size-val');
    const result = document.getElementById('sim-result');
    const radios = document.getElementsByName('sim-grade');

    // シミュレーション計算ロジック
    // ※これは概算用の簡易ロジックです。
    // 計算式: 坪数 * 3.3(㎡換算) * 1.2(係数) * 単価 * グレード係数 + 足場代等固定費
    // ここではもっと単純化して「坪数 × 係数」で算出しています。
    function calculate() {
        const tsubo = parseInt(slider.value);
        output.textContent = tsubo;

        let multiplier = 1.0;
        for (const radio of radios) {
            if (radio.checked) {
                multiplier = parseFloat(radio.value);
                break;
            }
        }

        // 基準単価（30坪で60万円になるように調整）
        // 30 * 2 = 60
        // ベース価格 = 坪数 * 2万円
        let basePrice = tsubo * 2; 
        
        // グレード補正
        let finalPrice = basePrice * multiplier;

        // 小数点切り捨て
        finalPrice = Math.floor(finalPrice);

        // アニメーション風に数値を更新
        animateValue(result, parseInt(result.textContent), finalPrice, 500);
    }

    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    slider.addEventListener('input', calculate);
    for (const radio of radios) {
        radio.addEventListener('change', calculate);
    }

    // 初期計算
    calculate();
});
</script>