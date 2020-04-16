<div class="xs-sidebar-group cart-group">
    <div class="xs-overlay black-bg"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading media">
                <div class="media-body">
                    <a href="#" class="close-side-widget">
                        <i class="icon icon-cross"></i>
                    </a>
                </div>
            </div>
            <div class="xs-empty-content">
                <h3 class="widget-title"><?php esc_html_e('Shopping cart','seocify');?></h3>
                <h4 class="xs-title"><?php esc_html_e('No products in the cart.','seocify');?></h4>
                <p class="empty-cart-icon">
                    <i class="icon icon-shopping-cart"></i>
                </p>
                <p class="xs-btn-wraper">
                    <a class="btn btn-primary" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php esc_html_e('Return To Shop','seocify');?></a>
                </p>
            </div>
        </div>
    </div>
</div>