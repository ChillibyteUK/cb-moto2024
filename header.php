<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lc-tideywebb
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/montserrat-v26-latin-700.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/montserrat-v26-latin-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?=get_stylesheet_directory_uri()?>/fonts/montserrat-v26-latin-500italic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <?php
    if (is_front_page()) {
        ?>
<script type="application/ld+json">
</script>
        <?php
    }
    if (get_field('ga_property', 'options')) { 
        ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property','options')?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?=get_field('ga_property','options')?>');
</script>
        <?php
    }
    if (get_field('gtm_property', 'options')) {
        ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?=get_field('gtm_property','options')?>');</script>
<!-- End Google Tag Manager -->
        <?php
    }
    if (get_field('google_site_verification','options')) {
        echo '<meta name="google-site-verification" content="' . get_field('google_site_verification','options') . '" />';
    }
    if (get_field('bing_site_verification','options')) {
        echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification','options') . '" />';
    }
    ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php
do_action('wp_body_open'); 
?>
<div class="site" id="page">
    <div id="wrapper-navbar" class="fixed-top">
        <nav id="navbar" class="navbar navbar-expand-md d-block py-auto" aria-labelledby="main-nav-label">
            <div class="container-xl d-block d-md-flex justify-content-start">
                <div class="d-flex w-md-auto justify-content-start align-items-center px-2">
                    <button class="navbar-toggler input-button" id="navToggle" data-bs-toggle="collapse" data-bs-target=".navbars" type="button" aria-label="Navigation">
                        <div class="navbar-toggler__container pointer">
                            <span class="navbar-toggler__bar1"></span>
                            <span class="navbar-toggler__bar2"></span>
                            <span class="navbar-toggler__bar3"></span>
                        </div>    
                    </button>
                    <div class="logo">
                        <a href="/" class="navbar-brand logo-full" rel="home"><img src="<?=get_stylesheet_directory_uri()?>/img/c-rd-motorola@2x.png" width=118.5 height=24 alt="Motorola logo"></a>
                        <a href="/" class="navbar-brand logo-icon" rel="home"><img src="<?=get_stylesheet_directory_uri()?>/img/motorola-2.png" width=30 height=30 alt="Motorola logo"></a>
                    </div>
                    <div class="mobile-icons d-flex gap-3 ms-auto d-md-none">
                        <div role="button" class="d-flex" data-bs-toggle="modal" data-bs-target="#newsletterModal">
                            <img class="newsletter-icon" alt="Newsletter envelop" data-src="https://motorolaimgrepo.vtexassets.com/arquivos/icon-news10off.png" loading="lazy" src="https://motorolaimgrepo.vtexassets.com/arquivos/icon-news10off.png">
                        </div>
                        <a class="d-flex align-items-center" href="https://motorola-global-en-uk.custhelp.com/" target="_blank">
                            <img class="support-icon" alt="Support icon" data-src="https://motorolaimgrepo.vtexassets.com/arquivos/menu-header-support-icon.png" loading="lazy" src="https://motorolaimgrepo.vtexassets.com/arquivos/menu-header-support-icon.png">
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column-reverse flex-md-column">
                    <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary_nav',
                                'container_class' => 'pt-2 px-0 p-md-0 collapse navbar-collapse navbars',
                                'container_id'    => 'primaryNav',
                                'menu_class'      => 'navbar-nav justify-content-start align-items-md-end mt-2 mt-md-0',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-menu',
                                'depth'           => 2,
                                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                            )
                        );
                    ?>
                </div>
                <div class="d-none d-md-flex ms-auto align-items-center header-icons gap-4 gap-lg-5">
                    <div role="button" class="d-flex" data-bs-toggle="modal" data-bs-target="#newsletterModal">
                        <img class="newsletter-icon" alt="Newsletter envelop" data-src="https://motorolaimgrepo.vtexassets.com/arquivos/icon-news10off.png" loading="lazy" src="https://motorolaimgrepo.vtexassets.com/arquivos/icon-news10off.png">
                        <div class="ps-2 lh-300 fs-100 newsletter-text">Subscribe to<br><span class="fs-400 text-coral fw-600">Get 5% Off</span></div>
                    </div>
                    <a class="d-flex align-items-center" href="https://motorola-global-en-uk.custhelp.com/" target="_blank">
                        <img class="support-icon" alt="Support icon" data-src="https://motorolaimgrepo.vtexassets.com/arquivos/menu-header-support-icon.png" loading="lazy" src="https://motorolaimgrepo.vtexassets.com/arquivos/menu-header-support-icon.png">
                        <div class="ps-2 lh-300 fs-100 support-text">Support</div></a>
                    </a>
                </div>
            </div>
		
        </nav>
    </div>