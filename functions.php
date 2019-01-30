<?php

/**
 * Gets markup to render an SVG icon
 *
 * @param		string		$filename		The filename of the SVG file to render. Must include the .svg suffix.
 * @param		string		$classes		Space-separated list of CSS class names to add to the SVG's enclosing <span> tag.
 * @param		string		$rel_path		The file path of the SVG file relative to the theme. Must include leading and trailing slashes.
 * @param		string		$abs_path		An absolute file path to the SVG file to render. This must be an absolute file path and not a URL. It must also include a trailing slash.
 * @return		sting		$markup			Inline HTML markup for the SVG file.
 * @author		gantsta
 * @since		1.0.0
 */
function PS_get_inline_svg($filename, $classes='', $rel_path='/img/svg/', $abs_path=''){
	$file_path = ( $abs_path != '' ? $abs_path : get_stylesheet_directory() . $rel_path );
	$file_path .= $filename;
	$markup = '';

	if ( file_exists($file_path) ):
		$css = ( $classes != '' ? 'inline-svg ' . $classes : 'inline-svg' );
		ob_start();
		?>
			<span class="<?php echo $css; ?>">
				<?php
				// readfile function is used here rather than require, include or get_template_part to prevent PHP code from being run
				readfile($file_path);
				?>
			</span>
		<?php
		$markup = ob_get_clean();
	endif;
	return $markup;
}

?>
