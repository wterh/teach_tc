<?php
declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\Knowledge;
use app\models\Keywords;
use app\models\Relationship;

/**
 * Class AdminController
 * @package app\controllers
 */
class MainController extends Controller
{
    /**
     * Controller constructor.
     * @param array $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'main';
    }

    public function indexAction()
    {
        $this->view->redirect('/knowledge');
    }

    // KNOWLEDGE
    public function knowledgeAction()
    {
        // Step 1 - get Knowledge
        $knowledgeModel = new Knowledge();
        $knowledges = $knowledgeModel->getAll();

        // Step 2 - get Relations
        $relationModel = new Relationship();
        $relations = $relationModel->getAllRelations($knowledges);

        // Step 3 - get Keywords
        $keywordsModel = new Keywords();
        $keywords = $keywordsModel->getAllKeywords($relations);

        $data = [];
        // Step 4 - compare data
        foreach($knowledges as $knowledge) {
            $data[$knowledge['id']]['name'] = $knowledge['name'];

            if(isset($keywords[$knowledge['id']])) {
                $data[$knowledge['id']]['keywords'] = $keywords[$knowledge['id']];
            }
        }

        $vars = [
            'title' => 'Области знаний',
            'urlPath' => '/knowledge',
            'data' => $data
        ];
        $this->view->render($vars);
    }

    // KNOWLEDGE ADD
    public function addKnowledgeAction()
    {
        if (!empty($_POST)) {
            if(empty($_POST['knowledge'])) {
                $this->view->redirect('/knowledge/add');
            }
            $knowledgeModel = new Knowledge();
            $knowledge = $knowledgeModel->addKnowledge($_POST['knowledge']);

            if(!empty($_POST['keywords'])) {
                $relationsModel = new Relationship();
                $relationsModel->addRelations(['id' => $knowledge, 'keywords' => $_POST['keywords']]);
            }

            if ($knowledge) {
                $this->view->redirect('/knowledge');
            } else {
                $this->view->redirect('/knowledge/add');
            }
        } else {
            $keywordsModel = new Keywords();
            $keywords = $keywordsModel->getAll('true');
            $vars = [
                'title' => 'Добавить область',
                'keywords' => $keywords
            ];
            $this->view->render($vars);
        }
    }

    // KNOWLEDGE EDIT
    public function editKnowledgeAction()
    {
        if (!empty($this->route['id'])) {
            if (!empty($_POST)) {
                $knowledge = $_POST['knowledge'];
                $knowledgeModel = new Knowledge();
                $knowledgeModel->edit(['name' => $knowledge], $this->route['id']);

                $relationModel = new Relationship();
                if(!empty($_POST['keywords'])) {
                    $keywords = $_POST['keywords'];
                    $relationModel->checkKeys($keywords, $this->route['id']);
                } else {
                    $relationModel->deleteRelations($this->route['id']);
                }

                $this->view->redirect('/');
            }

            $knowledgeModel = new Knowledge();
            $knowledge = $knowledgeModel->getById($this->route['id']);

            $relationModel = new Relationship();
            $relations = $relationModel->getRelationsById($this->route['id']);

            $keywordsModel = new Keywords();
            $knowledgeKeywords = $keywordsModel->getIdsByParentId($relations);
            $keywordsAll = $keywordsModel->getAll();

            $data = [
                'id' => $knowledge['id'],
                'name' => $knowledge['name'],
                'keywordsSelected' => $knowledgeKeywords,
                'keywords' => $keywordsAll
            ];
            $vars = [
                'title' => 'Изменить ключевое слово',
                'data' => $data
            ];
            $this->view->render($vars);
        } else {
            $this->view->redirect('/');
        }
    }

    // KNOWLEDGE DELETE
    public function deleteKnowledgeAction()
    {
        if (!empty($this->route['id'])) {
            $knowledgeModel = new Knowledge();
            $knowledgeModel->delete($this->route['id']);
            $relationModel = new Relationship();
            $relationModel->deleteRelations($this->route['id']);
            $this->view->redirect('/');
        } else {
            $this->view->redirect('/');
        }
    }
}
