<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package seniorsoutdoors
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<p class="copyright">&copy; <?php echo date(Y); ?> Seniors Outdoors! <span class="wordp">| Powered by <a href="https://wordpress.org/" target="_blank">Wordpress</a></span></p>
		<p><span class="lizb">Site designed and developed by <a target="_blank" href="http://burtonux.com/">Liz Burton</a></span></p>

	</footer><!-- #colophon -->
</div><!-- #page -->


<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>
<?php wp_footer(); ?>


</body>
</html>
