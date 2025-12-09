<?php
/**
 * Template Name: よくある質問アーカイブ
 * Description: カスタム投稿タイプ「faq」の一覧ページ（カテゴリー分類・アコーディオン）
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

// FAQカテゴリーを取得
$categories = get_terms([
    'taxonomy'   => 'faq_category',
    'hide_empty' => true,
    'orderby'    => 'menu_order', // 必要に応じて slug や id に変更
    'order'      => 'ASC',
]);

// 構造化データ（FAQPage）用配列
$faq_schema_items = [];

?>

<?php
// 全FAQを取得してSchemaを生成
$all_faqs = new WP_Query([
    'post_type'      => 'faq',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
]);
if ($all_faqs->have_posts()) {
    while ($all_faqs->have_posts()) {
        $all_faqs->the_post();
        $faq_schema_items[] = [
            '@type' => 'Question',
            'name' => get_the_title(),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => wp_strip_all_tags(get_the_content())
            ]
        ];
    }
    wp_reset_postdata();
}
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": <?php echo json_encode($faq_schema_items, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
}
</script>

<main id="main" class="faq-archive-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">よくあるご質問</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">Q&A</span>
                <h1 class="page-header__title">よくあるご質問</h1>
                <p class="page-header__lead">
                    お客様から寄せられるご質問をまとめました。<br>
                    その他ご不明な点がございましたら、お気軽にお問い合わせください。
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#f8fafc"/></svg>
        </div>
    </section>

    <section class="section faq-content">
        <div class="service-container">
            
            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                <div class="faq-nav-wrapper">
                    <ul class="faq-nav">
                        <li><a href="#all" class="faq-nav__item is-active">すべて</a></li>
                        <?php foreach ($categories as $cat) : ?>
                            <li><a href="#<?php echo esc_attr($cat->slug); ?>" class="faq-nav__item"><?php echo esc_html($cat->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="faq-lists">
                    <?php foreach ($categories as $cat) : 
                        $faq_query = new WP_Query([
                            'post_type'      => 'faq',
                            'posts_per_page' => -1,
                            'post_status'    => 'publish',
                            'tax_query'      => [[
                                'taxonomy' => 'faq_category',
                                'field'    => 'slug',
                                'terms'    => $cat->slug,
                            ]],
                            'meta_key'       => '_faq_display_order', // functions.phpで定義した表示順
                            'orderby'        => 'meta_value_num',
                            'order'          => 'ASC',
                        ]);

                        if ($faq_query->have_posts()) :
                    ?>
                        <div class="faq-section" id="<?php echo esc_attr($cat->slug); ?>">
                            <h2 class="faq-section__title">
                                <span class="icon">Q</span>
                                <?php echo esc_html($cat->name); ?>
                            </h2>
                            
                            <div class="faq-accordion">
                                <?php while ($faq_query->have_posts()) : $faq_query->the_post(); ?>
                                <article class="faq-item">
                                    <button class="faq-item__question" aria-expanded="false">
                                        <span class="faq-item__q">Q</span>
                                        <h3 class="faq-item__title"><?php the_title(); ?></h3>
                                        <span class="faq-item__toggle"></span>
                                    </button>
                                    <div class="faq-item__answer" aria-hidden="true">
                                        <div class="faq-item__answer-inner">
                                            <span class="faq-item__a">A</span>
                                            <div class="faq-item__content">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php 
                        endif;
                        wp_reset_postdata();
                    endforeach; 
                    ?>
                </div>

            <?php else : ?>
                <div class="faq-section" id="all">
                    <div class="faq-accordion">
                        <?php 
                        $fallback_query = new WP_Query([
                            'post_type'      => 'faq',
                            'posts_per_page' => -1,
                            'post_status'    => 'publish',
                        ]);
                        while ($fallback_query->have_posts()) : $fallback_query->the_post(); 
                        ?>
                        <article class="faq-item">
                            <button class="faq-item__question" aria-expanded="false">
                                <span class="faq-item__q">Q</span>
                                <h3 class="faq-item__title"><?php the_title(); ?></h3>
                                <span class="faq-item__toggle"></span>
                            </button>
                            <div class="faq-item__answer" aria-hidden="true">
                                <div class="faq-item__answer-inner">
                                    <span class="faq-item__a">A</span>
                                    <div class="faq-item__content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    解決しない場合は、<br>
                    <span class="highlight">お気軽にご相談</span>ください。
                </h2>
                <p class="creative-bottom__text">
                    「自分の家のケースはどうなるの？」「もっと詳しく知りたい」<br>
                    そんな時は、専門スタッフが丁寧にお答えします。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">個別に質問したい</span>
                            <span class="link-card__main">お問い合わせフォーム</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="link-card link-card--line" target="_blank" rel="noopener noreferrer">
                        <div class="link-card__icon">💬</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">チャットで聞きたい</span>
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
/* 共通設定 */
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

/* コンテナ */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

.text-center { text-align: center; }

/* Page Header */
.page-header {
    position: relative;
    padding: 120px 0 80px;
    color: #fff;
    overflow: hidden;
    background-color: var(--c-prm);
}
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
.breadcrumb__link:hover { color: #fff; }
.breadcrumb__separator { opacity: 0.5; }

/* FAQ Content */
.faq-content {
    background-color: var(--c-bg-gray);
    padding: 60px 0 100px;
}

/* Nav */
.faq-nav-wrapper {
    margin-bottom: 50px;
    position: sticky;
    top: 20px;
    z-index: 10;
}
.faq-nav {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.faq-nav__item {
    display: block;
    padding: 10px 25px;
    background: #fff;
    border-radius: 50px;
    text-decoration: none;
    color: var(--c-txt);
    font-weight: bold;
    font-size: 0.9rem;
    box-shadow: var(--shadow-card);
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.faq-nav__item:hover,
.faq-nav__item.is-active {
    background: var(--c-prm);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(13, 71, 161, 0.2);
}

/* Sections */
.faq-section {
    margin-bottom: 60px;
    scroll-margin-top: 100px; /* スクロール位置調整 */
}
.faq-section__title {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--c-prm);
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #e0e0e0;
    padding-bottom: 10px;
}
.faq-section__title .icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px; height: 32px;
    background: var(--c-prm);
    color: #fff;
    border-radius: 50%;
    font-size: 1rem;
    font-family: "DIN Alternate", sans-serif;
}

/* Accordion Item */
.faq-item {
    background: #fff;
    border-radius: var(--radius-m);
    margin-bottom: 15px;
    box-shadow: var(--shadow-card);
    overflow: hidden;
    transition: box-shadow 0.3s;
}
.faq-item:hover {
    box-shadow: 0 8px 16px rgba(0,0,0,0.05);
}

/* Question */
.faq-item__question {
    width: 100%;
    padding: 20px 25px;
    background: none;
    border: none;
    text-align: left;
    display: flex;
    align-items: center; /* 中央揃えに変更 */
    gap: 20px;
    cursor: pointer;
    transition: background 0.2s;
    position: relative;
}
.faq-item__question:hover {
    background: #f9fafb;
}

.faq-item__q {
    flex-shrink: 0;
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--c-prm) 0%, #1e40af 100%);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    font-family: "DIN Alternate", sans-serif;
    box-shadow: 0 3px 6px rgba(13, 71, 161, 0.2);
}

.faq-item__title {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0;
    flex: 1;
    line-height: 1.5;
    color: var(--c-txt);
}

.faq-item__toggle {
    position: relative;
    width: 24px;
    height: 24px;
    flex-shrink: 0;
}
.faq-item__toggle::before,
.faq-item__toggle::after {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    background-color: var(--c-prm);
    transform: translate(-50%, -50%);
    transition: transform 0.3s;
}
.faq-item__toggle::before { width: 14px; height: 2px; }
.faq-item__toggle::after { width: 2px; height: 14px; }

/* Open State */
.faq-item__question[aria-expanded="true"] .faq-item__toggle::after {
    transform: translate(-50%, -50%) rotate(90deg);
}
.faq-item__question[aria-expanded="true"] .faq-item__toggle::before {
    opacity: 0; /* マイナスにする場合 */
}
/* プラスからマイナスへの変化（回転させる場合） */
.faq-item__question[aria-expanded="true"] .faq-item__toggle {
    transform: rotate(45deg);
}
.faq-item__question[aria-expanded="true"] .faq-item__toggle::before,
.faq-item__question[aria-expanded="true"] .faq-item__toggle::after {
    background-color: var(--c-acc);
}


/* Answer */
.faq-item__answer {
    height: 0;
    overflow: hidden;
    transition: height 0.3s ease-out;
}
.faq-item__answer-inner {
    padding: 0 25px 25px 25px;
    display: flex;
    gap: 20px;
    border-top: 1px dashed #eee;
    margin-top: 5px;
    padding-top: 20px;
}

.faq-item__a {
    flex-shrink: 0;
    width: 40px; height: 40px;
    background: #fff5f5; /* 淡い赤背景 */
    color: #e53e3e; /* 赤文字 */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    font-family: "DIN Alternate", sans-serif;
}
/* アクセントカラーに合わせるならこちら */
.faq-item__a {
    background: #fffbe6; /* 淡い黄色 */
    color: var(--c-acc);
}


.faq-item__content {
    flex: 1;
    font-size: 0.95rem;
    line-height: 1.8;
    color: #555;
}
.faq-item__content p { margin: 0 0 1em; }
.faq-item__content p:last-child { margin-bottom: 0; }

/* Creative Bottom (Link Area) */
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

/* Responsive */
@media (max-width: 768px) {
    .page-header { padding: 100px 0 60px; }
    .page-header__title { font-size: 2rem; }
    
    .faq-nav { overflow-x: auto; white-space: nowrap; justify-content: flex-start; padding-bottom: 10px; }
    
    .faq-item__question { padding: 15px 20px; gap: 15px; }
    .faq-item__q { width: 32px; height: 32px; font-size: 1rem; }
    .faq-item__title { font-size: 1rem; }
    .faq-item__answer-inner { padding: 0 20px 20px; gap: 15px; }
    .faq-item__a { width: 32px; height: 32px; font-size: 1rem; }
    
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
    .sp-only { display: inline; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // アコーディオン
    const questions = document.querySelectorAll('.faq-item__question');
    
    questions.forEach(q => {
        q.addEventListener('click', () => {
            const expanded = q.getAttribute('aria-expanded') === 'true';
            const answer = q.nextElementSibling;
            
            // Toggle
            q.setAttribute('aria-expanded', !expanded);
            answer.setAttribute('aria-hidden', expanded);
            
            if (!expanded) {
                answer.style.height = answer.scrollHeight + 'px';
            } else {
                answer.style.height = 0;
            }
        });
    });
    
    // スムーズスクロール & タブ切り替え（簡易）
    const navLinks = document.querySelectorAll('.faq-nav__item');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Active Class
            navLinks.forEach(l => l.classList.remove('is-active'));
            link.classList.add('is-active');
            
            const targetId = link.getAttribute('href');
            
            if (targetId === '#all') {
                // すべて表示
                document.querySelectorAll('.faq-section').forEach(sec => sec.style.display = 'block');
            } else {
                // フィルタリング（CSSで非表示にするか、スクロールするか）
                // 今回はスクロール遷移にする
                const targetSection = document.querySelector(targetId);
                if(targetSection) {
                    const headerOffset = 100;
                    const elementPosition = targetSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>