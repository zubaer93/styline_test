<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

class AuthController extends AppController
{
    private $Users;
    private $Webhook;
    private $WebhookData;


    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->Users = TableRegistry::getTableLocator()->get('Users');
        $this->Webhook = TableRegistry::getTableLocator()->get('Webhook');
        $this->WebhookData = TableRegistry::getTableLocator()->get('WebhookData');
    }

    public function loginWithGithub() {
        $code = $this->request->getQuery('code');

        $user_data = (array) $this->getLoginData($code);
        pr($user_data);
        if(isset($user_data['email'])){
            $user = $this->Users->find()
                ->where(['email' => $user_data['email']])->first();
            if(!$user){
                $user = $this->Users->newEntity();
                $user_data['github_id'] = $user_data['id'];
                $user = $this->Users->patchEntity($user,$user_data);
                if ($this->Users->save($user)){
                    $this->Flash->success(__('succesfully logded in'));
                } else {
                    $this->Flash->error(__('User cannot be saved. Please, try again.'));
                }
            }
            return $this->redirect(['_name' => 'dashboard']);

        } else {
            $this->Flash->error(__('Session logged out'));
        }


    }

    public function dashboard(){
        $webhook_data = $this->WebhookData->find()
                ->order(['id' =>'DESC'])
                ->toArray();
        $this->set(compact(['webhook_data']));
        $this->set('_serialize', ['webhook_data']);
    }

    public function webhook(){
        $data = $this->request->getData();
        $webhook = $this->Webhook->newEntity();
        $webhook->body = json_encode($data);
        $this->Webhook->save($webhook);
        //$this->formatData($data);
        return true;

    }

    private function formatData($data){
        $data = (array) $data;
        $webhook = $this->WebhookData->newEntity();
        $webhook->author_name = $data['commits'][0]['author']['name'];
        $webhook->author_email = $data['commits'][0]['author']['email'];
        $webhook->commit = $data['commits'][0]['message'];
        $webhook->repository = $data['repository']['name'];
        $this->WebhookData->save($webhook);
        return true;
    }

    private function getLoginData($code) {
        $url = 'https://github.com/login/oauth/access_token';
        $data = array(
            'client_id' => 'f3c271f6e2eea28a9777',
            'client_secret' => 'af17182f8bd668fb08241ed0ae4a93106d752e8a',
            'code' => $code,
            //'accept' => ':application/xml'
        );

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $arr = explode("&", $result, 2);
        $first = $arr[0];
        $access_token = substr($first, strpos($first, "=") + 1);

        $req_url = "https://api.github.com/user?access_token=".$access_token;

        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,$req_url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return json_decode($query);
    }
}