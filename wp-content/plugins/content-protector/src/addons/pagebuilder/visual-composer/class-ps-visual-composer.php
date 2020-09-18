<?php

class PS_Visual_Composer extends WPBakeryShortCode
{
    /**
     * Constructor for PS_Visual_Composer
     */
    public function __construct()
    {
        add_action( 'vc_after_init', array( $this, 'vc_passster_row' ) );
    }
    
    /**
     * Add parameters after vc init for vc_row element.
     *
     * @return void
     */
    public function vc_passster_row()
    {
    }

}
new PS_Visual_Composer();