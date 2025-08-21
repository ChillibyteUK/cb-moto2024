<?php
/**
 * Footer template for the theme
 *
 * @package cb-moto2024
 */

defined( 'ABSPATH' ) || exit;

if ( is_single() ) {
    include get_stylesheet_directory() . '/page-templates/blocks/cb_related_posts.php';
}
?>
</div> <!-- end page -->
<div id="footer-top"></div>
<footer>
    <div class="footer container-xl pt-5 pb-3">
        <div class="row g-4 align-items-center pre-menu">
            <div class="col-lg-4 text-center">
                Official website
                <img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/c-rd-motorola@2x.png' ); ?>"
                    class="footer__logo" alt="Motorola" width="150px" height="30px">
            </div>
            <div class="col-lg-4 text-center">
                <div class="fs-200 mb-1">Follow us on social media:</div>
                <div class="socials w-50 mx-auto">
                    <a href="https://www.instagram.com/motorolauk/" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/motorolauk/" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/motorolauk" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.youtube.com/user/motorola" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="location d-flex justify-content-around flex-column flex-lg-row align-items-center">
                    <img alt="Current Country flag" class="flag" loading="lazy" crossorigin="anonymous" src="https://motorolauk.vtexassets.com/assets/vtex.file-manager-graphql/images/718cc89a-913a-42a1-a894-411fb33ab0fa___9820656e535ae0bb19235fef485de60a.png">
                    <a href="https://www.motorola.com/country-selector">Change location</a>
                </div>
            </div>
        </div>
        <div class="footer__menurow">
            <div>
                <a href="https://www.motorola.co.uk/smartphones">Smartphones</a>
                <!-- <?= wp_nav_menu( array( 'theme_location' => 'footer_menu1' ) ); ?> -->
            </div>
            <div>
                <a href="https://www.motorola.co.uk/accessories">Accessories</a>
                <!-- <?= wp_nav_menu( array( 'theme_location' => 'footer_menu2' ) ); ?> -->
            </div>
            <div>
                <a href="https://motorola-global-en-uk.custhelp.com/">Support</a>
                <!-- <?= wp_nav_menu( array( 'theme_location' => 'footer_menu3' ) ); ?> -->
            </div>
            <div>
                <a href="https://www.motorola.co.uk/about">About us</a>
                <!-- <?= wp_nav_menu( array( 'theme_location' => 'footer_menu4' ) ); ?> -->
            </div>
            <div class="text-center">
                Safe website
                <img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/secure-site.png' ); ?>" class="secure-site" width="29px" height="30px">
            </div>
        </div>
    </div>
    <div class="colophon">
        <div class="container text-center py-2 fs-200">
            <div class="my-1">&copy; <?= esc_html( gmdate( 'Y' ) ); ?> Motorola Mobility LLC. All Rights Reserved.</div>
            <div class="my-1">MOTOROLA and the Stylized M Logo are registered trademarks of Motorola Trademark Holdings, LLC</div>
            <div class="my-1">All mobile phones are designed and manufactured by Motorola Mobility LLC, a wholly owned subsidiary of Lenovo.</div>
            <div class="my-1">Android, Google, Google Play, Nexus and other marks are trademarks of Google Inc. The Android robot is reproduced or modified from work created and shared by Google and used according to terms described in the Creative Commons 3.0 Attribution License.</div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>