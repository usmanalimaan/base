<?php
App::uses('CakeEmail', 'Network/Email');
class UsersController extends AppController {
    // aading for social components
    
    var $uses = array('User','SocialProfile');
    public $components = array('Hybridauth');
     // var $layout = 'default'; 
    
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' ) 
        );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','social_login','social_endpoint','forgot_password','reset_password_token'); 
    }
    
    function home()
    {
        
    }
    
    public function login() {
        $this->layout='log';
        
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
        
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
                // $this->send_mail('usmanalimaan@outlook.com','Usman','ksjdlksjldjk');
                $this->redirect('home');
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
                // $this->redirect('login');
            }
        } 
    }
    
    public function logout() {
        $this->Hybridauth->logout();
        $this->redirect($this->Auth->logout());
    }
    
    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
            );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }
    
    
    public function add() {
        $this->layout='log';
        
        if ($this->request->is('post')) {
           
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
    }
    
    public function edit($id = null) {
       
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        
        $user = $this->User->findById($id);
        if (!$user) {
            $this->Session->setFlash('Invalid User ID Provided');
            $this->redirect(array('action'=>'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
               $this->Session->setFlash('The user has been updated');
                   // $this->Flash->set('The user has been updated');
                   //  $this->Flash->success('The user has been Updated!', array(
                   //      'key' => 'positive'));
               $this->redirect(array('action' => 'index'));
                      // $this->redirect(array('action' => 'edit', $id));
           }else{
            $this->Session->setFlash(__('Unable to update your user.'));
                    //$this->Flash->success('Unable to update your user', array(
                        //'key' => 'positive'));
        }
    }
    
    if (!$this->request->data) {
        $this->request->data = $user;
    }
}

public function delete($id = null) {
   
    if (!$id) {
        $this->Session->setFlash('Please provide a user id');

        $this->redirect(array('action'=>'index'));
    }
    
    $this->User->id = $id;
    if (!$this->User->exists()) {
        $this->Session->setFlash('Invalid user id provided');
        $this->redirect(array('action'=>'index'));
    }
    if ($this->User->saveField('status', 0)) {
        $this->Session->setFlash(__('User deleted'));
        $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('User was not deleted'));
    $this->redirect(array('action' => 'index'));
}

public function activate($id = null) {
   
    if (!$id) {
        $this->Session->setFlash('Please provide a user id');
        $this->redirect(array('action'=>'index'));
    }
    
    $this->User->id = $id;
    if (!$this->User->exists()) {
        $this->Session->setFlash('Invalid user id provided');
        $this->redirect(array('action'=>'index'));
    }
    if ($this->User->saveField('status', 1)) {
        $this->Session->setFlash(__('User re-activated'));
        $this->redirect(array('action' => 'index'));
    }
    $this->Session->setFlash(__('User was not re-activated'));
    $this->redirect(array('action' => 'index'));
}
public function social_login($provider) {
    if( $this->Hybridauth->connect($provider) ){
        $this->_successfulHybridauth($provider,$this->Hybridauth->user_profile);
    }else{
        // error
        $this->Session->setFlash($this->Hybridauth->error);
        $this->redirect($this->Auth->loginAction);
    }
}
public function social_endpoint($provider) {
    $this->Hybridauth->processEndpoint();
}

private function _successfulHybridauth($provider, $incomingProfile){
   
    // #1 - check if user already authenticated using this provider before
    $this->SocialProfile->recursive = -1;
    $existingProfile = $this->SocialProfile->find('first', array(
        'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
        ));
    
    if ($existingProfile) {
        // #2 - if an existing profile is available, then we set the user as connected and log them in
        $user = $this->User->find('first', array(
            'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
            ));
        
        $this->_doSocialLogin($user,true);
    } else {
       
        // New profile.
        if ($this->Auth->loggedIn()) {
            // user is already logged-in , attach profile to logged in user.
            // create social profile linked to current user
            $incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
            $this->SocialProfile->save($incomingProfile);
            
            $this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
            $this->redirect($this->Auth->redirectUrl());
            
        } else {
            // no-one logged and no profile, must be a registration.
            $user = $this->User->createFromSocialProfile($incomingProfile);
            $incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
            $this->SocialProfile->save($incomingProfile);
            
            // log in with the newly created user
            $this->_doSocialLogin($user);
        }
    }   
}

private function _doSocialLogin($user, $returning = false) {
   
    if ($this->Auth->login($user['User'])) {
        if($returning){
            $this->Session->setFlash(__('Welcome back, '. $this->Auth->user('username')));
        } else {
            $this->Session->setFlash(__('Welcome to our community, '. $this->Auth->user('username')));
        }
        $this->redirect($this->Auth->loginRedirect);
        
    } else {
        $this->Session->setFlash(__('Unknown Error could not verify the user: '. $this->Auth->user('username')));
    }
}

public function send_mail() {
            // $confirmation_link = "http://" . $_SERVER['HTTP_HOST'] . $this->webroot . "users/login/";
            // $message = 'Hi, Your Password is: ';
            // App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail('gmail');
    $email->from('022bscs2012@gmail.com');
    $email->to('usmanalimaan@outlook.com');
    $email->subject('Mail Confirmation');
    $email->send("hahahahahhaha");
    $this->Session->setFlash('success');
    return $this->redirect(array('action' => 'index'));
}
    /**
     * Allow a user to request a password reset.
     * Here is Git code
     * @return
     */
    function forgot_password() {
        $this->layout='log';
        if (!empty($this->request->data)) {
            $user = $this->User->findByUsername($this->request->data['User']['username']);
            // debug($user);
            // exit();
            if (empty($user)) {
                $this->Session->setflash('Sorry, the username entered was not found.');
                $this->redirect('/users/forgot_password');
            } else {
                $user = $this->__generatePasswordToken($user);
                if ($this->User->save($user) && $this->__sendForgotPasswordEmail($user['User']['id'])) {
                    $this->Session->setflash('Password reset instructions have been sent to your email address.
                        You have 24 hours to complete the request.');
                    $this->redirect('/users/login');
                }
            }
        }
    }
    /**
     * Allow user to reset password if $token is valid.
     * @return
     */
    function reset_password_token($reset_password_token = null) {
        $id=$reset_password_token;
        $this->set('id',$id);
        $this->layout='log';
        if (empty($this->request->data)) {
            $this->request->data = $this->User->findByResetPasswordToken($reset_password_token);
            if (!empty($this->request->data['User']['reset_password_token']) && !empty($this->request->data['User']['token_created_at']) &&
                $this->__validToken($this->request->data['User']['token_created_at'])) {
                $this->request->data['User']['id'] = null;
            $_SESSION['token'] = $reset_password_token;
        } else {
            $this->Session->setflash('The password Reset request has either expired or is invalid.');
            $this->redirect('/users/login');
        }
    } else {
        // debug($_SESSION['token']);
        // exit();
        if ($this->request->data['User']['reset_password_token'] != $_SESSION['token']) {
            $this->Session->setflash('The password reset request has either  expired or is invalid.');
            $this->redirect('/users/login');
        }
        $user = $this->User->findByResetPasswordToken($this->request->data['User']['reset_password_token']);
        $this->User->id = $user['User']['id'];
        if ($this->User->save($this->request->data, array('validate' => 'only'))) {
            $this->request->data['User']['reset_password_token'] = $this->request->data['User']['token_created_at'] = null;
            if ($this->User->save($this->request->data) && $this->__sendPasswordChangedEmail($user['User']['id'])) {
                unset($_SESSION['token']);
                $this->Session->setflash('Your password was changed successfully. Please login to continue.');
                $this->redirect('/users/login');
            }
        }
    }
}
    /**
     * Generate a unique hash / token.
     * @param Object User
     * @return Object User
     */
    function __generatePasswordToken($user) {
        if (empty($user)) {
            return null;
        }
        // Generate a random string 100 chars in length.
        $token = "";
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33,79)) : $token .= chr(rand(80,126));
        }
        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;
        // Generate hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }
        $user['User']['reset_password_token'] = $hash;
        $user['User']['token_created_at']     = date('Y-m-d H:i:s');
        return $user;
    }
    /**
     * Validate token created at time.
     * @param String $token_created_at
     * @return Boolean
     */
    function __validToken($token_created_at) {
        $expired = strtotime($token_created_at) + 86400;
        $time = strtotime("now");
        if ($time < $expired) {
            return true;
        }
        return false;
    }
    /**
     * Sends password reset email to user's email address.
     * @param $id
     * @return
     */
    function __sendForgotPasswordEmail($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            $link=$this->base;
            $User = $this->User->read();
            // $this->Email->to        = $User['User']['email'];
            $email = new CakeEmail('gmail');
            $email->from('022bscs2012@gmail.com');
            $email->to($User['User']['email']);
            $email->subject('Password Reset Request - DO NOT REPLY');
            // $email->message();
            $email->send("http://localhost/base/users/reset_password_token/".$User['User']['reset_password_token']);
            // $this->Email->subject   = 'Password Reset Request - DO NOT REPLY';
            // $this->Email->replyTo   = 'do-not-reply@example.com';
            // $this->Email->from      = '022bscs2012@gmail.com';
            // $this->Email->template  = 'reset_password_request';
            // $this->Email->sendAs    = 'both';
            $this->set('User', $User);
            // $this->Email->send();
            return true;
        }
        return false;
    }
    /**
     * Notifies user their password has changed.
     * @param $id
     * @return
     */
    function __sendPasswordChangedEmail($id = null) {
        if (!empty($id)) {
            // $this->User->id = $id;
            $User = $this->User->read();
            // $this->Email->to        = $User['User']['email'];
            // $this->Email->subject   = 'Password Changed - DO NOT REPLY';
            // $this->Email->replyTo   = 'do-not-reply@example.com';
            // $this->Email->from      = 'Do Not Reply <do-not-reply@example.com>';
            // $this->Email->template  = 'password_reset_success';
            // $this->Email->sendAs    = 'both';
            // $this->set('User', $User);
            // $this->Email->send();
            $email = new CakeEmail('gmail');
            $email->from('022bscs2012@gmail.com');
            $email->to($User['User']['email']);
            $email->subject('Password Reset success - DO NOT REPLY');
            // $email->message();
            $email->send("Your Password has been Updated");
            return true;
        }
        return false;
    }


    
}
?>