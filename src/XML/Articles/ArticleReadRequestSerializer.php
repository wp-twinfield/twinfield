<?php
/**
 * Article read request XML
 *
 * @link       http://pear.php.net/package/XML_Serializer/docs
 * @since      1.0.0
 *
 * @package    Pronamic/WP/Twinfield
 */

namespace Pronamic\WP\Twinfield\XML\Articles;

use Pronamic\WP\Twinfield\XML\ReadRequestSerializer;
use Pronamic\WP\Twinfield\Articles\ArticleReadRequest;

/**
 * Article read request XML
 *
 * @since      1.0.0
 * @package    Pronamic/WP/Twinfield
 * @author     Remco Tolsma <info@remcotolsma.nl>
 */
class ArticleReadRequestSerializer extends ReadRequestSerializer {
	/**
	 * Constructs and initialize an article read request XML object.
	 *
	 * @param ArticleReadRequest $request the article read request to serialize.
	 */
	public function __construct( ArticleReadRequest $request ) {
		parent::__construct();

		$root = $this->document->createElement( 'read' );

		$this->document->appendChild( $root );

		$elements = array(
			'type'   => $request->get_type(),
			'office' => $request->get_office(),
			'code'   => $request->get_code(),
		);

		foreach ( $elements as $name => $value ) {
			$element = $this->document->createElement( $name );
			$element->appendChild( new \DOMText( $value ) );

			$root->appendChild( $element );
		}
	}
}
