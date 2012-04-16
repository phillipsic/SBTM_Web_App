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
        if ($request->isMethod('post'))
         {
             $this->form->bind($request->getParameter('SearchString'));
             if ($this->form->isValid())
             {
                $this->redirect('Search/index?'.http_build_query($this->form->getValues()));
             }
          }

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

       public function executeReadSearchedSession(sfWebRequest $request) {
        $dirname = $request->getParameter('proj');
        $this->status = Doctrine_Core::getTable('Status')
                        ->createQuery('a')
                        ->execute();
        $name = sbtm::slugify($request->getParameter('name'));
        $this->getUser()->setAttribute('filename', $name);
        $this->getUser()->setAttribute('id', $request->getParameter('id'));
        $myFile = "uploads/{$dirname}/" . $name;
        $this->logMessage($myFile, 'err');
        $theData = file_get_contents($myFile);
        $this->getUser()->setAttribute('theData', $theData);
        $this->logMessage($theData, 'err');
    }


}
