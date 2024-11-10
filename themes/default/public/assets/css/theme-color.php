<?php
header("Content-Type:text/css");
$color = '#' . $_GET['color'] . ' !important;';
?>

.post-default .post-data .cats a,
.post-default .post-data .title h2 a:hover,
.post-default .post-data .meta li a:hover,
a:hover,
a:active,
a:focus,
.active,
.widget.widget-about .widget-content .author-social a i:hover,
.active-menu-item,
.post-details-cover .single-post-comment .comment-author-name h6:hover,
.nav-menu li:hover > a,
.post-default .post-data .cats a:after,
body.dark a:hover,
body.dark .active,
body.dark .nav-menu li a.active-menu-item,
body.dark .nav-menu li a:hover,
body.dark .banner-slide .banner-slide-text .category a,
body.dark .banner-slider-dots .active.current .dots-count,
body.dark .banner-slider .post-default.post-has-bg-img .cats a,
body.dark .post-default .post-data .cats a,
body.dark .banner-slider .post-default.post-has-bg-img .title h2 a:hover,
.container-404 .data p a
{
    color: <?php echo($color); ?>
}

.btn.btn-primary:before,
.btn.btn-primary:hover:before,
.newsletter form .btn,
.back-to-top:hover,
.widget.widget-most-commented-post .widget-content .wmcp-cover .owl-dots .owl-dot.active,
.preloader .spinnerBounce .double-bounce1,
.preloader .spinnerBounce .double-bounce2,
.post-details-cover.post-has-slide-thumb
  .post-thumb-cover
  .post-thumb
  .owl-nav
  .owl-prev:hover,
.post-details-cover.post-has-slide-thumb
  .post-thumb-cover
  .post-thumb
  .owl-nav
  .owl-next:hover
{
    background: <?php echo($color); ?>
}

.section-title h2,
body.dark .section-title h2
{
    background-image: linear-gradient(0deg, <?php echo('#' . $_GET['color']); ?> 25%, transparent 0%);
}

.widget.widget-tag-cloud .tagcloud a:hover,
.post-details-cover .post-all-tags a:hover,
.back-to-top:hover,
{
    color: #ffffff !important;
    background: <?php echo($color); ?>
}

.post-pagination span.current,
.post-pagination span:hover,
.post-pagination a.current,
.post-pagination a:hover
{
    color: #ffffff !important;
    background: <?php echo($color); ?>
}

.btn.btn-primary
{
    color:#000000 !important;
}

blockquote
{
    border-left: 2px solid <?php echo('#' . $_GET['color']); ?>; 
}