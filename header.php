<?php
if (!is_user_logged_in()) {
    wp_redirect(esc_url(site_url('/wp-login.php')));
    exit;
}
?>
<!DOCTYPE html>
<html dir="rtl" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <!-- this meta tag is for: responsive css -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <header class="site-header" >
        <div class="container">
            <h1 class="school-logo-text float-left"><a href="<?php echo site_url(); ?>">صفحه اصلی</a></h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group" >
                <nav class="main-navigation"  >

                   <ul>
                       <?php
                       $ourCurrentUser = wp_get_current_user();
                        if (($ourCurrentUser->roles[0] == 'administrator') OR ($ourCurrentUser->roles[0] == 'admin')OR ($ourCurrentUser->roles[0] == 'khadem-mard')OR ($ourCurrentUser->roles[0] == 'khadem-zan')){ ?>
                            <li <?php if (get_post_type() == 'salek')echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link('salek'); ?>">شاگردان</a></li>

                        <?php }                    ?>

                       <li <?php if (get_post_type() == 'arbayiin')echo 'class="current-menu-item"'; ?>><a href="<?php echo site_url('/sabegh'); ?>">اربعینیات سابق</a></li>
                       <li <?php if (get_post_type() == 'arbayiin')echo 'class="current-menu-item"'; ?>><a href="<?php echo get_post_type_archive_link('arbayiin'); ?>">اربعینیات</a></li>
                        <li <?php if (get_post_type() == 'event' OR is_page('past-events')) echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('event');?>">رویدادها</a></li>
                        <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>><a href="<?php echo site_url('/news');?>">اطلاعیه ها</a></li>


                </nav>
                <div class="site-header__util">
                    <?php if (is_user_logged_in()) { ?>
                        <a href="<?php echo esc_url(site_url('/my-notes')); ?>" class="btn btn--small btn--gray float-left push-right">یادداشت های من</a>
                        <a href="<?php echo esc_url(site_url('/profile')); ?>" class="btn btn--small btn--gray float-left push-right">ویرایش پروفایل</a>
                        <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small btn--dark-orange float-left btn--with-photo"><span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span><span class="btn__text">خروج</span></a>


                    <?php } else { ?>
                        <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--orange float-left push-right">ورود</a>
                        <a href="<?php echo esc_url(site_url('/profile')); ?>" class="btn btn--small  btn--dark-orange float-left">ثبت نام</a>
                    <?php } ?>



                </div>
            </div>
        </div>
    </header>
