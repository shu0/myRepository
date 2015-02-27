<?php
/**
 * Created by PhpStorm.
 * User: shugoikeda
 * Date: 15/02/19
 * Time: 21:12
 */

class PostsController extends AppController {

	public  $helpers = array('Html','Form');

	public  function index(){
		$this->set('posts',$this->Post->find('all',array(
			//'conditions'=>array('title'=>'タイトル'),
			'group'=>'created',
			'order' =>'created DESC',
		)));
		//debug($this->request);
		//debug($this->Session->read('SessionData.title'));
		//debug($this->Post->id);
		//debug(dirname(__FILE__));
		//debug( dirname($_SERVER["SCRIPT_NAME"]));
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->write('SessionData.title', $this->request->data['Post']['title']);
				$this->Session->write('SessionData.body', $this->request->data['Post']['body']);
				$this->Session->setFlash(__('Your post(title:%s)(body:%s) has been saved .',$this->Session->read('SessionData.title'),$this->Session->read('SessionData.body')));
				//debug($this->request);

				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your post.'));

		}


	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}

		if ($this->request->is(array('post', 'put'))) {
			//$this->Post->id = $id;
			//debug($this->Post);
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Your post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your post.'));
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Post->delete($id)) {
			$this->Session->setFlash(
				__('The post with id: %s has been deleted.', h($id))
			);
		} else {
			$this->Session->setFlash(
				__('The post with id: %s could not be deleted.', h($id))
			);
		}

		return $this->redirect(array('action' => 'index'));
	}


}
