<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		
		<footer id="colophon" class="site-footer" role="contentinfo">
				<div class="footer-colon">
				<?php dynamic_sidebar('footer-0'); ?>
				</div>

			<div class="copyright site-info">
				<?php dynamic_sidebar('copy-right'); ?>
				
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
<script src="<?php echo get_stylesheet_directory_uri() ?>/css/jquery.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap.min.js"></script>

</body>
</html>
<script type="text/javascript">
	jQuery(document).ready(function($){

		$('.responsive-menu-search-box').attr('placeholder','Cities')

		$('.carousel').carousel({
		  interval: 2000
		})

		$('.btBilal a').attr('href','javascript:void(0)');
		$('.btBilal a').attr('title','click to copy!');
		$('.btBilal a').addClass('ryanhssn');
		function copyToClipboard(element) {
		  var $temp = $("<input>");
		  $("body").append($temp);
		  $temp.val($(element).text()).select();
		  document.execCommand("copy");
		  $temp.remove();
		}

		$('.ryanhssn').on('click', function(){
			$(this).removeClass('copied')
			copyToClipboard(this);
			$(this).addClass('copied')
			$('.copied').attr('title','copied!');
			$( "span.cp" ).css( "display", "inline" ).fadeOut( 1000 );
		});

	});
</script>
