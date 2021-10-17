<?php

/* ---------------------------------------------------------------------------------------------
   BLOCK SETTINGS CLASS
   Handles block styles and block patterns.
------------------------------------------------------------------------------------------------ */

if ( ! class_exists( 'Nutmeg_Blocks_Manager' ) ) :
	class Nutmeg_Blocks_Manager {

		/*	-----------------------------------------------------------------------------------------------
			REGISTER BLOCK STYLES
		--------------------------------------------------------------------------------------------------- */

		public static function register_block_styles() {

			if ( ! function_exists( 'register_block_style' ) ) return;

			// Shared: Text Alignment
			$text_alignment_blocks = array( 
				'core/cover'
			);

			foreach ( $text_alignment_blocks as $block ) {
				register_block_style( $block, array(
					'label' => esc_html__( 'Align: Center', 'nutmeg' ),
					'name'  => 'center-aligned',
				) );
				register_block_style( $block, array(
					'label' => esc_html__( 'Align: Right', 'nutmeg' ),
					'name'  => 'right-aligned',
				) );
			}

			// Cover
			$cover_alignment_blocks = array( 
				'core/cover'
			);

			foreach ( $cover_alignment_blocks as $block ) {
				register_block_style( $block, array(
					'label' => esc_html__( 'Full Width', 'nutmeg' ),
					'name'  => 'full-width',
				) );
			}

			// Lists
			$list_styles_blocks = array( 
				'core/list'
			);

			foreach ( $list_styles_blocks as $block ) {
				register_block_style( $block, array(
					'label' => esc_html__( 'Columns: 2', 'nutmeg' ),
					'name'  => 'column-count--2',
				) );
				register_block_style( $block, array(
					'label' => esc_html__( 'Columns: 3', 'nutmeg' ),
					'name'  => 'column-count--3',
				) );
				register_block_style( $block, array(
					'label' => esc_html__( 'Ordered List - Alternative', 'nutmeg' ),
					'name'  => 'numbers-special',
				) );
				register_block_style( $block, array(
					'label' => esc_html__( 'Unordered List - Table', 'nutmeg' ),
					'name'  => 'table',
				) );
			}

			// Group Styles
			$section_intro_blocks = array( 
				'core/group'
			);

			foreach ( $section_intro_blocks as $block ) {
				register_block_style( $block, array(
					'label' => esc_html__( 'Align: Center', 'nutmeg' ),
					'name'  => 'center-aligned',
				) );
				register_block_style( $block, array(
					'label' => esc_html__( 'Align: Right', 'nutmeg' ),
					'name'  => 'right-aligned',
				) );
			}

		}


		/*	-----------------------------------------------------------------------------------------------
			REGISTER BLOCK PATTERNS
		--------------------------------------------------------------------------------------------------- */

		public static function register_block_patterns() {

			// Register the Nutmeg block pattern category.
			if ( function_exists( 'register_block_pattern_category' ) ) {
				register_block_pattern_category( 'nutmeg', array( 
					'label' => esc_html__( 'Nutmeg', 'nutmeg' ) 
				) );
			}
			
			// Register block patterns.
			// The block patterns can be modified with the nutmeg_block_patterns filter.
			$block_patterns = apply_filters( 'nutmeg_block_patterns', array(
				'nutmeg/opening-message' => array(
					'title'			=> esc_html__( 'Opening Message', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/opening-message.php' ),
					'categories'	=> array( 'nutmeg', 'header' ),
					'keywords'		=> array( 'intro', 'hero' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/cover-with-overlay' => array(
					'title'			=> esc_html__( 'Cover with Overlay', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/cover-with-overlay.php' ),
					'categories'	=> array( 'nutmeg', 'header' ),
					'keywords'		=> array( 'cover', 'intro' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/ingredients' => array(
					'title'			=> esc_html__( 'Ingredients List', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/ingredients.php' ),
					'categories'	=> array( 'columns', 'nutmeg' ),
					'keywords'		=> array( 'list', 'row', 'grid', 'column' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/ingredients-instructions' => array(
					'title'			=> esc_html__( 'Ingredients + Instructions', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/ingredients-instructions.php' ),
					'categories'	=> array( 'columns', 'nutmeg' ),
					'keywords'		=> array( 'list', 'row', 'grid', 'column' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/featured-pages-standard' => array(
					'title'			=> esc_html__( 'Featured Pages - Standard', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/featured-pages-standard.php' ),
					'categories'	=> array( 'columns', 'nutmeg' ),
					'keywords'		=> array( 'row', 'column', 'grid' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/recipe-info' => array(
					'title'			=> esc_html__( 'Recipe info', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/recipe-info.php' ),
					'categories'	=> array( 'nutmeg', 'header' ),
					'keywords'		=> array( 'intro' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/section-intro' => array(
					'title'			=> esc_html__( 'Section Intro', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/section-intro.php' ),
					'categories'	=> array( 'nutmeg', 'header' ),
					'keywords'		=> array( 'intro', 'hero' ),
					'viewportWidth'	=> 1200,
				),

				'nutmeg/section-intro-max-width' => array(
					'title'			=> esc_html__( 'Section Intro (60% Width)', 'nutmeg' ),
					'description'	=> esc_html__( 'A large text paragraph followed by buttons.', 'nutmeg' ),
					'content'		=> Nutmeg_Blocks_Manager::get_block_pattern_markup( 'ilovewp-admin/block-patterns/section-intro-max-width.php' ),
					'categories'	=> array( 'nutmeg', 'header' ),
					'keywords'		=> array( 'intro', 'hero' ),
					'viewportWidth'	=> 1200,
				),

			) );

			if ( $block_patterns && function_exists( 'register_block_pattern' ) ) {
				foreach ( $block_patterns as $name => $data ) {
					if ( isset( $data['content'] ) && $data['content'] ) {
						register_block_pattern( $name, $data );
					}
				}
			}

		}


		/*	-----------------------------------------------------------------------------------------------
			GET BLOCK PATTERN
			Returns the markup of the block pattern at the specified theme path.
		--------------------------------------------------------------------------------------------------- */

		public static function get_block_pattern_markup( $path ) {

			// Define shared block pattern placeholder content, to minimize cluttering up of the polyglot list.
			$lorem_short_1 = esc_html_x( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.', 'Block pattern demo content', 'nutmeg' );
			$lorem_short_2 = esc_html_x( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.', 'Block pattern demo content', 'nutmeg' );

			$lorem_long_1 = $lorem_short_1 . ' ' . $lorem_short_2;
			$lorem_long_2 =  esc_html_x( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', 'Block pattern demo content', 'nutmeg' );
			$lorem_long_3 =  esc_html_x( 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 'Block pattern demo content', 'nutmeg' );

			if ( ! locate_template( $path ) ) return;

			ob_start();
			include( locate_template( $path ) );
			return ob_get_clean();

		}

	}

	// Register block styles.
	add_action( 'init', array( 'Nutmeg_Blocks_Manager', 'register_block_styles' ) );

	// Register block patterns.
	add_action( 'init', array( 'Nutmeg_Blocks_Manager', 'register_block_patterns' ) );

endif;
