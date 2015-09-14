<?php
/**
 * Front Page
 */
?>

<?php
// get all PAGES that have Home as parent
$post = get_page_by_title( 'Home' );
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_parent'    => $post->ID,
    'order'          => 'ASC',
    'orderby'        => 'menu_order'
 );
$parent = new WP_Query( $args );
if ( $parent->have_posts() ) : ?>
	<header class="expansive"><h1 class="front-page-heading">Explore</h1></header><div>
    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
	    <article id="post-<?php the_ID(); ?>">
		<!-- .entry-header -->
		<header class="entry-header expansive">
			<h4 class="entry-title"><?php the_title(); ?></h4>
		</header>
			<?php
			global $more;
			$more = 0;
			?>
	        <div class="front-page entry-summary">
	        <?php the_content('<p style="text-align:right">More...</p>', true); ?></p>
	        </div>
	    </article>
    <?php endwhile; ?>
    </div>
<?php endif; wp_reset_query(); ?>
<header class="expansive open"><h1 class="front-page-heading">Recent</h1></header>
<?php // load in previews of all posts, expanding the 1st
while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<header class="expansive<?php if( $wp_query->current_post == 0){echo ' open';}?>">
			<h4 class="entry-title"><?php the_title(); ?></a></h4> 
		</header>
		<div class="entry-summary" id="<?php echo $post->post_name; ?>">
			<?php 
			if ( has_excerpt() ) :
				the_excerpt();
			elseif ( @strpos( $post->post_content, '<!--more-->') ) :
				the_content('<p style="text-align:right">More...</p>', true);
			elseif ( str_word_count( $post->post_content ) < 55 ) :
				the_content();
				echo '<p style="text-align:right"><a href="';
				the_permalink();
				echo '">More...</a></p>';
			else:
				the_excerpt();
			endif;
			?>
		</div>
	</article>
<?php endwhile; ?>
