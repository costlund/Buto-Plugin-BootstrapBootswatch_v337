<?php
/***
<p>Plugin to override bootstrap default css. 16 avilable css included.</p>
<p>This plugin has a public folder who has to be moved, copied or linked to public part of Buto.</p>
<p>Visit <a href="https://www.bootswatch.com/" target="_blank">www.bootswatch.com</a> for more info.</p>
 */
class PluginBootstrapBootswatch_v337{
  /**
  <p>Include this widget after bootstrap default css or remove it complete.</p>
  <p>One of these can be used. Default is Cerulean.</p>
  #code-yml#
  #load:[app_dir]/plugin/[plugin]/theme/availible.yml:load#
  #code#
  */
  public static function widget_include($data){
    /**
     * Set other theme in session via querystring.
     */
    if(wfRequest::get('bootstrap_bootswatch_v337_theme')){
      /**
       * Check if the theme exist.
       */
      $availible = wfSettings::getSettings('/plugin/bootstrap/bootswatch_v337/theme/availible.yml');
      if(array_search(wfRequest::get('bootstrap_bootswatch_v337_theme'), $availible)!==false){
        $_SESSION['plugin']['bootstrap']['bootswatch_v337']['theme'] = wfRequest::get('bootstrap_bootswatch_v337_theme');
      }
    }
    /**
     * Set theme.
     */
    if(isset($_SESSION['plugin']['bootstrap']['bootswatch_v337']['theme'])){
      /**
       * If set in Session.
       */
      $data['data']['theme'] = $_SESSION['plugin']['bootstrap']['bootswatch_v337']['theme'];
    }elseif(!isset($data['data']['theme'])){
      /**
       * If not set in widget we set Cerulean as default theme.
       */
      $data['data']['theme'] = 'Cerulean';
    }else{
      /**
       * The theme is not in session and is set in widget.
       */
    }
    /**
     * Set current theme to pic upp in selectbox widget.
     */
    wfArray::set($GLOBALS, 'sys/settings/plugin/bootstrap/bootswatch_v337/current_theme', $data['data']['theme']);
    /**
     * Create element and render.
     */
    $element = array();
    $element[] = wfDocument::createHtmlElement('link', null, array('href' => '/plugin/bootstrap/bootswatch_v337/'.strtolower($data['data']['theme']).'/bootstrap.min.css', 'rel' => 'stylesheet'));
    wfDocument::renderElement($element);
  }
  /**
  <p>Add a selectbox to your page to let user channge to other theme in current session.</p>
   */
  public static function widget_selectbox($data){
    wfPlugin::includeonce('wf/array');
    /**
     * Get settings to pic up default class and method.
     */
    $settings = new PluginWfArray($GLOBALS['sys']['settings']);
    /**
     * Current theme.
     */
    $current_theme = wfArray::get($GLOBALS, 'sys/settings/plugin/bootstrap/bootswatch_v337/current_theme');
    /**
     * Create select.
     */
    $select = wfDocument::createHtmlElementAsObject('select');
    $select->set('attribute/onchange', "location.href='/".$settings->get('default_class')."/".$settings->get('default_method')."/bootstrap_bootswatch_v337_theme/'+this.options[this.selectedIndex].text;");
    $availible = wfSettings::getSettings('/plugin/bootstrap/bootswatch_v337/theme/availible.yml');
    $option = array();
    $option[] = wfDocument::createHtmlElement('option', '', array('value' => ''));
    foreach ($availible as $key => $value) {
      $attribute = array('value' => $value);
      if($value == $current_theme){
        $attribute = array_merge($attribute, array('selected' => 'selected'));
      }
      $option[] = wfDocument::createHtmlElement('option', $value, $attribute);
    }
    $select->set('innerHTML', $option);
    /**
     * Render.
     */
    wfDocument::renderElement(array($select->get()));
  }
}










