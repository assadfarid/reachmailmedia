<?php

/**
 * FusionRedux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * FusionRedux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with FusionRedux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     FusionReduxFramework
 * @subpackage  Field_Images
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'FusionReduxFramework_image_select' ) ) {

	/**
	 * Main FusionReduxFramework_image_select class
	 *
	 * @since       1.0.0
	 */
	class FusionReduxFramework_image_select {

		public $parent;
		public $field;
		public $value;

		/**
		 * Field Constructor.
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		function __construct( $field = array(), $value = '', $parent = null ) {
			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;
		}

		/**
		 * Field Render Function.
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {

			if ( ! empty( $this->field['options'] ) ) {
				echo '<div class="fusionredux-table-container">';
				echo '<ul class="fusionredux-image-select">';

				$x = 1;

				foreach ( $this->field['options'] as $k => $v ) {

					if ( ! is_array( $v ) ) {
						$v = array( 'img' => $v );
					}

					if ( ! isset( $v['title'] ) ) {
						$v['title'] = '';
					}

					if ( ! isset( $v['alt'] ) ) {
						$v['alt'] = $v['title'];
					}

					if ( ! isset( $v['class'] ) ) {
						$v['class'] = '';
					}

					$style = '';

					if ( ! empty( $this->field['width'] ) ) {
						$style .= 'width: ' . $this->field['width'];

						if ( is_numeric( $this->field['width'] ) ) {
							$style .= 'px';
						}

						$style .= ';';
					} else {
						$style .= " width: 100%; ";
					}

					if ( ! empty( $this->field['height'] ) ) {
						$style .= 'height: ' . $this->field['height'];

						if ( is_numeric( $this->field['height'] ) ) {
							$style .= 'px';
						}

						$style .= ';';
					}

					$theValue = $k;
					if ( ! empty( $this->field['tiles'] ) && $this->field['tiles'] == true ) {
						$theValue = $v['img'];
					}

					$selected = ( checked( $this->value, $theValue, false ) != '' ) ? ' fusionredux-image-select-selected' : '';

					$this->field['class'] .= ' noUpdate ';

					$merge   = '';
					if ( isset( $v['merge'] ) && $v['merge'] !== false ) {
						$merge = is_array( $v['merge'] ) ? implode( '|', $v['merge'] ) : 'true';
						$merge = ' data-merge="' . htmlspecialchars( $merge, ENT_QUOTES, 'UTF-8' ) . '"';
					}

					echo '<li class="fusionredux-image-select">';
					echo '<label class="' . $selected . ' fusionredux-image-select' . $this->field['id'] . '_' . $x . '" for="' . $this->field['id'] . '_' . ( array_search( $k, array_keys( $this->field['options'] ) ) + 1 ) . '">';

					echo '<input type="radio" class="' . $this->field['class'] . '" id="' . $this->field['id'] . '_' . ( array_search( $k, array_keys( $this->field['options'] ) ) + 1 ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" value="' . $theValue . '" ' . checked( $this->value, $theValue, false ) . $merge . '/>';
					if ( ! empty( $this->field['tiles'] ) && $this->field['tiles'] == true ) {
						echo '<span class="tiles ' . $v['class'] . '" style="background-image: url(' . $v['img'] . ');" rel="' . $v['img'] . '"">&nbsp;</span>';
					} else {
						echo '<img src="' . $v['img'] . '" alt="' . $v['alt'] . '" class="' . $v['class'] . '" style="' . $style . '"' . $merge . ' />';
					}

					if ( $v['title'] != '' ) {
						echo '<br /><span>' . $v['title'] . '</span>';
					}

					echo '</label>';
					echo '</li>';

					$x ++;
				}

				echo '</ul>';
				echo '</div>';
			}
		}

		/**
		 * Enqueue Function.
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {

			wp_enqueue_script(
				'fusionredux-field-image-select-js',
				FusionReduxFramework::$_url . 'inc/fields/image_select/field_image_select' . FusionRedux_Functions::isMin() . '.js',
				array( 'jquery', 'fusionredux-js' ),
				time(),
				true
			);

			if ($this->parent->args['dev_mode']) {
				wp_enqueue_style(
					'fusionredux-field-image-select-css',
					FusionReduxFramework::$_url . 'inc/fields/image_select/field_image_select.css',
					array(),
					time(),
					'all'
				);
			}
		}

		public function getCSS( $mode = '' ) {
			$css   = '';
			$value = $this->value;

			$output = '';
			if ( ! empty( $value ) && ! is_array($value) ) {
				switch ( $mode ) {
					case 'background-image':
						$output = "background-image: url('" . $value . "');";
						break;

					default:
						$output = $mode . ": " . $value . ";";
				}
			}

			$css .= $output;

			return $css;
		}

		public function output() {
			$mode = ( isset( $this->field['mode'] ) && ! empty( $this->field['mode'] ) ? $this->field['mode'] : 'background-image' );

			if ( ( ! isset( $this->field['output'] ) || ! is_array( $this->field['output'] ) ) && ( ! isset( $this->field['compiler'] ) ) ) {
				return;
			}

			$style = $this->getCSS( $mode );

			if ( ! empty( $style ) ) {

				if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
					$keys  = implode( ",", $this->field['output'] );
					$style = $keys . "{" . $style . '}';
					$this->parent->outputCSS .= $style;
				}

				if ( ! empty( $this->field['compiler'] ) && is_array( $this->field['compiler'] ) ) {
					$keys  = implode( ",", $this->field['compiler'] );
					$style = $keys . "{" . $style . '}';
					$this->parent->compilerCSS .= $style;
				}
			}
		}
	}
}
