<?php 
/*
  Plugin Name: News Headline PHP Plugin
  Description: A news plugin that pulls from an API to give you the latest headlines
  Version: 1.0
  Author: Cache
  Author URI: www.github.com/cachehunter
*/

class NewsHeadlinesphpOnlyPlugin {
// Was supposed to register block
function register_block_type( $block_type, $args = array() ) {
  if ( is_string( $block_type ) && file_exists( $block_type ) ) {
    return register_block_type_from_metadata( $block_type, $args );
  }
 
    return WP_Block_Type_Registry::get_instance()->register( $block_type, $args );
}
//API GET request
function get_news_from_api(){
  $current_page = (! empty($_POST['current_page']) ) ? $_POST['current_page'] : 1;
  $news = [];
  $results = wp_remote_get('http://URLandKeyGoesHere' . $current_page. 
  '& per_page=5');

}
//Displays front end content
function display($content){
  $results = wp_remote_get('http://URLandKeyGoesHere');
  
  echo '<pre>';
  print_r($results);
  echo '</pre>';
  dies();
  return ($content);
}
//Setting page/Admin menu 
  function __construct() {
    add_action('admin_menu', array($this, 'adminPage')); 
    add_action('admin_init', array($this, 'settings'));
   } 

  function settings(){
    //Custom icon for setting/admin page
    $mainPageHook = add_menu_page('News Headlines', 'News Headlines', 'manage_options', 'ournewsheadlines', array($this, 'newsheadlinesapipage'), 'data:image/svg+xml
    ;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJl
    dmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xMCAyMEMxNS41MjI5IDIwIDIwIDE1LjUyMjkgMjAgMTBDMjAgNC40NzcxNCAxNS41MjI5IDAgMTAgMEM0LjQ3NzE0IDAgMCA0LjQ3NzE0IDAgMTBDMCAxN
    S41MjI5IDQuNDc3MTQgMjAgMTAgMjBaTTExLjk5IDcuNDQ2NjZMMTAuMDc4MSAxLjU2MjVMOC4xNjYyNiA3LjQ0NjY2SDEuOTc5MjhMNi45ODQ2NSAxMS4w
    ODMzTDUuMDcyNzUgMTYuOTY3NEwxMC4wNzgxIDEzLjMzMDhMMTUuMDgzNSAxNi45Njc0TDEzLjE3MTYgMTEuMDgzM0wxOC4xNzcgNy40NDY2NkgxMS45OVoiIGZpbGw9IiNGRkRGOEQiLz4KPC9zdmc+', 100);

    add_options_page ('News headline settings', 'News Settings', 'manage_options', 'news-headlines-setting-page', array($this, 'ourHTML'));
    add_settings_section('time_section', 'Time Sorting','Sort articles by date published', 'news-headlines-setting-page');
    add_settings_field('time_sorting', 'Sort by date published', array($this, 'timesortingHTMl', 'news-headlines-setting-page', 'time_section'));
    register_setting('newsheadlinsettings', 'time_sorting', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0' ));
  } 
   //Logic for settings
  function timesortingHTML(){ ?>
     <select name="time_sorting">
     <input type="checkbox" id="1" value="0">
     </select>
  <?php }
   //Adds settings page
  function adminPage() {
     add_options_page ('News headline settings', 'News Settings', 'manage_options', 'news-headlines-setting-page', array($this, 'ourHTML'));
   }
    //HTML for setting page
  function ourHTML() { ?>
    <div class="wrap">
      <h1>News display settings</h1>
        <ul><h1>Time Sorting</h1>
        <p>Display articles in a time range</p>
          <li>Last 7 daysweek</li>
          <li>last two weeks</li>
          <li>last four weeks</li>
          <li>mm/dd/yyyy</li>
        </ul>
       <h1>Content Sorting</h1>
       <p>Check the boxes of what you want to display</p>
       <ul>
         <li>Title</li>
         <li>Author</li>
         <li>Description</li>
         <li>Publisher<li>
         <li>Include image</li>
       </ul>
    </div>
<?php }}
  
  
  