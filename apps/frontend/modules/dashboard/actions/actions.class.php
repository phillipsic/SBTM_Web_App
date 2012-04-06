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


        $this->projects = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->andWhere('a.completetag!=1')
                        ->execute();

        $this->logMessage(">>> LOG Number of projects = " . $this->projects->count());


       
        $q = Doctrine_Query::create()
                        ->select('project_id as projectid, status_id as statusid, count(*) as totalcount, name as projectname')
                        ->from('Sessions s, ProjectCategory p')
                        ->where('p.completetag <> 1')
                        ->andWhere(' p.id = s.project_id')
                        ->groupBy('project_id, status_id');
        $this->sessions = $q->execute();
    }

}