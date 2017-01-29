<?php

class wp_breadcrumb {

	public static function the_breadcrumb() {

		if (!is_home() && !is_front_page()) {

			echo "<ol class='breadcrumb'>";

			printf(
				'<li><a href="%1$s"><i class="fa fa-home"></i></a></li>',
				get_option('home')
			);

			if (is_category() || is_single()) {			
				echo '<li>';
				the_category(' </li><li> ');
				echo '</li>';

				if (is_single()) {
					the_title( '<li>', '</li>');
				}
			} elseif (is_page()) {

				the_title( '<li>', ' </li> ');
			}
			echo "</ol>";
		}
	}
}

?>