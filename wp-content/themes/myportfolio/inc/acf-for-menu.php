<?php
/**
 * Plugin Name: Acf-For-Menu (GSP)
 * Plugin URI: https://www.facebook.com/joshim911/
 * Description: ACF-For-Menu is a product of GSP. You set class in the menu items and then you can do what you need althogh We desing this plugin specially for setting fontAwesome Icon in the menu items
 * Version: 1.0.0
 * Author: GSP
 * Author URI: https://www.facebook.com/dreambulider/
 * Developer: Joshim
 * Developer URI: https://www.facebook.com/dreambulider/
 * Text Domain: ACF-For-Menu-GSP
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

class menu_modify_gsp {
    
    protected $id = array();
    protected $li_class = array();
    protected $class_data = '';
    protected $url = array();
    protected $title = array();
    protected $acf_field = '';
    protected $acf_field_name = '';
    protected $checkAcfValue = false;
    protected $newMenu = '';
    public $domain = 'ACF-For-Menu-GSP';
    
    public function __construct($field_name){
       add_filter('wp_nav_menu_objects', array($this, 'access_menu_data'), 10, 2); 
       add_filter('wp_nav_menu_items',array($this, 'mobify_menu') , 10, 2);
       $this->acf_field_name = $field_name;
    }
    
    public function access_menu_data($items, $args){
        
        foreach( $items as $i => $item){
            $this->id[$i] = $item->ID;
            $this->title[$i] = $item->title;
            $this->url[$i] = $item->url;
            foreach($items[1]->classes as $class){
                $this->class_data .= " ". $class;
            }
            $this->li_class[$i] = $this->class_data;
            
            /*
                if get one result from acf then will be returned null value otherwise default will return
            */
            if(get_field($this->acf_field_name,$item->ID)){
                if( ! $this->checkAcfValue ){
                    $this->checkAcfValue = true;    
                }
            }
        }

        /*
            if get one result from acf then will be returned new menu otherwise default will return 
        */
        if($this->checkAcfValue){
            return null;
        }else{
            return $items;   
        }
    }
    
    function mobify_menu($items, $args){
        foreach($this->id as $i => $id){
             $this->acf_field = get_field($this->acf_field_name,$this->id[$i]);
            if( $i > 0 ){
                $this->newMenu .='<li id="'.'menu-item-'.$this->id[$i].'" class="'.$this->li_class[$i].'">'.$this->acf_field.'<a href="'.$this->url[$i].'"><h2>'.$this->title[$i].'</h2></a></li>';
            }
            
            if(get_field($this->acf_field_name,$this->id[$i])){
                if( ! $this->checkAcfValue ){
                    $this->checkAcfValue = true;    
                }
            }
        }
        
        // if get one result from acf then will be returned new menu otherwise default will return
        if($this->checkAcfValue){
            return $this->newMenu;
        }else{
            return $items;   
        }
    }
}

/*
* gsp_menu_modify class required one paramiter that will be the acf field name
*/
new menu_modify_gsp('icon_menu_icon');
