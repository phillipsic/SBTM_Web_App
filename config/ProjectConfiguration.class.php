<?php

require_once 'E://development//PQASBTM//lib//vendor//symfony//lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('stOfcPlugin');
  }
}
