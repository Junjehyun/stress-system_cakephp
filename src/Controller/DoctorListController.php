<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;

/**
 * DoctorList Controller
 *
 * @method \App\Model\Entity\DoctorList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DoctorListController extends AppController
{
    public function initialize(): void {
        parent::initialize();
        /**
         * 各テーブルをインスタンス化 Users, KaisyaMst, TaisyoSoshiki
         * 
         */
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->KaisyaMst = TableRegistry::getTableLocator()->get('KaisyaMst');
        $this->TaisyoSoshiki = TableRegistry::getTableLocator()->get('TaisyoSoshiki');
    }
    /**
     * 産業医一覧画面
     * 
     * @return void
     */
    public function doctorListIndex() {
        /**
         * Table Join
         * 
         * @var mixed
         */
        $query = $this->Users->find()
            ->contain(['KaisyaMst', 'TaisyoSoshiki'])
            ->select([
                'Users.USER_ID',
                'Users.NAME',
                'KaisyaMst.KAISYA_NAME_JPN',
                'TaisyoSoshiki.SOSHIKI_NAME_JPN',
                'Users.KENGEN_KUBUN'
            ])
            ->toArray();

        // ビューにデータを渡す
        $this->set(compact('query'));
    }

    /**
     * Ajax Search Company
     * 
     * @return void
     */
    public function searchCompany() {

        $this->request->allowMethod(['post']); 

        $companyName = $this->request->getData('companyName');  
        if (empty($companyName)) {
            throw new NotFoundException('会社名が入力されていません');
        }

        try {
            $results = $this->KaisyaMst->find()
                ->select(['KAISYA_CODE', 'KAISYA_NAME_JPN'])
                ->where(['KAISYA_NAME_JPN LIKE' => '%' . $companyName . '%'])
                ->toArray();

            $this->set(compact('results'));
            $this->viewBuilder()->setOption('serialize', 'results');

        } catch (\Exception $e) {

            $this->response = $this->response->withStatus(500);
            $this->set(['error' => $e->getMessage()]);
            $this->viewBuilder()->setOption('serialize', ['error']);
        }
    }

    /**
     * Ajax Search Soshiki
     * 
     * @return void
     */
    public function searchSoshiki() {
        $this->request->allowMethod(['post']);

        $soshikiName = $this->request->getData('soshikiName');
        if (empty($soshikiName)) {
            throw new NotFoundException('組織名が入力されていません');
        }

        try {
            $results = $this->TaisyoSoshiki->find()
                ->select(['SOSHIKI_CODE', 'SOSHIKI_NAME_JPN'])
                ->where(['SOSHIKI_NAME_JPN LIKE' => '%' . $soshikiName . '%'])
                ->toArray();

            $this->set(compact('results'));
            $this->viewBuilder()->setOption('serialize', 'results');

        } catch (\Exception $e) {
            $this->response = $this->response->withStatus(500);
            $this->set(['error' => $e->getMessage()]);
            $this->viewBuilder()->setOption('serialize', ['error']);
        }
    }
    /**
     * 表示するボタンを押したときの処理
     * 表示するボタンからPOSTリクエスト処理をする。
     * 選択された会社名、組織名を取得し、それぞれのテーブルからデータを取得する。
     * 
     * @return void
     */
    public function hyojiSearch() {

        // postリクエストか確認(isメソッド)
        if($this->request->is('post')) {

            // フォームから選択された会社名、組織名、権限区分を取得
            $companyName = $this->request->getData('companyNameOutput');
            $soshikiName = $this->request->getData('soshikiNameOutput');
            $kengenKubun = $this->request->getData('kengenKubun');

            //クエリ条件配列初期化
            $conditions = [];

            // 会社名が選択されている場合
            if (!empty($companyName)) {
                $conditions['kaisyaMst.KAISYA_CODE'] = $companyName;

                //画面にはKAISYA_NAME_JPNを表示する
                $searchResultCompany = $this->KaisyaMst->find()
                    ->select(['KAISYA_NAME_JPN'])
                    ->where(['KAISYA_CODE' => $companyName])
                    ->first();
            }
            // 組織名が選択されている場合
            if (!empty($soshikiName)) {
                $conditions['taisyoSoshiki.SOSHIKI_CODE'] = $soshikiName;

                //画面にはSOSHIKI_NAME_JPNを表示する
                $searchResultSoshiki = $this->TaisyoSoshiki->find()
                    ->select(['SOSHIKI_NAME_JPN'])
                    ->where(['SOSHIKI_CODE' => $soshikiName])
                    ->first();
            }
            // 権限区分が選択されている場合
            if (!empty($kengenKubun)) {
                $conditions['users.KENGEN_KUBUN'] = $kengenKubun;
            }
            //条件に合うユーザーをデータベースから照会
            $query = $this->Users->find()
                ->contain(['KaisyaMst', 'TaisyoSoshiki'])
                ->where($conditions);

            // ビューにデータを渡す
            $this->set(compact('query', 'companyName','searchResultCompany', 'soshikiName', 'searchResultSoshiki', 'kengenKubun'));
            $this->render('doctor_list_index');
        }
    }














    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $doctorList = $this->paginate($this->DoctorList);

        $this->set(compact('doctorList'));
    }

    /**
     * View method
     *
     * @param string|null $id Doctor List id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $doctorList = $this->DoctorList->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('doctorList'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $doctorList = $this->DoctorList->newEmptyEntity();
        if ($this->request->is('post')) {
            $doctorList = $this->DoctorList->patchEntity($doctorList, $this->request->getData());
            if ($this->DoctorList->save($doctorList)) {
                $this->Flash->success(__('The doctor list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor list could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorList'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Doctor List id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $doctorList = $this->DoctorList->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorList = $this->DoctorList->patchEntity($doctorList, $this->request->getData());
            if ($this->DoctorList->save($doctorList)) {
                $this->Flash->success(__('The doctor list has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor list could not be saved. Please, try again.'));
        }
        $this->set(compact('doctorList'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Doctor List id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorList = $this->DoctorList->get($id);
        if ($this->DoctorList->delete($doctorList)) {
            $this->Flash->success(__('The doctor list has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
