<?php

/**
 * Search actions.
 *
 * @package    QASBTM
 * @subpackage Search
 * @author     Gunjan
 */
class SearchActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->form = new SearchForm();
    }

    public function executeSubmit(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post'));

        $params =  $request->getParameter('SearchString');
      
        $this->session_result = Doctrine_Core::getTable('Sessions')
                        ->createQuery('a')
                            -> where('a.sessionname like ?','%'.$params .'%')
                        ->execute();

    //    $this->redirect('Search/sessionlist');
    }

    public function executeSearch(sfWebRequest $request) {
        
    }

}
