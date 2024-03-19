<section class="faq py-5">
    <div class="container-xl">
        <?php
        if (get_field('faq_title') ?? null) {
            ?>
        <h3 class="mb-4"><?=get_field('faq_title')?></h3>
            <?php
        }
        ?>
        <div itemscope="" itemtype="https://schema.org/FAQPage">
        <?php
        while(have_rows('faq')) {
            the_row();
            ?>
            <div class="faq__row" itemscope="" itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="faq__question" itemprop="name">
                    <?=get_sub_field('question')?>
                </div>
                <div itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div itemprop="text" class="faq__answer">
                        <?=get_sub_field('answer')?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</section>