<?php
/**
 * Template Name: ニュース・コラム一覧
 * Description: カスタム投稿タイプ「news」のアーカイブページ（カテゴリータブ付き）
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
$line_url     = sato_get_line_url();

// 現在のクエリオブジェクト（全件か、特定のカテゴリか）
$queried_object = get_queried_object();
$current_term_id = 0;

if (is_tax('news_category')) {
    $current_term_id = $queried_object->term_id;
    $page_title = $queried_object->name;
    $page_desc  = $queried_object->description ?: 'カテゴリー別の記事一覧です。';
} else {
    $page_title = 'ニュース・コラム';
    $page_desc  = '最新のお知らせや、住まいに関する役立つ情報を発信しています。';
}

// カテゴリーリスト取得
$categories = get_terms([
    'taxonomy'   => 'news_category',
    'hide_empty' => true,
    'orderby'    => 'id', // または slug, count など
    'order'      => 'ASC',
]);
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "<?php echo esc_js($page_title); ?> | <?php echo esc_js($company_name); ?>",
    "description": "<?php echo esc_js($page_desc); ?>",
    "url": "<?php echo esc_url(get_pagenum_link()); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "itemListElement": [
            <?php
            $json_list = [];
            $pos = 1;
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $json_list[] = sprintf(
                        '{"@type": "ListItem", "position": %d, "url": "%s", "name": "%s"}',
                        $pos++,
                        esc_url(get_permalink()),
                        esc_js(get_the_title())
                    );
                    if ($pos > 10) break;
                }
                // メインクエリなのでrewindは不要だが念のため
                rewind_posts();
            }
            echo implode(',', $json_list);
            ?>
        ]
    }
}
</script>

<main id="main" class="news-archive-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1505330622279-bf7d7fc918f4?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current"><?php echo esc_html($page_title); ?></span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">NEWS & COLUMN</span>
                <h1 class="page-header__title"><?php echo esc_html($page_title); ?></h1>
                <p class="page-header__lead">
                    <?php echo nl2br(esc_html($page_desc)); ?>
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#f8fafc"/></svg>
        </div>
    </section>

    <section class="news-content">
        <div class="service-container">
            
            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <div class="news-tab-wrapper">
                <ul class="news-tab">
                    <li>
                        <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" 
                           class="news-tab__item <?php echo ($current_term_id === 0) ? 'is-active' : ''; ?>">
                           すべて
                        </a>
                    </li>
                    <?php foreach ($categories as $cat) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>" 
                               class="news-tab__item <?php echo ($current_term_id === $cat->term_id) ? 'is-active' : ''; ?>">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="news-grid">
                    <?php 
                    $delay = 0;
                    while (have_posts()) : the_post(); 
                        $cats = get_the_terms(get_the_ID(), 'news_category');
                        $cat_name = !empty($cats) && !is_wp_error($cats) ? $cats[0]->name : 'お知らせ';
                        $cat_slug = !empty($cats) && !is_wp_error($cats) ? $cats[0]->slug : 'default';
                        
                        // アイキャッチ画像（なければダミー）
                        $thumbnail_url = has_post_thumbnail() 
                            ? get_the_post_thumbnail_url(get_the_ID(), 'large') 
                            : 'https://placehold.co/600x400/1e3a5f/ffffff?text=News';
                        
                        // NEWマーク（14日以内）
                        $days = 14;
                        $today = date_i18n('U');
                        $entry_day = get_the_time('U');
                        $is_new = ($days > date('U', ($today - $entry_day)) / 86400);
                    ?>
                    
                    <article class="news-card" style="--delay: <?php echo $delay * 0.05; ?>s">
                        <a href="<?php the_permalink(); ?>" class="news-card__link">
                            <div class="news-card__image-box">
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" class="news-card__img">
                                <?php if ($is_new) : ?>
                                    <span class="news-card__new-badge">NEW</span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="news-card__body">
                                <div class="news-card__meta">
                                    <span class="news-card__date">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <?php echo get_the_date('Y.m.d'); ?>
                                    </span>
                                    <span class="news-card__cat news-card__cat--<?php echo esc_attr($cat_slug); ?>">
                                        <?php echo esc_html($cat_name); ?>
                                    </span>
                                </div>
                                
                                <h2 class="news-card__title"><?php the_title(); ?></h2>
                                
                                <p class="news-card__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?>
                                </p>
                                
                                <span class="news-card__more">
                                    READ MORE
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </a>
                    </article>
                    <?php 
                        $delay++;
                    endwhile; 
                    ?>
                </div>

                <div class="pagination-wrapper">
                    <?php
                    the_posts_pagination([
                        'mid_size'  => 2,
                        'prev_text' => '←',
                        'next_text' => '→',
                        'screen_reader_text' => ' ',
                    ]);
                    ?>
                </div>

            <?php else : ?>
                <div class="no-results">
                    <p>現在、記事はありません。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    <span class="highlight">最新情報</span>を、<br>
                    お届けしました。
                </h2>
                <p class="creative-bottom__text">
                    記事を読んで気になったことや、ご相談がございましたら<br>
                    お気軽にお問い合わせください。
                </p>
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">まずは相談したい</span>
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
/* 共通設定 */
:root {
    --c-prm: #0d47a1;
    --c-acc: #f59e0b;
    --c-txt: #333;
    --c-bg-gray: #f8fafc;
    --radius-l: 16px;
    --radius-m: 8px;
    --shadow-card: 0 4px 6px -1px rgba(0,0,0,0.05);
    --shadow-hover: 0 10px 15px -3px rgba(0,0,0,0.1);
    --container-max: 1200px;
    --container-pad: 20px;
}

body {
    font-family: "Helvetica Neue", Arial, "Hiragino Kaku Gothic ProN", sans-serif;
    color: var(--c-txt);
    line-height: 1.6;
}

img { max-width: 100%; height: auto; vertical-align: bottom; }
.sp-only { display: none; }
@media (max-width: 768px) { .sp-only { display: inline; } }

/* コンテナ */
.service-container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
    width: 100%;
    box-sizing: border-box;
}

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

/* News Content */
.news-content {
    background-color: var(--c-bg-gray);
    padding: 60px 0 100px;
}

/* Tab Nav */
.news-tab-wrapper {
    margin-bottom: 50px;
    display: flex;
    justify-content: center;
}
.news-tab {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    list-style: none;
    padding: 0;
    margin: 0;
}
.news-tab__item {
    display: block;
    padding: 10px 30px;
    background: #fff;
    border-radius: 50px;
    text-decoration: none;
    color: var(--c-txt);
    font-weight: bold;
    font-size: 0.9rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.news-tab__item:hover,
.news-tab__item.is-active {
    background: var(--c-prm);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(13, 71, 161, 0.2);
}

/* News Grid */
.news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* News Card */
.news-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    height: 100%;
    opacity: 0;
    animation: fadeSlideUp 0.6s ease forwards;
    animation-delay: var(--delay, 0s);
    display: flex;
    flex-direction: column;
}
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.news-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}
.news-card__link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.news-card__image-box {
    position: relative;
    padding-top: 60%; /* 5:3 Aspect Ratio */
    overflow: hidden;
}
.news-card__img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.news-card:hover .news-card__img { transform: scale(1.05); }

.news-card__new-badge {
    position: absolute;
    top: 10px; right: 10px;
    background: #e53e3e;
    color: #fff;
    font-size: 0.7rem;
    font-weight: bold;
    padding: 3px 8px;
    border-radius: 4px;
    z-index: 2;
}

.news-card__body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.news-card__meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 0.8rem;
    color: #888;
}
.news-card__date {
    display: flex;
    align-items: center;
    gap: 4px;
}
.news-card__cat {
    padding: 2px 10px;
    border-radius: 12px;
    font-weight: bold;
    font-size: 0.75rem;
    background: #eee;
    color: #555;
}
/* カテゴリ別カラー例 */
.news-card__cat--info { background: #e0f2fe; color: #0284c7; }
.news-card__cat--column { background: #fef3c7; color: #d97706; }
.news-card__cat--campaign { background: #fee2e2; color: #dc2626; }
.news-card__cat--works { background: #dcfce7; color: #16a34a; }

.news-card__title {
    font-size: 1.15rem;
    font-weight: bold;
    margin: 0 0 15px;
    line-height: 1.4;
    color: var(--c-txt);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-card__excerpt {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

.news-card__more {
    font-size: 0.85rem;
    font-weight: bold;
    color: var(--c-prm);
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: auto;
    transition: gap 0.2s;
}
.news-card:hover .news-card__more { gap: 8px; }

/* Pagination */
.pagination-wrapper {
    margin-top: 60px;
    text-align: center;
}
.page-numbers {
    display: inline-flex;
    list-style: none;
    padding: 0;
    gap: 8px;
}
.page-numbers li a,
.page-numbers li span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px; height: 40px;
    border: 1px solid #ddd;
    border-radius: 50%;
    text-decoration: none;
    color: var(--c-txt);
    transition: 0.3s;
}
.page-numbers li span.current,
.page-numbers li a:hover {
    background: var(--c-prm);
    color: #fff;
    border-color: var(--c-prm);
}

/* No Results */
.no-results {
    text-align: center;
    padding: 50px;
    color: #888;
}

/* Creative Bottom */
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
@media (max-width: 900px) {
    .news-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .page-header { padding: 100px 0 60px; }
    .page-header__title { font-size: 2rem; }
    .news-tab-wrapper { overflow-x: auto; white-space: nowrap; justify-content: flex-start; padding-bottom: 10px; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
@media (max-width: 600px) {
    .news-grid { grid-template-columns: 1fr; }
}
</style>

<?php get_footer(); ?>