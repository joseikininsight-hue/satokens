<?php
/**
 * Template Name: 施工実績アーカイブ
 * Description: 施工実績の一覧ページ - フィルター機能付き（1ファイル完結型）
 * Author: Senior WordPress Engineer
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// データ取得 & 処理
// =============================================================================
$company_name = sato_get_company_name();
$phone_link   = sato_get_phone_link();

// 現在のフィルター値を取得
$current_cat  = get_query_var('works_category') ?: (isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '');
$current_area = get_query_var('works_area') ?: (isset($_GET['area']) ? sanitize_text_field($_GET['area']) : '');
$current_bldg = isset($_GET['building']) ? sanitize_text_field($_GET['building']) : '';

// 選択肢（ターム）の取得
$terms_cat  = get_terms(['taxonomy' => 'works_category', 'hide_empty' => true]);
$terms_area = get_terms(['taxonomy' => 'works_area', 'hide_empty' => true]);
$terms_bldg = get_terms(['taxonomy' => 'works_building', 'hide_empty' => true]);

// クエリの構築（フィルター適用）
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type'      => 'works',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'tax_query'      => [],
];

if ($current_cat) {
    $args['tax_query'][] = [
        'taxonomy' => 'works_category',
        'field'    => 'slug',
        'terms'    => $current_cat,
    ];
}
if ($current_area) {
    $args['tax_query'][] = [
        'taxonomy' => 'works_area',
        'field'    => 'slug',
        'terms'    => $current_area,
    ];
}
if ($current_bldg) {
    $args['tax_query'][] = [
        'taxonomy' => 'works_building',
        'field'    => 'slug',
        'terms'    => $current_bldg,
    ];
}
if (count($args['tax_query']) > 1) {
    $args['tax_query']['relation'] = 'AND';
}

$works_query = new WP_Query($args);
$total_works = $works_query->found_posts;
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "施工実績一覧 | <?php echo esc_js($company_name); ?>",
    "description": "<?php echo esc_js($company_name); ?>の施工実績一覧。外壁塗装、屋根塗装のビフォーアフター事例をご紹介。",
    "url": "<?php echo esc_url(get_post_type_archive_link('works')); ?>",
    "mainEntity": {
        "@type": "ItemList",
        "numberOfItems": <?php echo intval($total_works); ?>,
        "itemListElement": [
            <?php
            $json_list = [];
            $pos = 1;
            if ($works_query->have_posts()) {
                while ($works_query->have_posts()) {
                    $works_query->the_post();
                    $json_list[] = sprintf(
                        '{"@type": "ListItem", "position": %d, "url": "%s", "name": "%s"}',
                        $pos++,
                        esc_url(get_permalink()),
                        esc_js(get_the_title())
                    );
                    if ($pos > 10) break;
                }
                $works_query->rewind_posts();
            }
            echo implode(',', $json_list);
            ?>
        ]
    }
}
</script>

<main id="main" class="works-archive-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1595846519845-68e298c2edd8?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="service-container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">施工実績</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">OUR WORKS</span>
                <h1 class="page-header__title">施工実績</h1>
                <p class="page-header__lead">
                    一級塗装技能士が手掛けた、こだわりの施工事例。<br>
                    ビフォーアフターで、その違いをお確かめください。
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#f8fafc"/></svg>
        </div>
    </section>

    <section class="works-filter" id="works-filter">
        <div class="service-container">
            <form class="filter-form" method="get" action="<?php echo esc_url(get_post_type_archive_link('works')); ?>">
                <div class="filter-form__inner">
                    
                    <div class="filter-form__group">
                        <label class="filter-form__label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><line x1="22" y1="6" x2="2" y2="6"/></svg>
                            施工内容
                        </label>
                        <div class="filter-form__select-wrap">
                            <select name="category" class="filter-form__select">
                                <option value="">すべての施工内容</option>
                                <?php foreach ($terms_cat as $term) : ?>
                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_cat, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?> (<?php echo $term->count; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-form__group">
                        <label class="filter-form__label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            エリア
                        </label>
                        <div class="filter-form__select-wrap">
                            <select name="area" class="filter-form__select">
                                <option value="">すべてのエリア</option>
                                <?php foreach ($terms_area as $term) : ?>
                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_area, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-form__group">
                        <label class="filter-form__label">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            建物タイプ
                        </label>
                        <div class="filter-form__select-wrap">
                            <select name="building" class="filter-form__select">
                                <option value="">すべての建物</option>
                                <?php foreach ($terms_bldg as $term) : ?>
                                    <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($current_bldg, $term->slug); ?>>
                                        <?php echo esc_html($term->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="filter-form__btn">
                        <button type="submit" class="btn btn--primary btn--search">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            絞り込む
                        </button>
                    </div>
                </div>
                
                <?php if ($current_cat || $current_area || $current_bldg) : ?>
                <div class="filter-form__active">
                    <span class="filter-form__active-label">現在の条件:</span>
                    <?php if ($current_cat) : $t = get_term_by('slug', $current_cat, 'works_category'); ?><span class="active-tag"><?php echo esc_html($t->name); ?></span><?php endif; ?>
                    <?php if ($current_area) : $t = get_term_by('slug', $current_area, 'works_area'); ?><span class="active-tag"><?php echo esc_html($t->name); ?></span><?php endif; ?>
                    <?php if ($current_bldg) : $t = get_term_by('slug', $current_bldg, 'works_building'); ?><span class="active-tag"><?php echo esc_html($t->name); ?></span><?php endif; ?>
                    <a href="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="reset-link">条件をクリア</a>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <section class="section works-archive-list">
        <div class="service-container">
            
            <div class="works-archive-header">
                <h2 class="works-archive-count">
                    全 <strong><?php echo $total_works; ?></strong> 件の施工実績
                </h2>
            </div>

            <?php if ($works_query->have_posts()) : ?>
                <div class="works-grid">
                    <?php 
                    $delay = 0;
                    while ($works_query->have_posts()) : $works_query->the_post(); 
                        // メタデータ取得
                        $before_id   = get_post_meta(get_the_ID(), '_works_before_image', true);
                        $after_id    = get_post_meta(get_the_ID(), '_works_after_image', true);
                        $client_name = get_post_meta(get_the_ID(), '_works_client_name', true);
                        $work_cost   = get_post_meta(get_the_ID(), '_works_cost', true);
                        $completion  = get_post_meta(get_the_ID(), '_works_completion_date', true);
                        
                        // 画像URL設定
                        $thumbnail_url = $after_id ? wp_get_attachment_image_url($after_id, 'works-card') : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'works-card') : 'https://placehold.co/600x450/1e3a5f/ffffff?text=No+Image');
                        $before_url = $before_id ? wp_get_attachment_image_url($before_id, 'works-card') : '';
                        
                        // タクソノミー
                        $cats = get_the_terms(get_the_ID(), 'works_category');
                        $areas = get_the_terms(get_the_ID(), 'works_area');
                    ?>
                    
                    <article class="works-card" style="--delay: <?php echo $delay * 0.05; ?>s">
                        <a href="<?php the_permalink(); ?>" class="works-card__link">
                            <div class="works-card__image-box">
                                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" class="works-card__img">
                                
                                <?php if ($before_url) : ?>
                                <div class="works-card__badge"><span>Before/After</span></div>
                                <?php endif; ?>
                                
                                <div class="works-card__overlay">
                                    <span class="works-card__view-btn">詳細を見る</span>
                                </div>
                            </div>
                            
                            <div class="works-card__body">
                                <div class="works-card__tags">
                                    <?php if ($areas && !is_wp_error($areas)) : ?>
                                        <span class="works-tag works-tag--area"><?php echo esc_html($areas[0]->name); ?></span>
                                    <?php endif; ?>
                                    <?php if ($cats && !is_wp_error($cats)) : ?>
                                        <span class="works-tag works-tag--cat"><?php echo esc_html($cats[0]->name); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <h3 class="works-card__title"><?php the_title(); ?></h3>
                                
                                <div class="works-card__meta">
                                    <?php if ($work_cost) : ?>
                                    <div class="works-card__meta-item">
                                        <span class="label">費用</span>
                                        <span class="value price"><?php echo esc_html($work_cost); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($completion) : ?>
                                    <div class="works-card__meta-item">
                                        <span class="label">完工</span>
                                        <span class="value"><?php echo esc_html(date('Y.m', strtotime($completion))); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
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
                        'total'     => $works_query->max_num_pages,
                        'mid_size'  => 2,
                        'prev_text' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>',
                        'next_text' => '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
                        'type'      => 'list',
                    ]);
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="no-results">
                    <div class="no-results__icon">⚠️</div>
                    <p class="no-results__text">条件に一致する施工実績は見つかりませんでした。</p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="btn btn--outline">一覧に戻る</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="service-container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    <span class="highlight">理想の仕上がり</span>を、<br>
                    一緒に見つけませんか？
                </h2>
                <p class="creative-bottom__text">
                    「うちの家もこんな風になる？」「費用はどれくらい？」<br>
                    気になる事例がございましたら、お気軽にご相談ください。<br>
                    現地調査・お見積りは無料です。
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
}
.page-header__bg-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(13,71,161,0.9), rgba(21,101,192,0.8));
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
}
.page-header__title {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 20px;
}
.page-header__lead {
    font-size: 1.1rem;
    opacity: 0.9;
    line-height: 1.8;
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

/* Filter Section */
.works-filter {
    background: var(--c-bg-gray);
    padding: 30px 0;
    border-bottom: 1px solid #eee;
}
.filter-form__inner {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-end;
    background: #fff;
    padding: 20px;
    border-radius: var(--radius-m);
    box-shadow: var(--shadow-card);
}
.filter-form__group {
    flex: 1;
    min-width: 200px;
}
.filter-form__label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    font-weight: bold;
    margin-bottom: 8px;
    color: var(--c-txt);
}
.filter-form__select-wrap { position: relative; }
.filter-form__select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    appearance: none;
    font-size: 0.95rem;
    color: var(--c-txt);
    cursor: pointer;
}
.filter-form__select:focus {
    border-color: var(--c-prm);
    outline: none;
}
.filter-form__btn { min-width: 120px; }
.btn--search {
    width: 100%;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 6px;
    background: var(--c-prm);
    color: #fff;
    border: none;
    font-weight: bold;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.btn--search:hover { opacity: 0.9; }

.filter-form__active {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px dashed #ddd;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.active-tag {
    background: var(--c-prm);
    color: #fff;
    padding: 2px 10px;
    border-radius: 15px;
    font-size: 0.8rem;
}
.reset-link {
    font-size: 0.85rem;
    color: #888;
    text-decoration: underline;
    cursor: pointer;
}

/* Works Archive List */
.works-archive-list {
    padding: 60px 0 100px;
}
.works-archive-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}
.works-archive-count {
    font-size: 1.1rem;
    color: var(--c-txt);
    margin: 0;
}
.works-archive-count strong {
    font-size: 1.5rem;
    color: var(--c-prm);
}
.works-reset-link {
    font-size: 0.9rem;
    color: #888;
    text-decoration: none;
}
.works-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* Works Card Style */
.works-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    opacity: 0;
    animation: fadeSlideUp 0.6s ease forwards;
    animation-delay: var(--delay, 0s);
}
@keyframes fadeSlideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.works-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}
.works-card__link {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.works-card__image-box {
    position: relative;
    padding-top: 66.6%; /* 3:2 Aspect Ratio */
    overflow: hidden;
}
.works-card__img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.works-card:hover .works-card__img { transform: scale(1.05); }

.works-card__badge {
    position: absolute;
    top: 10px; left: 10px;
    background: var(--c-prm);
    color: #fff;
    font-size: 0.7rem;
    padding: 4px 10px;
    border-radius: 4px;
    font-weight: bold;
    z-index: 2;
}
.works-card__overlay {
    position: absolute;
    inset: 0;
    background: rgba(13, 71, 161, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 3;
}
.works-card:hover .works-card__overlay { opacity: 1; }
.works-card__view-btn {
    color: #fff;
    border: 1px solid #fff;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
}

.works-card__body {
    padding: 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.works-card__tags {
    margin-bottom: 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.works-tag {
    font-size: 0.75rem;
    padding: 3px 8px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.works-tag--area { background: #e3f2fd; color: var(--c-prm); }
.works-tag--cat { background: #fff7ed; color: #c2410c; }
.works-card__title {
    font-size: 1.1rem;
    font-weight: bold;
    margin: 0 0 15px;
    line-height: 1.4;
    color: var(--c-txt);
}
.works-card__meta {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #f0f0f0;
    padding-top: 12px;
}
.works-card__meta-item { display: flex; flex-direction: column; }
.works-card__meta-item .label { font-size: 0.7rem; color: #888; }
.works-card__meta-item .value { font-size: 0.9rem; font-weight: bold; }
.works-card__meta-item .price { color: var(--c-prm); font-size: 1rem; }

/* Pagination */
.pagination-wrapper {
    margin-top: 60px;
    display: flex;
    justify-content: center;
}
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    gap: 10px;
}
.page-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px; height: 44px;
    border: 1px solid #ddd;
    border-radius: 50%;
    text-decoration: none;
    color: var(--c-txt);
    transition: 0.3s;
}
.page-numbers.current, .page-numbers:hover {
    background: var(--c-prm);
    color: #fff;
    border-color: var(--c-prm);
}
.next, .prev { width: auto; padding: 0 20px; border-radius: 22px; }

/* No Results */
.no-results {
    text-align: center;
    padding: 50px;
    background: #fff;
    border-radius: var(--radius-l);
    border: 1px solid #eee;
}
.no-results__icon { font-size: 3rem; margin-bottom: 20px; }

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

/* Responsive */
@media (max-width: 900px) {
    .works-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .works-grid { grid-template-columns: 1fr; }
    .filter-form__inner { flex-direction: column; }
    .filter-form__group, .filter-form__btn { width: 100%; }
    .page-header { padding: 100px 0 60px; }
    .page-header__title { font-size: 2rem; }
}
</style>

<script>
// フィルターの自動送信（任意）
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('.filter-form__select');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            // 自動送信したい場合は以下のコメントアウトを外す
            // this.form.submit();
        });
    });
});
</script>