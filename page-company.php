<?php
/**
 * Template Name: 会社案内ページ
 * Template Post Type: page
 * Description: 会社概要・スタッフ紹介・アクセスマップ（functions.php連携版）
 * Author: Senior WordPress Engineer
 * Version: 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// =============================================================================
// データ取得 (functions.phpのカスタマイザー設定から)
// =============================================================================
// 会社情報
$company_name      = sato_get_company_name();
$company_name_full = sato_get_company_name(true);
$catchphrase       = get_theme_mod('sato_catchphrase', '御殿場市・静岡県東部の外壁塗装・屋根塗装専門店');
$representative    = get_theme_mod('sato_representative', '');
$address           = get_theme_mod('sato_address', '');
$zip               = get_theme_mod('sato_zip', '');
$phone             = sato_get_phone();
$phone_link        = sato_get_phone_link();
$fax               = get_theme_mod('sato_fax', '');
$email             = get_theme_mod('sato_email', '');
$business_hours    = get_theme_mod('sato_business_hours', '');
$holiday           = get_theme_mod('sato_holiday', '');
$established       = get_theme_mod('sato_established', '');
$capital           = get_theme_mod('sato_capital', '');
$employees         = get_theme_mod('sato_employees', '');
$license           = get_theme_mod('sato_license', '');
$google_map        = get_theme_mod('sato_google_map', ''); // Googleマップ埋め込みURL
$line_url          = sato_get_line_url();

// スタッフ取得
$staff_query = new WP_Query([
    'post_type'      => 'staff',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "GeneralContractor",
    "name": "<?php echo esc_js($company_name_full); ?>",
    "image": "<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'full') : ''; ?>",
    "@id": "<?php echo home_url('/#organization'); ?>",
    "url": "<?php echo home_url('/'); ?>",
    "telephone": "<?php echo esc_js($phone); ?>",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo esc_js($address); ?>",
        "addressLocality": "御殿場市",
        "addressRegion": "静岡県",
        "postalCode": "<?php echo esc_js(str_replace('〒', '', $zip)); ?>",
        "addressCountry": "JP"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": 35.3088,
        "longitude": 138.9344
    },
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ],
        "opens": "08:00",
        "closes": "18:00"
    }
}
</script>

<main id="main" class="company-page" role="main">

    <section class="page-header">
        <div class="page-header__bg">
            <div class="page-header__bg-image" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&q=80&w=1920');"></div>
            <div class="page-header__bg-overlay"></div>
        </div>
        
        <div class="container">
            <nav class="breadcrumb" aria-label="パンくずリスト">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__item"><a href="<?php echo home_url('/'); ?>" class="breadcrumb__link">HOME</a></li>
                    <li class="breadcrumb__separator">/</li>
                    <li class="breadcrumb__item"><span class="breadcrumb__current">会社案内</span></li>
                </ol>
            </nav>

            <div class="page-header__content">
                <span class="page-header__tag">COMPANY</span>
                <h1 class="page-header__title">会社案内</h1>
                <p class="page-header__lead">
                    地域に根ざして<?php echo sato_get_years_in_business(); ?>年。<br>
                    お客様の暮らしを守る、私たちの想いと概要をご紹介します。
                </p>
            </div>
        </div>
        <div class="page-header__wave">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,64 C320,120 640,0 960,64 C1280,128 1400,32 1440,64 L1440,120 L0,120 Z" fill="#ffffff"/></svg>
        </div>
    </section>

    <section class="section section--message">
        <div class="container">
            <div class="message-box">
                <div class="message-box__image">
                    <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?auto=format&fit=crop&q=80&w=600" alt="代表者" loading="lazy">
                </div>
                <div class="message-box__content">
                    <span class="message-box__subtitle">MESSAGE</span>
                    <h2 class="message-box__title">
                        <?php echo nl2br(esc_html($catchphrase)); ?>
                    </h2>
                    <div class="message-box__text">
                        <p>
                            平素より格別のご高配を賜り、厚く御礼申し上げます。<br>
                            <?php echo esc_html($company_name); ?>は、創業以来「丁寧な仕事」をモットーに、地域の皆様の大切なお住まいを守るお手伝いをしてまいりました。
                        </p>
                        <p>
                            塗装工事は、建物の美観を保つだけでなく、紫外線や雨風から家を守り、長く快適に住み続けるために欠かせないメンテナンスです。私たちは一級塗装技能士としての誇りを持ち、見えない下地処理から仕上げまで、一切の妥協を許さない施工をお約束します。
                        </p>
                        <p>
                            これからも地域の皆様に信頼され、愛される塗装店を目指して精進してまいります。
                        </p>
                    </div>
                    <div class="message-box__signer">
                        <span class="post">代表取締役</span>
                        <span class="name"><?php echo esc_html($representative ?: '代表者名'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($staff_query->have_posts()) : ?>
    <section class="section section--staff bg-gray">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">OUR STAFF</span>
                <h2 class="section-head__title">自慢の<span class="marker-blue">スタッフ</span>紹介</h2>
                <p class="section-head__desc">
                    国家資格を持つ熟練の職人が、真心込めて施工いたします。<br>
                    私たちにお任せください。
                </p>
            </div>

            <div class="staff-grid">
                <?php while ($staff_query->have_posts()) : $staff_query->the_post(); 
                    $position = get_post_meta(get_the_ID(), '_staff_position', true);
                    $experience = get_post_meta(get_the_ID(), '_staff_experience', true);
                    $qualifications = get_post_meta(get_the_ID(), '_staff_qualifications', true);
                    $message = get_post_meta(get_the_ID(), '_staff_message', true);
                    
                    $img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : 'https://placehold.co/400x400/e2e8f0/64748b?text=Staff';
                ?>
                <div class="staff-card">
                    <div class="staff-card__header">
                        <div class="staff-card__img">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title(); ?>" loading="lazy">
                        </div>
                        <div class="staff-card__title">
                            <span class="position"><?php echo esc_html($position); ?></span>
                            <h3 class="name"><?php the_title(); ?></h3>
                            <?php if ($experience) : ?>
                            <span class="experience">経験年数: <?php echo esc_html($experience); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="staff-card__body">
                        <?php if ($qualifications) : ?>
                        <div class="staff-card__qualifications">
                            <strong>保有資格</strong>
                            <ul>
                                <?php foreach (explode("\n", $qualifications) as $qual) : ?>
                                    <?php if (trim($qual)) : ?>
                                    <li><i class="icon-check">✓</i> <?php echo esc_html($qual); ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php if ($message) : ?>
                        <div class="staff-card__message">
                            <p><?php echo nl2br(esc_html($message)); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="section section--profile">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">PROFILE</span>
                <h2 class="section-head__title">会社<span class="marker-blue">概要</span></h2>
            </div>

            <div class="profile-table-wrap">
                <dl class="profile-list">
                    <div class="profile-row">
                        <dt>会社名</dt>
                        <dd><?php echo esc_html($company_name_full); ?></dd>
                    </div>
                    <?php if ($representative) : ?>
                    <div class="profile-row">
                        <dt>代表者</dt>
                        <dd><?php echo esc_html($representative); ?></dd>
                    </div>
                    <?php endif; ?>
                    <div class="profile-row">
                        <dt>所在地</dt>
                        <dd>
                            <?php echo esc_html($zip); ?> <?php echo esc_html($address); ?>
                            <?php if ($google_map) : ?>
                            <a href="#access-map" class="map-link">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                地図を見る
                            </a>
                            <?php endif; ?>
                        </dd>
                    </div>
                    <div class="profile-row">
                        <dt>電話番号</dt>
                        <dd><a href="<?php echo esc_attr($phone_link); ?>" class="tel-link"><?php echo esc_html($phone); ?></a></dd>
                    </div>
                    <?php if ($fax) : ?>
                    <div class="profile-row">
                        <dt>FAX番号</dt>
                        <dd><?php echo esc_html($fax); ?></dd>
                    </div>
                    <?php endif; ?>
                    <div class="profile-row">
                        <dt>営業時間</dt>
                        <dd><?php echo esc_html($business_hours); ?></dd>
                    </div>
                    <div class="profile-row">
                        <dt>定休日</dt>
                        <dd><?php echo esc_html($holiday); ?></dd>
                    </div>
                    <?php if ($established) : ?>
                    <div class="profile-row">
                        <dt>設立</dt>
                        <dd><?php echo esc_html($established); ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if ($capital) : ?>
                    <div class="profile-row">
                        <dt>資本金</dt>
                        <dd><?php echo esc_html($capital); ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if ($license) : ?>
                    <div class="profile-row">
                        <dt>建設業許可</dt>
                        <dd><?php echo esc_html($license); ?></dd>
                    </div>
                    <?php endif; ?>
                    <div class="profile-row">
                        <dt>事業内容</dt>
                        <dd>
                            <ul class="service-list-inline">
                                <li>外壁塗装</li>
                                <li>屋根塗装</li>
                                <li>防水工事</li>
                                <li>各種リフォーム</li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <?php if ($google_map) : ?>
    <section class="section section--access bg-light" id="access-map">
        <div class="container">
            <div class="section-head text-center">
                <span class="section-head__sub">ACCESS</span>
                <h2 class="section-head__title">アクセス<span class="marker-blue">マップ</span></h2>
            </div>
            <div class="access-map-wrapper">
                <div class="access-map-frame">
                    <iframe src="<?php echo esc_url($google_map); ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="creative-bottom">
        <div class="creative-bottom__bg"></div>
        <div class="container">
            <div class="creative-bottom__inner">
                <h2 class="creative-bottom__title">
                    お住まいのことなら、<br>
                    <span class="highlight">何でもご相談</span>ください。
                </h2>
                <p class="creative-bottom__text">
                    現地調査・お見積りは完全無料です。<br>
                    皆様からのお問い合わせを心よりお待ちしております。
                </p>
                
                <div class="creative-bottom__links">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="link-card">
                        <div class="link-card__icon">📝</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">お見積り・ご相談</span>
                            <span class="link-card__main">無料診断・お見積り</span>
                        </div>
                        <div class="link-card__arrow">→</div>
                    </a>
                    
                    <?php if ($line_url) : ?>
                    <a href="<?php echo esc_url($line_url); ?>" class="link-card link-card--line" target="_blank" rel="noopener noreferrer">
                        <div class="link-card__icon">💬</div>
                        <div class="link-card__content">
                            <span class="link-card__sub">気軽にLINEで</span>
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
/* 共通変数 */
:root {
    --c-prm: #0d47a1;
    --c-acc: #f59e0b;
    --c-txt: #333;
    --c-bg-light: #fff;
    --c-bg-gray: #f8fafc;
    --radius-l: 16px;
    --radius-m: 8px;
    --shadow-card: 0 4px 6px -1px rgba(0,0,0,0.05);
    --container-max: 1200px;
    --container-pad: 20px;
}

body { font-family: "Helvetica Neue", Arial, sans-serif; color: var(--c-txt); line-height: 1.6; }
img { max-width: 100%; height: auto; }
.bg-gray { background-color: var(--c-bg-gray); }
.text-center { text-align: center; }

/* コンテナ */
.container {
    max-width: var(--container-max);
    margin: 0 auto;
    padding: 0 var(--container-pad);
}

/* Section Header */
.section { padding: 80px 0; }
.section-head { margin-bottom: 50px; }
.section-head__sub { display: block; color: var(--c-prm); font-weight: bold; letter-spacing: 0.1em; font-size: 0.9rem; margin-bottom: 10px; font-family: "DIN Alternate", sans-serif; }
.section-head__title { font-size: 2.2rem; font-weight: bold; margin-bottom: 15px; }
.section-head__desc { color: #666; font-size: 1rem; }
.marker-blue { background: linear-gradient(transparent 60%, rgba(13, 71, 161, 0.15) 60%); }
.marker-green { background: linear-gradient(transparent 60%, rgba(16, 185, 129, 0.2) 60%); }

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
.breadcrumb__separator { opacity: 0.5; }

/* Message Section */
.section--message { padding-bottom: 40px; }
.message-box {
    display: flex;
    align-items: center;
    gap: 50px;
}
.message-box__image {
    flex: 1;
    max-width: 450px;
    position: relative;
}
.message-box__image img {
    border-radius: var(--radius-l);
    box-shadow: 20px 20px 0 var(--c-bg-gray);
}
.message-box__content { flex: 1.5; }
.message-box__subtitle { display: block; color: var(--c-prm); font-weight: bold; margin-bottom: 10px; letter-spacing: 0.1em; font-family: "DIN Alternate", sans-serif; }
.message-box__title { font-size: 1.8rem; font-weight: bold; margin-bottom: 30px; line-height: 1.4; }
.message-box__text p { margin-bottom: 1.5em; text-align: justify; }
.message-box__signer { margin-top: 30px; text-align: right; }
.message-box__signer .post { display: block; font-size: 0.9rem; color: #666; margin-bottom: 5px; }
.message-box__signer .name { font-size: 1.5rem; font-weight: bold; font-family: "Yu Mincho", serif; }

/* Staff Section */
.staff-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}
.staff-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: transform 0.3s;
}
.staff-card:hover { transform: translateY(-5px); }
.staff-card__header { text-align: center; padding: 30px 20px 20px; background: linear-gradient(to bottom, #f0f4f8 50%, #fff 50%); }
.staff-card__img {
    width: 120px; height: 120px;
    margin: 0 auto 15px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.staff-card__img img { width: 100%; height: 100%; object-fit: cover; }
.staff-card__title .position { display: block; font-size: 0.8rem; color: var(--c-prm); font-weight: bold; margin-bottom: 5px; }
.staff-card__title .name { font-size: 1.3rem; margin: 0 0 5px; font-weight: bold; }
.staff-card__title .experience { font-size: 0.85rem; color: #666; background: #eee; padding: 2px 10px; border-radius: 10px; }

.staff-card__body { padding: 20px 25px 30px; }
.staff-card__qualifications { margin-bottom: 20px; border-bottom: 1px dashed #eee; padding-bottom: 15px; }
.staff-card__qualifications strong { display: block; font-size: 0.9rem; margin-bottom: 8px; color: #444; }
.staff-card__qualifications ul { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 8px; }
.staff-card__qualifications li { font-size: 0.8rem; color: #555; background: #f9f9f9; padding: 3px 8px; border-radius: 4px; }
.staff-card__qualifications i { color: var(--c-acc); font-size: 0.8em; margin-right: 2px; }
.staff-card__message p { font-size: 0.9rem; color: #444; line-height: 1.6; margin: 0; }

/* Profile Section */
.profile-table-wrap {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    border-radius: var(--radius-l);
    padding: 40px;
    box-shadow: var(--shadow-card);
}
.profile-list { display: flex; flex-direction: column; border-top: 1px solid #eee; margin: 0; }
.profile-row {
    display: flex;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
    align-items: flex-start;
}
.profile-row dt {
    width: 30%;
    font-weight: bold;
    color: var(--c-prm);
    padding-right: 20px;
}
.profile-row dd {
    width: 70%;
    margin: 0;
}
.map-link { margin-left: 10px; font-size: 0.85rem; color: var(--c-prm); text-decoration: underline; }
.tel-link { color: inherit; text-decoration: none; font-weight: bold; font-family: "DIN Alternate", sans-serif; font-size: 1.1rem; }
.service-list-inline { list-style: none; padding: 0; margin: 0; display: flex; gap: 10px; flex-wrap: wrap; }
.service-list-inline li { background: #eef2f6; padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; }

/* Access Map */
.access-map-wrapper { max-width: 1000px; margin: 0 auto; }
.access-map-frame { border-radius: var(--radius-l); overflow: hidden; box-shadow: var(--shadow-card); }

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
.link-card__icon { font-size: 1.5rem; }
.link-card__content { text-align: left; }
.link-card__sub { display: block; font-size: 0.75rem; color: #94a3b8; margin-bottom: 2px; }
.link-card__main { display: block; font-size: 1.1rem; font-weight: bold; color: var(--c-prm); }
.link-card__arrow { margin-left: auto; color: #cbd5e1; font-weight: bold; }
.link-card--line .link-card__main { color: #06c755; }
.link-card--line:hover { border-color: #06c755; }

/* Responsive */
@media (max-width: 768px) {
    .page-header__title { font-size: 2.2rem; }
    .page-header { height: 500px; padding-top: 100px; }
    .message-box { flex-direction: column; text-align: left; }
    .message-box__image { max-width: 100%; }
    .profile-table-wrap { padding: 20px; }
    .profile-row { flex-direction: column; }
    .profile-row dt { width: 100%; margin-bottom: 5px; }
    .profile-row dd { width: 100%; }
    .creative-bottom__links { flex-direction: column; align-items: center; }
    .link-card { width: 100%; justify-content: flex-start; }
}
</style>