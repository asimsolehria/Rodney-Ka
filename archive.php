<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php
    // Get the current category object
    $category = get_queried_object();

    // Set up the query arguments
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'tax_query'      => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'internal-tag',
                'field'    => 'slug',
                'terms'    => 'featured-post',
            ),
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category->term_id,
            ),
        ),
    );

    // Run the query for featured posts
    $featured_posts = new WP_Query($args);
    ?>
    <div id="content" class="site-content">
        <div class="ast-container">


            <div id="primary" class="content-area primary ast-grid-3">


                <section class="ast-archive-description">
                    <h1 class="page-title ast-archive-title"><?php echo ($category->name); ?></h1>
                </section>
                <main id="main" class="site-main">
                    <?php if ($featured_posts->have_posts()) : ?>
                        <div class="ast-row">
                            <?php while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                                <article <?php post_class(); ?> id="post-36759" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                                    <div class="ast-post-format- blog-layout-1 ast-no-date-box">
                                        <div class="post-content ast-grid-common-col">
                                            <div class="ast-blog-featured-section post-thumb ast-grid-common-col ast-float">
                                                <div class="post-thumb-img-content post-thumb">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('large', array('class' => 'featured-image')) ?> </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <header class="entry-header">
                                                <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title() ?></a></h2>
                                            </header><!-- .entry-header -->
                                        </div><!-- .post-content -->
                                    </div> <!-- .blog-layout-1 -->
                                </article>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>

                        <?php endif; ?>
                        <?php if (!$featured_posts->have_posts()) {
                            echo ('<div class="ast-row">');
                        } ?>
                        <?php while (have_posts()) : the_post(); ?>

                            <?php if ($featured_posts->have_posts() && has_term('featured-post', 'internal-tag', get_the_ID())) continue; ?>

                            <article <?php post_class(); ?> id="post-36759" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
                                <div class="ast-post-format- blog-layout-1 ast-no-date-box">
                                    <div class="post-content ast-grid-common-col">
                                        <div class="ast-blog-featured-section post-thumb ast-grid-common-col ast-float">
                                            <div class="post-thumb-img-content post-thumb">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('large', array('class' => 'featured-image')) ?> </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <header class="entry-header">
                                            <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title() ?></a></h2>
                                        </header><!-- .entry-header -->
                                    </div><!-- .post-content -->
                                </div> <!-- .blog-layout-1 -->
                            </article>

                        <?php endwhile; ?>
                        </div>
                </main>
            </div><!-- #primary -->


        </div> <!-- ast-container -->
    </div>


    <?php the_posts_navigation(); ?>

<?php else : ?>

    <?php get_template_part('template-parts/content', 'none'); ?>

<?php endif; ?>


<?php get_footer(); ?>