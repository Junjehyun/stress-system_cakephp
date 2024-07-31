<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * DoctorEdit Controller
 *
 * @method \App\Model\Entity\DoctorEdit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DoctorEditController extends AppController
{
    /**
     * 初期化処理
     * 
     * @return void
     */
    public function initialize(): void {
        parent::initialize();
        
        //テーブルを取得
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->KaisyaMst = TableRegistry::getTableLocator()->get('KaisyaMst');
        $this->TaisyoSoshiki = TableRegistry::getTableLocator()->get('TaisyoSoshiki');
    }

    /**
     * 産業医情報編集画面へ移動
     * 
     * @param mixed $USER_ID
     * @return void
     */
    public function doctorEdit($USER_ID) {

        $companyCheck = $this->request->getQuery('companyCheck', 'false');
        $soshikiCheck = $this->request->getQuery('soshikiCheck', 'false');
        $kengenCheck = $this->request->getQuery('kengenCheck', 'false');
        $companyNameInput = $this->request->getQuery('companyNameInput');
        $soshikiNameInput = $this->request->getQuery('soshikiNameInput');
        $companyNameOutput = $this->request->getQuery('companyNameOutput');
        $soshikiNameOutput = $this->request->getQuery('soshikiNameOutput');
        $kengenKubun = $this->request->getQuery('kengenKubun');

        $userTable = TableRegistry::getTableLocator()->get('Users');
        $kaisyaTable = TableRegistry::getTableLocator()->get('KaisyaMst');
        $soshikiTable = TableRegistry::getTableLocator()->get('TaisyoSoshiki');

        $userUpdating = $userTable->find()
        ->where(['Users.USER_ID' => $USER_ID])
        ->contain(['KaisyaMst', 'TaisyoSoshiki'])
        ->first();
        
        // 会社リストを取得 
        $kaisyaList = $kaisyaTable->find('list', [
            'keyField' => 'KAISYA_CODE',
            'valueField' => 'KAISYA_NAME_JPN'
        ])->toArray()
        ;
        
        //組織リストを取得
        $soshikiList = $soshikiTable->find('list', [
            'keyField' => 'SOSHIKI_CODE',
            'valueField' => 'SOSHIKI_NAME_JPN'
        ])->toArray()
        ;

        //Update処理
        if ($this->request->is('post')) {
            $userTable->patchEntity($userUpdating, $this->request->getData());
    
            $errors = $userUpdating->getErrors();
            if (empty($this->request->getData('KENGEN_CHECK'))) {
                $errors['KENGEN_CHECK'][] = 'チェックしてください。';
            }
    
            if (empty($errors) && $userTable->save($userUpdating)) {
                $this->Flash->success(__('更新しました。'));
                return $this->redirect(['controller' => 'DoctorList',
                'action' => 'doctorListIndex'
            ]);
            }

            $this->set(compact('userUpdating', 'errors'));
        }
        $this->set(compact('userUpdating', 'kaisyaList', 'soshikiList', 
            'companyCheck', 'soshikiCheck', 'kengenCheck', 'companyNameInput',
            'soshikiNameInput', 'companyNameOutput', 'soshikiNameOutput', 'kengenKubun'
        ));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index()
    // {
    //     $doctorEdit = $this->paginate($this->DoctorEdit);

    //     $this->set(compact('doctorEdit'));
    // }

    /**
     * View method
     *
     * @param string|null $id Doctor Edit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorEdit = $this->DoctorEdit->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('doctorEdit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctorEdit = $this->DoctorEdit->newEmptyEntity();
        if ($this->request->is('post')) {
            $doctorEdit = $this->DoctorEdit->patchEntity($doctorEdit, $this->request->getData());
            if ($this->DoctorEdit->save($doctorEdit)) {
                $this->Flash->success(__('The doctor edit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor edit could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorEdit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor Edit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorEdit = $this->DoctorEdit->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorEdit = $this->DoctorEdit->patchEntity($doctorEdit, $this->request->getData());
            if ($this->DoctorEdit->save($doctorEdit)) {
                $this->Flash->success(__('The doctor edit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor edit could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorEdit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor Edit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorEdit = $this->DoctorEdit->get($id);
        if ($this->DoctorEdit->delete($doctorEdit)) {
            $this->Flash->success(__('The doctor edit has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor edit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
