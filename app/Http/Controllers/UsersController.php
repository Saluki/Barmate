<?php namespace App\Http\Controllers;

use App\Exceptions\RepositoryException;
use App\Exceptions\ValidationException;
use App\Repositories\ConnectRepository;
use App\Repositories\UserRepository;
use Input;

class UsersController extends Controller {
	
	private $userRepository;
    private $connectRepository;

	public function __construct(UserRepository $repository, ConnectRepository $connectRepository)
	{
		$this->userRepository = $repository;
        $this->connectRepository = $connectRepository;
	}

    public function getActiveUsers()
    {
    	$allUsers = $this->userRepository->allByStatus(true);
        $otherUsersCount = count($this->userRepository->allByStatus(false));

        return view('users.app')->with('users', $allUsers)
        						->with('roles', $this->getRoleNames())
        						->with('isActive', true)
                                ->with('otherUsersCount', $otherUsersCount);
    }
    
    public function getDisabledUsers()
    {
    	$allUsers = $this->userRepository->allByStatus(false);
        $otherUsersCount = count($this->userRepository->allByStatus(true));

    	return view('users.app')->with('users', $allUsers)
    							->with('roles', $this->getRoleNames())
    							->with('isActive', false)
                                ->with('otherUsersCount', $otherUsersCount);
    }

    public function showConnections($userId)
    {
        $user = $this->userRepository->get($userId);
        $connections = $this->connectRepository->forUser($userId);

        return view('users.history')->with('user', $user)
                                    ->with('connections', $connections);
    }
    
    public function getRegisterForm()
    {
    	return view('users.register');
    }
    
    public function registerNewUser()
    {
    	try {
    		$user = $this->userRepository->store(Input::all());
    	}
        catch(ValidationException $e) {
            return redirect('app/users/register')->withInput()
                                                 ->with('error', $e->getMessageBag()->first());
        }
        catch (RepositoryException $e) {
    		return redirect('app/users/register')->with('error', 'Could not add new user: '.strtolower($e->getMessage()))
                                                 ->withInput();
    	}
    	    	
    	return redirect('app/users')->with('success', $user->firstname.' account added');
    }
    
    public function changeAccountStatus($userId)
    {    	
    	try {
    		$user = $this->userRepository->changeStatus($userId);
    	}
    	catch(RepositoryException $e) {
    		return redirect('app/users')->with('error', 'Could not change account status');
    	}
    	
    	if($user->is_active)
    		return redirect('app/users/disabled')->with('success', 'User <b>'.$user->firstname.'</b> enabled');
    	else
    		return redirect('app/users')->with('success', 'User <b>'.$user->firstname.'</b> disabled');
    }
    
    public function changeAccountRole($userId)
    {
    	try {
    		$user = $this->userRepository->changeRole($userId);
    	}
    	catch(RepositoryException $e) {
    		return redirect('app/users')->with('error', 'Could not change user role');
    	}
    	
    	$redirectUrl = 'app/users';
    	if( !$user->is_active )
    		$redirectUrl .= '/disabled';
    	
    	$roleNames = ['ADMN'=>'administrator','MNGR'=>'manager','USER'=>'user'];
    	$roleName = $roleNames[$user->role];
    	
    	return redirect($redirectUrl)->with('success', 'User <b>'.$user->firstname.'</b> is now <i>'.$roleName.'</i>');
    }
    
    public function deleteUser($userId)
    {
    	try {
    		$user = $this->userRepository->softDelete($userId);
    	}
    	catch(RepositoryException $e) {
    		return redirect('app/users')->with('error', 'User could not be deleted: '.$e->getMessage());
    	}
    	
    	return redirect('app/users')->with('success', 'User <b>'.$user->firstname.'</b> deleted');
    }

    private function getRoleNames()
    {
        return ['ADMN'=>'Administrator','MNGR'=>'Manager','USER'=>'User'];
    }

}
