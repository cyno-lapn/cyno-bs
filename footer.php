        </div><!-- .container -->
    </div><!-- #content -->

    <footer id="colophon" class="site-footer bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="site-info">
                        <?php
                        printf(
                            /* translators: %1$s: Theme name, %2$s: Theme author. */
                            esc_html__('%1$s by %2$s', 'cyno-bs'),
                            '<a href="https://cyno.vn">CYNO Bootstrap Theme</a>',
                            '<a href="https://cyno.vn">CYNO Software Team</a>'
                        );
                        ?>
                    </div><!-- .site-info -->
                </div>
                <div class="col-md-6">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'nav justify-content-end',
                        'container'      => false,
                        'fallback_cb'    => '__return_false',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'          => 1,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 