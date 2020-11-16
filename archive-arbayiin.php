<?php get_header();
?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">اربعینیات</h1>
            <div class="page-banner__intro">
                <p>لیست همه ی اربعینیات</p>
            </div>
        </div>
    </div>
    <div class="container container--narrow page-section">

        <div class="generic-content">

        <ul class="" id="my-arbayiin">

        <?php
        while(have_posts()) {
            the_post();
            $id = get_the_ID();
            $permalink = get_the_permalink();
            $title = get_the_title();
            $duration = get_field('arbayiin-duration');

      ?>
    <?php


            //START >>>>>>********************************       [ ARBAYIINS FROM SALEKIN ]       **********************

            // Get users which their ID is current userID and have current arbayiin in their relation field
            $salekArbayiins = new WP_Query(array(
                'post_type' => 'salek',

                'orderby' => 'modified',
                'posts_per_page' => -1,
                'meta_query' => array(
                        'relation' => 'AND',
                    array(
                    'key' => 'arbayiin',
                    'compare' => 'LIKE',
                    'value' => '"' . $id . '"'
                    ),
                    array(
                        'key' => 'salekid',
                        'compare' => '=',
                        'value' => get_current_user_id()
                    )
                )
            ));


            if ($salekArbayiins->found_posts) { ?>
<!--                    <li class="arbayiin-title" data-id="--><?php //echo $id; ?><!--">-->
<!--                        <a class="" href="--><?php //echo $permalink; ?><!--"> <strong>--><?php //echo $title; ?><!--</strong></a>-->
<!--                    </li>-->
        <?php }
    //####################################################################################### END <<<<<<<<<<<<<<<<<<


    //START >>>>>>********************************       [ ARBAYIINS FROM GROUPS ]       **********************
    $post_objects = get_field('groups');
    if( $post_objects ):
        foreach( $post_objects as $post): // variable must be called $post (IMPORTANT)
        // override $post
        setup_postdata( $post );
        $userss = get_field('userss');
        if( $userss ): ?>
                <?php foreach( $userss as $user ): ?>
                    <?php if ($user['ID'] == get_current_user_id()): ?>
<!--                           <li  class="arbayiin-title" data-id="--><?php //echo $id; ?><!--">-->
<!--                               <a  href="--><?php //echo $permalink; ?><!--"> <strong>--><?php //echo $title; ?><!--</strong></a>-->
<!--                           </li>-->
                    <?php endif; ?>
                <?php endforeach; ?>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif;
    //############################################# END <<<<<<<<<<<<<<<<<<
    ?>

<?php } ?>
        </ul>
<?php
echo paginate_links();
?>




        <?php
        //########################################## salekin pas az application
        // args
        $args = array(
            'numberposts'	=> -1,
            'post_type'		=> 'salek',
        );
        $the_query = new WP_Query( $args);
        while ($the_query->have_posts()){
            $the_query->the_post();

            if (get_field('salekid')['ID'] == get_current_user_id()){

                // arbayiin haye bad az application
                /**
                 * ARBAYIIN HAYE BAD AZ APPLICATION
                 * Field Structure:
                 *
                 * - parent_repeater (Repeater)
                 *   - parent_title (Text)
                 *   - child_repeater (Repeater)
                 *     - child_title (Text)
                 */
                if( have_rows('arb_after_app') ):
                    while( have_rows('arb_after_app') ) : the_row();

                        // Get parent value.
                        $dastoor_title = get_sub_field('dastoor_takhsised');


                        if ($dastoor_title): ?>
<!--                            --><?php //print_r($dastoor_title);?>
                            <a id="no-underline" href="<?php echo str_replace("localhost", "192.168.1.168:3000", $dastoor_title->guid);?>">
                                <h5 class="arbayiin-title" style="color: #0e5da1">
                                    <?php echo esc_html( $dastoor_title->post_title ); ?>
                                </h5>
                            </a>
                        <?php endif; ?>
                    <?php


                    endwhile;
                endif;
            }
        }

        ?>
    </div>
    </div>


<?php get_footer();
?>