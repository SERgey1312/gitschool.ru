<?php
wp_head();
echo '<div style="width: 70%; margin: 0 auto">';
echo '<div style="text-align: center; font-size: 40px; font-weight: bold; margin: 20px 0">';
the_title();
echo '</div>';
echo '<div style="text-align: justify">';
the_content();
echo '</div>';
echo '</div>';
get_footer();
