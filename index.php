<?php
/*
Plugin Name: ISBN Book Search
Plugin URI: http://techooid.com/dev/wp-plugins/isbn-book-search
Description: Add the ISBN Book Search Widget in the Sidebar of your any website.
Version: 1.0
Author: Haseeb Ahmad Ayazi
Author URI: http://techooid.com/dev/wp-plugins/
*/
 
 
class isbnbooksearch extends WP_Widget
{
  function isbnbooksearch()
  {
    $widget_ops = array('classname' => 'isbnbooksearch', 'description' => 'ISBN Book Search' );
    $this->WP_Widget('isbnbooksearch', 'ISBN Book Search', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
echo <<<_HTML

<form method="get" action="http://www.amazon.com/gp/search">
<input type="hidden" name="tag" value="isbnbooksearch-20">
<input type="hidden" name="ie" value="UTF8">
<input type="hidden" name="index" value="blended">
<input name="keywords" size="12" type="text" value="">
<input type="submit" value="Search Book">
</form>

_HTML;


    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("isbnbooksearch");') );?>