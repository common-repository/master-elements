<?php 

while ( $all_posts->have_posts() ) :

    $all_posts->the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('elementpress-post'); ?>>

            <div class="elementpress-post-grid-inner">

            	<?php $this->render_thumbnail(); ?>

                <div class="elementpress-post-grid-text">

               		<?php $this->render_title(); ?>

	                <?php $this->render_excerpt(); ?>

	                <?php $this->render_readmore(); ?>

                </div>

                <?php $this->render_meta(); ?>

            </div><!-- .blog-inner -->

        </article>

        <?php

endwhile; 

wp_reset_postdata();