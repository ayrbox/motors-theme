<?php 

/**
 * Repetable control class for customier
 * Code used from OnePress theme
 * 
 * @since 1.0.1
 * @access public
 */
class Theme_Pages_Selector_Control extends WP_Customize_Control {


  public $type = 'pages';
  public $page_fields = array(
      'page_id' => array(
        'type' => 'select'        
      ),
      'show_link' => array(
        'type' => 'checkbox'
      ),
      'show_title' => array(
        'type' => 'checkbox'
      )
    );


  
  public function __construct($manager , $id, $args = array()) {
    parent::__construct($manager, $id, $args);
  }


  public function to_json() {
    parent::to_json();
    $pages = $this->value();
      
    // if(is_string($pages)) {
    //   $pages = json_decode($pages, true);      
    // }

    $this->json["actual_data"] = $pages;

    //todo
    // $pages = '[{"page_id":2, "show_title": 1, "show_link": 0}, {"page_id":9, "show_title": 0, "show_link": 1}]';
    
    $this->json["pages"] = $pages;
  }

  public function enqueue() {
    add_action('customize_controls_print_footer_scripts', array(__CLASS__,'page_item_tpl'), 66);
  }





  public function render_content() {
    ?>
      <label>
        <span class='customize-control-title'>
          <?php echo __('Add Pages:', 'theme'); ?>
        </span>
      </label>
      <input data-hidden-value type='hidden' value=""
        <?php $this->input_attrs(); ?>
        <?php $this->link();?> />

      <div class='form-data'>
        <ul class='page-list'></ul><!--List Container-->
      </div>
      <div class="repeatable-actions">          
          <button type="button" class="button-secondary add-page" data-button="add">
            <?php _e('Add Page', 'theme'); ?>
          </button>
        </div>
    <?php
  }


  public static function page_item_tpl() {    
    ?>    
    <script type="text/html" id="page-item-tpl">
      <# var pages = <?php echo self::get_page_list(); ?>; #>
      <li class='page-list-item'>
          <div class="widget">
            <div class='widget-top'>
              <div class="widget-title-action">
                <a href="#" class="widget-action"></a>
              </div>
              <div class="widget-title">
                <h4 class="live-title">
                  JS Item
                </h4>
              </div>
            </div>
            <div class='widget-inside'>
              <div class="page-form">
                <div class="widget-content">
                  <div class="item item-select">
                    <label class="field-label"><?php _e('Select Page', 'theme'); ?></label>                    
                    <select  class="select-one" name="_fields[{{data.item_id}}][page_id]">                      
                      <# _.each(pages, function(p) { #>
                        <option value="{{p.page_id}}" 
                          <# if(p.page_id == data.page_id) { #> selected="selected"<# } #> >
                        {{p.page_title}}
                        </option>
                      <# }); #>
                    </select>
                  </div>
                  <div class="item item-checkbox">
                    <label class="checkbox-label">
                      <input type="checkbox" value="1"
                        name="_fields[{{data.item_id}}][show_title]" 
                        <# if(data.show_title == 1) {#> checked='checked'<# } #> >
                      Show page title
                    </label>
                  </div>
                  <div class="item item-checkbox">
                    <label class="checkbox-label">
                      <input type="checkbox" value="1"
                      name="_fields[{{data.item_id}}][show_link]"
                      <# if(data.show_link == 1) {#> checked='checked'<# } #> >
                      Add Link to page
                    </label>
                  </div>
                </div>
                <div class="widget-control-actions">
                  <div class="alignleft">
                    <span class="remove-btn-wrapper">
                      <a href="#" class="page-remove">
                        Remove
                      </a> |
                      <a href="#" class="page-close">
                        Close
                      </a>
                      <br class="clear" />
                    </span>
                  </div>
                </div>
                <br class="clear" />
              </div>
            </div>
          </div>
        </li>
    </script>
    <?php 
  }


  public static function get_page_list() {    
    $pages = array();
    foreach(get_pages() as $i=>$page) {      
      $pages[$i] = array(
        'page_id'=> $page->ID,
        'page_title' => $page->post_title
      );
    }
    return json_encode($pages);
  }
} //Theme_Pages_Selector_Control