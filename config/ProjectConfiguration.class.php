<?php

require_once 'E://development//sfprojects//SBTM//lib//vendor//symfony//lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {$this->setWebDir('E://development//PQASBTM//web');
    $this->enablePlugins('sfDoctrinePlugin');
  }
}
