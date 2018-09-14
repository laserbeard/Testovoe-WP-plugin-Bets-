<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package testovoebets
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			echo the_title('<h1>','</h1>');

			the_content();


			$status_term = (get_the_terms($post, 'bets_status'));
			$status = array();;

			if(is_array($status_term)){
				foreach ($status_term as $term) {
					$status []= $term->name;
				}
			}

			echo "Статус: ". implode(', ', $status);

			echo '<br>';

			



			$type_term = (get_the_terms($post, 'bets_type'));
			$type = array();

			if(is_array($type_term)){
				foreach ($type_term as $term) {
					$type []= $term->name;
				}
			}

			 echo "Тип: ". implode(', ', $type);


			 echo '<br><br><br>';





		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
