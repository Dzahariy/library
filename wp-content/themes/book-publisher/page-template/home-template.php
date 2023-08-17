<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider" slider-loop="<?php echo esc_html(get_theme_mod('digital_books_slider_loop')); ?>">
    <?php if(get_theme_mod('digital_books_top_slider_section_setting') != ''){ ?>
    <?php $digital_books_slide_pages = array();
      for ( $book_publisher_count = 1; $book_publisher_count <= 3; $book_publisher_count++ ) {
        $book_publisher_mod = intval( get_theme_mod( 'digital_books_top_slider_page' . $book_publisher_count ));
        if ( 'page-none-selected' != $book_publisher_mod ) {
          $digital_books_slide_pages[] = $book_publisher_mod;
        }
      }
      if( !empty($digital_books_slide_pages) ) :
        $book_publisher_args = array(
          'post_type' => 'page',
          'post__in' => $digital_books_slide_pages,
          'orderby' => 'post__in'
        );
        $book_publisher_query = new WP_Query( $book_publisher_args );
        if ( $book_publisher_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $book_publisher_query->have_posts() ) : $book_publisher_query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h2><?php the_title(); ?></h2>
            <p><?php $digital_books_excerpt = the_excerpt(); echo esc_html( digital_books_string_limit_words( $digital_books_excerpt,20 ) ); ?></p>
            <div class="slide-btn mt-4"><a href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','book-publisher'); ?></a></div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
    <?php }?>
  </section>


<?php if(get_theme_mod('digital_books_product_section_setting') != ''){ ?>
  <section id="homepage-product">
    <div class="container">
      <div class="row product-home-box">
        <?php
        if ( class_exists( 'WooCommerce' ) ) {
          $book_publisher_args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'product_cat' => get_theme_mod('digital_books_home_product'),
            'order' => 'ASC'
          );
          $loop = new WP_Query( $book_publisher_args );
          while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <div class="col-lg-6 col-md-6">
              <div class="product-image">
                <span class="product-sale-tag">
                  <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
                </span>
                <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <h3><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h3>
              <h4><?php echo esc_url(wc_get_product_category_list($product->get_id())); ?></h4>
              <p><?php $digital_books_excerpt = the_excerpt(); echo ( digital_books_string_limit_words( $digital_books_excerpt, 60 ) ); ?></p>
              <p><?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?><h6 class="review-box"><?php esc_html_e('Reviews','book-publisher'); ?></h6></p>
                <div class="counter_info">
                  <div class="row">
                    <?php for ( $i = 1; $i <= 4; $i++ ) { ?>
                      <div class="col-lg-3 col-md-6 col-6">
                        <?php if(get_theme_mod('digital_books_home_product_number'.$i) != '' || get_theme_mod('digital_books_home_product_text'.$i)){ ?>
                          <div class="<?php echo('counter_box').$i ?>">
                            <h4><?php echo esc_html(get_theme_mod('digital_books_home_product_number'. $i)); ?></h4>
                            <h5><?php echo esc_html(get_theme_mod('digital_books_home_product_text'. $i)); ?></h5>
                          </div>
                        <?php }?>
                      </div>
                    <?php }?>
                  </div>
                </div>
              <div class="pro-button">
                <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_add_to_cart( $loop->post, $product ); } ?>
              </div>
            </div>
          <?php endwhile; wp_reset_query(); ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php }?>

<?php if(get_theme_mod('book_publisher_latest_product_section_setting') != ''){ ?>
  <section id="latest-product" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('book_publisher_latest_product_title','') != ''){ ?>
        <h3 class="text-center mb-4"><?php echo esc_html(get_theme_mod('book_publisher_latest_product_title','')); ?></h3>
      <?php }?>
      <div class="row">
        <?php
        if ( class_exists( 'WooCommerce' ) ) {
          $book_publisher_args = array(
            'post_type' => 'product',
            'posts_per_page' => 100,
            'product_cat' => get_theme_mod('book_publisher_latest_product'),
            'order' => 'ASC'
          );
          $loop = new WP_Query( $book_publisher_args );
          while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <div class="col-lg-3 col-md-4 col-sm-4">
              <div class="product-box mb-4">
                <div class="product-image">
                  <span class="product-sale-tag">
                    <?php woocommerce_show_product_sale_flash( $post, $product ); ?>
                  </span>
                  <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
                </div>
                <h3><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h3>
                <h5 class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></h5>
              </div>
            </div>
          <?php endwhile; wp_reset_query(); ?>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php }?>

  <section id="content-section" class="container">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>
