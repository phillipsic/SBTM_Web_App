<?php

/**
 * Search actions.
 *
 * @package    PQASBTM
 * @subpackage Search
 * @author     Mohamed Sithik
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SearchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new SearchForm();
  }
  public function executeSubmit(sfWebRequest $request)
{
  $this->forward404Unless($request->isMethod('post'));

  $params = array(
    'SearchString'    => $request->getParameter('SearchString'),
  );
  $this->session_result = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
            ->where('a.sessionname like ?', $dbSearchString)
      ->execute();
    
  $this->redirect('Search/SessionList');
}
}
