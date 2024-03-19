<?php
$img = wp_get_attachment_image_url(get_field('image'),'full');
?>
<img class="full_bleed_image" src="<?=$img?>">