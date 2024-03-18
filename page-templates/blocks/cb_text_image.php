<?php
/*

get order
get colour

*/
?>
<section class="text_image">
    <div class="container-fluid">
        <div class="h3 d-md-none">
            <?=get_field('title')?>
        </div>
        <div class="row">
            <div class="col-md-6 text_image__image"
                style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/placeholder-800x450.png)">
            </div>
            <div class="col-md-6">
                <div class="px-4 ps-md-5 text--right">
                    <h3 class="d-none d-md-block">
                        <?=get_field('title')?>
                    </h3>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="text_image">
    <div class="container-fluid">
        <div class="h3 d-md-none">
            <?=get_field('title')?>
        </div>
        <div class="row">
            <div class="col-md-6 text_image__image order-md-2"
                style="background-image:url(<?=get_stylesheet_directory_uri()?>/img/placeholder-800x450.png)">
            </div>
            <div class="col-md-6 order-md-1">
                <div class="px-4 pe-md-5 text--left">
                    <h3 class="d-none d-md-block">
                        <?=get_field('title')?>
                    </h3>
                    <?=get_field('content')?>
                </div>
            </div>
        </div>
    </div>
</section>