/* =============================================================================
   WORKS ARCHIVE STYLES
   ============================================================================= */

/* -- 共通変数 (既存のものと合わせてください) -- */
:root {
    --c-prm: #0d47a1;
    --c-acc: #f59e0b;
    --c-txt: #333;
    --c-bg-gray: #f8fafc;
    --radius-l: 16px;
    --radius-m: 8px;
    --shadow-card: 0 4px 6px -1px rgba(0,0,0,0.05);
    --shadow-hover: 0 10px 15px -3px rgba(0,0,0,0.1);
}

/* -- Page Header -- */
.page-header {
    position: relative;
    padding: 120px 0 80px;
    color: #fff;
    overflow: hidden;
}
.page-header__bg {
    position: absolute;
    inset: 0;
    z-index: -1;
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
}
.page-header__wave svg {
    width: 100%;
    height: 60px;
}

/* -- Filter Section -- */
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
    display: block;
    font-size: 0.85rem;
    font-weight: bold;
    margin-bottom: 8px;
    color: var(--c-txt);
}
.filter-form__select-wrap {
    position: relative;
}
.filter-form__select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    appearance: none;
    font-size: 0.95rem;
    color: var(--c-txt);
}
.filter-form__select:focus {
    border-color: var(--c-prm);
    outline: none;
}
/* Custom Arrow for Select */
.filter-form__select-wrap::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 15px;
    width: 8px;
    height: 8px;
    border-right: 2px solid #999;
    border-bottom: 2px solid #999;
    transform: translateY(-70%) rotate(45deg);
    pointer-events: none;
}
.filter-form__btn {
    min-width: 120px;
}
.btn--search {
    width: 100%;
    justify-content: center;
    padding: 12px 20px;
    border-radius: 6px;
}

/* -- Works Grid & List Header -- */
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
.works-reset-link:hover {
    color: var(--c-prm);
    text-decoration: underline;
}

.works-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* -- Works Card (Template Part Style) -- */
.works-card {
    background: #fff;
    border-radius: var(--radius-l);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
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
.works-card:hover .works-card__img {
    transform: scale(1.05);
}
.works-card__badges {
    position: absolute;
    top: 10px;
    left: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    z-index: 2;
}
.works-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: bold;
    color: #fff;
}
.works-badge--before-after { background: var(--c-prm); }
.works-badge--new { background: #e53e3e; }

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
.works-card__meta-item {
    display: flex;
    flex-direction: column;
}
.works-card__meta-item .label {
    font-size: 0.7rem;
    color: #888;
}
.works-card__meta-item .value {
    font-size: 0.9rem;
    font-weight: bold;
}
.works-card__meta-item .price {
    color: var(--c-prm);
    font-size: 1rem;
}

/* -- Pagination -- */
.pagination-wrapper {
    margin-top: 60px;
    text-align: center;
}
.pagination .page-numbers {
    display: inline-flex;
    gap: 10px;
    list-style: none;
}
.pagination .page-numbers a,
.pagination .page-numbers span {
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
.pagination .page-numbers .current,
.pagination .page-numbers a:hover {
    background: var(--c-prm);
    color: #fff;
    border-color: var(--c-prm);
}
.pagination .prev, .pagination .next {
    width: auto;
    padding: 0 20px;
    border-radius: 22px;
}

/* -- Responsive -- */
@media (max-width: 900px) {
    .works-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 600px) {
    .filter-form__inner {
        flex-direction: column;
    }
    .filter-form__group, .filter-form__btn {
        width: 100%;
        min-width: 100%;
    }
    .works-grid {
        grid-template-columns: 1fr;
    }
    .page-header {
        padding: 100px 0 60px;
    }
    .page-header__title {
        font-size: 2rem;
    }
}
</style>