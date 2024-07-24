<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Index Controller
 *
 * @method \App\Model\Entity\Index[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IndexController extends AppController
{
    /**
     * 産業医メニュー画面
     */
    public function main() {
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $index = $this->paginate($this->Index);

        $this->set(compact('index'));
    }

    /**
     * View method
     *
     * @param string|null $id Index id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $index = $this->Index->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('index'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $index = $this->Index->newEmptyEntity();
        if ($this->request->is('post')) {
            $index = $this->Index->patchEntity($index, $this->request->getData());
            if ($this->Index->save($index)) {
                $this->Flash->success(__('The index has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The index could not be saved. Please, try again.'));
        }
        $this->set(compact('index'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Index id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $index = $this->Index->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $index = $this->Index->patchEntity($index, $this->request->getData());
            if ($this->Index->save($index)) {
                $this->Flash->success(__('The index has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The index could not be saved. Please, try again.'));
        }
        $this->set(compact('index'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Index id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $index = $this->Index->get($id);
        if ($this->Index->delete($index)) {
            $this->Flash->success(__('The index has been deleted.'));
        } else {
            $this->Flash->error(__('The index could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
