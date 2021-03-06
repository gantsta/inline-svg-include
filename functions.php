<?php

/**
 * Gets markup to render an SVG file
 *
 * @param		string		$filename		The filename of the SVG file to render. Must include the .svg suffix.
 * @param		string		$classes		Space-separated list of CSS class names to add to the SVG's enclosing <span> tag.
 * @param		string		$rel_path		The file path of the SVG file relative to the theme. Must include leading and trailing slashes.
 * @param		string		$abs_path		An absolute file path to the SVG file to render. This must be an absolute file path and not a URL. It must also include a trailing slash.
 * @return		string		$markup			Inline HTML markup for the SVG file.
 * @author		gantsta
 */
function AJG_get_inline_svg($filename, $classes='', $rel_path='/img/svg/', $abs_path=''){
	$file_path = ( $abs_path != '' ? $abs_path : get_stylesheet_directory() . $rel_path );
	$file_path .= $filename;
	$markup = '';

	if ( file_exists($file_path) ):
		$xml = file_get_contents($file_path);
		// try and remove xml elements gracefully
		if(strpos($xml, '<!DOCTYPE') !== false) {
			try{
				$doc = new DOMDocument();
				$doc->loadXML($xml, LIBXML_NOENT);
				// remove doctype
				$doc->removeChild($doc->doctype);
				// on save, exclude xml declaration
				$xml = $doc->saveXML($doc->documentElement, LIBXML_NOXMLDECL); // LIBXML_NOXMLDECL requires libxml 2.6.21
			}
			catch ( DOMException $e ){
				echo '<!-- '.$e.' -->';
			}
		}
		$dom_id = ( $id != '' ? ' id="' . $id . '"' : '' );
		$css = ( $classes != '' ? 'inline-svg ' . $classes : 'inline-svg' );
		ob_start();
		?>
			<span<?php echo $dom_id; ?> class="<?php echo $css; ?>">
				<?php
				// readfile function is used here rather than require, include or get_template_part to prevent PHP code from being run
				readfile($file_path);
				?>
			</span>
		<?php
		$markup = ob_get_clean();
	else:
		error_log( 'The requested SVG file: ' . $file_path . ' could not be found.' );
	endif;
	return $markup;
}

?>
