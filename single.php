<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<main id="main" class="blog">
    <?php
    the_post();    
    the_content(); 
    ?>
</main>
<?php
get_footer();