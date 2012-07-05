<?php

class ForumController extends Controller
{
	public function actionIndex(){
		//index page, list the three categories of forum
		$this->render('index');
	}
	
	public function actionForumList(){
		//list of departments
		$model = new ForumCategory();
		//$list = ForumCategory::model()->findAllBySql("SELECT * FROM  `forum_category` ", ' ');
		$this->render('forumlist',array(
			'list' => $model->findAll('id!=1 AND id!=2'),
			));
	}
	
	public function actionArticleList($id,$category,$sort){
		//content of each forum
	}
	
	public function actionAdmin(){
	
	}
	
	public function actionCreate(){
		//add new article
	}
	
	public function actionView($article_id,$forum_id){
		//view article
	}
	
	public function actionUpdate(){
		//update article
	}
	
	public function actionDelete(){
		//delete article
	}
	
	
}