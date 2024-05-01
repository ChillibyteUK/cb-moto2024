<?php
$bg = get_field('colour') ?? null;
?>
<section class="full_width_text py-5 <?=$bg?>">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <h2 class="mb-3"><?=get_field('title')?></h2>
            <?php
        }
        ?>
        <?=get_field('content')?>
    </div>
</section>