<?php
/**
 * Template Name: お客様の声アーカイブ
 * Description: お客様の声（Voice）の一覧ページ - フィルター機能なし・カード一覧
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

// ページネーション設定
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type'      => 'voice',
    'posts_per_page' => 9, // 1ページあたりの表示件数
    'paged'          => $paged,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
];

$voice_query = new WP_Query($args);
$total_voices = $voice_query->found_posts;
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "お客様の声 | <?php echo esc_js($company_name); ?>",
    "description": "<?php echo esc_js($company_name); ?>をご利用いただいたお客様からの直筆アンケートや感想をご紹介します。",
    "url": "<?php echo esc_url(get_post_type_archive_link('voice')); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "numberOfItems": <?php echo intval($total_voices); ?>,
        "itemListElement": [
            <?php
            $json_list = [];
            $pos = 1;
            if ($voice_query->have_posts()) {
                while ($voice_query->have_posts()) {
                    $voice_query->the_post();
                    $rating = get_post_meta(get_the_ID(), '_voice_rating', true) ?: 5;
                    $author = get_post_meta(get_the_ID(), '_voice_client_initial', true) ?: '匿名';
                    
                    $json_list[] = sprintf(
                        '{
                            "@type": "ListItem",
                            "position": %d,
                            "item": {
                                "@type": "Review",
                                "name": "%s",
                                "reviewBody": "%s",
                                "reviewRating": {
                                    "@type": "Rating",
                                    "ratingValue": "%s",
                                    "bestRating": "5"
                                },
                                "author": {
                                    "@type": "Person",
                                    "name": "%s"
                                }
                            }
                        }',
                        $pos++,
                        esc_js(get_the_title()),
                        esc_js(wp_strip_all_tags(get_the_excerpt())),
                        esc_js($rating),
                        esc_js($author)
                    );
                    if ($pos > 10) break;
                }
                $voice_query->rewind_posts();
            }
            echo implode(',', $json_list);
            ?>
        ]
    }
}
</script>

<main id="main" class="voice-archive-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">お客様の声</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">VOICE</span>
                <h1 class="page-header__title">お客様の声</h1>
                <p class="page-header__lead">
                    <?php echo esc_html($company_name); ?>に寄せられた、<br class="sp-only">
                    実際のアンケートや喜びの声をご紹介します。<br>
                    お客様からの信頼が、私たちの誇りです。
                </p>
                <div class="page-header__stats">
                    <div class="page-header__stat">
                        <span class="page-header__stat-number"><?php echo number_format($total_voices); ?></span>
                        <span class="page-header__stat-label">件のアンケート</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#f8fafc"/></svg>
        </div>
    </section>

    <section class="voice-list">
        <div class="service-container">
            <?php if ($voice_query->have_posts()) : ?>
                
                <div class="voice-grid">
                    <?php 
                    $delay = 0;
                    while ($voice_query->have_posts()) : $voice_query->the_post(); 
                        // メタデータ取得
                        $area      = get_post_meta(get_the_ID(), '_voice_client_area', true);
                        $initial   = get_post_meta(get_the_ID(), '_voice_client_initial', true);
                        $age       = get_post_meta(get_the_ID(), '_voice_client_age', true);
                        $service   = get_post_meta(get_the_ID(), '_voice_service_type', true);
                        $rating    = get_post_meta(get_the_ID(), '_voice_rating', true);
                        $date      = get_post_meta(get_the_ID(), '_voice_date', true);
                        
                        // 画像（アンケート用紙など）
                        $thumbnail_url = has_post_thumbnail() 
                            ? get_the_post_thumbnail_url(get_the_ID(), 'medium') 
                            : 'https://placehold.co/400x300/f0f0f0/cccccc?text=No+Image';
                    ?>
                    
                    <article class="voice-card" style="--delay: <?php echo $delay * 0.05; ?>s">
                        <a href="<?php the_permalink(); ?>" class="voice-card__link">
                            <div class="voice-card__header">
                                <div class="voice-card__meta">
                                    <?php if ($area) : ?><span class="voice-tag voice-tag--area"><?php echo esc_html($area); ?></span><?php endif; ?>
                                    <?php if ($service) : ?><span class="voice-tag voice-tag--service"><?php echo esc_html($service); ?></span><?php endif; ?>
                                </div>
                                <div class="voice-card__rating">
                                    <?php echo sato_get_rating_stars($rating); ?>
                                </div>
                            </div>
                            
                            <h3 class="voice-card__title"><?php the_title(); ?></h3>
                            
                            <div class="voice-card__body">
                                <div class="voice-card__img-box">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                </div>
                                <div class="voice-card__excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 60, '...'); ?>
                                </div>
                            </div>
                            
                            <div class="voice-card__footer">
                                <div class="voice-card__client">
                                    <div class="voice-card__avatar">
                                        <svg viewBox="0 0 24 24" width="24" height="24" fill="#ccc"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    </div>
                                    <div class="voice-card__info">
                                        <span class="voice-card__name"><?php echo esc_html($initial . ' 様'); ?></span>
                                        <?php if ($age) : ?><span class="voice-card__age">（<?php echo esc_html($age); ?>）</span><?php endif; ?>
                                    </div>
                                </div>
                                <span class="voice-card__readmore">詳細を見る →</span>
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
                    echo paginate_links([
                        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format'    => '?paged=%#%',
                        'current'   => max(1, $paged),
                        'total'     => $voice_query->max_num_pages,
                        'mid_size'  => 2,
                        'prev_text' => '←',
                        'next_text' => '→',
                        'type'      => 'list',
                    ]);
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="no-results">
                    <p>現在、掲載できるお客様の声はありません。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    次は、<span class="highlight">あなたの番</span>です。
                </h2>
                <p class="creative-bottom__text">
                    お客様一人ひとりの「ありがとう」が、私たちの原動力です。<br>
                    まずは無料診断で、お家の状態をチェックしてみませんか？
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
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>

<style>
/* 共通設定 (他のページと統一) */
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
.page-header__bg {
    position: absolute;
    inset: 0;
    z-index: 0;
}
.page-header__bg-image {
    width: 100%; height: 100%;
    background-size: cover;
    background-position: center;
    filter: brightness(0.6);
}
.page-header__bg-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(13,71,161,0.8), rgba(21,101,192,0.6));
}
.page-header__content {
    position: relative;
    z-index: 1;
    text-align: center;
}
.page-header__tag {
    display: inline-block;
    padding: 6px 16px;
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 30px;
    font-size: 0.85rem;
    margin-bottom: 20px;
    letter-spacing: 0.1em;
    font-family: "DIN Alternate", "Roboto", sans-serif;
}
.page-header__title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 20px;
}
.page-header__lead {
    font-size: 1.1rem;
    opacity: 0.95;
    line-height: 1.8;
}
.page-header__stats {
    margin-top: 30px;
    display: inline-flex;
    background: rgba(255,255,255,0.15);
    padding: 15px 30px;
    border-radius: var(--radius-l);
    backdrop-filter: blur(5px);
}
.page-header__stat-number {
    font-size: 2.5rem;
    font-weight: 900;
    margin-right: 10px;
    font-family: "DIN Alternate", sans-serif;
}
.page-header__stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    align-self: center;
}
.page-header__wave {
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    line-height: 0;
    z-index: 2;
}
.page-header__wave svg {
    width: 100%;
    height: 60px;
}

/* Breadcrumb */
.breadcrumb {
    padding: 20px 0;
    font-size: 0.85rem;
    color: rgba(255,255,255,0.8);
    position: relative;
    z-index: 2;
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
.breadcrumb__link { color: inherit; text-decoration: none; }
.breadcrumb__link:hover { color: #fff; }
.breadcrumb__separator { opacity: 0.5; }

/* Voice List */
.voice-list {
    padding: 60px 0 100px;
    background: var(--c-bg-gray);
}
.voice-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* Voice Card Style */
.voice-card {
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
}
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.voice-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}
.voice-card__link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
    padding: 25px;
}

.voice-card__header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}
.voice-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.voice-tag {
    font-size: 0.7rem;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: bold;
}
.voice-tag--area { background: #e3f2fd; color: var(--c-prm); }
.voice-tag--service { background: #fff7ed; color: #c2410c; }

.voice-card__rating {
    color: var(--c-acc);
    display: flex;
}
.voice-card__rating svg { width: 16px; height: 16px; }

.voice-card__title {
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

.voice-card__body {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
}
.voice-card__img-box {
    width: 80px;
    height: 80px;
    flex-shrink: 0;
    border-radius: var(--radius-m);
    overflow: hidden;
    border: 1px solid #eee;
}
.voice-card__img-box img {
    width: 100%; height: 100%; object-fit: cover;
}
.voice-card__excerpt {
    font-size: 0.9rem;
    color: #666;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.voice-card__footer {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f0f0f0;
    padding-top: 15px;
}
.voice-card__client {
    display: flex;
    align-items: center;
    gap: 10px;
}
.voice-card__avatar {
    width: 32px; height: 32px;
    background: #f0f0f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.voice-card__info {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}
.voice-card__name {
    font-size: 0.9rem;
    font-weight: bold;
}
.voice-card__age {
    font-size: 0.75rem;
    color: #888;
}
.voice-card__readmore {
    font-size: 0.8rem;
    font-weight: bold;
    color: var(--c-prm);
}

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

/* Responsive */
@media (max-width: 900px) {
    .voice-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .voice-grid { grid-template-columns: 1fr; }
    .page-header { padding: 100px 0 60px; }
    .page-header__title { font-size: 2rem; }
}
</style>