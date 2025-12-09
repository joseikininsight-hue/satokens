<?php
/**
 * Main Template File
 * * @package Sato_Kenso
 * @version 3.0.0
 */

get_header(); 
?>

<main id="main-content" class="site-main">
    
    <div class="page-header bg-primary-light section--tight">
        <div class="container">
            <?php if (is_home() && !is_front_page()) : ?>
                <h1 class="page-title text-center text-primary text-2xl font-bold">お知らせ・ブログ</h1>
            <?php elseif (is_archive()) : ?>
                <h1 class="page-title text-center text-primary text-2xl font-bold"><?php the_archive_title(); ?></h1>
            <?php elseif (is_search()) : ?>
                <h1 class="page-title text-center text-primary text-2xl font-bold">「<?php echo get_search_query(); ?>」の検索結果</h1>
            <?php else : ?>
                <h1 class="page-title text-center text-primary text-2xl font-bold"><?php the_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="col-span-2">
                    <?php if (have_posts()) : ?>
                        <div class="post-list flex flex-col gap-8">
                            <?php while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="card__image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="card__content">
                                        <header class="entry-header mb-4">
                                            <div class="entry-meta text-sm text-muted mb-2">
                                                <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date(); ?></time>
                                                <span class="sep"> | </span>
                                                <span class="cat-links"><?php the_category(', '); ?></span>
                                            </div>
                                            <h2 class="entry-title text-xl font-bold">
                                                <a href="<?php the_permalink(); ?>" class="text-primary hover:text-primary-light"><?php the_title(); ?></a>
                                            </h2>
                                        </header>

                                        <div class="entry-summary text-base text-gray-600 mb-4">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <footer class="entry-footer">
                                            <a href="<?php the_permalink(); ?>" class="btn btn--outline btn--sm">
                                                続きを読む <?php echo sato_get_svg_icon('arrow-right', 16); ?>
                                            </a>
                                        </footer>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>

                        <div class="pagination mt-12 text-center">
                            <?php
                            the_posts_pagination([
                                'mid_size'  => 2,
                                'prev_text' => '&larr; 前へ',
                                'next_text' => '次へ &rarr;',
                            ]);
                            ?>
                        </div>

                    <?php else : ?>
                        <div class="no-results text-center py-12">
                            <p class="text-lg text-gray-600">記事が見つかりませんでした。</p>
                            <div class="mt-8">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--primary">トップページに戻る</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <aside class="sidebar col-span-1">
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    <?php else : ?>
                        <div class="widget card p-6 mb-8">
                            <h3 class="widget-title text-lg font-bold border-b pb-2 mb-4">カテゴリー</h3>
                            <ul>
                                <?php wp_list_categories(['title_li' => '']); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </aside>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
