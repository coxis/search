<?php
namespace Coxis\Search\Controllers;

class SearchController extends \Coxis\Core\Controller {
	/**
	@Route('search')
	*/
	public function indexAction($request) {
		$this->searchWidget();
		$this->results = array();

		if($this->form->isSent()) {
			$term = $this->form->term->getValue();
			
			foreach(Search::searchEntities('Actualite', $term) as $actualite)
				$this->results[] = array('title'=>$actualite, 'description'=>$actualite->content, 'link'=>$actualite->url());
		}
	}

	public function searchWidget() {
		$this->form = new Form(array('action'=>\Coxis\Core\App::get('url')->url_for(array('Coxis\Search\Controllers\search', 'index'))));
		$this->form->term = new TextField;
	}
}