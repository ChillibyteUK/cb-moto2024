<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option( 'page_on_front' );
$bg = get_the_post_thumbnail_url($page_for_posts,'full');

get_header();
?>
<main id="main">
<!-- hero -->
<section class="hero" style="background-image:url(<?=$bg?>">
    <div class="overlay--dark"></div>
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-8 py-5">
                <h1>Case Studies</h1>
            </div>
        </div>
    </div>
</section>

    <div class="container-xl py-5">
        <?php
        $cats = get_terms(array('taxonomy' => 'cssector', 'hide_empty' => true));
        ?>
        <div class="filters mb-4">
            <?php
        echo '<button class="btn btn-outline-primary active me-2 mb-2" data-filter="*">All</button>';
        foreach ($cats as $cat) {
            echo '<button class="btn btn-outline-primary me-2 mb-2" data-filter=".' . cbslugify($cat->name) . '">' . $cat->name . '</button>';
        }
        ?>
        </div>
        <div class="cs_index">
            <?php
                query_posts( array( 'post_type' => 'case-studies', 'posts_per_page' => -1 ) );

            while (have_posts()) {
                the_post();
                $img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                if (!$img) {
                    $img = get_stylesheet_directory_uri() . '/img/default-blog.jpg';
                }
                $cats = get_the_terms(get_the_ID(),'cssector');
                $category = wp_list_pluck($cats, 'name');
                $flashcat = $category[0] ?? null ? acf_slugify($category[0]) : '';
                $catclass = implode(' ', array_map( 'cbslugify', $category ) );
                $category = implode(', ',$category);

                $the_date = get_the_date('jS F, Y');

                $gallery = get_field('gallery', get_the_ID());
                $img = wp_get_attachment_image_url($gallery[0] , 'large' );
        
                ?>

            <a href="<?=get_the_permalink(get_the_ID())?>" class="cs_index__card <?=$catclass?>">
                <div class="cs_index__image_container">
                    <div class="cs_index__flash index_card__flash--<?=$flashcat?>"><?=$category?></div>
                    <img class="cs_index__image" src="<?=$img?>">
                </div>
                <div class="cs_index__content">
                    <div class="cs_index__title"><?=get_the_title()?></div>
                </div>
            </a>
                <?php
            }
            ?>
        </div>
    </div>
</main>
<?php
add_action('wp_footer',function(){
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
(function($){
        
    var $grid=$('.cs_index').isotope({
        itemSelector:'.cs_index__card',
        percentPosition: true,
        layoutMode: 'fitRows',
    });
    
    $('.filters').on('click','button',function(){
        var filterValue=$(this).attr('data-filter');
        $('.filters').find('.active').removeClass('active');
        $(this).addClass('active');
        $grid.isotope({filter:filterValue});
    });



})(jQuery);
</script>
    <?php
},9999);

get_footer();