<aside id="search">
    <form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
        <label class="assistive-text" for="s">Search for:</label>
        <input type="search" placeholder="Enter terms..." value="<?php get_search_query(); ?>" name="s" id="s">
        <input type="submit" id="searchsubmit" value="Search">
    </form>
</aside>