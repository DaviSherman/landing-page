<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_custom_field' ) ) {

    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_custom_field extends ReduxFramework {
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
        
            
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }    

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );            
        
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {
        
            // HTML output goes here
			echo 'Gabriel';
			
			//print_r($this->value);

            echo '<div class="redux-custom_field-accordion">';

            $x = 0;

            $multi = (isset($this->field['multi']) && $this->field['multi']) ? ' multiple="multiple"' : "";

            if (isset($this->value) && is_array($this->value)) {

                $slides = $this->value;

                foreach ($slides as $slide) {
                    
                    if ( empty( $slide ) ) {
                        continue;
                    }

                    $defaults = array(
                        'title' => '',
                        'description' => '',
                        'sort' => '',
                        'url' => '',
                        'image' => '',
                        'thumb' => '',
                        'attachment_id' => '',
                        'height' => '',
                        'width' => '',
                        'select' => array(),
                    );
                    $slide = wp_parse_args( $slide, $defaults );

                    if ( empty( $slide['thumb'] ) && !empty( $slide['attachment_id'] ) ) {
                        $img = wp_get_attachment_image_src($slide['attachment_id'], 'full');
                        $slide['image'] = $img[0];
                        $slide['width'] = $img[1];
                        $slide['height'] = $img[2];
                    }

                    echo '<div class="redux-custom_field-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-custom_field-header">' . $slide['title'] . '</span></h3><div>';

                    $hide = '';
                    if ( empty( $slide['image'] ) ) {
                        $hide = ' hide';
                    }


                    echo '<div class="screenshot' . $hide . '">';
                    echo '<a class="of-uploaded-image" href="' . $slide['image'] . '">';
                    echo '<img class="redux-custom_field-image" id="image_image_id_' . $x . '" src="' . $slide['thumb'] . '" alt="" target="_blank" rel="external" />';
                    echo '</a>';
                    echo '</div>';

                    echo '<div class="redux_custom_field_add_remove">';

                    echo '<span class="button media_upload_button" id="add_' . $x . '">' . __('Upload', 'redux-framework') . '</span>';

                    $hide = '';
                    if ( empty( $slide['image'] ) || $slide['image'] == '' ) {
                        $hide = ' hide';
                    }

                    echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $slide['attachment_id'] . '">' . __('Remove', 'redux-framework') . '</span>';

                    echo '</div>' . "\n";

                    echo '<ul id="' . $this->field['id'] . '-ul" class="redux-custom_field-list">';
					
					//title
                    $placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : __( 'Title', 'redux-framework' );
                    echo '<li><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="' . esc_attr($slide['title']) . '" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
					
					//description					
                    //$placeholder = (isset($this->field['placeholder']['description'])) ? esc_attr($this->field['placeholder']['description']) : __( 'Description', 'redux-framework' );
                    //echo '<li><textarea name="' . $this->field['name'] . '[' . $x . '][description]" id="' . $this->field['id'] . '-description_' . $x . '" placeholder="'.$placeholder.'" class="large-text" rows="6">' . esc_attr($slide['description']) . '</textarea></li>';					
					echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][description]" id="' . $this->field['id'] . '-description_' . $x . '" value="' . $slide['description'] . '" />';
					
					
					//url
                    //$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : __( 'URL', 'redux-framework' );
                    //echo '<li><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="' . esc_attr($slide['url']) . '" class="full-text" placeholder="'.$placeholder.'" /></li>';					
					echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][url]" id="' . $this->field['id'] . '-url_' . $x . '" value="' . $slide['url'] . '" />';
					
					//sort
					//$placeholder = (isset($this->field['placeholder']['sort'])) ? esc_attr($this->field['placeholder']['sort']) : __( 'Sort', 'redux-framework' );
                    //echo '<li><input type="text" id="' . $this->field['id'] . '-sort_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][sort]" value="' . esc_attr($slide['sort']) . '" class="full-text" placeholder="'.$placeholder.'" /></li>';					
					echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $slide['sort'] . '" />';
					
										
					//attachment_id
                    echo '<li><input type="hidden" class="upload-id" name="' . $this->field['name'] . '[' . $x . '][attachment_id]" id="' . $this->field['id'] . '-image_id_' . $x . '" value="' . $slide['attachment_id'] . '" />';
					
					//thumb
                    echo '<input type="hidden" class="upload-thumbnail" name="' . $this->field['name'] . '[' . $x . '][thumb]" id="' . $this->field['id'] . '-thumb_url_' . $x . '" value="' . $slide['thumb'] . '" readonly="readonly" />';
					
					//image
                    echo '<input type="hidden" class="upload" name="' . $this->field['name'] . '[' . $x . '][image]" id="' . $this->field['id'] . '-image_url_' . $x . '" value="' . $slide['image'] . '" readonly="readonly" />';
					
					//height
                    echo '<input type="hidden" class="upload-height" name="' . $this->field['name'] . '[' . $x . '][height]" id="' . $this->field['id'] . '-image_height_' . $x . '" value="' . $slide['height'] . '" />';
					
					//width
                    echo '<input type="hidden" class="upload-width" name="' . $this->field['name'] . '[' . $x . '][width]" id="' . $this->field['id'] . '-image_width_' . $x . '" value="' . $slide['width'] . '" /></li>';
/*
                    if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
                        $placeholder = (isset($this->field['placeholder']['options'])) ? esc_attr($this->field['placeholder']['options']) : __( 'Select an Option', 'redux-framework' );

                        if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                            $select2_params = json_encode( esc_attr( $this->field['select2'] ) );
                            $select2_params = htmlspecialchars( $select2_params , ENT_QUOTES);
                            echo '<input type="hidden" class="select2_params" value="'. $select2_params .'">';
                        }

                        echo '<select '.$multi.' id="'.$this->field['id'].'-select" data-placeholder="'.$placeholder.'" name="' . $this->field['name'] . '[' . $x . '][select]" class="redux-select-item '.$this->field['class'].'" rows="6">';
                            echo '<option></option>';
                            foreach($this->field['options'] as $k => $v){
                                if (is_array($this->value)) {
                                    $selected = (is_array($this->value) && in_array($k, $this->value))?' selected="selected"':'';                   
                                } else {
                                    $selected = selected($this->value, $k, false);
                                }
                                echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
                            }//foreach
                        echo '</select>';                           
                    }
*/                    
                    echo '<li><a href="javascript:void(0);" class="button deletion redux-custom_field-remove">' . __('Delete Slide', 'redux-framework') . '</a></li>';
                    echo '</ul></div></fieldset></div>';
                    $x++;
                
                }
            }

            if ($x == 0) {
                echo '<div class="redux-custom_field-accordion-group"><fieldset class="redux-field" data-id="'.$this->field['id'].'"><h3><span class="redux-custom_field-header">New Slide</span></h3><div>';

                $hide = ' hide';

                echo '<div class="screenshot' . $hide . '">';
                echo '<a class="of-uploaded-image" href="">';
                echo '<img class="redux-custom_field-image" id="image_image_id_' . $x . '" src="" alt="" target="_blank" rel="external" />';
                echo '</a>';
                echo '</div>';

                //Upload controls DIV
                echo '<div class="upload_button_div">';

                //If the user has WP3.5+ show upload/remove button
                echo '<span class="button media_upload_button" id="add_' . $x . '">' . __('Upload', 'redux-framework') . '</span>';

                echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][attachment_id]">' . __('Remove', 'redux-framework') . '</span>';

                echo '</div>' . "\n";
				
				

				
				
				
                echo '<ul id="' . $this->field['id'] . '-ul" class="redux-custom_field-list">';				
                
				//title
				$placeholder = (isset($this->field['placeholder']['title'])) ? esc_attr($this->field['placeholder']['title']) : __( 'Title', 'redux-framework' );				
                echo '<li><input type="text" id="' . $this->field['id'] . '-title_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][title]" value="" placeholder="'.$placeholder.'" class="full-text slide-title" /></li>';
                
				//description			
				//$placeholder = (isset($this->field['placeholder']['description'])) ? esc_attr($this->field['placeholder']['description']) : __( 'Description', 'redux-framework' );
                /*echo '<li><textarea name="' . $this->field['name'] . '[' . $x . '][description]" id="' . $this->field['id'] . '-description_' . $x . '" placeholder="'.$placeholder.'" class="large-text" rows="6"></textarea></li>';*/
				echo '<li><input type="hidden" class="slide-description" name="' . $this->field['name'] . '[' . $x . '][description]" id="' . $this->field['id'] . '-description_' . $x . '" value="' . $x . '" />';
                
				//url
				//$placeholder = (isset($this->field['placeholder']['url'])) ? esc_attr($this->field['placeholder']['url']) : __( 'URL', 'redux-framework' );
                /*echo '<li><input type="text" id="' . $this->field['id'] . '-url_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][url]" value="" class="full-text" placeholder="'.$placeholder.'" /></li>';*/
				echo '<li><input type="hidden" class="slide-url" name="' . $this->field['name'] . '[' . $x . '][url]" id="' . $this->field['id'] . '-url_' . $x . '" value="' . $x . '" />';
                
				//sort
				//$placeholder = (isset($this->field['placeholder']['sort'])) ? esc_attr($this->field['placeholder']['sort']) : __( 'Sort', 'redux-framework' );
				/*echo '<li><input type="text" id="' . $this->field['id'] . '-sort_' . $x . '" name="' . $this->field['name'] . '[' . $x . '][sort]" value="" class="full-text"
placeholder="'.$placeholder.'" /></li>';*/
				echo '<li><input type="hidden" class="slide-sort" name="' . $this->field['name'] . '[' . $x . '][sort]" id="' . $this->field['id'] . '-sort_' . $x . '" value="' . $x . '" />';
				
				//attachment_id
                echo '<li><input type="hidden" class="upload-id" name="' . $this->field['name'] . '[' . $x . '][attachment_id]" id="' . $this->field['id'] . '-image_id_' . $x . '" value="" />';				
				
				//image
                echo '<input type="hidden" class="upload" name="' . $this->field['name'] . '[' . $x . '][image]" id="' . $this->field['id'] . '-image_url_' . $x . '" value="" readonly="readonly" />';
				
				//height
                echo '<input type="hidden" class="upload-height" name="' . $this->field['name'] . '[' . $x . '][height]" id="' . $this->field['id'] . '-image_height_' . $x . '" value="" />';
				
				//width
                echo '<input type="hidden" class="upload-width" name="' . $this->field['name'] . '[' . $x . '][width]" id="' . $this->field['id'] . '-image_width_' . $x . '" value="" /></li>';
				
				//thumb
                echo '<input type="hidden" class="upload-thumbnail" name="' . $this->field['name'] . '[' . $x . '][thumb]" id="' . $this->field['id'] . '-thumb_url_' . $x . '" value="" /></li>';
/*
                    if ( isset( $this->field['options'] ) && !empty( $this->field['options'] ) ) {
                        $placeholder = (isset($this->field['placeholder']['select'])) ? esc_attr($this->field['placeholder']['select']) : __( 'Select an Option', 'redux-framework' );
                        if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                            $select2_params = json_encode( esc_attr( $this->field['select2'] ) );
                            $select2_params = htmlspecialchars( $select2_params , ENT_QUOTES);
                            echo '<input type="hidden" class="select2_params" value="'. $select2_params .'">';
                        }

                        echo '<select '.$multi.' id="'.$this->field['id'].'-select" data-placeholder="'.$placeholder.'" name="' . $this->field['name'] . '[' . $x . '][select]" class="redux-select-item '.$this->field['class'].'" rows="6" style="width:93%;">';
                            echo '<option></option>';
                            foreach($this->field['options'] as $k => $v){
                                if (is_array($this->value)) {
                                    $selected = (is_array($this->value) && in_array($k, $this->value))?' selected="selected"':'';                   
                                } else {
                                    $selected = selected($this->value, $k, false);
                                }
                                echo '<option value="'.$k.'"'.$selected.'>'.$v.'</option>';
                            }//foreach
                        echo '</select>';                           
                    }
*/
                echo '<li><a href="javascript:void(0);" class="button deletion redux-custom_field-remove">' . __('Delete Slide', 'redux-framework') . '</a></li>';
                echo '</ul></div></fieldset></div>';
            }
            echo '</div><a href="javascript:void(0);" class="button redux-custom_field-add button-primary" rel-id="' . $this->field['id'] . '-ul" rel-name="' . $this->field['name'] . '[title][]">' . __('Add Slide', 'redux-framework') . '</a><br/>';
			
			
			
			
			


        }
    
        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            $extension = ReduxFramework_extension_custom_field::getInstance();
        
            /*wp_enqueue_script(
                'redux-field-icon-select-js', 
                $this->extension_url . 'field_custom_field.js', 
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-icon-select-css', 
                $this->extension_url . 'field_custom_field.css',
                time(),
                true
            );
			*/
			
			
			wp_enqueue_script(
                'redux-field-mediab-js',
                $this->extension_url . 'field_mediab.js',
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-mediab-css',
                $this->extension_url . 'field_mediab.css',
                time(),
                true
            );            

            wp_enqueue_script(
                'redux-field-slidesb-js',
                $this->extension_url . 'field_slidesb.js',
                array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'wp-color-picker'),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-slidesb-css',
                $this->extension_url . 'field_slidesb.css',
                time(),
                true
            );
        
        }
        
        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */        
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {

            }
            
        }        
        
    }
}
