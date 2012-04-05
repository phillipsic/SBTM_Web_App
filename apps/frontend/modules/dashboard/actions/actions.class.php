<?php

/**
 * dashboard actions.
 *
 * @package    QASBTM
 * @subpackage dashboard
 * @author     Ian Phillips
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dashboardActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->forward('default', 'module');
    }

    public function executeAlldropdashboard(sfWebRequest $request) {


        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();


        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();

        endforeach;

        $this->sessions = Doctrine_Core::getTable('Sessions')
                        ->createQuery('a')
                        ->where('a.project_id = ?', $dbprojectID)
                        ->execute();
    }

}