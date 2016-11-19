<?php
/**
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
    $element = array();
    if(!isset($data['data']['theme'])){
      $data['data']['theme'] = 'Cerulean';
    }
    $element[] = wfDocument::createHtmlElement('link', null, array('href' => '/plugin/bootstrap/bootswatch_v337/'.strtolower($data['data']['theme']).'/bootstrap.min.css', 'rel' => 'stylesheet'));
    wfDocument::renderElement($element);
  }
}