<?php
//отключение вордпрессовской стандартной шапки
add_filter('show_admin_bar', '__return_false');

remove_action('wp_head', 'wp_generator');

//remove comment, post, users, tools, settings from admin menu (left admin sidebar)
add_action('admin_menu', 'admin_panel_remove');
function admin_panel_remove ()
{
	remove_menu_page('edit.php');                     //Posts
	remove_menu_page('edit-comments.php');            //Comments
	remove_menu_page( 'users.php' );                  //Users
	remove_menu_page( 'tools.php' );                  //Tools
	remove_menu_page( 'options-general.php' );        //Settings
}

// style for UI
add_action('wp_enqueue_scripts', 'style_theme');
function style_theme(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('plugins', get_template_directory_uri() . '/assets/css/plugins.css');
	wp_enqueue_style('main_style', get_template_directory_uri() . '/assets/css/style.css');
}

// scripts for UI
add_action('wp_footer', 'scripts_theme');
function scripts_theme(){
	wp_enqueue_script('plugins', get_template_directory_uri() . '/assets/js/plugins.js');
	wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js');
}


// scripts for admin panel
add_action('admin_enqueue_scripts', 'admin_panel_scripts');
function admin_panel_scripts(){
	wp_enqueue_script('admin_panel_scripts', get_template_directory_uri() . '/assets/js/for_admin_panel.js');
}


//register new post type (program)
add_action( 'init', 'register_program' );
function register_program(){
	register_post_type( 'post_program', [
		'label'  => null,
		'labels' => [
			'name'               => 'Программы', // основное название для типа записи
			'singular_name'      => 'Программа', // название для одной записи этого типа
			'add_new'            => 'Добавить программу', // для добавления новой записи
			'add_new_item'       => 'Название модуля: ', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование программы', // для редактирования типа записи
			'new_item'           => 'Новое название', // текст новой записи
			'view_item'          => 'Смотреть программу', // для просмотра записи этого типа.
			'search_items'       => 'Искать программу', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Программы', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}


//добавление метабокса с названием программы
add_action( 'admin_menu', 'program_name_metabox' );
function program_name_metabox() {
	add_meta_box('program_name_meta', 'Номер модуля', 'draw_metabox_parogram_name', 'post_program', 'normal', 'high');
}

function draw_metabox_parogram_name($post) {
		wp_nonce_field( basename( __FILE__ ), 'name_program_metabox_nonce' );

	$html = '';
	$html .= '<label><input style="width: 40%;" placeholder="Введите название" type="text" name="program_name" id = "input_program_name" value="' . get_post_meta($post->ID, 'program_name',true) . '" /></label> ';

	echo $html;
}

add_action('save_post', 'save_program_name');
function save_program_name ( $post_id ) {
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['name_program_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['name_program_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_program') { // укажите собственный
		update_post_meta($post_id, 'program_name', esc_attr($_POST['program_name']));
	}
	return $post_id;
}

//добавление метабокса с программой модуля
add_action('admin_menu', 'program_structure_metabox');
function program_structure_metabox(){
	add_meta_box('program_structure_meta', 'Программа модуля', 'draw_metabox_parogram', 'post_program', 'normal', 'high');
}
function draw_metabox_parogram($post) {
	wp_nonce_field( basename( __FILE__ ), 'structure_program_metabox_nonce' );

	$html = '';
	$html .= '<label><textarea style="width: 80%; height: 350px" placeholder="Введите программу модуля" type="text" name="program_structure" id = "input_program_structure" value="" >' . get_post_meta($post->ID, 'program_structure',true) . '</textarea></label> ';

	echo $html;
}

add_action('save_post', 'save_program');
function save_program($post_id ){
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['structure_program_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['structure_program_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_program') { // укажите собственный
		update_post_meta($post_id, 'program_structure', esc_attr($_POST['program_structure']));
	}
	return $post_id;
}

//register new post type (mentors)
add_action( 'init', 'register_mentor' );
function register_mentor(){
	register_post_type( 'post_mentor', [
		'label'  => null,
		'labels' => [
			'name'               => 'Менторы (ведущие занятия)', // основное название для типа записи
			'singular_name'      => 'Ментор', // название для одной записи этого типа
			'add_new'            => 'Добавить ментора', // для добавления новой записи
			'add_new_item'       => 'Имя ментора: ', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование ментора', // для редактирования типа записи
			'new_item'           => 'Новый ментор', // текст новой записи
			'view_item'          => 'Смотреть ментора', // для просмотра записи этого типа.
			'search_items'       => 'Искать ментора', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Ментора не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Менторы', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

//добавление метабокса с профессией ментора
add_action( 'admin_menu', 'profession_mentor' );
function profession_mentor() {
	add_meta_box('mentor_profession', 'Профессия ментора', 'draw_metabox', 'post_mentor', 'normal', 'high');
}

function draw_metabox($post) {
	wp_nonce_field( basename( __FILE__ ), 'prof_metabox_nonce' );

	$html = '';
	$html .= '<label><input style="width: 40%;" placeholder="" type="text" name="mentor_prof" id = "input_mentor_prof" value="' . get_post_meta($post->ID, 'seo_title',true) . '" /></label> ';

	echo $html;
}

add_action('save_post', 'save_mentor_profession');
function save_mentor_profession ( $post_id ) {
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['prof_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['prof_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_mentor') { // укажите собственный
		update_post_meta($post_id, 'seo_title', esc_attr($_POST['mentor_prof']));
	}
	return $post_id;
}


//добавление метабокса с описанием ментора
add_action( 'admin_menu', 'description_mentor' );
function description_mentor() {
	add_meta_box('mentor_description', 'Описание ментора', 'draw_metabox_mentor_description', 'post_mentor', 'normal', 'high');
}

function draw_metabox_mentor_description($post) {
	wp_nonce_field( basename( __FILE__ ), 'description_metabox_nonce' );

	$html = '';
	$html .= '<label><input style="width: 100%;" type="text" name="mentor_descr" id="input_mentor_description" value="' . get_post_meta($post->ID, 'descr_title',true) . '" /></label> ';

	echo $html;
}

//save mentor description
add_action('save_post', 'save_mentor_description');
function save_mentor_description( $post_id ) {
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['description_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['description_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_mentor') { // укажите собственный
		update_post_meta($post_id, 'descr_title', esc_attr($_POST['mentor_descr']));
	}
	return $post_id;
}


//add button for adding img
add_action( 'admin_enqueue_scripts', 'photo_upload_script' );
function photo_upload_script() {
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
	wp_enqueue_script( 'myuploadscript', get_template_directory_uri() . '/assets/js/for_photo_admin.js', array('jquery'), null, false );
}

function true_image_uploader_field( $name, $value = '', $w = 115, $h = 100) {
	$default = get_template_directory_uri() . '/assets/img/arrow.png';
	if( $value ) {
		$image_attributes = wp_get_attachment_image_src( $value, array($w, $h) );
		$src = $image_attributes[0];
	} else {
		$src = $default;
	}
	echo '
	<div>
		<img data-src="' . $default . '" src="' . $src . '" width="' . $w . 'px" height="' . $h . 'px" />
		<div>
			<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
			<button type="submit" class="upload_image_button button">Загрузить</button>
			<button type="submit" class="remove_image_button button">×</button>
		</div>
	</div>
	';
}


add_action( 'admin_menu', 'add_photo_mentor_metabox' );
function add_photo_mentor_metabox() {
	add_meta_box('photo_mentor_metabox', 'Фото', 'true_print_box_u', 'post_mentor', 'normal', 'high');
}

function true_print_box_u($post) {
	if( function_exists( 'true_image_uploader_field' ) ) {
		true_image_uploader_field( 'uploader_custom', get_post_meta($post->ID, 'uploader_custom',true) );
	}
}

add_action('save_post', 'true_save_box_data_u');
function true_save_box_data_u( $post_id ) {
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}
	update_post_meta( $post_id, 'uploader_custom', $_POST['uploader_custom']);
	return $post_id;
}


//register new post type (lecturer)
add_action( 'init', 'register_lecturer' );
function register_lecturer(){
	register_post_type( 'post_lecturer', [
		'label'  => null,
		'labels' => [
			'name'               => 'Лекторы (участие в разработке)', // основное название для типа записи
			'singular_name'      => 'Лектор', // название для одной записи этого типа
			'add_new'            => 'Добавить лектора', // для добавления новой записи
			'add_new_item'       => 'Имя лектора: ', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование лектора', // для редактирования типа записи
			'new_item'           => 'Новый лектор', // текст новой записи
			'view_item'          => 'Смотреть лектора', // для просмотра записи этого типа.
			'search_items'       => 'Искать лектора', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Лекторы', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

//добавление метабокса с описанием лектора
add_action( 'admin_menu', 'description_lecturer' );
function description_lecturer() {
	add_meta_box('lecturer_description', 'Описание лектора', 'draw_metabox_mentor_description', 'post_lecturer', 'normal', 'high');
}

//save lecturer description
add_action('save_post', 'save_lecturer_description');
function save_lecturer_description( $post_id ) {
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['description_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['description_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_lecturer') { // укажите собственный
		update_post_meta($post_id, 'descr_title', esc_attr($_POST['mentor_descr']));
	}
	return $post_id;
}

//добавление метабокса с профессией ментора
add_action( 'admin_menu', 'profession_lecturer' );
function profession_lecturer() {
	add_meta_box('lecturer_profession', 'Профессия лектора', 'draw_metabox', 'post_lecturer', 'normal', 'high');
}

//сохранение профессии лектора
add_action('save_post', 'save_lecturer_profession');
function save_lecturer_profession ( $post_id ) {
	// проверяем, пришёл ли запрос со страницы с метабоксом
	if ( !isset( $_POST['prof_metabox_nonce'] )
	     || !wp_verify_nonce( $_POST['prof_metabox_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
	// проверяем, права пользователя, может ли он редактировать записи
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	// теперь также проверим тип записи
	$post = get_post($post_id);
	if ($post->post_type == 'post_lecturer') { // укажите собственный
		update_post_meta($post_id, 'seo_title', esc_attr($_POST['mentor_prof']));
	}
	return $post_id;
}

//добавление загрузчика фотографий лектора (сохранение происходит в блоке с добавлением ментора)
add_action( 'admin_menu', 'add_photo_lecturer_metabox' );
function add_photo_lecturer_metabox() {
	add_meta_box('photo_lecturer_metabox', 'Фото', 'true_print_box_u', 'post_lecturer', 'normal', 'high');
}