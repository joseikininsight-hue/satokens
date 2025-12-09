<?php
/**
 * Theme Name: サトー建装 公式Webサイトテーマ
 * Theme URI: https://satokens.jp/
 * Author: Sato Kenso
 * Author URI: https://satokens.jp/
 * Description: 静岡県御殿場市・東部エリアの塗装専門店「サトー建装」公式テーマ - SEO最適化・高速表示・顧客獲得に特化
 * Version: 3.0.0
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sato-kenso
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * 
 * @package Sato_Kenso
 */

// =============================================================================
// セキュリティ: 直接アクセス防止
// =============================================================================
if (!defined('ABSPATH')) {
    exit;
}

// =============================================================================
// 定数定義
// =============================================================================
define('SATO_THEME_VERSION', '3.0.0');
define('SATO_THEME_DIR', get_template_directory());
define('SATO_THEME_URI', get_template_directory_uri());
define('SATO_THEME_ASSETS', SATO_THEME_URI . '/assets');
define('SATO_THEME_ASSETS_DIR', SATO_THEME_DIR . '/assets');

// =============================================================================
// テーマセットアップ
// =============================================================================
if (!function_exists('sato_theme_setup')) {
    function sato_theme_setup() {
        // 翻訳ファイルの読み込み
        load_theme_textdomain('sato-kenso', SATO_THEME_DIR . '/languages');

        // HTML5マークアップサポート
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        ]);

        // タイトルタグ自動生成
        add_theme_support('title-tag');

        // アイキャッチ画像
        add_theme_support('post-thumbnails');

        // カスタムロゴ
        add_theme_support('custom-logo', [
            'height'      => 80,
            'width'       => 300,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => ['site-title', 'site-description'],
        ]);

        // RSSフィードリンク
        add_theme_support('automatic-feed-links');

        // レスポンシブ埋め込み
        add_theme_support('responsive-embeds');

        // align-wide / align-full サポート
        add_theme_support('align-wide');

        // エディタースタイル
        add_theme_support('editor-styles');
        add_editor_style('assets/css/editor-style.css');

        // カスタム背景
        add_theme_support('custom-background', [
            'default-color' => 'ffffff',
        ]);

        // 部分リフレッシュ（カスタマイザー）
        add_theme_support('customize-selective-refresh-widgets');

        // コアブロックパターン無効化（オプション）
        // remove_theme_support('core-block-patterns');

        // 画像サイズ登録
        add_image_size('hero', 1920, 800, true);
        add_image_size('hero-sp', 750, 500, true);
        add_image_size('works-card', 400, 300, true);
        add_image_size('works-large', 800, 600, true);
        add_image_size('works-thumbnail', 150, 150, true);
        add_image_size('voice-avatar', 100, 100, true);
        add_image_size('news-thumb', 350, 200, true);
        add_image_size('service-card', 500, 350, true);
        add_image_size('og-image', 1200, 630, true);

        // ナビゲーションメニュー
        register_nav_menus([
            'primary'       => __('メインナビゲーション', 'sato-kenso'),
            'mobile'        => __('モバイルナビゲーション', 'sato-kenso'),
            'footer'        => __('フッターナビゲーション', 'sato-kenso'),
            'footer-sub'    => __('フッターサブナビゲーション', 'sato-kenso'),
            'footer-legal'  => __('フッター法的リンク', 'sato-kenso'),
        ]);
    }
}
add_action('after_setup_theme', 'sato_theme_setup');


// =============================================================================
// カスタム投稿タイプ登録
// =============================================================================
if (!function_exists('sato_register_post_types')) {
    function sato_register_post_types() {
        
        /**
         * 施工実績（Works）
         */
        register_post_type('works', [
            'labels' => [
                'name'                  => '施工実績',
                'singular_name'         => '施工実績',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規施工実績を追加',
                'edit_item'             => '施工実績を編集',
                'new_item'              => '新規施工実績',
                'view_item'             => '施工実績を表示',
                'view_items'            => '施工実績一覧を表示',
                'search_items'          => '施工実績を検索',
                'not_found'             => '施工実績が見つかりません',
                'not_found_in_trash'    => 'ゴミ箱に施工実績はありません',
                'all_items'             => 'すべての施工実績',
                'archives'              => '施工実績アーカイブ',
                'attributes'            => '施工実績の属性',
                'insert_into_item'      => '施工実績に挿入',
                'uploaded_to_this_item' => 'この施工実績にアップロード',
                'featured_image'        => 'メイン画像',
                'set_featured_image'    => 'メイン画像を設定',
                'remove_featured_image' => 'メイン画像を削除',
                'use_featured_image'    => 'メイン画像として使用',
                'menu_name'             => '施工実績',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'works',
            'menu_icon'           => 'dashicons-images-alt2',
            'menu_position'       => 5,
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'author'],
            'rewrite'             => ['slug' => 'works', 'with_front' => false],
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'query_var'           => true,
        ]);

        /**
         * お客様の声（Voice）
         */
        register_post_type('voice', [
            'labels' => [
                'name'                  => 'お客様の声',
                'singular_name'         => 'お客様の声',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規お客様の声を追加',
                'edit_item'             => 'お客様の声を編集',
                'new_item'              => '新規お客様の声',
                'view_item'             => 'お客様の声を表示',
                'view_items'            => 'お客様の声一覧を表示',
                'search_items'          => 'お客様の声を検索',
                'not_found'             => 'お客様の声が見つかりません',
                'not_found_in_trash'    => 'ゴミ箱にお客様の声はありません',
                'all_items'             => 'すべてのお客様の声',
                'archives'              => 'お客様の声アーカイブ',
                'menu_name'             => 'お客様の声',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'voice',
            'menu_icon'           => 'dashicons-format-quote',
            'menu_position'       => 6,
            'supports'            => ['title', 'editor', 'thumbnail', 'custom-fields', 'revisions'],
            'rewrite'             => ['slug' => 'voice', 'with_front' => false],
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'show_in_nav_menus'   => true,
        ]);

        /**
         * よくある質問（FAQ）
         */
        register_post_type('faq', [
            'labels' => [
                'name'                  => 'よくある質問',
                'singular_name'         => 'よくある質問',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規質問を追加',
                'edit_item'             => '質問を編集',
                'new_item'              => '新規質問',
                'view_item'             => '質問を表示',
                'view_items'            => '質問一覧を表示',
                'search_items'          => '質問を検索',
                'not_found'             => '質問が見つかりません',
                'not_found_in_trash'    => 'ゴミ箱に質問はありません',
                'all_items'             => 'すべての質問',
                'menu_name'             => 'よくある質問',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'faq',
            'menu_icon'           => 'dashicons-editor-help',
            'menu_position'       => 7,
            'supports'            => ['title', 'editor', 'page-attributes', 'custom-fields', 'revisions'],
            'rewrite'             => ['slug' => 'faq', 'with_front' => false],
            'capability_type'     => 'post',
            'hierarchical'        => false,
        ]);

        /**
         * お知らせ（News）
         */
        register_post_type('news', [
            'labels' => [
                'name'                  => 'お知らせ',
                'singular_name'         => 'お知らせ',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規お知らせを追加',
                'edit_item'             => 'お知らせを編集',
                'new_item'              => '新規お知らせ',
                'view_item'             => 'お知らせを表示',
                'view_items'            => 'お知らせ一覧を表示',
                'search_items'          => 'お知らせを検索',
                'not_found'             => 'お知らせが見つかりません',
                'not_found_in_trash'    => 'ゴミ箱にお知らせはありません',
                'all_items'             => 'すべてのお知らせ',
                'archives'              => 'お知らせアーカイブ',
                'menu_name'             => 'お知らせ',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'news',
            'menu_icon'           => 'dashicons-megaphone',
            'menu_position'       => 8,
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'author'],
            'rewrite'             => ['slug' => 'news', 'with_front' => false],
            'capability_type'     => 'post',
            'hierarchical'        => false,
        ]);

        /**
         * スタッフ紹介（Staff）
         */
        register_post_type('staff', [
            'labels' => [
                'name'                  => 'スタッフ紹介',
                'singular_name'         => 'スタッフ',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規スタッフを追加',
                'edit_item'             => 'スタッフを編集',
                'new_item'              => '新規スタッフ',
                'view_item'             => 'スタッフを表示',
                'search_items'          => 'スタッフを検索',
                'not_found'             => 'スタッフが見つかりません',
                'all_items'             => 'すべてのスタッフ',
                'menu_name'             => 'スタッフ紹介',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'staff',
            'menu_icon'           => 'dashicons-groups',
            'menu_position'       => 9,
            'supports'            => ['title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'],
            'rewrite'             => ['slug' => 'staff', 'with_front' => false],
            'capability_type'     => 'post',
            'hierarchical'        => false,
        ]);

        /**
         * サービス（Service）- 固定ページの代替として
         */
        register_post_type('service', [
            'labels' => [
                'name'                  => 'サービス',
                'singular_name'         => 'サービス',
                'add_new'               => '新規追加',
                'add_new_item'          => '新規サービスを追加',
                'edit_item'             => 'サービスを編集',
                'new_item'              => '新規サービス',
                'view_item'             => 'サービスを表示',
                'search_items'          => 'サービスを検索',
                'not_found'             => 'サービスが見つかりません',
                'all_items'             => 'すべてのサービス',
                'menu_name'             => 'サービス',
            ],
            'public'              => true,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'rest_base'           => 'service',
            'menu_icon'           => 'dashicons-admin-tools',
            'menu_position'       => 10,
            'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields', 'revisions'],
            'rewrite'             => ['slug' => 'service', 'with_front' => false],
            'capability_type'     => 'page',
            'hierarchical'        => true,
        ]);
    }
}
add_action('init', 'sato_register_post_types');


// =============================================================================
// カスタムタクソノミー登録
// =============================================================================
if (!function_exists('sato_register_taxonomies')) {
    function sato_register_taxonomies() {
        
        /**
         * 施工カテゴリー
         */
        register_taxonomy('works_category', 'works', [
            'labels' => [
                'name'              => '施工カテゴリー',
                'singular_name'     => '施工カテゴリー',
                'search_items'      => 'カテゴリーを検索',
                'all_items'         => 'すべてのカテゴリー',
                'parent_item'       => '親カテゴリー',
                'parent_item_colon' => '親カテゴリー:',
                'edit_item'         => 'カテゴリーを編集',
                'update_item'       => 'カテゴリーを更新',
                'add_new_item'      => '新規カテゴリーを追加',
                'new_item_name'     => '新規カテゴリー名',
                'menu_name'         => '施工カテゴリー',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rest_base'         => 'works-category',
            'rewrite'           => ['slug' => 'works/category', 'with_front' => false, 'hierarchical' => true],
            'query_var'         => true,
        ]);

        /**
         * 施工エリア
         */
        register_taxonomy('works_area', 'works', [
            'labels' => [
                'name'              => '施工エリア',
                'singular_name'     => '施工エリア',
                'search_items'      => 'エリアを検索',
                'all_items'         => 'すべてのエリア',
                'edit_item'         => 'エリアを編集',
                'update_item'       => 'エリアを更新',
                'add_new_item'      => '新規エリアを追加',
                'new_item_name'     => '新規エリア名',
                'menu_name'         => '施工エリア',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rest_base'         => 'works-area',
            'rewrite'           => ['slug' => 'works/area', 'with_front' => false],
            'query_var'         => true,
        ]);

        /**
         * 建物タイプ
         */
        register_taxonomy('works_building', 'works', [
            'labels' => [
                'name'              => '建物タイプ',
                'singular_name'     => '建物タイプ',
                'search_items'      => '建物タイプを検索',
                'all_items'         => 'すべての建物タイプ',
                'edit_item'         => '建物タイプを編集',
                'update_item'       => '建物タイプを更新',
                'add_new_item'      => '新規建物タイプを追加',
                'new_item_name'     => '新規建物タイプ名',
                'menu_name'         => '建物タイプ',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rest_base'         => 'works-building',
            'rewrite'           => ['slug' => 'works/building', 'with_front' => false],
        ]);

        /**
         * FAQカテゴリー
         */
        register_taxonomy('faq_category', 'faq', [
            'labels' => [
                'name'              => 'FAQカテゴリー',
                'singular_name'     => 'FAQカテゴリー',
                'search_items'      => 'カテゴリーを検索',
                'all_items'         => 'すべてのカテゴリー',
                'edit_item'         => 'カテゴリーを編集',
                'update_item'       => 'カテゴリーを更新',
                'add_new_item'      => '新規カテゴリーを追加',
                'new_item_name'     => '新規カテゴリー名',
                'menu_name'         => 'FAQカテゴリー',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'faq/category', 'with_front' => false],
        ]);

        /**
         * お知らせカテゴリー
         */
        register_taxonomy('news_category', 'news', [
            'labels' => [
                'name'              => 'お知らせカテゴリー',
                'singular_name'     => 'お知らせカテゴリー',
                'search_items'      => 'カテゴリーを検索',
                'all_items'         => 'すべてのカテゴリー',
                'edit_item'         => 'カテゴリーを編集',
                'update_item'       => 'カテゴリーを更新',
                'add_new_item'      => '新規カテゴリーを追加',
                'new_item_name'     => '新規カテゴリー名',
                'menu_name'         => 'お知らせカテゴリー',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'news/category', 'with_front' => false],
        ]);

        /**
         * サービスカテゴリー
         */
        register_taxonomy('service_category', 'service', [
            'labels' => [
                'name'              => 'サービスカテゴリー',
                'singular_name'     => 'サービスカテゴリー',
                'menu_name'         => 'サービスカテゴリー',
            ],
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => ['slug' => 'service/category', 'with_front' => false],
        ]);
    }
}
add_action('init', 'sato_register_taxonomies');


// =============================================================================
// デフォルトタクソノミー項目の登録
// =============================================================================
if (!function_exists('sato_register_default_terms')) {
    function sato_register_default_terms() {
        // 施工カテゴリーのデフォルト項目
        $works_categories = [
            'exterior'   => ['name' => '外壁塗装', 'description' => '外壁の塗装工事に関する施工実績'],
            'roof'       => ['name' => '屋根塗装', 'description' => '屋根の塗装工事に関する施工実績'],
            'waterproof' => ['name' => '防水工事', 'description' => '防水工事に関する施工実績'],
            'sealant'    => ['name' => 'シーリング工事', 'description' => 'シーリング（コーキング）工事に関する施工実績'],
            'interior'   => ['name' => '内装塗装', 'description' => '内装の塗装工事に関する施工実績'],
            'commercial' => ['name' => '店舗・商業施設', 'description' => '店舗・商業施設の塗装工事'],
            'other'      => ['name' => 'その他', 'description' => 'その他の塗装工事'],
        ];
        
        foreach ($works_categories as $slug => $data) {
            if (!term_exists($slug, 'works_category')) {
                wp_insert_term($data['name'], 'works_category', [
                    'slug' => $slug,
                    'description' => $data['description'],
                ]);
            }
        }

        // 施工エリアのデフォルト項目
        $works_areas = [
            'gotemba'     => '御殿場市',
            'susono'      => '裾野市',
            'mishima'     => '三島市',
            'numazu'      => '沼津市',
            'fuji'        => '富士市',
            'fujinomiya'  => '富士宮市',
            'nagaizumi'   => '長泉町',
            'shimizu'     => '清水町',
            'kannami'     => '函南町',
            'izunokuni'   => '伊豆の国市',
            'atami'       => '熱海市',
            'ito'         => '伊東市',
            'other-area'  => 'その他エリア',
        ];
        
        foreach ($works_areas as $slug => $name) {
            if (!term_exists($slug, 'works_area')) {
                wp_insert_term($name, 'works_area', ['slug' => $slug]);
            }
        }

        // 建物タイプのデフォルト項目
        $building_types = [
            'house'      => '戸建住宅',
            'apartment'  => 'アパート',
            'mansion'    => 'マンション',
            'shop'       => '店舗',
            'office'     => 'オフィス・事務所',
            'factory'    => '工場・倉庫',
            'public'     => '公共施設',
            'other-bldg' => 'その他',
        ];
        
        foreach ($building_types as $slug => $name) {
            if (!term_exists($slug, 'works_building')) {
                wp_insert_term($name, 'works_building', ['slug' => $slug]);
            }
        }

        // FAQカテゴリーのデフォルト項目
        $faq_categories = [
            'price'     => '料金について',
            'process'   => '施工について',
            'paint'     => '塗料について',
            'warranty'  => '保証について',
            'period'    => '工期について',
            'other-faq' => 'その他',
        ];
        
        foreach ($faq_categories as $slug => $name) {
            if (!term_exists($slug, 'faq_category')) {
                wp_insert_term($name, 'faq_category', ['slug' => $slug]);
            }
        }

        // お知らせカテゴリーのデフォルト項目
        $news_categories = [
            'info'      => 'お知らせ',
            'campaign'  => 'キャンペーン',
            'works'     => '施工事例',
            'media'     => 'メディア掲載',
            'blog'      => 'ブログ',
            'column'    => 'コラム',
        ];
        
        foreach ($news_categories as $slug => $name) {
            if (!term_exists($slug, 'news_category')) {
                wp_insert_term($name, 'news_category', ['slug' => $slug]);
            }
        }

        // サービスカテゴリーのデフォルト項目
        $service_categories = [
            'exterior'   => '外壁塗装',
            'roof'       => '屋根塗装',
            'waterproof' => '防水工事',
            'repair'     => '補修・修繕',
        ];
        
        foreach ($service_categories as $slug => $name) {
            if (!term_exists($slug, 'service_category')) {
                wp_insert_term($name, 'service_category', ['slug' => $slug]);
            }
        }
    }
}
add_action('init', 'sato_register_default_terms', 11);


// =============================================================================
// カスタムフィールド用メタボックス
// =============================================================================
if (!function_exists('sato_add_meta_boxes')) {
    function sato_add_meta_boxes() {
        // 施工実績用メタボックス
        add_meta_box(
            'works_details',
            '施工詳細情報',
            'sato_works_meta_box_callback',
            'works',
            'normal',
            'high'
        );

        // 施工実績用ギャラリーメタボックス
        add_meta_box(
            'works_gallery',
            '施工写真ギャラリー',
            'sato_works_gallery_meta_box_callback',
            'works',
            'normal',
            'default'
        );

        // お客様の声用メタボックス
        add_meta_box(
            'voice_details',
            'お客様情報',
            'sato_voice_meta_box_callback',
            'voice',
            'normal',
            'high'
        );

        // FAQ用メタボックス
        add_meta_box(
            'faq_details',
            'FAQ設定',
            'sato_faq_meta_box_callback',
            'faq',
            'side',
            'default'
        );

        // スタッフ用メタボックス
        add_meta_box(
            'staff_details',
            'スタッフ情報',
            'sato_staff_meta_box_callback',
            'staff',
            'normal',
            'high'
        );

        // サービス用メタボックス
        add_meta_box(
            'service_details',
            'サービス詳細',
            'sato_service_meta_box_callback',
            'service',
            'normal',
            'high'
        );

        // SEO用メタボックス（全投稿タイプ）
        $post_types = ['post', 'page', 'works', 'voice', 'faq', 'news', 'staff', 'service'];
        foreach ($post_types as $post_type) {
            add_meta_box(
                'sato_seo_meta',
                'SEO設定',
                'sato_seo_meta_box_callback',
                $post_type,
                'normal',
                'low'
            );
        }
    }
}
add_action('add_meta_boxes', 'sato_add_meta_boxes');


/**
 * 施工実績メタボックスコールバック
 */
if (!function_exists('sato_works_meta_box_callback')) {
    function sato_works_meta_box_callback($post) {
        wp_nonce_field('sato_works_meta_box', 'sato_works_meta_box_nonce');
        
        // 既存のメタデータを取得
        $completion_date = get_post_meta($post->ID, '_works_completion_date', true);
        $work_period = get_post_meta($post->ID, '_works_period', true);
        $work_cost = get_post_meta($post->ID, '_works_cost', true);
        $work_cost_detail = get_post_meta($post->ID, '_works_cost_detail', true);
        $paint_maker = get_post_meta($post->ID, '_works_paint_maker', true);
        $paint_name = get_post_meta($post->ID, '_works_paint_name', true);
        $paint_color = get_post_meta($post->ID, '_works_paint_color', true);
        $client_name = get_post_meta($post->ID, '_works_client_name', true);
        $client_comment = get_post_meta($post->ID, '_works_client_comment', true);
        $before_image = get_post_meta($post->ID, '_works_before_image', true);
        $after_image = get_post_meta($post->ID, '_works_after_image', true);
        $work_point = get_post_meta($post->ID, '_works_point', true);
        ?>
        <style>
            .sato-meta-box { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
            .sato-meta-box .full-width { grid-column: 1 / -1; }
            .sato-meta-field { margin-bottom: 15px; }
            .sato-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; color: #1d2327; }
            .sato-meta-field input[type="text"],
            .sato-meta-field input[type="date"],
            .sato-meta-field input[type="number"],
            .sato-meta-field input[type="url"],
            .sato-meta-field textarea,
            .sato-meta-field select { width: 100%; padding: 8px 10px; border: 1px solid #8c8f94; border-radius: 4px; font-size: 14px; }
            .sato-meta-field textarea { min-height: 80px; }
            .sato-meta-field .description { color: #646970; font-size: 13px; margin-top: 4px; }
            .sato-image-field { display: flex; align-items: flex-start; gap: 10px; flex-wrap: wrap; }
            .sato-image-preview { max-width: 200px; margin-top: 10px; border-radius: 4px; overflow: hidden; border: 1px solid #ddd; }
            .sato-image-preview img { max-width: 100%; height: auto; display: block; }
            .sato-meta-section { background: #f6f7f7; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
            .sato-meta-section h4 { margin: 0 0 15px; padding-bottom: 10px; border-bottom: 1px solid #ddd; color: #1d2327; }
        </style>
        
        <div class="sato-meta-section">
            <h4>基本情報</h4>
            <div class="sato-meta-box">
                <div class="sato-meta-field">
                    <label for="works_completion_date">完工日</label>
                    <input type="date" id="works_completion_date" name="works_completion_date" value="<?php echo esc_attr($completion_date); ?>">
                </div>
                
                <div class="sato-meta-field">
                    <label for="works_period">施工期間</label>
                    <input type="text" id="works_period" name="works_period" value="<?php echo esc_attr($work_period); ?>" placeholder="例: 約2週間（14日間）">
                </div>
                
                <div class="sato-meta-field">
                    <label for="works_cost">施工費用（税込・目安）</label>
                    <input type="text" id="works_cost" name="works_cost" value="<?php echo esc_attr($work_cost); ?>" placeholder="例: 約80万円">
                    <p class="description">表示用の概算金額を入力</p>
                </div>
                
                <div class="sato-meta-field">
                    <label for="works_client_name">お客様名（表示用）</label>
                    <input type="text" id="works_client_name" name="works_client_name" value="<?php echo esc_attr($client_name); ?>" placeholder="例: 御殿場市 S様邸">
                </div>
            </div>
        </div>
        
        <div class="sato-meta-section">
            <h4>使用塗料情報</h4>
            <div class="sato-meta-box">
                <div class="sato-meta-field">
                    <label for="works_paint_maker">塗料メーカー</label>
                    <select id="works_paint_maker" name="works_paint_maker">
                        <option value="">選択してください</option>
                        <option value="日本ペイント" <?php selected($paint_maker, '日本ペイント'); ?>>日本ペイント</option>
                        <option value="関西ペイント" <?php selected($paint_maker, '関西ペイント'); ?>>関西ペイント</option>
                        <option value="エスケー化研" <?php selected($paint_maker, 'エスケー化研'); ?>>エスケー化研</option>
                        <option value="アステックペイント" <?php selected($paint_maker, 'アステックペイント'); ?>>アステックペイント</option>
                        <option value="ガイナ" <?php selected($paint_maker, 'ガイナ'); ?>>ガイナ（日進産業）</option>
                        <option value="その他" <?php selected($paint_maker, 'その他'); ?>>その他</option>
                    </select>
                </div>
                
                <div class="sato-meta-field">
                    <label for="works_paint_name">塗料名・グレード</label>
                    <input type="text" id="works_paint_name" name="works_paint_name" value="<?php echo esc_attr($paint_name); ?>" placeholder="例: パーフェクトトップ（シリコン）">
                </div>
                
                <div class="sato-meta-field full-width">
                    <label for="works_paint_color">使用色</label>
                    <input type="text" id="works_paint_color" name="works_paint_color" value="<?php echo esc_attr($paint_color); ?>" placeholder="例: 外壁: ND-102 / 屋根: チョコレート">
                </div>
            </div>
        </div>
        
        <div class="sato-meta-section">
            <h4>ビフォーアフター画像</h4>
            <div class="sato-meta-box">
                <div class="sato-meta-field">
                    <label>施工前（Before）画像</label>
                    <div class="sato-image-field">
                        <input type="hidden" id="works_before_image" name="works_before_image" value="<?php echo esc_attr($before_image); ?>">
                        <button type="button" class="button sato-upload-image" data-target="works_before_image">画像を選択</button>
                        <button type="button" class="button sato-remove-image" data-target="works_before_image" <?php echo empty($before_image) ? 'style="display:none;"' : ''; ?>>削除</button>
                    </div>
                    <div class="sato-image-preview" id="works_before_image_preview">
                        <?php if ($before_image) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($before_image, 'medium')); ?>" alt="施工前">
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="sato-meta-field">
                    <label>施工後（After）画像</label>
                    <div class="sato-image-field">
                        <input type="hidden" id="works_after_image" name="works_after_image" value="<?php echo esc_attr($after_image); ?>">
                        <button type="button" class="button sato-upload-image" data-target="works_after_image">画像を選択</button>
                        <button type="button" class="button sato-remove-image" data-target="works_after_image" <?php echo empty($after_image) ? 'style="display:none;"' : ''; ?>>削除</button>
                    </div>
                    <div class="sato-image-preview" id="works_after_image_preview">
                        <?php if ($after_image) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_url($after_image, 'medium')); ?>" alt="施工後">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="sato-meta-section">
            <h4>その他</h4>
            <div class="sato-meta-field">
                <label for="works_point">施工のポイント・こだわり</label>
                <textarea id="works_point" name="works_point" rows="4" placeholder="この施工での工夫点やお客様のご要望への対応など"><?php echo esc_textarea($work_point); ?></textarea>
            </div>
            
            <div class="sato-meta-field">
                <label for="works_client_comment">お客様からのコメント</label>
                <textarea id="works_client_comment" name="works_client_comment" rows="3" placeholder="お客様からいただいた感想（任意）"><?php echo esc_textarea($client_comment); ?></textarea>
            </div>
            
            <div class="sato-meta-field">
                <label for="works_cost_detail">費用内訳（非公開メモ）</label>
                <textarea id="works_cost_detail" name="works_cost_detail" rows="3" placeholder="内部管理用メモ（サイトには表示されません）"><?php echo esc_textarea($work_cost_detail); ?></textarea>
            </div>
        </div>
        <?php
    }
}


/**
 * 施工写真ギャラリーメタボックス
 */
if (!function_exists('sato_works_gallery_meta_box_callback')) {
    function sato_works_gallery_meta_box_callback($post) {
        $gallery_images = get_post_meta($post->ID, '_works_gallery', true);
        ?>
        <style>
            .sato-gallery-container { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; }
            .sato-gallery-item { position: relative; width: 120px; height: 120px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; }
            .sato-gallery-item img { width: 100%; height: 100%; object-fit: cover; }
            .sato-gallery-item .remove-image { position: absolute; top: 5px; right: 5px; background: rgba(220, 53, 69, 0.9); color: #fff; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 16px; line-height: 1; }
            .sato-gallery-item .remove-image:hover { background: #dc3545; }
        </style>
        
        <div class="sato-gallery-container" id="works_gallery_container">
            <?php
            if (!empty($gallery_images) && is_array($gallery_images)) {
                foreach ($gallery_images as $image_id) {
                    $img_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                    if ($img_url) {
                        echo '<div class="sato-gallery-item" data-id="' . esc_attr($image_id) . '">';
                        echo '<img src="' . esc_url($img_url) . '" alt="">';
                        echo '<button type="button" class="remove-image">&times;</button>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
        <input type="hidden" id="works_gallery" name="works_gallery" value="<?php echo esc_attr(is_array($gallery_images) ? implode(',', $gallery_images) : ''); ?>">
        <button type="button" class="button" id="add_gallery_images">ギャラリー画像を追加</button>
        <p class="description">施工中の写真や詳細写真を複数追加できます。ドラッグで並び替え可能です。</p>
        <?php
    }
}


/**
 * お客様の声メタボックスコールバック
 */
if (!function_exists('sato_voice_meta_box_callback')) {
    function sato_voice_meta_box_callback($post) {
        wp_nonce_field('sato_voice_meta_box', 'sato_voice_meta_box_nonce');
        
        $client_area = get_post_meta($post->ID, '_voice_client_area', true);
        $client_initial = get_post_meta($post->ID, '_voice_client_initial', true);
        $client_age = get_post_meta($post->ID, '_voice_client_age', true);
        $service_type = get_post_meta($post->ID, '_voice_service_type', true);
        $rating = get_post_meta($post->ID, '_voice_rating', true);
        $related_works = get_post_meta($post->ID, '_voice_related_works', true);
        $voice_date = get_post_meta($post->ID, '_voice_date', true);
        ?>
        <style>
            .sato-meta-field { margin-bottom: 15px; }
            .sato-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .sato-meta-field input[type="text"],
            .sato-meta-field input[type="date"],
            .sato-meta-field select { width: 100%; padding: 8px; border: 1px solid #8c8f94; border-radius: 4px; }
            .sato-rating-field { display: flex; align-items: center; gap: 5px; }
            .sato-rating-field input[type="radio"] { display: none; }
            .sato-rating-field label { cursor: pointer; font-size: 28px; color: #ddd; transition: color 0.2s; }
            .sato-rating-field input[type="radio"]:checked ~ label { color: #ddd; }
            .sato-rating-field label:hover,
            .sato-rating-field label:hover ~ label,
            .sato-rating-field input[type="radio"]:checked + label,
            .sato-rating-field input[type="radio"]:checked + label ~ label { color: #ddd; }
            .sato-rating-field input[type="radio"]:checked + label,
            .sato-rating-field input[type="radio"]:checked ~ label:has(~ input:checked) { color: #ffc107; }
            .sato-rating-field .star-checked { color: #ffc107 !important; }
        </style>
        
        <div class="sato-meta-field">
            <label for="voice_client_area">お客様エリア</label>
            <input type="text" id="voice_client_area" name="voice_client_area" value="<?php echo esc_attr($client_area); ?>" placeholder="例: 御殿場市">
        </div>
        
        <div class="sato-meta-field">
            <label for="voice_client_initial">お客様イニシャル</label>
            <input type="text" id="voice_client_initial" name="voice_client_initial" value="<?php echo esc_attr($client_initial); ?>" placeholder="例: S様">
        </div>
        
        <div class="sato-meta-field">
            <label for="voice_client_age">お客様年代</label>
            <select id="voice_client_age" name="voice_client_age">
                <option value="">選択してください</option>
                <option value="20代" <?php selected($client_age, '20代'); ?>>20代</option>
                <option value="30代" <?php selected($client_age, '30代'); ?>>30代</option>
                <option value="40代" <?php selected($client_age, '40代'); ?>>40代</option>
                <option value="50代" <?php selected($client_age, '50代'); ?>>50代</option>
                <option value="60代" <?php selected($client_age, '60代'); ?>>60代</option>
                <option value="70代以上" <?php selected($client_age, '70代以上'); ?>>70代以上</option>
            </select>
        </div>
        
        <div class="sato-meta-field">
            <label for="voice_service_type">施工内容</label>
            <select id="voice_service_type" name="voice_service_type">
                <option value="">選択してください</option>
                <option value="外壁塗装" <?php selected($service_type, '外壁塗装'); ?>>外壁塗装</option>
                <option value="屋根塗装" <?php selected($service_type, '屋根塗装'); ?>>屋根塗装</option>
                <option value="外壁・屋根塗装" <?php selected($service_type, '外壁・屋根塗装'); ?>>外壁・屋根塗装</option>
                <option value="防水工事" <?php selected($service_type, '防水工事'); ?>>防水工事</option>
                <option value="シーリング工事" <?php selected($service_type, 'シーリング工事'); ?>>シーリング工事</option>
                <option value="内装塗装" <?php selected($service_type, '内装塗装'); ?>>内装塗装</option>
                <option value="その他" <?php selected($service_type, 'その他'); ?>>その他</option>
            </select>
        </div>
        
        <div class="sato-meta-field">
            <label>評価</label>
            <div class="sato-rating-field" id="rating-field">
                <?php for ($i = 5; $i >= 1; $i--) : ?>
                    <input type="radio" id="rating_<?php echo $i; ?>" name="voice_rating" value="<?php echo $i; ?>" <?php checked($rating, $i); ?>>
                    <label for="rating_<?php echo $i; ?>" class="<?php echo ($rating && $i <= $rating) ? 'star-checked' : ''; ?>">★</label>
                <?php endfor; ?>
            </div>
        </div>
        
        <div class="sato-meta-field">
            <label for="voice_date">ご回答日</label>
            <input type="date" id="voice_date" name="voice_date" value="<?php echo esc_attr($voice_date); ?>">
        </div>
        
        <div class="sato-meta-field">
            <label for="voice_related_works">関連施工実績</label>
            <select id="voice_related_works" name="voice_related_works">
                <option value="">選択してください</option>
                <?php
                $works_posts = get_posts([
                    'post_type' => 'works',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ]);
                foreach ($works_posts as $works_post) :
                ?>
                    <option value="<?php echo $works_post->ID; ?>" <?php selected($related_works, $works_post->ID); ?>>
                        <?php echo esc_html($works_post->post_title); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            // 星評価のインタラクション
            $('#rating-field label').on('click', function() {
                var index = $(this).index();
                $('#rating-field label').removeClass('star-checked');
                $('#rating-field label').slice(0, Math.floor(index / 2) + 1).addClass('star-checked');
            });
        });
        </script>
        <?php
    }
}


/**
 * FAQメタボックスコールバック
 */
if (!function_exists('sato_faq_meta_box_callback')) {
    function sato_faq_meta_box_callback($post) {
        wp_nonce_field('sato_faq_meta_box', 'sato_faq_meta_box_nonce');
        
        $display_order = get_post_meta($post->ID, '_faq_display_order', true);
        $is_featured = get_post_meta($post->ID, '_faq_is_featured', true);
        $related_service = get_post_meta($post->ID, '_faq_related_service', true);
        ?>
        <div class="sato-meta-field">
            <label for="faq_display_order">表示順序</label>
            <input type="number" id="faq_display_order" name="faq_display_order" value="<?php echo esc_attr($display_order); ?>" min="0" style="width: 100%;">
            <p class="description">数字が小さいほど上に表示されます</p>
        </div>
        
        <div class="sato-meta-field" style="margin-top: 15px;">
            <label>
                <input type="checkbox" name="faq_is_featured" value="1" <?php checked($is_featured, '1'); ?>>
                トップページに表示する
            </label>
        </div>
        
        <div class="sato-meta-field" style="margin-top: 15px;">
            <label for="faq_related_service">関連サービス</label>
            <select id="faq_related_service" name="faq_related_service" style="width: 100%;">
                <option value="">選択してください</option>
                <option value="exterior" <?php selected($related_service, 'exterior'); ?>>外壁塗装</option>
                <option value="roof" <?php selected($related_service, 'roof'); ?>>屋根塗装</option>
                <option value="waterproof" <?php selected($related_service, 'waterproof'); ?>>防水工事</option>
                <option value="repair" <?php selected($related_service, 'repair'); ?>>補修・修繕</option>
            </select>
        </div>
        <?php
    }
}


/**
 * スタッフメタボックスコールバック
 */
if (!function_exists('sato_staff_meta_box_callback')) {
    function sato_staff_meta_box_callback($post) {
        wp_nonce_field('sato_staff_meta_box', 'sato_staff_meta_box_nonce');
        
        $position = get_post_meta($post->ID, '_staff_position', true);
        $experience = get_post_meta($post->ID, '_staff_experience', true);
        $qualifications = get_post_meta($post->ID, '_staff_qualifications', true);
        $speciality = get_post_meta($post->ID, '_staff_speciality', true);
        $message = get_post_meta($post->ID, '_staff_message', true);
        ?>
        <style>
            .sato-meta-field { margin-bottom: 15px; }
            .sato-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .sato-meta-field input[type="text"],
            .sato-meta-field textarea { width: 100%; padding: 8px; border: 1px solid #8c8f94; border-radius: 4px; }
        </style>
        
        <div class="sato-meta-field">
            <label for="staff_position">役職・ポジション</label>
            <input type="text" id="staff_position" name="staff_position" value="<?php echo esc_attr($position); ?>" placeholder="例: 代表 / 職人 / 営業">
        </div>
        
        <div class="sato-meta-field">
            <label for="staff_experience">経験年数</label>
            <input type="text" id="staff_experience" name="staff_experience" value="<?php echo esc_attr($experience); ?>" placeholder="例: 20年">
        </div>
        
        <div class="sato-meta-field">
            <label for="staff_qualifications">保有資格（改行区切り）</label>
            <textarea id="staff_qualifications" name="staff_qualifications" rows="4" placeholder="一級塗装技能士&#10;外壁診断士&#10;雨漏り診断士"><?php echo esc_textarea($qualifications); ?></textarea>
        </div>
        
        <div class="sato-meta-field">
            <label for="staff_speciality">得意分野・専門</label>
            <input type="text" id="staff_speciality" name="staff_speciality" value="<?php echo esc_attr($speciality); ?>" placeholder="例: 外壁塗装、色彩提案">
        </div>
        
        <div class="sato-meta-field">
            <label for="staff_message">メッセージ</label>
            <textarea id="staff_message" name="staff_message" rows="4" placeholder="お客様へのメッセージ"><?php echo esc_textarea($message); ?></textarea>
        </div>
        <?php
    }
}


/**
 * サービスメタボックスコールバック
 */
if (!function_exists('sato_service_meta_box_callback')) {
    function sato_service_meta_box_callback($post) {
        wp_nonce_field('sato_service_meta_box', 'sato_service_meta_box_nonce');
        
        $price_from = get_post_meta($post->ID, '_service_price_from', true);
        $price_unit = get_post_meta($post->ID, '_service_price_unit', true);
        $duration = get_post_meta($post->ID, '_service_duration', true);
        $features = get_post_meta($post->ID, '_service_features', true);
        $recommended = get_post_meta($post->ID, '_service_recommended', true);
        ?>
        <style>
            .sato-meta-field { margin-bottom: 15px; }
            .sato-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .sato-meta-field input[type="text"],
            .sato-meta-field textarea,
            .sato-meta-field select { width: 100%; padding: 8px; border: 1px solid #8c8f94; border-radius: 4px; }
        </style>
        
        <div class="sato-meta-field">
            <label for="service_price_from">参考価格（〜から）</label>
            <input type="text" id="service_price_from" name="service_price_from" value="<?php echo esc_attr($price_from); ?>" placeholder="例: 49.8万円〜">
        </div>
        
        <div class="sato-meta-field">
            <label for="service_price_unit">価格単位</label>
            <input type="text" id="service_price_unit" name="service_price_unit" value="<?php echo esc_attr($price_unit); ?>" placeholder="例: 建坪30坪の場合">
        </div>
        
        <div class="sato-meta-field">
            <label for="service_duration">施工期間目安</label>
            <input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" placeholder="例: 約2週間">
        </div>
        
        <div class="sato-meta-field">
            <label for="service_features">サービスの特徴（改行区切り）</label>
            <textarea id="service_features" name="service_features" rows="4" placeholder="高耐久塗料使用&#10;丁寧な下地処理&#10;10年保証付き"><?php echo esc_textarea($features); ?></textarea>
        </div>
        
        <div class="sato-meta-field">
            <label for="service_recommended">こんな方におすすめ（改行区切り）</label>
            <textarea id="service_recommended" name="service_recommended" rows="4" placeholder="築10年以上の方&#10;外壁のひび割れが気になる方"><?php echo esc_textarea($recommended); ?></textarea>
        </div>
        <?php
    }
}


/**
 * SEOメタボックスコールバック
 */
if (!function_exists('sato_seo_meta_box_callback')) {
    function sato_seo_meta_box_callback($post) {
        wp_nonce_field('sato_seo_meta_box', 'sato_seo_meta_box_nonce');
        
        $seo_title = get_post_meta($post->ID, '_sato_seo_title', true);
        $seo_description = get_post_meta($post->ID, '_sato_seo_description', true);
        $seo_keywords = get_post_meta($post->ID, '_sato_seo_keywords', true);
        $seo_noindex = get_post_meta($post->ID, '_sato_seo_noindex', true);
        $og_image = get_post_meta($post->ID, '_sato_og_image', true);
        ?>
        <style>
            .sato-seo-field { margin-bottom: 15px; }
            .sato-seo-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .sato-seo-field input[type="text"],
            .sato-seo-field textarea { width: 100%; padding: 8px; border: 1px solid #8c8f94; border-radius: 4px; }
            .sato-seo-field .char-count { color: #646970; font-size: 12px; text-align: right; }
            .sato-seo-field .char-count.over { color: #dc3545; }
            .sato-seo-preview { background: #f6f7f7; padding: 15px; border-radius: 4px; margin-top: 15px; }
            .sato-seo-preview h4 { margin: 0 0 10px; font-size: 13px; color: #646970; }
            .sato-seo-preview .preview-title { color: #1a0dab; font-size: 18px; margin-bottom: 5px; }
            .sato-seo-preview .preview-url { color: #006621; font-size: 14px; margin-bottom: 5px; }
            .sato-seo-preview .preview-desc { color: #545454; font-size: 14px; line-height: 1.4; }
        </style>
        
        <div class="sato-seo-field">
            <label for="sato_seo_title">SEOタイトル</label>
            <input type="text" id="sato_seo_title" name="sato_seo_title" value="<?php echo esc_attr($seo_title); ?>" placeholder="空欄の場合は記事タイトルを使用">
            <div class="char-count"><span id="title-count"><?php echo mb_strlen($seo_title); ?></span>/60文字推奨</div>
            <p class="description">検索結果に表示されるタイトル。32〜60文字が推奨です。</p>
        </div>
        
        <div class="sato-seo-field">
            <label for="sato_seo_description">メタディスクリプション</label>
            <textarea id="sato_seo_description" name="sato_seo_description" rows="3" placeholder="空欄の場合は抜粋または本文から自動生成"><?php echo esc_textarea($seo_description); ?></textarea>
            <div class="char-count"><span id="desc-count"><?php echo mb_strlen($seo_description); ?></span>/160文字推奨</div>
            <p class="description">検索結果に表示される説明文。80〜160文字が推奨です。</p>
        </div>
        
        <div class="sato-seo-field">
            <label for="sato_seo_keywords">フォーカスキーワード</label>
            <input type="text" id="sato_seo_keywords" name="sato_seo_keywords" value="<?php echo esc_attr($seo_keywords); ?>" placeholder="例: 御殿場市 外壁塗装, 屋根塗装">
            <p class="description">カンマ区切りで入力。このページで重要なキーワード。</p>
        </div>
        
        <div class="sato-seo-field">
            <label>
                <input type="checkbox" name="sato_seo_noindex" value="1" <?php checked($seo_noindex, '1'); ?>>
                このページを検索結果に表示しない（noindex）
            </label>
        </div>
        
        <div class="sato-seo-field">
            <label>OGP画像（SNS共有時の画像）</label>
            <div style="display: flex; gap: 10px; align-items: flex-start;">
                <input type="hidden" id="sato_og_image" name="sato_og_image" value="<?php echo esc_attr($og_image); ?>">
                <button type="button" class="button sato-upload-image" data-target="sato_og_image">画像を選択</button>
                <button type="button" class="button sato-remove-image" data-target="sato_og_image" <?php echo empty($og_image) ? 'style="display:none;"' : ''; ?>>削除</button>
            </div>
            <div class="sato-image-preview" id="sato_og_image_preview" style="max-width: 300px; margin-top: 10px;">
                <?php if ($og_image) : ?>
                    <img src="<?php echo esc_url(wp_get_attachment_image_url($og_image, 'medium')); ?>" alt="" style="max-width: 100%;">
                <?php endif; ?>
            </div>
            <p class="description">推奨サイズ: 1200×630px。空欄の場合はアイキャッチ画像を使用。</p>
        </div>
        
        <div class="sato-seo-preview">
            <h4>検索結果プレビュー</h4>
            <div class="preview-title" id="seo-preview-title"><?php echo esc_html($seo_title ?: get_the_title($post->ID)); ?></div>
            <div class="preview-url"><?php echo esc_url(get_permalink($post->ID)); ?></div>
            <div class="preview-desc" id="seo-preview-desc"><?php echo esc_html($seo_description ?: wp_trim_words(get_the_excerpt($post->ID), 80, '...')); ?></div>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            // 文字カウント
            $('#sato_seo_title').on('input', function() {
                var len = $(this).val().length;
                $('#title-count').text(len);
                $('#title-count').parent().toggleClass('over', len > 60);
                $('#seo-preview-title').text($(this).val() || '<?php echo esc_js(get_the_title($post->ID)); ?>');
            });
            
            $('#sato_seo_description').on('input', function() {
                var len = $(this).val().length;
                $('#desc-count').text(len);
                $('#desc-count').parent().toggleClass('over', len > 160);
                $('#seo-preview-desc').text($(this).val() || '<?php echo esc_js(wp_trim_words(get_the_excerpt($post->ID), 80, '...')); ?>');
            });
        });
        </script>
        <?php
    }
}


/**
 * メタボックスの保存処理
 */
if (!function_exists('sato_save_meta_boxes')) {
    function sato_save_meta_boxes($post_id) {
        // 自動保存時は処理しない
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        // 権限チェック
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // 施工実績
        if (isset($_POST['sato_works_meta_box_nonce']) && wp_verify_nonce($_POST['sato_works_meta_box_nonce'], 'sato_works_meta_box')) {
            $works_fields = [
                'works_completion_date' => '_works_completion_date',
                'works_period'          => '_works_period',
                'works_cost'            => '_works_cost',
                'works_cost_detail'     => '_works_cost_detail',
                'works_paint_maker'     => '_works_paint_maker',
                'works_paint_name'      => '_works_paint_name',
                'works_paint_color'     => '_works_paint_color',
                'works_client_name'     => '_works_client_name',
                'works_client_comment'  => '_works_client_comment',
                'works_before_image'    => '_works_before_image',
                'works_after_image'     => '_works_after_image',
                'works_point'           => '_works_point',
            ];
            
            foreach ($works_fields as $field => $meta_key) {
                if (isset($_POST[$field])) {
                    if (in_array($field, ['works_client_comment', 'works_point', 'works_cost_detail'])) {
                        update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$field]));
                    } else {
                        update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
                    }
                }
            }
            
            // ギャラリー画像
            if (isset($_POST['works_gallery'])) {
                $gallery = array_filter(array_map('intval', explode(',', $_POST['works_gallery'])));
                update_post_meta($post_id, '_works_gallery', $gallery);
            }
        }

        // お客様の声
        if (isset($_POST['sato_voice_meta_box_nonce']) && wp_verify_nonce($_POST['sato_voice_meta_box_nonce'], 'sato_voice_meta_box')) {
            $voice_fields = [
                'voice_client_area'    => '_voice_client_area',
                'voice_client_initial' => '_voice_client_initial',
                'voice_client_age'     => '_voice_client_age',
                'voice_service_type'   => '_voice_service_type',
                'voice_rating'         => '_voice_rating',
                'voice_related_works'  => '_voice_related_works',
                'voice_date'           => '_voice_date',
            ];
            
            foreach ($voice_fields as $field => $meta_key) {
                if (isset($_POST[$field])) {
                    update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
                }
            }
        }

        // FAQ
        if (isset($_POST['sato_faq_meta_box_nonce']) && wp_verify_nonce($_POST['sato_faq_meta_box_nonce'], 'sato_faq_meta_box')) {
            if (isset($_POST['faq_display_order'])) {
                update_post_meta($post_id, '_faq_display_order', intval($_POST['faq_display_order']));
            }
            update_post_meta($post_id, '_faq_is_featured', isset($_POST['faq_is_featured']) ? '1' : '0');
            if (isset($_POST['faq_related_service'])) {
                update_post_meta($post_id, '_faq_related_service', sanitize_text_field($_POST['faq_related_service']));
            }
        }

        // スタッフ
        if (isset($_POST['sato_staff_meta_box_nonce']) && wp_verify_nonce($_POST['sato_staff_meta_box_nonce'], 'sato_staff_meta_box')) {
            $staff_fields = [
                'staff_position'       => '_staff_position',
                'staff_experience'     => '_staff_experience',
                'staff_qualifications' => '_staff_qualifications',
                'staff_speciality'     => '_staff_speciality',
                'staff_message'        => '_staff_message',
            ];
            
            foreach ($staff_fields as $field => $meta_key) {
                if (isset($_POST[$field])) {
                    if (in_array($field, ['staff_qualifications', 'staff_message'])) {
                        update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$field]));
                    } else {
                        update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
                    }
                }
            }
        }

        // サービス
        if (isset($_POST['sato_service_meta_box_nonce']) && wp_verify_nonce($_POST['sato_service_meta_box_nonce'], 'sato_service_meta_box')) {
            $service_fields = [
                'service_price_from'  => '_service_price_from',
                'service_price_unit'  => '_service_price_unit',
                'service_duration'    => '_service_duration',
                'service_features'    => '_service_features',
                'service_recommended' => '_service_recommended',
            ];
            
            foreach ($service_fields as $field => $meta_key) {
                if (isset($_POST[$field])) {
                    if (in_array($field, ['service_features', 'service_recommended'])) {
                        update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$field]));
                    } else {
                        update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
                    }
                }
            }
        }

        // SEO
        if (isset($_POST['sato_seo_meta_box_nonce']) && wp_verify_nonce($_POST['sato_seo_meta_box_nonce'], 'sato_seo_meta_box')) {
            $seo_fields = [
                'sato_seo_title'       => '_sato_seo_title',
                'sato_seo_description' => '_sato_seo_description',
                'sato_seo_keywords'    => '_sato_seo_keywords',
                'sato_og_image'        => '_sato_og_image',
            ];
            
            foreach ($seo_fields as $field => $meta_key) {
                if (isset($_POST[$field])) {
                    if ($field === 'sato_seo_description') {
                        update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$field]));
                    } else {
                        update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
                    }
                }
            }
            update_post_meta($post_id, '_sato_seo_noindex', isset($_POST['sato_seo_noindex']) ? '1' : '0');
        }
    }
}
add_action('save_post', 'sato_save_meta_boxes');


// =============================================================================
// 管理画面用スクリプト
// =============================================================================
if (!function_exists('sato_admin_scripts')) {
    function sato_admin_scripts($hook) {
        global $post;
        
        if ($hook === 'post-new.php' || $hook === 'post.php') {
            if (isset($post) && in_array($post->post_type, ['works', 'voice', 'staff', 'service', 'post', 'page', 'news', 'faq'])) {
                wp_enqueue_media();
                wp_enqueue_script('jquery-ui-sortable');
                
                // 管理画面用JS
                wp_enqueue_script(
                    'sato-admin',
                    SATO_THEME_ASSETS . '/js/admin.js',
                    ['jquery', 'jquery-ui-sortable'],
                    SATO_THEME_VERSION,
                    true
                );
                
                // インラインスクリプト（メディアアップローダー）
                wp_add_inline_script('sato-admin', "
                    jQuery(document).ready(function($) {
                        // 画像アップロード
                        $('.sato-upload-image').on('click', function(e) {
                            e.preventDefault();
                            var target = $(this).data('target');
                            var frame = wp.media({
                                title: '画像を選択',
                                button: { text: '選択' },
                                multiple: false
                            });
                            frame.on('select', function() {
                                var attachment = frame.state().get('selection').first().toJSON();
                                $('#' + target).val(attachment.id);
                                $('#' + target + '_preview').html('<img src=\"' + attachment.url + '\" alt=\"\" style=\"max-width:100%;\">');
                                $('[data-target=\"' + target + '\"].sato-remove-image').show();
                            });
                            frame.open();
                        });
                        
                        // 画像削除
                        $('.sato-remove-image').on('click', function(e) {
                            e.preventDefault();
                            var target = $(this).data('target');
                            $('#' + target).val('');
                            $('#' + target + '_preview').html('');
                            $(this).hide();
                        });
                        
                        // ギャラリー画像追加
                        $('#add_gallery_images').on('click', function(e) {
                            e.preventDefault();
                            var frame = wp.media({
                                title: 'ギャラリー画像を選択',
                                button: { text: '追加' },
                                multiple: true
                            });
                            frame.on('select', function() {
                                var attachments = frame.state().get('selection').toJSON();
                                var container = $('#works_gallery_container');
                                var ids = $('#works_gallery').val() ? $('#works_gallery').val().split(',') : [];
                                
                                attachments.forEach(function(attachment) {
                                    if (ids.indexOf(attachment.id.toString()) === -1) {
                                        ids.push(attachment.id);
                                        var thumb = attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                                        container.append(
                                            '<div class=\"sato-gallery-item\" data-id=\"' + attachment.id + '\">' +
                                            '<img src=\"' + thumb + '\" alt=\"\">' +
                                            '<button type=\"button\" class=\"remove-image\">&times;</button>' +
                                            '</div>'
                                        );
                                    }
                                });
                                
                                $('#works_gallery').val(ids.join(','));
                            });
                            frame.open();
                        });
                        
                        // ギャラリー画像削除
                        $(document).on('click', '.sato-gallery-item .remove-image', function() {
                            var item = $(this).closest('.sato-gallery-item');
                            var id = item.data('id').toString();
                            var ids = $('#works_gallery').val().split(',').filter(function(i) { return i !== id; });
                            $('#works_gallery').val(ids.join(','));
                            item.remove();
                        });
                        
                        // ギャラリーソート
                        $('#works_gallery_container').sortable({
                            update: function() {
                                var ids = [];
                                $(this).find('.sato-gallery-item').each(function() {
                                    ids.push($(this).data('id'));
                                });
                                $('#works_gallery').val(ids.join(','));
                            }
                        });
                    });
                ");
            }
        }
    }
}
add_action('admin_enqueue_scripts', 'sato_admin_scripts');

// =============================================================================
// フロントエンド スタイル・スクリプト読み込み
// =============================================================================
if (!function_exists('sato_enqueue_assets')) {
    function sato_enqueue_assets() {
        // Google Fonts
        wp_enqueue_style(
            'google-fonts',
            'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
            [],
            null
        );

        // メインスタイル（style.css）
        wp_enqueue_style(
            'sato-style',
            get_stylesheet_uri(),
            ['google-fonts'],
            SATO_THEME_VERSION
        );

        // ヘッダー用CSS
        if (file_exists(SATO_THEME_ASSETS_DIR . '/css/header.css')) {
            wp_enqueue_style(
                'sato-header-css',
                SATO_THEME_ASSETS . '/css/header.css',
                ['sato-style'],
                SATO_THEME_VERSION
            );
        }

        // フッター用CSS
        if (file_exists(SATO_THEME_ASSETS_DIR . '/css/footer.css')) {
            wp_enqueue_style(
                'sato-footer-css',
                SATO_THEME_ASSETS . '/css/footer.css',
                ['sato-style'],
                SATO_THEME_VERSION
            );
        }

        // フロントページ専用CSS
        if (is_front_page() && file_exists(SATO_THEME_ASSETS_DIR . '/css/front-page.css')) {
            wp_enqueue_style(
                'sato-front-page-css',
                SATO_THEME_ASSETS . '/css/front-page.css',
                ['sato-style'],
                SATO_THEME_VERSION
            );
        }

        // jQuery（WordPress標準）
        wp_enqueue_script('jquery');

        // メインJS
        if (file_exists(SATO_THEME_ASSETS_DIR . '/js/main.js')) {
            wp_enqueue_script(
                'sato-main-js',
                SATO_THEME_ASSETS . '/js/main.js',
                ['jquery'],
                SATO_THEME_VERSION,
                true
            );
        }

        // ヘッダーJS
        if (file_exists(SATO_THEME_ASSETS_DIR . '/js/header.js')) {
            wp_enqueue_script(
                'sato-header-js',
                SATO_THEME_ASSETS . '/js/header.js',
                [],
                SATO_THEME_VERSION,
                true
            );
        }

        // フロントページ専用JS
        if (is_front_page() && file_exists(SATO_THEME_ASSETS_DIR . '/js/front-page.js')) {
            wp_enqueue_script(
                'sato-front-page-js',
                SATO_THEME_ASSETS . '/js/front-page.js',
                ['jquery'],
                SATO_THEME_VERSION,
                true
            );
        }

        // PHPの値をJSに渡す
        wp_localize_script('sato-main-js', 'satoData', [
            'ajaxUrl'     => admin_url('admin-ajax.php'),
            'homeUrl'     => home_url('/'),
            'themeUrl'    => SATO_THEME_URI,
            'nonce'       => wp_create_nonce('sato_ajax_nonce'),
            'phone'       => sato_get_phone(),
            'phoneLink'   => sato_get_phone_link(),
            'lineUrl'     => sato_get_line_url(),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'sato_enqueue_assets');



// =============================================================================
// カスタマイザー設定
// =============================================================================
if (!function_exists('sato_customize_register')) {
    function sato_customize_register($wp_customize) {
        
        // ===========================================
        // 会社情報パネル
        // ===========================================
        $wp_customize->add_panel('sato_company_panel', [
            'title'    => '会社情報',
            'priority' => 30,
        ]);

        // --- 基本情報セクション ---
        $wp_customize->add_section('sato_company_basic', [
            'title' => '基本情報',
            'panel' => 'sato_company_panel',
        ]);

        // 会社名
        $wp_customize->add_setting('sato_company_name', [
            'default'           => 'サトー建装',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ]);
        $wp_customize->add_control('sato_company_name', [
            'label'   => '会社名（表示名）',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 会社名（正式名称）
        $wp_customize->add_setting('sato_company_name_full', [
            'default'           => '株式会社サトー建装',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_company_name_full', [
            'label'   => '会社名（正式名称）',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // キャッチコピー
        $wp_customize->add_setting('sato_catchphrase', [
            'default'           => '御殿場市・静岡県東部の外壁塗装・屋根塗装専門店',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_catchphrase', [
            'label'   => 'キャッチコピー',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 電話番号
        $wp_customize->add_setting('sato_phone', [
            'default'           => '0550-00-0000',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_phone', [
            'label'   => '電話番号',
            'section' => 'sato_company_basic',
            'type'    => 'tel',
        ]);

        // FAX番号
        $wp_customize->add_setting('sato_fax', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_fax', [
            'label'   => 'FAX番号',
            'section' => 'sato_company_basic',
            'type'    => 'tel',
        ]);

        // メールアドレス
        $wp_customize->add_setting('sato_email', [
            'default'           => 'info@satokens.jp',
            'sanitize_callback' => 'sanitize_email',
        ]);
        $wp_customize->add_control('sato_email', [
            'label'   => 'メールアドレス',
            'section' => 'sato_company_basic',
            'type'    => 'email',
        ]);

        // 郵便番号
        $wp_customize->add_setting('sato_zip', [
            'default'           => '〒412-0043',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_zip', [
            'label'   => '郵便番号',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 住所
        $wp_customize->add_setting('sato_address', [
            'default'           => '静岡県御殿場市',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_address', [
            'label'   => '住所',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 営業時間
        $wp_customize->add_setting('sato_business_hours', [
            'default'           => '8:00〜18:00',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_business_hours', [
            'label'   => '営業時間',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 定休日
        $wp_customize->add_setting('sato_holiday', [
            'default'           => '日曜日・祝日',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_holiday', [
            'label'   => '定休日',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 代表者名
        $wp_customize->add_setting('sato_representative', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_representative', [
            'label'   => '代表者名',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 設立年
        $wp_customize->add_setting('sato_established', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_established', [
            'label'   => '設立年',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 資本金
        $wp_customize->add_setting('sato_capital', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_capital', [
            'label'   => '資本金',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 従業員数
        $wp_customize->add_setting('sato_employees', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_employees', [
            'label'   => '従業員数',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // 建設業許可番号
        $wp_customize->add_setting('sato_license', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_license', [
            'label'   => '建設業許可番号',
            'section' => 'sato_company_basic',
            'type'    => 'text',
        ]);

        // --- SNS・外部サービスセクション ---
        $wp_customize->add_section('sato_sns', [
            'title' => 'SNS・外部サービス',
            'panel' => 'sato_company_panel',
        ]);

        // LINE公式アカウントID
        $wp_customize->add_setting('sato_line_id', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_line_id', [
            'label'       => 'LINE公式アカウントID',
            'section'     => 'sato_sns',
            'type'        => 'text',
            'description' => '例: @xxxxx',
        ]);

        // LINE友だち追加URL
        $wp_customize->add_setting('sato_line_url', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_line_url', [
            'label'       => 'LINE友だち追加URL',
            'section'     => 'sato_sns',
            'type'        => 'url',
            'description' => '例: https://line.me/ti/p/@xxxxx',
        ]);

        // Instagram
        $wp_customize->add_setting('sato_instagram', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_instagram', [
            'label'   => 'Instagram URL',
            'section' => 'sato_sns',
            'type'    => 'url',
        ]);

        // Facebook
        $wp_customize->add_setting('sato_facebook', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_facebook', [
            'label'   => 'Facebook URL',
            'section' => 'sato_sns',
            'type'    => 'url',
        ]);

        // Twitter/X
        $wp_customize->add_setting('sato_twitter', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_twitter', [
            'label'   => 'Twitter/X URL',
            'section' => 'sato_sns',
            'type'    => 'url',
        ]);

        // YouTube
        $wp_customize->add_setting('sato_youtube', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_youtube', [
            'label'   => 'YouTube URL',
            'section' => 'sato_sns',
            'type'    => 'url',
        ]);

        // Googleマップ埋め込みURL
        $wp_customize->add_setting('sato_google_map', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_google_map', [
            'label'       => 'Googleマップ埋め込みURL',
            'section'     => 'sato_sns',
            'type'        => 'url',
            'description' => 'Googleマップの「共有」→「地図を埋め込む」のsrc属性のURLを入力',
        ]);

        // Googleビジネスプロフィール
        $wp_customize->add_setting('sato_google_business', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control('sato_google_business', [
            'label'   => 'Googleビジネスプロフィール URL',
            'section' => 'sato_sns',
            'type'    => 'url',
        ]);

        // ===========================================
        // フロントページパネル
        // ===========================================
        $wp_customize->add_panel('sato_frontpage_panel', [
            'title'    => 'フロントページ設定',
            'priority' => 35,
        ]);

        // --- ヒーローセクション ---
        $wp_customize->add_section('sato_hero', [
            'title' => 'ヒーロー（メインビジュアル）',
            'panel' => 'sato_frontpage_panel',
        ]);

        // メインキャッチコピー1行目
        $wp_customize->add_setting('sato_hero_catch1', [
            'default'           => '住まいを守る、',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_hero_catch1', [
            'label'   => 'メインキャッチコピー（1行目）',
            'section' => 'sato_hero',
            'type'    => 'text',
        ]);

        // メインキャッチコピー2行目
        $wp_customize->add_setting('sato_hero_catch2', [
            'default'           => '職人の技術と想い。',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_hero_catch2', [
            'label'   => 'メインキャッチコピー（2行目）',
            'section' => 'sato_hero',
            'type'    => 'text',
        ]);

        // サブキャッチコピー
        $wp_customize->add_setting('sato_hero_subcatch', [
            'default'           => '国家資格 一級塗装技能士が施工する御殿場市の塗装専門店',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_hero_subcatch', [
            'label'   => 'サブキャッチコピー',
            'section' => 'sato_hero',
            'type'    => 'text',
        ]);

        // ヒーロー背景画像
        $wp_customize->add_setting('sato_hero_image_1', [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'sato_hero_image_1', [
            'label'     => 'ヒーロー背景画像',
            'section'   => 'sato_hero',
            'mime_type' => 'image',
            'description' => '推奨サイズ: 1920×800px以上',
        ]));

        // --- 対応エリアセクション ---
        $wp_customize->add_section('sato_area', [
            'title' => '対応エリア',
            'panel' => 'sato_frontpage_panel',
        ]);

        // 対応エリア（テキスト）
        $wp_customize->add_setting('sato_service_areas', [
            'default'           => "御殿場市\n裾野市\n三島市\n沼津市\n富士市\n富士宮市\n長泉町\n清水町",
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control('sato_service_areas', [
            'label'       => '対応エリア',
            'section'     => 'sato_area',
            'type'        => 'textarea',
            'description' => '1行に1つのエリアを入力（改行区切り）',
        ]);

        // エリア補足テキスト
        $wp_customize->add_setting('sato_area_note', [
            'default'           => 'その他、静岡県東部エリアもご対応可能です。まずはお気軽にお問い合わせください。',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control('sato_area_note', [
            'label'   => 'エリア補足テキスト',
            'section' => 'sato_area',
            'type'    => 'textarea',
        ]);

        // --- 保証設定セクション ---
        $wp_customize->add_section('sato_warranty', [
            'title' => '保証・アフターサポート',
            'panel' => 'sato_frontpage_panel',
        ]);

        // 最長保証年数
        $wp_customize->add_setting('sato_warranty_years', [
            'default'           => '10',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control('sato_warranty_years', [
            'label'   => '最長保証年数',
            'section' => 'sato_warranty',
            'type'    => 'number',
        ]);

        // 保証内容テキスト
        $wp_customize->add_setting('sato_warranty_text', [
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control('sato_warranty_text', [
            'label'   => '保証内容テキスト',
            'section' => 'sato_warranty',
            'type'    => 'textarea',
        ]);

        // ===========================================
        // SEO設定パネル
        // ===========================================
        $wp_customize->add_panel('sato_seo_panel', [
            'title'    => 'SEO設定',
            'priority' => 40,
        ]);

        // --- 基本SEOセクション ---
        $wp_customize->add_section('sato_seo_basic', [
            'title' => '基本SEO設定',
            'panel' => 'sato_seo_panel',
        ]);

        // サイト説明文（meta description）
        $wp_customize->add_setting('sato_site_description', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control('sato_site_description', [
            'label'       => 'サイト説明文（トップページ用）',
            'section'     => 'sato_seo_basic',
            'type'        => 'textarea',
            'description' => '80〜160文字推奨。検索結果に表示されます。',
        ]);

        // 地域キーワード
        $wp_customize->add_setting('sato_seo_area_keywords', [
            'default'           => '御殿場市,裾野市,三島市,沼津市,静岡県東部',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_seo_area_keywords', [
            'label'       => '地域キーワード',
            'section'     => 'sato_seo_basic',
            'type'        => 'text',
            'description' => 'カンマ区切りで入力',
        ]);

        // サービスキーワード
        $wp_customize->add_setting('sato_seo_service_keywords', [
            'default'           => '外壁塗装,屋根塗装,防水工事,塗り替え',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_seo_service_keywords', [
            'label'       => 'サービスキーワード',
            'section'     => 'sato_seo_basic',
            'type'        => 'text',
            'description' => 'カンマ区切りで入力',
        ]);

        // --- OGP設定セクション ---
        $wp_customize->add_section('sato_ogp', [
            'title' => 'OGP設定（SNS共有）',
            'panel' => 'sato_seo_panel',
        ]);

        // デフォルトOGP画像
        $wp_customize->add_setting('sato_ogp_image', [
            'default'           => '',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'sato_ogp_image', [
            'label'     => 'デフォルトOGP画像',
            'section'   => 'sato_ogp',
            'mime_type' => 'image',
            'description' => '推奨サイズ: 1200×630px。SNS共有時に使用されます。',
        ]));

        // Facebook App ID
        $wp_customize->add_setting('sato_fb_app_id', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_fb_app_id', [
            'label'   => 'Facebook App ID',
            'section' => 'sato_ogp',
            'type'    => 'text',
        ]);

        // Twitter Card Type
        $wp_customize->add_setting('sato_twitter_card', [
            'default'           => 'summary_large_image',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_twitter_card', [
            'label'   => 'Twitter Card タイプ',
            'section' => 'sato_ogp',
            'type'    => 'select',
            'choices' => [
                'summary'             => 'Summary',
                'summary_large_image' => 'Summary with Large Image',
            ],
        ]);

        // --- アナリティクス設定セクション ---
        $wp_customize->add_section('sato_analytics', [
            'title' => 'アクセス解析',
            'panel' => 'sato_seo_panel',
        ]);

        // Google Analytics ID
        $wp_customize->add_setting('sato_ga_id', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_ga_id', [
            'label'       => 'Google Analytics 測定ID',
            'section'     => 'sato_analytics',
            'type'        => 'text',
            'description' => '例: G-XXXXXXXXXX',
        ]);

        // Google Tag Manager ID
        $wp_customize->add_setting('sato_gtm_id', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_gtm_id', [
            'label'       => 'Google Tag Manager ID',
            'section'     => 'sato_analytics',
            'type'        => 'text',
            'description' => '例: GTM-XXXXXXX',
        ]);

        // Google Search Console 認証コード
        $wp_customize->add_setting('sato_gsc_verification', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control('sato_gsc_verification', [
            'label'       => 'Google Search Console 認証コード',
            'section'     => 'sato_analytics',
            'type'        => 'text',
            'description' => 'contentの値のみを入力',
        ]);
    }
}
add_action('customize_register', 'sato_customize_register');


// =============================================================================
// ヘルパー関数
// =============================================================================

/**
 * 電話番号を取得
 */
if (!function_exists('sato_get_phone')) {
    function sato_get_phone() {
        return get_theme_mod('sato_phone', '0550-00-0000');
    }
}

/**
 * 電話番号リンクを取得
 */
if (!function_exists('sato_get_phone_link')) {
    function sato_get_phone_link() {
        $phone = sato_get_phone();
        return 'tel:' . preg_replace('/[^0-9]/', '', $phone);
    }
}

/**
 * LINE URLを取得
 */
if (!function_exists('sato_get_line_url')) {
    function sato_get_line_url() {
        $line_url = get_theme_mod('sato_line_url', '');
        if ($line_url) {
            return $line_url;
        }
        $line_id = get_theme_mod('sato_line_id', '');
        if ($line_id) {
            return 'https://line.me/ti/p/' . ltrim($line_id, '@');
        }
        return '';
    }
}

/**
 * 会社名を取得
 */
if (!function_exists('sato_get_company_name')) {
    function sato_get_company_name($full = false) {
        if ($full) {
            return get_theme_mod('sato_company_name_full', 'サトー建装');
        }
        return get_theme_mod('sato_company_name', 'サトー建装');
    }
}
/**
 * SVGアイコンを取得
 */
if (!function_exists('sato_get_svg_icon')) {
    function sato_get_svg_icon($name, $size = 24, $class = '') {
        // 共通属性の定義
        $attr_stroke = 'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="' . intval($size) . '" height="' . intval($size) . '" class="icon ' . esc_attr($class) . '"';
        $attr_fill   = 'viewBox="0 0 24 24" fill="currentColor" width="' . intval($size) . '" height="' . intval($size) . '" class="icon ' . esc_attr($class) . '"';

        $icons = [
            // 基本アイコン
            'menu'           => '<svg ' . $attr_stroke . '><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>',
            'close'          => '<svg ' . $attr_stroke . '><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>',
            'chevron-down'   => '<svg ' . $attr_stroke . '><polyline points="6 9 12 15 18 9"/></svg>',
            'chevron-up'     => '<svg ' . $attr_stroke . '><polyline points="18 15 12 9 6 15"/></svg>',
            'chevron-right'  => '<svg ' . $attr_stroke . '><polyline points="9 18 15 12 9 6"/></svg>',
            'chevron-left'   => '<svg ' . $attr_stroke . '><polyline points="15 18 9 12 15 6"/></svg>',
            'arrow-right'    => '<svg ' . $attr_stroke . '><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',
            'check'          => '<svg ' . $attr_stroke . '><polyline points="20 6 9 17 4 12"/></svg>',
            'check-circle'   => '<svg ' . $attr_stroke . '><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
            'info'           => '<svg ' . $attr_stroke . '><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>',
            'alert-circle'   => '<svg ' . $attr_stroke . '><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
            'search'         => '<svg ' . $attr_stroke . '><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>',
            'map-pin'        => '<svg ' . $attr_stroke . '><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',
            'phone'          => '<svg ' . $attr_stroke . '><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
            'mail'           => '<svg ' . $attr_stroke . '><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',
            'clock'          => '<svg ' . $attr_stroke . '><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
            'calendar'       => '<svg ' . $attr_stroke . '><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',
            'external-link'  => '<svg ' . $attr_stroke . '><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>',
            'home'           => '<svg ' . $attr_stroke . '><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
            
            // 塗装・建築関連
            'roof'           => '<svg ' . $attr_stroke . '><path d="M3 10l9-7 9 7v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10z"/><polyline points="9 22 9 12 15 12 15 22"/><rect x="2" y="8" width="20" height="2"/></svg>',
            'wall'           => '<svg ' . $attr_stroke . '><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="12" y1="4" x2="12" y2="12"/><line x1="8" y1="12" x2="8" y2="20"/><line x1="16" y1="12" x2="16" y2="20"/></svg>',
            'waterproof'     => '<svg ' . $attr_stroke . '><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>',
            'shield'         => '<svg ' . $attr_stroke . '><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
            'shield-check'   => '<svg ' . $attr_stroke . '><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>',
            'award'          => '<svg ' . $attr_stroke . '><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>',
            'certificate'    => '<svg ' . $attr_stroke . '><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',
            'badge'          => '<svg ' . $attr_stroke . '><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.78 4.78 4 4 0 0 1-6.74 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/></svg>',
            'handshake'      => '<svg ' . $attr_stroke . '><path d="m11 17 2 2a6 6 0 0 0 8-8l-2-2"/><path d="m12.12 11.23.88-.88a6 6 0 1 0-8.49-8.49l-1.6 1.6a7 7 0 0 0 11.16 9.87l-1.95-2.1"/></svg>',
            'tool'           => '<svg ' . $attr_stroke . '><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
            
            // 塗装関連（続き）
            'image'          => '<svg ' . $attr_stroke . '><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>',
        ];

        return $icons[$name] ?? '';
    }
}



/**
 * アイコン取得のエイリアス関数
 */
if (!function_exists('sato_icon')) {
    function sato_icon($name, $size = 24, $class = '') {
        echo sato_get_svg_icon($name, $size, $class);
    }
}


// =============================================================================
// データ取得ヘルパー関数
// =============================================================================

/**
 * 施工実績を取得
 */
if (!function_exists('sato_get_works')) {
    function sato_get_works($args = []) {
        $defaults = [
            'post_type'      => 'works',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * お客様の声を取得
 */
if (!function_exists('sato_get_voices')) {
    function sato_get_voices($args = []) {
        $defaults = [
            'post_type'      => 'voice',
            'posts_per_page' => 6,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * FAQを取得
 */
if (!function_exists('sato_get_faqs')) {
    function sato_get_faqs($args = []) {
        $defaults = [
            'post_type'      => 'faq',
            'posts_per_page' => -1,
            'orderby'        => 'meta_value_num',
            'meta_key'       => '_faq_display_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * お知らせを取得
 */
if (!function_exists('sato_get_news')) {
    function sato_get_news($args = []) {
        $defaults = [
            'post_type'      => 'news',
            'posts_per_page' => 5,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * サービスを取得
 */
if (!function_exists('sato_get_services')) {
    function sato_get_services($args = []) {
        $defaults = [
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * スタッフを取得
 */
if (!function_exists('sato_get_staff')) {
    function sato_get_staff($args = []) {
        $defaults = [
            'post_type'      => 'staff',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * 星評価を表示
 */
if (!function_exists('sato_rating_stars')) {
    function sato_rating_stars($rating, $max = 5, $echo = true) {
        $rating = intval($rating);
        $output = '<div class="rating-stars" aria-label="評価: ' . $rating . '点（' . $max . '点満点）">';
        for ($i = 1; $i <= $max; $i++) {
            if ($i <= $rating) {
                $output .= sato_get_svg_icon('star', 20, 'star-filled');
            } else {
                $output .= sato_get_svg_icon('star-outline', 20, 'star-empty');
            }
        }
        $output .= '</div>';
        
        if ($echo) {
            echo $output;
        }
        return $output;
    }
}

/**
 * 対応エリアをリストで取得
 */
if (!function_exists('sato_get_service_areas')) {
    function sato_get_service_areas() {
        $areas_text = get_theme_mod('sato_service_areas', "御殿場市\n裾野市\n三島市\n沼津市\n富士市\n富士宮市\n長泉町\n清水町");
        $areas = array_filter(array_map('trim', explode("\n", $areas_text)));
        return $areas;
    }
}


// =============================================================================
// SEO機能
// =============================================================================

/**
 * SEOメタタグを出力
 */
if (!function_exists('sato_output_seo_meta')) {
    function sato_output_seo_meta() {
        global $post;
        
        // 基本情報
        $site_name = get_bloginfo('name');
        $company_name = sato_get_company_name();
        
        // タイトルとディスクリプション
        if (is_front_page()) {
            $title = get_theme_mod('sato_seo_title', $site_name . ' | ' . get_theme_mod('sato_catchphrase', ''));
            $description = get_theme_mod('sato_site_description', get_bloginfo('description'));
        } elseif (is_singular()) {
            $seo_title = get_post_meta($post->ID, '_sato_seo_title', true);
            $seo_description = get_post_meta($post->ID, '_sato_seo_description', true);
            
            $title = $seo_title ?: get_the_title() . ' | ' . $site_name;
            $description = $seo_description ?: wp_trim_words(get_the_excerpt(), 160, '...');
        } elseif (is_archive()) {
            $title = get_the_archive_title() . ' | ' . $site_name;
            $description = get_the_archive_description() ?: $site_name . 'の' . get_the_archive_title() . '一覧ページです。';
        } elseif (is_search()) {
            $title = '「' . get_search_query() . '」の検索結果 | ' . $site_name;
            $description = '「' . get_search_query() . '」の検索結果ページです。';
        } elseif (is_404()) {
            $title = 'ページが見つかりません | ' . $site_name;
            $description = 'お探しのページは見つかりませんでした。';
        } else {
            $title = $site_name;
            $description = get_bloginfo('description');
        }
        
        // ディスクリプション出力
        if ($description) {
            echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        }
        
        // noindex判定
        $noindex = false;
        if (is_singular() && get_post_meta($post->ID, '_sato_seo_noindex', true) === '1') {
            $noindex = true;
        }
        if (is_search() || is_404()) {
            $noindex = true;
        }
        
        if ($noindex) {
            echo '<meta name="robots" content="noindex, nofollow">' . "\n";
        }
        
        // Google Search Console認証
        $gsc_verification = get_theme_mod('sato_gsc_verification', '');
        if ($gsc_verification) {
            echo '<meta name="google-site-verification" content="' . esc_attr($gsc_verification) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'sato_output_seo_meta', 1);


/**
 * OGP・Twitter Cardを出力
 */
if (!function_exists('sato_output_ogp')) {
    function sato_output_ogp() {
        global $post;
        
        $site_name = get_bloginfo('name');
        $locale = 'ja_JP';
        
        // 基本OGP
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
        echo '<meta property="og:locale" content="' . esc_attr($locale) . '">' . "\n";
        
        // ページ別設定
        if (is_front_page()) {
            $og_title = $site_name;
            $og_description = get_theme_mod('sato_site_description', get_bloginfo('description'));
            $og_type = 'website';
            $og_url = home_url('/');
            $og_image_id = get_theme_mod('sato_ogp_image', 0);
        } elseif (is_singular()) {
            $seo_title = get_post_meta($post->ID, '_sato_seo_title', true);
            $seo_description = get_post_meta($post->ID, '_sato_seo_description', true);
            $og_image_custom = get_post_meta($post->ID, '_sato_og_image', true);
            
            $og_title = $seo_title ?: get_the_title();
            $og_description = $seo_description ?: wp_trim_words(get_the_excerpt(), 100, '...');
            $og_type = 'article';
            $og_url = get_permalink();
            $og_image_id = $og_image_custom ?: get_post_thumbnail_id() ?: get_theme_mod('sato_ogp_image', 0);
        } else {
            $og_title = get_the_archive_title() ?: $site_name;
            $og_description = get_the_archive_description() ?: get_bloginfo('description');
            $og_type = 'website';
            $og_url = home_url($_SERVER['REQUEST_URI']);
            $og_image_id = get_theme_mod('sato_ogp_image', 0);
        }
        
        echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($og_description) . '">' . "\n";
        echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
        
        // OGP画像
        if ($og_image_id) {
            $og_image_url = wp_get_attachment_image_url($og_image_id, 'og-image');
            if ($og_image_url) {
                echo '<meta property="og:image" content="' . esc_url($og_image_url) . '">' . "\n";
                echo '<meta property="og:image:width" content="1200">' . "\n";
                echo '<meta property="og:image:height" content="630">' . "\n";
            }
        }
        
        // Facebook App ID
        $fb_app_id = get_theme_mod('sato_fb_app_id', '');
        if ($fb_app_id) {
            echo '<meta property="fb:app_id" content="' . esc_attr($fb_app_id) . '">' . "\n";
        }
        
        // Twitter Card
        $twitter_card = get_theme_mod('sato_twitter_card', 'summary_large_image');
        echo '<meta name="twitter:card" content="' . esc_attr($twitter_card) . '">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($og_title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($og_description) . '">' . "\n";
        
        if ($og_image_id) {
            $og_image_url = wp_get_attachment_image_url($og_image_id, 'og-image');
            if ($og_image_url) {
                echo '<meta name="twitter:image" content="' . esc_url($og_image_url) . '">' . "\n";
            }
        }
    }
}
add_action('wp_head', 'sato_output_ogp', 2);


/**
 * 構造化データ（JSON-LD）を出力
 */
if (!function_exists('sato_output_structured_data')) {
    function sato_output_structured_data() {
        global $post;
        
        $company_name = sato_get_company_name(true);
        $phone = sato_get_phone();
        $address = get_theme_mod('sato_address', '');
        $zip = get_theme_mod('sato_zip', '');
        
        // 組織情報（全ページ共通）
        $organization = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            '@id' => home_url('/#organization'),
            'name' => $company_name,
            'url' => home_url('/'),
            'telephone' => $phone,
            'email' => get_theme_mod('sato_email', ''),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address,
                'addressLocality' => '御殿場市',
                'addressRegion' => '静岡県',
                'postalCode' => str_replace('〒', '', $zip),
                'addressCountry' => 'JP',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => '35.3088',
                'longitude' => '138.9344',
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '08:00',
                'closes' => '18:00',
            ],
            'priceRange' => '￥￥',
            'image' => get_theme_mod('sato_ogp_image') ? wp_get_attachment_image_url(get_theme_mod('sato_ogp_image'), 'full') : '',
            'sameAs' => array_filter([
                get_theme_mod('sato_instagram', ''),
                get_theme_mod('sato_facebook', ''),
                get_theme_mod('sato_twitter', ''),
                get_theme_mod('sato_youtube', ''),
                get_theme_mod('sato_line_url', ''),
            ]),
            'areaServed' => array_map(function($area) {
                return [
                    '@type' => 'City',
                    'name' => $area,
                ];
            }, sato_get_service_areas()),
            'serviceType' => ['外壁塗装', '屋根塗装', '防水工事', 'シーリング工事'],
        ];
        
        echo '<script type="application/ld+json">' . wp_json_encode($organization, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        
        // WebSite構造化データ
        if (is_front_page()) {
            $website = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => get_bloginfo('name'),
                'url' => home_url('/'),
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => home_url('/?s={search_term_string}'),
                    'query-input' => 'required name=search_term_string',
                ],
            ];
            echo '<script type="application/ld+json">' . wp_json_encode($website, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        }
        
        // 記事ページ
        if (is_singular(['post', 'news'])) {
            $article = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => get_the_title(),
                'datePublished' => get_the_date('c'),
                'dateModified' => get_the_modified_date('c'),
                'author' => [
                    '@type' => 'Organization',
                    'name' => $company_name,
                ],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => $company_name,
                    'logo' => [
                        '@type' => 'ImageObject',
                        'url' => get_theme_mod('sato_ogp_image') ? wp_get_attachment_image_url(get_theme_mod('sato_ogp_image'), 'full') : '',
                    ],
                ],
                'mainEntityOfPage' => get_permalink(),
            ];
            
            if (has_post_thumbnail()) {
                $article['image'] = get_the_post_thumbnail_url($post->ID, 'large');
            }
            
            echo '<script type="application/ld+json">' . wp_json_encode($article, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        }
        
        // 施工実績ページ
        if (is_singular('works')) {
            $service = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => get_the_title(),
                'description' => get_the_excerpt(),
                'provider' => [
                    '@type' => 'LocalBusiness',
                    'name' => $company_name,
                ],
                'areaServed' => [
                    '@type' => 'City',
                    'name' => get_post_meta($post->ID, '_works_client_name', true) ?: '御殿場市',
                ],
            ];
            
            if (has_post_thumbnail()) {
                $service['image'] = get_the_post_thumbnail_url($post->ID, 'large');
            }
            
            echo '<script type="application/ld+json">' . wp_json_encode($service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
        }
        
        // FAQページ
        if (is_post_type_archive('faq') || is_singular('faq')) {
            $faqs = sato_get_faqs();
            if ($faqs->have_posts()) {
                $faq_items = [];
                while ($faqs->have_posts()) {
                    $faqs->the_post();
                    $faq_items[] = [
                        '@type' => 'Question',
                        'name' => get_the_title(),
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text' => wp_strip_all_tags(get_the_content()),
                        ],
                    ];
                }
                wp_reset_postdata();
                
                $faq_schema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'FAQPage',
                    'mainEntity' => $faq_items,
                ];
                
                echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
            }
        }
        
        // お客様の声（レビュー）
        if (is_post_type_archive('voice') || is_singular('voice')) {
            $voices = sato_get_voices(['posts_per_page' => 10]);
            if ($voices->have_posts()) {
                $reviews = [];
                $total_rating = 0;
                $count = 0;
                
                while ($voices->have_posts()) {
                    $voices->the_post();
                    $rating = get_post_meta(get_the_ID(), '_voice_rating', true) ?: 5;
                    $total_rating += intval($rating);
                    $count++;
                    
                    $reviews[] = [
                        '@type' => 'Review',
                        'author' => [
                            '@type' => 'Person',
                            'name' => get_post_meta(get_the_ID(), '_voice_client_initial', true) ?: '匿名',
                        ],
                        'reviewRating' => [
                            '@type' => 'Rating',
                            'ratingValue' => $rating,
                            'bestRating' => 5,
                        ],
                        'reviewBody' => wp_trim_words(get_the_content(), 200, '...'),
                    ];
                }
                wp_reset_postdata();
                
                $avg_rating = $count > 0 ? round($total_rating / $count, 1) : 5;
                
                $review_schema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'LocalBusiness',
                    'name' => $company_name,
                    'aggregateRating' => [
                        '@type' => 'AggregateRating',
                        'ratingValue' => $avg_rating,
                        'reviewCount' => $count,
                        'bestRating' => 5,
                    ],
                    'review' => $reviews,
                ];
                
                echo '<script type="application/ld+json">' . wp_json_encode($review_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
            }
        }
        
        // パンくずリスト
        if (!is_front_page()) {
            $breadcrumb_items = sato_get_breadcrumb_items();
            if (!empty($breadcrumb_items)) {
                $breadcrumb_schema = [
                    '@context' => 'https://schema.org',
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [],
                ];
                
                foreach ($breadcrumb_items as $index => $item) {
                    $breadcrumb_schema['itemListElement'][] = [
                        '@type' => 'ListItem',
                        'position' => $index + 1,
                        'name' => $item['title'],
                        'item' => $item['url'],
                    ];
                }
                
                echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
            }
        }
    }
}
add_action('wp_head', 'sato_output_structured_data', 5);


/**
 * パンくずリストのアイテムを取得
 */
if (!function_exists('sato_get_breadcrumb_items')) {
    function sato_get_breadcrumb_items() {
        global $post;
        
        $items = [];
        $items[] = ['title' => 'ホーム', 'url' => home_url('/')];
        
        if (is_singular()) {
            $post_type = get_post_type();
            $post_type_obj = get_post_type_object($post_type);
            
            if ($post_type !== 'page' && $post_type !== 'post') {
                if ($post_type_obj && $post_type_obj->has_archive) {
                    $items[] = [
                        'title' => $post_type_obj->labels->name,
                        'url' => get_post_type_archive_link($post_type),
                    ];
                }
            }
            
            if ($post_type === 'post') {
                $categories = get_the_category();
                if ($categories) {
                    $items[] = [
                        'title' => $categories[0]->name,
                        'url' => get_category_link($categories[0]->term_id),
                    ];
                }
            }
            
            $items[] = ['title' => get_the_title(), 'url' => get_permalink()];
            
        } elseif (is_post_type_archive()) {
            $post_type_obj = get_queried_object();
            $items[] = [
                'title' => $post_type_obj->labels->name,
                'url' => get_post_type_archive_link($post_type_obj->name),
            ];
            
        } elseif (is_tax()) {
            $term = get_queried_object();
            $taxonomy = get_taxonomy($term->taxonomy);
            
            // 投稿タイプのアーカイブを追加
            if (!empty($taxonomy->object_type)) {
                $post_type = $taxonomy->object_type[0];
                $post_type_obj = get_post_type_object($post_type);
                if ($post_type_obj && $post_type_obj->has_archive) {
                    $items[] = [
                        'title' => $post_type_obj->labels->name,
                        'url' => get_post_type_archive_link($post_type),
                    ];
                }
            }
            
            $items[] = ['title' => $term->name, 'url' => get_term_link($term)];
            
        } elseif (is_category()) {
            $category = get_queried_object();
            $items[] = ['title' => $category->name, 'url' => get_category_link($category->term_id)];
            
        } elseif (is_tag()) {
            $tag = get_queried_object();
            $items[] = ['title' => $tag->name, 'url' => get_tag_link($tag->term_id)];
            
        } elseif (is_search()) {
            $items[] = ['title' => '「' . get_search_query() . '」の検索結果', 'url' => get_search_link()];
            
        } elseif (is_404()) {
            $items[] = ['title' => 'ページが見つかりません', 'url' => ''];
        }
        
        return $items;
    }
}


/**
 * パンくずリストを表示
 */
if (!function_exists('sato_breadcrumb')) {
    function sato_breadcrumb() {
        if (is_front_page()) {
            return;
        }
        
        $items = sato_get_breadcrumb_items();
        
        if (empty($items)) {
            return;
        }
        
        echo '<nav class="breadcrumb" aria-label="パンくずリスト">';
        echo '<ol class="breadcrumb__list">';
        
        $count = count($items);
        foreach ($items as $index => $item) {
            $is_last = ($index === $count - 1);
            
            echo '<li class="breadcrumb__item">';
            
            if (!$is_last && $item['url']) {
                echo '<a href="' . esc_url($item['url']) . '" class="breadcrumb__link">';
                echo esc_html($item['title']);
                echo '</a>';
                echo '<span class="breadcrumb__separator">' . sato_get_svg_icon('chevron-right', 16) . '</span>';
            } else {
                echo '<span class="breadcrumb__current" aria-current="page">' . esc_html($item['title']) . '</span>';
            }
            
            echo '</li>';
        }
        
        echo '</ol>';
        echo '</nav>';
    }
}


// =============================================================================
// Google Analytics / Tag Manager
// =============================================================================

/**
 * Google Analytics 4を出力
 */
if (!function_exists('sato_output_ga4')) {
    function sato_output_ga4() {
        $ga_id = get_theme_mod('sato_ga_id', '');
        
        if (empty($ga_id)) {
            return;
        }
        
        // 管理者はトラッキングしない（オプション）
        if (is_user_logged_in() && current_user_can('manage_options')) {
            return;
        }
        ?>
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?php echo esc_js($ga_id); ?>', {
    'anonymize_ip': true,
    'link_attribution': true
});
</script>
        <?php
    }
}
add_action('wp_head', 'sato_output_ga4', 1);


/**
 * Google Tag Manager（head）を出力
 */
if (!function_exists('sato_output_gtm_head')) {
    function sato_output_gtm_head() {
        $gtm_id = get_theme_mod('sato_gtm_id', '');
        
        if (empty($gtm_id)) {
            return;
        }
        
        if (is_user_logged_in() && current_user_can('manage_options')) {
            return;
        }
        ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_js($gtm_id); ?>');</script>
<!-- End Google Tag Manager -->
        <?php
    }
}
add_action('wp_head', 'sato_output_gtm_head', 1);


/**
 * Google Tag Manager（body）を出力
 */
if (!function_exists('sato_output_gtm_body')) {
    function sato_output_gtm_body() {
        $gtm_id = get_theme_mod('sato_gtm_id', '');
        
        if (empty($gtm_id)) {
            return;
        }
        
        if (is_user_logged_in() && current_user_can('manage_options')) {
            return;
        }
        ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        <?php
    }
}
add_action('wp_body_open', 'sato_output_gtm_body', 1);


// =============================================================================
// パフォーマンス最適化
// =============================================================================

/**
 * 不要なWordPress機能を無効化
 */
if (!function_exists('sato_disable_unnecessary_features')) {
    function sato_disable_unnecessary_features() {
        // バージョン情報削除
        remove_action('wp_head', 'wp_generator');
        
        // Emoji無効化
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles', 'print_emoji_styles');
        
        // RSD/wlwmanifest無効化
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        
        // 短縮URLリンク無効化
        remove_action('wp_head', 'wp_shortlink_wp_head');
        
        // REST API リンク（必要に応じて）
        // remove_action('wp_head', 'rest_output_link_wp_head');
        
        // oEmbed無効化（必要に応じて）
        // remove_action('wp_head', 'wp_oembed_add_discovery_links');
        
        // 前後記事リンク
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        
        // Windows Live Writer
        remove_action('wp_head', 'wlwmanifest_link');
    }
}
add_action('init', 'sato_disable_unnecessary_features');


/**
 * DNS Prefetch / Preconnectを追加
 */
if (!function_exists('sato_resource_hints')) {
    function sato_resource_hints($urls, $relation_type) {
        if ($relation_type === 'dns-prefetch') {
            $urls[] = '//fonts.googleapis.com';
            $urls[] = '//fonts.gstatic.com';
            $urls[] = '//www.google-analytics.com';
            $urls[] = '//www.googletagmanager.com';
        }
        
        if ($relation_type === 'preconnect') {
            $urls[] = [
                'href' => 'https://fonts.googleapis.com',
                'crossorigin' => false,
            ];
            $urls[] = [
                'href' => 'https://fonts.gstatic.com',
                'crossorigin' => true,
            ];
        }
        
        return $urls;
    }
}
add_filter('wp_resource_hints', 'sato_resource_hints', 10, 2);


/**
 * 抜粋の長さを調整
 */
if (!function_exists('sato_excerpt_length')) {
    function sato_excerpt_length($length) {
        return 80;
    }
}
add_filter('excerpt_length', 'sato_excerpt_length');


/**
 * 抜粋の「続きを読む」を調整
 */
if (!function_exists('sato_excerpt_more')) {
    function sato_excerpt_more($more) {
        return '...';
    }
}
add_filter('excerpt_more', 'sato_excerpt_more');


/**
 * ログインページのロゴURL変更
 */
if (!function_exists('sato_login_logo_url')) {
    function sato_login_logo_url() {
        return home_url('/');
    }
}
add_filter('login_headerurl', 'sato_login_logo_url');


/**
 * ログインページのロゴタイトル変更
 */
if (!function_exists('sato_login_logo_url_title')) {
    function sato_login_logo_url_title() {
        return get_bloginfo('name');
    }
}
add_filter('login_headertext', 'sato_login_logo_url_title');


// =============================================================================
// ウィジェットエリア登録
// =============================================================================
if (!function_exists('sato_widgets_init')) {
    function sato_widgets_init() {
        // サイドバー
        register_sidebar([
            'name'          => 'サイドバー',
            'id'            => 'sidebar-1',
            'description'   => 'ブログページなどで表示されるサイドバー',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
        
        // フッター1
        register_sidebar([
            'name'          => 'フッター1',
            'id'            => 'footer-1',
            'description'   => 'フッターエリア1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
        
        // フッター2
        register_sidebar([
            'name'          => 'フッター2',
            'id'            => 'footer-2',
            'description'   => 'フッターエリア2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
        
        // フッター3
        register_sidebar([
            'name'          => 'フッター3',
            'id'            => 'footer-3',
            'description'   => 'フッターエリア3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
        
        // CTA用（固定表示など）
        register_sidebar([
            'name'          => 'CTA（お問い合わせ誘導）',
            'id'            => 'cta-widget',
            'description'   => '記事下などに表示されるCTA',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'sato_widgets_init');


// =============================================================================
// AJAX処理
// =============================================================================

/**
 * 施工実績の追加読み込み
 */
if (!function_exists('sato_load_more_works')) {
    function sato_load_more_works() {
        check_ajax_referer('sato_ajax_nonce', 'nonce');
        
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $area = isset($_POST['area']) ? sanitize_text_field($_POST['area']) : '';
        
        $args = [
            'post_type'      => 'works',
            'posts_per_page' => 6,
            'paged'          => $paged,
            'post_status'    => 'publish',
        ];
        
        // カテゴリーフィルター
        if ($category) {
            $args['tax_query'][] = [
                'taxonomy' => 'works_category',
                'field'    => 'slug',
                'terms'    => $category,
            ];
        }
        
        // エリアフィルター
        if ($area) {
            $args['tax_query'][] = [
                'taxonomy' => 'works_area',
                'field'    => 'slug',
                'terms'    => $area,
            ];
        }
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content', 'works-card');
            }
            wp_reset_postdata();
            
            wp_send_json_success([
                'html'     => ob_get_clean(),
                'has_more' => $paged < $query->max_num_pages,
            ]);
        } else {
            wp_send_json_error(['message' => '施工実績が見つかりませんでした']);
        }
    }
}
add_action('wp_ajax_sato_load_more_works', 'sato_load_more_works');
add_action('wp_ajax_nopriv_sato_load_more_works', 'sato_load_more_works');


/**
 * お問い合わせフォーム送信（シンプル版）
 */
if (!function_exists('sato_contact_form_submit')) {
    function sato_contact_form_submit() {
        check_ajax_referer('sato_ajax_nonce', 'nonce');
        
        // フォームデータ取得
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
        $service = isset($_POST['service']) ? sanitize_text_field($_POST['service']) : '';
        
        // バリデーション
        $errors = [];
        
        if (empty($name)) {
            $errors[] = 'お名前を入力してください';
        }
        
        if (empty($email) || !is_email($email)) {
            $errors[] = '正しいメールアドレスを入力してください';
        }
        
        if (empty($message)) {
            $errors[] = 'お問い合わせ内容を入力してください';
        }
        
        // ハニーポット（スパム対策）
        if (!empty($_POST['website'])) {
            wp_send_json_error(['message' => '送信に失敗しました']);
            return;
        }
        
        if (!empty($errors)) {
            wp_send_json_error(['message' => implode('<br>', $errors)]);
            return;
        }
        
        // メール送信
        $to = get_theme_mod('sato_email', get_option('admin_email'));
        $subject = '【お問い合わせ】' . get_bloginfo('name') . ' - ' . $name . '様';
        
        $body = "お問い合わせを受け付けました。\n\n";
        $body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $body .= "■ お名前: {$name}\n";
        $body .= "■ メールアドレス: {$email}\n";
        $body .= "■ 電話番号: {$phone}\n";
        $body .= "■ ご検討中のサービス: {$service}\n";
        $body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $body .= "■ お問い合わせ内容:\n{$message}\n\n";
        $body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $body .= "送信日時: " . current_time('Y年m月d日 H:i') . "\n";
        $body .= "送信元: " . home_url('/') . "\n";
        
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . get_bloginfo('name') . ' <' . $to . '>',
            'Reply-To: ' . $name . ' <' . $email . '>',
        ];
        
        $sent = wp_mail($to, $subject, $body, $headers);
        
        if ($sent) {
            // 自動返信メール
            $auto_subject = '【' . get_bloginfo('name') . '】お問い合わせありがとうございます';
            $auto_body = "{$name} 様\n\n";
            $auto_body .= "この度は、" . get_bloginfo('name') . "にお問い合わせいただき、\n";
            $auto_body .= "誠にありがとうございます。\n\n";
            $auto_body .= "以下の内容でお問い合わせを承りました。\n";
            $auto_body .= "担当者より改めてご連絡させていただきますので、\n";
            $auto_body .= "今しばらくお待ちくださいませ。\n\n";
            $auto_body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $auto_body .= "■ お名前: {$name}\n";
            $auto_body .= "■ ご検討中のサービス: {$service}\n";
            $auto_body .= "■ お問い合わせ内容:\n{$message}\n";
            $auto_body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            $auto_body .= "※このメールは自動送信されています。\n";
            $auto_body .= "━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $auto_body .= sato_get_company_name(true) . "\n";
            $auto_body .= "TEL: " . sato_get_phone() . "\n";
            $auto_body .= "URL: " . home_url('/') . "\n";
            
            wp_mail($email, $auto_subject, $auto_body, $headers);
            
            wp_send_json_success(['message' => 'お問い合わせを送信しました。<br>確認メールをお送りしましたのでご確認ください。']);
        } else {
            wp_send_json_error(['message' => '送信に失敗しました。お手数ですがお電話にてお問い合わせください。']);
        }
    }
}
add_action('wp_ajax_sato_contact_form_submit', 'sato_contact_form_submit');
add_action('wp_ajax_nopriv_sato_contact_form_submit', 'sato_contact_form_submit');


// =============================================================================
// Contact Form 7対応
// =============================================================================

/**
 * Contact Form 7の自動pタグ無効化
 */
add_filter('wpcf7_autop_or_not', '__return_false');


// =============================================================================
// セキュリティ強化
// =============================================================================

/**
 * SVGアップロードを許可
 */
if (!function_exists('sato_allow_svg')) {
    function sato_allow_svg($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
        return $mimes;
    }
}
add_filter('upload_mimes', 'sato_allow_svg');


/**
 * SVGのサニタイズ
 */
if (!function_exists('sato_sanitize_svg')) {
    function sato_sanitize_svg($file) {
        if ($file['type'] === 'image/svg+xml') {
            $svg_content = file_get_contents($file['tmp_name']);
            
            // 危険なタグを除去
            $dangerous_tags = ['script', 'onload', 'onclick', 'onerror'];
            foreach ($dangerous_tags as $tag) {
                if (stripos($svg_content, '<' . $tag) !== false || stripos($svg_content, $tag . '=') !== false) {
                    $file['error'] = 'セキュリティ上の理由からこのSVGファイルはアップロードできません。';
                    return $file;
                }
            }
        }
        return $file;
    }
}
add_filter('wp_handle_upload_prefilter', 'sato_sanitize_svg');


// =============================================================================
// 管理画面カスタマイズ
// =============================================================================

/**
 * 管理画面フッターテキスト変更
 */
if (!function_exists('sato_admin_footer_text')) {
    function sato_admin_footer_text() {
        return '<span id="footer-thankyou">' . sato_get_company_name() . ' 公式テーマ ver.' . SATO_THEME_VERSION . '</span>';
    }
}
add_filter('admin_footer_text', 'sato_admin_footer_text');


/**
 * 管理バーにカスタムメニュー追加
 */
if (!function_exists('sato_admin_bar_menu')) {
    function sato_admin_bar_menu($wp_admin_bar) {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        $wp_admin_bar->add_node([
            'id'    => 'sato-theme-settings',
            'title' => sato_get_svg_icon('brush', 16) . ' テーマ設定',
            'href'  => admin_url('customize.php'),
        ]);
        
        $wp_admin_bar->add_node([
            'id'     => 'sato-company-info',
            'parent' => 'sato-theme-settings',
            'title'  => '会社情報',
            'href'   => admin_url('customize.php?autofocus[panel]=sato_company_panel'),
        ]);
        
        $wp_admin_bar->add_node([
            'id'     => 'sato-frontpage',
            'parent' => 'sato-theme-settings',
            'title'  => 'フロントページ設定',
            'href'   => admin_url('customize.php?autofocus[panel]=sato_frontpage_panel'),
        ]);
        
        $wp_admin_bar->add_node([
            'id'     => 'sato-seo',
            'parent' => 'sato-theme-settings',
            'title'  => 'SEO設定',
            'href'   => admin_url('customize.php?autofocus[panel]=sato_seo_panel'),
        ]);
    }
}
add_action('admin_bar_menu', 'sato_admin_bar_menu', 100);


/**
 * ダッシュボードウィジェット追加
 */
if (!function_exists('sato_dashboard_widgets')) {
    function sato_dashboard_widgets() {
        wp_add_dashboard_widget(
            'sato_quick_stats',
            sato_get_company_name() . ' サイト概要',
            'sato_dashboard_widget_content'
        );
    }
    
    function sato_dashboard_widget_content() {
        $works_count = wp_count_posts('works')->publish;
        $voice_count = wp_count_posts('voice')->publish;
        $news_count = wp_count_posts('news')->publish;
        $faq_count = wp_count_posts('faq')->publish;
        ?>
        <div class="sato-dashboard-stats" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; text-align: center;">
            <div style="padding: 15px; background: #f0f6fc; border-radius: 8px;">
                <div style="font-size: 28px; font-weight: bold; color: #0073aa;"><?php echo $works_count; ?></div>
                <div style="font-size: 12px; color: #666;">施工実績</div>
            </div>
            <div style="padding: 15px; background: #f0f6fc; border-radius: 8px;">
                <div style="font-size: 28px; font-weight: bold; color: #0073aa;"><?php echo $voice_count; ?></div>
                <div style="font-size: 12px; color: #666;">お客様の声</div>
            </div>
            <div style="padding: 15px; background: #f0f6fc; border-radius: 8px;">
                <div style="font-size: 28px; font-weight: bold; color: #0073aa;"><?php echo $news_count; ?></div>
                <div style="font-size: 12px; color: #666;">お知らせ</div>
            </div>
            <div style="padding: 15px; background: #f0f6fc; border-radius: 8px;">
                <div style="font-size: 28px; font-weight: bold; color: #0073aa;"><?php echo $faq_count; ?></div>
                <div style="font-size: 12px; color: #666;">FAQ</div>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <h4 style="margin-bottom: 10px;">クイックリンク</h4>
            <a href="<?php echo admin_url('post-new.php?post_type=works'); ?>" class="button" style="margin-right: 5px;">施工実績を追加</a>
            <a href="<?php echo admin_url('post-new.php?post_type=voice'); ?>" class="button" style="margin-right: 5px;">お客様の声を追加</a>
            <a href="<?php echo admin_url('post-new.php?post_type=news'); ?>" class="button">お知らせを追加</a>
        </div>
        <?php
    }
}
add_action('wp_dashboard_setup', 'sato_dashboard_widgets');


// =============================================================================
// テーマ有効化時の処理
// =============================================================================

/**
 * テーマ有効化時にリライトルールをフラッシュ
 */
if (!function_exists('sato_theme_activation')) {
    function sato_theme_activation() {
        // カスタム投稿タイプとタクソノミーを登録
        sato_register_post_types();
        sato_register_taxonomies();
        sato_register_default_terms();
        
        // リライトルールをフラッシュ
        flush_rewrite_rules();
        
        // デフォルトオプションを設定
        if (!get_option('sato_theme_activated')) {
            update_option('sato_theme_activated', true);
            update_option('sato_theme_version', SATO_THEME_VERSION);
        }
    }
}
add_action('after_switch_theme', 'sato_theme_activation');


/**
 * テーマ無効化時の処理
 */
if (!function_exists('sato_theme_deactivation')) {
    function sato_theme_deactivation() {
        flush_rewrite_rules();
    }
}
add_action('switch_theme', 'sato_theme_deactivation');


// =============================================================================
// ショートコード
// =============================================================================

/**
 * 電話番号ショートコード
 */
if (!function_exists('sato_phone_shortcode')) {
    function sato_phone_shortcode($atts) {
        $atts = shortcode_atts([
            'text' => '',
            'class' => '',
        ], $atts);
        
        $phone = sato_get_phone();
        $link = sato_get_phone_link();
        $text = $atts['text'] ?: $phone;
        $class = $atts['class'] ? ' ' . esc_attr($atts['class']) : '';
        
        return '<a href="' . esc_attr($link) . '" class="phone-link' . $class . '">' . esc_html($text) . '</a>';
    }
}
add_shortcode('sato_phone', 'sato_phone_shortcode');


/**
 * LINE友だち追加ボタンショートコード
 */
if (!function_exists('sato_line_button_shortcode')) {
    function sato_line_button_shortcode($atts) {
        $atts = shortcode_atts([
            'text' => 'LINEで相談する',
            'class' => '',
        ], $atts);
        
        $line_url = sato_get_line_url();
        
        if (!$line_url) {
            return '';
        }
        
        $class = 'line-button' . ($atts['class'] ? ' ' . esc_attr($atts['class']) : '');
        
        return '<a href="' . esc_url($line_url) . '" class="' . $class . '" target="_blank" rel="noopener noreferrer">' . sato_get_svg_icon('line', 20) . ' ' . esc_html($atts['text']) . '</a>';
    }
}
add_shortcode('sato_line', 'sato_line_button_shortcode');


/**
 * 施工実績カウントショートコード
 */
if (!function_exists('sato_works_count_shortcode')) {
    function sato_works_count_shortcode($atts) {
        $atts = shortcode_atts([
            'format' => '%s件',
        ], $atts);
        
        $count = wp_count_posts('works')->publish;
        
        return sprintf($atts['format'], number_format($count));
    }
}
add_shortcode('sato_works_count', 'sato_works_count_shortcode');


/**
 * 営業時間ショートコード
 */
if (!function_exists('sato_business_hours_shortcode')) {
    function sato_business_hours_shortcode() {
        return esc_html(get_theme_mod('sato_business_hours', '8:00〜18:00'));
    }
}
add_shortcode('sato_hours', 'sato_business_hours_shortcode');


/**
 * 会社名ショートコード
 */
if (!function_exists('sato_company_name_shortcode')) {
    function sato_company_name_shortcode($atts) {
        $atts = shortcode_atts([
            'full' => false,
        ], $atts);
        
        return esc_html(sato_get_company_name($atts['full']));
    }
}
add_shortcode('sato_company', 'sato_company_name_shortcode');


// =============================================================================
// カスタムログイン画面
// =============================================================================

/**
 * ログイン画面のスタイル
 */
if (!function_exists('sato_login_styles')) {
    function sato_login_styles() {
        $logo_id = get_theme_mod('custom_logo');
        $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'medium') : '';
        ?>
        <style type="text/css">
            body.login {
                background: linear-gradient(135deg, #0056a6 0%, #003d7a 100%);
            }
            .login h1 a {
                <?php if ($logo_url) : ?>
                background-image: url(<?php echo esc_url($logo_url); ?>);
                background-size: contain;
                width: 200px;
                height: 80px;
                <?php else : ?>
                font-size: 20px;
                color: #fff;
                text-indent: 0;
                background: none;
                width: auto;
                height: auto;
                <?php endif; ?>
            }
            .login form {
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            }
            .login #backtoblog a,
            .login #nav a {
                color: rgba(255,255,255,0.8);
            }
            .login #backtoblog a:hover,
            .login #nav a:hover {
                color: #fff;
            }
            .wp-core-ui .button-primary {
                background: #0056a6;
                border-color: #003d7a;
            }
            .wp-core-ui .button-primary:hover {
                background: #003d7a;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'sato_login_styles');


// =============================================================================
// デバッグ・開発用
// =============================================================================

/**
 * 開発環境でのみデバッグ情報を表示
 */
if (!function_exists('sato_debug_info')) {
    function sato_debug_info() {
        if (!WP_DEBUG || !current_user_can('manage_options')) {
            return;
        }
        
        global $wpdb;
        
        echo '<!-- SATO DEBUG INFO';
        echo "\nQueries: " . get_num_queries();
        echo "\nTime: " . timer_stop(0) . 's';
        echo "\nMemory: " . round(memory_get_peak_usage() / 1024 / 1024, 2) . 'MB';
        echo "\n-->";
    }
}
add_action('wp_footer', 'sato_debug_info', 999);


// =============================================================================
// エンドオブファイル
// =============================================================================


// =============================================================================
// front-page.php 互換用ヘルパー関数
// =============================================================================

/**
 * 電話番号取得（エイリアス）
 */
if (!function_exists('sato_get_phone_number')) {
    function sato_get_phone_number() {
        return sato_get_phone();
    }
}

/**
 * 創業年数を取得
 */
if (!function_exists('sato_get_years_in_business')) {
    function sato_get_years_in_business() {
        $established = get_theme_mod('sato_established', '');
        if ($established) {
            // 数字以外を除去して年数計算
            $year = intval(preg_replace('/[^0-9]/', '', $established));
            if ($year > 0) {
                return date('Y') - $year;
            }
        }
        return '20'; // デフォルト値
    }
}

/**
 * 保証年数を取得
 */
if (!function_exists('sato_get_warranty_years')) {
    function sato_get_warranty_years() {
        return get_theme_mod('sato_warranty_years', '10');
    }
}

/**
 * 汎用カスタム投稿取得
 */
if (!function_exists('sato_get_custom_posts')) {
    function sato_get_custom_posts($post_type, $args = []) {
        $defaults = [
            'post_type'      => $post_type,
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];
        $args = wp_parse_args($args, $defaults);
        return new WP_Query($args);
    }
}

/**
 * 注目の施工実績を取得
 */
if (!function_exists('sato_get_featured_works')) {
    function sato_get_featured_works($count = 6) {
        // recommendフラグがあるものを優先、なければ最新
        $args = [
            'post_type'      => 'works',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'meta_query'     => [
                'relation' => 'OR',
                [
                    'key'     => '_works_featured',
                    'value'   => '1',
                    'compare' => '='
                ],
                [
                    'key'     => '_works_featured',
                    'compare' => 'NOT EXISTS'
                ]
            ],
            'orderby' => 'meta_value_num date', // featuredがあるものを優先したい場合など調整
        ];
        return new WP_Query($args);
    }
}

/**
 * 注目のFAQを取得
 */
if (!function_exists('sato_get_featured_faqs')) {
    function sato_get_featured_faqs($count = 5) {
        return new WP_Query([
            'post_type'      => 'faq',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
            'meta_key'       => '_faq_is_featured',
            'meta_value'     => '1',
            'orderby'        => 'meta_value_num', // 表示順序(_faq_display_order)があればそちらを優先すべきですが、ここでは簡易的に
        ]);
    }
}

/**
 * 星評価取得（HTMLを返す版）
 */
if (!function_exists('sato_get_rating_stars')) {
    function sato_get_rating_stars($rating, $max = 5) {
        // 第3引数をfalseにしてechoせずに値を返す
        return sato_rating_stars($rating, $max, false);
    }
}


