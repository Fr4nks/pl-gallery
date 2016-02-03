<?php 
/* 
 Plugin Name: PL Gallery.
 Description: Reorders landscapes and portraits to fit in slideshow.
 Author: EHBeat: Francois de Villiers
 Version: 1.0 
*/

/* shortcode
<?php 
echo do_shortcode("[pl-gallery]");
?>
*/

?>

<?php 
function styles_with_the_lot()
{
    // Plugin Scripts:

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, false );
    
    wp_register_script( 'slick', plugins_url( '/slick/slick.min.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'slick' );   
   
    wp_register_script( 'slick-custom-script', plugins_url( '/js/script.js', __FILE__ ),  false);
    wp_enqueue_script( 'slick-custom-script' );    

    // Plugin Styles:
    wp_register_style( 'slick-style', plugins_url( 'slick/slick.css', __FILE__ ));
    wp_register_style( 'slick-theme', plugins_url( 'slick/slick-theme.css', __FILE__ ));
    wp_register_style( 'slick-custom-style', plugins_url( 'css/style.css', __FILE__ ));

    wp_enqueue_style( 'slick-style' );
    wp_enqueue_style( 'slick-theme' );
    wp_enqueue_style( 'slick-custom-style' );
}

add_action( 'init', 'styles_with_the_lot' );
?>

<?php
function gallery_main(){
    $images = get_field('gallery');
    function array_move(&$a, $oldpos, $newpos) {
        if ($oldpos==$newpos) {return;}
        array_splice($a,max($newpos,0),0,array_splice($a,max($oldpos,0),1));
    }
        $last_key = key( array_slice( $images, -1, 1, TRUE ) );
        $number = 0;

    foreach( $images as $key => $image ):
        $image['width'] <= $image['height'] ? $number++ : $number+=2;
        $number == 2 ? $number = 0 : '';  
        $number % 2 == 0 && $number > 3 ? $number = 0 . array_move($images, $key, $store) : ''; 
        if ( $key == $last_key && $number % 2 != 0 ):
           // array_move($images, $store, $last_key - 1 );
           unset($images[$store -1]);
        endif;              
        $image['width'] <= $image['height'] ? $store = $key + 1: '';                     
    endforeach;

    if( $images ): 
        ?><div class="your-class"><?php 
        foreach( $images as $key => $image ): 
            $image['width'] <= $image['height'] ? $orientation = 'portrait' : $orientation = 'landscape'; 
            ?><div>
                <a data-size="<?php echo $image['width']?> x <?php echo $image['height'] ?>" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['sizes'][$orientation]; ?>" alt="<?php echo $image['alt']; ?>" /></a>
            </div>
            <?php if($image['width'] > $image['height']): ?>
                 <div class="spacer"></div>
            <?php ; endif; ?>
        <?php endforeach; ?>
        </div>
    <a class="click-slide" >click here</a>
    <?php  endif;

};

add_shortcode('pl-gallery', 'gallery_main'); ?>


    <?php function slideshow_thumbnail(){
    $images = get_field('gallery');
    if( $images ): ?>
            <?php foreach( $images as $image ): ?>
                    <a data-size="<?php echo $image['width']?> x <?php echo $image['height'] ?>" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['sizes']['gallery-thumb']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
            <?php endforeach; ?>
    <?php endif; }; 
add_shortcode('slideshow-thumbnail', 'slideshow_thumbnail'); ?>




























