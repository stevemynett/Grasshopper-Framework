<section id="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar1') ) : ?>
	<?php endif; ?>
	<aside id="categories" class="widget"><h4>Categories</h4>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</aside>
	<aside id="archives" class="widget"><h4>Archives</h4>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</aside>
	<aside id="subscribe" class="widget"><h4>Subscribe</h4>
		<ul>
			<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
		</ul>
	</aside>
	</section>
</section>