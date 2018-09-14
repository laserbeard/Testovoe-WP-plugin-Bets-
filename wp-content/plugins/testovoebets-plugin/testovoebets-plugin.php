<?php 
ini_set('display_errors', 1);
/**
* @package TestovoebetsPlugin
*/
/*
Plugin Name: Testovoebets Plugin 
Plugin URI: https://docs.google.com/document/d/1ejl9M_Lv1c1v0YatvdGlDpWh2BeRq3ojoNcIMH967Dw/edit?usp=sharing
Description: Этот плагин из тестового задания на вакансию разработчика wordpress 
Version: 1.0.0
Author: Максим Тарасенко
Author URI: http://realcoder.ru
License: GPLv2 or later
Text Domain: testovoebets-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

if( ! defined('ABSPATH') ) {
		die;
}

class TestovoebetsPlugin
{
	

	function __construct(){
		add_action('init', array($this, 'bets_post_type'));
		
		// Регитрируем таксономии 
		add_action('init', array($this, 'bets_post_type_taxonomies'));

		
	}


	static function activate($obj){
		
		flush_rewrite_rules();

		TestovoebetsPlugin::create_roles();
		
	}

	function deactivate(){
		//echo "The plugin was deactivated";
		remove_role('kapper');
	}

	function uninstall(){ }


	function bets_post_type(){
		
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
			//'taxonomies'            => array( 'category'),
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
			'capability_type'       => 'posts',
			'capabilities' => array(
				'edit_post' => 'edit_bet',
		        'edit_posts' => 'edit_bets',
		        'edit_others_posts' => 'edit_others_bets',
		        'delete_others_posts' => 'delete_others_bets',
		        'publish_posts' => 'publish_bets',
		        'read_post' => 'read_bet',
		        'read_private_posts' => 'read_private_bets',
		        'delete_post' => 'delete_bets',
		        'create_posts' => 'edit_bets',
		    ),
			'show_in_rest'          => true,
	        'query_var'         =>  true,
	       	'rewrite' => array('slug' => 'bets', 'with_front' => true),
		);
		

		register_post_type('bets', $args);

	}



	static function create_roles(){


		//«Каппер» - со стандартными правами подписчика и возможностью добавлять/редактировать свои ставки в типе постов «Ставки».


		 // remove_role('kapper');
		 // remove_role('moderator');


		 add_role('kapper', 'Каппер', array('read'));

		 add_role('moderator', 'Модератор', array('read'));




	
			//«Каппер» - со стандартными правами подписчика и возможностью добавлять/редактировать свои ставки в типе постов «Ставки».

			$kapper = get_role( 'kapper' );
		    $kapper->add_cap( 'edit_bet' ); 
		   	$kapper->add_cap( 'edit_bets' ); 
		    $kapper->add_cap( 'read_bet' ); 
		    //$kapper->add_cap( 'delete_bets' );

		


		    //«Модератор» - с правами добавлять/редактировать любые ставки в типе постов «Ставки».

			$moderator = get_role( 'moderator' );
		    $moderator->add_cap( 'edit_bet' ); 
		    $moderator->add_cap( 'edit_bets' ); 
		    $moderator->add_cap( 'edit_others_bets' ); 
		    $moderator->add_cap( 'publish_bets' ); 
		    $moderator->add_cap( 'read_bet' ); 
		    $moderator->add_cap( 'read_private_bets' );
		    $moderator->add_cap( 'delete_bets' );
	

	 }



	




	function bets_post_type_taxonomies() {

		// Регитрируем таксономию "Тип ставки"
	    register_taxonomy(
	        'bets_type',
	        'bets',
	        array(
	            'labels' => array(
	                'name' => 'Тип ставки',
	                'add_new_item' => 'Add New Bets Type',
	                'new_item_name' => "New Bets Type"
	            ),
	            'show_ui' => true,
	            'show_tagcloud' => false,
	            'hierarchical' => true,
	            'capabilities' => array(
				    // 'manage_terms' => 'manage_genre',
				    // 'edit_terms' => 'edit_genre',
				    // 'delete_terms' => 'delete_genre',
				    'assign_terms' => 'edit_bets',
				)
	        )
	    );

	    // Регитрируем термины для "Тип ставки"
		$bets_type_terms = array (
            '0' => array (
                'name'          => 'Ординар',
                'slug'          => 'Ordinar',
                'description'   => 'Тип Ординар',
            ),
            '1' => array (
                'name'          => 'Экспресс',
                'slug'          => 'expres',
                'description'   => 'Тип Экспресс',
            ),
        );  

		$this->register_new_terms('bets_type', $bets_type_terms);



		// Регитрируем таксономию "Статус ставки"
	    register_taxonomy(
	        'bets_status',
	        'bets',
	        array(
	            'labels' => array(
	                'name' => 'Статус ставки',
	                'add_new_item' => 'Add New Bets State',
	                'new_item_name' => "New Bets State"
	            ),
	            'show_ui' => true,
	            'show_tagcloud' => false,
	            'hierarchical' => true,
	            'capabilities' => array(
				    // 'manage_terms' => 'manage_genre',
				    // 'edit_terms' => 'edit_genre',
				    // 'delete_terms' => 'delete_genre',
				    'assign_terms' => 'edit_bets',
				)
	        )
	    );

	    // Регитрируем термины для "Статус ставки"
		$bets_state_terms = array (
            '0' => array (
                'name'          => 'Выигрыш',
                'slug'          => 'win',
                'description'   => 'Статус Выигрыш',
            ),
            '1' => array (
                'name'          => 'Проигрыш',
                'slug'          => 'loss',
                'description'   => 'Статус Проигрыш',
            ),
            '2' => array (
                'name'          => 'Возврат',
                'slug'          => 'return',
                'description'   => 'Статус Возврат',
            ),
            '3' => array (
                'name'          => 'Активная',
                'slug'          => 'active',
                'description'   => 'Статус Активная',
            ),
        );  

		$this->register_new_terms('bets_status', $bets_state_terms);

	}


	


	function register_new_terms($taxonomy, $terms) {
        

        foreach ( $terms as $term_key=>$term) {
                wp_insert_term(
                    $term['name'],
                    $taxonomy, 
                    array(
                        'description'   => $term['description'],
                        'slug'          => $term['slug'],
                    )
                );
            unset( $term ); 
        }

    }



}




if( class_exists('TestovoebetsPlugin')){
	$testovoebetsPlugin = new TestovoebetsPlugin();	
}


// activation
register_activation_hook(__FILE__, array('TestovoebetsPlugin', 'activate'));



// deactivation
//register_deactivation_hook(__FILE__, 'deactivate');

