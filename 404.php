<?php header("HTTP/1.1 404 Not Found"); ?>
<?php header("Status: 404 Not Found"); ?>
<?php get_header(); ?>

	<section id="main">
		<section id="main_content">
			<article>
				<h2>Oops.. File or page not found.</h2>
				<p>We've recently made changes to our website and the page you are looking for might have been deleted or moved. Please <a href="<?php echo home_url(); ?>">visit our home page or <a href="javascript:history.back()">return to your previous page</a> instead</a>.</p>
				<p>Sorry for the inconvenience.</p>
				<?php //TODO Remove if search has been removed from site ?>
				<script>
					// focus on search field after it has loaded
					document.getElementById('s') && document.getElementById('s').focus();
				</script>
				
			</article>
		</section>

<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>