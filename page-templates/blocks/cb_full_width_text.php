<?php
$l = get_field('level');
$bg = get_field('colour') ?? null;
?>
<section class="full_width_text py-5 <?=$bg?>">
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <<?=$l?> class="mb-3"><?=get_field('title')?></<?=$l?>>
            <?php
        }
        ?>
        <?=get_field('content')?>
    </div>
</section>