<?php
/*
Template Name: Full Width Home
*/
?>

<?php get_header(); ?>

    <div id="content">

        <div id="inner-content">

            <main id="main" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <?php get_template_part( 'parts/loop', 'page' ); ?>

                <?php endwhile; endif; ?>

            </main> <!-- end #main -->

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>