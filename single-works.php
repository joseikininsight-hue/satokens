<?php
/**
 * Template: 施工実績シングルページ
 * Description: 施工実績の詳細ページ - Before/After比較、ギャラリー、関連実績
 * 
 * @package Sato_Kenso
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// データ取得
// =============================================================================
$company_name = sato_get_company_name();
$phone = sato_get_phone();
$phone_link = sato_get_phone_link();
$line_url = sato_get_line_url();
$warranty_years = sato_get_warranty_years();

// メタデータ
$completion_date = get_post_meta(get_the_ID(), '_works_completion_date', true);
$work_period     = get_post_meta(get_the_ID(), '_works_period', true);
$work_cost       = get_post_meta(get_the_ID(), '_works_cost', true);
$paint_maker     = get_post_meta(get_the_ID(), '_works_paint_maker', true);
$paint_name      = get_post_meta(get_the_ID(), '_works_paint_name', true);
$paint_color     = get_post_meta(get_the_ID(), '_works_paint_color', true);
$client_name     = get_post_meta(get_the_ID(), '_works_client_name', true);
$client_comment  = get_post_meta(get_the_ID(), '_works_client_comment', true);
$before_image_id = get_post_meta(get_the_ID(), '_works_before_image', true);
$after_image_id  = get_post_meta(get_the_ID(), '_works_after_image', true);
$work_point      = get_post_meta(get_the_ID(), '_works_point', true);
$gallery_ids     = get_post_meta(get_the_ID(), '_works_gallery', true);

// 画像URL
$before_url = $before_image_id ? wp_get_attachment_image_url($before_image_id, 'works-large') : '';
$after_url  = $after_image_id ? wp_get_attachment_image_url($after_image_id, 'works-large') : (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'works-large') : '');
$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : $after_url;

// タクソノミー
$categories = get_the_terms(get_the_ID(), 'works_category');
$areas      = get_the_terms(get_the_ID(), 'works_area');
$buildings  = get_the_terms(get_the_ID(), 'works_building');

$category_name = (!empty($categories) && !is_wp_error($categories)) ? $categories[0]->name : '';
$area_name     = (!empty($areas) && !is_wp_error($areas)) ? $areas[0]->name : '';
$building_name = (!empty($buildings) && !is_wp_error($buildings)) ? $buildings[0]->name : '';

// 前後の記事
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<!-- 構造化データ -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "<?php echo esc_js(get_the_title()); ?>",
    "description": "<?php echo esc_js(wp_trim_words(get_the_excerpt(), 100, '...')); ?>",
    "provider": {
        "@type": "LocalBusiness",
        "name": "<?php echo esc_js($company_name); ?>",
        "url": "<?php echo esc_url(home_url('/')); ?>"
    },
    "areaServed": {
        "@type": "City",
        "name": "<?php echo esc_js($area_name ?: '御殿場市'); ?>"
    },
    "serviceType": "<?php echo esc_js($category_name ?: '外壁塗装'); ?>",
    <?php if ($thumbnail_url) : ?>
    "image": "<?php echo esc_url($thumbnail_url); ?>",
    <?php endif; ?>
    "url": "<?php echo esc_url(get_permalink()); ?>"
}
</script>

<main id="main" class="works-single" role="main">

    <!-- =========================================================================
         HERO SECTION
         ========================================================================= -->
    <section class="works-hero">
        <div class="works-hero__bg">
            <?php if ($thumbnail_url) : ?>
            <div class="works-hero__bg-image" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></div>
            <?php endif; ?>
            <div class="works-hero__bg-overlay"></div>
        </div>
        
        <div class="container">
            <?php sato_breadcrumb(); ?>
            
            <div class="works-hero__content">
                <!-- タグ -->
                <div class="works-hero__tags">
                    <?php if ($category_name) : ?>
                    <span class="works-hero__tag works-hero__tag--category"><?php echo esc_html($category_name); ?></span>
                    <?php endif; ?>
                    <?php if ($area_name) : ?>
                    <span class="works-hero__tag works-hero__tag--area">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <?php echo esc_html($area_name); ?>
                    </span>
                    <?php endif; ?>
                    <?php if ($building_name) : ?>
                    <span class="works-hero__tag works-hero__tag--building"><?php echo esc_html($building_name); ?></span>
                    <?php endif; ?>
                </div>
                
                <!-- タイトル -->
                <h1 class="works-hero__title"><?php the_title(); ?></h1>
                
                <!-- メタ情報 -->
                <?php if ($completion_date || $client_name) : ?>
                <div class="works-hero__meta">
                    <?php if ($completion_date) : ?>
                    <span class="works-hero__meta-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <?php echo esc_html(date('Y年n月', strtotime($completion_date))); ?>完工
                    </span>
                    <?php endif; ?>
                    <?php if ($client_name) : ?>
                    <span class="works-hero__meta-item">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <?php echo esc_html($client_name); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         MAIN CONTENT
         ========================================================================= -->
    <div class="works-content">
        <div class="container">
            <div class="works-content__grid">
                
                <!-- メインコンテンツ -->
                <div class="works-main">
                    
                    <!-- Before/After セクション -->
                    <?php if ($before_url && $after_url) : ?>
                    <section class="works-section works-ba" aria-labelledby="ba-heading">
                        <div class="works-section__header">
                            <h2 class="works-section__title" id="ba-heading">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                Before / After
                            </h2>
                            <p class="works-section__desc">スライダーを動かして施工前後を比較できます</p>
                        </div>
                        
                        <div class="ba-compare">
                            <div class="ba-compare__slider">
                                <!-- After -->
                                <div class="ba-compare__after">
                                    <img src="<?php echo esc_url($after_url); ?>" alt="施工後の様子" loading="lazy">
                                    <span class="ba-compare__label ba-compare__label--after">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        After
                                    </span>
                                </div>
                                <!-- Before -->
                                <div class="ba-compare__before">
                                    <img src="<?php echo esc_url($before_url); ?>" alt="施工前の様子" loading="lazy">
                                    <span class="ba-compare__label ba-compare__label--before">Before</span>
                                </div>
                                <!-- スライダー -->
                                <input type="range" class="ba-compare__range" min="0" max="100" value="50" aria-label="Before/After比較スライダー">
                                <div class="ba-compare__handle">
                                    <span class="ba-compare__handle-icon">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="15 18 9 12 15 6"/>
                                        </svg>
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- 個別画像 -->
                            <div class="ba-compare__images">
                                <figure class="ba-compare__figure">
                                    <img src="<?php echo esc_url($before_url); ?>" alt="施工前" loading="lazy">
                                    <figcaption>Before（施工前）</figcaption>
                                </figure>
                                <figure class="ba-compare__figure">
                                    <img src="<?php echo esc_url($after_url); ?>" alt="施工後" loading="lazy">
                                    <figcaption>After（施工後）</figcaption>
                                </figure>
                            </div>
                        </div>
                    </section>
                    <?php elseif ($thumbnail_url) : ?>
                    <!-- サムネイルのみ表示 -->
                    <section class="works-section works-main-image">
                        <figure class="works-main-image__figure">
                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </figure>
                    </section>
                    <?php endif; ?>
                    
                    <!-- 施工概要 -->
                    <?php if (get_the_content()) : ?>
                    <section class="works-section works-overview" aria-labelledby="overview-heading">
                        <div class="works-section__header">
                            <h2 class="works-section__title" id="overview-heading">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                                施工概要
                            </h2>
                        </div>
                        
                        <div class="works-overview__content entry-content">
                            <?php the_content(); ?>
                        </div>
                    </section>
                    <?php endif; ?>
                    
                    <!-- 施工のポイント -->
                    <?php if ($work_point) : ?>
                    <section class="works-section works-point" aria-labelledby="point-heading">
                        <div class="works-section__header">
                            <h2 class="works-section__title" id="point-heading">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                                施工のポイント・こだわり
                            </h2>
                        </div>
                        
                        <div class="works-point__content">
                            <?php echo wp_kses_post(wpautop($work_point)); ?>
                        </div>
                    </section>
                    <?php endif; ?>
                    
                    <!-- 施工ギャラリー -->
                    <?php if (!empty($gallery_ids) && is_array($gallery_ids)) : ?>
                    <section class="works-section works-gallery" aria-labelledby="gallery-heading">
                        <div class="works-section__header">
                            <h2 class="works-section__title" id="gallery-heading">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                                施工写真ギャラリー
                            </h2>
                        </div>
                        
                        <div class="works-gallery__grid">
                            <?php foreach ($gallery_ids as $image_id) : 
                                $img_url = wp_get_attachment_image_url($image_id, 'works-large');
                                $img_full = wp_get_attachment_image_url($image_id, 'full');
                                $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true) ?: '施工写真';
                                if (!$img_url) continue;
                            ?>
                            <figure class="works-gallery__item">
                                <a href="<?php echo esc_url($img_full); ?>" class="works-gallery__link" data-lightbox="works-gallery">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
                                    <span class="works-gallery__zoom">
                                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"/>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                            <line x1="11" y1="8" x2="11" y2="14"/>
                                            <line x1="8" y1="11" x2="14" y2="11"/>
                                        </svg>
                                    </span>
                                </a>
                            </figure>
                            <?php endforeach; ?>
                        </div>
                    </section>
                    <?php endif; ?>
                    
                    <!-- お客様の声 -->
                    <?php if ($client_comment) : ?>
                    <section class="works-section works-voice" aria-labelledby="voice-heading">
                        <div class="works-section__header">
                            <h2 class="works-section__title" id="voice-heading">
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                                お客様の声
                            </h2>
                        </div>
                        
                        <blockquote class="works-voice__quote">
                            <div class="works-voice__content">
                                <?php echo wp_kses_post(wpautop($client_comment)); ?>
                            </div>
                            <?php if ($client_name) : ?>
                            <footer class="works-voice__footer">
                                <cite class="works-voice__cite">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    <?php echo esc_html($client_name); ?>様
                                </cite>
                            </footer>
                            <?php endif; ?>
                        </blockquote>
                    </section>
                    <?php endif; ?>

                </div>

                <!-- サイドバー -->
                <aside class="works-sidebar">
                    
                    <!-- 施工データ -->
                    <div class="works-sidebar__card works-data">
                        <h3 class="works-sidebar__title">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                <line x1="3" y1="9" x2="21" y2="9"/>
                                <line x1="9" y1="21" x2="9" y2="9"/>
                            </svg>
                            施工データ
                        </h3>
                        
                        <dl class="works-data__list">
                            <?php if ($area_name || $client_name) : ?>
                            <div class="works-data__item">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    エリア
                                </dt>
                                <dd><?php echo esc_html($client_name ?: $area_name); ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($category_name) : ?>
                            <div class="works-data__item">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                                    </svg>
                                    施工内容
                                </dt>
                                <dd><?php echo esc_html($category_name); ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($building_name) : ?>
                            <div class="works-data__item">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                        <polyline points="9 22 9 12 15 12 15 22"/>
                                    </svg>
                                    建物タイプ
                                </dt>
                                <dd><?php echo esc_html($building_name); ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($work_period) : ?>
                            <div class="works-data__item">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    施工期間
                                </dt>
                                <dd><?php echo esc_html($work_period); ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($completion_date) : ?>
                            <div class="works-data__item">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    完工日
                                </dt>
                                <dd><?php echo esc_html(date('Y年n月', strtotime($completion_date))); ?></dd>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($work_cost) : ?>
                            <div class="works-data__item works-data__item--highlight">
                                <dt>
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="1" x2="12" y2="23"/>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                                    </svg>
                                    施工費用
                                </dt>
                                <dd><strong><?php echo esc_html($work_cost); ?></strong></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                    
                    <!-- 使用塗料 -->
                    <?php if ($paint_maker || $paint_name || $paint_color) : ?>
                    <div class="works-sidebar__card works-paint">
                        <h3 class="works-sidebar__title">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v4c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                                <path d="M12 11v10"/>
                                <path d="M8 21h8"/>
                            </svg>
                            使用塗料
                        </h3>
                        
                        <dl class="works-paint__list">
                            <?php if ($paint_maker) : ?>
                            <div class="works-paint__item">
                                <dt>メーカー</dt>
                                <dd><?php echo esc_html($paint_maker); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ($paint_name) : ?>
                            <div class="works-paint__item">
                                <dt>塗料名</dt>
                                <dd><?php echo esc_html($paint_name); ?></dd>
                            </div>
                            <?php endif; ?>
                            <?php if ($paint_color) : ?>
                            <div class="works-paint__item">
                                <dt>カラー</dt>
                                <dd><?php echo esc_html($paint_color); ?></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                    <?php endif; ?>
                    
                    <!-- CTA -->
                    <div class="works-sidebar__card works-sidebar-cta">
                        <div class="works-sidebar-cta__badge">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                            最長<?php echo esc_html($warranty_years); ?>年保証
                        </div>
                        
                        <h3 class="works-sidebar-cta__title">
                            あなたのお住まいも<br>
                            <span>キレイに生まれ変わります</span>
                        </h3>
                        
                        <p class="works-sidebar-cta__text">
                            まずは無料診断から。<br>
                            お見積りは無料です。
                        </p>
                        
                        <div class="works-sidebar-cta__buttons">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--block">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                無料お見積り
                            </a>
                            <a href="<?php echo esc_attr($phone_link); ?>" class="btn btn--outline btn--block">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <?php echo esc_html($phone); ?>
                            </a>
                        </div>
                    </div>
                    
                </aside>

            </div>
        </div>
    </div>

    <!-- =========================================================================
         RELATED WORKS
         ========================================================================= -->
    <?php
    // 関連施工実績を取得
    $related_args = [
        'post_type'      => 'works',
        'posts_per_page' => 3,
        'post__not_in'   => [get_the_ID()],
        'post_status'    => 'publish',
    ];
    
    // 同じカテゴリーの実績を優先
    if (!empty($categories) && !is_wp_error($categories)) {
        $related_args['tax_query'] = [
            [
                'taxonomy' => 'works_category',
                'field'    => 'term_id',
                'terms'    => wp_list_pluck($categories, 'term_id'),
            ],
        ];
    }
    
    $related_works = new WP_Query($related_args);
    
    if ($related_works->have_posts()) :
    ?>
    <section class="works-related" aria-labelledby="related-heading">
        <div class="container">
            <header class="works-related__header">
                <h2 class="works-related__title" id="related-heading">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    関連する施工実績
                </h2>
                <a href="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="works-related__link">
                    すべての実績を見る
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </header>
            
            <div class="works-related__grid">
                <?php while ($related_works->have_posts()) : $related_works->the_post();
                    $rel_thumbnail = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'works-card') : 'https://placehold.co/400x300/1e3a5f/ffffff?text=Works';
                    $rel_categories = get_the_terms(get_the_ID(), 'works_category');
                    $rel_areas = get_the_terms(get_the_ID(), 'works_area');
                ?>
                <article class="works-related__card">
                    <a href="<?php the_permalink(); ?>" class="works-related__card-link">
                        <div class="works-related__card-image">
                            <img src="<?php echo esc_url($rel_thumbnail); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        </div>
                        <div class="works-related__card-body">
                            <div class="works-related__card-tags">
                                <?php if (!empty($rel_categories) && !is_wp_error($rel_categories)) : ?>
                                <span class="works-tag works-tag--category"><?php echo esc_html($rel_categories[0]->name); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3 class="works-related__card-title"><?php the_title(); ?></h3>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- =========================================================================
         POST NAVIGATION
         ========================================================================= -->
    <nav class="works-nav" aria-label="前後の施工実績">
        <div class="container">
            <div class="works-nav__inner">
                <?php if ($prev_post) : ?>
                <a href="<?php echo get_permalink($prev_post); ?>" class="works-nav__link works-nav__link--prev">
                    <span class="works-nav__arrow">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                    </span>
                    <span class="works-nav__content">
                        <span class="works-nav__label">前の実績</span>
                        <span class="works-nav__title"><?php echo esc_html($prev_post->post_title); ?></span>
                    </span>
                </a>
                <?php else : ?>
                <span class="works-nav__placeholder"></span>
                <?php endif; ?>
                
                <a href="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="works-nav__archive">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"/>
                        <rect x="14" y="3" width="7" height="7"/>
                        <rect x="14" y="14" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/>
                    </svg>
                    一覧へ戻る
                </a>
                
                <?php if ($next_post) : ?>
                <a href="<?php echo get_permalink($next_post); ?>" class="works-nav__link works-nav__link--next">
                    <span class="works-nav__content">
                        <span class="works-nav__label">次の実績</span>
                        <span class="works-nav__title"><?php echo esc_html($next_post->post_title); ?></span>
                    </span>
                    <span class="works-nav__arrow">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </span>
                </a>
                <?php else : ?>
                <span class="works-nav__placeholder"></span>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- =========================================================================
         CTA SECTION
         ========================================================================= -->
    <section class="works-cta-full">
        <div class="works-cta-full__bg"></div>
        <div class="container">
            <div class="works-cta-full__inner">
                <div class="works-cta-full__content">
                    <h2 class="works-cta-full__title">
                        この施工事例のような<br>
                        <span>仕上がりをあなたのお住まいにも</span>
                    </h2>
                    <p class="works-cta-full__text">
                        無料診断・お見積りは随時受付中。<br>
                        お気軽にお問い合わせください。
                    </p>
                </div>
                <div class="works-cta-full__actions">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn--accent btn--xl">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        無料お見積り依頼
                    </a>
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="btn btn--line btn--lg" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.627-.63.349 0 .631.285.631.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.349 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.281.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                        </svg>
                        LINEで相談する
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
/* =============================================================================
   WORKS SINGLE - CSS
   ============================================================================= */

/* Variables */
:root {
    --color-primary: #0d47a1;
    --color-primary-dark: #002171;
    --color-primary-light: #5472d3;
    --color-accent: #f59e0b;
    --color-line: #06c755;
    --color-text: #1a1a1a;
    --color-text-light: #666666;
    --color-text-muted: #999999;
    --color-bg: #ffffff;
    --color-bg-light: #f8fafc;
    --color-border: #e2e8f0;
    --radius-md: 8px;
    --radius-lg: 16px;
    --radius-xl: 24px;
    --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
    --transition-base: 0.3s ease;
}

/* Works Hero */
.works-hero {
    position: relative;
    padding: 120px 0 80px;
    overflow: hidden;
}

.works-hero__bg {
    position: absolute;
    inset: 0;
}

.works-hero__bg-image {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    filter: blur(2px);
    transform: scale(1.05);
}

.works-hero__bg-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(13, 71, 161, 0.95) 0%,
        rgba(21, 101, 192, 0.9) 50%,
        rgba(25, 118, 210, 0.85) 100%
    );
}

.works-hero .container {
    position: relative;
    z-index: 1;
}

.works-hero .breadcrumb {
    margin-bottom: 2rem;
}

.works-hero .breadcrumb__link,
.works-hero .breadcrumb__current,
.works-hero .breadcrumb__separator {
    color: rgba(255,255,255,0.8);
}

.works-hero .breadcrumb__link:hover {
    color: #fff;
}

.works-hero__content {
    color: #fff;
}

.works-hero__tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.works-hero__tag {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.875rem;
    font-size: 0.8125rem;
    font-weight: 600;
    border-radius: 9999px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(4px);
}

.works-hero__tag--category {
    background: var(--color-accent);
    color: #fff;
}

.works-hero__title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 900;
    margin: 0 0 1rem;
    line-height: 1.3;
}

.works-hero__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.works-hero__meta-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    opacity: 0.9;
}

@media (max-width: 768px) {
    .works-hero {
        padding: 100px 0 60px;
    }
}

/* Works Content Layout */
.works-content {
    padding: 3rem 0;
    background: var(--color-bg-light);
}

.works-content__grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 2.5rem;
    align-items: start;
}

@media (max-width: 1024px) {
    .works-content__grid {
        grid-template-columns: 1fr;
    }
}

/* Works Main */
.works-main {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Works Section */
.works-section {
    background: #fff;
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-md);
}

.works-section__header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--color-bg-light);
}

.works-section__title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    color: var(--color-primary);
}

.works-section__desc {
    font-size: 0.875rem;
    color: var(--color-text-light);
    margin: 0.5rem 0 0;
}

/* Before/After Compare */
.ba-compare__slider {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    border-radius: var(--radius-lg);
    margin-bottom: 1.5rem;
}

.ba-compare__after,
.ba-compare__before {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.ba-compare__before {
    clip-path: inset(0 50% 0 0);
    z-index: 2;
}

.ba-compare__after img,
.ba-compare__before img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ba-compare__label {
    position: absolute;
    top: 16px;
    padding: 0.5rem 1rem;
    font-size: 0.8125rem;
    font-weight: 700;
    color: #fff;
    border-radius: var(--radius-md);
    z-index: 3;
}

.ba-compare__label--before {
    left: 16px;
    background: rgba(0, 0, 0, 0.7);
}

.ba-compare__label--after {
    right: 16px;
    background: var(--color-primary);
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.ba-compare__range {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    margin: 0;
    opacity: 0;
    cursor: ew-resize;
    z-index: 10;
}

.ba-compare__handle {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 4px;
    background: #fff;
    transform: translateX(-50%);
    z-index: 5;
    pointer-events: none;
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
}

.ba-compare__handle::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 56px;
    height: 56px;
    background: #fff;
    border-radius: 50%;
    box-shadow: var(--shadow-lg);
}

.ba-compare__handle-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    align-items: center;
    color: var(--color-primary);
    z-index: 1;
}

.ba-compare__images {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.ba-compare__figure {
    margin: 0;
}

.ba-compare__figure img {
    width: 100%;
    border-radius: var(--radius-md);
}

.ba-compare__figure figcaption {
    text-align: center;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-text-light);
    margin-top: 0.5rem;
}

/* Works Overview */
.works-overview__content {
    line-height: 1.9;
    color: var(--color-text);
}

.works-overview__content p {
    margin: 0 0 1em;
}

.works-overview__content p:last-child {
    margin-bottom: 0;
}

/* Works Point */
.works-point__content {
    padding: 1.5rem;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-radius: var(--radius-lg);
    border-left: 4px solid var(--color-primary);
    line-height: 1.8;
}

.works-point__content p {
    margin: 0;
}

/* Works Gallery */
.works-gallery__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

@media (max-width: 768px) {
    .works-gallery__grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.works-gallery__item {
    margin: 0;
}

.works-gallery__link {
    display: block;
    position: relative;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    border-radius: var(--radius-md);
}

.works-gallery__link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.works-gallery__link:hover img {
    transform: scale(1.1);
}

.works-gallery__zoom {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(13, 71, 161, 0.8);
    color: #fff;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.works-gallery__link:hover .works-gallery__zoom {
    opacity: 1;
}

/* Works Voice */
.works-voice__quote {
    margin: 0;
    padding: 2rem;
    background: var(--color-bg-light);
    border-radius: var(--radius-lg);
    position: relative;
}

.works-voice__quote::before {
    content: '';
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    width: 48px;
    height: 48px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230d47a1' opacity='0.1'%3E%3Cpath d='M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z'/%3E%3C/svg%3E");
    background-size: contain;
    opacity: 0.2;
}

.works-voice__content {
    position: relative;
    z-index: 1;
    font-size: 1rem;
    line-height: 1.9;
    color: var(--color-text);
}

.works-voice__content p {
    margin: 0;
}

.works-voice__footer {
    margin-top: 1.5rem;
    padding-top: 1rem;
    border-top: 1px dashed var(--color-border);
}

.works-voice__cite {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-style: normal;
    font-weight: 600;
    color: var(--color-primary);
}

/* Works Sidebar */
.works-sidebar {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    position: sticky;
    top: 100px;
}

@media (max-width: 1024px) {
    .works-sidebar {
        position: static;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .works-sidebar {
        grid-template-columns: 1fr;
    }
}

.works-sidebar__card {
    background: #fff;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-md);
}

.works-sidebar__title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--color-bg-light);
    color: var(--color-primary);
}

/* Works Data */
.works-data__list {
    margin: 0;
}

.works-data__item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px dashed var(--color-border);
}

.works-data__item:last-child {
    border-bottom: none;
}

.works-data__item dt {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    color: var(--color-text-light);
}

.works-data__item dd {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0;
}

.works-data__item--highlight {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    margin: 0.5rem -1.5rem -1.5rem;
    padding: 1rem 1.5rem;
    border-radius: 0 0 var(--radius-lg) var(--radius-lg);
    border-bottom: none;
}

.works-data__item--highlight dd strong {
    font-size: 1.125rem;
    color: var(--color-accent);
}

/* Works Paint */
.works-paint__list {
    margin: 0;
}

.works-paint__item {
    padding: 0.625rem 0;
    border-bottom: 1px dashed var(--color-border);
}

.works-paint__item:last-child {
    border-bottom: none;
}

.works-paint__item dt {
    font-size: 0.75rem;
    color: var(--color-text-muted);
    margin-bottom: 0.25rem;
}

.works-paint__item dd {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0;
}

/* Works Sidebar CTA */
.works-sidebar-cta {
    background: linear-gradient(135deg, #0d47a1 0%, #002171 100%);
    color: #fff;
}

@media (max-width: 1024px) {
    .works-sidebar-cta {
        grid-column: 1 / -1;
    }
}

.works-sidebar-cta__badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 1rem;
    background: rgba(255,255,255,0.15);
    border-radius: 9999px;
    font-size: 0.8125rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.works-sidebar-cta__title {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 0 0 0.75rem;
    line-height: 1.5;
}

.works-sidebar-cta__title span {
    color: var(--color-accent);
}

.works-sidebar-cta__text {
    font-size: 0.875rem;
    opacity: 0.9;
    margin: 0 0 1.25rem;
    line-height: 1.7;
}

.works-sidebar-cta__buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.works-sidebar-cta .btn--outline {
    border-color: rgba(255,255,255,0.5);
    color: #fff;
}

.works-sidebar-cta .btn--outline:hover {
    background: #fff;
    border-color: #fff;
    color: var(--color-primary);
}

/* Works Related */
.works-related {
    padding: 4rem 0;
    background: #fff;
}

.works-related__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.works-related__title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: var(--color-text);
}

.works-related__link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-primary);
    transition: gap 0.3s ease;
}

.works-related__link:hover {
    gap: 0.75rem;
}

.works-related__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

@media (max-width: 768px) {
    .works-related__header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .works-related__grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

.works-related__card {
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.works-related__card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.works-related__card-link {
    display: block;
}

.works-related__card-image {
    aspect-ratio: 4 / 3;
    overflow: hidden;
}

.works-related__card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.works-related__card:hover .works-related__card-image img {
    transform: scale(1.1);
}

.works-related__card-body {
    padding: 1.25rem;
    background: #fff;
}

.works-related__card-tags {
    margin-bottom: 0.5rem;
}

.works-related__card-title {
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
    color: var(--color-text);
    line-height: 1.5;
}

/* Works Nav */
.works-nav {
    background: var(--color-bg-light);
    padding: 2rem 0;
    border-top: 1px solid var(--color-border);
    border-bottom: 1px solid var(--color-border);
}

.works-nav__inner {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 2rem;
    align-items: center;
}

@media (max-width: 768px) {
    .works-nav__inner {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

.works-nav__link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    transition: var(--transition-base);
}

.works-nav__link:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.works-nav__link--prev {
    justify-content: flex-start;
}

.works-nav__link--next {
    justify-content: flex-end;
    text-align: right;
}

@media (max-width: 768px) {
    .works-nav__link--next {
        justify-content: flex-start;
        text-align: left;
        flex-direction: row-reverse;
    }
}

.works-nav__arrow {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background: var(--color-bg-light);
    border-radius: 50%;
    color: var(--color-primary);
    transition: var(--transition-base);
}

.works-nav__link:hover .works-nav__arrow {
    background: var(--color-primary);
    color: #fff;
}

.works-nav__content {
    flex: 1;
    min-width: 0;
}

.works-nav__label {
    display: block;
    font-size: 0.75rem;
    color: var(--color-text-muted);
    margin-bottom: 0.25rem;
}

.works-nav__title {
    display: block;
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-text);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.works-nav__placeholder {
    display: block;
}

.works-nav__archive {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: var(--color-primary);
    color: #fff;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 9999px;
    transition: var(--transition-base);
}

.works-nav__archive:hover {
    background: var(--color-primary-dark);
}

@media (max-width: 768px) {
    .works-nav__archive {
        order: -1;
        justify-self: center;
    }
}

/* Works CTA Full */
.works-cta-full {
    position: relative;
    padding: 5rem 0;
    overflow: hidden;
}

.works-cta-full__bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #0d47a1 0%, #002171 100%);
}

.works-cta-full__bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.works-cta-full .container {
    position: relative;
    z-index: 1;
}

.works-cta-full__inner {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 3rem;
    align-items: center;
}

@media (max-width: 768px) {
    .works-cta-full__inner {
        grid-template-columns: 1fr;
        text-align: center;
    }
}

.works-cta-full__content {
    color: #fff;
}

.works-cta-full__title {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 900;
    margin: 0 0 1rem;
    line-height: 1.4;
}

.works-cta-full__title span {
    color: var(--color-accent);
}

.works-cta-full__text {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
    line-height: 1.8;
}

.works-cta-full__actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

@media (max-width: 768px) {
    .works-cta-full__actions {
        width: 100%;
    }
}

/* Tags */
.works-tag {
    display: inline-block;
    padding: 0.25em 0.75em;
    font-size: 0.6875rem;
    font-weight: 600;
    border-radius: 9999px;
    letter-spacing: 0.03em;
}

.works-tag--category {
    background: #dbeafe;
    color: #1e40af;
}

.works-tag--area {
    background: #fef3c7;
    color: #92400e;
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.9375rem;
    font-weight: 700;
    border: 2px solid transparent;
    border-radius: 9999px;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
    text-decoration: none;
}

.btn--primary {
    background: var(--color-primary);
    color: #fff;
}

.btn--primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
}

.btn--accent {
    background: var(--color-accent);
    color: #fff;
}

.btn--accent:hover {
    background: #d97706;
    transform: translateY(-2px);
}

.btn--outline {
    background: transparent;
    border-color: var(--color-primary);
    color: var(--color-primary);
}

.btn--outline:hover {
    background: var(--color-primary);
    color: #fff;
}

.btn--line {
    background: var(--color-line);
    color: #fff;
}

.btn--line:hover {
    background: #05b04a;
}

.btn--lg {
    padding: 0.btn--lg {
    padding: 0.875rem 2rem;
    font-size: 1rem;
}

.btn--xl {
    padding: 1rem 2.5rem;
    font-size: 1.0625rem;
}

.btn--block {
    width: 100%;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Entry Content */
.entry-content h2 {
    font-size: 1.375rem;
    font-weight: 700;
    margin: 2rem 0 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--color-primary);
    color: var(--color-text);
}

.entry-content h3 {
    font-size: 1.125rem;
    font-weight: 700;
    margin: 1.5rem 0 0.75rem;
    color: var(--color-text);
}

.entry-content p {
    margin: 0 0 1em;
    line-height: 1.9;
}

.entry-content ul,
.entry-content ol {
    margin: 0 0 1.5em;
    padding-left: 1.5em;
}

.entry-content li {
    margin-bottom: 0.5em;
    line-height: 1.8;
}

.entry-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-md);
    margin: 1rem 0;
}

/* Works Main Image (fallback) */
.works-main-image__figure {
    margin: 0;
}

.works-main-image__figure img {
    width: 100%;
    border-radius: var(--radius-lg);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .works-sidebar-cta {
        grid-column: 1 / -1;
    }
}

@media (max-width: 768px) {
    .ba-compare__images {
        grid-template-columns: 1fr;
    }
    
    .works-section {
        padding: 1.5rem;
    }
}

/* Print Styles */
@media print {
    .works-hero__bg,
    .works-sidebar-cta,
    .works-cta-full,
    .works-nav,
    .works-related {
        display: none;
    }
    
    .works-content__grid {
        grid-template-columns: 1fr;
    }
    
    .works-sidebar {
        display: none;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
    }
}

:focus-visible {
    outline: 3px solid var(--color-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    // ==========================================================================
    // Before/After Slider
    // ==========================================================================
    const baSliders = document.querySelectorAll('.ba-compare__slider');
    
    baSliders.forEach(slider => {
        const rangeInput = slider.querySelector('.ba-compare__range');
        const beforeLayer = slider.querySelector('.ba-compare__before');
        const handle = slider.querySelector('.ba-compare__handle');
        
        if (!rangeInput || !beforeLayer || !handle) return;
        
        const updateSlider = (value) => {
            beforeLayer.style.clipPath = `inset(0 ${100 - value}% 0 0)`;
            handle.style.left = `${value}%`;
        };
        
        // Initialize
        updateSlider(50);
        
        // Range input event
        rangeInput.addEventListener('input', (e) => {
            updateSlider(e.target.value);
        });
        
        // Touch/Mouse drag support
        let isDragging = false;
        
        const startDrag = (e) => {
            isDragging = true;
            updatePosition(e);
        };
        
        const endDrag = () => {
            isDragging = false;
        };
        
        const updatePosition = (e) => {
            if (!isDragging && e.type !== 'click') return;
            
            const rect = slider.getBoundingClientRect();
            let clientX;
            
            if (e.touches && e.touches[0]) {
                clientX = e.touches[0].clientX;
            } else {
                clientX = e.clientX;
            }
            
            let position = ((clientX - rect.left) / rect.width) * 100;
            position = Math.max(0, Math.min(100, position));
            
            rangeInput.value = position;
            updateSlider(position);
        };
        
        slider.addEventListener('mousedown', startDrag);
        slider.addEventListener('mousemove', updatePosition);
        slider.addEventListener('mouseup', endDrag);
        slider.addEventListener('mouseleave', endDrag);
        
        slider.addEventListener('touchstart', startDrag, { passive: true });
        slider.addEventListener('touchmove', updatePosition, { passive: true });
        slider.addEventListener('touchend', endDrag);
    });

    // ==========================================================================
    // Simple Lightbox for Gallery
    // ==========================================================================
    const galleryLinks = document.querySelectorAll('.works-gallery__link');
    
    if (galleryLinks.length > 0) {
        // Create lightbox elements
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox__overlay"></div>
            <div class="lightbox__content">
                <button class="lightbox__close" aria-label="閉じる">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                <button class="lightbox__prev" aria-label="前へ">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"/>
                    </svg>
                </button>
                <button class="lightbox__next" aria-label="次へ">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
                <img class="lightbox__image" src="" alt="">
            </div>
        `;
        document.body.appendChild(lightbox);
        
        // Add lightbox styles
        const lightboxStyles = document.createElement('style');
        lightboxStyles.textContent = `
            .lightbox {
                position: fixed;
                inset: 0;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }
            .lightbox.is-active {
                opacity: 1;
                visibility: visible;
            }
            .lightbox__overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.9);
            }
            .lightbox__content {
                position: relative;
                max-width: 90vw;
                max-height: 90vh;
            }
            .lightbox__image {
                display: block;
                max-width: 90vw;
                max-height: 90vh;
                object-fit: contain;
                border-radius: 8px;
            }
            .lightbox__close,
            .lightbox__prev,
            .lightbox__next {
                position: absolute;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 48px;
                height: 48px;
                background: rgba(255, 255, 255, 0.1);
                border: none;
                border-radius: 50%;
                color: #fff;
                cursor: pointer;
                transition: background 0.3s ease;
            }
            .lightbox__close:hover,
            .lightbox__prev:hover,
            .lightbox__next:hover {
                background: rgba(255, 255, 255, 0.2);
            }
            .lightbox__close {
                top: -60px;
                right: 0;
            }
            .lightbox__prev {
                left: -60px;
                top: 50%;
                transform: translateY(-50%);
            }
            .lightbox__next {
                right: -60px;
                top: 50%;
                transform: translateY(-50%);
            }
            @media (max-width: 768px) {
                .lightbox__prev {
                    left: 10px;
                    top: auto;
                    bottom: -60px;
                    transform: none;
                }
                .lightbox__next {
                    right: 10px;
                    top: auto;
                    bottom: -60px;
                    transform: none;
                }
                .lightbox__close {
                    top: 10px;
                    right: 10px;
                }
            }
        `;
        document.head.appendChild(lightboxStyles);
        
        const lightboxImage = lightbox.querySelector('.lightbox__image');
        const closeBtn = lightbox.querySelector('.lightbox__close');
        const prevBtn = lightbox.querySelector('.lightbox__prev');
        const nextBtn = lightbox.querySelector('.lightbox__next');
        const overlay = lightbox.querySelector('.lightbox__overlay');
        
        let currentIndex = 0;
        const images = Array.from(galleryLinks).map(link => link.href);
        
        const showImage = (index) => {
            currentIndex = index;
            lightboxImage.src = images[index];
            lightbox.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        };
        
        const closeLightbox = () => {
            lightbox.classList.remove('is-active');
            document.body.style.overflow = '';
        };
        
        const showPrev = () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            lightboxImage.src = images[currentIndex];
        };
        
        const showNext = () => {
            currentIndex = (currentIndex + 1) % images.length;
            lightboxImage.src = images[currentIndex];
        };
        
        galleryLinks.forEach((link, index) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                showImage(index);
            });
        });
        
        closeBtn.addEventListener('click', closeLightbox);
        overlay.addEventListener('click', closeLightbox);
        prevBtn.addEventListener('click', showPrev);
        nextBtn.addEventListener('click', showNext);
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox.classList.contains('is-active')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') showPrev();
            if (e.key === 'ArrowRight') showNext();
        });
    }
});
</script>

<?php get_footer(); ?>
