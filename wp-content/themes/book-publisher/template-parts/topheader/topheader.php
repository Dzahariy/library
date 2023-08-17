<?php
/**
 * Displays top header
 *
 * @package Book Publisher
 */
?>

<div class="top-info">
	<div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-3 col-sm-6 align-self-center">
                <div class="social-link">
                    <?php if(get_theme_mod('digital_books_social_on_of_setting') != ''){ ?>
                    <?php if(get_theme_mod('digital_books_facebook_url') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_books_facebook_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('digital_books_facebook_icon') ); ?>"></i></a>
                    <?php }?>
                    <?php if(get_theme_mod('digital_books_twitter_url') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_books_twitter_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('digital_books_twitter_icon') ); ?>"></i></a>
                    <?php }?>
                    <?php if(get_theme_mod('digital_books_intagram_url') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_books_intagram_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('digital_books_intagram_icon') ); ?>"></i></a>
                    <?php }?>
                    <?php if(get_theme_mod('digital_books_linkedin_url') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_books_linkedin_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('digital_books_linkedin_icon') ); ?>"></i></a>
                    <?php }?>
                    <?php if(get_theme_mod('digital_books_pintrest_url') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_books_pintrest_url','')); ?>"><i class="<?php echo esc_html( get_theme_mod('digital_books_pintrest_icon') ); ?>"></i></a>
                    <?php }?>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-4 col-md-7 col-sm-4 align-self-center">
                <?php if(get_theme_mod('book_publisher_topbar_text') != ''){ ?>
                    <p class="mb-0 text-center"><?php echo esc_html(get_theme_mod('book_publisher_topbar_text','')); ?></p>
                <?php }?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 align-self-center">
                <div class="text-center">
                    <?php if(class_exists('woocommerce')){ ?>
                        <?php if ( is_user_logged_in() ) { ?>
                            <a class="account-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','book-publisher'); ?>"><?php esc_html_e('My Account','book-publisher'); ?></a>
                        <?php }
                        else { ?>
                            <a class="account-btn" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','book-publisher'); ?>"><?php esc_html_e('Login / Register','book-publisher'); ?></a>
                        <?php } ?>
                	<?php }?>
                </div>
            </div>
        </div>
	</div>
</div>
