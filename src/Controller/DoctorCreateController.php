<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * DoctorCreate Controller
 *
 * @method \App\Model\Entity\DoctorCreate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DoctorCreateController extends AppController
{
    public function initialize(): void {
        
        parent::initialize();

        /**
         * テーブルを取得
         */
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->KaisyaMst = TableRegistry::getTableLocator()->get('KaisyaMst');
        $this->TaisyoSoshiki = TableRegistry::getTableLocator()->get('TaisyoSoshiki');
    }

    /**
     * 産業医登録画面へ移動
     * 
     * @return void
     */
    public function doctorCreateIndex() {

        $companyName = $this->KaisyaMst->find('list', [
            'keyField' => 'KAISYA_CODE',
            'valueField' => 'KAISYA_NAME_JPN'
        ])->toArray();

        $soshikiName = $this->TaisyoSoshiki->find('list', [
            'keyField' => 'SOSHIKI_CODE',
            'valueField' => 'SOSHIKI_NAME_JPN'
            ])->toArray();

        $this->set(compact('companyName', 'soshikiName'));

    }

    public function createDoctor() {

        //リクエストがPOSTかどうか確認
        if ($this->request->is('post')) {
            //新たな産業医を生成する
            $doctor = $this->Users->newEmptyEntity();
            //フォームデータをUsersエンティティにパッチする
            $doctor = $this->Users->patchEntity($doctor, $this->request->getData());
            //産業医をデータベースに保存する
            if ($this->Users->save($doctor)) {
                //成功メッセージを表示, doctor-listページにリダイレクト
                $this->Flash->success(__('産業医登録が完了しました'));
                return $this->redirect(['controller' => 'DoctorList','action' => 'doctorListIndex']);
            }
            //エラーメッセージを表示
            $this->Flash->error(__('エラーが発生しました'));
        }
        return $this->redirect(['action' => 'doctorCreateIndex']);
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $doctorCreate = $this->paginate($this->DoctorCreate);

        $this->set(compact('doctorCreate'));
    }

    /**
     * View method
     *
     * @param string|null $id Doctor Create id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorCreate = $this->DoctorCreate->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('doctorCreate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctorCreate = $this->DoctorCreate->newEmptyEntity();
        if ($this->request->is('post')) {
            $doctorCreate = $this->DoctorCreate->patchEntity($doctorCreate, $this->request->getData());
            if ($this->DoctorCreate->save($doctorCreate)) {
                $this->Flash->success(__('The doctor create has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor create could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorCreate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor Create id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorCreate = $this->DoctorCreate->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorCreate = $this->DoctorCreate->patchEntity($doctorCreate, $this->request->getData());
            if ($this->DoctorCreate->save($doctorCreate)) {
                $this->Flash->success(__('The doctor create has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor create could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorCreate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor Create id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorCreate = $this->DoctorCreate->get($id);
        if ($this->DoctorCreate->delete($doctorCreate)) {
            $this->Flash->success(__('The doctor create has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor create could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
