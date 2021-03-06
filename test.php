<?php 
$labels = array(
		'name'                  => _x( 'Ставки', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Ставки', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Ставки', 'text_domain' ),
		'name_admin_bar'        => __( 'Ставки', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'Все', 'text_domain' ),
		'add_new_item'          => __( 'Добавить', 'text_domain' ),
		'add_new'               => __( 'Добавить', 'text_domain' ),
		'new_item'              => __( 'Новая', 'text_domain' ),
		'edit_item'             => __( 'Редактировать', 'text_domain' ),
		'update_item'           => __( 'Обновтить', 'text_domain' ),
		'view_item'             => __( 'Посмотреть', 'text_domain' ),
		'view_items'            => __( 'Посмотреть', 'text_domain' ),
		'search_items'          => __( 'Искать', 'text_domain' ),
		'not_found'             => __( 'Не найдено', 'text_domain' ),
		'not_found_in_trash'    => __( 'Не найдено в корзине', 'text_domain' ),
		'featured_image'        => __( 'Картинка этой записи', 'text_domain' ),
		'set_featured_image'    => __( 'Выбрать картинку записи', 'text_domain' ),
		'remove_featured_image' => __( 'Удалить картинку записи', 'text_domain' ),
		'use_featured_image'    => __( 'Использовать картинкой записи', 'text_domain' ),
		'insert_into_item'      => __( 'Вставить в запись', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Загрузить в запись', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Ставки', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain'),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields',  'thumbnail'),
		'taxonomies'            => array( 'category'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-aside',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		//'has_archive'           => 'bets',
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
        'query_var'         =>  true,
       'rewrite' => array('slug' => 'bets', 'with_front' => true),
    
	);