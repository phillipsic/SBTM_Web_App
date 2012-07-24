<?php

/**
 * Issues actions.
 *
 * @package    QASBTM
 * @subpackage Issues
 * @author     Gunjan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IssuesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new IssuesForm();
  }

   public function executeSubmit(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post'));

        
    }
}
